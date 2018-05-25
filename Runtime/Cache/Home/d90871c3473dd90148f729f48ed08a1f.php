<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('money_manage');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		<?php echo L('money_manage');?>
	</h3>
</header>
		<div class="main assetManagement">
			<div class="lhbg tc asset-info">
				<p><?php echo L('yestoday_income');?></p>
				<h3><?php echo ($yestoday_shouyi*1); ?></h3>
				<h4>MC<?php echo L('coin');?>：<?php echo ($usercoin['lth']*1); ?></h4>
				<div class="flex-box asset-total">
					<div class="flex-1">
						<p><?php echo ($month_shouyi*1); ?></p>
						<p><?php echo L('month_income');?></p>
					</div>
					<div class="flex-1">
						<p><?php echo ($shouyi*1); ?></p>
						<p><?php echo L('total_income');?></p>
					</div>
				</div>
			</div>
			<ul class="asset-item">
				<li>
					<a href="<?php echo U('finance/address');?>">
						<i class="purse"></i><?php echo L('wallet_manage');?>
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/myzr');?>">
						<i class="enter"></i><?php echo L('menu_cb');?>
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/myzc');?>">
						<i class="out"></i><?php echo L('menu_tb');?>
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/transfer');?>">
						<i class="out"></i><?php echo L('transfer');?>
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/transferlog');?>">
						<i class="record"></i><?php echo L('transfer_log');?>
						<span class="go"></span>
					</a>
				</li>
				<li>
					<a href="<?php echo U('finance/income');?>">
						<i class="record"></i><?php echo L('income_log');?>
						<span class="go"></span>
					</a>
				</li>
			</ul>
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></