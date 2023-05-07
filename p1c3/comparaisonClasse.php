<?php

$dateUne = new DateTime();
$dateDeux = new DateTime();

$cloneInstanceDate = $dateUne->modify('+1 day'); // Ici $cloneInstanceDate est une référence à $dateUne


var_dump([
    '$dateUne == $cloneInstanceDate' => $dateUne == $cloneInstanceDate, // En classe on test si c'est la même valeur.
    '$dateUne === $cloneInstanceDate' => $dateUne === $cloneInstanceDate, // En classe on test si c'est la même instance.
    // Ici c'est normal, car $dateUne et $dateDeux ont des valeurs différentes.
    '$dateUne == $dateDeux' => $dateUne == $dateDeux,
    // Et ce n'est pas la même instance
    '$dateUne === $dateDeux' => $dateUne === $dateDeux,
]);