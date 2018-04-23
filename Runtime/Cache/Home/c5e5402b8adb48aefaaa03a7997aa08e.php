<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>提币记录</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	<link rel="stylesheet" type="text/css" href="<?php echo (PUB_CSS); ?>mobileSelect.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		收益记录
	</h3>
</header>
		<div class="main chargeRecord">
			<div class="flex-box record-hd">
				<div class="flex-1">					
					<!--<p><span>提币：0.00</span></p>-->
				</div>
				
			</div>
			<div class="record-bd">
				<ul>
					<li class="flex-box">
						<div class="flex-1 flex-box">
							<img src="<?php echo (PUB_IMG); ?>ht.png" alt="">
							<div class="flex-1">
								<h4>提币</h4>
								<p><span>4月3日</span><span>14:16</span></p>
							</div>
						</div>
						<span>+100.00</span>
					</li>
					<li class="flex-box">
						<div class="flex-1 flex-box">
							<img src="<?php echo (PUB_IMG); ?>ht.png" alt="">
							<div class="flex-1">
								<h4>提币</h4>
								<p><span>4月3日</span><span>14:16</span></p>
							</div>
						</div>
						<span>+100.00</span>
					</li>
				</ul>
				<p class="no-list tc">暂无收益记录</p>
			</div>
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>mobileSelect.js" type="text/javascript"></script>
	<script type="text/javascript">
		var yearArr=['2010年','2011年','2012年','2013年','2014年','2015年','2016年','2017年','2018年'];
		var monthArr = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];
		var mobileSelect2 = new MobileSelect({
			trigger: '#date',
			title: '',
			wheels: [
				{data: yearArr},
				{data: monthArr}
			],
			position:[1, 2],
				transitionEnd:function(indexArr, data){
			},
			callback:function(indexArr, data){
			}
	});
	</script>
</html>