<?php include('header.php'); ?>
<?php
//require('model/database.php'); ?>
<?php





?>

<section id="list" class="list">
    <header class="list_row list_header">
        <h1>To Do's</h1>
        <form action="?action=view_items" method="get" id="list_header_select" class="list_header_select">
            <input type="hidden" name="action" value="list_items">
            <select name="category_id" required>
                <option value="0"> View All</option>
                <?php if (isset($categories)) {
                    foreach ($categories as $category) : ?>
                        <?php if (isset($category_id)) {
                            if ($category_id == $category['categoryID']) { ?>
                                <option value="<? $category['categoryID'] ?>" selected>
                                <?php } else { ?>
                                <option value="<?= $category['categoryID'] ?>">
                                <?php }
                        } ?>
                            <?= $category['categoryName'] ?>
                            </option>
                        <?php endforeach;
                } ?>


            </select>
            <button class="add-button bold">Go</button>
        </form>
    </header>
    <?php if (isset($items)) {
       if ($items) { ?>
            <?php foreach ($items as $item) : ?>
                <div class="list_row">
                    <div class="list_item">
                        <p class="bold"><?= $item['categoryName'] ?></p>
                        <p><?= $item['description'] ?></p>
                    </div>
                    <div class="list_removeItem">
                        <form action="." method="post">
                            <input type="hidden" name="action" value="delete_item">
                            <input type="hidden" name="category_id" value="<?=
                                                                            $item['itemNum'] ?>">
                            <button class="remove_button">Delete</button>
                        </form>
                    </div>
                </div>
                </div>
            <?php endforeach; ?>
        <?php } else { ?>
            <br>
            <?php if ($category_id) { ?>
                <p>No to do items for this category</p>
            <?php } else { ?>
                <p>No to do items exist yet.</p>

            <?php  } ?>
            <br>
        <?php }
} ?>
    }
</section>

<section id="add" class="add">
    <h2>Add Items</h2>
    <form action="." method="post" id="add_items" class="add_form">
        <input type="hidden" name="action" value="add_form">
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

<p><a href="?action=list_categories">View/Edit Categories</a> </p>


<?php include("footer.php"); ?>