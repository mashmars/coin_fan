<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<meta http-equiv="Cache-Control" content="no-siteapp"/>
<link rel="Bookmark" href="/favicon.ico">
<link rel="Shortcut Icon" href="/favicon.ico"/>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>html5shiv.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_STATIC); ?>h-ui/css/H-ui.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_STATIC); ?>h-ui.admin/css/H-ui.admin.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_LIB); ?>Hui-iconfont/1.0.8/iconfont.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_STATIC); ?>h-ui.admin/skin/default/skin.css" id="skin"/>
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_STATIC); ?>h-ui.admin/css/style.css"/>
<!--单选按钮样式-->
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>DD_belatedPNG_0.0.8a-min.js"></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->
</head>
<body>
<article class="page-container">
<form class="form form-horizontal" method="post" action="" id='form' enctype="multipart/form-data">
	<input type="hidden" class="input-text" value="<?php echo ($info["id"]); ?>" placeholder="" id="id" name="id">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>数量下限:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="<?php echo ($info["minnum"]); ?>" placeholder="" id="minnum" name="minnum">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>数量上限:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="<?php echo ($info["maxnum"]); ?>" placeholder="" id="maxnum" name="maxnum">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>比例:</label>
		<div class="formControls col-xs-8 col-sm-3">
			<input type="text" class="input-text" value="<?php echo ($info["bl"]); ?>" placeholder="" id="bl" name="bl">
		</div>
		<label class="form-label col-xs-4 col-sm-6" style="text-align:left">0.13%需要直接输入0.0013</label>
	</div>
	
	
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>状态:</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="status" type="radio" id="sex-1" value='1' <?php if($info["status"] == 1): ?>checked<?php endif; ?>>
				<label for="sex-1">可用</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" value='0' name="status" <?php if($info["status"] == 0): ?>checked<?php endif; ?>>
				<label for="sex-2">禁用</label>
			</div>
		</div>
	</div>
	
	
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" id='submit' type="button" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
</form>
</article>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>layer/2.4/layer.js"></script>
<script type="text/javascript" src="<?php echo (PUB_STATIC); ?>h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="<?php echo (PUB_STATIC); ?>h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>My97DatePicker/4.8/WdatePicker.js"></script> 

<!---单选按钮js--->
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$('#submit').click(function(){ //var index = parent.layer.getFrameIndex(window.name); //parent.layer.close(index);return false;
									//window.parent.location.reload();//刷新父级的时候会自动关闭弹层	
		var minnum = $('#minnum').val();
		var maxnum = $('#maxnum').val();
		var bl = $('#bl').val();
		if(minnum == '' || isNaN(minnum) || minnum <=0){
			layer.msg('数量下限设置不正确!',{time:2000,icon:5});
			return false;
		}
		if(maxnum == '' || isNaN(maxnum) || maxnum <=0){
			layer.msg('数量上限设置不正确!',{time:2000,icon:5});
			return false;
		}
		if(parseInt(maxnum) <= parseInt(minnum)){
			layer.msg('数量上限必须大于下限!',{time:2000,icon:5});
			return false;
		}
		if(bl == '' || isNaN(bl) || bl <=0){
			layer.msg('比例设置不正确!',{time:2000,icon:5});
			return false;
		}
		//$('#form').submit();
		$.ajax({
			url:"<?php echo U('system/ajax_sys_jtfh_edit');?>", 
			data:$('#form').serialize(),
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.info =='success'){
					layer.msg(data.msg,{time:2000,icon: 1}, function(){
						parent.window.location.reload();//刷新
					});
				}else{
					layer.msg(data.msg,{time:2000,icon:2});
				}
			},
		})
	})
	
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>