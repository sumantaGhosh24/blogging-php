<?php
    session_start();

    require_once 'auth.php';
    
    $user = new Auth();
    
    // user registration handler
    if(isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['bio'])) {        
        $valid_extensions = array('jpeg', 'jpg', 'png'); 
        $path = '../uploads/';
        if($_FILES['image']) {
            $img = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $final_image = rand(1000,1000000).$img;
            if(in_array($ext, $valid_extensions)) { 
                $path = $path.strtolower($final_image); 
                if(move_uploaded_file($tmp,$path)) {
                    $fullname = $user->test_input($_POST['fullname']);
                    $username = $user->test_input($_POST['username']);
                    $bio = $user->test_input($_POST['bio']);
                    $email = $user->test_input($_POST['email']);
                    $password = $user->test_input($_POST['password']);

                    $hashpass = password_hash($password, PASSWORD_DEFAULT);
                    
                    if($user->user_exist($email)) {
                        echo 'this email already register, please try another one';
                    } else {
                        if($user->register($fullname, $username, $bio, $email, $hashpass, $final_image)) {
                            echo 'register';
                            // $_SESSION['user'] = $email;
                        } else {
                            echo 'something went wrong, please try again later';
                        }
                    }
                }
            } else {
                echo 'invalid image';
            }
        } else {
            echo "no image selected";
        }
    }

    // user login handler
    if(isset($_POST['action']) && $_POST['action'] == 'login') {
        $email = $user->test_input($_POST['email']);
        $password = $user->test_input($_POST['password']);
        $loggedInUser = $user->login($email);

        if($loggedInUser != null) {
            if(password_verify($password, $loggedInUser['password'])) {
                $_SESSION['user'] = $email;
                echo 'login';
            } else {
                echo "invalid login credentials";
            }
        } else {
            echo "user not found";
        }
    }
?>