<?php

use Devboard\Service\AccountService;

$accounts = AccountService::getAccounts();

if (isset($_POST['username']) && (!empty($_POST['username']))) {
    $account = array(
        'username' => $_POST['username']
    );
    AccountService::register($account);
}
?>

<section class="login-section">
    <div class="card login-card">
        <div class="card-body">
            <h2 class="text-center">Welcome</h2>
            <form action="" method="post" class="login-form">
                <label for="username" class="form-label">Username</label>
                <label>
                    <input type="text" name="username" class="form-control">
                </label>
                <button type="submit" class="btn btn-outline-success">Register</button>
            </form>
        </div>
        <?php if (!empty($accounts)) { ?>
            <div class="card-footer text-center">
                <a href="/devboard/" class="card-link">Login</a>
            </div>
        <?php } ?>
    </div>
</section>