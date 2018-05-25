<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('menu_cb');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
    <style>
      .qrcode img{display:block;margin:0 auto;width:200px;}
    </style>
	</head>
	<body>
		<div class="main chargingMoney">
			<div class="user-info">
				<img src="<?php echo (PUB_IMG); ?>usbg.png" alt=""class="usbg">
				<div class="user-txt">
					<h3 class="tc"><?php echo L('menu_cb');?></h3>
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
			<div class="charging-item">
				<h3><i class="mon"></i><?php echo L('wallet_address');?></h3>
				<h4 class="ovh">
					<span class="fl copybox"><?php echo ($qianbao); ?></span>
					<span class="fr copy" data-clipboard-action="copy" data-clipboard-target=".copybox"><?php echo L('copy');?></span>
				</h4>
			</div>
			<div class="charging-item">
				<h3><i class="qr"></i><?php echo L('wallet_qrcode');?></h3>
				<p class="qrcode" id="qrcode"></p>
			</div>
			<div class="charging-item">
				<h3><i class="notice"></i><?php echo L('notice');?></h3>
				<p class="notice-txt">1.<?php echo L('notice_1');?></p>
				<p class="notice-txt">2.<?php echo L('notice_2');?></p>
			</div>
		</div>
		<footer>
	<ul class="tc ovh">
		<li class="active">
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
	<script src="<?php echo (PUB_LIB); ?>qrcode.min.js"></script>
	<script src="<?php echo (PUB_JS); ?>clipboard.min.js"></script>
	<script>
		function showmsg(msg) {
		var c = $(".showmsg").attr("class");
		if (c == 'showmsg') {
		$(".showmsg").fadeIn(100);
		$(".showmsg>span").text(msg);
		} else {
		var htm = '<div class="showmsg"><span>' + msg + '</span></div>';
		$("body").append(htm);
		$(".showmsg").fadeIn(100);
		}
		setTimeout(function() {
			$(".showmsg").fadeOut(100);
			}, 1500);
		}
		window.onload =function(){
			var clipboard = new ClipboardJS('.copy');
			clipboard.on('success', function(e) {
				showmsg("<?php echo L('copyed');?>");
			});
			clipboard.on('error', function(e) {
				showmsg("<?php echo L('copy_error');?>")
			});
		}
	</script>
	<script>
	$(function(){
		new QRCode(document.getElementById('qrcode'), "<?php echo ($qianbao); ?>");
	})
	</script>
</html>