<?php require "./includes/header.php"; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}

if ($_SESSION["USER_ROLE"] !== "admin") {
    header("Location: index.php");
    die();
}
?>

<?php echo "Manage Comments Page"; ?>

<?php require "./includes/footer.php"; ?>