<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>hijauIN</title>
  <link rel="stylesheet" href="{{ asset('css/pengguna.css') }}" />

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
   <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body>


   <header>
    <div class="logo">
      <h1>hijau<span>IN</span></h1>
    </div>

    <nav class="navbar">
      <a href="#home" class="active">Home</a>
      <a href="#menu">Menu</a>
      <a href="#about">AboutUS</a>
      <a href="#contact">Contact</a>
    </nav>

    <div class="auth-buttons">
      <button class="signup">SignUp</button>
      <button class="login">LogIn</button>
    </div>
  </header>


  <main id="home">
    <section class="hero">
      <img src="{{ asset('images/recycle.png') }}" alt="recycle" class="img-left">

      <div class="welcome-box">
        <div class="logo-icon"><i class="fas fa-leaf"></i></div>
        <h2>Welcome to <span>hijauIN</span></h2>
        <p>
          Membantu mengatasi pencemaran atau masalah lingkungan dan membantu mendaur ulang sampah.
        </p>
      </div>

      <img src="{{ asset('images/masalah.jpg') }}" class="img-right">
      <img src="{{ asset('images/sampah1.jpeg') }}" class="img-bottom">
    </section>
  </main>


   <section class="menu-section" id="menu">
    <h1 class="menu-title">MENU</h1>
    <div class="menu-container">
      <div class="menu-card">
        <p>Melaporkan terkait masalah atau pencemaran lingkungan</p>
        <a href="/Laporan" class="menu-btn">Laporan</a>
      </div>
      <div class="menu-card">
        <p>Menyerahkan sampah yang bisa didaur ulang</p>
        <a href="/daur" class="menu-btn">Daur Ulang</a>
      </div>
    </div>
  </section>


  <section class="about-section" id="about">
    <div class="about-content">
      <div class="about-images">
        <img src="{{ asset('images/recycle.png') }}" alt="Recycle" class="about-img">
        <img src="{{ asset('images/sampah1.jpeg') }}" alt="Pollution" class="about-img">
        <img src="{{ asset('images/sampah1.jpeg') }}" alt="Garbage" class="about-img">
      </div>

      <div class="about-text">
        <h1 class="about-logo">hijau<span>IN</span></h1>
        <p>
          Kami hadir untuk membantu masyarakat dalam mengatasi masalah lingkungan seperti sampah liar, limbah pabrik yang belum diolah, dan sungai yang mampet akibat sampah.
        </p>
        <p>
          Kami juga menerima barang-barang yang dapat didaur ulang agar bisa lebih bermanfaat dan tidak mencemari lingkungan.
        </p>
      </div>
    </div>
  </section>


   <footer class="contact-section" id="contact">
    <h2>Contact Us</h2>
    <div class="contact-info">
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


    <nav class="bottom-navbar">
    <a href="#home" class="active">
      <img src="{{ asset('icons/home.png') }}" alt="Home">
      <span>Home</span>
    </a>
    <a href="#menu">
      <img src="{{ asset('icons/menu.png') }}" alt="Menu">
      <span>Menu</span>
    </a>
    <a href="#about">
      <img src="{{ asset('icons/about.png') }}" alt="About">
      <span>About</span>
    </a>
    <a href="#contact">
      <img src="{{ asset('icons/contact.png') }}" alt="Contact">
      <span>Contact</span>
    </a>
  </nav>

  <script>
    // Navbar smooth scroll active state
    const sections = document.querySelectorAll("section, main");
    const navLinks = document.querySelectorAll("header .navbar a, .bottom-navbar a");

    window.addEventListener("scroll", () => {
      let current = "";
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        if (scrollY >= sectionTop) {
          current = section.getAttribute("id");
        }
      });

      navLinks.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href").includes(current)) {
          link.classList.add("active");
        }
      });
    });

    document.querySelectorAll(".menu-btn").forEach(btn => {
      btn.addEventListener("click", () => {
        window.location.href = btn.getAttribute("href");
      });
    });
  </script>
</body>
</html>
