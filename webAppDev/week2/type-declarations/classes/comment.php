<?php 
namespace wad;

class Comment{
  protected string $user;
  protected string $comment;

  //initialize variable
  function __construct($user, $comment){
    $this->user = $user;
    $this->comment = $comment;
  }

  // Handles return for user
  function getUser(){
    return $this->user;
  }

  // Handles return for comment
  function getComment(){
    return $this->comment;
  }
}
?>
