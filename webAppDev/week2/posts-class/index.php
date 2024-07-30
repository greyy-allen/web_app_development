<?php 
  include 'classes/post.php';
  $post = new Post("Bob", "hi!");
  var_dump($post->getUser());
  exit;
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