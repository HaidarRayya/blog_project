<?php session_start(); ?>

<?php
$validations = [];
if (!empty($_SESSION['validations'])) {
    $validations = $_SESSION['validations'];
    $_SESSION['validations'] = [];
}
$old_data = [];
if (!empty($_SESSION['old_data'])) {
    $old_data = $_SESSION['old_data'];
    $_SESSION['old_data'] = [];
}

?>
<?php require_once('partials/head.php') ?>;

<div class="container">
    <form class method="POST" action="../controllers/store_post.php">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="please enter the title"
                name="title" value="<?php
                                    if ($old_data)
                                        echo $old_data['title'] != "" ? $old_data['title'] : '' ?>">

            <?php
            if ($validations)
                if ($validations['title'] != "") {
                    echo " <p class='error_message'> " . $validations['title']  . " </p>";
                }
            ?>

        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Content</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="content"
                placeholder="please enter a content"><?php
                                                        if ($old_data)
                                                            echo $old_data['content'] != "" ? $old_data['content'] : '' ?></textarea>

            <?php
            if ($validations)
                if ($validations['content'] != "") {
                    echo " <p class='error_message'> " . $validations['content']  . " </p>";
                }
            ?>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Send </button>
        </div>
    </form>
</div>
<?php require_once('partials/footer.php') ?>