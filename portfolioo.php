<?php
include 'db.php';
$o=new database();
$result = $o->connect()->query("SELECT * FROM portfolio");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/new.css"> 
    <title>Portfolio</title>
</head>
<body>
    <section id="portfolio">
        <?php while ($project = $result->fetch_assoc()) { ?>
            <div class="project">
                <h2><?php echo $project['title']; ?></h2>
                <p><?php echo $project['description']; ?></p>
                <img id="show" src="<?php echo $project['image']; ?>" alt="Project Image">
                <a href="<?php echo $project['link']; ?>">View Project</a>
            </div>
        <?php } ?>
    </section>
</body>
</html>
