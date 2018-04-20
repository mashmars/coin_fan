<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <title><?php echo ($config["title"]); ?></title>
    <link rel="stylesheet" href="<?php echo (PUB_CSS); ?>reset.css" />
    <link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css" />
    <link rel="stylesheet" href="<?php echo (PUB_CSS); ?>style.css" />
    <!--[if lte IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style='zoom:0.7'>
	<div class="navbar">
		<div class="w"  style='width:925px;'><a href="http://www.gada.org.cn/" class="logo"><img  src="<?php echo (UP_SYSTEM); echo ($config["logo"]); ?>"/></a></div>
	</div>
	<!--banner-->
    <link rel="stylesheet" href="<?php echo (PUB_CSS); ?>swiper.min.css" />
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="#" style="background: url(<?php echo (PUB_IMG); ?>banner.jpg) no-repeat center"></a></div>
           
        </div>
        <!--查询-->
		<div class="login">
            <h2>二手车鉴定评估师信息查询系统</h2>
            <h5>Information inquiry system of used vehicle appraiser and appraiser</h5>
                <form  id='Info' action="<?php echo U('index/certificate');?>" method="post" target='_blank'>
                <div class="form-item clearfix">
                    <label>姓名:</label>
                    <input type="text" id="firstname" name='realname' placeholder="请输入名字" valid="valid">
                </div>
                <div class="form-item clearfix">
                    <label>身份证号:</label>
                    <input type="text" id="Identification" name='idcard' placeholder="请输入身份证号" valid="valid">
                </div>
                <div class="form-item clearfix">
                    <label>证书编号:</label>
                    <input type="text" id="certificate" name='zsbh' placeholder="请输入证书编号" valid="valid">
                </div>
                <div class="form-button">
                    <button type="button" id='query' >查询</button>
                </div>
                <p>注：任意输入以上两项即可查询</p>
            </form>
        </div>
    </div>

    <div class="head1">
        <h3>招贤纳士</h3>
        <h4>RECRUIMENT POSITION</h4>
    </div>
    <div class="position w" style='width:900px;'>
        <ul>
            <?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$job): $mod = ($i % 2 );++$i;?><li class="text-ellipsis">
				<a href="<?php echo U('index/detail',array('id'=>$job['id']));?>"><?php echo ($job["title"]); ?></a>
			 </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <a href="<?php echo U('index/job');?>" class="more">查看更多</a>
    </div>
    <footer>
        <div class="w">
            <p class="bq">Copyright@<?php echo ($config["copyright"]); ?></p>
            <p>联系我们：<?php echo ($config["address"]); ?>.电话:<?php echo ($config["tel"]); ?>.传真:<?php echo ($config["fax"]); ?></p>
        </div>
    </footer>

<script type="text/javascript" src="<?php echo (PUB_JS); ?>jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo (PUB_JS); ?>swiper.min.js"></script>
<script>
	/*var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		spaceBetween: 0,
		centeredSlides: true,
		autoplay: 5000,
		autoplayDisableOnInteraction : false
	});*/
</script>
<script type="text/javascript">
/*
验证表单，至少输入*个查询条件；
strFormId为表单Id，nMinValid为需要的条件个数；
在有效标签加入valid="valid"属性。
*/
function checkFormValid(strFormId, nMinValid)
{
	var objForm = document.getElementById(strFormId);
	var arrayFormChilds = objForm.getElementsByTagName("input");
	var nValid = 0;

	for (var n = 0; n < arrayFormChilds.length; n++)
	{   
		if (arrayFormChilds[n].getAttribute("valid"))
		{
			if (arrayFormChilds[n].value.length > 0)
			{
				nValid++;
			}
		}
	}

	if (nValid < nMinValid)
	{
		window.alert("请至少输入" + nMinValid + "个查询条件！");
		return false;
	}
	return true;
}
$(function(){
	$('#query').click(function(){
		var d = checkFormValid('Info', 2);		
		if(d){ 
			$('#Info').submit();
		}
	});
})
</script>
</body>
</html>