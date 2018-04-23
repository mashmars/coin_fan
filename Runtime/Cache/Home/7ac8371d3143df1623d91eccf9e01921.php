<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>个人中心</title>
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
					<h3 class="tc">我的</h3>
					<div class="flex-box user-head">
						<img src="<?php echo (PUB_IMG); ?>ht.png" alt="">
						<div class="flex-1">
							<h4>你好，<?php echo ($userinfo['realname'] ? $userinfo['realname'] : 'MC'); ?>！</h4>
							<p><?php echo (session('phone')); ?></p>
						</div>
					</div>
					<div class="tc flex-box user-total">
						<div class="flex-1">
							<p>挖矿收益</p>
							<h4><?php echo ($shouyi); ?></h4>
						</div>
						<div class="flex-1">
							<p>参考市值</p>
							<h4><?php echo ($usercoin['lth']); ?></h4>
						</div>
						<div class="flex-1">
							<p>矿池币数</p>
							<h4><?php echo ($usercoin['lth']); ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="user-contain">
				<ul>
					<li>
						<a href="<?php echo U('user/profile');?>">
							<i class="modify"></i>修改资料
							<span class="go"></span>
						</a>
					</li>
					<li>
						<a href="<?php echo U('user/password');?>">
							<i class="pwsmanage"></i>密码管理
							<span class="go"></span>
						</a>
					</li>
					<li>
						<a href="<?php echo U('user/phone');?>">
							<i class="binding"></i>手机绑定
							<span class="go"></span>
						</a>
					</li>
				</ul>
			</div>
			<p class="tc"><button class="lhbg exit-logon">退出登录</button></p>
		</div>
		<footer>
	<ul class="tc ovh">
		<li>
			<a href="<?php echo U('finance/myzr');?>">
				<i class="charge"></i>
				<span>充币</span>
			</a>
		</li>
		<li>
			<a href="<?php echo U('finance/myzc');?>">
				<i class="carry"></i>
				<span>提币</span>
			</a>
		</li>
		<li>
			<a href="<?php echo U('finance/index');?>">
				<i class="wallet"></i>
				<span>钱包</span>
			</a>
		</li>
		<li class="active">
			<a href="<?php echo U('user/index');?>">
				<i class="use"></i>
				<span>我的</span>
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
	</script>
</html>