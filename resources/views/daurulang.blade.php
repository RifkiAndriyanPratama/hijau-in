<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Daur Ulang</title>
  <link rel="stylesheet" href="{{ asset('css/filament/filament/daurulang.css') }}">
</head>
<body>

  <div class="sidebar" id="sidebar">
    <div class="logo">
      <h2>hijauIN🌿</h2>
      <button class="toggle-btn" id="toggleBtn">☰</button>
    </div>

    <ul class="nav-links">
      <li class="nav-item"><a href="/Laporan">Laporan</a></li>
      <li class="nav-item active"><a href="/daur">Daur Ulang</a></li>
      <li class="nav-item"><a href="/progress">Progress</a></li>
      <li class="nav-item"><a href="/profil">Profil</a></li>
    </ul>
  </div>


  <div class="main-content" id="mainContent">
    <h2 class="form-title">Form Daur Ulang</h2>

    <form class="form-laporan">

      <label>Nama:</label>
      <input type="text" name="nama" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Nomor Telepon:</label>
      <input type="text" name="telepon">

      <label>Alamat Lokasi:</label>
      <input type="text" name="alamat">

      <label>Jenis Sampah:</label>
      <select name="jenis_sampah">
        <option value="">Pilih Jenis Sampah</option>
        <option value="plastik">Plastik</option>
        <option value="kertas">Kertas</option>
        <option value="logam">Logam</option>
        <option value="kaca">Kaca</option>
        <option value="organik">Organik</option>
      </select>

      <label>Berat/Volume:</label>
      <input type="text" name="berat" placeholder="cth: 3 kg / 5 liter">

      <label>Catatan Tambahan:</label>
      <input type="text" name="catatan">

      <button type="submit" class="submit-btn">Submit →</button>
    </form>
  </div>


  <script>
    const toggleBtn = document.getElementById('toggleBtn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('expanded');
    });

    // Highlight nav item aktif
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
