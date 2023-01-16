<?php
session_start();
if (!$_SESSION['isAuth']) {
    header('Location: ./view/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Hello</title>
</head>

<body>
    <div class="container">
        <div>
            <span>Hello, </span>
            <?php
            if (isset($_SESSION["name"])) {
                echo "<span class='span__name'>" . $_SESSION["name"] . "</span>";
            }
            ?>
        </div>
        <button type="button" class="button__exit">Выйти</button>
    </в>
    <script type="module" src="./js/index2.js"></script>
</body>

</html>