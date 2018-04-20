<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>提币</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
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
							<h4>你好，孟晓明！</h4>
							<p>13723103200</p>
						</div>
					</div>
					<div class="tc flex-box user-total">
						<div class="flex-1">
							<p>挖矿收益</p>
							<h4>0.000000000</h4>
						</div>
						<div class="flex-1">
							<p>参考市值</p>
							<h4>￥0.00</h4>
						</div>
						<div class="flex-1">
							<p>矿池币数</p>
							<h4>0.000000000</p>
						</div>
					</div>
				</div>
			</div>
			<div class="charging-item">
				<h3><i class="num"></i>提币数量</h3>
				<div class="charging-inpu">
					<input type="text"placeholder="请输入提币数量">
				</div>
			</div>
			<div class="charging-item">
				<h3><i class="adr"></i>钱包地址</h3>
				<div class="rel charging-inpu selection">
					<input type="text"placeholder="请输入钱包地址"onfocus="this.blur()">
					<i></i>
					<ul class="tc">
						<li id="1">123</li>
						<li id="2">456</li>
						<li id="3">789</li>
					</ul>
				</div>
			</div>
			<div class="charging-item">
				<h3><i class="pwd"></i>交易密码</h3>
				<div class="charging-inpu">
					<input type="text"placeholder="请输入交易密码">
				</div>
			</div>
			<div class="charging-item">
				<h3><i class="cod"></i>短信验证码</h3>
				<div class="rel charging-inpu">
					<input type="text"placeholder="请输入短信验证码">
					<span id="code">获取验证码</span>
				</div>
			</div>
			<p class="tc">
				<button class="lhbg mod-btn">提币</button>
			</p>
		</div>
		<footer>
	<ul class="tc ovh">
		<li>
			<a href="">
				<i class="charge"></i>
				<span>充币</span>
			</a>
		</li>
		<li>
			<a href="">
				<i class="carry"></i>
				<span>提币</span>
			</a>
		</li>
		<li>
			<a href="">
				<i class="wallet"></i>
				<span>钱包</span>
			</a>
		</li>
		<li class="active">
			<a href="">
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
	<script>

		var wait=60;//60s验证码
		function time(o) {
			if (wait == 0) {
				o.removeClass("disabled");   
				o.text("获取验证码");
				wait = 60;
				} else {
					o.addClass("disabled");
					o.text("重新发送(" + wait + "s)");
					wait--;
					setTimeout(function() {
						time(o)
					},
					1000)
			}
		}
		$(document).ready(function(){
			$('.selection i').removeClass('active');
			$('.selection ul').hide();
			$('.selection input').click(function () {
				$(this).siblings('ul').toggle();
				$(this).siblings('i').toggleClass("active");
			})
			$('.selection ul li').click(function () {
				$(this).parent().hide();
				$(this).addClass('hv').siblings().removeClass('hv');
				$(this).parent().siblings('input').val($(this).text());
				$(this).parent().siblings('input').attr('id',$(this).attr('id'));
				$(this).parent().siblings('i').removeClass('active');
			})

			$('#code').click(function(){ //发送验证码
				time($('#code'));
			});
		});
</script>
</html>