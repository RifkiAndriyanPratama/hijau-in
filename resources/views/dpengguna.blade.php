<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>hijauIN</title>
  <link rel="stylesheet" href="css/filament/filament/pengguna.css" />
</head>
<body>
  <header>
    <div class="logo">
      <h1>hijau<span>IN</span></h1>
    </div>
    <nav class="navbar">
      <a href="#">Home</a>
      <a href="#">Menu</a>
      <a href="#">AboutUS</a>
      <a href="#">Contact</a>
    </nav>
    <div class="auth-buttons">
      <button class="signup">SignUp</button>
      <button class="login">LogIn</button>
    </div>
  </header>

  <main>
    <section class="hero">
      <img  src="{{ asset('images/recycle.png') }}" alt="recycle" class="img-left">
      
      <div class="welcome-box">
        <div class="logo-icon"></div>
        <h2>Wellcome to <span>hijauIN</span></h2>
        <p>
          Membantu mengatasi pencemaran atau masalah lingkungan dan membantu mendaur ulang sampah
        </p>
      </div>

      <img src="{{ asset('images/sampah1.jpeg') }}" class="img-right">
      <img src="{{ asset('images/sampah1.jpeg') }}" class="img-bottom">
    </section>
  </main>


      <section class="menu-section">
      <h1 class="menu-title">MENU</h2>
      <div class="menu-container">
        
        <div class="menu-card">
          <p>Melaporkan terkait masalah atau pencemaran lingkungan</p>
          <button class="menu-btn">Laporan</button>
        </div>

        <div class="menu-card">
          <p>Menyerahkan sampah yang bisa didaur ulang</p>
          <button class="menu-btn">Daur Ulang</button>
        </div>

      </div>
    </section>


    <section class="about-section">
      <div class="about-content">
        <div class="about-images">
          <img src="{{ asset('images/recycle.png') }}" alt="Recycle" class="about-img">
          <img src="{{ asset('images/sampah1.jpeg') }}" alt="Pollution" class="about-img">
          <img src="{{ asset('images/sampah1.jpeg') }}" alt="Garbage" class="about-img">
        </div>

        <div class="about-text">
          <h1 class="about-logo">hijau<span>IN</span></h1>
          <p>
            Disini kami hadir untuk membantu masyarakat dalam mengatasi masalah lingkungan, seperti sampah liar,
            limbah pabrik yang belum diolah, aliran sungai atau selokan yang mampet gara-gara sampah. Itu semua
            kita akan bantu menyelesaikannya.
          </p>
          <p>
            Lalu kita juga akan membantu atau menerima barang-barang yang bisa didaur ulang untuk kami mendaur ulang
            sampah-sampah tersebut agar bisa lebih bermanfaat dan tidak mencemari lingkungan.
          </p>
        </div>
      </div>
    </section>


    <footer class="contact-section">
      <h2>Contact Us</h2>
      <div class="contact-info">
        <div class="contact-item">
          <img src="{{ asset('icons/whatsapp.png') }}" alt="WhatsApp">
          <p>+6285181728983</p>
        </div>

        <div class="contact-item">
          <img src="{{ asset('icons/email.png') }}" alt="Email">
          <p>hijauin@gmail.com</p>
        </div>

        <div class="contact-item">
          <img src="{{ asset('icons/instagram.png') }}" alt="Instagram">
          <p>@hijauin</p>
        </div>
      </div>
    </footer>



</body>
</html>
