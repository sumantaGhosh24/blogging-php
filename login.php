<?php
    if (isset($_SESSION["user"])) {
        header("location:index.php");
    }
?>

<?php include_once('./templates/top.php'); ?>
<?php include_once('./templates/header.php'); ?>

<!-- start login section -->
<div class="container mt-5">
      <div class="row">
        <div class="col-10 offset-1 bg-white p-4 rounded shadow-lg">
          <h2 class="text-center mb-4">Login Form</h2>
          <form id="login-form" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required />
            </div>
            <div id="login-err" class="text-danger-my-3"></div>
            <button type="submit" id="login-btn" class="btn btn-lg btn-primary">Login</button>
          </form>
          <div>
            <p class="mt-4">
              Don't have an account? <a href="./register.php">Register</a>
            </p>
          </div>
        </div>
      </div>
    </div>
    <!-- end login section -->

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>