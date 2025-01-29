<?php
include '../db.php'; 
$o=new database();

$id = "";
$title = "";
$content = "";
$img = "";


if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $o->connect()->query("SELECT * FROM about WHERE id=$edit_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
        $img = $row['img'];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
       
        $title = $_POST['title'];
        $content = $_POST['content'];
        $img = $_POST['img'];
        $o->connect()->query("INSERT INTO about (title, content, img) VALUES ('$title', '$content', '$img')");
        header("Location: admin.about.php");
        exit;
    } elseif (isset($_POST['update'])) {
        
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $img = $_POST['img'];
        $o->connect()->query("UPDATE about SET title='$title', content='$content', img='$img' WHERE id=$id");
        header("Location: admin.about.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete']; 
        $o->connect()->query("DELETE FROM about WHERE id=$id");
        header("Location: admin.about.php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - About Section</title>
</head>
<body>
    <h1>Manage About Section</h1>

   
    <form method="POST">
   
    <input type="hidden" name="id" value="<?php echo ($id); ?>">

    <label>Title:</label>
    <input type="text" name="title" value="<?php echo ($title); ?>" required>

    <label>Content:</label>
    <textarea name="content" required><?php echo ($content); ?></textarea>

    <label>Image Path:</label>
    <input type="text" name="img" value="<?php echo ($img); ?>" required>

    <?php if ($id==true): ?>
        <button type="submit" name="update">Update</button>
    <?php else: ?>
        <button type="submit" name="add">Add</button>
    <?php endif; ?>
</form>


    <h2>Existing Records</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        $result =$o->connect()->query("SELECT * FROM about");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['content']}</td>";
            echo "<td><img src='{$row['img']}' alt='Image' ></td>";
            echo "<td>
                <form method='GET' action='admin.about.php' '>
                    <button type='submit' name='edit' value='{$row['id']}'>Edit</button>
                </form>
                <form method='POST'>
              <button type='submit' name='delete' value='{$row['id']}'>Delete</button>

               </form>

            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
