<?php
namespace wad;

use wad\Post;
use wad\Comment;

include 'post.php';
include 'comment.php';

class PostSeeder{
  public static function seed(){
    $posts = [];
    $image = '/../images/default.jpg';
    $posts[] = new Post("Bob", $image, "hi!", "8/11/2024");
    $posts[] = new Post("John", $image, "hello!", "8/11/2024");
    $posts[] = new Post("Fred", $image, "aye!", "8/11/2024");

    $posts[0] -> addComment("Bob", "Nice post!");
    $posts[0] -> addComment("Fred", "Yes!");
    $posts[1] -> addComment("Fred", "No!");

    return $posts;
  }
}
?>