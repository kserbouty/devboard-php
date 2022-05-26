<?php

use Devboard\Service\AccountService;

$accounts = AccountService::getAccounts();

if (!$accounts) {
    header('Location: /devboard/register');
}

if (isset($_POST['login'])) {
    $id = $_POST['login'];
    AccountService::login($id);
}
?>

<section class="login-section">
    <div class="card login-card">
        <div class="card-body">
            <h2 class="text-center">Login</h2>
            <form action="" class="login-form" method="post">
                <label for="account" class="form-label">Account</label>
                <select name="login" class="form-select" aria-label="login-accounts">
                    <?php foreach ($accounts as $user) {
                        echo '<option value="' . $user['id'] . '">' . $user['username'] . '</option>';
                    } ?>
                </select>
                <button class="login-btn btn btn-outline-success" type="submit">Sign in</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <a href="/devboard/register" class="card-link">Register an account</a>
        </div>
    </div>
</section>