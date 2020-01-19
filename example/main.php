<?php
/**
 * File: main.php
 * @author: Cvar1984 <gedzsarjuncomuniti@gmail.com>
 * Date: 19.01.2020
 * Last Modified Date: 19.01.2020
 * Last Modified By: Cvar1984 <gedzsarjuncomuniti@gmail.com>
 */

require '../vendor/autoload.php';

$input = $argv[1]; // assume user input
$npass = (new Cvar1984\Npass\Npass())
    ->setDataSheet('../assets/DirtyWords.csv') // datasheet
    ->getRecord()
    ->findWord($input);

$high = $npass->getHigh(); // get high percentage, return empty or string
$medium = $npass->getMid();
$low = $npass->getLow();

ob_start(); // capture the test
if(!empty($high)) {
    echo $input . ' high similarity to swear word => ' . $high;
}
if(!empty($mid)) {
    echo $input . ' medium similarity to swear word => ' . $mid; 
}
if(!empty($low)) {
    echo $input . ' low similarity to swear word => ' . $low;
}

$output = ob_get_clean();

if(!empty($output)) { // validate test
    echo $output;
}
else {
    echo 'You have passed the test';
}
echo PHP_EOL;
