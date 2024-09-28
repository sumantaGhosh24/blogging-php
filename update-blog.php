<?php require "./includes/header.php"; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}

if ($_SESSION["USER_ROLE"] !== "admin") {
    header("Location: index.php");
    die();
}
?>

<?php
if (!isset($_GET["id"])) {
    echo "There is something wrong, try again later.";
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

<div class="flex justify-center items-center bg-white my-20">
    <div class="bg-white rounded-lg shadow-md p-8 shadow-black w-[75%]">
        <h1 class="text-3xl font-semibold mb-5 text-black">Update Blog</h1>
        <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
        <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
        <form class="mb-6" id="update_blog_form">
            <div class="mb-4">
                <label for="title" class="text-black">Blog Title:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter blog title" name="title" id="title" />
            </div>
            <div class="mb-4">
                <label for="description" class="text-black">Blog Description:</label>
                <textarea placeholder="Enter blog description" name="description" id="description"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 resize-y"></textarea>
            </div>
            <div class="mb-4">
                <label for="content" class="text-black">Blog Content:</label>
                <textarea name="content" id="markdown-editor"></textarea>
            </div>
            <div class="mb-4">
                <label for="category" class="text-black">Blog Category:</label>
                <select name="category" id="category" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                    <option value="">Select Category</option>
                </select>
            </div>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <button type="submit" id="update_blog_submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Update
                Blog</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        var simplemde = new SimpleMDE({ element: document.getElementById("markdown-editor") });

        function fetchCategories() {
            $.ajax({
                url: "http://localhost:3000/includes/category.php?admin=true",
                type: "get",
                success: function (result) {
                    let categories = $.parseJSON(result);

                    categories.forEach(category => {
                        $("#category").append(`
                            <option value="${category.id}">${category.name}</option>
                        `);
                    })
                }
            })
        }

        fetchCategories();

        function fetchBlog() {
            $.ajax({
                url: "http://localhost:3000/includes/blog.php?id=<?php echo $_GET['id']; ?>",
                type: "get",
                success: function (result) {
                    var data = $.parseJSON(result);

                    $("#title").val(data.title);
                    $("#description").val(data.description);
                    simplemde.value(data.content);
                    $("#category").val(data.category.id);
                }
            })
        }

        fetchBlog();

        $("#update_blog_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#update_blog_submit").attr("disabled", true);
            $("#update_blog_submit").text("Processing...");

            $.ajax({
                url: "http://localhost:3000/includes/blog.php",
                type: "post",
                data: $("#update_blog_form").serialize(),
                success: function (result) {
                    $("#update_blog_submit").attr("disabled", false);
                    $("#update_blog_submit").text("Update Blog");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        fetchBlog();
                    }
                }
            })

            e.preventDefault();
        })
    })
</script>

<?php require "./includes/footer.php"; ?>