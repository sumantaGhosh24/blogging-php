<?php
include 'database.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = mysqli_real_escape_string($con, $_POST["action"]);

    if ($action === "register") {
        $firstName = mysqli_real_escape_string($con, $_POST["firstName"]);
        $lastName = mysqli_real_escape_string($con, $_POST["lastName"]);
        $username = mysqli_real_escape_string($con, $_POST["username"]);
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $mobileNumber = mysqli_real_escape_string($con, $_POST["mobileNumber"]);
        $password = mysqli_real_escape_string($con, $_POST["password"]);
        $cf_password = mysqli_real_escape_string($con, $_POST["cf_password"]);

        if ($firstName === "") {
            $arr = array("status" => "error", "msg" => "First name is required", "field" => "firstName_error");
        } elseif ($lastName === "") {
            $arr = array("status" => "error", "msg" => "Last name is required", "field" => "lastName_error");
        } elseif ($username === "") {
            $arr = array("status" => "error", "msg" => "Username is required", "field" => "username_error");
        } elseif ($email === "") {
            $arr = array("status" => "error", "msg" => "Email is required", "field" => "email_error");
        } elseif ($mobileNumber === "") {
            $arr = array("status" => "error", "msg" => "Mobile number is required", "field" => "mobileNumber_error");
        } elseif (strlen($password) < 6) {
            $arr = array("status" => "error", "msg" => "Password length minimum 6", "field" => "password_error");
        } elseif ($password !== $cf_password) {
            $arr = array("status" => "error", "msg" => "Password and confirm password not match", "field" => "cf_password_error");
        } else {
            $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email='$email'"));

            if ($check > 0) {
                $arr = array("status" => "error", "msg" => "Email id already registered", "field" => "email_error");
            } else {
                $new_password = password_hash($password, PASSWORD_BCRYPT);

                $sql = "INSERT INTO users (firstName, lastName, username, mobileNumber, email, password) VALUES ('$firstName', '$lastName', '$username', '$mobileNumber', '$email', '$new_password')";

                if (mysqli_query($con, $sql)) {
                    $arr = array("status" => "success", "msg" => "Registration success", "field" => "form_msg");
                } else {
                    $arr = array("status" => "error", "msg" => mysqli_error($con), "field" => "email_error");
                }
            }
        }

        echo json_encode($arr);
    }

    if ($action === "login") {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $password = mysqli_real_escape_string($con, $_POST["password"]);

        if ($email === "") {
            $arr = array("status" => "error", "msg" => "Email is required", "field" => "email_error");
        } elseif ($password === "") {
            $arr = array("status" => "error", "msg" => "Password is required", "field" => "password_error");
        } else {
            $result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    $_SESSION["USER_ID"] = $row["id"];
                    $_SESSION["USER_ROLE"] = $row["role"];

                    $arr = array("status" => "success", "msg" => "Login success", "field" => "form_msg");
                } else {
                    $arr = array("status" => "error", "msg" => "Invalid login credential", "field" => "email_error");
                }
            } else {
                $arr = array("status" => "error", "msg" => "Please enter a valid email address", "field" => "email_error");
            }
        }

        echo json_encode($arr);
    }
}
?>