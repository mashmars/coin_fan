<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>充币</title>
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
							<h4><?php echo ($shouyi*1); ?></h4>
						</div>
						<div class="flex-1">
							<p>参考市值</p>
							<h4><?php echo ($usercoin['lth']*$config['price']); ?></h4>
						</div>
						<div class="flex-1">
							<p>MC币数</p>
							<h4><?php echo ($usercoin['lth']*1); ?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="charging-item">
				<h3><i class="mon"></i>钱包地址</h3>
				<h4 class="ovh">
					<span class="fl copybox"><?php echo ($qianbao); ?></span>
					<span class="fr copy" data-clipboard-action="copy" data-clipboard-target=".copybox">复制</span>
				</h4>
			</div>
			<div class="charging-item">
				<h3><i class="qr"></i>钱包二维码</h3>
				<p class="qrcode" id="qrcode"></p>
			</div>
			<div class="charging-item">
				<h3><i class="notice"></i>充币须知</h3>
				<p class="notice-txt">1.充币需要经过自动网络安全确认才能到账</p>
				<p class="notice-txt">2.因为网络访问量大、确认时间长，充币通常需要30分钟左右才能到账</p>
			</div>
		</div>
		<footer>
	<ul class="tc ovh">
		<li class="active">
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
		<li >
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
				showmsg('钱包地址已复制到粘贴板！');
			});
			clipboard.on('error', function(e) {
				showmsg('钱包地址复制失败请重新复制！')
			});
		}
	</script>
	<script>
	$(function(){
		new QRCode(document.getElementById('qrcode'), "<?php echo ($qianbao); ?>");
	})
	</script>
</html>