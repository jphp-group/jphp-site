<?php

use php\lib\str;

// Unicode like in Java, UTF-16

// (from japan) programing language
$str = "プログラミング言語";

// Get length of the unicode string
echo str::length($str);

// Change symbol by index
$str[1] = '語';

echo $str;