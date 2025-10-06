<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tralive</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.min.css">

  <!-- Google Font (Poppins) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/home.css">
</head>

<body>
  <!-- navbar start -->
  <!-- Hero Section -->
  <div class="hero-section">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <!-- Logo -->
        <img src="assets/images/logo.png.webp" alt="Logo" class="logo img-fluid">

        <!-- Mobile Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav m-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>

            <!-- Dropdown with hover -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="eventDropdown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Event
              </a>
              <ul class="dropdown-menu" aria-labelledby="eventDropdown">
                <li><a class="dropdown-item" href="#">Event Details</a></li>
                <li><a class="dropdown-item" href="#">Upcoming Events</a></li>
                <li><a class="dropdown-item" href="#">Past Events</a></li>
              </ul>
            </li>

            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Content</a></li>
          </ul>

          <!-- sign-in Buttons -->
          <div class="d-flex align-items-center gap-3">
            <?php if (!empty($_SESSION['user_id'])): ?>
              <!-- Agar user logged in hai to profile image ya icon dikhana -->
              <div class="dropdown1">
                <a href="profile.php" class="signin-btn dropdown-toggle">
                  <?php if (!empty($_SESSION['profile_img'])): ?>
                    <img src="uploads/<?php echo $_SESSION['profile_img']; ?>" alt="Profile">
                  <?php else: ?>
                    <i class="fas fa-user"></i>
                  <?php endif; ?>
                </a>

                <!-- Dropdown menu -->
                <div class="dropdown-menu1">
                  <a class="dropdown-item1" href="profile.php"> <i class="fas fa-user-circle"></i>Profile</a>
                  <a class="dropdown-item1" href="logout.php"> <i class="fas fa-sign-out-alt"></i>Logout</a>
                </div>
              </div>
            <?php else: ?>
              <!-- Agar login nahi hai to normal icon -->
              <div class="dropdown1">
                <a href="sign-in.php" class="signin-btn dropdown-toggle">
                  <i class="fas fa-user"></i>
                </a>

                <!-- Dropdown menu -->
                <div class="dropdown-menu1">
                  <a class="dropdown-item" href="sign-in.php">Join Us</a>
                </div>
              </div>
            <?php endif; ?>
          </div>

        </div>

      </div>
    </nav>

    <!-- Hero Text -->
    <div class="hero-text">
      <p class="center-text">
        Lifelong memories just a <span class="highlight-box">few seconds away</span>
      </p>
      <p class="text">
        Let's start your journey with us, your dream will come true
      </p>
      <div class="btn-gradient-container">
        <button class="btn-gradient"><span>Explore Destination</span></button>
      </div>
    </div>

    <!-- Background Image -->
    <div class="img-container">
      <img src="assets/images/scenery img1.jpg" alt="scenery img" class="main-img">
    </div>
  </div>

  <p class="para-1">Check our best promotional tour</p>
  <p class="para-2">Upcoming Events</p>
  <!-- card-silder-open -->
  <div id="cardCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="row justify-content-center">
          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Swiss Alps.jpg" class="card-img-top" alt="Swiss Alps">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title fw-bold mb-0">Swiss Alps</h5>
                  <h5 class=" text-primary mb-0">$2500</h5>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="badge bg-light text-primary">2 Jul – 9 Jul</span>
                  <span class="fw-bold text-dark">8 Days</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Bali.avif" class="card-img-top" alt="Bali">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title fw-bold mb-0">Bali</h5>
                  <h5 class=" text-primary mb-0">$1300</h5>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="badge bg-light text-primary">12 May – 18 May</span>
                  <span class="fw-bold text-dark">7 Days</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Banff National Park.jpg" class="card-img-top" alt="Banff National Park">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title fw-bold mb-0">Banff National Park</h5>
                  <h5 class=" text-primary mb-0">$2000</h5>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="badge bg-light text-primary">15 jun - 22 jun</span>
                  <span class="fw-bold text-dark">8 Days</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="row justify-content-center">
          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Santorin.jpg" class="card-img-top" alt="Santorini">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title fw-bold mb-0">Santorini</h5>
                  <h5 class=" text-primary mb-0">$1700</h5>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="badge bg-light text-primary">1 Sep – 6 Sep</span>
                  <span class="fw-bold text-dark">6 Days</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Spitzbergen.jpeg" class="card-img-top" alt="Spitzberg">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title fw-bold mb-0">Spitzberg</h5>
                  <h5 class=" text-primary mb-0">$2200</h5>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="badge bg-light text-primary">10 jan - 17 jan</span>
                  <span class="fw-bold text-dark">8 Days</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Kyoto.jpeg" class="card-img-top" alt="Kyoto">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <h5 class="card-title fw-bold mb-0">Kyoto</h5>
                  <h5 class=" text-primary mb-0">$1800</h5>
                </div>
                <div class="d-flex justify-content-between">
                  <span class="badge bg-light text-primary">25 Mar – 31 Mar</span>
                  <span class="fw-bold text-dark">7 Days</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#cardCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#cardCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  <!-- card-slider-close -->
  <!-- get ready section open -->
  <div class="ready-container">
    <img src="assets/images/travle-png.png" alt="travle" class="travel-img">

    <div class="travlive-section">
      <!-- 👇 About Us add kiya heading ke bilkul upar -->
      <p class="about-text">About Us</p>

      <h3 class="travlive-heading">TravLive — Your Journey, Our Guidance</h3>
      <p class="travlive-paragraph">
        TravLive is a modern travel website designed to make your journeys simple and enjoyable.
        From popular destinations and hotels to affordable flight deals and travel packages,
        TravLive helps you plan your trips with ease. Whether it’s a family holiday, a solo adventure,
        or a getaway with friends, TravLive is here to guide you every step of the way.
      </p>
      <div class="btn-gradient-container2">
        <button class="btn-gradient2"><span>Explore Destination</span></button>
      </div>
    </div>
  </div>

  <!-- get ready section close -->
  <!-- box section open  -->
  <div class="testimonial-box">
    <div class="dots">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>

    <h2>What customers say</h2>
    <p>
      "Let’s start your journey with us, your dream will come true.
      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."
    </p>

    <div class="author">
      <img src="assets/images/CEO photo.jpg" alt="CEO Photo">
      <div class="author-name">Fida Ullah</div>
      <div class="author-role">CEO of Travlive</div>
    </div>
  </div>
  <!-- box section close -->
  <!-- FAQ Section open -->
  <div class="faq-section">
    <div class="faq-header">
      <span class="faq-subtitle">FAQ</span>
      <h2 class="faq-heading">Full range of travel service</h2>
    </div>
    <div class="faq-container">
      <div class="left-content">
        <div class="accordion">
          <div class="accordion-item">
            <div class="accordion-header">
              <span class="symbol">+</span> How can I book a trip with your service?.
            </div>
            <div class="accordion-body">Book directly on our website in a few clicks.</div>
          </div>

          <div class="accordion-item">
            <div class="accordion-header">
              <span class="symbol">+</span>Can I cancel or reschedule my booking?
            </div>
            <div class="accordion-body">Yes, changes allowed up to 48 hours before departure.</div>
          </div>

          <div class="accordion-item">
            <div class="accordion-header">
              <span class="symbol">+</span> Do you offer travel packages with hotels and flights included?
            </div>
            <div class="accordion-body">Yes, we provide complete packages with flights and hotels.</div>
          </div>

          <div class="accordion-item">
            <div class="accordion-header">
              <span class="symbol">+</span>Is customer support available during the trip?
            </div>
            <div class="accordion-body">Yes, support is available 24/7 during your trip.</div>
          </div>
        </div>
      </div>

      <div class="right-content">
        <div class="illustration-img">
          <img src="assets/images/FAQ img.png" alt="FAQ-illustration-img">
        </div>
      </div>
    </div>
  </div>
  <!--FAQ button open-->
  <div class="btn-gradient-container3">
    <button class="btn-gradient3"><span>Explore Destination</span></button>
  </div>
  <!--FAQ button close-->
  <!-- FAQ Section Close -->
  <!--video section open-->
  <div class="video-container">
    <video width="70%" height="auto" autoplay loop muted playsinline>
      <source src="assets/video/tourism-place.mp4" type="video/mp4">
    </video>
  </div>
  <!--video section close-->
  <!-- swiper carousel open-->
  <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="row justify-content-center g-0">
          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Swiss Alps.jpg" class="card-img-top img1" alt="Swiss Alps" draggable="false">
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Bali.avif" class="card-img-top img1" alt="Bali" draggable="false">
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Banff National Park.jpg" class="card-img-top img1" alt="Banff National Park" draggable="false">
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/swiper img3.jfif" class="card-img-top img1" alt="Banff National Park" draggable="false">
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="row justify-content-center g-0">
          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Santorin.jpg" class="card-img-top img1" alt="Santorini" draggable="false">
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Spitzbergen.jpeg" class="card-img-top img1" alt="Spitzberg" draggable="false">
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/Kyoto.jpeg" class="card-img-top img1" alt="Kyoto" draggable="false">
            </div>
          </div>

          <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4">
              <img src="assets/images/swiper img1.jfif" class="card-img-top img1" alt="thailand" draggable="false">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- swiper carousel close-->

  <!-- footer open-->
  <footer>
    <div class="footer-container">

      <!-- Logo & About -->
      <div class="footer-logo">
        <img src="assets/images/footer logo.png" alt="Logo" class="footer-icon">
        <p>Land behold it created good saw after she'd Our set living. Signs midst dominion creepth morning laboris nisi ufist aliquip.</p>
        <div class="social-icons">
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-linkedin"></i></a>
          <a href="#"><i class="fab fa-pinterest"></i></a>
          <a href="#"><i class="fab fa-google-play"></i></a>
          <a href="#"><i class="fab fa-tiktok"></i></a>
        </div>

      </div>

      <!-- Navigation -->
      <div class="footer-col">
        <h3>Navigation</h3>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Event</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>

      <!-- Services -->
      <div class="footer-col">
        <h3>Services</h3>
        <ul>
          <li><a href="#">Bali</a></li>
          <li><a href="#">Swiss Alps</a></li>
          <li><a href="#">Banff National Park</a></li>
          <li><a href="#">Spitzberg</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="footer-col contact-info">
        <h3>Contact Us</h3>
        <p>76/A, Green Lane, Dhanmondi, NYC</p>
        <p>demomail89@gmail.com</p>
        <a href="tel:+10787389083">+10 (78) 738-9083</a>
      </div>

    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
      <p>Copyright ©2025 All rights reserved | This template is made with <i class="fa-solid fa-heart" style="color:#5a8dee"></i> by <a href="#">Tralive</a></p>
    </div>
  </footer>
  <!-- footer close-->

  <!-- back to top open -->
  <button id="backToTop"><i class="fas fa-arrow-up"></i></button>
  <!-- back to top close  -->


  <!-- js section -->
  <script src="assets/js/home.js"></script>
  <!--bootstrap js-->
  <script src="assets/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>