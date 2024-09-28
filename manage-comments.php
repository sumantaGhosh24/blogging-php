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
        <h2 class="text-2xl font-bold mb-4 text-black text-center">Manage Comments</h2>
        <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Message</th>
                    <th class="py-3 px-6 text-left">Blog</th>
                    <th class="py-3 px-6 text-left">User</th>
                    <th class="py-3 px-6 text-left">Created At</th>
                    <th class="py-3 px-6 text-left">Updated At</th>
                </tr>
            </thead>
            <tbody id="comments"></tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        function fetchComments() {
            $.ajax({
                url: "http://localhost:3000/includes/comment.php?admin=true",
                type: "get",
                success: function (result) {
                    let comments = $.parseJSON(result);

                    $("#comments").html("");

                    comments.forEach(comment => {
                        $("#comments").append(`
                            <tr>
                                <td class="py-3 px-6 text-left">${comment.id}</td>
                                <td class="py-3 px-6 text-left">${comment.message}</td>
                                <td class="py-3 px-6 text-left">${comment.blog.id} | ${comment.blog.title}</td>
                                <td class="py-3 px-6 text-left">${comment.owner.id} | ${comment.owner.username}</td>
                                <td class="py-3 px-6 text-left">${comment.createdAt}</td>
                                <td class="py-3 px-6 text-left">${comment.updatedAt}</td>
                            </tr>
                        `);
                    })
                }
            })
        }

        fetchComments();
    })
</script>

<?php require "./includes/footer.php"; ?>