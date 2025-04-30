<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $address = $_POST['address'];
    $image = $_FILES['photo']['name'];
    $temp_image = $_FILES['photo']['tmp_name'];
    $role = $_POST['role'];

    if ($password === $confirm_password) {
        move_uploaded_file($temp_image, "uploads/$image");
        $insert = mysqli_query($conn, "INSERT INTO user (name, mobile, password, address, photo, role, status, votes) VALUES ('$name', '$mobile', '$password', '$address', '$image', '$role', '0', '0')");
        if ($insert) {
            echo "<script> alert('Registration Successful')</script>";
            header("Location: login.php");
            exit();
        } else {
            echo "<script> alert('Registration Failed')</script>";
            header("Location: index.php");
            exit();
        }
    } else {
        echo "<script> alert('Password and Confirm Password do not match')</script>";
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Voting System - Register</title>
    <link rel="stylesheet" href="styles/register.css">
  </head>
  <body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <h2>Registration</h2>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="input-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" id="mobile" name="mobile" placeholder="Enter your mobile number" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                </div>
                <div class="input-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" placeholder="Enter your address" rows="3" required></textarea>
                </div>
                <div class="input-group">
                    <label for="photo">Upload Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                <div class="input-group">
                    <label for="role">Select Role</label>
                    <select id="role" name="role" required>
                        <option value="" disabled selected>Select your role</option>
                        <option value="1">Voter</option>
                        <option value="2">Group</option>
                    </select>
                </div>
                <div class="actions">
                    <button type="submit" class="btn">Register</button>
                </div>
                <div class="links">
                    <a href="login.php">Already have an account? Login here</a>
                </div>
            </form>
        </div>
    </div>
  </body>
</html>
