<?php
session_start();

include 'database.php';
include 'constant.php';
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="author" content="sumanta ghosh" />
    <meta name="description" content="blogging website php" />
    <meta name="keywords" content="blog, blogging, developer" />

    <!--==================== favicon ====================-->
    <link rel="icon" type="image/png" href="./assets/images/favicon-32x32.png" />

    <!--==================== canonical ====================-->
    <link rel="canonical" href="http://example.com/home" />

    <!--==================== fontawesome cdn ====================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />

    <!--==================== swiper css ====================-->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!--==================== jQuery cdn ====================-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--==================== custom css ====================-->
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />

    <title>Blogging</title>
</head>

<body class="bg-white">
    <nav class="bg-blue-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">Logo</a>
            <ul class="flex space-x-4">
                <?php
                if (!isset($_SESSION["USER_ID"])) {
                    ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                    <?php
                }
                if (isset($_SESSION["USER_ID"]) && $_SESSION["USER_ROLE"] === "admin") {
                    ?>
                    <div class="dropdown inline-block relative">
                        <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
                            <span class="mr-1">Manage</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                            <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="dashboard.php">Dashboard</a></li>
                            <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="manage-category.php">Category</a></li>
                            <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="manage-blogs.php">Blogs</a></li>
                            <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="manage-comments.php">Comments</a></li>
                            <li><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                    href="manage-users.php">Users</a></li>
                        </ul>
                    </div>
                    <?php
                }
                if (isset($_SESSION["USER_ID"])) {
                    ?>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="comments.php">Comments</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>