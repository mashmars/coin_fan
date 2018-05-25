<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('finance_title');?></title>
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
					<h3 class="tc"><?php echo L('finance_title');?></h3>
					<div class="flex-box user-head">
						<img src="<?php echo (PUB_IMG); ?>ht.png" alt="">
						<div class="flex-1">
							<h4><?php echo L('hello');?>，<?php echo ($userinfo['realname'] ? $userinfo['realname'] : 'MC'); ?>！</h4>
							<p><?php echo (session('phone')); ?></p>
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
						<a href="<?php echo U('finance/wallet');?>">
							<i class="assets"></i><?php echo L('submenu_1');?>
							<span class="go"></span>
						</a>
					</li>
					</ul>
					<ul>
					<li>
						<a href="<?php echo U('finance/myzrdetail');?>">
							<i class="charge-record"></i><?php echo L('submenu_2');?>
							<span class="go"></span>
						</a>
					</li>
					<li>
						<a href="<?php echo U('finance/myzcdetail');?>">
							<i class="currency record"></i><?php echo L('submenu_3');?>
							<span class="go"></span>
						</a>
					</li>
				</ul>
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
		<li class="active">
			<a href="<?php echo U('finance/index');?>">
				<i class="wallet"></i>
				<span><?php echo L('menu_qb');?></span>
			</a>
		</li>
		<li >
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
</html>