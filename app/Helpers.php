<?php
/*
 * THIS LOADS ALL HELPER PHP FILES FROM 'Helpers' DIRECTORY
 * php composer.phar dump-autoload; -this needs to be run to activate helper files
 */
$files = glob(__DIR__ . '/Helpers/*.php');
if ($files === false) {
    throw new RuntimeException("Failed to glob for helper files");
}

foreach ($files as $file) {
    require_once $file;
}
unset($file);
unset($files);
?>
