<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT COUNT(*) as total FROM users";
    $result = mysqli_query($con, $sql);
    $users = mysqli_fetch_assoc($result)["total"];

    $sql = "SELECT COUNT(*) as total FROM category";
    $result = mysqli_query($con, $sql);
    $category = mysqli_fetch_assoc($result)["total"];

    $sql = "SELECT COUNT(*) as total FROM blogs";
    $result = mysqli_query($con, $sql);
    $blogs = mysqli_fetch_assoc($result)["total"];

    $sql = "SELECT COUNT(*) as total FROM comments";
    $result = mysqli_query($con, $sql);
    $comments = mysqli_fetch_assoc($result)["total"];

    $finalResult = [
        "users" => $users,
        "category" => $category,
        "blogs" => $blogs,
        "comments" => $comments
    ];

    echo json_encode($finalResult);
}
?>