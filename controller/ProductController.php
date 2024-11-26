<?php
require_once __DIR__ . '/../nour.php';
include __DIR__ . '/../Model/Product.php';

class ProductController
{
    private $db;

    public function __construct($db = null)
    {
        $this->db = $db ?: nour::getConnexion();
    }

    public function listProducts()
    {
        $sql = "SELECT * FROM products";
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function addProduct($product)
    {
        $sqlCheckCategory = "SELECT * FROM categories WHERE nomcategorie = :nomcategorie";
        $nour = nour::getConnexion();

        try {
            $stmtCheck = $nour->prepare($sqlCheckCategory);
            $stmtCheck->bindValue(':nomcategorie', $product->getNomCategorie(), PDO::PARAM_STR);
            $stmtCheck->execute();

            if ($stmtCheck->rowCount() === 0) {
                echo "Category does not exist!";
                return false;
            }

            // Prepare the SQL to insert the product including the image
            $sql = "INSERT INTO products (nomprod, priceprod, descriptionprod, nomcategorie, imageprod)
                    VALUES (:nomprod, :priceprod, :descriptionprod, :nomcategorie, :imageprod)";

            $query = $nour->prepare($sql);
            $params = [
                'nomprod' => $product->getNomProd(),
                'priceprod' => $product->getPriceProd(),
                'descriptionprod' => $product->getDescriptionProd(),
                'nomcategorie' => $product->getNomCategorie(),
                'imageprod' => $product->getImageProd()  // Assuming this method retrieves the image data
            ];

            $query->execute($params);
            echo "Product added successfully!";
            return true;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function showProduct($idprod)
    {
        $sql = "SELECT * FROM products WHERE idprod = :idprod";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idprod', $idprod, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    public function deleteProduct($idprod)
    {
        $sql = "DELETE FROM products WHERE idprod = :idprod";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':idprod', $idprod, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
    }

    public function updateProduct($product)
    {
        $sqlCheckCategory = "SELECT * FROM categories WHERE nomcategorie = :nomcategorie";
        $nour = nour::getConnexion();
        
        try {
            // Check if category exists if it's provided
            if ($product->getNomCategorie() !== null) {
                $stmtCheck = $nour->prepare($sqlCheckCategory);
                $stmtCheck->bindValue(':nomcategorie', $product->getNomCategorie(), PDO::PARAM_STR);
                $stmtCheck->execute();
        
                if ($stmtCheck->rowCount() === 0) {
                    echo "Category does not exist!";
                    return false;
                }
            }
    
            // Build the dynamic SQL query
            $fieldsToUpdate = [];
            $params = ['idprod' => $product->getIdProd()];  // Use getIdProd from the product object
        
            // Update product name if provided
            if ($product->getNomProd() !== null) {
                $fieldsToUpdate[] = "nomprod = :nomprod";
                $params['nomprod'] = $product->getNomProd();
            }
        
            // Update product price if provided
            if ($product->getPriceProd() !== null) {
                $fieldsToUpdate[] = "priceprod = :priceprod";
                $params['priceprod'] = $product->getPriceProd();
            }
        
            // Update product description if provided
            if ($product->getDescriptionProd() !== null) {
                $fieldsToUpdate[] = "descriptionprod = :descriptionprod";
                $params['descriptionprod'] = $product->getDescriptionProd();
            }
        
            // Update category name if provided
            if ($product->getNomCategorie() !== null) {
                $fieldsToUpdate[] = "nomcategorie = :nomcategorie";  // Ensure you're updating category name, not ID
                $params['nomcategorie'] = $product->getNomCategorie();
            }
        
            // Update image if provided
            if ($product->getImageProd() !== null) {
                $fieldsToUpdate[] = "imageprod = :imageprod";  // Add image field to update
                $params['imageprod'] = $product->getImageProd();
            }
    
            // Ensure there are fields to update
            if (empty($fieldsToUpdate)) {
                echo "No fields to update.";
                return false;
            }
    
            // Construct the dynamic SQL query
            $sql = 'UPDATE products SET ' . implode(', ', $fieldsToUpdate) . ' WHERE idprod = :idprod';
            $query = $nour->prepare($sql);
            $query->execute($params);
        
            echo $query->rowCount() . " record(s) UPDATED successfully!";
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}