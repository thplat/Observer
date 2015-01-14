<?php

namespace Observer\Interfaces;

interface Observable {

	public function addObserver( Observer $oberserver );
	public function notifyObservers( $type );
	public function queueObserverNotification( $type );

}