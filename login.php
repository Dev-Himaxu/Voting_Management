<?php
include 'db.php';
session_start();
if (isset($_SESSION['userdata'])) {
    header("Location: dashboard.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $check = mysqli_query($conn, "SELECT * FROM user WHERE mobile='$mobile' AND password='$password' AND role='$role'");

    if (mysqli_num_rows($check) > 0) {
        $userdata = mysqli_fetch_array($check);
        $groups = mysqli_query($conn, "SELECT * FROM user WHERE role=2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

        $_SESSION['userdata'] = $userdata;
        $_SESSION['groupsdata'] = $groupsdata;

        header("Location: dashboard.php");
    } else {
        echo "<script> alert('Invalid Credentials')</script>";
        header("Location: login.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/reg_login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Login</h2>
            </div>
            <form method="POST">
                <div class="input-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" id="mobile" name="mobile" placeholder="Enter your mobile number" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
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
                    <button type="submit" class="btn">Login</button>
                </div>
                <div class="links">
                    <a href="index.php">Don't have an account? Register here</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>