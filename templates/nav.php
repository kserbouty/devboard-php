<?php
use Devboard\Service\AccountService;
const HEADER_DEFAULT = "Location: /devboard/";
const HEADER_HOME = "Location: /devboard/home";
$user = null;

session_start();

if (!$_SESSION['login']) {
    header(HEADER_DEFAULT);
}

if (isset($_SESSION['login'])) {
    $user = AccountService::getAccount($_SESSION['login']);
} else {
    header(HEADER_DEFAULT);
}

if (isset($_POST['logout'])) {
    AccountService::logout();
}

if (isset($_POST['username']) && isset($_SESSION['login'])) {
    $account = array(
        'id' => $_SESSION['login'],
        'username' => $_POST['username']
    );
    AccountService::updateAccount($account);
    header(HEADER_HOME);
}

if (isset($_POST['remove-account'])) {
    $account = array(
        'id' => $_SESSION['login']
    );
    AccountService::removeAccount($account);
    header(HEADER_DEFAULT);
}
?>

<nav class="navbar navbar-expand-lg navbar-light d-flex flex-row">
    <div class="container-fluid">

        <a class="navbar-brand justify-content-start" href="/devboard/home">Devboard</a>

        <ul class="navbar-nav justify-content-end">
            <li class="nav-item">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#nav-account">
                    <em class="bi bi-person-circle"></em><?= $user['username'] ?>
                </button>
            </li>
            <div id="nav-account" class="modal fade" tabindex="-1" aria-labelledby="account-settings" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User settings</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Edit profile</h6>
                            <form action="" method="POST" class="modal-form">
                                <label for="username" class="form-label">Username</label>
                                <label>
                                    <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control">
                                </label>
                                <button type="submit" class="btn-edit btn btn-outline-primary">Update</button>
                            </form>
                            <h6>Delete account</h6>
                            <form action="" method="POST" class="modal-form">
                                <div class="form-check">
                                    <p>All projects will be lost in the process.</p>
                                    <label for="remove-account" class="form-check-label">
                                        Delete account.
                                    </label>
                                    <label>
                                        <input type="checkbox" name="remove-account" value="remove" class="form-check-input">
                                    </label>
                                </div>
                                <button type="submit" class="btn-remove btn btn-outline-danger">Delete</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Return</button>
                        </div>
                    </div>
                </div>
            </div>
            <li class="nav-item">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#logout">
                    <em class="bi bi-power"></em>
                </button>
            </li>
            <div id="logout" class="modal fade" tabindex="-1" aria-labelledby="logout" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Logout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" class="logout-form">
                                <label>
                                    <input name="logout" value="logout">
                                </label>
                                <button type="submit" class="btn-logout btn btn-outline-danger">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</nav