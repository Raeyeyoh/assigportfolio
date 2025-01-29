<?php
include 'db.php';
$o=new database();
$result = $o->connect()->query("SELECT * FROM contact ");
$contact = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/new.css">
    <title>Contact</title>
</head>
<body>
    <section id="contact">
        <h1>Contact Information</h1>
        
       
        <div class="contact-info">
            <p><strong>Email:</strong> <?php echo $contact['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $contact['phone']; ?></p>
            <p><strong>Address:</strong> <?php echo $contact['address']; ?></p>
        </div>
        
       
        <div class="social-media">
            <h2>Follow Me</h2>
            <a href="https://linkedin.com/in/<?php echo ($contact['linkedin']); ?>" target="_blank">LinkedIn</a>
            <a href="https://github.com/<?php echo $contact['github']; ?>" target="_blank">GitHub</a>
            </div>
    </section>
</body>
</html>
