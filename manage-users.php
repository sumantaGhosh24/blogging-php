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

<div class="min-h-screen pt-8 bg-white overflow-x-scroll">
    <div class="overflow-x-auto">
        <h2 class="text-2xl font-bold mb-4 text-black text-center">Manage Users</h2>
        <table class="min-w-full bg-white rounded-lg shadow-md mx-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Mobile Number</th>
                    <th class="py-3 px-6 text-left">First Name</th>
                    <th class="py-3 px-6 text-left">Last Name</th>
                    <th class="py-3 px-6 text-left">Username</th>
                    <th class="py-3 px-6 text-left">Image</th>
                    <th class="py-3 px-6 text-left">DOB</th>
                    <th class="py-3 px-6 text-left">Gender</th>
                    <th class="py-3 px-6 text-left">City</th>
                    <th class="py-3 px-6 text-left">State</th>
                    <th class="py-3 px-6 text-left">Country</th>
                    <th class="py-3 px-6 text-left">Zip</th>
                    <th class="py-3 px-6 text-left">Addressline</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Role</th>
                    <th class="py-3 px-6 text-left">Created At</th>
                    <th class="py-3 px-6 text-left">Updated At</th>
                </tr>
            </thead>
            <tbody id="users"></tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        function fetchUsers() {
            $.ajax({
                url: "http://localhost:3000/includes/user.php?admin=true",
                type: "get",
                success: function (result) {
                    let users = $.parseJSON(result);

                    $("#users").html("");

                    users.forEach(user => {
                        $("#users").append(`
                            <tr>
                                <td class="py-3 px-6 text-left">${user.id}</td>
                                <td class="py-3 px-6 text-left">${user.email}</td>
                                <td class="py-3 px-6 text-left">${user.mobileNumber}</td>
                                <td class="py-3 px-6 text-left">${user.firstName}</td>
                                <td class="py-3 px-6 text-left">${user.lastName}</td>
                                <td class="py-3 px-6 text-left">${user.username}</td>
                                <td class="py-3 px-6 text-left">
                                    <img src="/uploads/${user.filename}" alt="avatar" class="w-12 h-12 rounded-full" />
                                </td>
                                <td class="py-3 px-6 text-left">${user.dob}</td>
                                <td class="py-3 px-6 text-left">${user.gender}</td>
                                <td class="py-3 px-6 text-left">${user.city}</td>
                                <td class="py-3 px-6 text-left">${user.state}</td>
                                <td class="py-3 px-6 text-left">${user.country}</td>
                                <td class="py-3 px-6 text-left">${user.zip}</td>
                                <td class="py-3 px-6 text-left">${user.addressline}</td>
                                <td class="py-3 px-6 text-left">${user.status}</td>
                                <td class="py-3 px-6 text-left">${user.role}</td>
                                <td class="py-3 px-6 text-left">${user.createdAt}</td>
                                <td class="py-3 px-6 text-left">${user.updatedAt}</td>
                            </tr>
                        `);
                    })
                }
            })
        }

        fetchUsers()
    })
</script>

<?php require "./includes/footer.php"; ?>