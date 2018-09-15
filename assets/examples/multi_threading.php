<?php

$thread = new Thread(function () {
    $i = 0;

    while (true) {
        $i++;
        echo $i, "\\n";

        sleep(2); // every 2 seconds
    }
});

$thread->start(); // start thread