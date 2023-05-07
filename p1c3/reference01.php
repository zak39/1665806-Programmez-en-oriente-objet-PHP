<?php

// déclaration par référence avec le symbole &
function foo($var) {
    $var = 2;
}


$a=1;
foo ($a);
print($a . "\n");
// $a vaut toujours 1