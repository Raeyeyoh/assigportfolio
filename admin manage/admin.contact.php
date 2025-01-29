<?php
include '../db.php'; 
$o=new database();
$id = "";
$email = "";
$phone = "";
$address = "";

$linkedin = "";
$github = "";

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $o->connect()->query("SELECT * FROM contact WHERE id=$edit_id");
    if ($result->num_rows > 0) {
        $contact = $result->fetch_assoc();
        $id = $contact['id'];
        $email = $contact['email'];
        $phone = $contact['phone'];
        $address = $contact['address'];
        $linkedin = $contact['linkedin'];
        $github = $contact['github'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
       
        $linkedin = $_POST['linkedin'];
        $github = $_POST['github'];
        $o->connect()->query("INSERT INTO contact (email, phone, address, linkedin, github) 
                      VALUES ('$email', '$phone', '$address', '$linkedin', '$github')");
        header("Location: admin.contact.php");
        exit;
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $linkedin = $_POST['linkedin'];
        $github = $_POST['github'];
        $o->connect()->query("UPDATE contact SET email='$email', phone='$phone', address='$address', 
                      linkedin='$linkedin', github='$github' WHERE id=$id");
        header("Location: admin.contact.php");
        exit;
    } elseif (isset($_POST['delete'])) {
       
        $id = $_POST['delete'];
        $o->connect()->query("DELETE FROM contact WHERE id=$id");
        header("Location: admin.contact.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/admin.css">
    <title>Admin - Contact Information</title>
</head>
<body>
    <h1>Manage Contact Information</h1>

   
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required>
        
        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>" required>

        <label>Address:</label>
        <input type="text" name="address" value="<?php echo $address; ?>" required>


        <label>LinkedIn:</label>
        <input type="text" name="linkedin" value="<?php echo $linkedin; ?>" required>

        <label>GitHub:</label>
        <input type="text" name="github" value="<?php echo $github; ?>" required>

        <?php if ($id): ?>
            <button type="submit" name="update">Update Contact Info</button>
        <?php else: ?>
            <button type="submit" name="add">Add Contact Info</button>
        <?php endif; ?>
    </form>

    <h2>Existing Contact Information</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>LinkedIn</th>
            <th>GitHub</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = $o->connect()->query("SELECT * FROM contact");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['address']}</td>";
            
            echo "<td>{$row['linkedin']}</td>";
            echo "<td>{$row['github']}</td>";
            echo "<td>
                <form method='GET' action='admin.contact.php' >
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
