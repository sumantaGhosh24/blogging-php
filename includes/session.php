<?php
    session_start();

    require_once 'auth.php';

    $cuser = new Auth();

    if(isset($_SESSION['user'])) {
        $cemail = $_SESSION['user'];
    
        $data = $cuser->currentUser($cemail);
    
        $cid = $data['id'];
        $cfullname = $data['fullname'];
        $cusername = $data['username'];
        $cbio = $data['bio'];
        $cemail = $data['email'];
        $cusertype = $data['usertype'];
        $registerdate = $data['register_date'];
    
        $fname = strtok($cfullname, " ");
    }
?>