<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>团队分析</title>

<!--图标样式-->
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_LIB); ?>tree/css/bootstrap.min.css" />

<!--主要样式-->
<link rel="stylesheet" type="text/css" href="<?php echo (PUB_LIB); ?>tree/css/style.css" />

<script type="text/javascript" src="<?php echo (PUB_LIB); ?>tree/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(function(){
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});
</script>

</head>
<body>

<div class="tree well">
<ul>
	<li>
		<!--<span><i class="icon-folder-open"></i> Parent</span>
		<ul>
			<li>
				<span><i class="icon-leaf"></i> Grand Child</span>
			</li>
			<li>
				<span><i class="icon-minus-sign"></i> Child</span>
				<ul>
					<li>
						<span><i class="icon-leaf"></i> Grand Child</span>
					</li>
				</ul>
			</li>
		</ul>	
		-->
		<?php echo ($html); ?>
	</li>
</ul>
</div>
</body>
</html>