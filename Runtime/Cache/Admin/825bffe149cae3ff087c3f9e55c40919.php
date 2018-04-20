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
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 资产管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
				<option value="realname" data-type='input' <?php if($field == 'realname'): ?>selected<?php endif; ?>>姓名</option>
				<option value="idcard" data-type='input' <?php if($field == 'idcard'): ?>selected<?php endif; ?>>身份证号码</option>
				<option value="zsbh" data-type='input' <?php if($field == 'zsbh'): ?>selected<?php endif; ?>>证书编号</option>
				<option value="zczbh" data-type='input' <?php if($field == 'zczbh'): ?>selected<?php endif; ?>>注册证编号</option>
				<option value="txdz" data-type='input' <?php if($field == 'txdz'): ?>selected<?php endif; ?>>通讯地址</option>
				<option value="qfrq" data-type='date' <?php if($field == 'qfrq'): ?>selected<?php endif; ?>>注册日期(起止)</option>
				<option value="zcyxq" data-type='date' <?php if($field == 'zcyxq'): ?>selected<?php endif; ?>>注册有效期(起止)</option>
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
				<th width="100">可用乐淘链</th>								
				<th width="100">冻结乐淘链</th>								
				<th width="100">钱包地址</th>								
				<th width="170">操作</th>
			</tr>
		</thead>
		<tbody id='tbody'>
		<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name=""></td>
				<td><?php echo ($vo["id"]); ?></td>							
				<td><?php echo ($vo["username"]); ?></td>				
				<td><?php echo ($vo["phone"]); ?></td>	
				<td><?php echo ($vo["lth"]); ?></td>	
				<td><?php echo ($vo["lthd"]); ?></td>	
				<td><?php echo ($vo["lthb"]); ?></td>	
				<td class="td-manage">				
				<a style="text-decoration:none" class="btn btn-secondary-outline radius size-MINI" onclick="member_add('编辑用户资产','<?php echo U('user/member_coin_edit',array('id'=>$vo['id']));?>','','510')"   title="编辑用户资产">编辑</a>  
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


</script> 
</body>
</html>