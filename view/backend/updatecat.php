<?php
// Include necessary files
include '../../controller/CategorieController.php';
require_once 'C:\xampp\htdocs\smartfarmproduit2.6\nour.php';

// Initialize variables
$oldCategoryName = ""; // Old category name
$error = "";

// Check if the old category name is provided via GET
if (isset($_GET['nomcategorie'])) {
    $oldCategoryName = $_GET['nomcategorie'];
}

// Process the form submission
if (isset($_POST['newCategoryName']) && isset($_POST['oldCategoryName'])) {
    $newCategoryName = $_POST['newCategoryName'];
    $oldCategoryName = $_POST['oldCategoryName'];

    // Update the category
    $categoryController = new CategoryController();
    $result = $categoryController->updateCategory($oldCategoryName, $newCategoryName);

    if ($result) {
        echo "Category updated successfully!";
    } else {
        header('Location: listcat.php');
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
      <h2 class="text-center">Update Category</h2>
      <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>
      <form id="categoryForm" action="updatecat.php" method="POST">
        <input type="hidden" name="oldCategoryName" value="<?= htmlspecialchars($oldCategoryName); ?>">
        <div class="mb-3">
          <label for="newCategoryName" class="form-label">New Category Name</label>
          <input type="text" name="newCategoryName" class="form-control" id="newCategoryName" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Update Category</button>
      </form>
    </div>
  </main>

  <footer id="footer" class="footer dark-background">
    <!-- Footer content -->
  </footer>

  <script src="../backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../backend/main.js"></script>
</body>
</html>
