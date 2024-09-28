<?php require './includes/header.php'; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<div class="flex justify-center items-center h-screen bg-white">
    <div class="bg-white rounded-lg shadow-md p-8 shadow-black w-[90%]">
        <form id="searchForm">
            <div class="flex items-center justify-between gap-2 flex-col md:flex-row">
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Search blog"
                    name="title" id="title" />
                <select name="category" id="category" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                    <option value="">Select Category</option>
                </select>
                <input type="hidden" id="limit" name="limit" value="5" />
                <button type="submit"
                    class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Search
                    Blog</button>
            </div>
        </form>
        <div id="blogList" class="flex flex-col gap-3 my-5"></div>
        <div id="paginationLinks"></div>
    </div>
</div>

<script>
    $(document).ready(function () {
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

        function fetchBlogs(page = 1) {
            const category = $("#category").val();
            const title = $("#title").val();
            const limit = $("#limit").val();

            $.ajax({
                url: "http://localhost:3000/includes/fetch_blogs.php",
                type: "get",
                data: {
                    category: category,
                    title: title,
                    limit: limit,
                    page: page
                },
                success: function (data) {
                    const result = JSON.parse(data);

                    const blogs = result.blogs;
                    const totalPages = result.totalPages;

                    $("#blogList").empty();

                    if (blogs.length > 0) {
                        blogs.forEach(blog => {
                            $("#blogList").append(`
                                <a href="./blog-details.php?id=${blog.id}">
                                    <div class="bg-white shadow-black shadow-md rounded p-3">
                                        <h2 class="capitalize text-2xl font-bold text-black">${blog.title}</h2>
                                        <p class="text-black">${blog.description}</p>
                                        <p class="text-black"><strong>Category:</strong> ${blog.category.name}</p>
                                        <p class="text-black"><strong>Owner:</strong> ${blog.owner.firstName} ${blog.owner.lastName}</p>
                                    </div>
                                </a>
                            `);
                        })
                    } else {
                        $("#blogList").append("<p class='font-extrabold text-2xl p-3'>No blogs found.</p>");
                    }

                    $("#paginationLinks").empty();

                    if (page > 1) {
                        $('#paginationLinks').append(`<a href="#" class="paginationLink w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200" data-page="${page - 1}">Previous</a> `);
                    }
                    if (page < totalPages) {
                        $('#paginationLinks').append(`<a href="#" class="paginationLink w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200" data-page="${page + 1}">Next</a>`);
                    }
                }
            })
        }

        $('#searchForm').on('submit', function (e) {
            e.preventDefault();

            fetchBlogs();
        });

        $(document).on('click', '.paginationLink', function (e) {
            e.preventDefault();

            const page = $(this).data('page');
            fetchBlogs(page);
        });

        fetchBlogs();
    })
</script>

<?php require './includes/footer.php'; ?>