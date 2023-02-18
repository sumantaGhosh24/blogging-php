<?php include_once('./templates/top.php'); ?>
<?php include_once('./templates/header.php'); ?>

<?php
  if (!isset($cusertype) || $cusertype == 'user') {
      ?>
      <script>
        location.href = 'index.php';
      </script>
      <?php
  }
?>

<!-- start manage section -->
<div class="container mt-5 bg-white p-3 rounded">
      <h4 class="fw-bold">Dashboard</h4>
      <div class="row mt-3">
        <div class="col-lg-3 col-md-4 col-6 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">User</h5>
              <a href="./manage-user.php" class="link-primary">Manage User</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Blog</h5>
              <a href="./manage-blog.php" class="link-primary">Manage Blog</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Category</h5>
              <a href="./manage-category.php" class="link-primary"
                >Manage Category</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end manage section -->

    <!-- start new user table -->
    <div class="container mt-5 bg-white rounded p-3">
      <div class="row">
        <div class="col-6 fw-bold mb-3 h4">New User</div>
        <div class="col d-flex justify-content-end">
          <a
            href="./manage-user.php"
            class="fw-bold text-capitalize text-decoration-none"
            >manage user</a
          >
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12" id="manage-user">
          
        </div>
      </div>
    </div>
    <!-- end new user table -->

    <!-- start new blog table -->
    <div class="container mt-5 bg-white rounded p-3">
      <div class="row">
        <div class="col-6 fw-bold mb-3 h4">New Blog</div>
        <div class="col d-flex justify-content-end">
          <a
            href="./manage-blog.php"
            class="fw-bold text-capitalize text-decoration-none"
            >manage blog</a
          >
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12" id="manage-blog">
          
        </div>
      </div>
    </div>
    <!-- end new blog table -->

    <!-- start new category table -->
    <div class="container mt-5 bg-white rounded p-3">
      <div class="row">
        <div class="col-6 fw-bold mb-3 h4">New Category</div>
        <div class="col d-flex justify-content-end">
          <a
            href="./manage-category.php"
            class="fw-bold text-capitalize text-decoration-none"
            >manage category</a
          >
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-12" id="manage-category">

        </div>
      </div>
    </div>
    <!-- end new category table -->

    <script>
      setTimeout(() => {
        const data = document.querySelectorAll('#last');
        data.forEach(item => {
          item.style.display = 'none'
        })
      }, 500);
    </script>

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>