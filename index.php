<?php

include 'vendor/autoload.php';

$user = new User();
$persistence = new Persistence();

$user->addObserver( $persistence );
$user->signUp();

echo "Doing Something else";

$user->flushObservers();