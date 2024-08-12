<?php
namespace wad;

use wad\Comment;

//Class Post for post object instance creation
class Post{
  protected $user;
  protected $image;
  protected $message;
  protected $date;
  protected $comments;

  function __construct($user, $image, $message, $date){
    $this->user = $user;
    $this->image = $image;
    $this->message = $message;
    $this->date = $date;
    $this->comments = [];
  }

  // Handles return for user
  function getUser(){
    return $this->user;
  }

  // Handles return for image
  function getImage(){
    return $this->image;
  }

  // Handles return for message
  function getMessage(){
    return $this->message;
  }

  // Handles return for date
  function getDate(){
    return $this->date;
  }

  // Handles return for comments
  function getComments(){
    return $this->comments;
  }

  // Since comment is allowed to be 0, comments is added through this function
  function addComment($user, $comment){
    $this->comments[] = new Comment($user, $comment);
  }
}
?>
