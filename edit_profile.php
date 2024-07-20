<?php
session_start();
require 'db.php';

$user_id = 1; // Assuming the user ID is 1 for this example

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $photo = $_FILES['photo']['name'];

    // Handle file upload
    if ($photo) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($photo);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
    } else {
        $target_file = $_POST['existing_photo'];
    }

    $stmt = $conn->prepare("UPDATE users SET name = :name, username = :username, email = :email, contact = :contact, photo = :photo WHERE id = :id");
    $stmt->execute([
        'name' => $name,
        'username' => $username,
        'email' => $email,
        'contact' => $contact,
        'photo' => $target_file,
        'id' => $user_id
    ]);

    header('Location: profile.php');
    exit;
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "User not found!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>"><br>

        <label for="photo">Photo:</label>
        <input type="file" id="photo" name="photo"><br>
        <input type="hidden" name="existing_photo" value="<?php echo $user['photo']; ?>">

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
