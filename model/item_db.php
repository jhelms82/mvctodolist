<?php

        //grabs all rows that have a specific category ID
        function get_items_by_category($category_id)
        {
            global $db;

            if (!$category_id) {
                $query = 'SELECT I.itemNum, I.description, C.categoryName FROM todoitems I LEFT JOIN
                        categories C ON I.categoryID = C.categoryID
                        WHERE I.categoryID = :category_id ORDER BY I.itemNum';
            } else {
                $query = 'SELECT I.itemNum, I.description, C.categoryName FROM todoitems I LEFT JOIN
                        categories C ON I.categoryID = C.categoryID 
                         ORDER BY I.categoryID';
            }

                    $statement = $db -> prepare ($query);
                    $statement -> bindValue (':category_id', $category_id);
                    $statement -> execute ();
                    $items = $statement -> fetchAll ();
                    $statement -> closeCursor ();
                    return $items;
                }



//accecpts ItemNum as parameter and deletes a single row
                function delete_items($ItemNum)
                {
                    global $db;
                    $query = 'DELETE FROM todoitems
              WHERE itemNum = :item_id';
                    $statement = $db -> prepare ($query);
                    $statement -> bindValue (":item_id", $ItemNum);
                    $statement -> execute ();
                    $statement -> closeCursor ();
                }

                function add_items($category_id, $description)
                {
                    global $db;

                    $query = 'INSERT INTO todoitems
                 (description, categoryID)
              VALUES
                 (:description, :categoryID)';
                    $statement = $db -> prepare ($query);
                    $statement -> bindValue (":description", $description);
                    $statement -> bindValue (":categoryID", $category_id);
                    $statement -> execute ();
                    $statement -> closeCursor ();

                }

