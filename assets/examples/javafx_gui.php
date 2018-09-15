<?php
use php\gui\{ UXApplication, UXForm }; // import JavaFX classes from jphp-gui-ext

UXApplication::runLater(function () {
    $form = new UXForm(); // create new form
    $form->title = "Hello, World!!";
    $form->size = [300, 200];
    $form->show(); // show form
});