<?php

class auth extends db{

  public function register($username,$password,$email){
    
  $hashedPassword = password_hash($password,PASSWORD_BCRYPT);
	$createUser = $this->conn->prepare("insert into users (username,password,email,verified) values (:username ,:password,:email,false)");
	$createUser->bindValue(':username',$username);
	$createUser->bindValue(':email',$email);
	$createUser->bindValue(':password',$hashedPassword);
	$createUser->execute();

  }

  public function login($username,$password){

  $stmt = $this->conn->prepare('select * from users where username=:username');
  $stmt->bindValue(':username',$username);
  $stmt->execute();
  $userData =  $stmt->fetchAll();
  return password_verify($password,$userData[0]['password']);

  }
}
