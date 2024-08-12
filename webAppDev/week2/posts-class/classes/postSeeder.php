<?php
namespace wad;
use wad\Post; 
include 'post.php';

class PostSeeder{
    public static function seed(){
        $posts = [];
        $image = '/../images/default.jpg';
        $posts[] = new Post("Bob", $image, "hi!", 8/11/2024);
        $posts[] = new Post("John", $image, "hello!", 8/11/2024);
        $posts[] = new Post("Fred", $image, "aye!", 8/11/2024);
        return $posts;
    }
}
?>