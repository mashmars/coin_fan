<?php if (!defined('THINK_PATH')) exit();?><html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>钱包管理</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
			<h3 class="tc lhbg">
				<i class="go"></i>
				钱包管理
			</h3>
		</header>
		<div class="main purseAddress">
			<ul>
			<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					<div>
						<h3 class="ovh">
							<img src="<?php echo (PUB_IMG); ?>log.png" alt="" class="fl">
							<span class="fl">MC</span>
							<em class="fr">标识:<?php echo ($vo["name"]); ?></em>
						</h3>
						<p><?php echo ($vo["address"]); ?></p>
					</div>
					<p class="purse-btn">
						<a href="javascript:;" class='del' data-id="<?php echo ($vo["id"]); ?>">删除</a>
						<a href="<?php echo U('finance/zcwallet',array('id'=>$vo['id']));?>">修改</a>
					</p>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
			<div class="additem">
				<a href="<?php echo U('finance/zcwallet');?>"><img src="<?php echo (PUB_IMG); ?>additem.png" alt=""></a>
			</div>
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
	$(function(){
		$('.del').click(function(){
			var obj = $(this),id=$(this).data('id');
			layer.confirm('是否确认删除此地址?',function(){
				$.post("<?php echo U('finance/ajax_address_del');?>",{id:id},function(data){
					if(data.info == 'success'){
						layer.msg(data.msg,{time:2000,icon:1},function(){
							obj.parents('li').remove();
						})
					}else{
						layer.msg(data.msg,{time:2000,icon:5})
					}
				},'json')
			})
		})
	})
	</script>
</html>