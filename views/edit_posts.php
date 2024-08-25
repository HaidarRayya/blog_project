<?php
require_once('../model/Post.php');
session_start();
$post = $_SESSION['post'];

$validations = "";
if (!empty($_SESSION['validations'])) {
    $validations = $_SESSION['validations'] ?? [];
    $_SESSION['validations'] = [];
}
?>
<?php require_once('partials/head.php'); ?>
<div class="container">
    <form method="POST" action="../controllers/update_post.php">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="please enter the title"
                name="title" value="<?php echo $post->getTitle() ?>">

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
                placeholder="please enter a content"><?php echo $post->getContent() ?></textarea>
            <?php
                if ($validations)
                    if ($validations['content'] != "") {
                        echo " <p class='error_message'> " . $validations['content']  . " </p>";
                    }
                ?>
        </div>
        <input type="hidden" name="id" value="<?php echo $post->getId() ?>">
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Send </button>
        </div>
    </form>
</div>
<?php require_once('partials/footer.php') ?>