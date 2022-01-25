<?php

spl_autoload_register('autoLoader');

function autoLoader ($className) {
    $path = $_SERVER['DOCUMENT_ROOT'].installDir.'/includes/classes/'.$className.'.php';
    include $path;
}
