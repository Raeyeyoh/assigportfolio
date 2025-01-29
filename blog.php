<?php
include 'db.php';
$o=new database();
$result = $o->connect()->query("SELECT * FROM blog");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/new.css">
    <title>Blog</title>
</head>
<body>
    <section id="blog">
        <h1>Latest Posts</h1>
        <?php while ($post = $result->fetch_assoc()) { ?>
            <div>
              <p><?php echo $post['title']; ?></p>
              <p><?php echo $post['content']; ?></p>
             <p><?php echo $post['author']; ?></p>
                
            </div>
        <?php } ?>
    </section>
</body>
</html>
