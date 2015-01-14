# Observer
An implementation of the Observer-Pattern in PHP which makes use of Traits.
It currently supports queued observer notifications.

## Usage

* [Adding Observers](#adding-observers)
* [Removing Observers](#removing-observers)
* [Notifying Observers](#notifying-observers)
* [Handling Observables](#handling-observables)
* [Queued Observer Notification](#queued-observer-notifications)
* [To-Do](#to-do)

### Adding Observers

Basically the observer pattern introduces two components. The *Subject* and the *Observers*. 
The Subject registers one ore more Observers and notifies them about it's internal events.

To add an Observer to a Subject (or Observable), the Observable needs to implement the
`Observer\Interfaces\Observable` Interface. Once that is done an Observer can be registered
through the `addObserver()` method on an Observable.

An Observer needs to implement the `Observer\Interfaces\Observer` interface in order to be
able to be registered to an Observable.

```php
$user = new User();
$mailer = new Mailer();

$user->addObserver( $mailer );
```

### Removing Observers

Observers can be as easily removed as they can be added through a call to `removeObserver()`

```php
<?php

$mailer = new Mailer();

$user = new User();

$user->addObserver( $mailer );
$user->removeObserver( $mailer );
$user->signUp();
```



### Notifying Observers

Once at least one Observer has been registered to an Observable you can start notifying
the Observers. Therefore the `notifyObservers()` method is to be used on the Observable.
All Observers will be notified. A string (*will be changed in the future*) is passed to 
the method that indicates what type of event happened in the Observable.

```php
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
``` 

### Handling Observables

To be able to be notified by an Observable, an Observer has to implement the `Observer\Interfaces\Observer` interface
and implement the `notifyObserver()` method. It receives the Observable as first argument, and the event type as second
argument. **Only objects that implement the Observable interface can be handled by the `notifyObserver()` method**.

```php
<?php

use Observer\Interfaces\Observer;
use Observer\Interfaces\Observable;

class Mailer implements Observer {

	public function notifyObserver( Observable $user, $type )
	{
		echo "E-Mail some welcome message to the user";
	}

}
```

### Queued Observer Notifications

Observers can be only notified from within an Observable. However instead of immediately notifying all Observers
the notifications can be queued. They can then be flushed at a later point of script execution from the outside environment.

To register a queued notification the `queueObserverNotification` may be called on an Observable.

```php
<?php

use Observer\Interfaces\Observable;

class User implements Observable {

	use Observer\Behavior\Observable;

	public function signUp()
	{
		echo "A user signed up";
		$this->queueObserverNotification('User Signed Up');
	}

}
```

In order to release the queue and notify all Observers you may call the `flushObservers()` method
on the Observable.

```php
$user = new User();
$mailer = new Mailer();

$user->addObserver( $mailer );
$user->signUp();

echo "Doing Something else";

$user->flushObservers();
```

### To-Do

* Add dedicated methods to Observers to only receive relevant event types from Observables
* Add support to remove observers
* Instead of passing Strings as event types there should be dedicated objects for that
* Remove example scripts and add requirements to composer.json
