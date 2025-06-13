<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manajemen Kelas</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      margin: 0;
      background: linear-gradient(to bottom right, #0f3c73, #a5b8da);
      color: #333;
      min-height: 100vh;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #052f5f;
      padding: 10px 30px;
      color: white;
    }

    .navbar .brand {
      font-weight: bold;
      font-size: 20px;
    }

    .navbar .menu {
      display: flex;
      gap: 20px;
    }

    .navbar .menu a {
      color: white;
      text-decoration: none;
      font-weight: 500;
    }

    .navbar .menu a:hover {
      text-decoration: underline;
    }

    .navbar .profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .container {
      max-width: 1100px;
      margin: 30px auto;
      background-color: #e6eef8;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .section-header {
      background-color: #d9e4f0;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
    }

    .section-header h2 {
      margin: 0;
      color: #052f5f;
    }

    .section-header p {
      margin: 5px 0 0;
      color: #555;
    }

    .nav-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .nav-tabs button {
      padding: 8px 20px;
      border: none;
      border-radius: 8px;
      background-color: #c2d4ee;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .nav-tabs button:hover {
      background-color: #a5b8da;
    }

    .nav-tabs button.active {
      background-color: #1d3f72;
      color: white;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .grid-cards {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 3px 6px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .card h4 {
      margin: 0 0 10px 0;
      color: #1d3f72;
    }

    .card p {
      font-size: 14px;
      margin: 3px 0;
      color: #555;
    }

    .card .actions {
      margin-top: 10px;
      display: flex;
      gap: 8px;
    }

    .card .actions button {
      flex: 1;
      padding: 6px 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .card .actions button:hover {
      opacity: 0.9;
    }

    .btn-detail { background-color: #3a68b7; color: white; }
    .btn-edit   { background-color: #1d3f72; color: white; }
    .btn-delete { background-color: #d9534f; color: white; }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
      margin-bottom: 20px;
    }

    .form-grid label {
      font-weight: 600;
      margin-bottom: 5px;
      display: block;
      color: #1d3f72;
    }

    .form-grid input, .form-grid textarea, .form-grid select {
      width: 100%;
      padding: 8px 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      transition: border 0.3s ease;
    }

    .form-grid input:focus, .form-grid textarea:focus, .form-grid select:focus {
      border-color: #3a68b7;
      outline: none;
    }

    .form-grid textarea {
      resize: vertical;
      grid-column: span 2;
      min-height: 80px;
    }

    .btn-submit {
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
      background-color: #218838;
    }

    .stats {
      display: flex;
      gap: 20px;
      justify-content: space-around;
      margin-bottom: 20px;
    }

    .stat-box {
      flex: 1;
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .stat-box br {
      display: none;
    }

    .stat-box:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .status-aktif {
      color: green;
      font-weight: bold;
    }

    .status-selesai {
      color: #d9534f;
      font-weight: bold;
    }

    h3 {
      color: #1d3f72;
      margin-bottom: 15px;
    }

    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        gap: 10px;
        padding: 15px;
      }
      
      .navbar .menu {
        flex-wrap: wrap;
        justify-content: center;
      }
      
      .form-grid {
        grid-template-columns: 1fr;
      }
      
      .form-grid textarea {
        grid-column: span 1;
      }
      
      .stats {
        flex-direction: column;
      }
      
      .stat-box br {
        display: inline;
      }
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="brand">📚 EduManage</div>
    <div class="menu">
      <a href="#">Dashboard</a>
      <a href="#">Kelas</a>
      <a href="#">Mahasiswa</a>
      <a href="#">Laporan</a>
    </div>
    <div class="profile">
      <span>👤 Dr. Ahmad Susanto</span>
      <span style="background:#ccc; padding:5px 10px; border-radius:50%;">AS</span>
    </div>
  </div>

  <div class="container">
    <div class="section-header">
      <h2>📘 Manajemen Kelas</h2>
      <p>Kelola mata kuliah dan kelas dengan mudah dan efisien</p>
    </div>

    <div class="nav-tabs">
      <button class="active">Dashboard</button>
      <button>Daftar Kelas</button>
      <button>Tambah Kelas</button>
    </div>

    <!-- Dashboard Section -->
    <div class="stats">
      <div class="stat-box">4 <br/>Total Kelas</div>
      <div class="stat-box">3 <br/>Kelas Aktif</div>
      <div class="stat-box">103 <br/>Total Mahasiswa</div>
      <div class="stat-box">1 <br/>Kelas Selesai</div>
    </div>

    <h3>Kelas Terbaru</h3>
    <div class="grid-cards">
      <div class="card">
        <h4>Basis Data (IF-302)</h4>
        <p>👩‍🏫 Prof. Siti Nurhaliza</p>
        <p>📚 3 SKS • Selasa, 10:00–12:00</p>
        <p>🏫 Ruang Kelas A • 👥 30/35 mahasiswa</p>
        <p class="status-aktif">🟢 Aktif</p>
        <div class="actions">
          <button class="btn-detail">Detail</button>
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Hapus</button>
        </div>
      </div>
      
      <div class="card">
        <h4>Pemrograman Web (IF-301)</h4>
        <p>👨‍🏫 Dr. Ahmad Susanto</p>
        <p>📚 4 SKS • Senin, 08:00–10:00</p>
        <p>🏫 Lab Komputer 1 • 👥 28/30 mahasiswa</p>
        <p class="status-aktif">🟢 Aktif</p>
        <div class="actions">
          <button class="btn-detail">Detail</button>
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Hapus</button>
        </div>
      </div>
      
      <div class="card">
        <h4>Kecerdasan Buatan (IF-303)</h4>
        <p>👨‍🏫 Dr. Bambang Setiawan</p>
        <p>📚 3 SKS • Rabu, 13:00–15:00</p>
        <p>🏫 Ruang Kelas B • 👥 25/30 mahasiswa</p>
        <p class="status-aktif">🟢 Aktif</p>
        <div class="actions">
          <button class="btn-detail">Detail</button>
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Hapus</button>
        </div>
      </div>
      
      <div class="card">
        <h4>Algoritma (IF-201)</h4>
        <p>👩‍🏫 Dr. Rina Wijaya</p>
        <p>📚 3 SKS • Kamis, 10:00–12:00</p>
        <p>🏫 Ruang Kelas C • 👥 20/25 mahasiswa</p>
        <p class="status-selesai">🔴 Selesai</p>
        <div class="actions">
          <button class="btn-detail">Detail</button>
          <button class="btn-edit">Edit</button>
          <button class="btn-delete">Hapus</button>
        </div>
      </div>
    </div>

    <!-- Tambah Kelas Section -->
    <h3 style="margin-top:40px;">Tambah Kelas Baru</h3>
    <form>
      <div class="form-grid">
        <div>
          <label>Nama Mata Kuliah</label>
          <input type="text" placeholder="Contoh: Pemrograman Web" required>
        </div>
        <div>
          <label>Kode Mata Kuliah</label>
          <input type="text" placeholder="Contoh: IF-301" required>
        </div>
        <div>
          <label>Dosen Pengampu</label>
          <input type="text" placeholder="Nama Dosen" required>
        </div>
        <div>
          <label>SKS</label>
          <select required>
            <option value="">Pilih SKS</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
          </select>
        </div>
        <div>
          <label>Semester</label>
          <input type="text" placeholder="Contoh: Semester 3" required>
        </div>
        <div>
          <label>Jadwal</label>
          <input type="text" placeholder="Contoh: Senin, 08:00–10:00" required>
        </div>
        <div>
          <label>Ruangan</label>
          <input type="text" placeholder="Contoh: Lab Komputer 1" required>
        </div>
        <div>
          <label>Kapasitas</label>
          <input type="number" placeholder="Jumlah mahasiswa maksimal" min="1" required>
        </div>
        <div>
          <label>Deskripsi Mata Kuliah</label>
          <textarea rows="3" placeholder="Deskripsi singkat mata kuliah..." required></textarea>
        </div>
      </div>
      <button type="submit" class="btn-submit">Simpan Kelas</button>
    </form>

  </div>
</body>
</html>