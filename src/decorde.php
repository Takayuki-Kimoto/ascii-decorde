<?php

$inputFile = $argv[1];
if (null == $inputFile || !file_exists($inputFile)) {
    echo 'ファイルを指定して下さい', PHP_EOL;
    exit(1);
}

$outputfile = __DIR__ . '/../output.txt';

$decordeList = [
    '%20' => ' ',
    '%21' => '!',
    '%22' => '"',
    '%23' => '#',
    '%24' => '$',
    '%25' => '%',
    '%26' => '&',
    '%27' => '\'',
    '%28' => '(',
    '%29' => ')',
    '%2A' => '*',
    '%2B' => '+',
    '%2C' => ',',
    '%2F' => '/',
    '%3A' => ':',
    '%3B' => ';',
    '%3C' => '<',
    '%3D' => '=',
    '%3E' => '>',
    '%3F' => '?',
    '%40' => '@',
    '%5B' => '[',
    '%5D' => ']',
    '%5E' => '^',
    '%60' => '`',
    '%7B' => '{',
    '%7C' => '|',
    '%7D' => '}',
    '%7E' => '~'
];

$lines = file($inputFile);
$result = [];
foreach ($lines as $line) {
    if ($line == null || trim($line) == '') continue;
    foreach ($decordeList as $key => $val) {
        $lowerkey = strtolower($key);
        $line = str_replace($key, $val, $line);
        if ($key !== $lowerkey) {
            $line = str_replace($lowerkey, $val, $line);
        }
    }
    $line = urldecode($line);
    $result[] = $line;
}

file_put_contents($outputfile, implode("\n", $result));

exit(0);
