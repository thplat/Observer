<?php

namespace Observer\Behavior;

use Observer\Interfaces\Observer;

trait Observable {

	protected $observers = [];
	protected $observerQueue = [];

	/**
	 * Adds an observer to the observable
	 * @param Observer $observer [description]
	 */
	
	public function addObserver( Observer $observer )
	{
		$this->observers[] = $observer;
	}


	/**
	 * Removes an observer from the Observable
	 *
	 * @param Observer $observer
	 */
	
	public function removeObserver( Observer $observerToRemove )
	{
		for( $i = 0; $i < count($this->observers); $i++ )
		{
			if( $this->observers[$i] === $observerToRemove )
			{
				unset($this->observers[$i]);
			}

			$this->observers = array_values($this->observers);
		}
	}


	protected function queueObserverNotification( $type )
	{
		$this->observerQueue[] = $type;
	}

	/**
	 * Notifies all unqueued registered observers immediately
	 * @param string $action
	 */
	
	protected function notifyObservers( $type )
	{
		$this->callObservers($type);
	}


	/**
	 * Notifies observers in queue
	 * @param string $action
	 */
	
	public function flushObservers()
	{
		foreach( $this->observerQueue AS $type )
		{
			$this->callObservers($type);
		}
	}

	/**
	 * Actually calls notification method on
	 * a set of observers
	 * 
	 * @param  string $type
	 * @param  string $action
	 */
	protected function callObservers( $type )
	{
		foreach( $this->observers AS $observer )
		{
			$observer->notifyObserver($this, $type);
		}		
	}



}