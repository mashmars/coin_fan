<?php if (!defined('THINK_PATH')) exit();?>﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>html5shiv.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_STATIC); ?>h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_STATIC); ?>h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_LIB); ?>Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_STATIC); ?>h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_STATIC); ?>h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>基本设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	系统管理
	<span class="c-gray en">&gt;</span>
	基本设置
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add" action='' method='post' enctype='multipart/form-data'>
		<div id="tab-system" class="HuiTab">
			<div class="tabBar cl">
				<span>基本设置</span>
				
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>当前市值价格:</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" id="price" placeholder="" value="<?php echo ($info["price"]); ?>"name='price' class="input-text">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>转出手续费:</label>
					<div class="formControls col-xs-8 col-sm-2">
						<input type="text" id="zc_fee" placeholder="转化成0.格式" value="<?php echo ($info["zc_fee"]); ?>"name='zc_fee' class="input-text">
					</div>
					<label class="form-label col-xs-4 col-sm-2" style='text-align:left;color:red'>5%转换成0.05小数点格式</label>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>转账手续费:</label>
					<div class="formControls col-xs-8 col-sm-2">
						<input type="text" id="zz_fee" placeholder="转化成0.格式" value="<?php echo ($info["zz_fee"]); ?>"name='zz_fee' class="input-text">
					</div>
					<label class="form-label col-xs-4 col-sm-2" style='text-align:left;color:red'>5%转换成0.05小数点格式</label>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>锁仓比例:</label>
					<div class="formControls col-xs-8 col-sm-2">
						<input type="text" id="tb_bl" placeholder="转化成0.格式" value="<?php echo ($info["tb_bl"]); ?>"name='tb_bl' class="input-text">
					</div>
					<label class="form-label col-xs-4 col-sm-3" style='text-align:left;color:red'>5%转换成0.05小数点格式,每次不超过数量*比例（个人比例大于0优先）</label>
				</div>
				
			
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>layer/2.4/layer.js"></script>
<script type="text/javascript" src="<?php echo (PUB_STATIC); ?>h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="<?php echo (PUB_STATIC); ?>h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>uploadPreview.min.js"></script> 
<script type="text/javascript">
 window.onload = function () { 
      new uploadPreview({ UpBtn: "up_img", DivShow: "updata_img", ImgShow: "imgShow" });	 
	  new uploadPreview({ UpBtn: "up_img1", DivShow: "updata_img", ImgShow: "imgShow1" });
  }
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>