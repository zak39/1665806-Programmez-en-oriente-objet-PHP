<?php

require_once('./Admin.php');

$admin = new Admin('Lily');
$admin->printStatusFromParent();

Admin::nouvelleInitialisation();

var_dump([
    'Admin' => [
        'nombre_admins' => Admin::$nombreAdminInitialises,
        'nombre_utilisateurs' => Admin::$nombreUtilisateursInitialises,
    ],
    'User' => [
        'nombre_utilisateurs' => User::$nombreUtilisateursInitialises
    ]
]);

//var_dump(User::$nombreAdminInitialises); // ceci ne marche pas

// Affiche "L'administrateur Lily a pour status : active"
$admin->printCustomStatus();
print("\n");

/*
* prinStatus n'existe pas dans la classe Admin, 
* donc printStatus() de la classe User sera appelée
* grâce à l'héritage.
*/
$admin->printStatus();
print("\n");

$admin = new Admin('Paddington');
$admin->setStatus(Admin::STATUS_LOCKED);
print($admin->getStatus());
print("\n");
