<?php

//grabs all rows that have a specific category ID
function get_items_by_category($category_id)
{
    global $db;
    if ($category_id) {
    $query = 'SELECT I.ItemNum, I.Description, C.CategoryName FROM todoitems I LEFT JOIN
                category C ON I.CategoryID = C.CategoryID 
                WHERE I.CategoryID = :category_id ORDER BY I.ItemNum';
                } else {
        'SELECT I.ItemNum, I.Description, C.CategoryName FROM todoitems I LEFT JOIN
                category C ON I.CategoryID = C.CategoryID 
                 ORDER BY C.CategoryID';
    }


    $statement = $db->prepare($query);
    $statement->bindValue(":category_id", $category_id);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    return $items;
}

//accecpts ItemNum as parameter and deletes a single row
function delete_items($ItemNum)
{
    global $db;
    $query =
        'DELETE FROM todoitems
              WHERE ItemNum = :item_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":item_id", $ItemNum);
    $statement->execute();
    $statement->closeCursor();
}

function add_items($category_id, $description)
{
    global $db;

    $query = 'INSERT INTO todoitems
                 (Description, CategoryID)
              VALUES
                 (:Description, :CategoryID)';
    $statement = $db->prepare($query);
    $statement->bindValue(":Description", $description);
    $statement->bindValue(":CategoryID", $category_id);
    $statement->execute();
    $statement->closeCursor();
}

?>
