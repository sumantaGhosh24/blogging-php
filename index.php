<?php include_once('./templates/top.php'); ?>
<?php include_once('./templates/header.php'); ?>

<!-- start category section -->
<div class="container mt-5 bg-white p-3 rounded">
  <div class="row">
    <div class="col-6 fw-bold mb-3 h4">All Category</div>
    <div class="col-6 d-flex justify-content-end">
      <a
      href="./blog.php"
      class="fw-bold text-capitalize text-decoration-none"
      >explore more</a
      >
    </div>
  </div>
    <?php if(isset($_SESSION['user'])) { ?>
      <div class="row" id="public-category">
        
      </div>
      <?php } ?>
    </div>
    <!-- end category section -->

    <!-- start latest blog section -->
    <div class="container mt-5 rounded bg-white p-3">
      <div class="row">
        <div class="col-6 fw-bold mb-3 h4">Latest Blog</div>
        <div class="col-6 d-flex justify-content-end">
          <a
            href="./blog.php"
            class="fw-bold text-capitalize text-decoration-none"
            >explore more</a
          >
        </div>
      </div>
      <div class="row" id="blog-home">
        
      </div>
    </div>
    <!-- end latest blog section -->

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>