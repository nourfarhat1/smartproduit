<?php
include '../../controller/ProductController.php';
require_once 'C:\xampp\htdocs\smartfarmproduit2.6\nour.php';
$productController = new ProductController();
$products = $productController->listProducts(); // Fetch products
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&family=Marcellus:wght@400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../backend/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../backend/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="../backend/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="../frontend/main.css" rel="stylesheet">
</head>
<body>

  <header id="header" class="header d-flex align-items-center position-relative">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../backend/assets/img/our logo.png" alt="Agrivatorslogo">
        <h1 class="sitename">smartfarm</h1> 
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="../frontend/index.html">Home</a></li>
          <li><a href="../frontend/about.html">About Us</a></li>
          <li><a href="../frontend/NOURservices.html" class="active">Our Services</a></li>
          <li><a href="../frontend/AHMEDblog.html">Blog</a></li>
          <li><a href="../frontend/NASSIMlogin.html">Login</a></li>
          <li><a href="../frontend/AZIZreclamation.html">Reclamations</a></li>
          <li><a href="../frontend/SAMERpanier.html">Panier</a></li>
          <li><a href="../frontend/MAYSSOUNevents.html">Events</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="container my-5">
    <!-- Display Products -->
    <section id="product-display" class="mt-5">
      <h2 class="text-center">Product Listings</h2>
      <div class="row" id="product-list">
        <?php
        // Loop through each product and display it
        foreach ($products as $product) {
          // Ensure the product data is sanitized to prevent XSS
          $productName = htmlspecialchars($product['nomprod']);
          $productCategory = htmlspecialchars($product['nomcategorie']);
          $productId = htmlspecialchars($product['idprod']);
          $productPrice = htmlspecialchars($product['priceprod']);
          $productDescription = htmlspecialchars($product['descriptionprod']); // Add description
          $imageData = base64_encode($product['imageprod']); // Assuming imageprod is binary data
        ?>
        <div class="col-md-4 mb-4">
          <div class="card">
            <img src="data:image/jpeg;base64,<?= $imageData; ?>" class="card-img-top" alt="<?= $productName; ?>"> <!-- Display product image -->
            <div class="card-body">
              <h5 class="card-title"><?= $productName; ?></h5>
              <p class="card-text"><strong>Category:</strong> <?= $productCategory; ?></p>
              <p class="card-text"><strong>ID:</strong> <?= $productId; ?></p>
              <p class="card-text"><strong>Price:</strong> $<?= $productPrice; ?></p>
              <p class="card-text"><strong>Description:</strong> <?= $productDescription; ?></p> <!-- Display description -->
              <form method="POST" action="updateprod.php">
                <input type="hidden" value="<?= $productId; ?>" name="idprod">
                <button type="submit" class="btn btn-success">Update</button>
              </form>
              <a href="deleteprod.php?idprod=<?= $productId; ?>" class="btn btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </section>
  </main>

  <footer id="footer" class="footer dark-background">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="../backend/assets/img/our logo.png" alt="Agrivatorslogo">
              <h1 class="sitename">smartfarm</h1> 
            </a>
            <div class="footer-contact pt-3">
              <p>Tunisia, Esprit</p>
              <p class="mt-3"><strong>Phone:</strong> <span>53 *** ***</span></p>
              <p><strong>Email:</strong> <span>agri.vators@gmail.com</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="../backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../backend/main.js"></script>
</body>
</html>