<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Laporan</title>
  <link rel="stylesheet" href="{{ asset('css/progress.css') }}">
</head>
<body>

  <div class="sidebar" id="sidebar">
    <div class="logo">
      <h2>hijauIN</h2>
      <button class="toggle-btn" id="toggleBtn">☰</button>
    </div>

    <ul class="nav-links">
      <li class="nav-item"><a href="/Laporan">Laporan</a></li>
      <li class="nav-item"><a href="/daur">Daur Ulang</a></li>
      <li class="nav-item active"><a href="/progress">Progress</a></li>
      <li class="nav-item"><a href="/profil">Profil</a></li>
    </ul>
  </div>

  <div class="main-content" id="mainContent">
    <div class="top-bar">
      <h2>Daftar Laporan Anda</h2>
      <button class="filter-btn" title="Filter">
        <img src="{{ asset('images/filter.png') }}" alt="Filter">
      </button>
    </div>

    <div class="laporan-list">

 
      <div class="laporan-card">
        <div class="laporan-header">
          <p class="lokasi"><strong>Pundong, Bantul</strong></p>
          <p class="tanggal">17 Agustus 1945</p>
        </div>

        <h3 class="judul">Laporan: Sampah Liar</h3>

        <p class="deskripsi">
          <strong>Deskripsi:</strong> "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
          incididunt ut labore et dolore magna aliqua."
        </p>

        <div class="laporan-footer">
          <span class="status status-pending">Laporan anda masih dalam antrian</span>
          <button class="delete-btn">Delete </button>
        </div>
      </div>


      <div class="laporan-card">
        <div class="laporan-header">
          <p class="lokasi"><strong>Pundong, Bantul</strong></p>
          <p class="tanggal">18 Agustus 1945</p>
        </div>

        <h3 class="judul">Laporan: Daur Ulang Plastik</h3>

        <p class="deskripsi">
          <strong>Deskripsi:</strong> "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat."
        </p>

        <div class="laporan-footer">
          <span class="status status-done">Laporan anda telah ditindak lanjuti</span>
          <button class="delete-btn">Delete</button>
        </div>
      </div>

    </div>
  </div>

 
  <div class="bottom-nav">
    <a href="/Laporan" class="bottom-item active">
      <img src="{{ asset('icons/report.png') }}" alt="Laporan">
      <span>Laporan</span>
    </a>
    <a href="/daur" class="bottom-item">
      <img src="{{ asset('icons/recycle.png') }}" alt="Daur">
      <span>Daur</span>
    </a>

    <div class="middle-btn">
      <a href="/progress">
        <div class="circle-btn">
          <img src="{{ asset('icons/progress.png') }}" alt="Progress">
        </div>
      </a>
    </div>

    <a href="/profil" class="bottom-item">
      <img src="{{ asset('icons/user.png') }}" alt="Profil">
      <span>Profil</span>
    </a>
  </div>

  <script>
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('expanded');
    });

    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
      item.addEventListener('click', () => {
        navItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
      });
    });
  </script>

</body>
</html>
