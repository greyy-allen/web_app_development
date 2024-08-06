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
  // var_dump($posts);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Document</title>
  </head>

  <body>
    <div id="content">
      <h1>Social Media</h1>
      <?php foreach($posts as $post) { ?>
        <div id="post">
          <img src="<?= $post['image'] ?>" width="50" height="50" alt="user_image"><br>
          <?= $post['name'] ?><br>
          <?= $post['message'] ?><br>
          <?= $post['date'] ?><br>
        </div>
      <?php } ?>
    </div>
  </body>
</html>