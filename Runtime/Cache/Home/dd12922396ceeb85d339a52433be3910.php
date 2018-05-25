<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>

	<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>

	<title><?php echo L('menu_tb');?></title>

	<meta name="description" content="">

	<meta name="keywords" content="">

	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">

	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">

	</head>

	<body>

	<header>

			<h3 class="tc lhbg">

				<i class="go"></i>

				<?php echo L('menu_tb');?>

			</h3>

	</header>

		<div class="main chargingMoney">

			<?php if($address != null): ?><div class="charging-item">

					<h3><i class="num"></i><?php echo L('amount');?></h3>

					<div class="charging-inpu">

						<input type="number"placeholder="<?php echo L('amount_p');?>" id='num'>

					</div>

				</div>

				<div class="charging-item">

					<h3><i class="adr"></i><?php echo L('wallet_address');?></h3>

					<div class="rel charging-inpu selection">

						<input type="text"placeholder="<?php echo L('wallet_address_p');?>"onfocus="this.blur()" id="address" >

						<i></i>

						<ul class="tc">

						<?php if(is_array($address)): $i = 0; $__LIST__ = $address;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-id="<?php echo ($vo["id"]); ?>" data-value="<?php echo ($vo["address"]); ?>"><?php echo ($vo["name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>							

						<li data-id="" data-value=""><?php echo L('address_manage');?></li>

						</ul>

					</div>

				</div>

				<div class="charging-item">

					<h3><i class="pwd"></i><?php echo L('paypassword');?></h3>

					<div class="rel ovh charging-inpu">

						<input type="password"placeholder="<?php echo L('paypassword_p');?>" id="paypassword">
						<a href="<?php echo U('user/password');?>" class="forget-btn"><?php echo L('forget_password');?></a>
					</div>

				</div>

				<div class="charging-item">

					<h3><i class="cod"></i><?php echo L('sms');?></h3>

					<div class="rel charging-inpu">

						<input type="text"placeholder="<?php echo L('sms_p');?>" id="sms">

						<span id="code"><?php echo L('sms_get');?></span>

					</div>

				</div>

				<p class="tc">

					<button class="lhbg mod-btn" id='myzc'><?php echo L('submit');?></button>

				</p>

			<?php else: ?>

				<p class="tc">

					<a class="lhbg mod-btn" href="<?php echo U('finance/zcwallet');?>"><?php echo L('add_address_button');?></a>

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

				o.text("<?php echo L('sms_get');?>");

				wait = 60;

				} else {

					o.addClass("disabled");

					o.text("<?php echo L('sms_get_again');?>(" + wait + "s)");

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

				obj.text("<?php echo L('sms_get');?>");

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

			layer.msg("<?php echo L('amount_error');?>",{time:2000,icon:5});

			obj.prop('disabled',false);

			return false;

		}

		if(sms == ''){

			layer.msg("<?php echo L('sms_set_empty');?>",{time:2000,icon:5});

			obj.prop('disabled',false);

			return false;

		}		

		if(paypassword == ''){

			layer.msg("<?php echo L('paypassword_set_empty');?>",{time:2000,icon:5});

			obj.prop('disabled',false);

			return false;

		}

		if (typeof(address) == 'undefined'){

			layer.msg("<?php echo L('wallet_address_set_empty');?>",{time:2000,icon:5});

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