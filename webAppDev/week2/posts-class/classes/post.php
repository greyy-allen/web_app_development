<?php
class Post{
  protected $user;
  protected $message;

  function __construct($user, $message){
    $this->user = $user;
    $this->message = $message;
  }

  function getUser(){
    return $this->user;
  }

  function getMessage(){
    return $this->message;
  }
}
?>
