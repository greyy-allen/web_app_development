<?php 
  include 'classes/postSeeder.php';
  $posts = wad\PostSeeder::seed();
  $posts[0] -> addComment("Bob", "Nice post!");
  $posts[0] -> addComment("Fred", "Yes!");
  $posts[1] -> addComment("Fred", "No!");
  //var_dump($posts);
  //exit;
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
          <img src="<?= $post->getImage() ?>" alt="user_image" height="100" width="100"><br>
          <?= $post->getUser() ?>
          <?= $post->getMessage() ?> <br>
          <b>Comments:</b><br>
          <?php $comments = $post->getComment();
          foreach($comments as $comment) { ?>
            <?= $comment["user"]?> said <?= $comment["comment"] ?><br>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </body>
</html>