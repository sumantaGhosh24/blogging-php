// go top button section
var topButton = document.getElementById("topButton");

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    topButton.style.display = "block";
  } else {
    topButton.style.display = "none";
  }
}

topButton.onclick = function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};

// backend
$(document).ready(function () {
  // register user
  $("#register-form").on("submit", function (e) {
    if ($("#register-form")[0].checkValidity()) {
      e.preventDefault();
      let formData = new FormData(this);
      $("#register-err").text("");
      $("#register-btn").text("Please wait...");
      $.ajax({
        url: "includes/action.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          $("#register-btn").text("Signup");
          if (response == "register") {
            window.location = "login.php";
          } else {
            $("#register-err").html(response);
          }
        },
      });
    } else {
      $("#register-err").text(
        "* something went wrong, please fill all fields with valid information."
      );
    }
  });

  // login user
  $("#login-btn").click(function (e) {
    if ($("#login-form")[0].checkValidity()) {
      e.preventDefault();
      $("#login-err").text("");
      $("#login-btn").text("Please wait...");
      $.ajax({
        url: "includes/action.php",
        method: "post",
        data: $("#login-form").serialize() + "&action=login",
        success: function (response) {
          $("#login-btn").text("Login");
          if (response === "login") {
            window.location = "index.php";
          } else {
            $("#login-err").html(response);
          }
        },
      });
    } else {
      $("#login-err").text(
        "* something went wrong, please fill all fields with valid information."
      );
    }
  });

  // manage categories
  manageCategory();
  function manageCategory() {
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {action: "manage_category"},
      success: function (response) {
        $("#manage-category").html(response);
      },
    });
  }

  // add category
  $("#add-category-btn").click(function (e) {
    if ($("#add-category-form")[0].checkValidity()) {
      e.preventDefault();
      $("#add-category-err").text("");
      $("#add-category-btn").text("Please wait...");
      $.ajax({
        url: "includes/process.php",
        method: "post",
        data: $("#add-category-form").serialize() + "&action=add_category",
        success: function (response) {
          $("#add-category-btn").text("Add Category");
          $("#add-category-form")[0].reset();
          $(".btn-close").click();
          manageCategory();
        },
      });
    } else {
      $("#add-category-err").text(
        "* something went wrong, please fill all fields with valid information."
      );
    }
  });

  // view category
  $("body").on("click", ".viewCategory", function (e) {
    e.preventDefault();
    get_category = $(this).attr("id");
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {get_category: get_category},
      success: function (response) {
        data = JSON.parse(response);
        $("#viewName").html(data.name);
        $("#viewDescription").html(data.description);
      },
    });
  });

  // edit category
  $("body").on("click", ".editCategory", function (e) {
    e.preventDefault();
    edit_category = $(this).attr("id");
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {edit_category: edit_category},
      success: function (response) {
        data = JSON.parse(response);
        $("#cid").val(data.id);
        $("#uname").val(data.name);
        $("#udescription").val(data.description);
      },
    });
  });

  // update category
  $("#update-category-btn").click(function (e) {
    if ($("#update-category-form")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "includes/process.php",
        method: "post",
        data:
          $("#update-category-form").serialize() + "&action=update_category",
        success: function (response) {
          manageCategory();
        },
      });
    }
  });

  // delete category
  $("body").on("click", ".deleteCategory", function (e) {
    e.preventDefault();
    del_category = $(this).attr("id");
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {del_category: del_category},
      success: function (response) {
        alert("category deleted");
        manageCategory();
      },
    });
  });

  // manage blogs
  manageBlog();
  function manageBlog() {
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {action: "manage_blog"},
      success: function (response) {
        $("#manage-blog").html(response);
      },
    });
  }

  // show category in form
  viewCategory();
  function viewCategory() {
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {view_category: "view_category"},
      success: function (response) {
        $("#category").html(response);
      },
    });
  }

  // add blog
  $("#add-blog-form").on("submit", function (e) {
    if ($("#add-blog-form")[0].checkValidity()) {
      e.preventDefault();
      let formData = new FormData(this);
      $("#add-blog-err").text("");
      $("#add-blog-btn").text("Please wait...");
      $.ajax({
        url: "includes/process.php",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == "created") {
            $("#add-blog-btn").text("Create Blog");
            $("#add-blog-form")[0].reset();
            $(".btn-close").click();
            manageBlog();
          } else {
            $("#add-blog-btn").text("Create Blog");
            $("#add-blog-err").html(response);
          }
        },
      });
    } else {
      $("#add-blog-err").text(
        "* something went wrong, please fill all fields with valid information."
      );
    }
  });

  // view blog
  $("body").on("click", ".viewBlog", function (e) {
    e.preventDefault();
    get_blog = $(this).attr("id");
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {get_blog: get_blog},
      success: function (response) {
        data = JSON.parse(response);
        $("#viewTitle").text(data.title);
        $("#viewDescription").text(data.description);
        $("#viewContent").text(data.content);
        $("#viewImg").attr("src", `./uploads/${data.image}`);
      },
    });
  });

  // edit blog
  $("body").on("click", ".editBlog", function (e) {
    e.preventDefault();
    edit_blog = $(this).attr("id");
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {edit_blog: edit_blog},
      success: function (response) {
        data = JSON.parse(response);
        $("#cid").val(data.id);
        $("#utitle").val(data.title);
        $("#udescription").val(data.description);
        $("#ucontent").val(data.content);
      },
    });
  });

  // update blog
  $("#update-blog-btn").click(function (e) {
    if ($("#update-blog-form")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "includes/process.php",
        method: "post",
        data: $("#update-blog-form").serialize() + "&action=update_blog",
        success: function (response) {
          manageBlog();
        },
      });
    }
  });

  // delete blog
  $("body").on("click", ".deleteBlog", function (e) {
    e.preventDefault();
    del_blog = $(this).attr("id");
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {del_blog: del_blog},
      success: function (response) {
        alert("blog deleted");
        manageBlog();
      },
    });
  });

  // get users
  manageUser();
  function manageUser() {
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {action: "manage_user"},
      success: function (response) {
        $("#manage-user").html(response);
      },
    });
  }

  // view user
  $("body").on("click", ".viewUser", function (e) {
    e.preventDefault();
    get_user = $(this).attr("id");
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {get_user: get_user},
      success: function (response) {
        data = JSON.parse(response);
        $("#viewFullname").text(data.fullname);
        $("#viewUsername").text(data.username);
        $("#viewEmail").text(data.email);
        $("#viewUsertype").text(data.usertype);
        $("#viewImg").attr("src", `./uploads/${data.image}`);
      },
    });
  });

  // show category in home page
  viewCategory();
  function viewCategory() {
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {public_category: "public_category"},
      success: function (response) {
        $("#public-category").html(response);
      },
    });
  }

  // show blog in home page
  viewBlogOnHome();
  function viewBlogOnHome() {
    $.ajax({
      url: "includes/process.php",
      method: "post",
      data: {public_blog: "public_blog"},
      success: function (response) {
        $("#blog-home").html(response);
      },
    });
  }

  // search blog
  $("#search-btn").click(function (e) {
    if ($("#search-form")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "includes/process.php",
        method: "post",
        data: $("#search-form").serialize() + "&action=search_blog",
        success: function (response) {
          $("#search-container").html(response);
        },
      });
    }
  });
});
