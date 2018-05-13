<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<style>
#address select{width: 80px;height: 30px;border: 1px solid #c0c0c0;}
#address select option{width: 80px;max-width: 100px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
</style>
<title>静态分红设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 系统设置 <span class="c-gray en">&gt;</span> 分红管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">	
		<a href="javascript:;" onclick="member_add('添加静态设置','<?php echo U('system/sys_jtfh_add');?>','','510')" class="btn btn-primary radius">
		<i class="Hui-iconfont">&#xe600;</i> 添加设置
		</a>
		
		</span>	
		<span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> 	
		
	</div>
	
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg ">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">上限</th>								
				<th width="100">下线</th>								
				<th width="100">比例</th>								
				<th width="100">状态</th>								
				<th width="170">操作</th>
			</tr>
		</thead>
		<tbody id='tbody'>
		<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name=""></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["minnum"]); ?></td>				
				<td><?php echo ($vo["maxnum"]); ?></td>				
				<td><?php echo ($vo["bl"]); ?></td>				
				<td><?php if($vo["status"] == 1): ?>可用<?php else: ?>禁用<?php endif; ?></td>				
				<td class="td-manage">				
				<a style="text-decoration:none" class="btn btn-secondary-outline radius size-MINI" onclick="member_add('编辑','<?php echo U('system/sys_jtfh_edit',array('id'=>$vo['id']));?>','','510')"   title="编辑">编辑</a>  
				<a style="text-decoration:none" class="btn btn-danger-outline radius size-MINI" onClick="del(this,'<?php echo ($vo["id"]); ?>')" href="javascript:;" title="删除">删除</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
		<!--
		<tr class="text-c" >
			<td colspan="14" style="text-align:left;">
			
				<button type="button" class="btn btn-success radius" id="export" name=""><i class="Hui-iconfont">&#xe644;</i> 导出选中</button>
				<form id='form-export' style='display:none' action="<?php echo U('user/export');?>" method='post'>
					<textarea id='ids' name='ids'></textarea>
				</form>
			</td>
		</tr>
		-->
	</table>
	</div>
	<div class='page'><?php echo ($page); ?></div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>layer/2.4/layer.js"></script>
<script type="text/javascript" src="<?php echo (PUB_STATIC); ?>h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="<?php echo (PUB_STATIC); ?>h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>My97DatePicker/4.8/WdatePicker.js"></script> 

<script src="<?php echo (PUB_LIB); ?>a/js/bootstrap.js"></script>
<script src="<?php echo (PUB_LIB); ?>a/js/city-picker.data.js"></script>
<script src="<?php echo (PUB_LIB); ?>a/js/city-picker.js"></script>
<script src="<?php echo (PUB_LIB); ?>a/js/main.js"></script>
<link href="<?php echo (PUB_LIB); ?>a/css/city-picker.css" rel="stylesheet" type="text/css" />
<script>

	
//查询
$(function(){
	
})

</script>

<script type="text/javascript">

/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
	layer_show(title,url,w,h);
}

function del(obj,id){
	layer.confirm('是否确认删除,一经删除，无法恢复',function(){
		$.ajax({
			url:"<?php echo U('system/ajax_sys_jtfh_del');?>",
			data:{id:id},
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.info =='success'){
					layer.msg(data.msg,{time:2000,icon:6},function(){
						$(obj).parents('tr').remove();
					})
				}else{
					layer.msg(data.msg,{time:2000,icon:5})
				}
			}
		})
	})
}

</script> 
</body>
</html>