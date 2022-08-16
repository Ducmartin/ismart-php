$(document).ready(function () {
    $(".btn_check").click(function () {
      var id = $(this).attr('data-id');
      var confirm = $(this).attr('data-confirm');
      var data = {id: id ,confirm:confirm};
      $.ajax({
        url: '?mod=orders&action=confirm_order',
        method: "POST",
        data: data,
        dataType: 'json',
        success: function (data) {
          if(confirm==0){
             $("#btn_check_"+id).text('Xác nhận thành công');
          }
          if(confirm==1){
             $("#btn_check_"+id).text('Đóng hàng thành công');
          }
          if(confirm==2){
             $("#btn_check_"+id).text('Nhận hàng thành công');
          }
           $("#btn_check_"+id).attr('class','btn btn-success');
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }
      })
      return false;
    });
  });