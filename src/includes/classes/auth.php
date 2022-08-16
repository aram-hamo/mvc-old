<?php

class auth extends db{

  public function register($username,$password,$email){

  $tokan = bin2hex(openssl_random_pseudo_bytes(16));
  $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
	$createUser = $this->conn->prepare("insert into users (username,password,email,verified,tokan) values (:username ,:password,:email,false,:tokan)");
	$createUser->bindValue(':username',$username);
	$createUser->bindValue(':email',$email);
	$createUser->bindValue(':password',$hashedPassword);
  $createUser->bindValue(':tokan',$tokan);
	if($createUser->execute()){
    setcookie("tokan",$tokan);
  }
  }

  public function login($username,$password){

  $stmt = $this->conn->prepare('select * from users where username=:username');
  $stmt->bindValue(':username',$username);
  $stmt->execute();
  $userData =  $stmt->fetchAll();
  $verify = password_verify($password,$userData[0]['password']);
  if($verify){
    setcookie("tokan",$userData[0]['tokan']);
  }
  return $verify;
  }
  public function loginCheck(){

  $stmt = $this->conn->prepare('select * from users where tokan=:tokan');
  $stmt->bindValue(':tokan',$_COOKIE['tokan']);
  $stmt->execute();
  return $stmt->fetchAll();
  }
}
