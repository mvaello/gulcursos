<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Gesti&oacute;n de cursos de <?php echo $config['title']; ?> - <?php echo $title_for_layout=="Home"?"Entrada":$title_for_layout  ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php echo $html->css('corporateblue'); ?>
	<link rel="shortcut icon" href="/css/logo-gul.png" />
	<link rel="alternate" type="application/rss+xml" title="Feed RSS" href="<?php echo $html->url('/')?>lectures/rss" />	
</head>
<body>
	
<div id="wrap">
	<div id="header">
		 <div id="logo"><?php echo $html->link($config['title'],"/"); ?></div>
		 <div id="slogan"><?php __($config['subtitle']); ?></div>
		
		<div id="nav">
		<!-- the "active" class markes which link will be highlited-->	
			<ul>
				<?php if($myuser): ?>
					<li><?php echo $html->link(__('User',true).": {$myuser['User']['username']}",array('controller'=>'users','action'=>'view',$myuser['User']['id'])); ?></li>
					<li><?php echo $html->link(__('manage users',true),array('controller'=>'users','action'=>'index')); ?></li>
					<li><?php echo $html->link(__('logout',true),array('controller'=>'users','action'=>'logout')); ?></li>
				<?php else: ?>
					<li><?php echo $html->link(__('login',true),array('controller'=>'users','action'=>'login')); ?></li>
				<?php endif; ?>
			</ul>
		</div>

	<!--- header pic goes below. For each page save an 820px x 240px header picture in info/header-pics and then link to it-->
		<div id="header-pic">
			<?php echo $html->image("corporateblue-header.jpg"); ?>
		</div>

		<?php $crumb->add($breadcrumbs); echo $crumb->html(); ?>
		
	</div>
		
	<div id="content-wrap">
		<div id="content">
			<?php $session->flash(); ?>
			<?php echo $content_for_layout ?>
		</div>
	</div>
	
	
	<div id="footer">
		<div class='text'>(c) 2007 Grupo de Usuarios de Linux de la Universidad Carlos III de Madrid</div>
		<div class='icons'>
			<?php echo $html->image("gul_project.gif",array('alt'=>"GUL project",'border'=>"0",'url'=>"http://www.gul.es")); ?>
			<?php echo $html->image("cake.power.png",array('alt'=>"CakePHP(tm) : Rapid Development Framework",'border'=>"0",'url'=>"http://www.cakephp.org")); ?>
		</div>
	</div>
		
</div>
	
</body>
</html>
