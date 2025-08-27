<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php"); 
  exit;
}

require_once 'functions.php';
$siswa = query("SELECT nama FROM siswa"); 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Kehadiran</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
      background: #f4f6f9;
      color: #333;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 240px;
      height: 100%;
      background-color:skyblue;
      color: #FFFFFF;
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
  margin-left: 60px; 
  padding: 5px 20px;
  display: flex;
  flex-direction: column;
  align-items: flex-start; /* penting → bikin isi nempel kiri */
}

    .content h1 {
      margin-bottom: 20px;
      font-size: 26px;
      color: #2c3e50;
    }

    /* Modern Table Card */
  .table-wrapper {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  width: 500px;   /* atur lebar tabel, biar ga full */
  margin-left: 0; /* biar rapat kiri */
}

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: center;
    }

    thead {
      background: linear-gradient(135deg, #16A085, #1a38bcff);
      color: white;
    }

    thead th {
      padding: 16px;
      font-size: 16px;
      font-weight: 600;
    }

    tbody td {
      padding: 14px;
      border-bottom: 1px solid #eee;
      font-size: 15px;
    }

    tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tbody tr:hover {
      background-color: #ecf8fdff;
    }

    /* Toggle button */
    .toggle-btn {
      position: fixed;
      left: 10px;
      top: 10px;
      background-color:blue;
      color: white;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
      font-size: 18px;
      z-index: 1100;
      border-radius: 4px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .content {
        margin-left: 0;
        padding: 20px;
      }
      .table-wrapper {
        max-width: 100%;
      }
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
  <h1>Daftar Kehadiran Siswa</h1><div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th style="width:70px">No</th>
          <th>Nama Siswa</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($siswa)): ?>
          <tr>
            <td colspan="2">Data siswa tidak ditemukan.</td>
          </tr>
        <?php else: ?>
          <?php $i = 1; foreach ($siswa as $row): ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= htmlspecialchars($row['nama']); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>


<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('show');
  }
</script>

</body>
</html>