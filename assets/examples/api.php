<?php

use php\io\Stream;
use php\lib\str;
use php\util\Flow;
use php\util\Regex;

str::shuffle($str); // New API for primitive types

// API for Streams instead of fopen, fclose, etc.
Stream::getContents('path/to/file');

// API for regex instead of preg_*
$valid = Regex::match('^[a-z]+$', $str);

// Flow API for iterators and arrays
echo Flow::of([1, 2, 3])
    ->map(function($n) { return $n * 10; })
    ->reduce(function(&$r, $n) { $r += $n; });