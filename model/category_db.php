<?php
function get_categories() {
    global $db;
    $query = 'SELECT * FROM categories
              ORDER BY CategoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
    return $categories;
}

function get_category_name($category_id) {
    if (!$category_id) {
        return "All Categories";
    }
    global $db;
    $query = 'SELECT * FROM categories
              WHERE CategoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $category = $statement->fetch();
    $statement->closeCursor();
    $category_name = $category['CategoryName'];
    return $category_name;


}

function add_category($category_name) {
    global $db;
    $query = 'INSERT INTO categories (CategoryName)
              VALUES (:CategoryName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':CategoryName', $category_name);
    $statement->execute();
    $statement->closeCursor();
}

function delete_category($category_id) {
    global $db;
    $query = 'DELETE FROM categories
              WHERE CategoryID = :category_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}
?>