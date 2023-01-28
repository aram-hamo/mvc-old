<?php

class auth extends db{

  public function register($firstName,$lastName,$username,$password,$email){

  $tokan = bin2hex(openssl_random_pseudo_bytes(16));
  $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
	$createUser = $this->conn->prepare("insert into users (firstName,lastName,username,password,email,verified,tokan) values (:firstName,:lastName,:username ,:password,:email,false,:tokan)");
	$createUser->bindValue(':firstName',$firstName);
	$createUser->bindValue(':lastName',$lastName);
	$createUser->bindValue(':username',$username);
	$createUser->bindValue(':email',$email);
	$createUser->bindValue(':password',$hashedPassword);
  $createUser->bindValue(':tokan',$tokan);
	if($createUser->execute()){
    setcookie("tokan",$tokan,time()+60*60*24*30,null,null,true,true);
  }
  }

  public function login($username,$password){

  $stmt = $this->conn->prepare('select * from users where username=:username');
  $stmt->bindValue(':username',$username);
  $stmt->execute();
  $userData =  $stmt->fetchAll();
  $verify = password_verify($password,$userData[0]['password']);
  if($verify){
    setcookie("tokan",$userData[0]['tokan'],time()+60*60*24*30,null,null,true,true);
  }
  return $verify;
  }
  public function tokanCheck(){
    if(isset($_COOKIE['tokan'])){
      $stmt = $this->conn->prepare('select * from users where tokan=:tokan');
      $stmt->bindValue(':tokan',$_COOKIE['tokan']);
      $stmt->execute();
      return $stmt->fetchAll();
    }
  }
}
