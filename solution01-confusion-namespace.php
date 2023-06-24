<?php

declare(strict_types=1);

namespace Forum;
class Message {}

namespace Messenger;

class Message {}

$forumMessage = new \Forum\Message;
$messengerMessage = new \Messenger\Message;
/*
* Erreur ici car le programme pense que DateTime
* est dans le namespace "Messenger".
* Or, ce n'est pas le cas.
* Pour résoudre ce problème, on ajoute un antislash
* pour préciser qu'on veut DateTime du code interne à PHP.
*/
$date = new \DateTime();

var_dump([
    'forum' => $forumMessage,
    'messenger' => $messengerMessage
]);
