<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>我的 - 修改资料</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		修改资料
	</h3>
</header>
		<div class="main modify">
			
				<ul>
					<li>
						<label>姓名</label>
						<input type="text" placeholder="请输入真实姓名" id='realname' value="<?php echo ($info["realname"]); ?>">
					</li>
					<li>
						<label>身份证号</label>
						<input type="text"placeholder="请输入身份证号码" id="idcard" value="<?php echo ($info["idcard"]); ?>">
					</li>
					<li>
						<label>国籍</label>
						<input type="text"placeholder="请输入国籍" id="country" value="<?php echo ($info["country"]); ?>">
					</li>
					<li>
						<label>省份/州</label>
						<input type="text"placeholder="请输入省份/州" id='province' value="<?php echo ($info["province"]); ?>">
					</li>
					<li>
						<label>城市</label>
						<input type="text"placeholder="请输入城市" id='city' value="<?php echo ($info["city"]); ?>">
					</li>
				</ul>
				<p class="tc"><button class="lhbg mod-btn" id='save'>保存</button></p>
			
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script>
	$(function(){
		$('#save').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			
			var realname = $('#realname').val();
			var idcard = $('#idcard').val();
			var country = $('#country').val();
			var province = $('#province').val();
			var city = $('#city').val();
			
		
			$.post("<?php echo U('user/ajax_profile');?>",{realname:realname,idcard:idcard,country:country,province:province,city:city},function(data){
				
				if(data.info == 'success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.reload();
					})
				}else{
					layer.msg(data.msg,{time:2000,icon:5});
					obj.prop('disabled',false);
				}
			},'json')
			
			
		})
	})
	</script>
</html>