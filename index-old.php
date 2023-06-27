<?php

spl_autoload_register();

require_once('Domain/Forum/Message.php');
require_once('Domain/User/User.php');

use Domain\Forum\Message;
use Domain\User\User;

$user = new User;
$user->name = 'Greg';

$forumMessage = new Message($user, 'J\'aime les pates.');

var_dump($forumMessage);
