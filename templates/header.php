<?php
    session_start();

    require_once 'includes/auth.php';

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

<!-- start navbar section -->
<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="index.php">Blogging</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- public links -->
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="blog.php">Blog</a>
                </li>

                <!-- guest links -->
                <?php if (!isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="login.php">Login</a>
                    </li>
                <?php } ?>

                <!-- admin links -->
                <?php if (isset($cusertype) && $cusertype == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                <?php } ?>

                <!-- user links -->
                <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="logout.php">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<!-- end navbar section -->