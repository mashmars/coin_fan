<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>资产管理</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		资产管理
	</h3>
</header>
		<div class="main assetManagement">
			<div class="lhbg tc asset-info">
				<p>昨日收益</p>
				<h3><?php echo ($yestoday_shouyi*1); ?></h3>
				<h4>狂池币数：<?php echo ($usercoin['lth']*1); ?></h4>
				<div class="flex-box asset-total">
					<div class="flex-1">
						<p><?php echo ($month_shouyi*1); ?></p>
						<p>本月收益</p>
					</div>
					<div class="flex-1">
						<p><?php echo ($shouyi*1); ?></p>
						<p>累计收益</p>
					</div>
				</div>
			</div>
			<ul class="asset-item">
				<li>
					<a href="<?php echo U('finance/myzr');?>">
						<i class="enter"></i>转入
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/myzc');?>">
						<i class="out"></i>转出
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/transfer');?>">
						<i class="out"></i>账户转账
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/transferlog');?>">
						<i class="record"></i>转账记录
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/income');?>">
						<i class="record"></i>收益记录
						<span class="go"></span>
					</a>
				</li>
			</ul>
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
</html>