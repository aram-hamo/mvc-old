<?php

class db{
    public $conn;
    function __construct(){

        $this->conn = new PDO("sqlite:/".$_SERVER['DOCUMENT_ROOT'].installDir."/db.sqlite");
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
}

