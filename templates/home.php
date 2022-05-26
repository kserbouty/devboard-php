<?php include '../templates/nav.php'; ?>

<?php

use Devboard\Service\DashboardService;

if (isset($_POST['ws-name']) && (!empty($_POST['ws-name']))) {
    $data = array(
        'name' => $_POST['ws-name'],
        'user_id' => $_SESSION['login']
    );
    DashboardService::addWorkspace($data);
}

if (isset($_POST['ws-id']) && isset($_POST['ws-edit-name'])) {
    $data = array();
    $data['id'] = $_POST['ws-id'];
    $data['name'] = $_POST['ws-edit-name'];
    $data['user_id'] = $_SESSION['login'];
    DashboardService::updateWorkspace($data);
}

$workspaces =  DashboardService::getWorkspaces();
?>

<main id="home">

    <?php foreach ($workspaces as $workspace) { ?>

        <section class="workspace">
            <div class="d-flex justify-content-start align-items-center">
                <form action="" method="POST" class="d-flex justify-content-start align-items-center">
                    <label>
                        <input class="hidden form-control" type="number" name="ws-id" value="<?= $workspace['id'] ?>">
                    </label>
                    <label>
                        <input type="text" name="ws-edit-name" value="<?= $workspace['name'] ?>" class="form-control">
                    </label>
                    <button type="submit" class="btn">
                        <em class="bi bi-pencil"></em>
                    </button>
                </form>
                <form action="" method="POST">
                    <label>
                        <input class="hidden form-control" type="number" name="ws-id" value="<?= $workspace['id'] ?>">
                    </label>
                    <button type="submit" class="btn">
                        <em class="bi bi-x-circle"></em>
                    </button>
                </form>
            </div>
            <div class="ws-projects d-flex flex-wrap justify-content-center">
                <div class="ws-project">
                    <a class="text-decoration-none" href="">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <a class="text-decoration-none" href="" data-bs-toggle="modal" data-bs-target="#add-project">
                    <div class="card ws-project">
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <em class="bi bi-plus-circle"></em>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <div id="add-project" class="modal fade" tabindex="-1" aria-labelledby="project-modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="project-modal" class="modal-title">Add project</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" class="modal-form">
                        <div class="modal-body">
                            <label for="project-name" class="form-label">Name</label>
                            <label>
                                <input type="text" name="project-name" value="" class="form-control">
                            </label>
                            <label for="project-description" class="form-label">Description</label>
                            <label>
                                <textarea name="project-description" class="form-control" rows="4"></textarea>
                            </label>
                            <button type="submit" class="btn btn-outline-success btn-add">Create</button>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Return</button>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <section>
        <a data-bs-toggle="modal" data-bs-target="#add-workspace" href="">
            <div class="ws-add">
                <div class="d-flex justify-content-center">
                    <em class="bi bi-plus-circle"></em>
                </div>
            </div>
        </a>
    </section>

    <div id="add-workspace" class="modal fade" tabindex="-1" aria-labelledby="new-workspace" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="new-workspace" class="modal-title">Add workspace</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" class="modal-form">
                    <div class="modal-body">
                        <label for="ws-name" class="form-label">Name</label>
                        <label>
                            <input type="text" name="ws-name" value="" class="form-control">
                        </label>
                        <button type="submit" class="btn btn-outline-success btn-add">Create</button>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Return</button>
                </div>
            </div>
        </div>
    </div>

</main>