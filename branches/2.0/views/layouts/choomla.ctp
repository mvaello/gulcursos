<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Gesti&oacute;n de cursos de GUL-UC3M - <?php echo $title_for_layout=="Home"?"Entrada":$title_for_layout  ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php echo $html->css('choomla/choomla'); ?>
	<link rel="shortcut icon" href="/css/logo-gul.png" />
	<link rel="alternate" type="application/rss+xml" title="Feed RSS" href="<?php echo $html->url('/')?>lectures/rss" />	
</head>
<body>
	
	<div id="all">

		<div id="header">
			<!--[if lte IE 6]>
				<a href="/" style="font-size:200%">
				GUL UC3M
				</a>
			<![endif]-->
				
			<h1 id="logo">
				<?php echo $html->image("choomla/logo.png",array('alt'=>"Logo GUL UC3M", 'url'=>array('controller'=>'pages','action'=>'home'))); ?>
			</h1>

			<div id="logindiv">
				<ul id='login'>
					<?php if($user): ?>
						<li><?php echo __('User',true).": {$user['User']['username']}"; ?></li>
						<li><?php echo $html->link(__('manage users',true),array('controller'=>'users','action'=>'index')); ?></li>
						<li><?php echo $html->link(__('logout',true),array('controller'=>'users','action'=>'logout')); ?></li>
					<?php else: ?>
						<li><?php echo $html->link(__('login',true),array('controller'=>'users','action'=>'login')); ?></li>
					<?php endif; ?>
				</ul>
			</div>

			<h2 class="unseen"> Search, View and Navigation			</h2> 

			<div id=fortunes>
			</div>
			<!-- Esto estaba abajo, pero creo que aqui queda mejor, cuando se retoque -->
			<div id="fontsize">
				<p class="syndicate">
					<a href="/index.php?format=feed&amp;type=rss"><img src="/images/M_images/livemarks.png" alt="feed-image"  /> <span>RSS</span></a> 
				</p>
			</div>

			<?php $crumb->add($breadcrumbs); echo $crumb->html(); ?>
			
			<div class="wrap">&nbsp;</div>
		</div><!-- end header -->


		<div id="contentarea2"> 
			<?php echo $content_for_layout ?>
		</div>
	<!--sfarsit sidebar-->				
	
	
	<div id="footer">
		<div class='text'>(c) 2007 Grupo de Usuarios de Linux de la Universidad Carlos III de Madrid</div>
		<div class='icons'>
			<?php echo $html->image("gul_project.gif",array('alt'=>"GUL project",'border'=>"0",'url'=>"http://www.gul.es")); ?>
			<?php echo $html->image("cake.power.png",array('alt'=>"CakePHP(tm) : Rapid Development Framework",'border'=>"0",'url'=>"http://www.cakephp.org")); ?>
		</div>

		<div class="wrap"></div>
	</div><!-- footer -->
</div>
	
</body>
</html>
