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
<title>财务管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 财务管理 <span class="c-gray en">&gt;</span> 转出管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	
	<div class="text-c" >
		<form action=''  method='post' id='form-search'>
		<input type='hidden' name='field' />
		<input type='hidden' name='type' />
		<input type='hidden' name='keyword' />
		<input type='hidden' name='datemin' />
		<input type='hidden' name='datemax' />
		<label>筛选查询：</label>
		<span class="select-box inline">			
			<select name="" id='field' class="select">
				<!-- <option value="txdz" data-type='input' <?php if($field == 'txdz'): ?>selected<?php endif; ?> >地址</option> -->
				<option value="" data-type='' <?php if($field == ''): ?>selected<?php endif; ?>>全部会员</option>
				<option value="phone" data-type='input' <?php if($field == 'phone'): ?>selected<?php endif; ?>>手机号</option>
				
			</select>
		</span>
		<span class="btn-upload form-group" id='date' <?php if($type != 'date'): ?>style='display:none'<?php endif; ?>>
			日期范围：
			<input type="text" onfocus="WdatePicker({ maxDate:'#F{ $dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" value='<?php echo ($start); ?>' id="datemin" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker({ minDate:'#F{ $dp.$D(\'datemin\')}'})" value='<?php echo ($end); ?>' id="datemax" class="input-text Wdate" style="width:120px;">
		</span>
		<span class="btn-upload form-group" id='input' <?php if($type == 'date'): ?>style='display:none'<?php endif; ?>>
			<input type="text" class="input-text" style="width:250px" placeholder="输入关键字" id="keyword" value='<?php echo ($keyword); ?>'>
		</span>
		<button type="button" class="btn btn-success radius" id="serach" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
		<!--<button type="button" class="btn btn-success radius" id="export1" name=""><i class="Hui-iconfont">&#xe644;</i> 按条件导出</button>-->
		</form>
	</div>
	
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
		<span class="l">	
		<!--<a href="javascript:;" onclick="member_add('添加用户','<?php echo U('user/member_add');?>','','510')" class="btn btn-primary radius">
		<i class="Hui-iconfont">&#xe600;</i> 添加用户
		</a>
		-->
		</span>	
		<span class="r">共有数据：<strong><?php echo ($count); ?></strong> 条</span> 	
		
	</div>
	
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg ">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>								
				<th width="100">手机号</th>								
				<th width="100">转出数量</th>								
				<th width="100">手续费</th>								
				<th width="100">实际数量</th>								
				<th width="150">转出地址</th>								
				<th width="100">时间</th>								
				<th width="100">状态</th>								
				<th width="170">操作</th>
			</tr>
		</thead>
		<tbody id='tbody'>
		<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name=""></td>
				<td><?php echo ($vo["id"]); ?></td>
				<td><?php echo ($vo["username"]); ?></td>				
				<td><?php echo ($vo["phone"]); ?></td>				
				<td><?php echo ($vo["mum"]); ?></td>				
				<td><?php echo ($vo["fee"]); ?></td>				
				<td><?php echo ($vo["num"]); ?></td>				
				<td width="150"><?php echo ($vo["address"]); ?></td>				
				<td><?php echo (date('Y-m-d',$vo["createdate"])); ?></td>
				<td><?php if($vo["status"] == 1): ?><span class="label label-success radius">已完成</span><?php elseif($vo["status"] == 2): ?><span class="label label-primary radius">已拒绝</span><?php else: ?><span class="label label-danger radius">待审核</span><?php endif; ?></td>					
				<td class="td-manage">
				<?php if($vo["status"] == 0): ?><a style="text-decoration:none" class="btn btn-secondary-outline radius size-MINI" onclick="shenhe('<?php echo ($vo["id"]); ?>')"   title="审核通过">审核通过</a>  
				<a style="text-decoration:none" class="btn btn-danger-outline radius size-MINI" onClick="del(this,'<?php echo ($vo["id"]); ?>')" href="javascript:;" title="拒绝">拒绝通过</a><?php endif; ?>
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
	$('#field').change(function(){
		var type = $(this).find('option:selected').attr('data-type');
		if(type == 'date'){
			$('#input').hide();
			$('#datemin').val('');
			$('#datemax').val('');
			$('#date').show();
		}else{
			$('#date').hide();
			$('#keyword').val('');
			$('#input').show();
		}
	})
	$('#serach').click(function(){
		$('#form-search').prop('action','');
		var field = $('#field').find('option:selected').val();
		var type = $('#field').find('option:selected').attr('data-type');
		if(type == 'input'){
			var param = $('#keyword').val();
			if(param == ''){
				layer.msg('请输入查询关键字',{icon:5,time:2000});return false;
			}else{
				$('input[name=field]').val(field);
				$('input[name=type]').val(type);
				$('input[name=keyword]').val(param);
				$('input[name=datemin]').val('');
				$('input[name=datemax]').val('');
				$('#form-search').submit();
			}
		}else if(type == 'date'){
			var param1 = $('#datemin').val();
			var param2 = $('#datemax').val();
			if(param1 == '' && param2 == ''){
				layer.msg('开始日期和结束日期不能同时为空',{icon:5,time:2000});return false;
			}else{
				$('input[name=field]').val(field);
				$('input[name=type]').val(type);
				$('input[name=keyword]').val('');
				$('input[name=datemin]').val(param1);
				$('input[name=datemax]').val(param2);
				$('#form-search').submit();
			}
		}
	})
	
	
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
//拒绝
function del(obj,id){
	layer.confirm('是否确认拒绝此转出请求',function(){
		$.ajax({
			url:"<?php echo U('finance/ajax_myzc_refuse');?>",
			data:{id:id},
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.info =='success'){
					layer.msg(data.msg,{time:2000,icon:6},function(){
						parent.location.reload();
					})
				}else{
					layer.msg(data.msg,{time:2000,icon:5})
				}
			}
		})
	})
}
//审核通过
function shenhe(id){
	layer.confirm('是否确认通过此转出请求',function(){
		$.ajax({
			url:"<?php echo U('finance/ajax_myzc_shenhe');?>",
			data:{id:id},
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.info =='success'){
					layer.msg(data.msg,{time:2000,icon:6},function(){
						parent.location.reload();
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