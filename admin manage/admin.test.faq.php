<?php
include '../db.php'; 
$o=new database();
$testimonial_id = "";
$testimonial_name = "";
$testimonial_content = "";


$faq_id = "";
$faq_question = "";
$faq_answer = "";

if (isset($_GET['edit'])) {
    $edit_testimonial_id = $_GET['edit'];
    $result = $o->connect()->query("SELECT * FROM testimonial WHERE id=$edit_testimonial_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $testimonial_id = $row['id'];
        $testimonial_name = $row['name'];
        $testimonial_content = $row['content'];
      
    }
}

if (isset($_GET['edit'])) {
    $edit_faq_id = $_GET['edit'];
    $result = $o->connect()->query("SELECT * FROM faq WHERE id=$edit_faq_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $faq_id = $row['id'];
        $faq_question = $row['question'];
        $faq_answer = $row['answer'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_testimonial'])) {
        $testimonial_name = $_POST['testimonial_name'];
        $testimonial_content = $_POST['testimonial_content'];
      
        $o->connect()->query("INSERT INTO testimonial (name, content) VALUES ('$testimonial_name', '$testimonial_content' )");
        header("Location: admin.test.faq.php");
        exit;
    } elseif (isset($_POST['update_testimonial'])) {
        $testimonial_id = $_POST['testimonial_id'];
        $testimonial_name = $_POST['testimonial_name'];
        $testimonial_content = $_POST['testimonial_content'];
        
        $o->connect()->query("UPDATE testimonial SET name='$testimonial_name', content='$testimonial_content' WHERE id=$testimonial_id");
        header("Location: admin.test.faq.php");
        exit;
    } elseif (isset($_POST['delete'])) {
       
        $testimonial_id = $_POST['delete'];
        $o->connect()->query("DELETE FROM testimonial WHERE id=$testimonial_id");
        header("Location: admin.test.faq.php");
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_faq'])) {
    
        $faq_question = $_POST['faq_question'];
        $faq_answer = $_POST['faq_answer'];
        $o->connect()->query("INSERT INTO faq (question, answer) VALUES ('$faq_question', '$faq_answer')");
        header("Location: admin.test.faq.php");
        exit;
    } elseif (isset($_POST['update_faq'])) {
     
        $faq_id = $_POST['faq_id'];
        $faq_question = $_POST['faq_question'];
        $faq_answer = $_POST['faq_answer'];
        $o->connect()->query("UPDATE faq SET question='$faq_question', answer='$faq_answer' WHERE id=$faq_id");
        header("Location: admin.test.faq.php");
        exit;
    } elseif (isset($_POST['delete'])) {
      
        $faq_id = $_POST['delete'];
        $o->connect()->query("DELETE FROM faq WHERE id=$faq_id");
        header("Location: admin.test.faq.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - Testimonials & FAQs Management</title>
</head>
<body>
    <h1>Manage Testimonials</h1>

    
    <form method="POST">
        <input type="hidden" name="testimonial_id" value="<?php echo $testimonial_id; ?>"> 
        <label>Name:</label>
        <input type="text" name="testimonial_name" value="<?php echo $testimonial_name; ?>" required>
        <label>Content:</label>
        <textarea name="testimonial_content" required><?php echo $testimonial_content; ?></textarea>
        
        <?php if ($testimonial_id): ?>
            <button type="submit" name="update_testimonial">Update Testimonial</button>
        <?php else: ?>
            <button type="submit" name="add_testimonial">Add Testimonial</button>
        <?php endif; ?>
    </form>

    <h2>Existing Testimonials</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        <?php
        $result =$o->connect()->query("SELECT * FROM testimonial");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['content']}</td>";
            echo "<td>
                <form method='GET' action='admin.test.faq.php' >
                 <button type='submit' name='edit' value='{$row['id']}'>Edit</button>

                </form>
                <form method='POST' >
             <button type='submit' name='delete' value='{$row['id']}'>Delete</button>

                </form>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Manage FAQs</h1>

   
    <form method="POST">
        <input type="hidden" name="faq_id" value="<?php echo $faq_id; ?>">
        <label>Question:</label>
        <input type="text" name="faq_question" value="<?php echo $faq_question; ?>" required>
        <label>Answer:</label>
        <textarea name="faq_answer" required><?php echo $faq_answer; ?></textarea>
        
        <?php if ($faq_id): ?>
            <button type="submit" name="update_faq">Update FAQ</button>
        <?php else: ?>
            <button type="submit" name="add_faq">Add FAQ</button>
        <?php endif; ?>
    </form>

    <h2>Existing FAQs</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $o->connect()->query("SELECT * FROM faq");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['question']}</td>";
            echo "<td>{$row['answer']}</td>";
            echo "<td>
                <form method='GET' action='admin.test.faq.php' '>
          <button type='submit' name='edit' value='{$row['id']}'>Edit</button>
              </form>
                <form method='POST' >
     <button type='submit' name='delete' value='{$row['id']}'>Delete</button>

                </form>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
