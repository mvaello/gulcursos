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
	
		function add($links)   {
			foreach($links as $link){
				$limiter="";
				if($this->buffer){
					$limiter = " >> ";
				}
		
				if(!empty($link[1])):
					$this->buffer[] = $limiter . $this->Html->link($link[0], $link[1]);
				else:
					$this->buffer[] = $limiter . $link[0];
				endif;
			}
			
			return true;
		}
		
		function html() {
			foreach($this->buffer as $links):
				$this->str .= $links;
			endforeach;
			
			$this->str = "<div id='breadcrumbs'><span>".$this->str."</span></div>";
			return $this->output($this->str);
		}
	}
?>
