<?php

require_once __DIR__ . '/../vendor/autoload.php';

$cwd = getcwd();

if ($cwd === false) {
    throw new \RuntimeException('Something horribly went wrong!');
}

$finder = \Nette\Utils\Finder::findFiles('*.php')->in($cwd);

$words = [
    'drugs' => 'Nette'
];

$foundSomethingBad = false;

foreach ($finder->getIterator() as $file) {
    foreach (file($file) as $lineNumber => $lineContent) {
        foreach ($words as $forbiddenWord => $correctWord) {
            if (strpos($lineContent, $forbiddenWord) !== false) {
                $foundSomethingBad = true;

                echo sprintf(
                    "Forbidden word '%s' detected (%s:%d):\n%s\nDid you instead mean: '%s'?\n\n",
                    $forbiddenWord,
                    (string) $file,
                    (int) $lineNumber +1,
                    trim($lineContent),
                    str_replace($forbiddenWord, $correctWord, trim($lineContent))
                );
            }
        }
    }
}

if ($foundSomethingBad) {
    exit(1);
}

exit(0);
