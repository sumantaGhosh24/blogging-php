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

    <!-- start manage category -->
    <div class="container mt-5 bg-white rounded p-3">
      <div class="row">
        <div class="col-6 fw-bold mb-3 h4">Manage Category</div>
        <div class="col-6">
          <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createCategory">
            Create Category
          </button>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12" id="manage-category">
          
              
        </div>
      </div>
    </div>
    <!-- end manage category -->

    <!-- start create category modal -->
    <div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="createCategoryLabel">Create Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add-category-form" method="post">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required />
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required />
              </div>
              <div id="add-category-err" class="text-danger"></div>
              <button type="submit" class="btn btn-lg btn-primary" id="add-category-btn">
                Create Category
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end create category modal -->

    <!-- start view category modal -->
    <div class="modal fade" id="viewCategoryModal" tabindex="-1" aria-labelledby="viewCategoryModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewCategoryModalLabel">Category Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4>Name : <span id="viewName"></span></h4>
            <h5>Description : <span id="viewDescription"></span></h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end view category modal -->

    <!-- start update category modal -->
    <div class="modal fade" id="updateCategory" tabindex="-1" aria-labelledby="updateCategoryLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateCategoryLabel">Update Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="update-category-form" method="post">
              <input type="hidden" name="cid" id="cid" val="">
              <div class="mb-3">
                <label for="uname" class="form-label">Name</label>
                <input type="text" class="form-control" id="uname" name="uname" required />
              </div>
              <div class="mb-3">
                <label for="udescription" class="form-label">Description</label>
                <input type="text" class="form-control" id="udescription" name="udescription" required />
              </div>
              <div id="update-category-err" class="text-danger"></div>
              <button type="submit" class="btn btn-lg btn-primary" id="update-category-btn">
                Update Category
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end update category modal -->

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>