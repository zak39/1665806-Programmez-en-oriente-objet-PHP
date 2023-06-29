<?php

/**
 * Autoload les classes.
 */
spl_autoload_register(static function(string $fqcn) {
    $path = str_replace('\\', '/', $fqcn) . '.php';
    require_once($path);
});

use Domain\Display\MessagePrinter;
use Domain\Forum\Message;
use Domain\Notification\Message as Notification;
use Domain\User\User;

$user = new User;
$user->name = 'Greg';

$forumMessage = new Message($user, 'J\'aime les pates.');

$notification = new Notification($user, "Vous avez recu un message de $user->name");

$messagePrinter = new MessagePrinter();
$messagePrinter->printMessage($forumMessage);
$messagePrinter->printMessage($notification);
