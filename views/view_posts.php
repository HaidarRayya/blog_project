<?php
require_once('../model/Post.php');
session_start();
$post = $_SESSION['post'];

?>

<?php require_once('partials/head.php') ?>;

<div class="container center">
    <div class="card text-center">
        <div class="card-header">
            Author: <?php echo $post->getAuthor() ?>
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: <?php echo $post->getTitle() ?>
            </h5>
            <p class="card-text"> <?php echo $post->getContent() ?>
            </p>
        </div>
        <div class="card-footer text-muted">
            Date: <?php echo  $post->getCreated_at() ?>
            <br>
            <?php if (!($post->getCreated_at() == $post->getUpdated_at()))
                echo "post is updated"
            ?>
        </div>

    </div>
</div>

<?php require_once('partials/footer.php') ?>;