
<?php
include 'db.php';
$o = new Database();
$result = $o->connect()->query("SELECT * FROM about");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/new.css">
    <title>About</title>
</head>
<body>
    <section id="about">
        <?php
        while ($about = $result->fetch_assoc()) {
            echo "<h1>{$about['title']}</h1>";
            echo "<p>{$about['content']}</p>";
            echo "<img src='{$about['img']}' alt='About, vision future Image'>";
        }
        ?>
    </section>
</body>
</html>
