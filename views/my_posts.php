<?php
require_once('../model/Post.php');
require_once('../model/User.php');
require_once('../database/ConvertDataToPosts.php');

session_start();
$posts = $_SESSION['posts'];
$added = '';
$delete = '';
if (!empty($_SESSION['messages'])) {
    $added = $_SESSION['messages']['add'] ?? '';
    $delete = $_SESSION['messages']['delete'] ?? '';
    $_SESSION['messages']['add'] = "";
    $_SESSION['messages']['delete'] = "";
}

$loginUser = $_SESSION['loginUser'];

?>
<?php require_once('partials/head.php') ?>;

<?php
if ($added != "") {
    echo "<div class='alert alert-success' role='alert'>";
    echo $added;
    echo " </div> ";
}
if ($delete != "") {
    echo "<div class='alert alert-success' role='alert'>";
    echo $delete;
    echo " </div> ";
}

?>
<div class="search-bar">
    <form class="container-xl mt-5" action="../controllers/search.php" method="POST">
        <div class=" input-group mt-3 mb-3">
            <select id="myDropdown">
                <option value="title">title</option>
                <option value="content">content</option>
            </select>
            <input class="form-control" id="myForm" type="text" name="title" size="25" maxlength="255" value="" />
            <input name="myPost" hidden>
            <input type="submit" onclick="UpdateFormAction()" value="Search" />
            <input type="submit" onclick="UpdateFormAction()" value="Reset" />

        </div>
    </form>
</div>
<div class="container-xl mt-5">
    <div class="container-xl mb-2">
        <a href="../controllers/create_post.php" class="btn btn-primary m-10">Add New Blog</a>
    </div>
    <div class="row">
        <?php
        if (empty($posts))
            echo " <p> no data</p>";
        else
            foreach ($posts as $post):
        ?>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class='card-title'>Title: <?php echo $post->getTitle() ?> </h5>
                    <p class='card-text'>Author: <?php echo $post->getAuthor() ?> </p>
                    <p class='card-text'> <?php if (strlen($post->getContent()) > 30)
                                                    echo substr($post->getContent(), 0, 30) . ""  . '....';
                                                else
                                                    echo $post->getContent(); ?> </p>

                    <div class="d-flex">
                        <a href="../controllers/edit_post.php?id=<?php echo $post->getId() ?>"
                            class="btn btn-secondary m-2">Edit</a>
                        <a href="../controllers/view_post.php?id=<?php echo $post->getId() ?>"
                            class="btn btn-info m-2">Show</a>
                        <form action="../controllers/delete_post.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $post->getId() ?>">
                            <button type="submit" class="btn btn-danger m-2">Delete </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

        <?php
            endforeach
        ?>

    </div>
</div>
<?php require_once('partials/footer.php') ?>;