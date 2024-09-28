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

<div class="bg-white min-h-screen">
    <br><br>
    <div class="container mx-auto">
        <h1 class="text-xl font-bold mb-10">Dashboard</h1>
        <div class="bg-white shadow-md shadow-black p-5 rounded flex items-center justify-between gap-3">
            <div class="bg-gray-200 p-3 rounded w-full">
                <h2 class="font-bold text-xl">Users</h2>
                <h3 id="users"></h3>
            </div>
            <div class="bg-gray-200 p-3 rounded w-full">
                <h2 class="font-bold text-xl">Category</h2>
                <h3 id="category"></h3>
            </div>
            <div class="bg-gray-200 p-3 rounded w-full">
                <h2 class="font-bold text-xl">Blogs</h2>
                <h3 id="blogs"></h3>
            </div>
            <div class="bg-gray-200 p-3 rounded w-full">
                <h2 class="font-bold text-xl">Comments</h2>
                <h3 id="comments"></h3>
            </div>
        </div>
    </div>
    <br><br>
</div>

<script>
    $(document).ready(function () {
        function fetchDashboard() {
            $.ajax({
                url: "http://localhost:3000/includes/dashboard.php",
                type: "get",
                success: function (result) {
                    var data = $.parseJSON(result);

                    $("#users").text(data.users);
                    $("#category").text(data.category);
                    $("#blogs").text(data.blogs);
                    $("#comments").text(data.comments);
                }
            })
        }

        fetchDashboard();
    })
</script>

<?php require "./includes/footer.php"; ?>