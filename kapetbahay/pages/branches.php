<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kape'tBahay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <?php 
      echo '<link rel="stylesheet" href="assets/css/styles.css"/>';
    ?>
  </head>

  <body>
    <!-- ITO YONG NAVBAR GUYS -->
    <nav
      class="nav-style navbar navbar-expand-lg animate__animated animate__fadeInDown"
    >
      <div class="nav-content container">
        <a class="logo navbar-brand" href="/kapetbahay/"
          ><img src="assets/Images/logo.png" alt="logo"
        /></a>
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
              <a class="nav-link" href="/kapetbahay/#Prod">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/kapetbahay/branches">Location</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/kapetbahay/about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/kapetbahay/contact">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- ITO AY SECTION NG BANNER -->
    <section class="hero-branches">
      <div class="main-hero container">
        <div class="row">
          <div
            class="branches-content d-flex align-items-center justify-content-center"
          >
            >
            <div class="content animate__animated animate__fadeInDown">
              <h1 class="main-content">
                Welcome Home to Kape't Bahay
              </h1>
              <div class="content-button text-center">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <img src="assets/Images/cafeeee.jpg" class="img-fluid" alt="...">
    <!-------------------------------------------- -->

    <section class="products-section">
      <div class="container">
        <!-- sample -->
        <div class="branch-container container">
          <div class="title-branch text-center"></div>
          <div class="branch row align-items-center">
            <div
              class="branches branch-img col-lg-5 col-md-5 col-sm-4 col-xs-12"
            >
              <img src="assets/Images/woman.png" alt="" />
            </div>
            <div
              class="branches branch-content col-lg-7 col-md-7 col-sm-8 col-xs-12"
            >
              <h2>HERE AT KAPE’T BAHAY</h2>
              <p>
                <b>MCARTHUR HIGHWAY, MABALACAT, PAMPANGA:</b> <br>
                At Kape'tBahay, we strive to create a space that feels like a second home, and our dedicated staff plays a crucial role in making that vision a reality. The moment you walk through our doors, you're greeted with warm smiles and genuine hospitality that instantly put you at ease. Our interior, with its cozy, home-like decor, complements this friendly atmosphere, featuring rustic wooden furniture, soft lighting, and cultural accents that reflect the rich heritage of Pampanga. Our staff goes above and beyond to ensure your comfort, treating you like a cherished guest in their own home. From personalized recommendations to attentive service, every interaction is filled with care and consideration, making you feel valued and appreciated. At Kape'tBahay, we are committed to providing an experience that is not just about great coffee and delicious food, but also about creating lasting memories in a place where you feel truly at home
              </p>
            </div>
          </div>
          </div>
        </div>
      </div>
    </section>

    <div class="row">
      <div class="column">
        <img src="assets/Images/2.jpg" alt="Snow" style="width:100%">
      </div>
      <div class="column">
        <img src="assets/Images/1.jpg" alt="Forest" style="width:100%">
      </div>
      <div class="column">
        <img src="assets/Images/3.jpg" alt="Mountains" style="width:100%">
      </div>
    </div>

    <footer>
      <div class="footer-content">
        <p>&copy; 2023 Julie's Bakeshop. All rights reserved.</p>
      </div>
    </footer>
  </body>
</html>
