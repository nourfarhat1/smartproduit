<?php
include "../../controller/productcontroller.php";
require_once 'C:\xampp\htdocs\smartfarmproduit2.6\nour.php';

$error = "";
$product = null;
$productController = new ProductController();

if (
  isset($_POST["nomprod"]) &&
  isset($_POST["nomcategorie"]) &&
  isset($_POST["priceprod"]) &&
  isset($_POST["descriptionprod"]) &&
  isset($_FILES["imageprod"]) // Check if an image file was uploaded
) {
  if (
      !empty($_POST['nomprod']) &&
      !empty($_POST["nomcategorie"]) &&
      !empty($_POST["priceprod"]) &&
      !empty($_POST["descriptionprod"]) &&
      $_FILES["imageprod"]["error"] === UPLOAD_ERR_OK // Ensure the file was uploaded without errors
  ) {
      // Read the image content
      $imageData = file_get_contents($_FILES["imageprod"]["tmp_name"]);

      $product = new Product(
          null, // Let the DB auto-generate the ID
          $_POST['nomprod'], // Product Name
          $_POST['nomcategorie'], // Category Name (nomcategorie)
          $_POST['priceprod'], // Product Price
          $_POST['descriptionprod'], // Product Description
          $imageData // Image data
      );

      if ($productController->addProduct($product)) {
          // Successfully added product, redirect to the product list page
          header('Location: listprod.php');
          exit();
      } else {
          // If there was an error in adding the product
          $error = "Error adding product.";
      }
  } else {
      $error = "Please fill all fields and upload a valid image.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Marcellus:wght@400&display=swap" rel="stylesheet">

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
    <div class="card p-4">
      <h2 class="text-center">Upload Product</h2>
      <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>
      <form id="productForm" action="" method="POST" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
        <div class="mb-3">
          <label for="productName" class="form-label">Nom de produit</label>
          <input type="text" name="nomprod" class="form-control" id="productName" required>
        </div>
        <div class="mb-3">
          <label for="productCategorie" class="form-label">Categorie</label>
          <input type="text" name="nomcategorie" class="form-control" id="productCategorie" required>
        </div>
        <div class="mb-3">
          <label for="productDescription" class="form-label">Description</label>
          <textarea name="descriptionprod" class="form-control" id="productDescription" rows="4" required></textarea>
        </div>
        <div class="mb-3">
          <label for="productPrice" class="form-label">Prix ($)</label>
          <input type="number" name="priceprod" class="form-control" id="productPrice" required>
        </div>
        <div class="mb-3">
          <label for="imageprod" class="form-label">Image du produit</label>
          <input type="file" name="imageprod" class="form-control" id="imageprod" accept="image/*" required> <!-- File input for image -->
        </div>
        <button type="submit" class="btn btn-success w-100">Upload Product</button>
      </form>
    </div>
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
              <p class="mt-3"><strong>Phone:</strong> <span>53 *** *** </span></p>
              <p><strong>Email:</strong> <span>agri.vators@gmail.com</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="../backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../backend/main.js"></script>

  <!-- JavaScript for form validation -->
  <script>
   document.getElementById('productForm').addEventListener('submit', function(event) {
      let errorMessage = "";
      let isValid = true;

      // Validate Product Name
      let productName = document.getElementById('productName').value.trim();
      if (!productName) {
        errorMessage += "Product name is required.\n";
        isValid = false;
      }

      // Validate Product Description
      let productDescription = document.getElementById('productDescription').value.trim();
      if (!productDescription) {
        errorMessage += "Product description is required.\n";
        isValid = false;
      }

      // Validate Product Price
      let productPrice = document.getElementById('productPrice').value.trim();
      if (!productPrice || isNaN(productPrice) || parseFloat(productPrice) <= 0) {
        errorMessage += "Product price must be a valid number greater than zero.\n";
        isValid = false;
      }

      // Validate Category
      let productCategory = document.getElementById('productCategorie').value;
      if (!productCategory) {
        errorMessage += "Please insert a category.\n";
        isValid = false;
      }

      // Validate Image
      let productImage = document.getElementById('imageprod').files[0];
      if (!productImage) {
        errorMessage += "Please upload an image.\n";
        isValid = false;
      }

      if (!isValid) {
        alert(errorMessage);
        event.preventDefault();
      }
  });
  </script>
</body>
</html>