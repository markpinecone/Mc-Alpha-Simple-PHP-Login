<?php
require_once '../../config/config.php';
require INCLUDE_DIR . '/dbh.inc.php';
require VIEWS_DIR . '/header.view.php';
require VIEWS_DIR . '/navbar.view.php';
require INSTALL_DIR . '/includes/install.inc.php';
?>
<div id="form">
    <h2 class="mt-3 mb-3">Site Setup</h2>
    <h1 class="mb-3">Create Admin user</h1>
    <?php
    if (isset($_POST["db"])) {
        include INSTALL_DIR . '/db.php';
    }
    ?>
    <form method="POST" action="">
        <button class="btn btn-primary" type="submit" value="db" name="db">Setup Database tables</button><br><br>
        <!-- Email input -->
        <div class="form-group col-md-4 mb-3">
            <input class="form-control col-md-4" type="email" name='email' value="<?php echo (isset($_GET['email']) ? $_GET['email'] : ''); ?>" id=""
                class="" placeholder="Admin e-mail">
        </div>
        <div class="form-group col-md-4 mb-3">
            <input class="form-control" type="name" name='name' value="<?php echo (isset($_GET['name']) ? $_GET['name'] : ''); ?>" id=""
                placeholder="First Name">
        </div>
        <div class="form-group col-md-4 mb-3">
            <input class="form-control" type="lastname" name='lastname'
                value="<?php echo (isset($_GET['lastname']) ? $_GET['lastname'] : ''); ?>" placeholder="Last Name">
        </div>
        <!-- Password input -->
        <div class="form-group col-md-4 mb-3">
            <input class="form-control" type="password" name='pass' placeholder="Enter password">
        </div>
        <div class="form-group col-md-4 mb-3">
            <input class="form-control" type="password" name='repeat-pass' placeholder="Repeat password">
        </div>
        <button class="btn btn-primary" type="submit" value="submit" name="submit" class="">Create ADM User</button>
    </form>
</div>
<?php
require VIEWS_DIR . '/footer.view.php';
?>
