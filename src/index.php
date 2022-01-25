<?php

include(__DIR__.'/config.php');
include(__DIR__.'/includes/autoload.php');

if(!isset($_GET["url"])){
    include(__DIR__.'/views/'.$views['/'].'.php');

}elseif(isset($views['/'.$_GET["url"]])){
    include(__DIR__.'/views/'.$views['/'.$_GET["url"]].'.php');

}elseif(isset($views['/'.$_GET["url"].'/'])){
    include(__DIR__.'/views/'.$views['/'.$_GET["url"].'/'].'.php');
}else{
    header('Location: /');
}
