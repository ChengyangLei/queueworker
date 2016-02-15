<?php
/**
 * @author 追逐__something
 * @version $id
 */
define('SCRIPT_ROOT',dirname(__FILE__).'/');
$act = @trim($_REQUEST['act']);
switch($act)
{
    case 'login':
        // 获取验证码
        $code = trim($_REQUEST['code']);
        
        // $loginParams为curl模拟登录时post的参数
        $loginParams['UserName'] = 'huaerzb';
        $loginParams['PassWord'] = 'qwe111';
        $loginParams['VerifyCode'] = $code;
        $loginParams['backurl'] = "http://user.nipic.com";

        // $cookieFile 为加载验证码时保存的cookie文件名 
        $cookieFile = SCRIPT_ROOT.'cookie.tmp';
        
        // $targetUrl curl 提交的目标地址
        $targetUrl = 'http://login.nipic.com';
        
        // 参数重置
        $content = curlLogin($targetUrl, $cookieFile, $loginParams);
        echo $content;
    break;
    case 'authcode':
        // Content-Type 验证码的图片类型
        header('Content-Type:image/png');
        showAuthcode('http://login.nipic.com/account/verifycode?r=0.03192671708666017');
        exit;
    break;
}

/**
 * 模拟登录
 * @param string $url 提交到的地址
 * @param string $cookieFile 保存cookie的文件
 * @param string $loginParams 提交时要post的参数
 * @return string $content 返回的内容
 */
function curlLogin($url, $cookieFile, $loginParams)
{
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_COOKIEFILE, $cookieFile); //同时发送Cookie
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $loginParams); //提交查询信息
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);  //是否抓取跳转后的页面
    $content = curl_exec($ch);
    curl_close($ch);
    return $content;
}

/**
 * 加载目标网站图片验证码
 * @param string $authcode_url 目标网站验证码地址
 */
function showAuthcode( $authcode_url )
{
    $cookieFile = SCRIPT_ROOT.'cookie.tmp';
    $ch = curl_init($authcode_url);
    curl_setopt($ch,CURLOPT_COOKIEJAR, $cookieFile); // 把返回来的cookie信息保存在文件中
    curl_exec($ch);
    curl_close($ch);
}
?>
<iframe src="?act=authcode" style='width: 160px; height:60px ' frameborder=0 ></iframe>
<form>
<input type="hidden" name="act" value="login">
<input type="text" name="code" />
<input type="submit" name="submit" >
</form>