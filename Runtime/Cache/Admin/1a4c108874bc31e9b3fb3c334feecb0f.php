<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>html5.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>respond.min.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>PIE_IE678.js"></script>
<![endif]-->
<link href="<?php echo (PUB_STATIC); ?>h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (PUB_STATIC); ?>h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (PUB_STATIC); ?>h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo (PUB_LIB); ?>Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台管理系统</title>
<meta name="keywords" content="后台管理系统">
<meta name="description" content="后台管理系统">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="" method="post">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="username" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="pwd" name="pwd" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <!-- <div class="row cl"> -->
        <!-- <div class="formControls col-xs-8 col-xs-offset-3"> -->
          <!-- <input class="input-text size-L" type="text" placeholder="验证码" name='captcha' id='captcha' onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="" style="width:150px;"> -->
          <!-- <img src="/yaxing888.php/login/captcha" onclick="this.src='/yaxing888.php/login/captcha/'+Math.random()"> <a id="kanbuq" href="javascript:;">看不清,点击图片更换</a> </div> -->
      <!-- </div> -->
      
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" id='submit' class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright  <a href='' target='_blank'></a></div>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo (PUB_STATIC); ?>h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>layer/2.1/layer.js"></script> 
<script>
$(function(){
	$('#submit').click(function(){
		var user = $('#username').val();
		var pwd =  $('#pwd').val();
		var captcha = $('#captcha').val();
		if(user == ''){
			layer.alert('登录用户名不能为空！');
			return false;
		}
		if(pwd == ''){
			layer.alert('登录密码不能为空！');
			return false;
		}
		if(captcha == ''){
			layer.alert('登录验证码不能为空！');
			return false;
		}
	})
})
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>