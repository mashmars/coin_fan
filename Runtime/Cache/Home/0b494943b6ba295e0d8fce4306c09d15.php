<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('login');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<div class="main login">
			<h3 class="tc rel"><?php echo L('login');?>
			<span class="switch-btn">简体中文<i></i></span>
				<input type="text"class="dn switch-con">
				<ul class="switchBox">
					<li id="1"><a href="?l=zh-cn">简体中文</a></li>
					<li id="3"><a href="?l=zh-tw">繁体中文</a></li>
					<li id="2"><a href="?l=en-us">English</a></li>
				</ul>
			</h3>
			<p class="tc loglo">
				<img src="<?php echo (PUB_IMG); ?>log.png" alt="">
			</p>
			
				<ul>
					<li>
						<input type="text"placeholder="<?php echo L('phone');?>" id='phone'>
					</li>
					<li>
						<input type="password"placeholder="<?php echo L('password');?>" id="password">
						<!--<i class="hided"></i>-->
					</li>
				</ul>
				<p class="tr forget"><a href="<?php echo U('login/findpassword');?>"><?php echo L('forget_password');?></a></p>
				
				<p class="tc"><button class="lhbh mod-btn" id='login_password'><?php echo L('login');?></button></p>
			
			<p class="ovh lolink">
				<a href="<?php echo U('login/phone');?>" class="fl"><?php echo L('use_phone');?></a>
				<a href="<?php echo U('login/register');?>" class="fr"><?php echo L('register');?></a>
			</p>
			
		</div>
		
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
		$('.hided').click(function(){
			var inval = $(this).siblings('input').val();
				if($(this).parent().hasClass('active')){
					$(this).siblings('input').detach();
					$(this).before('<input type="text" value="'+ inval +'"placeholder="密码">');
					$(this).parent().removeClass('active');
				}else{
					$(this).parent().addClass('active');
					$(this).siblings('input').detach();
					$(this).before('<input type="password" value="'+ inval +'"placeholder="密码">');
				}
			});
		function hasClass(element, cls) {
			return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
		}
		window.onload = function(){
			var agree = document.getElementById('agree'),
				agrI = agree.getElementsByTagName('i')[0];				
				agrI.onclick = function(){
					if(hasClass(agrI,'active')){
						this.className = '';
					}else{
						this.className = 'active';
					}
				}
			
				$('.hided').click(function(){
					var inval = $(this).siblings('input').val();
					if($(this).parent().hasClass('active')){
						$(this).siblings('input').detach();
						$(this).before('<input type="text"  value="'+ inval +'">');
						$(this).parent().removeClass('active');
					}else{
						$(this).parent().addClass('active');
						$(this).siblings('input').detach();
						$(this).before('<input type="password" value="'+ inval +'">');
					}
			});
		}
		
		$('.switchBox').hide();
		$('.switch-btn').click(function(){
			$('.switchBox').toggle();
			$(this).children('i').toggleClass("active");
		});
		var lang = "<?php echo (cookie('think_language')); ?>";
		if(lang == 'zh-tw'){
			var text = '繁体中文';
		}else if (lang == 'en-us'){
			var text = 'English';
		}else{
			var text = '简体中文';
		}
		$('.switch-btn').html(text+'<i></i>');
		
		
	</script>
	<script>
	$(function(){
		$('#login_password').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			var phone = $('#phone').val();
			var password = $('#password').val();
			
			if(phone == ''){
				layer.msg("<?php echo L('phone_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(password == ''){
				layer.msg("<?php echo L('password_set_empty');?>",{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			
			
			$.post("<?php echo U('login/ajax_login_password');?>",{phone:phone,password:password},function(data){
				if(data.info == 'success'){
					layer.msg(data.msg,{time:2000,icon:1},function(){
						var url = "<?php echo U('user/index');?>";
						location.href = url;
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