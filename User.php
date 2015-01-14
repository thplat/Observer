<?php

use Observer\Interfaces\Observable;

class User implements Observable {

	use Observer\Behavior\Observable;

	public function signUp()
	{
		echo "A user signed up";
		$this->notifyObservers('User Signed Up');
	}

}
