jQuery( document ).ready(function($) {  

  $('.frp_fav_del').click(function(e){
    let postId =  $(this).data('post');  
    let _this = this;
    $(_this).parent().parent().css("background-color", "pink");

    $.ajax({
        type: 'POST',
        url: frp_admin_obj.url,
        data: {
            nonce: frp_admin_obj.nonce,
            action: 'frp_del',
            postId: postId
        },
        success: function(res){
           location.reload();
        },
        error: function(error){
            console.log("error " + error);
        },
        complete: function(){                
           $(_this).parent().parent().css("background-color", "white");
        }
    });

    return false;
  });

  $('#frp_clear_list').click(function(e){    

    $.ajax({
        type: 'POST',
        url: frp_admin_obj.url,
        data: {
            nonce: frp_admin_obj.nonce,
            action: 'frp_del_all'
        },
        success: function(res){
          location.reload();
        },
        error: function(error){
            console.log("error " + error);
        }
    });

  });

});