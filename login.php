<?php
session_start(); // Required for $_SESSION to work

if (isset($_SESSION['user'])) {
    header("Location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="form.css">
</head>

<body>
  <div class="login-container">
    <h2>Login</h2>
    
    <?php if (isset($_GET['error'])): ?>
      <p style="color: red;">Username atau password salah!</p>
    <?php endif; ?>

    <form action="auth.php" method="post">
      <label for="username">Username</label>  
      <div class="input-group">
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>

      <label for="password">Password</label>
      <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>

      <button type="submit" class="login-btn">Login</button>
      <div>
        <a href="index.html" class="back-btn">back</a>
    </div>
    </form>
  </div>
</body>
</html>