<?php require "./includes/header.php"; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<?php
if (!isset($_GET["id"])) {
    echo "There is something wrong, try again later.";
}
?>

<div class="bg-white min-h-screen">
    <br><br>
    <div class="container mx-auto">
        <div class="bg-white shadow-md shadow-black p-5 rounded space-y-5">
            <h2 id="title" class="text-2xl font-bold capitalize text-black"></h2>
            <h3 id="description" class="text-lg font-medium text-black"></h3>
            <h3 id="content" class="text-lg font-medium text-black"></h3>
            <div id="image" class="flex items-center gap-3"></div>
            <h4 id="id" class="text-black"></h4>
            <div id="category"></div>
            <div id="owner"></div>
            <h5 id="created_at" class="text-black"></h5>
            <h5 id="updated_at" class="text-black"></h5>
            <h1 class="text-3xl font-semibold mb-5 text-black">Create Comment</h1>
            <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
            <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
            <form class="mb-6" id="create_comment_form">
                <div class="mb-4">
                    <label for="file" class="text-black">Comment Message:</label>
                    <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter comment message" name="message" id="message" />
                </div>
                <input type="hidden" name="blog" value=<?php echo $_GET["id"]; ?> />
                <button type="submit" id="create_comment_submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200 w-fit">Create
                    Comment</button>
            </form>
            <div id="commentList"></div>
        </div>
    </div>
    <br><br>
</div>

<script>
    $(document).ready(function () {
        function fetchBlog() {
            $.ajax({
                url: "http://localhost:3000/includes/blog.php?id=<?php echo $_GET['id']; ?>",
                type: "get",
                success: function (result) {
                    var data = $.parseJSON(result);

                    $("#title").text(data.title);
                    $("#description").text(data.description);
                    $("#content").html(data.body);
                    $("#image").html(`
                        <img src="./uploads/${data.image}" alt="blog" class="h-36 w-36 rounded" />
                    `);
                    $("#id").text(`Id: ${data.id}`);
                    $("#category").html(`
                        <div class="flex items-center gap-3">
                            <img src="./uploads/${data.category.image}" alt="category" class="h-16 w-16 rounded-full" />
                            <h4 class="text-black">${data.category.name}</h4>
                        </div>
                    `);
                    $("#owner").html(`
                        <div class="flex items-center gap-3">
                            <img src="./uploads/${data.owner.filename}" alt="category" class="h-16 w-16 rounded-full" />
                            <div>
                                <h4 class="text-black">${data.owner.username}</h4>
                                <h4 class="text-black">${data.owner.email}</h4>
                            </div>
                        </div>
                    `);
                    $("#created_at").text(`Created At: ${data.createdAt}`);
                    $("#updated_at").text(`Updated At: ${data.updatedAt}`);
                }
            })
        }

        fetchBlog();

        function fetchComments() {
            $.ajax({
                url: "http://localhost:3000/includes/comment.php?id=<?php echo $_GET['id']; ?>",
                type: "get",
                success: function (result) {
                    var data = $.parseJSON(result);

                    $("#commentList").html("");

                    if (data.length > 0) {
                        data.forEach(comment => {
                            $("#commentList").append(`
                                <div class='bg-gray-200 p-3 my-4 rounded space-y-3'>
                                    <h2 class='text-xl font-bold capitalize'>${comment.message}</h2>
                                    <h4>Owner: ${comment.owner.email}</h4>
                                    <h5 class='text-xs font-light'>${comment.createdAt}</h5>
                                </div>
                            `);
                        })
                    } else {
                        $("#commentList").html("<p class='font-extrabold text-2xl p-3'>No Comments found.</p>")
                    }
                }
            })
        }

        fetchComments();

        $("#create_comment_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#create_comment_submit").attr("disabled", true);
            $("#create_comment_submit").text("Processing...");

            var formData = new FormData(this);

            $.ajax({
                url: "http://localhost:3000/includes/comment.php",
                type: "post",
                data: $("#create_comment_form").serialize(),
                success: function (result) {
                    $("#create_comment_submit").attr("disabled", false);
                    $("#create_comment_submit").text("Create comment");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        fetchComments();
                    }
                }
            })

            e.preventDefault();
        })
    })
</script>

<?php require "./includes/footer.php"; ?>