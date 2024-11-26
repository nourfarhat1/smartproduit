<?php 
include '../../controller/ProductController.php'; 
require_once 'C:\xampp\htdocs\smartfarmproduit2.6\nour.php'; 
$productController = new ProductController();
$productController->deleteProduct($_GET["idprod"]); 
header('Location: listprod.php');  
?>

