<?php
include('server.php');
//session_start();

// Redirect if already logged in
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login | Portfolio</title>
  <style>
    :root {
      --bg: #0a0a0a;
      --fg: #eee;
      --accent: #00ffff;
      --card: #1a1a1a;
      --shadow: rgba(0,255,255,0.1);
      --trans: 0.3s ease;
    }
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
      font-family:"Segoe UI", sans-serif;
      background:var(--bg);
      color:var(--fg);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .login-container {
      background: var(--card);
      padding: 2em;
      border-radius: 10px;
      box-shadow: 0 4px 20px var(--shadow);
      width: 320px;
      max-width: 90%;
      text-align: center;
    }
    .login-container h2 {
      margin-bottom: 1em;
      color: var(--accent);
    }
    .input-group {
      margin-bottom: 1em;
      text-align: left;
    }
    .input-group label {
      display: block;
      margin-bottom: 0.3em;
      font-size: 0.9em;
    }
    .input-group input {
      width: 100%;
      padding: 0.7em;
      border: none;
      border-radius: 5px;
      background: #111;
      color: var(--fg);
      transition: border var(--trans);
    }
    .input-group input:focus {
      outline: none;
      border: 2px solid var(--accent);
    }
    .btn {
      display: inline-block;
      width: 100%;
      padding: 0.8em;
      background: var(--accent);
      color: var(--bg);
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background var(--trans), transform var(--trans);
    }
    .btn:hover {
      background: #00cccc;
      transform: translateY(-2px);
    }
    .alternate {
      margin-top: 1em;
      font-size: 0.9em;
    }
    .alternate a {
      color: var(--accent);
      text-decoration: none;
    }
    .alternate a:hover {
      text-decoration: underline;
    }
    .error {
      background: #b33;
      color: #fff;
      padding: 0.5em;
      margin-bottom: 1em;
      border-radius: 5px;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php include('errors.php'); ?>
    <form method="post" action="login.php">
      <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo isset($username)?htmlspecialchars($username):''; ?>" required>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <button class="btn" type="submit" name="login_user">Login</button>
      <p class="alternate">
        Not yet a member? <a href="register.php">Sign up</a>
      </p>
    </form>
  </div>
</body>
</html>
