<?php
include '../db.php'; 
$o=new database();
$id = "";
$title = "";
$description = "";
$image = "";
$link = "";

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $o->connect()->query("SELECT * FROM portfolio WHERE id=$edit_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $image = $row['image'];
        $link = $row['link'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $link = $_POST['link'];
        $o->connect()->query("INSERT INTO portfolio (title, description, image, link) VALUES ('$title', '$description', '$image', '$link')");
        header("Location: admin.portfolio.php");
        exit;
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $link = $_POST['link'];
        $o->connect()->query("UPDATE portfolio SET title='$title', description='$description', image='$image', link='$link' WHERE id=$id");
        header("Location: admin.portfolio.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        
        $id = $_POST['delete'];
        $o->connect()->query("DELETE FROM portfolio WHERE id=$id");
        header("Location: admin.portfolio.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - Portfolio Management</title>
</head>
<body>
    <h1>Manage Portfolio Projects</h1>

    
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $title; ?>" required>
        <label>Description:</label>
        <textarea name="description" required><?php echo $description; ?></textarea>
        <label>Image Path:</label>
        <input type="text" name="image" value="<?php echo $image; ?>" required>
        <label>Project Link:</label>
        <input type="text" name="link" value="<?php echo $link; ?>" required>
        
        <?php if ($id): ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="add">Add</button>
        <?php endif; ?>
    </form>

    <h2>Existing Portfolio Projects</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Link</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $o->connect()->query("SELECT * FROM portfolio");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td><img src='{$row['image']}' alt='Project Image' style='width:50px;'></td>";
            echo "<td><a href='{$row['link']}'>View Project</a></td>";
            echo "<td>
                <form method='GET' action='admin.portfolio.php' >
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
