<?php 
include 'classes/post.php';

class PostSeeder{
    public static function seed(){
        $post = new Post("Bob", "hi!");
    }
}
?>