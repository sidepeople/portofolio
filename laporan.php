<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php"); 
  exit;
}
?>

<?php
require_once 'functions.php';
$siswa = query("SELECT * FROM siswa");

// tambah siswa php
// check apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    // check apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('data BERHASIL');
            document.location.href = 'laporan.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('data GAGAL');
            document.location.href = 'laporan.php';
        </script>
        ";
    }
}


?>


<!DOCTYPE html>
<html>
<head>
  <title>Detail Laporan</title>
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
      border-radius: 4px;}

    /* Detail card */
    .detail-card {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .btn-brown {
      background: #096b57ff;
      color: white;
      padding: 8px 15px;
      border-radius: 15px;
      border: none;
      cursor: pointer;
      margin-top: 1px;
      transition: background-color 0.3s ease;
    }

    .btn-brown:hover {
      background-color: #16A085;
    }

    /* Comment section */
    .comment-box {
      margin-top: 10px;
      background: white;
      border-radius: 8px;
      padding: 10px;
    }

    .comment-input {
      display: flex;
      margin-top: 5px;
      border: 2px solid #16A085;
      border-radius: 5px;
      overflow: hidden;
    }

    .comment-input input {
      flex: 1;
      border: none;
      padding: 8px;
      outline: none;
      height: 35px;
      font-size: 14px;
    }

    .comment-input button {
      background: #16A085;
      color: white;
      border: none;
      padding: 8px 15px;
      cursor: pointer;
    }

    .comment-meta {
      font-size: 12px;
      color: gray;
    }

/* Form Container mirip Tabel */
.form-container {
  background: #fff;
  padding: 20px 25px;
  border-radius: 8px;
  border: 1px solid #eee;
  box-shadow: 0 1px 3px rgba(0,0,0,0.08);
  margin-bottom: 25px;
}

/* Judul Form */
.form-container h4 {
  margin-bottom: 20px;
  font-size: 18px;
  font-weight: 600;
  color: #2c3e50;
  border-bottom: 1px solid #e0e0e0;
  padding-bottom: 8px;
}

/* Grid Form */
.form-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px 20px;
}

/* Biar ada yg full width */
.form-grid .full {
  grid-column: 1 / 3;
}

/* Label + Input */
.form-container label {
  display: block;
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 6px;
  color: #333;
}

.form-container input[type="text"],
.form-container input[type="email"],
.form-container input[type="file"],
.form-container select {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid black;
  border-radius: 6px;
  font-size: 14px;
  transition: all 0.3s ease;
}

.form-container input:focus,
.form-container select:focus {
  border-color: #16A085;
  outline: none;
  box-shadow: 0 0 3px rgba(22,160,133,0.4);
}

/* Tombol Submit */
.form-container button {
  background: blue;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
}

.form-container button:hover {
  background: #138d75;
}

/* Responsif */
@media (max-width: 768px) {
  .form-grid {
    grid-template-columns: 1fr;
  }
  .form-grid .full {
    grid-column: 1;
  }
}


    /* Table-rossi */

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
        h1 {
            margin-bottom: 10px;
        }
        .top-bar {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom: 15px;
        }
        .btn {
            display:inline-block;
            padding:6px 12px;
            background:#2d8f4f;
            color:white;
            text-decoration:none;
            border-radius:4px;
            font-size:14px;
        }
        .btn.secondary { background:#3498db; }
        .btn.danger { background:#16A085; }
        table {
            width:100%;
            border-collapse:collapse;
            background:white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }
        th, td {
            padding:10px 12px;
            border-bottom:1px solid #eee;
            text-align:left;
            vertical-align:middle;
        }
        th {
            background:#fafafa;
            font-weight:600;
        }
        tr:last-child td { border-bottom: none; }
        .thumb {
            width:60px;
            height:60px;
            object-fit:cover;
            border-radius:6px;
            border:1px solid #ddd;
        }
        .aksi-btns a {
          
            display:inline-block;
            margin-right:8px;
            padding:6px 10px;
            border-radius:4px;
            color:white;
            text-decoration:none;
            font-size:13px;
        }
        .btn-ubah {
  background-color: #4CAF50; /* hijau */
  color: white;
  border: 1px solid #45a049;
}
.btn-ubah:hover {
  background-color: #45a049;
}

/* Tombol Hapus */
.btn-hapus {
  background-color: #f44336; /* merah */
  color: white;
  border: 1px solid #d32f2f;
}
.btn-hapus:hover {
  background-color: #d32f2f;
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
  <a href="logout.php" class="logout-btn">🏡 Logout</a>
</div>

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<!-- Toggle button -->
<button class="toggle-btn" onclick="toggleSidebar()">☰</button>

<!-- Content -->
<div class="content" id="content">

  <!-- Card Input -->
       <h3>Laporan Siswa</h3>
      <div class="form-container">
  <h4>Tambah Siswa Baru</h4>
  <form action="" method="POST" enctype="multipart/form-data" class="form-grid">
      
      <div>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>
      </div>

      <div>
        <label for="nis">NIS</label>
        <input type="text" id="nis" name="nis" required>
      </div>

      <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>

      <div>
        <label for="jurusan">Jurusan</label>
        <select name="jurusan" id="jurusan">
            <option value=""></option>
            <option value="Teknik Informatika">Teknik Informatika</option>
            <option value="Sistem Informatika">Sistem Informatika</option>
            <option value="Biomedical">Biomedical</option>
            <option value="F-MIPA M">F-MIPA M</option>
            <option value="F-MIPA IPA">F-MIPA IPA</option>
        </select>
      </div>

      <div class="full">
        <label for="gambar">Gambar Profil</label>
        <input type="file" name="gambar" id="gambar" accept="image/*">
      </div>

      <div class="full">
        <button type="submit" name="submit">Tambah Data Siswa</button>
      </div>

  </form>
</div>

  <!-- Card Tabel -->
    <table>
      <thead>
        <tr>
          <th style="width:56px">No</th>
          <th>Nama</th>
          <th>NIS</th>
          <th>Email</th>
          <th>Jurusan</th>
          <th>Gambar</th>
          <th style="width:200px">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($siswa)): ?>
          <tr>
            <td colspan="7" style="text-align:center; padding:30px;">Data kosong.</td>
          </tr>
        <?php else: ?>
          <?php $i = 1; foreach ($siswa as $row): ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= htmlspecialchars($row['nama']); ?></td>
              <td><?= htmlspecialchars($row['nim']); ?></td>
              <td><?= htmlspecialchars($row['email']); ?></td>
              <td><?= htmlspecialchars($row['jurusan']); ?></td>
              <td>
                <img src="<?= htmlspecialchars($row['gambar']); ?>" alt="default.jpg" class="thumb">
              </td>
               <td>
              
              
                 <a href="update.php?id=<?= $row["id"] ?>" class="btn btn-ubah">Update</a>
              <a href="hapus.php?id=<?= $row["id"]; ?>" class="btn btn-hapus">hapus</a>
              </td>
              
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