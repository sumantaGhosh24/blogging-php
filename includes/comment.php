<?php
include "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id = mysqli_real_escape_string($con, $_GET["id"]);

        $res = mysqli_query($con, "SELECT c.id, c.ownerId, c.blogId, c.message, c.createdAt, c.updatedAt, b.id as blog_id, b.title as blog_title, u.id as owner_id, u.email as owner_email, u.username as owner_username FROM comments c JOIN users u ON c.ownerId = u.id JOIN blogs b ON c.blogId = b.id WHERE c.blogId = $id");
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

        $finalResult = [];

        foreach ($rows as $row) {
            $blog = [
                "id" => $row["blog_id"],
                "title" => $row["blog_title"]
            ];

            $owner = [
                "id" => $row["owner_id"],
                "email" => $row["owner_email"],
                "username" => $row["owner_username"]
            ];

            $finalResult[] = [
                "id" => $row["id"],
                "message" => $row["message"],
                "createdAt" => $row["createdAt"],
                "updatedAt" => $row["updatedAt"],
                "blog" => $blog,
                "owner" => $owner
            ];
        }


        echo json_encode($finalResult);
    }

    if (isset($_GET["admin"])) {
        $res = mysqli_query($con, "SELECT c.id, c.ownerId, c.blogId, c.message, c.createdAt, c.updatedAt, b.id as blog_id, b.title as blog_title, u.id as owner_id, u.email as owner_email, u.username as owner_username FROM comments c JOIN users u ON c.ownerId = u.id JOIN blogs b ON c.blogId = b.id");
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

        $finalResult = [];

        foreach ($rows as $row) {
            $blog = [
                "id" => $row["blog_id"],
                "title" => $row["blog_title"]
            ];

            $owner = [
                "id" => $row["owner_id"],
                "email" => $row["owner_email"],
                "username" => $row["owner_username"]
            ];

            $finalResult[] = [
                "id" => $row["id"],
                "message" => $row["message"],
                "createdAt" => $row["createdAt"],
                "updatedAt" => $row["updatedAt"],
                "blog" => $blog,
                "owner" => $owner
            ];
        }


        echo json_encode($finalResult);
    }

    if (isset($_GET["user"])) {
        $id = $_SESSION["USER_ID"];

        $res = mysqli_query($con, "SELECT c.id, c.ownerId, c.blogId, c.message, c.createdAt, c.updatedAt, b.id as blog_id, b.title as blog_title, u.id as owner_id, u.email as owner_email, u.username as owner_username FROM comments c JOIN users u ON c.ownerId = u.id JOIN blogs b ON c.blogId = b.id WHERE c.ownerId = $id");
        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

        $finalResult = [];

        foreach ($rows as $row) {
            $blog = [
                "id" => $row["blog_id"],
                "title" => $row["blog_title"]
            ];

            $owner = [
                "id" => $row["owner_id"],
                "email" => $row["owner_email"],
                "username" => $row["owner_username"]
            ];

            $finalResult[] = [
                "id" => $row["id"],
                "message" => $row["message"],
                "createdAt" => $row["createdAt"],
                "updatedAt" => $row["updatedAt"],
                "blog" => $blog,
                "owner" => $owner
            ];
        }


        echo json_encode($finalResult);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ownerId = $_SESSION["USER_ID"];
    $message = mysqli_real_escape_string($con, $_POST["message"]);
    $blog = mysqli_real_escape_string($con, $_POST["blog"]);

    if ($ownerId === "") {
        $arr = array("status" => "error", "msg" => "Owner is required");
    } elseif ($message === "") {
        $arr = array("status" => "error", "msg" => "Message is required");
    } elseif ($blog === "") {
        $arr = array("status" => "error", "msg" => "Blog is required");
    } else {
        $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM blogs WHERE id = $blog"));

        if ($check > 0) {
            $sql = "INSERT INTO comments (ownerId, blogId, message) VALUES ('$ownerId', '$blog', '$message')";

            if (mysqli_query($con, $sql)) {
                $arr = array("status" => "success", "msg" => "Comment created successfully");
            } else {
                $arr = array("status" => "error", "msg" => mysqli_error($con));
            }
        } else {
            $arr = array("status" => "error", "msg" => "Invalid blog details");
        }
    }

    echo json_encode($arr);
}
?>