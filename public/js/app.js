$(document).ready(function () {
  $(".num_order").change(function () {
    var qty = $(this).val();
    var id = $(this).attr('data-id');
    var data = { qty: qty, id: id };
    $.ajax({
      url: 'xu-ly-gio-hang.html',
      method: "POST",
      data: data,
      dataType: 'json',
      success: function (data) {
         $("#sub-total-"+id).text(data.sub_total);
         $("#total_price span").text(data.total);
         $("#num").text(data.total_num_oder)
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    })
    return false;
  });
});