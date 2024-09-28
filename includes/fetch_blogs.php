<?php
include "database.php";

if ($_GET["category"] !== "" && $_GET["title"] !== "") {
    $categoryId = isset($_GET['category']) ? $_GET['category'] : '';
    $searchTitle = isset($_GET['title']) ? $_GET['title'] : '';
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
    $offset = ($page - 1) * $limit;
    $searchTerm = '%' . $searchTitle . '%';

    $sql = "SELECT COUNT(*) as total FROM blogs WHERE categoryId='$categoryId' AND title LIKE '$searchTerm'";
    $result = mysqli_query($con, $sql);
    $totalRows = mysqli_fetch_assoc($result)['total'];
    $totalPages = ceil($totalRows / $limit);

    $sql = "SELECT b.id as blogId, b.ownerId, b.title, b.description, b.image, b.categoryId, b.createdAt, b.updatedAt, c.id as category_id, c.name as category_name, c.image as category_image, u.id as owner_id, u.email as owner_email, u.mobileNumber as owner_mobileNumber, u.firstName as owner_firstName, u.lastName as owner_lastName, u.username as owner_username, u.filename as owner_filename FROM blogs b JOIN users u ON b.ownerId = u.id JOIN category c ON b.categoryId = c.id WHERE b.categoryId ='$categoryId' AND b.title LIKE '$searchTerm' LIMIT $limit OFFSET $offset";
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
            "image" => $blog["category_image"],
        ];

        $blogId = $blog["blogId"];
        $finalResult[] = [
            "id" => $blogId,
            "title" => $blog["title"],
            "description" => $blog["description"],
            "image" => $blog["image"],
            "category" => $category,
            "createdAt" => $blog["createdAt"],
            "updatedAt" => $blog["updatedAt"],
            "owner" => $owner,
        ];
    }

    echo json_encode(['blogs' => $finalResult, 'totalPages' => $totalPages]);
} elseif ($_GET["category"] !== "") {
    $categoryId = isset($_GET['category']) ? $_GET['category'] : '';
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT COUNT(*) as total FROM blogs WHERE categoryId='$categoryId'";
    $result = mysqli_query($con, $sql);
    $totalRows = mysqli_fetch_assoc($result)['total'];
    $totalPages = ceil($totalRows / $limit);

    $sql = "SELECT b.id as blogId, b.ownerId, b.title, b.description, b.image, b.categoryId, b.createdAt, b.updatedAt, c.id as category_id, c.name as category_name, c.image as category_image, u.id as owner_id, u.email as owner_email, u.mobileNumber as owner_mobileNumber, u.firstName as owner_firstName, u.lastName as owner_lastName, u.username as owner_username, u.filename as owner_filename FROM blogs b JOIN users u ON b.ownerId = u.id JOIN category c ON b.categoryId = c.id WHERE b.categoryId ='$categoryId' LIMIT $limit OFFSET $offset";
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
            "image" => $blog["category_image"],
        ];

        $blogId = $blog["blogId"];
        $finalResult[] = [
            "id" => $blogId,
            "title" => $blog["title"],
            "description" => $blog["description"],
            "image" => $blog["image"],
            "category" => $category,
            "createdAt" => $blog["createdAt"],
            "updatedAt" => $blog["updatedAt"],
            "owner" => $owner,
        ];
    }

    echo json_encode(['blogs' => $finalResult, 'totalPages' => $totalPages]);
} elseif ($_GET["title"] !== "") {
    $searchTitle = isset($_GET['title']) ? $_GET['title'] : '';
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
    $offset = ($page - 1) * $limit;
    $searchTerm = '%' . $searchTitle . '%';

    $sql = "SELECT COUNT(*) as total FROM blogs WHERE title LIKE '$searchTerm'";
    $result = mysqli_query($con, $sql);
    $totalRows = mysqli_fetch_assoc($result)['total'];
    $totalPages = ceil($totalRows / $limit);

    $sql = "SELECT b.id as blogId, b.ownerId, b.title, b.description, b.image, b.categoryId, b.createdAt, b.updatedAt, c.id as category_id, c.name as category_name, c.image as category_image, u.id as owner_id, u.email as owner_email, u.mobileNumber as owner_mobileNumber, u.firstName as owner_firstName, u.lastName as owner_lastName, u.username as owner_username, u.filename as owner_filename FROM blogs b JOIN users u ON b.ownerId = u.id JOIN category c ON b.categoryId = c.id WHERE b.title LIKE '$searchTerm' LIMIT $limit OFFSET $offset";
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
            "image" => $blog["category_image"],
        ];

        $blogId = $blog["blogId"];
        $finalResult[] = [
            "id" => $blogId,
            "title" => $blog["title"],
            "description" => $blog["description"],
            "image" => $blog["image"],
            "category" => $category,
            "createdAt" => $blog["createdAt"],
            "updatedAt" => $blog["updatedAt"],
            "owner" => $owner,
        ];
    }

    echo json_encode(['blogs' => $finalResult, 'totalPages' => $totalPages]);
} else {
    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 10;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT COUNT(*) as total FROM blogs";
    $result = mysqli_query($con, $sql);
    $totalRows = mysqli_fetch_assoc($result)['total'];
    $totalPages = ceil($totalRows / $limit);

    $sql = "SELECT b.id as blogId, b.ownerId, b.title, b.description, b.image, b.categoryId, b.createdAt, b.updatedAt, c.id as category_id, c.name as category_name, c.image as category_image, u.id as owner_id, u.email as owner_email, u.mobileNumber as owner_mobileNumber, u.firstName as owner_firstName, u.lastName as owner_lastName, u.username as owner_username, u.filename as owner_filename FROM blogs b JOIN users u ON b.ownerId = u.id JOIN category c ON b.categoryId = c.id LIMIT $limit OFFSET $offset";
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
            "image" => $blog["category_image"],
        ];

        $blogId = $blog["blogId"];
        $finalResult[] = [
            "id" => $blogId,
            "title" => $blog["title"],
            "description" => $blog["description"],
            "image" => $blog["image"],
            "category" => $category,
            "createdAt" => $blog["createdAt"],
            "updatedAt" => $blog["updatedAt"],
            "owner" => $owner,
        ];
    }

    echo json_encode(['blogs' => $finalResult, 'totalPages' => $totalPages]);
}
?>