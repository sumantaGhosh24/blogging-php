<?php
    require_once 'config.php';

    class Auth extends Database {
        // register user
        public function register($fullname, $username, $bio, $email, $hashpass, $path) {
            $sql = "INSERT INTO users(fullname, username, bio, email, password, image) VALUES (:fullname, :username, :bio, :email, :password, :image)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['fullname'=>$fullname, 'username'=>$username, 'bio'=>$bio, 'email'=>$email, 'password'=>$hashpass, 'image'=>$path]);
            return true;
        }

        // check user already register or not
        public function user_exist($email) {
            $sql = "SELECT email FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        // login user
        public function login($email) {
            $sql = "SELECT email, password FROM users WHERE email = :email AND status = 'active'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        // get current user
        public function currentUser($email) {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        
        // get category
        public function getCategory() {
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // add category
        public function addCategory($name, $description, $status) {
            $sql = "INSERT INTO categories (name, description, status) VALUES (:name, :description, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['name'=>$name, 'description'=>$description, 'status'=>$status]);
            return true;
        }

        // edit category
        public function editCategory($id) {
            $sql = "SELECT * FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        // update category
        public function updateCategory($id, $name, $description) {
            $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['name'=>$name, 'description'=>$description, 'id'=>$id]);
            return true;
        }
        
        // delete category
        public function deleteCategory($id) {
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return true;
        }

        // get blog
        public function getBlog() {
            $sql = "SELECT * FROM blog";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // create blog
        public function createBlog($title, $description, $content, $category, $path, $user, $status) {
            $sql = "INSERT INTO blog(title, description, content, category, image, user, status) VALUES (:title, :description, :content, :category, :image, :user, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['title'=>$title, 'description'=>$description, 'content'=>$content, 'category'=>$category, 'image'=>$path, 'user'=>$user, 'status'=>$status]);
            return true;
        }

        // edit blog
        public function editBlog($id) {
            $sql = "SELECT * FROM blog WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        // update blog
        public function updateBlog($id, $title, $description, $content) {
            $sql = "UPDATE blog SET title = :title, description = :description, content = :content WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['title'=>$title, 'description'=>$description, 'content'=>$content, 'id'=>$id]);
            return true;
        }
        
        // delete blog
        public function deleteBlog($id) {
            $sql = "DELETE FROM blog WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return true;
        }

        // get user
        public function getUser() {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // edit user
        public function editUser($id) {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        // get blog in index page
        public function getBlogIndex() {
            $sql = "SELECT * FROM blog LIMIT 6";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        // search blog
        public function searchBlog($search) {
            $sql = "SELECT * FROM blog WHERE title like '%$search%'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>