<?php
    if (isset($_SESSION["user"])) {
        header("location:index.php");
    }
?>

<?php include_once('./templates/top.php'); ?>
<?php include_once('./templates/header.php'); ?>

<!-- start register section -->
<div class="container mt-5">
      <div class="row">
        <div class="col-10 offset-1 bg-white p-4 rounded shadow-lg">
          <h2 class="text-center mb-4">Registration Form</h2>
          <form id="register-form" enctype="multipart/form-data" method="POST" action="">
            <div class="mb-3">
              <label for="image" class="form-label"
                >Upload your profile picture</label
              >
              <input
                class="form-control form-control-lg"
                id="image"
                type="file" name="image"
              />
            </div>
            <div class="mb-3">
              <label for="fullname" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullname" name="fullname" required />
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required />
            </div>
            <div class="mb-3">
              <label for="bio" class="form-label">Bio</label>
              <input type="text" class="form-control" id="bio" name="bio" required />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div id="register-err" class="text-danger my-3"></div>
            <button type="submit" class="btn btn-lg btn-primary" id="register-btn">
              Signup
            </button>
          </form>
          <div>
            <p class="mt-4">
              Already have an account? <a href="./login.php">Login</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- end register section -->

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>