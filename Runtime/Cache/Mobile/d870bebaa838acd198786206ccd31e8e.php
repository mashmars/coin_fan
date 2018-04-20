<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,
                                     maximum-scale=1.0,
                                     user-scalable=no">
    <title><?php echo ($config["title"]); ?></title>
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo (PUB_CSS); ?>bootstrap.css"/>
    
</head>
<body>

    <div class="hearder">
        <div class="logo">
            <a href="http://www.gada.org.cn/"><img src="<?php echo (UP_SYSTEM); echo ($config["logo"]); ?>"></a>
        </div>
    </div>
    <!--logo结束-->
    <div class="banner">
        <img src="<?php echo (UP_SYSTEM); echo ($config["banner"]); ?>">
    </div>
<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>style.css">

    <div class="enquiries_box">
        <div style="background: #337ab7;height: 50px;" class="hidden-xs"></div>
		<form class="form-horizontal" role="form" id='Info' action="<?php echo U('index/certificate');?>" method="post" target='_blank'>
            <div class="form-group namestyle">
                <label for="firstname" class="col-xs-4 col-sm-2 col-md-2 col-lg-2 control-label">
                    <p>姓名:</p>
                </label>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <input type="text" class="form-control" id="firstname" name='realname' placeholder="请输入名字" valid="valid">
                </div>
            </div>
            <div class="form-group">
                <label for="Identification" class="col-xs-4 col-sm-2 col-md-2 col-lg-2 control-label">
                    <p>身份证号：</p>
                </label>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <input type="text" class="form-control" id="Identification" name='idcard' placeholder="请输入身份证号" valid="valid">
                </div>
            </div>
            <div class="form-group">
                <label for="certificate" class="col-xs-4 col-sm-2 col-md-2 col-lg-2 control-label">
                    <p>证书编号：</p>
                </label>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                    <input type="text" class="form-control" id="certificate" name='zsbh' placeholder="请输入证书编号" valid="valid">
                </div>
            </div>
            <div class="form-group">
                <p class="zhushi">注：任意输入以上两项即可查询</p>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2">
                    <button type="button" id='query' class="btn btn-default">
                        <a  target="_blank" style="text-decoration: none;color: #000;">查询</a>
                    </button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="zhaopin">
        <div class="zhaopin_box">
            <div class="zhaopin_title">
                 <h2 class="hidden-xs">招贤纳士</h2>
            </div>
            <div class="gengduo">
                <p><a href="<?php echo U('index/job');?>">更多>></a></p>
                <div class="clearfix"></div>
            </div>
            <ol>
				<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$job): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('index/detail',array('id'=>$job['id']));?>"><?php echo ($job["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
             </ol>
            
            <div class="clearfix"></div>
        </div>
    </div>
    <!--招聘结束-->
 
 <div class="footer">
        <p>Copyright@<?php echo ($config["copyright"]); ?></p>
        <p>联系我们：<?php echo ($config["address"]); ?>.电话:<?php echo ($config["tel"]); ?>.传真:<?php echo ($config["fax"]); ?></p>
    </div>
    <script src="<?php echo (PUB_JS); ?>jquery-3.1.1.min.js"></script>
    <script src="<?php echo (PUB_JS); ?>bootstrap.min.js"></script>
</body>
</html>

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