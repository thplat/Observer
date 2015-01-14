<?php

include 'vendor/autoload.php';

$user = new User();
$persistence = new Persistence();
$mailer = new Mailer();


$user->addObserver( $persistence );
$user->addObserver( $mailer );
$user->removeObserver( $persistence );
$user->signUp();

echo "Doing Something else";