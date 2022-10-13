<?php

define('installDir','');
define('rootURL',$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].installDir);

$forcessl=true;
$debug=false;

$views = array(
    '/'=>'welcome'
);
