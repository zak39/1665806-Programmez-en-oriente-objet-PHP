<?php

/**
 * Génère cette erreur :
 * 
 * PHP Fatal error:  Uncaught Error: Class "Domain\User\User" not
 * found in/home/zak/projects/1665806-Programmez-en-oriente-objet-PHP/index.php:11
*/
//require_once('Domain/Forum/Message.php');
//require_once('Domain/User/User.php');

/**
 * Mais nous pouvons résoudre ce problème en utilisant
 * le système d'autoload pour charger nos classes.
 * 
 * A noter que Composer rempli très bien ce rôle.
 */
spl_autoload_register(static function(string $fqcn) {
    // $fqcn contient Domain\Forum\Message
    // remplaçons les \ par des / et ajoutons .php à la fin.
    // on obtient Domain/Forum/Message.php
    $path = str_replace('\\', '/', $fqcn) . '.php';

    // puis chargeons le fichier
    require_once($path);
});

use Domain\Forum\Message;
use Domain\User\User;

$user = new User;
$user->name = 'Greg';

$forumMessage = new Message($user, 'J\'aime les pates.');

var_dump($forumMessage);
