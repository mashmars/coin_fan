<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>我的 - 密码管理</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		修改密码
	</h3>
</header>
		<div class="main passwordManagement">
			<p class="tips">经常更换密码有助于账号安全</p>
			<div class="pwd-box">
				<ul class="ovh tc" id="pwdNav">
					<li class="active">登录密码</li>
					<li>交易密码</li>
				</ul>
				<div class="pwd-con"id="pwdCon">
					<div class="pwd-item"style="display: block;">
						<ul>
							<li>
								<label>原始密码</label>
								<input type="text"placeholder="请输入原始登录密码" id='oldpassword'>
							</li>
							<li>
								<label>新密码</label>
								<input type="text"placeholder="请输入新登录密码" id='newpassword'>
							</li>
							<li>
								<label>确认密码</label>
								<input type="text"placeholder="再次输入登录密码" id='newpassword2'>
							</li>
						</ul>
						<p class="tc">
							<button class="lhbg mod-btn" id="password_confirm">确认修改</button>
						</p>
					</div>
					<div class="pwd-item">
						<ul>
							<li>
								<label>原始密码</label>
								<input type="text"placeholder="请输入原始支付密码" id="oldpaypassword">
							</li>
							<li>
								<label>新密码</label>
								<input type="text"placeholder="请输入新支付密码" id="newpaypassword">
							</li>
							<li>
								<label>确认密码</label>
								<input type="text"placeholder="再次输入支付密码" id="newpaypassword2">
							</li>
						</ul>
						<p class="tc">
							<button class="lhbg mod-btn" id="paypassword_confirm">确认修改</button>
						</p>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
		window.onload = function(){
			var pwdNav = document.getElementById('pwdNav'),
				pLi = pwdNav.getElementsByTagName('li'),
				pwdCon = document.getElementById('pwdCon'),
				pwdItem = pwdCon.getElementsByClassName('pwd-item');
				for(var i=0;i<pLi.length;i++){
					pLi[i].index=i;
					pLi[i].onclick=function (){
						for(var i=0;i<pLi.length;i++){
							pLi[i].className = '';
							pwdItem[i].style.display = 'none';
						}
						this.className ='active';
						pwdItem[this.index].style.display='block';
					}
			}

		}
	</script>
	<script>
	$(function(){
		$('#password_confirm').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			var oldpassword  = $('#oldpassword').val();
			var newpassword  = $('#newpassword').val();
			var newpassword2 = $('#newpassword2').val();
			if(oldpassword == ''){
				layer.msg('原始密码不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword == ''){
				layer.msg('新密码不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword2 == ''){
				layer.msg('确认密码不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword != newpassword2){
				layer.msg('新密码和确认密码不一致',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			$.post("<?php echo U('user/ajax_password');?>",{oldpassword:oldpassword,newpassword:newpassword,newpassword2:newpassword2},function(data){
				if(data.info == 'success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.reload();
					});
				}else{
					layer.msg(data.msg,{time:2000,icon:5});
					obj.prop('disabled',false);
				}
			},'json')
		})
		$('#paypassword_confirm').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			var oldpassword  = $('#oldpaypassword').val();
			var newpassword  = $('#newpaypassword').val();
			var newpassword2 = $('#newpaypassword2').val();
			if(oldpassword == ''){
				layer.msg('原始密码不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword == ''){
				layer.msg('新密码不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword2 == ''){
				layer.msg('确认密码不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(newpassword != newpassword2){
				layer.msg('新密码和确认密码不一致',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			$.post("<?php echo U('user/ajax_paypassword');?>",{oldpassword:oldpassword,newpassword:newpassword,newpassword2:newpassword2},function(data){
				if(data.info == 'success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						location.reload();
					});
				}else{
					layer.msg(data.msg,{time:2000,icon:5});
					obj.prop('disabled',false);
				}
			},'json')
		})
	})
	</script>
</html>