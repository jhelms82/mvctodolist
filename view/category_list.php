<?php include 'header.php';
//include '../model/category_db.php';

?>
<?php if (isset($categories)) {
    if ($categories) { ?>
        <section id="list" class="list">
            <header class="list_row list_header">
                <h1>Categories</h1>
            </header>


            <?php foreach ($categories as $category) :
                ?>
                <div class="list_row">
                    <div class="list_item">
                        <p class="bold"><?= $category['categoryName'] ?></p>
                    </div>
                    <div class="list_removeItem">
                        <form action="." method="post">
                            <input type="hidden" name="action" value="delete_category">
                            <input type="hidden" name="category_id" value="<?=  $category['categoryID'] ?>">
                            <button class="remove-button">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach ?>
        </section>
    <?php } else { ?>
        <p>No categories exist yet</p>
    <?php }
} ?>


<section id="add" class="add">
    <h2>Add Category</h2>
    <form action="." method="post" id="add_form" class="add_form">
        <input type="hidden" name="action" value="add_category">
        <div class="add_inputs">
            <label>Name:</label>

            <input type="text" name="title" maxlength="50" placeholder="Name" autofocus required>
        </div>
        <div class="add_addItem">
            <button href=".?action=add_categories"class="add-button bold">Add</button>
        </div>
    </form>

</section>
<br>
<p><a href="../view/item_list.php">View &amp; Add Items</a> </p>



<?php include "footer.php" ?>