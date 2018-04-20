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
<title>文章列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 招聘管理 <span class="c-gray en">&gt;</span> 发布招聘 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<!-- <button onclick="removeIframe()" class="btn btn-primary radius">关闭选项卡</button> -->
	 <!-- <span class="select-box inline"> -->
		<!-- <select name="" class="select">
			<option value="0">全部分类</option>
			<option value="1">分类一</option>
			<option value="2">分类二</option>
		</select>
		</span> 日期范围：
		<input type="text" onfocus="WdatePicker({ maxDate:'#F{ $dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({ minDate:'#F{ $dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" name="" id="" placeholder=" 公告名称" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜公告</button> -->
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<span class="l">
	<a class="btn btn-primary radius" data-title="添加招聘"  data-href="<?php echo U('news/gonggao_add');?>"  href="<?php echo U('news/gonggao_add');?>">
	<i class="Hui-iconfont">&#xe600;</i> 添加招聘</a></span> <span class="r">共有数据：<strong></strong> 条</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover">
			<thead>
				<tr class="text-c">
					
					<th width="80">ID</th>
					<th width="120">标题</th>						
					<th width="120">创建时间</th>
					<th width="120">是否显示</th>									
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">					
					<td><?php echo ($vo["id"]); ?></td>
					<td class="text-l"><?php echo ($vo["title"]); ?></td>	
					<td><?php echo (date('Y-m-d H:i:s',$vo["createdate"])); ?></td>
					<td class="text-c"><?php if($vo['is_show'] == 1): ?><a class='btn btn-success radius size-MINI'>显示</a><?php else: ?><a class='btn disabled radius size-MINI'>不显示</a><?php endif; ?></td>	
					<td class="f-14 product-brand-manage">					
					<a style="text-decoration:none;color: #428bca;" class="ml-5"  href="<?php echo U('news/gonggao_edit' , array('id'=>$vo['id']));?>" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
					<a style="text-decoration:none;color: #428bca;" class="ml-5" onClick="gonggao_del(this,'<?php echo ($vo['id']); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>	
			</tbody>
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
<script type="text/javascript" src="<?php echo (PUB_LIB); ?>datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript">
$(function(){
	

//是否显示控制
	///switch
	$('.show').on('switch-change', function (e, data) {
		var status = 0 ;
		var value = data.value;
		if(value){
			status = 1;
		}
		var id = $(this).attr('id');
		$.ajax({
			url:"<?php echo U('news/ajax_gonggao_status');?>",
			data:{status:status,id:id},
			type:"post",
			dataType:"json",
			success:function(data){
				if(data.info =='success'){
					layer.msg(data.msg,{time:1000,icon: 1});
				}else{
					layer.msg(data.msg,{time:1000,icon: 2});
				}
			},
			
		})
	});
	


})


	/*公告-删除*/
	function gonggao_del(obj,id){ 
		layer.confirm('确认要删除吗？',function(index){
			$.ajax({
				type: "POST",
				url: "<?php echo U('news/ajax_gonggao_del');?>",
				data:{id:id},
				dataType: "json",
				success: function(data){
					$(obj).parents("tr").remove();
					layer.msg(data.msg,{icon:1,time:1000});
				}			
			});		
		});
	}

</script> 
</body>
</html>