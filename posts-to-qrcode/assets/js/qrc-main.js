;(function($){
    $(document).ready(function(){

        $('#toggle1').minitoggle();
        $('#toggle1').on("toggle", function(e){
            if(e.isActive)
                $('#qrc_toggle').val(1);
            else
                $('#qrc_toggle').val(0);
        });
    });
})(jQuery);