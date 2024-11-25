// Sweet Alert JS
$(function () {
  $(document).on("click", "#delete", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: "Are you sure?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire("Deleted!", "Your data has been deleted.", "success");
      }
    });
  });
});

$(function () {
  $(document).on("click", "#ApproveBtn", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");

    Swal.fire({
      title: "Are you sure?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, approve it!",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link;
        Swal.fire("Approved!", "Your data has been approved.", "success");
      }
    });
  });
});

// Add Purchase
$(document).ready(function () {
  $(document).on("click", ".addeventmore", function () {
    var date = $("#date").val();
    var purchase_no = $("#purchase_no").val();
    var supplier_id = $("#supplier_id").val();
    var category_id = $("#category_id").val();
    var category_name = $("#category_id").find("option:selected").text();
    var product_id = $("#product_id").val();
    var product_name = $("#product_id").find("option:selected").text();
    if (date == "") {
      $.notify("Date is Required", {
        globalPosition: "top right",
        className: "error",
      });
      return false;
    }
    if (purchase_no == "") {
      $.notify("Purchase No is Required", {
        globalPosition: "top right",
        className: "error",
      });
      return false;
    }
    if (supplier_id == "") {
      $.notify("Supplier is Required", {
        globalPosition: "top right",
        className: "error",
      });
      return false;
    }
    if (category_id == "") {
      $.notify("Category is Required", {
        globalPosition: "top right",
        className: "error",
      });
      return false;
    }
    if (product_id == "") {
      $.notify("Product Field is Required", {
        globalPosition: "top right",
        className: "error",
      });
      return false;
    }
    var source = $("#document-template").html();
    var tamplate = Handlebars.compile(source);
    var data = {
      date: date,
      purchase_no: purchase_no,
      supplier_id: supplier_id,
      category_id: category_id,
      category_name: category_name,
      product_id: product_id,
      product_name: product_name,
    };
    var html = tamplate(data);
    $("#addRow").append(html);
  });
  $(document).on("click", ".removeeventmore", function (event) {
    $(this).closest(".delete_add_more_item").remove();
    totalAmountPrice();
  });
  $(document).on("keyup click", ".unit_price,.buying_qty", function () {
    var unit_price = $(this).closest("tr").find("input.unit_price").val();
    var qty = $(this).closest("tr").find("input.buying_qty").val();
    var total = unit_price * qty;
    $(this).closest("tr").find("input.buying_price").val(total);
    totalAmountPrice();
  });
  // Calculate sum of amout in invoice
  function totalAmountPrice() {
    var sum = 0;
    $(".buying_price").each(function () {
      var value = $(this).val();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    $("#estimated_amount").val(sum);
  }
});

$(function () {
  $(document).on("change", "#supplier_id", function () {
    var supplier_id = $(this).val();
    $.ajax({
      url: "/get-category",
      type: "GET",
      data: {
        supplier_id: supplier_id,
      },
      dataType: "json",
      success: function (data) {
        var html = '<option value="">Select category</option>';
        if (data && Array.isArray(data)) {
          $.each(data, function (key, value) {
            html +=
              '<option value=" ' +
              value.category_id +
              ' "> ' +
              value.name +
              "</option>";
          });
        } else {
          console.log("Data is not array", data);
        }
        $("#category_id").html(html);
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: " + error);
      },
    });
  });
});

$(function () {
  $(document).on("change", "#category_id", function () {
    var category_id = $(this).val();
    $.ajax({
      url: "/get-product",
      type: "GET",
      data: {
        category_id: category_id,
      },
      dataType: "json",
      success: function (data) {
        var html = '<option value="">Select product</option>';
        if (data && Array.isArray(data)) {
          $.each(data, function (key, value) {
            html +=
              '<option value=" ' + value.id + ' "> ' + value.name + "</option>";
          });
        } else {
          console.log("Data is not array", data);
        }
        $("#product_id").html(html);
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: " + error);
      },
    });
  });
});

// Add invoice
$(document).ready(function () {
  $(document).on("click", ".addeventmore", function () {
    var date = $("#date").val();
    var invoice_no = $("#invoice_no").val();
    var category_id = $("#category_id").val();
    var category_name = $("#category_id").find("option:selected").text();
    var product_id = $("#product_id").val();
    var product_name = $("#product_id").find("option:selected").text();
    if (date == "") {
      $.notify("Date is Required", {
        globalPosition: "top right",
        className: "error",
      });
      return false;
    }
    if (category_id == "") {
      $.notify("Category is Required", {
        globalPosition: "top right",
        className: "error",
      });
      return false;
    }
    if (product_id == "") {
      $.notify("Product Field is Required", {
        globalPosition: "top right",
        className: "error",
      });
      return false;
    }
    var source = $("#document-template").html();
    var tamplate = Handlebars.compile(source);
    var data = {
      date: date,
      invoice_no: invoice_no,
      category_id: category_id,
      category_name: category_name,
      product_id: product_id,
      product_name: product_name,
    };
    var html = tamplate(data);
    $("#addRow").append(html);
  });
  $(document).on("click", ".removeeventmore", function (event) {
    $(this).closest(".delete_add_more_item").remove();
    totalAmountPrice();
  });
  $(document).on("keyup click", ".unit_price,.selling_qty", function () {
    var unit_price = $(this).closest("tr").find("input.unit_price").val();
    var qty = $(this).closest("tr").find("input.selling_qty").val();
    var total = unit_price * qty;
    $(this).closest("tr").find("input.selling_price").val(total);
    $("#discount_amount").trigger("keyup");
  });
  $(document).on("keyup", "#discount_amount", function () {
    totalAmountPrice();
  });

  // Calculate sum of amout in invoice
  function totalAmountPrice() {
    var sum = 0;
    $(".selling_price").each(function () {
      var value = $(this).val();
      if (!isNaN(value) && value.length != 0) {
        sum += parseFloat(value);
      }
    });
    var discount_amount = parseFloat($("#discount_amount").val());
    if (!isNaN(discount_amount) && discount_amount.length != 0) {
      sum -= parseFloat(discount_amount);
    }
    $("#estimated_amount").val(sum);
  }
});

$(function () {
  $(document).on("change", "#product_id", function () {
    var product_id = $(this).val();
    $.ajax({
      url: "/check-product",
      type: "GET",
      dataType: "json",
      data: {
        product_id: product_id,
      },
      success: function (data) {
        if (data.error) {
          console.error("Error: ", data.error);
          alert(data.error);
        } else if (data.stock !== undefined) {
          $("#current_stock_qty").val(data.stock);
        } else {
          console.error("Unexpected response format: ", data);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error: ", xhr.responseText);
      },
    });
  });
});

$(document).on("change", "#paid_status", function () {
  var paid_status = $(this).val();
  if (paid_status == "partial_paid") {
    $(".paid_amount").show();
  } else {
    $(".paid_amount").hide();
  }
});

$(document).on("change", "#customer_id", function () {
  var customer_id = $(this).val();
  if (customer_id == "0") {
    $(".new_customer").show();
  } else {
    $(".new_customer").hide();
  }
});
