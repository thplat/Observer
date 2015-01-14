<?php

use Observer\Interfaces\Observer;
use Observer\Interfaces\Observable;

class Mailer implements Observer {

	public function notifyObserver( Observable $user, $type )
	{
		echo "--- Mail Observer has been notified ---";
		var_dump($user);
	}

}