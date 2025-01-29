<?php
include '../db.php'; 
$o= new database();
$id = "";
$title = "";
$content = "";
$author = "";

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $o->connect()->query("SELECT * FROM blog WHERE id=$edit_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $title = $row['title'];
        $content = $row['content'];
        $author = $row['author'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
        $o->connect()->query("INSERT INTO blog (title, content, author) VALUES ('$title', '$content', '$author')");
        
        header("Location: admin.blog.php");
        exit;
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
        $o->connect()->query("UPDATE blog SET title='$title', content='$content', author='$author' WHERE id=$id");
        
        header("Location: admin.blog.php");
        exit;
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $o->connect()->query("DELETE FROM blog WHERE id=$id");
        
        header("Location: admin.blog.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - Blog Management</title>
</head>
<body>
    <h1>Manage Blog Posts</h1>

  
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $title; ?>" required>
        <label>Content:</label>
        <textarea name="content" required><?php echo $content; ?></textarea>
        <label>Author:</label>
        <input type="text" name="author" value="<?php echo $author; ?>" required>
        <?php if ($id): ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="add">Add</button>
        <?php endif; ?>
    </form>

    <h2>Existing Blog Posts</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Author</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $o->connect()->query("SELECT * FROM blog");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['content']}</td>";
            echo "<td>{$row['author']}</td>";
            echo "<td>
                <form method='GET' action='admin.blog.php' style='display:inline;'>
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