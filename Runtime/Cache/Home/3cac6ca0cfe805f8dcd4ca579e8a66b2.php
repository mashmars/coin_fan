<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>转出记录</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	<script type="text/javascript" src="<?php echo (PUB_JS); ?>iscroll.js"></script>
	<style type="text/css" media="all">


		#wrapper{position:absolute; z-index:1;top:45px; bottom:48px; left:0;width:100%;overflow:auto;}
		#scroller {
			position:relative;
		/*  -webkit-touch-callout:none;*/
			-webkit-tap-highlight-color:rgba(0,0,0,0);

			float:left;
			width:100%;
			padding:0;
		}

		#scroller ul {
			position:relative;
			width:100%;
			text-align:left;
		}
		#pullDown, #pullUp {
			background:#fff;
			height:40px;
			line-height:40px;
			padding:5px 10px;
			border-bottom:1px solid #ccc;
			font-weight:bold;
			font-size:14px;
			color:#888;
		}
		#pullDown .pullDownIcon, #pullUp .pullUpIcon  {
			display:block; float:left;
			width:40px; height:40px;
			background:url(/Home/Public/js/pull-icon@2x.png) 0 0 no-repeat;
			-webkit-background-size:40px 80px; background-size:40px 80px;
			-webkit-transition-property:-webkit-transform;
			-webkit-transition-duration:250ms;  
		}
		#pullDown .pullDownIcon {
			-webkit-transform:rotate(0deg) translateZ(0);
		}
		#pullUp .pullUpIcon  {
			-webkit-transform:rotate(-180deg) translateZ(0);
		}


		/**
		 * 动画效果css3代码
		 */
		#pullDown.flip .pullDownIcon {
			-webkit-transform:rotate(-180deg) translateZ(0);
		}

		#pullUp.flip .pullUpIcon {
			-webkit-transform:rotate(0deg) translateZ(0);
		}

		#pullDown.loading .pullDownIcon, #pullUp.loading .pullUpIcon {
			background-position:0 100%;
			-webkit-transform:rotate(0deg) translateZ(0);
			-webkit-transition-duration:0ms;

			-webkit-animation-name:loading;
			-webkit-animation-duration:2s;
			-webkit-animation-iteration-count:infinite;
			-webkit-animation-timing-function:linear;
		}

		@-webkit-keyframes loading {
			from { -webkit-transform:rotate(0deg) translateZ(0); }
			to { -webkit-transform:rotate(360deg) translateZ(0); }
		}

	</style>
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		转出记录
	</h3>
</header>
</header>
		<div class="main chargeRecord">
			<div class="record-bd" id="wrapper">
				<div id="scroller">
					<div id="pullDown">
						<span class="pullDownIcon"></span>
						<span class="pullDownLabel">下拉刷新...</span>
					</div>
					<?php if($res[0] != null): ?><ul id="list">
					<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="flex-box">
							<div class="flex-1 flex-box">
								<img src="<?php echo (PUB_IMG); ?>ht.png" alt="">
								<div class="flex-1">
									<h4>提币</h4>
									<p><span><?php echo (date('m月d日',$vo["createdate"])); ?></span><span><?php echo (date('H:i',$vo["createdate"])); ?></span></p>
								</div>
							</div>
							<span>-<?php echo ($vo["num"]); ?></span>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<?php else: ?>
					<p class="no-list tc">暂无记录</p><?php endif; ?>
					<div id="pullUp">
						<span class="pullUpIcon"></span>
						<span class="pullUpLabel">上拉加载更多...</span>
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
					var url = "<?php echo U('finance/ajax_myzcdetail');?>";
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
				var url = "<?php echo U('finance/ajax_myzcdetail');?>";
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
								layer.msg('没有更多数据可加载',{time:2000,icon:2});
								return false;
							}
							$.each(result,function(k,v){
								var src = "<?php echo (PUB_IMG); ?>";
								if(v.id){
									list += '<li class="flex-box"><div class="flex-1 flex-box"><img src="<?php echo (PUB_IMG); ?>ht.png" alt="">';
									list += '<div class="flex-1"><h4>提币</h4><p><span>4月3日</span><span>14:16</span></p></div></div>';
									list += '<span>-'+v.num+'</span></li>';
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
							pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
						} else if (pullUpEl.className.match('loading')) {
							pullUpEl.className = '';
							pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
						}
					},
					onScrollMove: function () {
						if (this.y > 5 && !pullDownEl.className.match('flip')) {
							pullDownEl.className = 'flip';
							pullDownEl.querySelector('.pullDownLabel').innerHTML = '松手开始更新...';
							this.minScrollY = 0;
						} else if (this.y < 5 && pullDownEl.className.match('flip')) {
							pullDownEl.className = '';
							pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
							this.minScrollY = -pullDownOffset;
						} else if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
							pullUpEl.className = 'flip';
							pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手开始更新...';
							this.maxScrollY = this.maxScrollY;
						} else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
							pullUpEl.className = '';
							pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
							this.maxScrollY = pullUpOffset;
						}
					},
					onScrollEnd: function () {
						if (pullDownEl.className.match('flip')) {
							pullDownEl.className = 'loading';
							pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';
							pullDownAction();   // Execute custom function (ajax call?)
						} else if (pullUpEl.className.match('flip')) {
							pullUpEl.className = 'loading';
							pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
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