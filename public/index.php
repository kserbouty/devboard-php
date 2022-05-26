<?php
error_reporting(-1);
require_once '../vendor/autoload.php';

$uri = $_SERVER['REQUEST_URI'];
echo $uri;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devboard</title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<?php
switch ($uri) {
    case '/devboard/':
        include '../templates/login.php';
        break;
    case '/devboard/register':
        include '../templates/register.php';
        break;
    case '/devboard/home':
        include '../templates/home.php';
        break;
    default:
        include '../templates/404.php';
}
?>

<footer></footer>
</body>
</html>
