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

    <!-- start manage blog -->
    <div class="container mt-5 bg-white rounded p-3">
      <div class="row">
        <div class="col-6 fw-bold mb-3 h4">Manage Blog</div>
        <div class="col-6">
          <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createBlog">
            Create Blog
          </button>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12" id="manage-blog">

        </div>
      </div>
    </div>
    <!-- end manage blog -->

    <!-- start create blog modal -->
    <div class="modal fade" id="createBlog" tabindex="-1" aria-labelledby="createBlogLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="createBlogLabel">Create Blog</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="add-blog-form" enctype="multipart/form-data" method="POST" action="">
              <div class="mb-3">
                <label for="image" class="form-label"
                  >Upload your blog image</label
                >
                <input
                  class="form-control form-control-lg"
                  id="image"
                  type="file" name="image"
                />
              </div>
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required />
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required />
              </div>
              <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="5" name="content" required></textarea>
              </div>
              <div class="mb-3">
                <select class="form-select" aria-label="Default select example" name="category" id="category" required>
                  
                </select>
              </div>
              <div id="add-blog-err" class="text-danger"></div>
              <button type="submit" class="btn btn-lg btn-primary" id="add-blog-btn">
                Create Blog
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end create blog modal -->

    <!-- start view blog modal -->
    <div class="modal fade" id="viewBlogModal" tabindex="-1" aria-labelledby="viewBlogModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewBlogModalLabel">Blog Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4>Title : <span id="viewTitle" class="text-muted"></span></h4>
            <h5>Description : <span id="viewDescription" class="text-muted"></span></h5>
            <h5>Content : <span id="viewContent" class="text-muted"></span></h5>
            <img id="viewImg" src="" alt="blog" width="200px" class="mt-3">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end view blog modal -->

    <!-- start update blog modal -->
    <div class="modal fade" id="updateBlog" tabindex="-1" aria-labelledby="updateBlogLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateBlogLabel">Update Blog</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="update-blog-form" method="post">
              <input type="hidden" name="cid" id="cid" val="">
              <div class="mb-3">
                <label for="utitle" class="form-label">Title</label>
                <input type="text" class="form-control" id="utitle" name="utitle" required />
              </div>
              <div class="mb-3">
                <label for="udescription" class="form-label">Description</label>
                <input type="text" class="form-control" id="udescription" name="udescription" required />
              </div>
              <div class="mb-3">
                <label for="ucontent" class="form-label">Content</label>
                <textarea class="form-control" id="ucontent" name="ucontent" required rows="5"></textarea>
              </div>
              <div id="update-blog-err" class="text-danger"></div>
              <button type="submit" class="btn btn-lg btn-primary" id="update-blog-btn">
                Update Blog
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end update blog modal -->

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>