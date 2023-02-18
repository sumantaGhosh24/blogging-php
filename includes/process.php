<?php
    require_once 'session.php';

    // manage category
    if(isset($_POST['action']) && $_POST['action'] == 'manage_category') {
        $output = '';
        if(!isset($cusertype) || $cusertype == 'user') {
            echo "<h3>only admin can access this data.</h3>";
        }
        $categories = $cuser->getCategory();
        if($categories) {
            $output .= '
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col" id="last">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
            ';
            foreach($categories as $row) {
                $output .= '
                    <tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['name'].'</td>
                        <td>'.substr($row['description'],0,75).'...</td>
                        <td>' ;                          
                            if($row['status'] == 'active') {
                                $output .= '<span class="badge text-bg-success">Active</span>';
                            } else {
                                $output .= '<span class="badge text-bg-danger">Inactive</span>';
                            }
                        $output .= '</td>
                        <td id="last">
                            <a class="btn btn-info viewCategory" href="#" id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#viewCategoryModal">
                                <i class="fa fa-eye text-white" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-warning editCategory" href="#" id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#updateCategory">
                                <i class="fa fa-pencil text-white" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger deleteCategory" id="'.$row['id'].'">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';
            }
            $output .= '
                    </tbody>
                </table>
            ';
            echo $output;
        } else {
            echo '<h3>No category found, create one for view here.</h3>';
        }
    }

    // add category
    if(isset($_POST['action']) && $_POST['action'] == 'add_category') {
        $name = $cuser->test_input($_POST['name']);
        $description = $cuser->test_input($_POST['description']);
        $status = 'active';
        $cuser->addCategory($name, $description, $status);
    }

    // view category
    if(isset($_POST['get_category'])) {
        $id = $_POST['get_category'];
        $row = $cuser->editCategory($id);
        echo json_encode($row);
    }

    // edit category
    if(isset($_POST['edit_category'])) {
        $id = $_POST['edit_category'];
        $row = $cuser->editCategory($id);
        echo json_encode($row);
    }

    // update category
    if(isset($_POST['action']) && $_POST['action'] == 'update_category') {
        $id = $cuser->test_input($_POST['cid']);
        $name = $cuser->test_input($_POST['uname']);
        $description = $cuser->test_input($_POST['udescription']);        
        $cuser->updateCategory($id, $name, $description);
    }
    
    // delete category
    if(isset($_POST['del_category'])) {
        $id = $_POST['del_category'];
        $cuser->deleteCategory($id);
    }

    // manage blog
    if(isset($_POST['action']) && $_POST['action'] == 'manage_blog') {
        $output = '';
        if(!isset($cusertype) || $cusertype == 'user') {
            echo "<h3>only admin can access this data.</h3>";
        }
        $blogs = $cuser->getBlog();
        if($blogs) {
            $output .= '
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Content</th>
                        <th scope="col">Image</th>
                        <th scope="col">User</th>
                        <th scope="col">Status</th>
                        <th scope="col">Category</th>
                        <th scope="col" id="last">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
            ';
            foreach($blogs as $row) {
                $output .= '
                    <tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['title'].'</td>
                        <td>'.substr($row['description'],0,75).'...</td>
                        <td>'.substr($row['content'],0,75).'...</td>
                        <td>
                            <img src="./uploads/'.$row['image'].'" alt="blog" class="img-fluid rounded" style="height:100px !important;width:100px !important" />
                        </td>
                        <td>'.$row['user'].'</td>
                        <td>' ;                          
                        if($row['status'] == 'active') {
                                $output .= '<span class="badge text-bg-success">Active</span>';
                            } else {
                                $output .= '<span class="badge text-bg-danger">Inactive</span>';
                            }
                            $output .= '</td>
                        <td>'.$row['category'].'</td>
                        <td id="last">
                            <a class="btn btn-info viewBlog" href="#" id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#viewBlogModal">
                                <i class="fa fa-eye text-white" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-warning editBlog" href="#" id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#updateBlog">
                                <i class="fa fa-pencil text-white" aria-hidden="true"></i>
                            </a>
                            <a href="#" class="btn btn-danger deleteBlog" id="'.$row['id'].'">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';
            }
            $output .= '
                    </tbody>
                </table>
            ';
            echo $output;
        } else {
            echo '<h3>No blog found, create one for view here.</h3>';
        }
    }


    // add blog
    if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['content'])) {    
        $valid_extensions = array('jpeg', 'jpg', 'png'); 
        $path = '../uploads/';
        if($_FILES['image']) {
            $img = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $final_image = rand(1000,1000000).$img;
            if(in_array($ext, $valid_extensions)) { 
                $path = $path.strtolower($final_image); 
                if(move_uploaded_file($tmp,$path)) {
                    $title = $cuser->test_input($_POST['title']);
                    $description = $cuser->test_input($_POST['description']);
                    $content = $cuser->test_input($_POST['content']);
                    $category = $cuser->test_input($_POST['category']);
                    $user = 'sumanta@ghosh.com';
                    $status = 'active';
                    
                    if($cuser->createBlog($title, $description, $content, $category, $final_image, $user, $status)) {
                        echo 'created';
                    } else {
                        echo 'something went wrong, please try again later';
                    }
                }
            } else {
                echo 'invalid image';
            }
        } else {
            echo "no image selected";
        }
    }

    // view category in form
    if(isset($_POST['view_category'])) {
        $categories = $cuser->getCategory();
        if($categories) {
            $output = '';
            foreach($categories as $row) {
                $output .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
            }
            echo $output;
        } else {
            echo '<option>no category found</option>';
        }
    }

    // view blog
    if(isset($_POST['get_blog'])) {
        $id = $_POST['get_blog'];
        $row = $cuser->editBlog($id);
        echo json_encode($row);
    }

    // edit blog
    if(isset($_POST['edit_blog'])) {
        $id = $_POST['edit_blog'];
        $row = $cuser->editBlog($id);
        echo json_encode($row);
    }

    // update blog
    if(isset($_POST['action']) && $_POST['action'] == 'update_blog') {
        $id = $cuser->test_input($_POST['cid']);
        $title = $cuser->test_input($_POST['utitle']);
        $description = $cuser->test_input($_POST['udescription']);        
        $content = $cuser->test_input($_POST['ucontent']);        
        $cuser->updateBlog($id, $title, $description, $content);
    }
    
    // delete blog
    if(isset($_POST['del_blog'])) {
        $id = $_POST['del_blog'];
        $cuser->deleteBlog($id);
    }

    // manage user
    if(isset($_POST['action']) && $_POST['action'] == 'manage_user') {
        $output = '';
        if(!isset($cusertype) || $cusertype == 'user') {
            echo "<h3>only admin can access this data.</h3>";
        }
        $users = $cuser->getUser();
        if($users) {
            $output .= '
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Usertype</th>
                        <th scope="col" id="last">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
            ';
            foreach($users as $row) {
                $output .= '
                    <tr>
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['fullname'].'</td>
                        <td>'.$row['username'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>
                            <img src="./uploads/'.$row['image'].'" alt="blog" class="img-fluid rounded" style="height:100px !important;width:100px !important" />
                        </td>
                        <td>' ;                          
                        if($row['status'] == 'active') {
                                $output .= '<span class="badge text-bg-success">Active</span>';
                            } else {
                                $output .= '<span class="badge text-bg-danger">Inactive</span>';
                            }
                            $output .= '</td>
                        <td>'.$row['usertype'].'</td>
                        <td id="last">
                            <a class="btn btn-info viewUser" href="#" id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#viewUserModal">
                                <i class="fa fa-eye text-white" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                ';
            }
            $output .= '
                    </tbody>
                </table>
            ';
            echo $output;
        } else {
            echo '<h3>No user found, create one for view here.</h3>';
        }
    }

    // view user
    if(isset($_POST['get_user'])) {
        $id = $_POST['get_user'];
        $row = $cuser->editUser($id);
        echo json_encode($row);
    }

    // view category in home page
    if(isset($_POST['public_category'])) {
        $categories = $cuser->getCategory();
        if($categories) {
            $output = '';
            foreach($categories as $row) {
                $output .= '
                <div class="col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">'.$row['name'].'</h5>
                        <a href="./blog.php?category='.$row['id'].'" class="link-primary">Explore More</a>
                    </div>
                    </div>
                </div>
                ';
            }
            echo $output;
        } else {
            echo 'no category found.';
        }
    }

    // view blog in home page
    if(isset($_POST['public_blog'])) {
        $blogs = $cuser->getBlogIndex();
        if($blogs) {
            $output = '';
            foreach($blogs as $blog) {
                $output .= '
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="card">
                    <img
                        src="./uploads/'.$blog['image'].'"
                        class="card-img-top"
                        alt="blog" height="250px"
                    />
                    <div class="card-body">
                        <h5 class="card-title">'.$blog['title'].'</h5>
                        <p class="card-text">'.$blog['description'].'</p>
                        <a href="./blog-inner.php?blog='.$blog['id'].'" class="btn btn-primary">Read More</a>
                    </div>
                    </div>
                </div> 
                ';
            }
            echo $output;
        } else {
            echo 'no blog found.';
        }
    }

    // search blog
    if(isset($_POST['action']) && $_POST['action'] == 'search_blog') {
        $blogs = $cuser->searchBlog($_POST['search']);
        if($blogs) {
            $output = '';
            foreach($blogs as $blog) {
                $output .= '
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="card">
                    <img
                        src="./uploads/'.$blog['image'].'"
                        class="card-img-top"
                        alt="blog" height="250px"
                    />
                    <div class="card-body">
                        <h5 class="card-title">'.$blog['title'].'</h5>
                        <p class="card-text">'.$blog['description'].'</p>
                        <a href="./blog-inner.php?blog='.$blog['id'].'" class="btn btn-primary">Read More</a>
                    </div>
                    </div>
                </div> 
                ';
            }
            echo $output;
        } else {
            echo 'no blog found.';
        }
    }
?>