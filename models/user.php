<?php

class User extends AppModel
{
	var $name = "User";
	
	function accept($userlist)
	{
		foreach($userlist as $user => $accepted)
		{
			if ($accepted == 1)
			{
				$sql = "update users set accepted='1' where id='$user'";
				$this->execute($sql);
			}
		}
	}

	function reject($userlist)
	{
		foreach($userlist as $user => $accepted)
		{
			if ($accepted == 1)
			{
				$sql = "delete from users where id='$user'";
				$this->execute($sql);
			}
		}
	}
}

?>