<?php
	/*
	@desc: Helper for BreadCrumb
	@idea: Marie Anne Mertens <mmertens@atobiz.com>
	@developer: Fabian Ramirez <framirez@atobiz.com>
	@demo in the view:
	$crumb->add('News', '/admin/news); // With URL
	$crumb->add('Edit'); // Without URL
	echo $crumb->html();
	*/
	
	class CrumbHelper extends Helper
	{
		var $helpers = array('Html');
		var $buffer;   // Array
		var $str;       // String
		
		function CrumbHelper() { // Metodo constructor
			$this->buffer[] = "<div id='breadcumb'><img src='/img/cms/home.gif' border='0'><a href='/admin/admins/menu'>Home</a>";
		}
	
		function add($titulo, $url=null)   {
			if(!empty($url)):
				$this->buffer[] = " >> " . $this->Html->link($titulo, $url);
			else:
				$this->buffer[] = " >> " . $titulo;
			endif;
			
			return true;
		}
		
		function html() {
			foreach($this->buffer as $links):
				$this->str .= $links;
			endforeach;
			
			$this->str .= "</div>";
			return $this->output($this->str);
		}
	}
?>
