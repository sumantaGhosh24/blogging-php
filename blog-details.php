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
    <div class="container mx-auto">
        <br><br>
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
        </div>
    </div>
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
    })
</script>

<?php require "./includes/footer.php"; ?>