<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('user_title');?>-<?php echo L('profile_h3');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		<?php echo L('profile_h3');?>
	</h3>
</header>
		<div class="main modify">
			
				<ul>
					<li>
						<label><?php echo L('realname');?></label>
						<input type="text" placeholder="<?php echo L('realname_p');?>" id='realname' value="<?php echo ($info["realname"]); ?>">
					</li>
					<li>
						<label><?php echo L('idcard');?></label>
						<input type="text"placeholder="<?php echo L('idcard_p');?>" id="idcard" value="<?php echo ($info["idcard"]); ?>">
					</li>
					<li>
						<label><?php echo L('country');?></label>
						<input type="text"placeholder="<?php echo L('country_p');?>" id="country" value="<?php echo ($info["country"]); ?>">
					</li>
					<li>
						<label><?php echo L('address');?></label>
						<input type="text"placeholder="<?php echo L('address_p');?>" id='province' value="<?php echo ($info["province"]); ?>">
					</li>
					<li>
						<label><?php echo L('city');?></label>
						<input type="text"placeholder="<?php echo L('city_p');?>" id='city' value="<?php echo ($info["city"]); ?>">
					</li>
				</ul>
				<p class="tc"><button class="lhbg mod-btn" id='save'><?php echo L('submit');?></button></p>
			
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
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