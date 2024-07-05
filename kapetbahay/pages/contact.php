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
    <!-- NAVBAR -->
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
              <a class="nav-link" href="/kapetbahay/#prod">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/kapetbahay/branches">Location</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/kapetbahay/about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/kapetbahay/contact">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- BANNER SECTION -->
    <section class="hero-contact">
      <div class="main-hero container">
        <div class="row">
          <div
            class="contact-content d-flex align-items-center justify-content-between"
          >
            <div class="content animate__animated animate__fadeInDown">
              <h1 class="main-content">
                <span class="d-flex align-items-center"
                  >Message
                  <div class="content-logo">
                    <img src="assets/Images/content-logo.png" alt="" />
                  </div>
                  .</span
                >
              </h1>
              <h4>We Value Customers Feedback.</h4>
            </div>
            <div class="hero-img animate__animated animate__bounceIn"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTACT US SECTION -->
    <section class="contact-section">
      <div class="container d-flex">
        <div class="contact-form row">
          <div class="products-title text-center">
            <h2>Contact Us</h2>
          </div>
          <form>
            <div class="d-flex names">
              <div class="name mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="lastName"
                  placeholder="Last Name"
                />
              </div>

              <div class="name mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="firstName"
                  placeholder="First Name"
                />
              </div>
            </div>

            <div class="mb-3">
              <input
                type="text"
                class="form-control"
                id="middleName"
                placeholder="Middle Name"
              />
            </div>

            <div class="mb-3">
              <input
                type="email"
                class="form-control"
                id="email"
                placeholder="Email"
              />
            </div>

            <div class="mb-3">
              <input
                type="number"
                class="form-control"
                id="contactNumber"
                placeholder="Contact Number"
              />
            </div>

            <div class="mb-3">
              <textarea
                class="form-control"
                id="message"
                rows="3"
                placeholder="Message"
              ></textarea>
            </div>

            <button type="button" class="btn btn-outline-danger">Send</button>
          </form>
        </div>

        <div class="contact-details row">
          <div class="details text-start">
            <h2><br /><br />Kape'tBahay</h2>
            <p>Smart: 099771954822 </p>
            <p>Email: kapetbahay@gmail.com</p>
            <p>McArthur Highway, Mabalacat, Pampanga</p>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="footer-content">
        <p>&copy; 2024 Kapet Bahay. All rights reserved.</p>
      </div>
    </footer>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-lytjvYDAs3FJyLSizq6cQqY5YSbP7IyRwa1ltGOu8VQlxF0CZmb7PbTG0QCO0+lr"
      crossorigin="anonymous"
    ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="script.js"></script>
  </body>
</html>
