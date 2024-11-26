<?php
require_once 'C:\xampp\htdocs\smartfarmproduit2.6\nour.php';
include(__DIR__ . '/../Model/Categorie.php');

class CategoryController
{
    // CREATE: Add a new category
    public function addCategory($category)
    {
        $sql = "INSERT INTO categories (nomcategorie) VALUES (:nomcategorie)";
        $nour = nour::getConnexion();
        
        try {
            $query = $nour->prepare($sql);
            $query->execute([
                'nomcategorie' => $category->getNomCategorie()
            ]);
            echo "Category added successfully!";
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // READ: List all categories
    public function listCategories()
    {
        $sql = "SELECT * FROM categories";
        $nour = nour::getConnexion();
        
        try {
            $liste = $nour->query($sql);
            return $liste; // Return the list of categories
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // READ: Show a specific category by its name
    public function showCategory($nomcategorie)
    {
        $sql = "SELECT * FROM categories WHERE nomcategorie = :nomcategorie";
        $nour = nour::getConnexion();
        
        try {
            $query = $nour->prepare($sql);
            $query->bindValue(':nomcategorie', $nomcategorie, PDO::PARAM_STR);
            $query->execute();
            $category = $query->fetch();
            return $category; // Return the category data
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // UPDATE: Update a category name
    public function updateCategory($oldCategoryName, $newCategoryName)
    {
        $sql = "UPDATE categories SET nomcategorie = :newCategoryName WHERE nomcategorie = :oldCategoryName";
        $nour = nour::getConnexion();

        try {
            $query = $nour->prepare($sql);
            $query->execute([
                'oldCategoryName' => $oldCategoryName,
                'newCategoryName' => $newCategoryName
            ]);
            echo "Category updated successfully!";
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    

    // DELETE: Delete a category by its name
    public function deleteCategory($nomcategorie)
    {
        $sql = "DELETE FROM categories WHERE nomcategorie = :nomcategorie";
        $nour = nour::getConnexion();
        
        try {
            $query = $nour->prepare($sql);
            $query->bindValue(':nomcategorie', $nomcategorie, PDO::PARAM_STR);
            $query->execute();
            echo "Category deleted successfully!";
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
}
?>
