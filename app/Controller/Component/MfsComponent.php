<?

class MfsComponent extends Component {

    const US_UP_AUTHORIZATION = "upload:cd124";
    const UPLOAD_URL = 'http://cn-mfs.63810.com/upload/';
    const DOWNLOAD_URL = 'http://cn-mfs.63810.com/download/';
    const OssBaseURL = 'http://oss.63810.com/';
    const OssDownloadUrl = 'http://oss.63810.com/mogilefs/';
    const UseOss = 1;
    const UseLocalFile = 1;  //是否直接使用刚上传的这个文件，不用再put一次，因为已经在本机了。
    const LocalOssBaseURL = 'http://127.0.0.1:1189/';

    function download($key) {
        if (!$key || strlen($key) < 20)
            return;
        if (self::UseOss) {
            return self::OssDownloadUrl . '' . $key;
        } else {
            return self::DOWNLOAD_URL . '' . $key;
        }
    }

    function upload($key, $file) {
        if (!$key || !$file || strlen($key) < 20)
            return;
        if (!file_exists($file))
            return;

        if (self::UseOss) {
            return $this->_OssMethods('PUT', $key, $file);
        } else {
            return $this->_methods(self::UPLOAD_URL . '' . $key, 'PUT', $file);
        }
    }

    function delete($key) {
        if (!$key || strlen($key) < 20)
            return;

        if (self::UseOss) {
            return $this->_OssMethods('DELETE', $key);
        } else {
            return $this->_methods(self::UPLOAD_URL . '' . $key, 'DELETE');
        }
    }

    private function _OssMethods($action, $key, $files = false) {
        if (!$key || !$action)
            return;

        if ($action != 'DELETE' && $action != 'PUT')
            return;

        $options = array(
            'useragent' => "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; YINUOINFO API; Alexa Toolbar)",
            'connecttimeout' => 120,
            'timeout' => 120,
            'redirect' => 10,
        );

        if ($action == 'DELETE') {
            $r = new HttpRequest(self::OssBaseURL . 'delete.php?key=' . $key, HTTP_METH_GET);
            $r->setOptions($options);
            $r->addHeaders(array('Authorization' => 'Basic ' . base64_encode(self::US_UP_AUTHORIZATION)));
            try {
                $ret = $r->send()->getBody();
                if ($ret == 'success')
                    return 1;
            } catch (HttpException $e) {
                return 0;
            }
        }

        if ($action == 'PUT') {
            if (self::UseLocalFile && !APP_DEV){
                $r = new HttpRequest(self::LocalOssBaseURL . 'local_upload.php', HTTP_METH_POST);
                $r->setPostFields(array('key' => $key,'localfile' => $files));
            }else {
                $r = new HttpRequest(self::OssBaseURL . 'upload.php', HTTP_METH_POST);
                $r->setPostFields(array('key' => $key));
                $r->addPostFile('file', $files, 'image/jpeg');
            }
            $r->setOptions($options);
            $r->addHeaders(array('Authorization' => 'Basic ' . base64_encode(self::US_UP_AUTHORIZATION)));
            try {
                $ret = $r->send()->getBody();
                if (preg_match("/OK/i", $ret))
                    return 1;
            } catch (HttpException $e) {
                return 0;
            }
        }
        return 0;
    }

    private function _methods($host, $action, $files = false) {
        if (!$host || !$action)
            return;
        if ($action != 'DELETE' && $action != 'PUT')
            return;

        $query = '';
        if ($files)
            $query = file_get_contents($files);

        $hostarr = parse_url($host);
        $path = $hostarr['path'];
        $host = $hostarr['host'];

        @set_time_limit(360);

        $post = "$action $path HTTP/1.1\r\nHost: $host\r\nContent-type: application/x-www-form-urlencoded\r\nUser-Agent: Mozilla 4.0\r\nContent-length: " . strlen($query) . "\r\nAuthorization: Basic " . base64_encode(self::US_UP_AUTHORIZATION) . "\r\nConnection: close\r\n\r\n$query";
        $h = fsockopen($host, 80, $errno, $errstr, 360);
        fwrite($h, $post);
        for ($a = 0, $r = ''; !$a;) {
            $b = fread($h, 8192);
            $r.=$b;
            $a = (($b == '') ? 1 : 0);
        }
        fclose($h);
        if ($action == 'DELETE' && false !== strpos($r, 'HTTP/1.1 204')) {
            return 1;
        }

        if (!$r)
            return 1;
        return;
    }

}