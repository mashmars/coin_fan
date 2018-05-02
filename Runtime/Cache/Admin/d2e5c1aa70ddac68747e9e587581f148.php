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

<title></title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<input type='hidden' name='id' value="<?php echo ($id); ?>" />
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo ($role["title"]); ?>" placeholder="" id="roleName" readonly>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站菜单：</label>
			<div class="formControls col-xs-8 col-sm-9">
			<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl class="permission-list">
					<!--一级菜单-->
					<dt>
						<label>
							<input type="checkbox" value="<?php echo ($vo["id"]); ?>"<?php if(in_array(($vo["id"]), is_array($role['rules'])?$role['rules']:explode(',',$role['rules']))): ?>checked<?php endif; ?> name="rules" id="user-Character-0">
							<?php echo ($vo["title"]); ?></label>
					</dt>
					
					<dd>
						<?php if(is_array($vo['erji'])): $i = 0; $__LIST__ = $vo['erji'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$erji): $mod = ($i % 2 );++$i;?><dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="<?php echo ($erji["id"]); ?>"<?php if(in_array(($erji["id"]), is_array($role['rules'])?$role['rules']:explode(',',$role['rules']))): ?>checked<?php endif; ?> name="rules" id="user-Character-0-0">
									<?php echo ($erji["title"]); ?></label>
							</dt>
							<dd>
								<?php if(is_array($erji['sanji'])): $i = 0; $__LIST__ = $erji['sanji'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sanji): $mod = ($i % 2 );++$i;?><label class="">
									<input type="checkbox" value="<?php echo ($sanji["id"]); ?>" <?php if(in_array(($sanji["id"]), is_array($role['rules'])?$role['rules']:explode(',',$role['rules']))): ?>checked<?php endif; ?> name="rules" id="user-Character-0-0-0">
									<?php echo ($sanji["title"]); ?>
								</label><?php endforeach; endif; else: echo "" ;endif; ?>
							</dd>
						</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					</dd>
				</dl><?php endforeach; endif; else: echo "" ;endif; ?>	
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
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});

});
</script>

<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>