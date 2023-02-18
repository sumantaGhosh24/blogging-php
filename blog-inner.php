<?php include_once('./templates/top.php'); ?>
<?php include_once('./templates/header.php'); ?>

<?php
  $conn = new PDO("mysql:host=localhost;dbname=blogging-php","root", "");
  $id = $_GET['blog'];
  $sql = "SELECT * FROM blog where id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->execute(['id'=>$id]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

    <!-- start detailed blog section -->
    <div class="container mt-5">
      <div class="row" id="blog-inner">
        <?php if(isset($row)) { ?>
          <div class="col-12 bg-white rounded p-3">
            <h3>
              <?php echo $row['title'] ?>
            </h3>
            <h5 class="mt-4 fw-light">
              <?php echo $row['description'] ?>
            </h5>
            <img
              class="img-fluid w-100 h-50 mt-4"
              src="./uploads/<?php echo $row['image'] ?>"
              alt="blog"
            />
            <p class="mt-5">
              <?php echo $row['content'] ?>
            </p>
          </div>
        <?php } else { ?>
          <p>no blog found</p>
        <?php } ?>
<?php
  $sql2 = "SELECT * FROM users where email = :id";
  $stmt2 = $conn->prepare($sql2);
  $stmt2->execute(['id'=>$row['user']]);
  $creator = $stmt2->fetch(PDO::FETCH_ASSOC);
?>
        <div class="col-12 mt-5 bg-white rounded p-3">
          <h3 class="fw-bold">Creator Information</h3>
          <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4">
                <img
                  src="./uploads/<?php echo $creator['image'] ?>"
                  class="img-fluid rounded-start h-100 w-100"
                  alt="user"
                />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title mb-4"><?php echo $creator['fullname'] ?></h5>
                  <p class="card-title mb-4 fw-bold"><?php echo $creator['username'] ?></p>
                  <p class="card-title mb-4">
                    <span class="fw-bold">Email Address: </span> <?php echo $creator['email'] ?>
                  </p>
                  <p class="card-text mb-4">
                  <?php echo $creator['bio'] ?>
                  </p>
                  <p class="card-text">
                    User since : <small class="text-muted"><?php echo $creator['register_date'] ?></small>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php if(isset($_SESSION['user'])) { ?>
        <div class="col-12 mt-5 bg-white p-3 rounded">
          <h3 class="fw-bold">Write a Comment</h3>
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" />
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" />
            </div>
            <button type="submit" class="btn btn-lg btn-primary">
              Comment
            </button>
          </form>
        </div>
        </div>
        <?php } else { ?>
          <p class="my-5 text-danger">please login to make comment.</p>
        <?php } ?>
      </div>
    </div>
    <!-- end detailed blog section -->

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>