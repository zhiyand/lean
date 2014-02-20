<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<?php $theme_url = get_bloginfo('template_url');?>

	<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
	<!-- 
<div id="header">
	<div class="cnt">
		<a id="brand" href="<?php bloginfo('url');?>"><?php echo bloginfo('name');?></a>
	</div>
</div>
		-->
<div id="wrap">
	<div id="main">
