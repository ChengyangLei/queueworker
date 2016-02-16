<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>queueworker-批量任务处理平台</title>
        <!-- Bootstrap Core CSS -->
        <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            body{
                font-family:"microsoft yahei", simhei, arial, sans-serif;
                font-weight:lighter;
            }
            /* @group Header */
            .header {
              background-color: #3893c6;
              background-repeat: repeat-x;
              background-image: -webkit-linear-gradient(320deg, #27678a, #3893c6);
              background-image: -o-linear-gradient(320deg, #27678a, #3893c6);
              background-image: linear-gradient(320deg, #27678a, #3893c6);
            }
            @media (min-width: 768px) {
              .header {
                min-height: 100%;
              }
            }
            .header .jumbotron {
              background-color: transparent;
              color: #ffffff;
              text-align: center;
              margin-top:40px;
              padding:0px;
            }
            .header .jumbotron .logo {
              width: 100%;
              margin: 20px auto;
            }
            .header .jumbotron h2 {
              font-family: 'Open Sans', sans-serif;
              margin: 30px auto 20px;
                font-weight:lighter;
            }
            .header .jumbotron .btn-group {
              margin: 5px 0 10px;
            }
            .header .jumbotron .btn-group .btn {
              margin: 0;
              display: block;
              padding:0 10px;
              width: 100%;
            }
            .header .login-btns a{
                color:#fff;
                margin:0 10px;
            }
            @media (min-width: 768px) {
              .header .jumbotron .btn-group .btn {
                display: inline-block;
                width: auto;
                margin: 10px 0;
              }
            }
            .header .jumbotron .latest-version {
              font-family: 'Open Sans', sans-serif;
              font-weight: 300;
              color: #eaeae8;
              text-align: left;
              font-size: 0.9em;
              margin: 0 0 20px;
              position: relative;
              top: 15px;
            }
            @media (min-width: 992px) {
              .header .jumbotron .latest-version {
                position: static;
                margin: 0;
              }
            }
            .header .jumbotron .latest-version .version,
            .header .jumbotron .latest-version .date {
              padding-left: 0;
              padding-right: 0;
            }
            @media (min-width: 992px) {
              .header .jumbotron .latest-version .date {
                text-align: right;
              }
            }
            .header .jumbotron .screenshot {
              margin: 20px auto;
            }
            .header .btn-success{
                min-width:140px;
                margin-top:20px;
            }
            /* @end Header */
            /* @group Homepage */
            .section {
              padding: 50px 15px;
            }
            .section .lead{
                font-weight:lighter;
                font-size:14px;
                line-height:30px;
            }
            .section li{
                line-height:30px;
            }
            .section.alt {
              background-color: #3893c6;
              color: #ffffff;
            }
            .section h3 {
              margin: 40px 0 30px;
              font-weight:lighter;
            }
            .section .screenshot {
              margin: 30px auto;
            }
            /* @end Homepage */
            /* @group Footer */
            .footer {
              font-family: 'Open Sans', sans-serif;
              font-weight: 300;
              background-color: #111;
              color: #ffffff;
              padding: 20px 0;
            }
            .footer a {
              color: #e6e6e6;
            }

        </style>
    </head>
    <body>
<div class="container-fluid header">
  <div class="jumbotron container">
    <div class="row">
      <div class="col-md-8">
        <h1 class="text-left">QueueWorker</h1>
        <h2 class="text-left">一个在云端帮助您完成脚本任务的平台</h2>
      </div>
      <div class="col-md-4 login-btns">
        <a href="/Users/login">登录</a>|
        <a href="Users/register">注册</a>
      </div>

    </div>
    <div class="row">
        <div class="col-md-12 text-center">
          <a class="btn btn-lg btn-success" href="/Users/home">立即体验</a>
          <!-- <p>联系QQ: <span>120377843</span></p> -->
        </div>
    </div>
  </div>
</div>

<div class="container section" id="section1">
  <div class="row">
    <div class="col-md-7">
      <h3>我们做什么？</h3>
      <p class="lead">有这样一个场景，我们需要对一件事情重复处理，比如检查一批域名是否注册，以前我们会手动操作。高级一点我们可以编写一个简单的脚本完成，编写脚本需要寻找程序员，然后在自己电脑运行。现在，我们就是您要找的人，我们可以处理各种任务，然后在我们系统上运行，我们有更强大的运算服务器，只需稍等片刻您就可以得到你要的结果。</p>
    </div>
    <div class="col-md-4 col-md-offset-1"><img class="img-responsive screenshot" src="static/images/screenshot.png" alt="QueueWorker" style="display: block;"></div>
  </div>
</div>

  <div class="container section">
      <div class="row">
        <div class="col-md-4"><img class="img-responsive screenshot" src="static/images/preferences.png" alt="queueworker" style="display: block;"></div>
        <div class="col-md-7 col-md-offset-1">
            <h3>带来什么?</h3>
          <p class="lead">
            我们可以完成您寻找程序员编写脚本程序的大部分任务，同时不占用您自己电脑资源，不用自己租用服务器挂机，可以节省费用。
            <ul>
                <li>大量的应用</li>
                <li>容易使用的操作方式</li>
                <li>数据长期保存不丢失</li>
                <li>不用守护电脑运行</li>
                <li>不占用自己电脑资源</li>
            </ul>
          </p>
        </div>
      </div>
  </div>

<div class="container-fluid footer">
      <div class="container">
        <div class="col-sm-10">
          Copyright <a href="http://queueworker.com/" target="_blank">QueueWorker</a> © 2016.
          <span class="pull-right">联系QQ 120377843</span>
        </div>
        <div class="hidden-xs col-sm-2 text-right">
          <a href="#" class="scroll-to-top"><i class="fa fa-chevron-up"></i></a>
        </div>
      </div>
    </div>

        <!-- jQuery -->
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>