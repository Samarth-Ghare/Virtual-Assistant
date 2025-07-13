<?php
session_start();

// Initialize variables
$username = "";
$email = "";
$errors = array();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'samdb');

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // Receive and escape all input values
    $username = mysqli_real_escape_string($db, trim($_POST['username']));
    $email = mysqli_real_escape_string($db, trim($_POST['email']));
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Form validation
    if (empty($username)) array_push($errors, "Username is required");
    if (empty($email)) array_push($errors, "Email is required");
    if (empty($password_1)) array_push($errors, "Password is required");
    if ($password_1 !== $password_2) array_push($errors, "Passwords do not match");

    // Check for existing user
    $query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) array_push($errors, "Username already exists");
        if ($user['email'] === $email) array_push($errors, "Email already exists");
    }

    // Register user if no errors
    if (count($errors) === 0) {
        // Use password_hash instead of md5
        $hashed_password = password_hash($password_1, PASSWORD_DEFAULT);

        $insert = "INSERT INTO users (username, email, password) 
                   VALUES('$username', '$email', '$hashed_password')";
        mysqli_query($db, $insert);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('Location: home.html');
        exit();
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, trim($_POST['username']));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) array_push($errors, "Username is required");
    if (empty($password)) array_push($errors, "Password is required");

    if (count($errors) === 0) {
        // Fetch hashed password from DB
        $query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('Location: home.php');
            exit();
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
