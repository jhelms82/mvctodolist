<?php
require('model/database.php');
require('model/item_db.php');
require('model/category_db.php');




$category_name = filter_input(INPUT_POST, "category_name", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
$item_id =filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
//$items = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);

$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
if($category_id) {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
}

//Action will allow take us different routes in controller
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    if (!$action) {
        $action = 'list_items';
    }
}

//switch statement

switch ($action) {
    case 'list_items':
        $categories = get_categories();
        include('view/category_list.php');
        break;


    case add_category()($category_name);
        header("location: .?action=list_categories");
        break;

    case "add_items":
        if ($category_id && $description) {
            add_items($category_id, $description);
            header("location: .?category_id=$category_id");

        } else {
            $error = "Invalid item. Check all fields and try again";
            include('view/error.php');
            exit();
        }
        break;

    case "delete_category":
        if ($category_id) {
            try {
                delete_category($category_id);
            } catch (PDOException $e) {
                $error = "You cannot delete a category if items exist in the course.";
                include('view/error.php');
                exit();
            }
            header("location: .?action=list_categories");
        }
        break;

    case "delete_items":
        if ($item_id) {
            delete_items($item_id);
            header("location: .?category_id=$category_id");
        } else {
            $error = "Missing or incorrect item id";
            include('view/error.php');
        }
        break;

    default:
        $category_name = get_category_name($category_id);
        $categories = get_categories();
        $items = get_items_by_category($category_id);
        include('view/item_list.php');
}

