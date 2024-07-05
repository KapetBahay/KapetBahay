<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kape'tBahay</title>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <?php 
      echo '<link rel="stylesheet" href="assets/css/styles.css"/>';
    ?>
  </head>
  <body>
    <!-- NAVBAR -->
    <nav
      class="nav-style navbar navbar-expand-lg animate__animated animate__fadeInDown"
    >
      <div class="nav-content container">
        <a class="logo navbar-brand" href="/kapetbahay/">
          <img src="assets/Images/logo.png" alt="logo" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/kapetbahay/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/kapetbahay/#prod">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/kapetbahay/branches">Location</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/kapetbahay/about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/kapetbahay/contact">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- SECTION: BANNER -->
    <section class="hero-about">
      <div class="main-hero container">
        <div class="row">
          <div
            class="about-content d-flex align-items-center justify-content-between"
          >
            <div class="content animate__animated animate__fadeInDown">
              <h1 class="main-content">
                <span class="d-flex align-items-center">
                  All About
                  <div class="content-logo">
                    <img src="assets/Images/content-logo.png" alt="" />
                  </div>
              </h1>
              <h3>Your Home, Your Coffee that holds you.</h3>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION: HISTORY, ACHIEVEMENTS, WHAT TO OFFER -->
    <section class="history">
      <div class="container text-center">
        <div class="row align-items-center">
          <div class="col-5">
            <h4 class="start">Kape'tBahay Mabalacat</h4>
            <img class="history-img" src="assets/Images/KAPETBAHAY.jpg" alt="" />
          </div>
          <div class="col-7">
            <h4 class="start">GET TO KNOW US</h4>
            <div class="container-content">
              <p class="text">
                Founded in 2024 in the heart of Mabalacat, Pampanga, Kape'tBahay is more than just a café—it's a haven where tradition meets innovation. Inspired by the warm, inviting essence of a Filipino home, our name translates to "Coffee and Home," reflecting our commitment to creating a cozy, family-friendly atmosphere where everyone feels welcome.
              </p>
              <p class="text">
                At Kape'tBahay, we take pride in serving locally sourced coffee and homemade treats that celebrate the rich culinary heritage of Pampanga. Our menu features a delightful blend of traditional Filipino flavors and contemporary twists, offering something special for every palate. Whether you're here for a quick coffee break, a leisurely brunch, or a cozy evening with friends, we aim to make every visit a memorable experience.
              </p>
              <p class="text">
                Our café is a testament to our love for community and culture. With comfortable seating, warm lighting, and a welcoming ambiance, Kape'tBahay is the perfect spot to relax, unwind, and enjoy the simple pleasures of good coffee and great company. We also host regular events, from live music to cultural nights, to bring people together and celebrate the vibrant spirit of Mabalacat.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="offers">
      <div class="container text-center">
        <div class="row">
          <div class="col">
            <h4 class="start">WHAT TO OFFER?</h4>
            <div class="container-content">
              <p class="text">
                Kape'tBahay offers a cozy, home-like atmosphere where guests can enjoy locally sourced coffee, a variety of homemade treats, traditional Filipino delicacies, and savory dishes that celebrate the rich culinary heritage of Pampanga, all served with genuine hospitality.
              </p>

              <div class="d-flex justify-content-center">
                <div class="mission">
                  <h4 class="start">MISSION</h4>
                  <div class="container-content">
                    <p class="texts">At Kape'tBahay, our mission is to create a warm and inviting space that feels like home, where guests can savor the authentic flavors of Pampanga through our locally sourced coffee and homemade treats. We are dedicated to promoting local farmers, preserving culinary traditions, and fostering a sense of community by providing exceptional service and a welcoming environment for everyone.</p>
                  </div>
                </div>

                <div class="vision">
                  <h4 class="start">VISION</h4>
                  <div class="container-content">
                    <p class="texts">Our vision is to become the leading café in Mabalacat, Pampanga, known for our commitment to quality, sustainability, and cultural heritage. We aspire to be a beloved gathering place where people come together to enjoy delicious food and drinks, celebrate local traditions, and create lasting memories. Through our efforts, we aim to inspire a deeper appreciation for Filipino cuisine and support the growth of local agriculture and small businesses.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer>
      <div class="footer-content">
        <p>&copy; 2024 Kapet Bahay. All rights reserved.</p>
      </div>
    </footer>
  </body>
</html>
