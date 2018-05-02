<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>密码登录</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<div class="main login">
			<h3 class="tc">登录</h3>
			<p class="tc loglo">
				<img src="<?php echo (PUB_IMG); ?>log.png" alt="">
			</p>
			
				<ul>
					<li>
						<input type="text"placeholder="手机号" id='phone'>
					</li>
					<li>
						<input type="password"placeholder="密码" id="password">
						<!--<i class="hided"></i>-->
					</li>
				</ul>
				<p class="tr forget"><a href="<?php echo U('login/findpassword');?>">忘记密码？</a></p>
				<p class="agreement"id="agree">
					<i class="active"></i>
					<span>注册表示您已阅读并同意</span>
					<a href="#" id='read'>《矿产链用户注册协议》</a>
				</p>
				<p class="tc"><button class="lhbh mod-btn" id='login_password'>登录</button></p>
			
			<p class="ovh lolink">
				<a href="<?php echo U('login/phone');?>" class="fl">使用验证码登录</a>
				<a href="<?php echo U('login/register');?>" class="fr">注册新账号</a>
			</p>
			
		</div>
		<div id='xieyi' style='display:none'>
			一、总则
1.1 用户在注册之前，应当仔细阅读本协议，并同意遵守本协议后方可成为注册用户。一旦注册成功，则用户与矿产链之间自动形成协议关系，用户应当受本协议的约束。用户在使用特殊的服务或产品时，应当同意接受相关协议后方能使用。 
1.2 本协议则可由矿产链随时更新，用户应当及时关注并同意本站不承担通知义务。本站的通知、公告、声明或其它类似内容是本协议的一部分。
二、服务内容
2.1 矿产链的具体内容由本站根据实际情况提供。 
2.2 本站仅提供相关的网络服务，除此之外与相关网络服务有关的设备(如个人电脑、手机、及其他与接入互联网或移动网有关的装置)及所需的费用(如为接入互联网而支付的电话费及上网费、为使用移动网而支付的手机费)均应由用户自行负担。
三、用户帐号
3.1 经本站注册系统完成注册程序并通过身份认证的用户即成为正式用户，可以获得本站规定用户所应享有的一切权限；未经认证仅享有本站规定的部分会员权限。矿产链有权对会员的权限设计进行变更。 
3.2 用户只能按照注册要求使用真实姓名，及身份证号注册。用户有义务保证密码和帐号的安全，用户利用该密码和帐号所进行的一切活动引起的任何损失或损害，由用户自行承担全部责任，本站不承担任何责任。如用户发现帐号遭到未授权的使用或发生其他任何安全问题，应立即修改帐号密码并妥善保管，如有必要，请通知本站。因黑客行为或用户的保管疏忽导致帐号非法使用，本站不承担任何责任。
四、使用规则
4.1 遵守中华人民共和国相关法律法规，包括但不限于《中华人民共和国计算机信息系统安全保护条例》、《计算机软件保护条例》、《最高人民法院关于审理涉及计算机网络著作权纠纷案件适用法律若干问题的解释(法释[2004]1号)》、《全国人大常委会关于维护互联网安全的决定》、《互联网电子公告服务管理规定》、《互联网新闻信息服务管理规定》、《互联网著作权行政保护办法》和《信息网络传播权保护条例》等有关计算机互联网规定和知识产权的法律和法规、实施办法。 
4.2 用户对其自行发表、上传或传送的内容负全部责任，所有用户不得在本站任何页面发布、转载、传送含有下列内容之一的信息，否则本站有权自行处理并不通知用户：
(1)违反宪法确定的基本原则的； 
(2)危害国家安全，泄漏国家机密，颠覆国家政权，破坏国家统一的； 
(3)损害国家荣誉和利益的； 
(4)煽动民族仇恨、民族歧视，破坏民族团结的； 
(5)破坏国家宗教政策，宣扬邪教和封建迷信的； 
(6)散布谣言，扰乱社会秩序，破坏社会稳定的；
(7)散布淫秽、色情、赌博、暴力、恐怖或者教唆犯罪的； 
(8)侮辱或者诽谤他人，侵害他人合法权益的； 
(9)煽动非法集会、结社、游行、示威、聚众扰乱社会秩序的； 
(10)以非法民间组织名义活动的；
(11)含有法律、行政法规禁止的其他内容的。
4.3 用户承诺对其发表或者上传于本站的所有信息(即属于《中华人民共和国著作权法》规定的作品，包括但不限于文字、图片、音乐、电影、表演和录音录像制品和电脑程序等)均享有完整的知识产权，或者已经得到相关权利人的合法授权；如用户违反本条规定造成本站被第三人索赔的，用户应全额补偿本站一切费用(包括但不限于各种赔偿费、诉讼代理费及为此支出的其它合理费用)； 
4.4 当第三方认为用户发表或者上传于本站的信息侵犯其权利，并根据《信息网络传播权保护条例》或者相关法律规定向本站发送权利通知书时，用户同意本站可以自行判断决定删除涉嫌侵权信息，除非用户提交书面证据材料排除侵权的可能性，本站将不会自动恢复上述删除的信息；
(1)不得为任何非法目的而使用网络服务系统； 
(2)遵守所有与网络服务有关的网络协议、规定和程序； (3)不得利用本站进行任何可能对互联网的正常运转造成不利影响的行为； 
(4)不得利用本站进行任何不利于本站的行为。
4.5 如用户在使用网络服务时违反上述任何规定，本站有权要求用户改正或直接采取一切必要的措施(包括但不限于删除用户张贴的内容、暂停或终止用户使用网络服务的权利)以减轻用户不当行为而造成的影响。
五、隐私保护
5.1 本站不对外公开或向第三方提供单个用户的注册资料及用户在使用网络服务时存储在本站的非公开内容，但下列情况除外：
(1)事先获得用户的明确授权； 
(2)根据有关的法律法规要求；
(3)按照相关政府主管部门的要求；
(4)为维护社会公众的利益。
5.2 本站可能会与第三方合作向用户提供相关的网络服务，在此情况下，如该第三方同意承担与本站同等的保护用户隐私的责任，则本站有权将用户的注册资料等提供给该第三方。
5.3 在不透露单个用户隐私资料的前提下，本站有权对整个用户数据库进行分析并对用户数据库进行商业上的利用。
六、版权声明
6.1 本站的文字、图片、音频、视频等版权均归矿产链享有或与作者共同享有，未经本站许可，不得任意转载。 
6.2 本站特有的标识、版面设计、编排方式等版权均属矿产链享有，未经本站许可，不得任意复制或转载。 
6.3 使用本站的任何内容均应注明“来源于矿产链”及署上作者姓名，按法律规定需要支付稿酬的，应当通知本站及作者及支付稿酬，并独立承担一切法律责任。
6.4 本站享有所有作品用于其它用途的优先权，包括但不限于网站、电子杂志、平面出版等，但在使用前会通知作者，并按同行业的标准支付稿酬。
6.5 本站所有内容仅代表作者自己的立场和观点，与本站无关，由作者本人承担一切法律责任。 
6.6 恶意转载本站内容的，本站保留将其诉诸法律的权利。
七、责任声明
7.1 用户明确同意其使用本站网络服务所存在的风险及一切后果将完全由用户本人承担，矿产链对此不承担任何责任。 
7.2 本站无法保证网络服务一定能满足用户的要求，也不保证网络服务的及时性、安全性、准确性。 
7.3 本站不保证为方便用户而设置的外部链接的准确性和完整性，同时，对于该等外部链接指向的不由本站实际控制的任何网页上的内容，本站不承担任何责任。
7.4 对于因不可抗力或本站不能控制的原因造成的网络服务中断或其它缺陷，本站不承担任何责任，但将尽力减少因此而给用户造成的损失和影响。
7.5 对于站向用户提供的下列产品或者服务的质量缺陷本身及其引发的任何损失，本站无需承担任何责任：
(1)本站向用户免费提供的各项网络服务； 
(2)本站向用户赠送的任何产品或者服务。
7.6 本站有权于任何时间暂时或永久修改或终止本服务(或其任何部分)，而无论其通知与否，本站对用户和任何第三人均无需承担任何责任。
八、附则
8.1 本协议的订立、执行和解释及争议的解决均应适用中华人民共和国法律。 
8.2 如本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，本协议的其余条款仍应有效并且有约束力。
8.3 本协议解释权及修订权归矿产链所有。
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
	</script>
	<script>
	$(function(){
		$('#login_password').click(function(){
			var obj = $(this);
			obj.prop('disabled',true);
			var phone = $('#phone').val();
			var password = $('#password').val();
			
			var agree = $('#agree i').hasClass('active');
			if(!agree){
				layer.msg('请阅读并同意协议',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(phone == ''){
				layer.msg('手机号不能为空',{time:2000,icon:5});
				obj.prop('disabled',false);
				return false;
			}
			if(password == ''){
				layer.msg('登录密码不能为空',{time:2000,icon:5});
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
		
		$('#read').click(function(){
			//页面层
			layer.open({
			  type: 1,
			  title:'用户注册协议',
			  skin: 'layui-layer-rim', //加上边框
			  area: ['320px', '540px'], //宽高
			  content: $('#xieyi')
			});
		})
	})
	</script>
</html>