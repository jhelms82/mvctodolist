<?php include('header.php'); ?>
<?php
//require('model/database.php');
//include 'model/category_db.php';
//include 'model/item_db.php';


$categories = get_categories();
$action = filter_input (INPUT_GET, 'action');
if($action == 'add_item'){
    $category_id = filter_input (INPUT_POST, 'category_id');
    $title = filter_input (INPUT_POST, 'description');
    add_items ($category_id, $title);
} else if($action == "list_items") {
//    $error = "invalid item data.";
//    include ('view/error.php');
//    exit();
    $category_id = filter_input (INPUT_POST, 'category_id');
    $items= get_items_by_category($category_id);
//    print_r($items);
}
//else if($action == "delete_item") {
////    $error = "invalid item data.";
////    include ('view/error.php');
////    exit();
//    $category_id = filter_input (INPUT_POST, 'category_id');
//    $items= delete_items($category_id);
////    print_r($items);
//}



?>


<section id="list" class="list">
    <header class="list_row list_header">
        <h1>To Do's</h1>
        <?php if (isset($items)) {
            if ($items) { ?>
                <section id="list" class="list">
                    <header class="list_row list_header">
                        <h1>Items</h1>
                    </header>


                    <?php foreach ($items as $item) :
//                print_r($category);
                        ?>
                        <div class="list_row">
                            <div class="list_item">
                                <p class="bold"><?= $item['description'] ?></p>
                            </div>
                            <div class="list_removeItem">
                                <form action="." method="post">
                                    <input type="hidden" name="action" value="delete_items">
                                    <input type="hidden" name="item_id" value="<?=  $item['itemNum']; ?>">
                                    <button class="remove-button">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach ?>
                </section>
            <?php } else { ?>
                <p>No items exist yet</p>
            <?php }
        } ?>


        <form action="?action=list_items" method="POST" id="list_header_select" class="list_header_select">
            <input type="hidden" name="action" value="list_items">
            <select name="category_id" required>
                <option value="0"> View All</option>
                <?php
//                print_r($categories);
                    foreach ($categories as $category) : ?>
                              <option value="<?= $category['categoryID']; ?>">
                        <?= $category['categoryName']; ?>
                                 </option>
                        <?php endforeach; ?>


            </select>
            <button class="add-button bold">Go</button>
        </form>
    </header>
<!--    --><?php //if (isset($items)) {
//       if ($items) { ?>
<!--            --><?php //foreach ($items as $item) : ?>
<!--                <div class="list_row">-->
<!--                    <div class="list_item">-->
<!--                        <p class="bold">--><?//= $item['categoryName'] ?><!--</p>-->
<!--                        <p>--><?//= $item['description'] ?><!--</p>-->
<!--                    </div>-->
<!--                    <div class="list_removeItem">-->
<!--                        <form action="." method="post">-->
<!--                            <input type="hidden" name="action" value="delete_item">-->
<!--                            <input type="hidden" name="category_id" value="-->
<!--                            --><?//= $item['itemNum'] ?><!--">-->
<!--                            <button class="remove_button">Delete</button>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--                </div>-->
<!--            --><?php //endforeach; ?>
<!--        --><?php //} else { ?>
<!--            <br>-->
<!--            --><?php //if ($category_id) { ?>
<!--                <p>No to do items for this category</p>-->
<!--            --><?php //} else { ?>
<!--                <p>No to do items exist yet.</p>-->
<!---->
<!--            --><?php // } ?>
<!--            <br>-->
<!--        --><?php //}
//} ?>
<!--    }-->
<!--</section>-->




<section id="add" class="add">
    <h2>Add Items</h2>
    <form action="." method="post" id="add_items" class="add_form">
        <input type="hidden" name="action" value="add_item">
        <div class="add_inputs">
            <Label>Categories</Label>
            <select name="category_id" required>
                <option value="">Please Select</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['categoryID']; ?>">
                        <?= $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>

            </select>
            <label>Description:</label>
            <input type="text" name="description" maxlength="120" placeholder="Description" required>
        </div>
        <div class="add_addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>
<br>

<p><a href=".?action=category_list">View/Edit Categories</a> </p>


<?php include("footer.php"); ?>