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
    
    function login($data) {
        $this->Session->write(self::sesskey, $data);
    }
    
    function logout() {
        $this->Session->delete(self::sesskey);
        $this->Session->destroy();
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
}