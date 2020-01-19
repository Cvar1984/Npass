<?php
/**
 * File: main.php
 * @author: Cvar1984 <gedzsarjuncomuniti@gmail.com>
 * Date: 19.01.2020
 * Last Modified Date: 20.01.2020
 * Last Modified By: Cvar1984 <gedzsarjuncomuniti@gmail.com>
 */

require '../vendor/autoload.php';

$input = $argv[1]; // assume user input
$depth = $argv[2];

$npass = (new Cvar1984\Npass\Npass())
    ->setDataSheet('../assets/DirtyWords.csv') // datasheet
    ->getRecord()
    ->findWord($input, $depth); // sentence, depth result

$high = $npass->getHigh(); // get high percentage, return empty or array
$medium = $npass->getMid();
$low = $npass->getLow();

ob_start(); // capture everything on the test
if (!empty($high)) {
    $high = implode(', ', $high);
    echo $input . ' high similarity to swear word => ' . $high;
}
if (!empty($mid)) {
    $medium = implode(', ', $medium);
    echo $input . ' medium similarity to swear word => ' . $mid;
}
if (!empty($low)) {
    $low = implode(', ', $low);
    echo $input . ' low similarity to swear word => ' . $low;
}

$output = ob_get_clean();

if (!empty($output)) {
    // validate test
    echo $output;
} else {
    echo 'You have passed the test';
}
echo PHP_EOL;
