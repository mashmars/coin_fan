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
	<input name='id' value='<?php echo ($info["id"]); ?>' type='hidden'/>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text"  placeholder="" id="username" value="<?php echo ($info["username"]); ?>" disabled>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机号:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text"  placeholder="" id="phone" value="<?php echo ($info["phone"]); ?>" disabled>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>登录密码:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text"  placeholder="留空不修改" id="password" name="password" value="">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>支付密码:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text"  placeholder="留空不修改" id="paypassword" name="paypassword" value="">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>姓名:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text"  placeholder="" id="realname" name="realname" value="<?php echo ($info["realname"]); ?>">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>提币状态:</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="finance_status" type="radio" id="finance_status-1" value='1' <?php if($info["finance_status"] == 1): ?>checked<?php endif; ?>>
				<label for="finance_status-1">可提币</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="finance_status-2" value='0' name="finance_status" <?php if($info["finance_status"] == 0): ?>checked<?php endif; ?>>
				<label for="finance_status-2">禁止提币</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>锁仓比例:</label>
		<div class="formControls col-xs-8 col-sm-2">
			<input type="text" id="tb_bl" placeholder="转化成0.格式" value="<?php echo ($info["tb_bl"]); ?>"name='tb_bl' class="input-text">
		</div>
		<label class="form-label col-xs-4 col-sm-6" style='text-align:left;color:red'>5%转换成0.05小数点格式,每次不超过数量*比例（个人比例大于0优先，为0是走锁仓比例）</label>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">创建日期:</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" onfocus="WdatePicker({ dateFmt:'yyyy-MM-dd HH:mm:ss'})" name='createdate' id="datemax" placeholder="为空为当前时间" class="input-text Wdate" style="width:180px;" value="<?php echo (date('Y-m-d H:i:s',$info["createdate"])); ?>">
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
		var realname = $('#realname').val();
		
		
		if(realname == ''){
			layer.msg('请输入姓名!',{time:2000,icon:5});
			return false;
		}
		//$('#form').submit();
		$.ajax({
			url:"<?php echo U('user/ajax_member_edit');?>", 
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