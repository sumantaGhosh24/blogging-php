<?php
include "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["my"])) {
    $id = $_SESSION["USER_ID"];

    $res = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);

    echo json_encode($row);
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["admin"])) {
    $res = mysqli_query($con, "SELECT * FROM users");

    $users = [];
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $users[] = $row;
        }
    }

    echo json_encode($users);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = mysqli_real_escape_string($con, $_POST["action"]);

    if ($action === "data_form") {
        $id = $_SESSION["USER_ID"];
        $firstName = mysqli_real_escape_string($con, $_POST["firstName"]);
        $lastName = mysqli_real_escape_string($con, $_POST["lastName"]);
        $username = mysqli_real_escape_string($con, $_POST["username"]);
        $dob = mysqli_real_escape_string($con, $_POST["dob"]);
        $gender = mysqli_real_escape_string($con, $_POST["gender"]);

        if ($firstName === "") {
            $arr = array("status" => "error", "msg" => "First name is required", "field" => "firstName_error");
        } elseif ($lastName === "") {
            $arr = array("status" => "error", "msg" => "Last name is required", "field" => "lastName_error");
        } elseif ($username === "") {
            $arr = array("status" => "error", "msg" => "Username is required", "field" => "username_error");
        } elseif ($dob === "") {
            $arr = array("status" => "error", "msg" => "DOB is required", "field" => "dob_error");
        } elseif ($gender === "") {
            $arr = array("status" => "error", "msg" => "Gender is required", "field" => "gender_error");
        } else {
            $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE id='$id'"));

            if ($check > 0) {
                $sql = "UPDATE users SET firstName='$firstName', lastName='$lastName', username='$username', dob='$dob', gender='$gender' WHERE id=$id";

                if (mysqli_query($con, $sql)) {
                    $arr = array("status" => "success", "msg" => "Updated user details", "field" => "form_msg");
                } else {
                    $arr = array("status" => "error", "msg" => mysqli_error($con), "field" => "firstName_error");
                }
            } else {
                $arr = array("status" => "error", "msg" => "Invalid user details", "field" => "firstName_error");
            }
        }

        echo json_encode($arr);
    }

    if ($action == "address_form") {
        $id = $_SESSION["USER_ID"];
        $city = mysqli_real_escape_string($con, $_POST["city"]);
        $state = mysqli_real_escape_string($con, $_POST["state"]);
        $country = mysqli_real_escape_string($con, $_POST["country"]);
        $zip = mysqli_real_escape_string($con, $_POST["zip"]);
        $addressline = mysqli_real_escape_string($con, $_POST["addressline"]);

        if ($city === "") {
            $arr = array("status" => "error", "msg" => "City is required", "field" => "city_error");
        } elseif ($state === "") {
            $arr = array("status" => "error", "msg" => "State is required", "field" => "state_error");
        } elseif ($country === "") {
            $arr = array("status" => "error", "msg" => "Country is required", "field" => "country_error");
        } elseif ($zip === "") {
            $arr = array("status" => "error", "msg" => "Zip is required", "field" => "zip_error");
        } elseif ($addressline === "") {
            $arr = array("status" => "error", "msg" => "Addressline is required", "field" => "addressline_error");
        } else {
            $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE id='$id'"));

            if ($check > 0) {
                $sql = "UPDATE users SET city='$city', state='$state', country='$country', zip='$zip', addressline='$addressline' WHERE id=$id";

                if (mysqli_query($con, $sql)) {
                    $arr = array("status" => "success", "msg" => "Updated user address", "field" => "form_msg");
                } else {
                    $arr = array("status" => "error", "msg" => mysqli_error($con), "field" => "city_error");
                }
            } else {
                $arr = array("status" => "error", "msg" => "Invalid user address", "field" => "form_msg");
            }
        }

        echo json_encode($arr);
    }

    if ($action == "image_form") {
        $id = $_SESSION["USER_ID"];
        $targetDir = "../uploads/";
        $fileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileType;
        $targetFilePath = $targetDir . $fileName;

        if (!empty($_FILES["file"]["name"])) {
            $allowTypes = array('jpg', 'png', 'jpeg');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    $res = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");
                    $row = mysqli_fetch_assoc($res);
                    $check = mysqli_num_rows($res);

                    if (gettype($row["filename"]) === "string") {
                        $file = '../uploads/' . $row["filename"];

                        if (file_exists($file)) {
                            unlink($file);
                        } else {
                            $arr = array("status" => "error", "msg" => "File does not exist", "field" => "image_error");
                        }
                    }

                    if ($check > 0) {
                        $sql = "UPDATE users SET filename='$fileName' WHERE id=$id";

                        if (mysqli_query($con, $sql)) {
                            $arr = array("status" => "success", "msg" => "User image updated", "field" => "form_msg");
                        } else {
                            $arr = array("status" => "error", "msg" => mysqli_error($con), "field" => "image_error");
                        }
                    } else {
                        $arr = array("status" => "error", "msg" => "Invalid user details", "field" => "image_error");
                    }
                } else {
                    $arr = array("status" => "error", "msg" => "There is something wrong, when upload your image", "field" => "image_error");
                }
            } else {
                $arr = array("status" => "error", "msg" => "Select a valid image type(jpg, jpeg and png required)", "field" => "image_error");
            }
        } else {
            $arr = array("status" => "error", "msg" => "Select a image first", "field" => "image_error");
        }

        echo json_encode($arr);
    }
}
?>