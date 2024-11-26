<?php
include '../../controller/CategorieController.php';
require_once 'C:\xampp\htdocs\smartfarmproduit2.6\nour.php';


// Ensure 'nomcategorie' is passed via GET
if (isset($_GET["nomcategorie"])) {
    $nomcategorie = $_GET["nomcategorie"];

    // Create the CategoryController object
    $categoryController = new CategoryController();

    // Attempt to delete the category
    $result = $categoryController->deleteCategory($nomcategorie);

    if ($result) {
        // Successful deletion, redirect to the list page
        header('Location: listcat.php');
        exit(); // Always call exit after header redirection to prevent further script execution
    } else {
        header('Location: listcat.php');
    }
} else {
    echo "Category name (nomcategorie) not provided.";
}
?>
