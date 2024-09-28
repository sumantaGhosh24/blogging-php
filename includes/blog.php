<?php
require "../vendor/autoload.php";
include "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id = mysqli_real_escape_string($con, $_GET["id"]);

        $sql = "SELECT b.id as blogId, b.ownerId, b.title, b.image, b.description, b.content, b.categoryId, b.createdAt, b.updatedAt, c.id as category_id, c.name as category_name, c.image as category_image, u.id as owner_id, u.email as owner_email, u.mobileNumber as owner_mobileNumber, u.firstName as owner_firstName, u.lastName as owner_lastName, u.username as owner_username, u.filename as owner_filename FROM blogs b JOIN users u ON b.ownerId = u.id JOIN category c ON b.categoryId = c.id WHERE b.id = $id";

        $result = mysqli_query($con, $sql);
        $blog = mysqli_fetch_assoc($result);

        $sql = "SELECT id, blogId, message, createdAt FROM comments WHERE blogId = $id";
        $result = mysqli_query($con, $sql);
        $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $parsedown = new Parsedown();

        $owner = [
            "id" => $blog["owner_id"],
            "email" => $blog["owner_email"],
            "mobileNumber" => $blog["owner_mobileNumber"],
            "firstName" => $blog["owner_firstName"],
            "lastName" => $blog["owner_lastName"],
            "username" => $blog["owner_username"],
            "filename" => $blog["owner_filename"]
        ];

        $category = [
            "id" => $blog["category_id"],
            "name" => $blog["category_name"],
            "image" => $blog["category_image"]
        ];

        $finalResult = [
            "id" => $blog["blogId"],
            "title" => $blog["title"],
            "image" => $blog["image"],
            "description" => $blog["description"],
            "content" => $blog["content"],
            "body" => $parsedown->text($blog["content"]),
            "category" => $category,
            "createdAt" => $blog["createdAt"],
            "updatedAt" => $blog["updatedAt"],
            "owner" => $owner,
            "comments" => $comments
        ];

        echo json_encode($finalResult);
    }

    if (isset($_GET["admin"])) {
        $sql = "SELECT b.id as blogId, b.ownerId, b.title, b.image, b.description, b.content, b.categoryId, b.createdAt, b.updatedAt, c.id as category_id, c.name as category_name, c.image as category_image, u.id as owner_id, u.email as owner_email, u.mobileNumber as owner_mobileNumber, u.firstName as owner_firstName, u.lastName as owner_lastName, u.username as owner_username, u.filename as owner_filename FROM blogs b JOIN users u ON b.ownerId = u.id JOIN category c ON b.categoryId = c.id";

        $result = mysqli_query($con, $sql);
        $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $finalResult = [];

        foreach ($blogs as $blog) {
            $owner = [
                "id" => $blog["owner_id"],
                "email" => $blog["owner_email"],
                "mobileNumber" => $blog["owner_mobileNumber"],
                "firstName" => $blog["owner_firstName"],
                "lastName" => $blog["owner_lastName"],
                "username" => $blog["owner_username"],
                "filename" => $blog["owner_filename"]
            ];

            $category = [
                "id" => $blog["category_id"],
                "name" => $blog["category_name"],
                "image" => $blog["category_image"]
            ];

            $finalResult[] = [
                "id" => $blog["blogId"],
                "title" => $blog["title"],
                "image" => $blog["image"],
                "description" => $blog["description"],
                "content" => $blog["content"],
                "category" => $category,
                "createdAt" => $blog["createdAt"],
                "updatedAt" => $blog["updatedAt"],
                "owner" => $owner
            ];
        }

        echo json_encode($finalResult);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = mysqli_real_escape_string($con, $_POST["action"]);
    $role = $_SESSION["USER_ROLE"];

    if ($role !== "admin") {
        $arr = array("status" => "error", "msg" => "Only admin can access this resource");

        echo json_encode($arr);
    } else {
        if ($action === "create") {
            $ownerId = $_SESSION["USER_ID"];
            $title = mysqli_real_escape_string($con, $_POST["title"]);
            $description = mysqli_real_escape_string($con, $_POST["description"]);
            $content = mysqli_real_escape_string($con, $_POST["content"]);
            $category = mysqli_real_escape_string($con, $_POST["category"]);

            if ($ownerId === "") {
                $arr = array("status" => "error", "msg" => "Owner Id is required");
            } elseif ($title === "") {
                $arr = array("status" => "error", "msg" => "Title is required");
            } elseif ($description === "") {
                $arr = array("status" => "error", "msg" => "Description is required");
            } elseif ($content === "") {
                $arr = array("status" => "error", "msg" => "Content is required");
            } elseif ($category === "") {
                $arr = array("status" => "error", "msg" => "Category is required");
            } else {
                $targetDir = "../uploads/";
                $fileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
                $fileName = uniqid() . "." . $fileType;
                $targetFilePath = $targetDir . $fileName;

                if (!empty($_FILES["file"]["name"])) {
                    $allowTypes = array("jpg", "png", "jpeg");
                    if (in_array($fileType, $allowTypes)) {
                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                            $sql = "INSERT INTO blogs (title, description, content, image, ownerId, categoryId) VALUES ('$title', '$description', '$content', '$fileName', '$ownerId', '$category')";

                            if (mysqli_query($con, $sql)) {
                                $arr = array("status" => "success", "msg" => "Category created successfully");
                            } else {
                                $arr = array("status" => "error", "msg" => mysqli_error($con));
                            }
                        } else {
                            $arr = array("status" => "error", "msg" => "Something went wrong, when upload category image");
                        }
                    } else {
                        $arr = array("status" => "error", "msg" => "Select a valid image type (jpg, jpeg and png required)");
                    }
                } else {
                    $arr = array("status" => "error", "msg" => "Select a image first");
                }
            }

            echo json_encode($arr);
        }

        if ($action === "update") {
            $title = mysqli_real_escape_string($con, $_POST["title"]);
            $description = mysqli_real_escape_string($con, $_POST["description"]);
            $content = mysqli_real_escape_string($con, $_POST["content"]);
            $category = mysqli_real_escape_string($con, $_POST["category"]);
            $id = mysqli_real_escape_string($con, $_POST["id"]);

            if ($title === "") {
                $arr = array("status" => "error", "msg" => "Title is required");
            } elseif ($description === "") {
                $arr = array("status" => "error", "msg" => "Description is required");
            } elseif ($content === "") {
                $arr = array("status" => "error", "msg" => "Content is required");
            } elseif ($category === "") {
                $arr = array("status" => "error", "msg" => "Category is required");
            } else {
                $res = mysqli_query($con, "SELECT * FROM blogs WHERE id='$id'");
                $row = mysqli_fetch_assoc($res);
                $check = mysqli_num_rows($res);

                if ($check > 0) {
                    $sql = "UPDATE blogs SET title='$title', description='$description', content='$content', categoryId='$category' WHERE id=$id";

                    if (mysqli_query($con, $sql)) {
                        $arr = array("status" => "success", "msg" => "Category updated successfully");
                    } else {
                        $arr = array("status" => "error", "msg" => mysqli_error($con));
                    }
                } else {
                    $arr = array("status" => "error", "msg" => "Blog id is invalid");
                }
            }

            echo json_encode($arr);
        }

        if ($action === "delete") {
            $id = mysqli_real_escape_string($con, $_POST["id"]);

            $res = mysqli_query($con, "SELECT * FROM blogs WHERE id=$id");
            $row = mysqli_fetch_assoc($res);
            $check = mysqli_num_rows($res);

            if ($check > 0) {
                if (gettype($row["image"]) === "string") {
                    $file = "../uploads/" . $row["image"];

                    if (file_exists($file)) {
                        unlink($file);
                    } else {
                        $arr = array("status" => "error", "msg" => "File does not exists");
                    }
                }

                $sql = "DELETE FROM blogs WHERE id=$id";

                if (mysqli_query($con, $sql)) {
                    $arr = array("status" => "success", "msg" => "Blog deleted successfully");
                } else {
                    $arr = array("status" => "error", "msg" => mysqli_error($con));
                }
            } else {
                $arr = array("status" => "error", "msg" => "Invalid category id");
            }

            echo json_encode($arr);
        }
    }
}
?>