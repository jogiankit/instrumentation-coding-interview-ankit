<?php

/*
Number of workers (threads)
*/
$workers = 8;

/*
Array to store Future elements (thread handles)
*/
$futures = array();

/*
This function will be run in the threads.
*/
$producer = function(int $worker) {
    for($i = 0; $i < 1000; $i++) {
        sleep(0.1);
        SolarwindsIncrement(); // TODO implement
    }
};

SolarwindsReset(); // TODO implement

echo "Before: ".SolarwindsGetTotal()."\n"; // TODO implement

/*
Start new worker threads
*/
for($i = 0; $i < $workers; $i++) {
    $r = new \parallel\Runtime();
    $futures[$i] = $r->run($producer, array($i+1));
}

/*
Wait for workers to finish
*/
for($i = 0; $i < $workers; $i++) {
    $futures[$i]->value();
}

echo "After: ".SolarwindsGetTotal()."\n"; // TODO implement

?>
