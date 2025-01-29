<?php
include 'db.php';
$o=new database(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/new.css">
    <title>Home</title>
</head>
<body >
<div class="nav-links">
    <a href="about.php">About Us</a>
    <a href="index.php">Services</a>
    <a href="portfolioo.php">Portfolio</a>
    <a href="contact.php">Contact Us</a>
    <a href="blog.php">Blog</a>
    <a href="testimonial.faq.php">testimonial and FAQs</a>

</div>
    <section id="home">
        <h1>Welcome to My Portfolio</h1>
        
    </section>

    <section id="services">
        <h2>Our Services</h2>
        <?php
        $result = $o->connect()->query("SELECT * FROM services");
        while ($service = $result->fetch_assoc()) {
            echo "<div class='service'>";
            echo "<h3>" . $service['title'] . "</h3>";
            echo "<p>".$service['description']."</p>";
            echo "</div>";
        }
        ?>
    </section>

    
    
</section>

 <section id= "footer">
    <footer >
    <?php
        $foot = $o->connect()->query("SELECT * FROM footer");
        while ($fot = $foot->fetch_assoc()) {
            echo "<div class='footer-content'>";
            echo "<h6>{$fot['title']}</h6>";
            echo "<p>{$fot['content']}</p>";
          echo"<p>{$fot['date']}</p>";
         
            echo "</div>";
        }
        ?>
    </footer>
</body>
</html>