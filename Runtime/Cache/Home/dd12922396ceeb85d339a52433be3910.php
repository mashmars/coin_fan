<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>提币</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
	<header>
			<h3 class="tc lhbg">
				<i class="go"></i>
				提币
			</h3>
	</header>
		<div class="main chargingMoney">
			<?php if($address != null): ?><div class="charging-item">
					<h3><i class="num"></i>提币数量</h3>
					<div class="charging-inpu">
						<input type="number"placeholder="请输入提币数量" id='num'>
					</div>
				</div>
				<div class="charging-item">
					<h3><i class="adr"></i>钱包地址</h3>
					<div class="rel charging-inpu selection">
						<input type="text"placeholder="请输入钱包地址"onfocus="this.blur()" id="address" >
						<i></i>
						<ul class="tc">
						<?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($vo["id"]); ?>" data-value="<?php echo ($vo["address"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>							
						<li data-id="" data-value="">地址管理</li>
						</ul>
					</div>
				</div>
				<div class="charging-item">
					<h3><i class="pwd"></i>交易密码</h3>
					<div class="charging-inpu">
						<input type="password"placeholder="请输入交易密码" id="paypassword">
					</div>
				</div>
				<div class="charging-item">
					<h3><i class="cod"></i>短信验证码</h3>
					<div class="rel charging-inpu">
						<input type="text"placeholder="请输入短信验证码" id="sms">
						<span id="code">获取验证码</span>
					</div>
				</div>
				<p class="tc">
					<button class="lhbg mod-btn" id='myzc'>提币</button>
				</p>
			<?php else: ?>
				<p class="tc">
					<a class="lhbg mod-btn" href="<?php echo U('finance/zcwallet');?>">添加转出钱包地址</a>
				</p><?php endif; ?>
		</div>

	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>

		var wait=60;//60s验证码
		var t;
		function time(o) {
			if (wait == 0) {
				o.removeClass("disabled");   
				o.text("获取验证码");
				wait = 60;
				} else {
					o.addClass("disabled");
					o.text("重新发送(" + wait + "s)");
					wait--;
					t=setTimeout(function() {
						time(o)
					},
					1000)
			}
		}
		$(document).ready(function(){
			$('.selection i').removeClass('active');
			$('.selection ul').hide();
			$('.selection input').click(function () {
				$(this).siblings('ul').toggle();
				$(this).siblings('i').toggleClass("active");
			})
			$('.selection ul li').click(function () {
				if($(this).data('id') ==''){
					var url = "<?php echo U('finance/address');?>";
					location.href=url;
				}
				
				$(this).parent().hide();
				$(this).addClass('hv').siblings().removeClass('hv');
				$(this).parent().siblings('input').val($(this).text());
				$(this).parent().siblings('input').attr('value',$(this).data('value'));
				$(this).parent().siblings('input').attr('data-value',$(this).data('id'));
				$(this).parent().siblings('i').removeClass('active');
			})

			
		});
</script>
<script>
$(function(){
	$('#code').click(function(){		
		time($(this));
		var obj = $(this);
		$.post("<?php echo U('finance/ajax_send_sms_myzc');?>",'',function(data){
			if(data.info == 'success'){				
				layer.msg(data.msg,{time:2000,icon:1})
			}else{			
				clearTimeout(t);
				obj.text('获取验证码');
				obj.removeClass('disabled');	
				layer.msg(data.msg,{time:2000,icon:5});
							
			}
		},'json')
		
	})
	
	$('#myzc').click(function(){
		var obj = $(this);
		obj.prop('disabled',true);
		
		var sms = $('#sms').val();
		var num = $('#num').val();		
		var paypassword = $('#paypassword').val();
		var refer = $('#refer').val();
		var address = $('#address').data('value');
		
		if(isNaN(num) || num <=0 || num == ''){
			layer.msg('数量填写不正确',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		if(sms == ''){
			layer.msg('手机验证码不能为空',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}		
		if(paypassword == ''){
			layer.msg('支付密码不能为空',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		if (typeof(address) == 'undefined'){
			layer.msg('请选择钱包地址',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		
		
		$.post("<?php echo U('finance/ajax_myzc');?>",{sms:sms,paypassword:paypassword,num:num,address:address},function(data){
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