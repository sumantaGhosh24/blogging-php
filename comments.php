<?php require './includes/header.php'; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<?php echo "Comments Page"; ?>

<?php require './includes/footer.php'; ?>