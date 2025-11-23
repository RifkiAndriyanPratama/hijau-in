<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Laporan</title>
  <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
</head>
<body>

  <div class="sidebar" id="sidebar">
    <div class="logo">
      <h2>hijauIN</h2>
      <button class="toggle-btn" id="toggleBtn">☰</button>
    </div>

    <ul class="nav-links">
      <li class="nav-item active"><a href="/Laporan">Laporan</a></li>
      <li class="nav-item "><a href="/daur">Daur Ulang</a></li>
      <li class="nav-item"><a href="/progress">Progress</a></li>
      <li class="nav-item"><a href="/profil">Profil</a></li>
    </ul>
  </div>

  <div class="main-content" id="mainContent">
    <h2 class="form-title">Form Laporan</h2>
    <form class="form-laporan" method="POST" action="{{ route('lapor.store') }}" enctype="multipart/form-data">
      @csrf
      <label>Lokasi:</label>
      <input type="text" name="lokasi" required />

      <label>Keterangan:</label>
      <textarea name="keterangan" rows="4" required></textarea>

      <label>Foto Lokasi (maks 5):</label>
      <input type="file" name="fotos[]" multiple accept="image/*" required />

      <p class="help">Format: jpg/png/gif, max 2MB per file.</p>

      <button type="submit" class="submit-btn">Kirim Laporan →</button>
    </form>
  </div>



  <div class="bottom-nav">
     <div class="middle-btn">
      <a href="/Laporan">
        <div class="circle-btn">
          <img src="{{ asset('icons/report.png') }}" alt="Laporan">
        </div>
      </a>
    </div>
    <a href="/daur" class="bottom-item">
      <img src="{{ asset('icons/recycle.png') }}" alt="Daur">
      <span>Daur</span>
    </a>

    <a href="/progress" class="bottom-item">
      <img src="{{ asset('icons/progress.png') }}" alt="Progress">
      <span>Progress</span>
    </a>

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

    // Highlight nav item (contoh manual untuk demo)
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
