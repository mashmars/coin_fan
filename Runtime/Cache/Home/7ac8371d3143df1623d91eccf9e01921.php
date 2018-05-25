<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('user_title');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<div class="main user">
			<div class="user-info">
				<img src="<?php echo (PUB_IMG); ?>usbg.png" alt=""class="usbg">
				<div class="user-txt">
					<h3 class="tc rel"><?php echo L('user_title');?>
					<span class="switch-btn">简体中文<i></i></span>
					<input type="text"class="dn switch-con">
					<ul class="switchBox">
						<li id="1"><a href="?l=zh-cn">简体中文</a></li>
						<li id="3"><a href="?l=zh-tw">繁体中文</a></li>
						<li id="2"><a href="?l=en-us">English</a></li>
					</ul>
					
					</h3>
					<div class="flex-box user-head">
						<img src="<?php echo (PUB_IMG); ?>ht.png" alt="">
						<div class="flex-1">
							<h4><?php echo L('hello');?>，<?php echo ($userinfo['realname'] ? $userinfo['realname'] : 'MC'); ?>！</h4>
							<p><?php echo (session('phone')); ?></p>
						</div>
						<div class="flex-1">
							<p><?php echo L('yeji_A');?>:<?php echo ($yeji['yiqu']*1); ?></p>
							<p><?php echo L('yeji_B');?>:<?php echo ($yeji['erqu']*1); ?></p>
						</div>
					</div>
					<div class="tc flex-box user-total">
						<div class="flex-1">
							<p><?php echo L('income');?></p>
							<h4><?php echo ($shouyi*1); ?></h4>
						</div>
						<div class="flex-1">
							<p><?php echo L('shizhi');?></p>
							<h4><?php echo ($usercoin['lth']*$config['price']); ?></h4>
						</div>
						<div class="flex-1">
							<p>MC<?php echo L('coin');?></p>
							<h4><?php echo ($usercoin['lth']*1); ?></p>
						</div>
					</div>
				</div>
				
			</div>
			<div class="user-contain">
				<ul>
					<li>
						<a href="<?php echo U('user/profile');?>">
							<i class="modify"></i><?php echo L('profile');?>
							<span class="go"></span>
						</a>
					</li>
					<li>
						<a href="<?php echo U('user/password');?>">
							<i class="pwsmanage"></i><?php echo L('password_manage');?>
							<span class="go"></span>
						</a>
					</li>
					<li>
						<a href="<?php echo U('user/phone');?>">
							<i class="binding"></i><?php echo L('phone_bind');?>
							<span class="go"></span>
						</a>
					</li>
					
				</ul>
			</div>
			<p class="tc"><button class="lhbg exit-logon"><?php echo L('logout');?></button></p>
			<div id='gonggao' style='display:none'>
				<h4><?php echo ($gonggao["title"]); ?></h4>
				<div><?php echo (html_entity_decode($gonggao["content"])); ?></div>
			</div>
		</div>
		<footer>
	<ul class="tc ovh">
		<li>
			<a href="<?php echo U('finance/myzr');?>">
				<i class="charge"></i>
				<span><?php echo L('menu_cb');?></span>
			</a>
		</li>
		<li>
			<a href="<?php echo U('finance/myzc');?>">
				<i class="carry"></i>
				<span><?php echo L('menu_tb');?></span>
			</a>
		</li>
		<li>
			<a href="<?php echo U('finance/index');?>">
				<i class="wallet"></i>
				<span><?php echo L('menu_qb');?></span>
			</a>
		</li>
		<li class="active">
			<a href="<?php echo U('user/index');?>">
				<i class="use"></i>
				<span><?php echo L('menu_wd');?></span>
			</a>
		</li>
	</ul>
</footer>

	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
	$(function(){
		$('.exit-logon').click(function(){
			$.post("<?php echo U('user/ajax_logout');?>",'',function(data){
				if(data.info == 'success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.href = '/';
					})
				}else{
					layer.msg(data.msg,{time:2000,icon:5})
				}
			},'json')
		})
	})
	
	var flag='<?php echo ($flag); ?>';
	if(flag){
		layer.open({
		  type: 1,
		  shade: false,
		  title: false,
		area: ['280px', '60%'],		  
		content: $('#gonggao'), 
		  cancel: function(){
			
		  }
		});
	}
	
	$('.switchBox').hide();
	$('.switch-btn').click(function(){
		$('.switchBox').toggle();
		$(this).children('i').toggleClass("active");
	});
	var lang = "<?php echo (cookie('think_language')); ?>";
	if(lang == 'zh-tw'){
		var text = '繁体中文';
	}else if (lang == 'en-us'){
		var text = 'English';
	}else{
		var text = '简体中文';
	}
	$('.switch-btn').html(text+'<i></i>');
	</script>
</html>