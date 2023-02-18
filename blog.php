<?php include_once('./templates/top.php'); ?>
<?php include_once('./templates/header.php'); ?>

    <!-- start search section -->
    <div class="container mt-5 bg-white rounded p-4">
      <div class="row">
        <div class="col-8 offset-2 fw-bold mb-3 h4">Search Blog</div>
      </div>
      <form class="row" id="search-form" method="post">
        <div class="col-8 offset-2">
          <input
            type="text"
            class="form-control mb-3"
            id="search" name="search" required
            placeholder="search your query..."
          />
          <button class="btn btn-primary" id="search-btn">Search</button>
        </div>
      </form>
    </div>
    <!-- end search section -->

    <?php
      if(isset($_GET['category'])) {
        $conn = new PDO("mysql:host=localhost;dbname=blogging-php","root", "");
        $category = $_GET['category'];
        $sql = "SELECT * FROM blog where category = :category";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['category'=>$category]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($rows);
      }
    ?>

    <!-- start blog section -->
    <div class="container mt-5 bg-white rounded p-4">
      <div class="row">
        <div class="col-6 fw-bold mb-3 h4">All Blog</div>
      </div>
      <div class="row" id="search-container">
        <?php if(isset($rows)) {
          foreach($rows as $row) { ?>
            <div class="col-lg-4 col-md-6 col-12 mb-3">
              <div class="card">
                <img
                  src="./uploads/<?php echo $row['image'] ?> "
                  class="card-img-top"
                  alt="blog" height="250px"
                />
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['title'] ?></h5>
                  <p class="card-text">
                  <?php echo $row['description'] ?>
                  </p>
                  <a href="./blog-inner.php?blog=<?php echo $row['id'] ?>" class="btn btn-primary">Read More</a>
                </div>
              </div>
            </div>      
         <?php }
         } else { ?>
          <p class="my-5 text-danger">no blog found</p>
        <?php } ?>
      </div>
    </div>
    <!-- end blog section -->

<?php include_once('./templates/footer.php'); ?>
<?php include_once('./templates/bottom.php'); ?>