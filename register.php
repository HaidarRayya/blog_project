<?php require_once('views/partials/head.php');
?>;
<?php
session_start();

$validations = "";
if (!empty($_SESSION['validations'])) {
    $validations = $_SESSION['validations'] ?? [];
    $_SESSION['validations'] = [];
}
$old_data = [];
if (!empty($_SESSION['old_data'])) {
    $old_data = $_SESSION['old_data'];
    $_SESSION['old_data'] = [];
}
?>
<div class="container">
    <form method="POST" action="controllers/register.php">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">First Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1"
                placeholder="please enter the firstname" name="firstName"
                value="<?php
                        if ($old_data)
                            echo $old_data['firstName'] != "" ? $old_data['firstName'] : '' ?>">

            <?php
            if ($validations)
                if ($validations['firstName'] != "") {
                    echo " <p class='error_message'> " . $validations['firstName']  . " </p>";
                }
            ?>

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1"
                placeholder="please enter the last name" name="lastName" value="<?php if ($old_data)
                                                                                    echo $old_data['lastName'] != "" ? $old_data['lastName'] : '' ?>">

            <?php
            if ($validations)
                if ($validations['lastName'] != "") {
                    echo " <p class='error_message'> " . $validations['lastName']  . " </p>";
                }
            ?>

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleFormControlInput2" placeholder="please enter the email"
                name="email" value="<?php if ($old_data) echo $old_data['email'] != "" ? $old_data['email'] : '' ?>">
            <?php
            if ($validations)
                if ($validations['email'] != "") {
                    echo " <p class='error_message'> " . $validations['email']  . " </p>";
                }
            ?>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleFormControlInput2"
                placeholder="please enter the password" name="password">
            <?php
            if ($validations)
                if ($validations['password'] != "") {
                    echo " <p class='error_message'> " . $validations['password']  . " </p>";
                }
            ?>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Send </button>
        </div>
        <a href="index.php" class="btn btn-secondary m-2">login</a>

    </form>
</div>
<?php require_once('views/partials/footer.php') ?>