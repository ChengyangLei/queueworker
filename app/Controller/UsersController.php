<?php 
class UsersController extends AppController {

    public $layout = "admin";
    public $allow = array('register','login','captcha');
    public $prefixLayout = true;
    public $uses = array('User','Vip','Log');

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function register($action='/Users/home') {
        $this->layout = 'default';
        $this->site_title = '快速注册 ';

        if ( $this->UserAuth->isLogged() ) {
            $uri = $this->Session->read( UserAuthComponent::originAfterLogin );
            $this->Session->delete( UserAuthComponent::originAfterLogin );
            if ( $uri )
                $this->redirect( $uri );
            else
                $this->redirect($action);
        }

        if ( $this->request->isPost() ) {
            $postData = $this->data;
            $postData['User']['role'] = 'user';
            $postData['User']['created'] = time();
            $postData['User']['last_login'] = time();

            if ( @$postData['User']['password'] !== @$postData['User']['cpassword'] ) {
                $this->User->validationErrors = array(
                    'cpassword' => array( '两次输入密码不一致' )
                );
                return;
            }
            $this->User->create( $postData );
            $user = $this->User->save( $postData );
            if ($user) {
                $this->succ("注册成功!");
                $this->UserAuth->flashUser( $user['User']['id'] );
                if ( $uri )
                    $this->redirect( $uri );
                else
                    $this->redirect( $action );
            }
        }
    }

    public  function login( $action = '/Users/home') {
        $this->layout = "default";

        //寻找可用账号
        $vip = $this->Vip->find('first',array(
            'conditions'=>array(
                "OR"=>array(
                    'today <'=>date("Y-m-d"),
                    array(
                        'number < 20',
                        'today ='=>date("Y-m-d"),
                    )
                )
            ),
        ));
        if (!$vip) {
            throw new Exception("系统错误,联系管理员！", 1);
        }
        $this->Session->write("vip",$vip['Vip']);
        if ( $this->request->isPost() ) {
            $this->request->data['User']['email'] = trim( $this->request->data['User']['email'] );
            $this->request->data['User']['password'] = trim( $this->request->data['User']['password'] );

            $postData = $this->data;

            $email = $postData['User']['email'];
            $password = $postData['User']['password'];
            $this->User->recursive = -1;
            $this->User->cache=false;
            $user = $this->User->findByEmail( $email );
            if ( $user['User']['password'] != $password ) {

                $this->User->validationErrors = array(
                    'password' => array( "密码错误" )
                );
                $this->warning( '密码错误' );
                return;          

            }   

            //管理员直接登陆
            if ($user['User']['role'] == 'admin') {
                $this->UserAuth->login( $user );
                $uri = $this->Session->read( UserAuthComponent::originAfterLogin );
                if ( !$uri ) {
                    $uri = $action;
                }
                CakeSession::delete( 'Message.flash' );
                $this->Session->delete( UserAuthComponent::originAfterLogin );
                $this->redirect( $uri );
            }

            if (strtotime($user['User']['expired']) <= time()) {
                $this->warning( '账户已经过期!' );
                return;   
            }

            // $loginParams为curl模拟登录时post的参数
            $loginParams['UserName'] = $vip['Vip']['username'];
            $loginParams['PassWord'] = $vip['Vip']['password'];
            $loginParams['RememberMe'] = "true";

            $loginParams['VerifyCode'] = $postData['User']['captcha'];
            $loginParams['backurl'] = "http://user.nipic.com";

            // $cookieFile 为加载验证码时保存的cookie文件名 
            $cookieFile = WWW_ROOT.'cookie.tmp';

            // $targetUrl curl 提交的目标地址
            $targetUrl = 'http://login.nipic.com';

            //远程登陆
            $ch = curl_init($targetUrl);
            curl_setopt($ch,CURLOPT_COOKIEFILE, $cookieFile); //同时发送Cookie
            curl_setopt($ch,CURLOPT_COOKIEJAR, $cookieFile); // 把返回来的cookie信息保存在文件中
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $loginParams); //提交查询信息
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);  //是否抓取跳转后的页面
            $content = curl_exec($ch);
            curl_close($ch);

            if (strpos($content,"/nibi/index")) {
                $this->UserAuth->login( $user );
                $this->succ("登陆成功!");
                $this->redirect(array('action'=>'home'));
            }else{
                $error = array();
                $preg = '<span class="field-validation-error".*>([^"]*)</span>';
                preg_match("/span class=\"field-validation-error\".*\>([^\"]*)\<\/span/",$content,$error);
                $this->error('登录失败!错误原因为:'.$error[1]);
                $this->redirect(array('action'=>'login'));
            }
        }
    }


    /**
     * 验证码
     */
    public function captcha()
    {
        header('Content-Type:image/png');
        $cookieFile = WWW_ROOT.'cookie.tmp';
        $ch = curl_init("http://login.nipic.com/account/verifycode?r=0.03192671708666017");
        curl_setopt($ch,CURLOPT_COOKIEJAR, $cookieFile); // 把返回来的cookie信息保存在文件中
        curl_exec($ch);
        curl_close($ch);
        $this->_stop();
    }


    /**
     * 是否昵图网下载登陆
     */
    public function isOtherLogin()
    {
        $cookieFile = WWW_ROOT.'cookie.tmp';
        $ch = curl_init("http://user.nipic.com/");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_COOKIEFILE, $cookieFile); //同时发送Cookie
        curl_setopt($ch,CURLOPT_COOKIEJAR, $cookieFile); // 把返回来的cookie信息保存在文件中
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);  //是否抓取跳转后的页面
        $content = curl_exec($ch);
        curl_close($ch);
        return strpos($content,"我的昵图");
    }

    /**
     * down 下载
     */
    public function down()
    {
        // http://file564d4.nipic.com/0000-00-00/downvsid.asp?clink=http://file564d4.nipic.com/20140813/Nipic_2160477_32696b40b65db586.zip&ctime=2014/9/1%2023:26:43&ccode=ad23a34fc8c2432e83eb9ac20735eb47&ckind=1&ctout=2014/9/2%202:13:23
        if (!$this->isOtherLogin()) {
            $this->error("先登录！");
            $this->redirect(array('controller'=>'Users','action'=>'login'));
        }

        $user = $this->UserAuth->getUser();
        $user_id = $this->UserAuth->getUserId();
        if ($user['User']['number'] <= 0) {
            $this->error("账户余额不足!");
            $this->redirect(array('controller'=>'Users','action'=>'home'));
        }
        $url = $this->request->data['url'];
        if (!$url) {
            $this->error("错误填写!");
            $this->redirect($this->referer());
        }
        $id = array();
        preg_match("/[0-9]+/",$url,$id);
        $id = $id[0];
        if (!is_numeric($id)) {
            $this->error("没有找到目标信息!");
            $this->redirect($this->referer());
        }
        $loginParams = array('id'=>$id,'kid'=>2);
        $cookieFile = WWW_ROOT.'cookie.tmp';
        $ch = curl_init("http://down.nipic.com/ajax/download_go");
        curl_setopt($ch,CURLOPT_COOKIEFILE, $cookieFile); //同时发送Cookie
        curl_setopt($ch,CURLOPT_COOKIEJAR, $cookieFile); // 把返回来的cookie信息保存在文件中
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $loginParams); //提交查询信息
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);  //是否抓取跳转后的页面
        $content = curl_exec($ch);
        curl_close($ch);   
        $content = json_decode($content,true);
        if ($content['code'] == 1000) {

            //日志
            $this->loadModel("Log");
            $this->Log->create(
                array(
                    'user_id'=>$this->UserAuth->getUserId(),
                    'url'=>$url,
                )
            );
            $this->Log->save();
            //更新下载次数
            $vip =  $this->Session->read("vip");
            $vip = $this->Vip->read(null,$vip['id']);
            $vip = $vip['Vip'];

            if ($vip['today'] == date("Y-m-d")) {
                $this->Vip->updateAll(array('number'=>"number + 1"),array('id'=>$vip['id']));
            }else{
                $this->Vip->id = $vip['id'];
                $this->Vip->saveField('number',1);
                $this->Vip->saveField('today',date('Y-m-d'));
            }
            //更新用户个数
            $this->User->updateAll(array('number'=>'number - 1'),array('User.id'=>$user_id));
            $this->UserAuth->flashUser($user_id);

            $this->redirect($content['data']['url']);
        }else{
            $this->error("请求失败。错误信息:".$content['mes']);
            $this->redirect($this->referer());
        }
    }

    public function logs()
    {
        $this->layout = "default";
        $user_id = $this->UserAuth->getUserId();
        $conditions = array('user_id'=>$user_id);

        $query = $this->request->query;
        if ($query['start_time']) {
            $conditions['Log.created >= '] = strtotime($query['start_time']);
        }
        if ($query['end_time']) {
            $conditions['Log.created <= '] = strtotime($query['end_time']);
        }
        if ($query['url']) {
            $conditions['Log.url like '] = "%".$query['url']."%";
        }
        $this->request->data['Log'] = $query;
        $this->paginate = array(
            'conditions'=>$conditions,
            'order'=>array('Log.id desc'),
        );
        $data = $this->paginate("Log");
        $this->set('data',$data);
    }

    public function admin_logs()
    {
        $conditions = array();
        $query = $this->request->query;
        if ($query['start_time']) {
            $conditions['Log.created >= '] = strtotime($query['start_time']);
        }
        if ($query['end_time']) {
            $conditions['Log.created <= '] = strtotime($query['end_time']);
        }
        if ($query['url']) {
            $conditions['Log.url like '] = "%".$query['url']."%";
        }
        $this->request->data['Log'] = $query;
        $this->paginate = array(
            'conditions'=>$conditions,
            'order'=>"Log.id desc"
        );
        $data = $this->paginate("Log");
        $this->set('data',$data);
    }

    public function logout() {
        $this->UserAuth->logout();
        $this->redirect( array( 'action' => 'login' ) );
    }

    public function home()
    {
        $this->layout = "default";
        if($this->request->isPost()){
            $data  = $this->request->data;
        }
        // $this->isOtherLogin();
    }

    public function password()
    {
        $this->layout = "default";
        $active_arr = $this->User->active_arr;
        $this->set(compact('active_arr'));
        $id = $this->UserAuth->getUserId();

        $me = $this->UserAuth->getUser();
        $role_arr = $this->User->role_arr;
        $this->set('role_arr',$role_arr);
        if ($this->request->isPost() || $this->request->isPut()){
            $post_data = $this->request->data;

            $data = $this->request->data;
            if ($data['User']['password'] !== $data['User']['cpassword']) {
                $this->User->validationErrors = array(
                    'cpassword' => array("两次输入密码不一致")
                );
                return;
            }
            if (strlen($data['User']['password']) < 6) {
                $this->User->validationErrors = array(
                    'password' => array("密码最少6位数")
                );
                return;
            }
            if ($data['User']['opassword'] !== $me['User']['password']) {
                $this->User->validationErrors = array(
                    'opassword' => array("密码错误")
                );
                return;
            }
            $this->User->id = $id;
            if ($this->User->save($post_data)) {
                 $this->succ('修改成功!');
                 $this->redirect(array('controller'=>'Users','action'=>'login','admin'=>false));
            }else{
                $this->error('修改失败'.print_r($this->User->validationErrors,true));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }


    public function admin_password()
    {
        $active_arr = $this->User->active_arr;
        $this->set(compact('active_arr'));
        $id = $this->UserAuth->getUserId();

        $me = $this->UserAuth->getUser();
        $role_arr = $this->User->role_arr;
        $this->set('role_arr',$role_arr);
        if ($this->request->isPost() || $this->request->isPut()){
            $post_data = $this->request->data;

            $data = $this->request->data;
            if ($data['User']['password'] !== $data['User']['cpassword']) {
                $this->User->validationErrors = array(
                    'cpassword' => array("两次输入密码不一致")
                );
                return;
            }
            if (strlen($data['User']['password']) < 6) {
                $this->User->validationErrors = array(
                    'password' => array("密码最少6位数")
                );
                return;
            }
            if ($data['User']['opassword'] !== $me['User']['password']) {
                $this->User->validationErrors = array(
                    'opassword' => array("密码错误")
                );
                return;
            }
            $this->User->id = $id;
            if ($this->User->save($post_data)) {
                 $this->succ('修改成功!');
                 $this->redirect(array('controller'=>'Users','action'=>'login','admin'=>false));
            }else{
                $this->error('修改失败'.print_r($this->User->validationErrors,true));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

/**
 * admin_index method
 *
 * @return void
 */
    public function admin_index() {
        $this->layout = "admin";
        $this->User->recursive = 0;
        $this->paginate = array(
            'order'=>'User.id desc'
        );
        $this->set('data', $this->paginate());
    }


/**
 * admin_add method
 *
 * @return void
 */
    public function admin_add() {
        if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
                $this->succ("添加成功");
                $this->redirect(array('action'=>'index'));
            }else{
                return ;
            }
        }

    }

    public function admin_edit($id = null) {
       $active_arr = $this->User->active_arr;
        $this->set(compact('active_arr'));
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('无效用户!'));
        }
        
        $role_arr = $this->User->role_arr;
        $this->set('role_arr',$role_arr);
        if ($this->request->isPost() || $this->request->isPut()){
            $post_data = $this->request->data;
            if ($this->User->save($post_data)) {
                 $this->succ('修改成功!');
                 $this->redirect($this->referer());
            }else{
                $this->error('修改失败'.print_r($this->User->validationErrors,true));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function admin_delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->succ('删除成功');
        } else {
            $this->error('删除失败');
        }
        return $this->redirect(array('action' => 'index'));
    }
}
 ?>