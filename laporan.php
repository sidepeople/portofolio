<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php"); 
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      height: 100vh;
      background-color: #ecf0f1;
      overflow-x: hidden;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 240px;
      height: 100%;
      background-color:skyblue;
      color: blue;
      padding-top: 20px;
      transform: translateX(-100%);
      transition: transform 0.3s ease;
      z-index: 1001;
    }

    .sidebar.open {
      transform: translateX(0);
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 15px;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      transition: background-color 0.2s;
    }

    .sidebar a:hover {
      background-color: blue;
      color: #000;
    }

    .logout-btn {
      background-color: blue;
      color: white;
      padding: 10px 20px;
      display: block;
      margin-top: 20px;
      text-align: center;
      text-decoration: none;
    }

    .logout-btn:hover {
      background-color: blue;
    }

    /* Overlay */
    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s ease;
      z-index: 1000;
    }

    .overlay.show {
      opacity: 1;
      pointer-events: auto;
    }

    /* Content */
    .content {
      flex-grow: 1;
      padding: 20px;
      padding-top: 100px;
      transition: filter 0.3s ease;
      width: 100%;
    }

    /* Toggle button */
    .toggle-btn {
      position: fixed;
      left: 10px;
      top: 10px;
      background-color: blue;
      color: white;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
      font-size: 18px;
      z-index: 1100;
      border-radius: 4px;
      
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <h2>Menu</h2>
  <a href="welcome.php"> Home</a>
  <a href="nilai.php">Nilai</a>
  <a href="kehadiran.php"> Kehadiran</a>
  <a href="jadwal.php">Jadwal</a>
  <a href="pengaturan.php"> Pengaturan</a>
  <a href="laporan.php">Laporan</a>
  <a href="logout.php" class="logout-btn">🏡Logout</a>
</div>

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- Toggle button -->
<button class="toggle-btn" onclick="toggleSidebar()">☰</button>

<!-- Content -->
<div class="content" id="content">
  <h1>LAPORAN HARIAN SISWA </h1>
  <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
    Nesciunt placeat excepturi sint recusandae nam quisquam porro ipsa provident eum amet nobis, 
    alias veniam sit non eligendi. Obcaecati, modi! Voluptatum, tempore!</p>
</div>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('show');
  }
</script>

</body>
</html>