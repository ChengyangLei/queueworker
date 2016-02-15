<?php

class AppExceptionHandler extends ErrorHandler {

    public static function handleException(Exception $exception) {
        //MissingControllerException 方法的一般都是无效的访问，丢出去
        if ($exception instanceof MissingControllerException || $exception instanceof MissingActionException || $exception instanceof MissingViewException) {
            header("HTTP/1.0 404 Not Found");
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /><title>404 Not Found</title></head><body><div align=\"center\"><a href=\"/\"><img src=\"/img/button/404.gif\" border=\"0\" /></a></div></body></html>";
            exit;
        }
        
        $config = Configure::read('Exception');
        if (@$config['log']) {
            $slow_log = "";
            $slow_log.="\nHTTP_HOST  http://" . @(@$_SERVER['HTTP_X_REAL_HOST'] ? @$_SERVER['HTTP_X_REAL_HOST'] : $_SERVER['HTTP_HOST']) . @$_SERVER["REQUEST_URI"];
            $slow_log.="\nHTTP_REFERER= " . @$_SERVER["HTTP_REFERER"];
            $slow_log.="\nHTTP_USER_AGENT= " . @$_SERVER["HTTP_USER_AGENT"];
            $slow_log.="\nSCRIPT_FILENAME= " . @$_SERVER["SCRIPT_FILENAME"];
            $slow_log.=var_export(@$_POST, true);
            $slow_log.=var_export(@$_GET, true);
            CakeLog::write(LOG_ERR, $slow_log);
        }

        parent::handleException($exception);
    }

}

?>