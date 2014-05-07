<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<?php $theme_url = get_template_directory_uri();?>

	<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
	<!-- 
<div id="header">
	<div class="cnt">
		<a id="brand" href="<?php echo home_url();?>"><?php echo bloginfo('name');?></a>
	</div>
</div>
		-->
<div id="wrap">
	<div id="main">
