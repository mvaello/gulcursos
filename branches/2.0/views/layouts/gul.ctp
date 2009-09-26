<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Gesti&oacute;n de cursos de GUL-UC3M - <?php echo $title_for_layout=="Home"?"Entrada":$title_for_layout  ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php echo $html->css('style'); ?>
	<link rel="shortcut icon" href="/css/logo-gul.png" />
	<link rel="alternate" type="application/rss+xml" title="Feed RSS" href="<?php echo $html->url('/')?>lectures/rss" />	
</head>
<body>


<div id="header">
<!--
	<div id="staff-msg">
		Estamos de mantenimiento. Si algo no te funciona bien, espera unos minutillos y prueba otra vez.
	</div>
-->
	<div id="login">
		<?php 
			if ($session->check('User'))
			{
				$user = $session->read('User');
				echo "Usuario " . $user['username'] . " | " . $html->link("Salir", "/users/logout");
				
				if ($waitingusers > 0)
				{
					echo " | ";
					echo $html->link(" 	¡Hey! ¡Hay usuarios esperando a ser aceptados! ¡Échales un cable!", "/users/accept");
				}
			}
			else
			{
				echo $html->link("Login", "/users/login");
//				echo " | &iquest;No tienes cuenta?  " . $html->link("¡Hazte con una!", "/users/add");
			}
		?>		
	</div>
	<div id="navigation">
		<?php
			$out = $html->link("Entrada", "/");
			
			if (isset($navcourse))
			{
				$out .= " > " . $html->link("Todas las jornadas", "/courses");
				
				if ($navcourse != "index")
				{
					$out .= " > ";
					$out .= $html->link($navcourse['title'], "/courses/view/".$navcourse['id']);
				}
				
				if (isset($navlecture))
				{
					$out .= " > ";
					$out .= $html->link($navlecture['title'], "/lectures/view/".$navlecture['id']);					
				}
			}
			echo $out;
		?>
	</div>
</div>

<?php echo $content_for_layout ?>

<div id="footer">
	<p>
	(c) 2007 Grupo de Usuarios de Linux de la Universidad Carlos III de Madrid
	</p>
	<p>
		<?php echo $html->image("gul_project.gif",array('alt'=>"GUL project",'border'=>"0",'url'=>"http://www.gul.es")); ?>
		<?php echo $html->image("cake.power.png",array('alt'=>"CakePHP(tm) : Rapid Development Framework",'border'=>"0",'url'=>"http://www.cakephp.org")); ?>
	</p>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3477361-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
</body>
</html>
