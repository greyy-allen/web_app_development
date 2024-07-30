<?php 
    $posts = array();
    $posts[] = array(
        'name' => 'Bob',
        'message' => 'hello',
        'image' => 'images/default.jpg',
        'date' => '1/1/11'
    );
    $posts[] = array(
        'name' => 'John',
        'message' => "It's a good day",
        'image' => 'images/default.jpg',
        'date' => '1/2/11'
    );
    $posts[] = array(
        'name' => 'Fred',
        'message' => 'Sunny day',
        'image' => 'images/default.jpg',
        'date' => '3/5/16'
    );
    var_dump($posts);
?>