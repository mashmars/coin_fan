<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title><?php echo L('transferlog_title');?></title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	<script type="text/javascript" src="<?php echo (PUB_JS); ?>iscroll.js"></script>
	
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		<?php echo L('transferlog_title');?>
	</h3>
</header>
</header>
		<div class="main chargeRecord">
			<div class="record-bd" id="wrapper">
				<div id="scroller">
					<div id="pullDown">
						<span class="pullDownIcon"></span>
						<span class="pullDownLabel"><?php echo L('pulldown');?>...</span>
					</div>
					<?php if($res[0] != null): ?><ul id="list">
					<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="flex-box">
							<div class="flex-1 flex-box">
								<img src="<?php echo (PUB_IMG); ?>ht.png" alt="">
								<div class="flex-1">
									<h4><?php if($vo['type'] == 'zc'): echo L('zc');?>(<?php echo ($vo["phone"]); ?>)<?php else: echo L('zr');?>(<?php echo ($vo["phone"]); ?>)<?php endif; ?></h4>
									<p><span><?php echo (date('m/d',$vo["createdate"])); ?></span><span><?php echo (date('H:i',$vo["createdate"])); ?></span></p>
								</div>
							</div>
							<span><?php if($vo['type'] == 'zc'): ?>-<?php else: ?>+<?php endif; echo ($vo["num"]); ?></span>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<?php else: ?>
					<p class="no-list tc"><?php echo L('no_record');?></p><?php endif; ?>
					<div id="pullUp">
						<span class="pullUpIcon"></span>
						<span class="pullUpLabel"><?php echo L('pullup');?>...</span>
					</div>
				</div>
			</div>
		</div>
		<div class="mask"></div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script type="text/javascript">
		$('.selectbox ul').hide();
		$('.selection').click(function () {
			$('.mask').toggle();
			$(this).siblings('ul').toggle();
		});
		$('.selectbox ul li').click(function () {
			$(this).parent().hide();
			$('.mask').hide();
			$(this).parent().siblings('span').html($(this).text() + '<i class="go"></i>');
			$(this).parent().siblings('span').attr('id',$(this).attr('id'));
			})
	</script>
	<script type="text/javascript">
		var myScroll,
			pullDownEl, pullDownOffset,
			pullUpEl, pullUpOffset,
			generatedCount = 0;
		var p = 2;
			/**下拉刷新 （自定义实现此方法） myScroll.refresh(); 数据加载完成后，调用界面更新方法*/
			function pullDownAction () {
				setTimeout(function () { 
					var url = "<?php echo U('finance/ajax_transferlog');?>";
					$.ajax({
							url:url,
							type:'post',
							data:{
								p:p,
							},
							dataType:'json',
							success:function(result){
								var data=result.data;
								for(var i=0;i<data.length;i++){
									$('#list').append('<li></li>')
								}
							},error:function(err){
								
							}
							});
					myScroll.refresh();   
				}, 1000);   
			}
			/** 滚动翻页 （自定义实现此方法）
			 * myScroll.refresh();      // 数据加载完成后，调用界面更新方法
			 */
			function pullUpAction () {
				var url = "<?php echo U('finance/ajax_transferlog');?>";
				setTimeout(function () {
					$.ajax({
						url:url,
						type:'post',
						data:{
							p:p,
						},
						dataType:'json',
						success:function(result){
							var list = '';
							if(result == ''){ 
								layer.msg("<?php echo L('no_more_record');?>",{time:2000,icon:2});
								return false;
							}
							$.each(result,function(k,v){
								var src = "<?php echo (PUB_IMG); ?>";
								var type='',fh='';
								if(v.type == 'zc'){
									type = "<?php echo L('zc');?>";
									fh = '-';
								}else{
									type = "<?php echo L('zr');?>";
									fh = '+';
								}
								if(v.id){
									list += '<li class="flex-box"><div class="flex-1 flex-box"><img src="<?php echo (PUB_IMG); ?>ht.png" alt="">';
									list += '<div class="flex-1"><h4>'+type+'('+v.phone+')</h4><p><span>'+v.date+'</span><span>'+v.time+'</span></p></div></div>';
									list += '<span>'+fh+v.num+'</span></li>';
								}
							})
							p +=1;
							$('#list').append(list);
						},error:function(err){
							
						}
					});

					myScroll.refresh();
				}, 1000);
			}
			/*** 初始化iScroll控件*/
			function loaded() {
				pullDownEl = document.getElementById('pullDown');
				pullDownOffset = pullDownEl.offsetHeight;
				pullUpEl = document.getElementById('pullUp');   
				pullUpOffset = pullUpEl.offsetHeight;

				myScroll = new iScroll('wrapper', {
					scrollbarClass: 'myScrollbar', 
					useTransition: false, 
					topOffset: pullDownOffset,
					onRefresh: function () {
						if (pullDownEl.className.match('loading')) {
							pullDownEl.className = '';
							pullDownEl.querySelector('.pullDownLabel').innerHTML = "<?php echo L('pulldown');?>...";
						} else if (pullUpEl.className.match('loading')) {
							pullUpEl.className = '';
							pullUpEl.querySelector('.pullUpLabel').innerHTML = "<?php echo L('pullup');?>...";
						}
					},
					onScrollMove: function () {
						if (this.y > 5 && !pullDownEl.className.match('flip')) {
							pullDownEl.className = 'flip';
							pullDownEl.querySelector('.pullDownLabel').innerHTML = "<?php echo L('updating');?>...";
							this.minScrollY = 0;
						} else if (this.y < 5 && pullDownEl.className.match('flip')) {
							pullDownEl.className = '';
							pullDownEl.querySelector('.pullDownLabel').innerHTML = "<?php echo L('pulldown');?>...";
							this.minScrollY = -pullDownOffset;
						} else if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
							pullUpEl.className = 'flip';
							pullUpEl.querySelector('.pullUpLabel').innerHTML = "<?php echo L('updating');?>...";
							this.maxScrollY = this.maxScrollY;
						} else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
							pullUpEl.className = '';
							pullUpEl.querySelector('.pullUpLabel').innerHTML = "<?php echo L('pullup');?>...";
							this.maxScrollY = pullUpOffset;
						}
					},
					onScrollEnd: function () {
						if (pullDownEl.className.match('flip')) {
							pullDownEl.className = 'loading';
							pullDownEl.querySelector('.pullDownLabel').innerHTML = "<?php echo L('loading');?>...";
							pullDownAction();   // Execute custom function (ajax call?)
						} else if (pullUpEl.className.match('flip')) {
							pullUpEl.className = 'loading';
							pullUpEl.querySelector('.pullUpLabel').innerHTML = "<?php echo L('loading');?>...";
							pullUpAction();
						}
					}
			});
			setTimeout(function () { document.getElementById('wrapper').style.left = '0'; }, 800);
			}
			//初始化绑定iScroll控件 
			document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
			document.addEventListener('DOMContentLoaded', loaded, false); 
	</script>
</html>