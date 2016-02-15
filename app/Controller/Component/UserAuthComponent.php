<?php

class UserAuthComponent extends Component {

    var $components = array('Session');

    /**
     * session key
     *
     * @var string
     */

    const sesskey = 'user';

    /**
     * 登录后转跳地址
     *
     * @var unknown_type
     */
    const originAfterLogin = 'origin_after_login';

    
    /**
     * 退出后的登录页面
     *
     * @var unknown_type
     */
    const pageAfterLogout = 'page_after_logout';

    /**
     * 验证方法名
     *
     * @var unknown_type
     */
    private $isAuthorized = 'isAuthorized';

    function initialize(Controller $controller) {
        static $_initialized;
        if ($_initialized) {
            // 存在2次初始化情况，目的是优化性能。
            return;
        }
        if (!in_array(get_class($controller), array('CakeErrorController')) 
            && is_callable(array($controller, $this->isAuthorized))) {
            $user = $this->getUser();
            $controller->{$this->isAuthorized}($user);
        }
        $_initialized = true;
    }

    function isLogged() {
        return ($this->getUserId() > 0);
    }

    /**
     * 刷新用户数据
     *
     * @param int $user_id
     */
    function flashUser($user_id) {
        $controller = $this->_Collection->getController();
        $controller->loadModel('User');
        $controller->User->recursive = 0;
        $user = $controller->User->read(null, $user_id);
        $this->login($user);
    }

    function getUser() {
        static $u = null;
        if ($u === null) {
            $u = $this->Session->read(self::sesskey);
        }
        return $u;
    }

    function getUserId() {
        $u = $this->getUser();
        return isset($u['User']['id']) ? $u['User']['id'] : 0;
    }

    function getUserDomainId()
    {
        $u = $this->getUser();
        return isset($u['User']['domain_id']) ? $u['User']['domain_id'] : 0;
    }
    
    /**
     * 打通 电子票 淘宝 移动营销三者
     * @return type
     */
    function openTicketTaobaoMedia(){
        $u = $this->getUser();
        return isset($u['User']['open_ticket_taobao_media']) ? $u['User']['open_ticket_taobao_media'] : 0;
    }
    
    /*
     * 打开了自供码，自己提供对换码
     * 
     */
    function openMerchantQrcode(){
        $u = $this->getUser();
        return isset($u['User']['open_merchant_qrcode']) ? $u['User']['open_merchant_qrcode'] : 0;
    }
    
    /**
     * 是否关掉了显示 电商平台
     * @return type
     */
    function closeTicketEB(){
        $u = $this->getUser();
        return isset($u['User']['close_ticket_eb']) ? $u['User']['close_ticket_eb'] : 0;
    }
    
    function login($data) {
        $this->Session->write(self::sesskey, $data);
    }

    function logout() {
        $this->Session->delete(self::sesskey);
        $this->Session->destroy();
    }
    
    /**
     * 取得当前用户（平台商）的网站domain_id
     *
     * @author LinYang
     * @return int
     */
    function getAgentDomainId() {
        $u = $this->getUser();
        if ($u['UserGroup']['alias']!='agent') {
            return 0;
        }
        $controller = $this->_Collection->getController();
        $controller->loadModel('Engine');
        $domain = $controller->Engine->findByUserId($u['User']['id']);
        return isset($domain['Engine']['domain_id']) ? $domain['Engine']['domain_id'] : 0;
    }    

    function getUserIP() {
        $user_ip = $_SERVER["REMOTE_ADDR"];
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $user_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        $IPs_arry = explode(',', $user_ip);
        if (strtolower($IPs_arry[0]) == 'unknown')
            return 0;
        return $IPs_arry[0];
    }

    public function saveIp($users_id = 0) {
        if (!$users_id) {
            $users_id = $this->getUserId();
        }
        $cahekey = "ecode_save_ip_" . md5($users_id . "_" . $this->getUserIP());
        if (Cache::read($cahekey)) {
            return 1;
        }
        Cache::write($cahekey, time());

        $controller = $this->_Collection->getController();

        $controller->loadModel('UserIp');
        $controller->UserIp->create(array(
            'user_id' => $users_id,
            'ip' => $this->getUserIP(),
            'created'=>time(),
        ));
        $controller->UserIp->save();
    }

    /**
     * 设置用户组
     *
     * @return void
     * @author 
     **/
    public function setGroup($alias)
    {
        if (!$alias) {
            return ;
        }
        $user = $this->getUser();
        if (!isset($user['UserGroup']['alias'])) {
            throw new Exception("查询用户权限信息失败", 1);
        }
        if ($user['UserGroup']['alias'] == 'admin' || $user['UserGroup']['alias'] == $alias) {
            return ;
        }
        $controller = $this->_Collection->getController();
        $controller->loadModel('UserGroup');
        $group = $controller->UserGroup->findByAlias($alias);
        if (!$group) {
            return ;
        }
        $controller->loadModel('User');
        $controller->User->id = $user['User']['id'];
        $rs = $controller->User->saveField('user_group_id', $group['UserGroup']['id']);
        if ($rs) {
            $this->flashUser($user['User']['id']);
        }
        return true;
    }
}