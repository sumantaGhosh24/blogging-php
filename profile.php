<?php require './includes/header.php'; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<div class="bg-white min-h-screen">
    <div class="container mx-auto">
        <div class="flex pt-5 mb-5">
            <button id="details" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded">User Details</button>
            <button id="image" class="mr-2 bg-gray-400 text-gray-700 px-4 py-2 rounded">Update User Image</button>
            <button id="data" class="mr-2 bg-gray-400 text-gray-700 px-4 py-2 rounded">Update User Data</button>
            <button id="address" class="mr-2 bg-gray-400 text-gray-700 px-4 py-2 rounded">Update User Address</button>
        </div>
        <div id="detailsContent" class="bg-white shadow-md shadow-black p-5 rounded">
            <h1 class="text-2xl font-semibold mb-4 text-black">User Details</h1>
            <div class="flex flex-col gap-3" id="view_details"></div>
        </div>
        <div id="imageContent" class="hidden bg-white shadow-md shadow-black p-5 rounded">
            <h1 class="text-2xl font-semibold mb-4 text-black">Update User Image</h1>
            <span id="form_msg" class="text-green-500 font-bold text-center my-3"></span>
            <form id="image_form" class="mt-6 p-4">
                <div id="img_preview"></div>
                <label for="file" class="text-black">Avatar:</label>
                <input type="file" id="file" name="file" accept="image/*"
                    class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                <span id="image_error" class="text-red-500 font-bold error_field"></span>
                <input type="hidden" name="action" value="image_form" />
                <button type="submit" id="image_form_submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Update User
                    Image</button>
            </form>
        </div>
        <div id="dataContent" class="hidden bg-white shadow-md shadow-black p-5 rounded">
            <h1 class="text-2xl font-semibold mb-4 text-black">Update User Data</h1>
            <span id="form_msg" class="text-green-500 font-bold text-center my-3"></span>
            <form id="data_form" class="p-4">
                <div class="mb-4">
                    <label for="firstName" class="text-black">First Name:</label>
                    <input type="text" id="firstName" name="firstName"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter your first name" />
                    <span id="firstName_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <div class="mb-4">
                    <label for="lastName" class="text-black">Last Name:</label>
                    <input type="text" id="lastName" name="lastName"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter your last name" />
                    <span id="lastName_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <div class="mb-4">
                    <label for="username" class="text-black">Username:</label>
                    <input type="text" id="username" name="username"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter your username" />
                    <span id="username_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <div class="mb-4">
                    <label for="dob" class="text-black">DOB:</label>
                    <input type="date" id="dob" name="dob"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300" />
                    <span id="dob_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <div class="mb-4">
                    <label for="gender" class="text-black">Gender(
                        <span id="gn"></span>):
                    </label>
                    <select name="gender" id="gender" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <span id="gender_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <input type="hidden" name="action" value="data_form" />
                <button type="submit" id="data_form_submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Update User
                    Data</button>
            </form>
        </div>
        <div id="addressContent" class="hidden bg-white shadow-md shadow-black p-5 rounded">
            <h1 class="text-2xl font-semibold mb-4 text-black">Update User Address</h1>
            <span id="form_msg" class="text-green-500 font-bold text-center my-3"></span>
            <form id="address_form" class="mt-6 p-4 mb-4">
                <div class="mb-4">
                    <label for="city" class="text-black">City:</label>
                    <input type="text" id="city" name="city"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Enter your city" />
                    <span id="city_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <div class="mb-4">
                    <label for="state" class="text-black">State:</label>
                    <input type="text" id="state" name="state"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter your state" />
                    <span id="state_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <div class="mb-4">
                    <label for="country" class="text-black">Country:</label>
                    <input type="text" id="country" name="country"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter your country" />
                    <span id="country_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <div class="mb-4">
                    <label for="zip" class="text-black">Zip:</label>
                    <input type="text" id="zip" name="zip"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300" placeholder="Enter your zip" />
                    <span id="zip_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <div class="mb-4">
                    <label for="addressline" class="text-black">Addressline:</label>
                    <input type="text" id="addressline" name="addressline"
                        class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300"
                        placeholder="Enter your addressline" />
                    <span id="addressline_error" class="text-red-500 font-bold error_field"></span>
                </div>
                <input type="hidden" name="action" value="address_form" />
                <button type="submit" id="address_form_submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Update User
                    Address</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#details").click(function () {
            $("#details").addClass("bg-blue-500", "text-white");
            $("#details").removeClass("bg-gray-400", "text-gray-700");

            $("#image").removeClass("bg-blue-500", "text-white");
            $("#image").addClass("bg-gray-400", "text-gray-700");
            $("#data").removeClass("bg-blue-500", "text-white");
            $("#data").addClass("bg-gray-400", "text-gray-700");
            $("#address").removeClass("bg-blue-500", "text-white");
            $("#address").addClass("bg-gray-400", "text-gray-700");

            $("#detailsContent").removeClass("hidden");

            $("#imageContent").addClass("hidden");
            $("#dataContent").addClass("hidden");
            $("#addressContent").addClass("hidden");
        });

        $("#image").click(function () {
            $("#image").addClass("bg-blue-500", "text-white");
            $("#image").removeClass("bg-gray-400", "text-gray-700");

            $("#details").removeClass("bg-blue-500", "text-white");
            $("#details").addClass("bg-gray-400", "text-gray-700");
            $("#data").removeClass("bg-blue-500", "text-white");
            $("#data").addClass("bg-gray-400", "text-gray-700");
            $("#address").removeClass("bg-blue-500", "text-white");
            $("#address").addClass("bg-gray-400", "text-gray-700");

            $("#imageContent").removeClass("hidden");

            $("#detailsContent").addClass("hidden");
            $("#dataContent").addClass("hidden");
            $("#addressContent").addClass("hidden");
        });

        $("#data").click(function () {
            $("#data").addClass("bg-blue-500", "text-white");
            $("#data").removeClass("bg-gray-400", "text-gray-700");

            $("#image").removeClass("bg-blue-500", "text-white");
            $("#image").addClass("bg-gray-400", "text-gray-700");
            $("#details").removeClass("bg-blue-500", "text-white");
            $("#details").addClass("bg-gray-400", "text-gray-700");
            $("#address").removeClass("bg-blue-500", "text-white");
            $("#address").addClass("bg-gray-400", "text-gray-700");

            $("#dataContent").removeClass("hidden");

            $("#detailsContent").addClass("hidden");
            $("#imageContent").addClass("hidden");
            $("#addressContent").addClass("hidden");
        });

        $("#address").click(function () {
            $("#address").addClass("bg-blue-500", "text-white");
            $("#address").removeClass("bg-gray-400", "text-gray-700");

            $("#details").removeClass("bg-blue-500", "text-white");
            $("#details").addClass("bg-gray-400", "text-gray-700");
            $("#data").removeClass("bg-blue-500", "text-white");
            $("#data").addClass("bg-gray-400", "text-gray-700");
            $("#image").removeClass("bg-blue-500", "text-white");
            $("#image").addClass("bg-gray-400", "text-gray-700");

            $("#addressContent").removeClass("hidden");

            $("#detailsContent").addClass("hidden");
            $("#dataContent").addClass("hidden");
            $("#imageContent").addClass("hidden");
        });

        function fetchItems() {
            $.ajax({
                url: "http://localhost:3000/includes/user.php?my=true",
                type: "get",
                success: function (result) {
                    var data = $.parseJSON(result);

                    $("#view_details").html("");

                    if (data.filename) {
                        $("#view_details").append(`<img src="/uploads/${data.filename}" alt="avatar" class="w-24 h-24 rounded-full" />`);
                        $("#img_preview").html(`<img src="/uploads/${data.filename}" alt="avatar" class="w-24 h-24 rounded-full" />`);
                    }
                    $("#view_details").append(`<p class="text-black"><strong>Id:</strong> <span>${data.id}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Username:</strong> <span>${data.username}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Name:</strong> <span>${data.firstName} ${data.lastName}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Email:</strong> <span>${data.email}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Mobile Number:</strong> <span>${data.mobileNumber}</span></p>`);
                    if (data.dob) {
                        $("#view_details").append(`<p class="text-black"><strong>DOB:</strong> <span>${data.dob}</span></p>`);
                    }
                    if (data.gender) {
                        $("#view_details").append(`<p class="text-black"><strong>Gender:</strong> <span>${data.gender}</span></p>`);
                    }
                    if (data.city) {
                        $("#view_details").append(`<p class="text-black"><strong>City:</strong> <span>${data.city}</span></p>`);
                    }
                    if (data.state) {
                        $("#view_details").append(`<p class="text-black"><strong>State:</strong> <span>${data.state}</span></p>`);
                    }
                    if (data.country) {
                        $("#view_details").append(`<p class="text-black"><strong>Country:</strong> <span>${data.country}</span></p>`);
                    }
                    if (data.zip) {
                        $("#view_details").append(`<p class="text-black"><strong>Zip:</strong> <span>${data.zip}</span></p>`);
                    }
                    if (data.addressline) {
                        $("#view_details").append(`<p class="text-black"><strong>Addressline:</strong> <span>${data.addressline}</span></p>`);
                    }
                    $("#view_details").append(`<p class="text-black" ><strong>Status:</strong> <span class="capitalize font-extrabold">${data.status}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Role:</strong> <span class="capitalize font-extrabold">${data.role}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Created At:</strong> <span>${data.createdAt}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Updated At:</strong> <span>${data.updatedAt}</span></p>`);

                    $("#firstName").val(data.firstName);
                    $("#lastName").val(data.lastName);
                    $("#username").val(data.username);
                    $("#dob").val(data.dob);
                    $("#gn").text(data.gender);
                    $("#city").val(data.city);
                    $("#state").val(data.state);
                    $("#country").val(data.country);
                    $("#zip").val(data.zip);
                    $("#addressline").val(data.addressline);
                }
            })
        }

        fetchItems()

        $("#image_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#image_form_submit").attr("disabled", true);
            $("#image_form_submit").text("Processing...");

            var formData = new FormData(this);

            $.ajax({
                url: "http://localhost:3000/includes/user.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    $("#image_form_submit").attr("disabled", false);
                    $("#image_form_submit").text("Update User Image");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#" + data.field).html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#" + data.field).html(data.msg);
                        $("#image_form")[0].reset();
                        fetchItems()
                    }
                }
            })

            e.preventDefault()
        })

        $("#data_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#data_form_submit").attr("disabled", true);
            $("#data_form_submit").text("Processing...");

            $.ajax({
                url: "http://localhost:3000/includes/user.php",
                type: "post",
                data: $("#data_form").serialize(),
                success: function (result) {
                    $("#data_form_submit").attr("disabled", false);
                    $("#data_form_submit").text("Update User Data");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#" + data.field).html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#" + data.field).html(data.msg);
                        $("#data_form")[0].reset();
                        fetchItems()
                    }
                }
            })

            e.preventDefault()
        })

        $("#address_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#address_form_submit").attr("disabled", true);
            $("#address_form_submit").text("Processing...");

            $.ajax({
                url: "http://localhost:3000/includes/user.php",
                type: "post",
                data: $("#address_form").serialize(),
                success: function (result) {
                    $("#address_form_submit").attr("disabled", false);
                    $("#address_form_submit").text("Update User Address");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#" + data.field).html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#" + data.field).html(data.msg);
                        $("#address_form")[0].reset();
                        fetchItems()
                    }
                }
            })

            e.preventDefault()
        })
    })
</script>

<?php require './includes/footer.php'; ?>