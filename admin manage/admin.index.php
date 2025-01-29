<?php
include '../db.php'; 
$o=new database();
$service_id = "";
$service_title = "";
$service_description = "";

$footer_id = "";
$footer_title = "";
$footer_content = "";
$footer_date = "";

if (isset($_GET['edit_service'])) {
    $edit_service_id = $_GET['edit_service'];
    $result = $o->connect()->query("SELECT * FROM services WHERE id=$edit_service_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $service_id = $row['id'];
        $service_title = $row['title'];
        $service_description = $row['description'];
    }
}

if (isset($_GET['edit-footer'])) {
    $edit_footer_id = $_GET['edit-footer'];
    $result = $o->connect()->query("SELECT * FROM footer WHERE id=$edit_footer_id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $footer_id = $row['id'];
        $footer_title = $row['title'];
        $footer_content = $row['content'];
        $footer_date = $row['date'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_service'])) {
        $service_title = $_POST['service_title'];
        $service_description = $_POST['service_description'];
        $o->connect()->query("INSERT INTO services (title, description) VALUES ('$service_title', '$service_description')");
        header("Location: admin.index.php");
        exit;
    } elseif (isset($_POST['edit_service'])) {
        $service_id =$_POST['service_id'];
        $service_title = $_POST['service_title'];
        $service_description = $_POST['service_description'];
        $o->connect()->query("UPDATE services SET title='$service_title', description='$service_description' WHERE id=$service_id");
        header("Location: admin.index.php");
        exit;
    } elseif (isset($_POST['Delete'])) {
        $service_id = $_POST['Delete'];
        $o->connect()->query("DELETE FROM services WHERE id=$service_id");
        header("Location: admin.index.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_footer'])) {
        $footer_title = $_POST['footer_title'];
        $footer_content = $_POST['footer_content'];
        $footer_date = $_POST['footer_date'];
        $o->connect()->query("INSERT INTO footer (title, content, date) VALUES ('$footer_title', '$footer_content', '$footer_date')");
        header("Location: admin.index.php");
        exit;
    } elseif (isset($_POST['update_footer'])) {
        $footer_id = $_POST['footer_id'];
        $footer_title = $_POST['footer_title'];
        $footer_content = $_POST['footer_content'];
        $footer_date = $_POST['footer_date'];
        $o->connect()->query("UPDATE footer SET title='$footer_title', content='$footer_content', date='$footer_date' WHERE id=$footer_id");
        header("Location: admin.index.php");
        exit;
    } elseif (isset($_POST['delete'])) {
       
        $footer_id = $_POST['delete'];
        $o->connect()->query("DELETE FROM footer WHERE id=$footer_id");
        header("Location: admin.index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - Services & Footer Management</title>
</head>
<body>
    <h1>Manage Services</h1>

    
    <form method="POST">
        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>"> 
        <label>Title:</label>
        <input type="text" name="service_title" value="<?php echo $service_title; ?>" >
        <label>Description:</label>
        <textarea name="service_description" ><?php echo $service_description; ?></textarea>
        
        <?php if ($service_id==true): ?>
            <button type="submit" name="edit_service">Update Service</button>
        <?php else: ?>
            <button type="submit" name="add_service">Add Service</button>
        <?php endif; ?>
    </form>

    <h2>Existing Services</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $o->connect()->query("SELECT * FROM services");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td>
                <form method='GET' >
                    <button type='submit' name='edit_service' value='{$row['id']}'>Edit</button>
                   
                </form>
                <form method='POST' >
                    <button type='submit' name='Delete' value='{$row['id']}'>Delete</button>
                </form>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Manage Footer</h1>

    <form method="POST">
        <input type="hidden" name="footer_id" value="<?php echo $footer_id; ?>"> 
        <label>Title:</label>
        <input type="text" name="footer_title" value="<?php echo $footer_title; ?>" required>
        <label>Content:</label>
        <textarea name="footer_content" required><?php echo $footer_content; ?></textarea>
        <label>Date:</label>
        <input type="date" name="footer_date" value="<?php echo $footer_date; ?>" required>
        
        <?php if ($footer_id): ?>
            <button type="submit" name="update_footer">Update Footer</button>
        <?php else: ?>
            <button type="submit" name="add_footer">Add Footer</button>
        <?php endif; ?>
    </form>

    <h2>Existing Footer</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $o->connect()->query("SELECT * FROM footer");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['content']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>
                <form method='GET' action='admin.index.php' >
                    <button type='submit' name='edit-footer' value='{$row['id']}'>Edit</button>
                </form>
                <form method='POST'>
                    <button type='submit' name='delete' value='{$row['id']}'>delete</button>
                </form>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
