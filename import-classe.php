<?php

declare(strict_types=1);

namespace Forum {
    class Message {}
}

namespace Messenger {
    class Message {}
}

/**
 * Encapsulation dans un namespace qui fait partie
 * du namespace global.
 */
namespace {
    use Forum\Message as ForumMessage;
    use Messenger\Message;

    $forumMessage = new ForumMessage;
    $messengerMessage = new Message;
    /*
    * Erreur ici car le programme pense que DateTime
    * est dans le namespace "Messenger".
    * Or, ce n'est pas le cas.
    * Pour résoudre ce problème, on peut "encapsuler" les
    * classes dans leur namepsaces avec des accolades.
    */
    $date = new DateTime();
    
    var_dump([
        'forum' => $forumMessage,
        'messenger' => $messengerMessage
    ]);
}    
