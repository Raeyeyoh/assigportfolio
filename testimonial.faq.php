<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/new.css">

</head>
<body>
    <?php

include "db.php";
$o=new database();
 ?>
 <section id="testimonials">
        <h2>What my Clients Say</h2>
        <?php
        $testimonials = $o->connect()->query("SELECT * FROM testimonial");
        while ($testimonial = $testimonials->fetch_assoc()) {
            echo "<div class='testimonial'>";
            echo "<blockquote>{$testimonial['content']}</blockquote>";
            echo "<p>- {$testimonial['name']}</p>";
         
            echo "</div>";
        }
        ?> 
    </section>



    <br><br>
  <section id="faq">
        <h2>Frequently Asked Questions</h2>
        <?php
        $faqs = $o->connect()->query("SELECT * FROM faq");
        while ($faq = $faqs->fetch_assoc()) {
            echo "<div class='faq-item'>";
            echo "<h3>{$faq['question']}</h3>";
            echo "<p>{$faq['answer']}</p>";
            echo "</div>";
        }
        ?>
    </section>
   </body>
</html>