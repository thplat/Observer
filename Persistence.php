<?php

use Observer\Interfaces\Observer;
use Observer\Interfaces\Observable;

class Persistence implements Observer {

	public function notifyObserver( Observable $user, $type )
	{
		echo "--- Persistence Observer has been notified ---";
		var_dump($user);
	}

}