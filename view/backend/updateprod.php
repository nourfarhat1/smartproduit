<?php
include '../../controller/ProductController.php';
require_once 'C:\xampp\htdocs\smartfarmproduit2.6\nour.php';

$productController = new ProductController();
$error = "";

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["nomprod"]) && !empty($_POST["nomcategorie"]) && !empty($_POST["priceprod"]) && !empty($_POST["descriptionprod"])) {
        $nomprod = htmlspecialchars($_POST['nomprod']);
        $nomcategorie = htmlspecialchars($_POST['nomcategorie']);
        $priceprod = htmlspecialchars($_POST['priceprod']);
        $descriptionprod = htmlspecialchars($_POST['descriptionprod']);
        $idprod = $_POST['idprod'];  // We need to pass the product ID for the update.

        // Handle image upload
        $imageprod = null;
        if (isset($_FILES['imageprod']) && $_FILES['imageprod']['error'] === UPLOAD_ERR_OK) {
            $imageprod = file_get_contents($_FILES['imageprod']['tmp_name']); // Get the image data
        } else {
            // If no new image is uploaded, set to current image (or handle according to your needs)
            $currentProduct = $productController->showProduct($idprod);
            $imageprod = $currentProduct['imageprod']; // Retain existing image
        }

        // Create the product object with the provided ID and details
        $product = new Product(
            $idprod,  // Pass the product ID for update
            $nomprod,
            $nomcategorie,
            $priceprod,
            $imageprod, // Updated image data
            $descriptionprod
        );

        // Proceed to update the product
        if ($productController->updateProduct($product)) {
            header('Location: listprod.php');  // Redirect to product list after update
            exit;
        } else {
            $error = "Failed to update product.";
        }
    } 
}

// Fetch product details for the update form
$productToEdit = null;
if (isset($_GET['idprod'])) {
    $productToEdit = $productController->showProduct($_GET['idprod']);
    if (!$productToEdit) {
        $error = "Product not found.";
    }
}
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
    <div class="card p-4">
        <h2 class="text-center">Update Product</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form id="productForm" action="" method="POST" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
            <input type="hidden" name="idprod" value="<?= htmlspecialchars($productToEdit['idprod'] ?? ''); ?>"> <!-- Keep the product ID -->
            <div class="mb-3">
                <label for="nomprod" class="form-label">Product Name</label>
                <input type="text" name="nomprod" class="form-control" id="nomprod" 
                    value="<?= htmlspecialchars($productToEdit['nomprod'] ?? ''); ?>" >
            </div>

            <div class="mb-3">
                <label for="nomcategorie" class="form-label">Category</label>
                <input name="nomcategorie" class="form-control" id="nomcategorie" 
                    value="<?= htmlspecialchars($productToEdit['nomcategorie'] ?? ''); ?>" >
            </div>

            <div class="mb-3">
                <label for="descriptionprod" class="form-label">Product Description</label>
                <textarea name="descriptionprod" class="form-control" id="descriptionprod" rows="4" ><?= htmlspecialchars($productToEdit['descriptionprod'] ?? ''); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="priceprod" class="form-label">Price ($)</label>
                <input type="number" name="priceprod" class="form-control" id="priceprod" 
                    value="<?= htmlspecialchars($productToEdit['priceprod'] ?? ''); ?>" >
            </div>

            <div class="mb-3">
                <label for="imageprod" class="form-label">Product Image (optional)</label>
                <input type="file" name="imageprod" class="form-control" id="imageprod" accept="image/*">
            </div>

            <button type="submit" class="btn btn-success w-100" aria-label="Update Product">Update Product</button>
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