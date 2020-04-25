jQuery( document ).ready(function($) {

    $('.frp_post_link').click(function(e){
        e.preventDefault();
        let _this = this;
        $(_this).css("background-color", "pink");

         $.ajax({
             type: 'POST',
             url: frp_obj.url,
             data: {
                 nonce: frp_obj.nonce,
                 action: 'frp_' + $(_this).data('action'),
                 postId: frp_obj.postId
             },
             success: function(res){
                location.reload();
             },
             error: function(error){
                 console.log("error " + error);
             },
             complete: function(){                
                $(_this).css("background-color", "white");
             }
         });
     });

});