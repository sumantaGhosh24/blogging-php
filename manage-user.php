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

    <!-- start manage user -->
    <div class="container mt-5 bg-white rounded p-3">
      <div class="row">
        <div class="col-6 fw-bold mb-3 h4">Manage User</div>
      </div>
      <div class="row mt-5">
        <div class="col-12" id="manage-user">
          
        </div>
      </div>
    </div>
    <!-- end manage user -->

    <!-- start view user modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="viewUserModalLabel">User Details</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h4>Fullname : <span id="viewFullname" class="text-muted"></span></h4>
            <h5>Username : <span id="viewUsername" class="text-muted"></span></h5>
            <h5>Email : <span id="viewEmail" class="text-muted"></span></h5>
            <h5>Usertype : <span id="viewUsertype" class="text-muted"></span></h5>
            <img id="viewImg" src="" alt="user" width="200px" class="mt-3">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end view user modal -->

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>