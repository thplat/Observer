<?php

namespace Observer\Interfaces;

interface Observer {

	public function notifyObserver( Observable $observable, $type );

} 