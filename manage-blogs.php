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

<div class="min-h-screen pt-8 bg-white container mx-auto">
    <div class="overflow-x-scroll">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold mb-4 text-black text-center">Manage Blogs</h2>
            <span id="form_error" class="text-red-500 font-bold text-center my-3"></span>
            <span id="form_success" class="text-green-500 font-bold text-center my-3"></span>
            <a href="/create-blog.php"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors w-fit">Create
                Blog</a>
        </div>
        <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Title</th>
                    <th class="py-3 px-6 text-left">Description</th>
                    <th class="py-3 px-6 text-left">Owner</th>
                    <th class="py-3 px-6 text-left">Image</th>
                    <th class="py-3 px-6 text-left">Category</th>
                    <th class="py-3 px-6 text-left">Created At</th>
                    <th class="py-3 px-6 text-left">Updated At</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="blogs"></tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        function fetchBlogs() {
            $.ajax({
                url: "http://localhost:3000/includes/blog.php?admin=true",
                type: "get",
                success: function (result) {
                    let blogs = $.parseJSON(result);

                    $("#blogs").html("");

                    blogs.forEach(blog => {
                        $("#blogs").append(`
                            <tr>
                                <td class="py-3 px-6 text-left">${blog.id}</td>
                                <td class="py-3 px-6 text-left">${blog.title}</td>
                                <td class="py-3 px-6 text-left">${blog.description}</td>
                                <td class="py-3 px-6 text-left flex items-center gap-3">
                                    <img src="/uploads/${blog.owner.filename}" alt="owner" class="w-12 h-12 rounded-full" />
                                    <div>
                                        <p class="text-lg font-bold">${blog.owner.username}</p>
                                        <p class="text-lg font-bold">${blog.owner.email}</p>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <img src="/uploads/${blog.image}" alt="blog" class="w-12 h-12 rounded-full" />
                                </td>
                                <td class="py-3 px-6 text-left flex items-center gap-3">
                                    <img src="/uploads/${blog.category.image}" alt="category" class="w-12 h-12 rounded-full" />
                                    <p class="text-lg font-bold">${blog.category.name}</p>
                                </td>
                                <td class="py-3 px-6 text-left">${blog.createdAt}</td>
                                <td class="py-3 px-6 text-left">${blog.updatedAt}</td>
                                <td class="py-3 px-6 text-left flex items-center gap-3">
                                    <a href="./blog-details.php?id=${blog.id}" class="w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">View</a>
                                    <a href="./update-blog.php?id=${blog.id}" class="w-fit bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors disabled:bg-green-200">Update</a>
                                    <form class="blog_delete_form">
                                        <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors disabled:bg-red-200">Delete</button>
                                        <input type="hidden" name="id" value="${blog.id}" />
                                        <input type="hidden" name="action" value="delete" />
                                    </form>
                                </td>
                            </tr>
                        `);
                    })
                }
            })
        }

        fetchBlogs();

        $(document).on("submit", ".blog_delete_form", function (e) {
            e.preventDefault();

            let form = $(this);
            let button = form.find("button[type='submit']");

            $("#form_error").html("");
            $("#form_success").html("");
            button.attr("disabled", true).text("Processing...");

            $.ajax({
                url: "http://localhost:3000/includes/blog.php",
                type: "post",
                data: form.serialize(),
                success: function (result) {
                    button.attr("disabled", false).text("Delete");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        fetchBlogs();
                    }
                }
            })
        })
    })
</script>

<?php require "./includes/footer.php"; ?>