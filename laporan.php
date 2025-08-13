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
      background-color:blue; 
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
    .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Detail card */
    .detail-card {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .detail-header {
      padding-bottom: 5px;
      margin-bottom: 15px;
    }

    .btn-blue {
      background: blue;
      color: white;
      padding: 8px 15px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      margin-top: 10px;
      
    }

    /* Comment section */
    .comment-box {
      margin-top: 30px;
      background: white;
      border-radius: 8px;
      padding: 15px;
    }

    .comment-input {
      display: flex;
      margin-top: 10px;
      border: 2px solid blue;
      border-radius: 5px;
      overflow: hidden;
    }

    .comment-input input {
      flex: 1;
      border: none;
      padding: 8px;
      outline: none;
    }

    .comment-input button {
      background: blue;
      color: white;
      border: none;
      padding: 8px 15px;
      cursor: pointer;
    }

    .comment-meta {
      font-size: 12px;
      color: gray;
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


  <div class="detail-card">
    <div class="detail-header">
      <h2>Student Report</h2>
      <small>Present time</small>
    </div>
    <p>Absen, tidak ada surat.</p>
  
  <!-- Komentar 1 -->
<div class="comment-box">
  <strong>Nama</strong>
  <div class="comment-input">
    <input type="text" placeholder="Tulis pesan..." />

  </div>
</div>

<!-- Komentar 2 -->
<div class="comment-box">
  <strong>NIS</strong>
  <div class="comment-input">
    <input type="text" placeholder="Tulis pesan..." />
  </div>
</div>

<!-- Komentar 3 -->
<div class="comment-box">
  <strong>Email</strong>
  <div class="comment-input">
    <input type="text" placeholder="Tulis pesan..." />
  </div>
</div>

<!-- Komentar 4 -->
<div class="comment-box">
  <strong>Jurusan</strong>
  <div class="comment-input">
    <input type="text" placeholder="Tulis pesan..." />
  </div>
</div>

<!-- Komentar 5 -->
<div class="comment-box">
  <strong>Email</strong>
  <div class="comment-input">
    <input type="text" placeholder="Tulis pesan..." />
  </div>
</div>


<button class="btn-blue">Tanda Selesai</button>

</div>

    
<!-- </div> -->
<div class="table-container">
    <table>
        
            <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Gambar</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jurusan</th>
                <th>Keterangan</th>
                <th>Alamat</th>
                <th>No HP</th>
            </tr>
    
      </div>
      
      <script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('show');
  }
</script>

        

</body>
</html>