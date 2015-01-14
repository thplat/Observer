<?php

include 'vendor/autoload.php';

$mailer = new Mailer();

$user = new User();

$user->addObserver( $mailer );
$user->removeObserver( $mailer );
$user->signUp();