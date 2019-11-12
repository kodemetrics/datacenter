  $( document ).ready(function() {
    $('.vendor').hide();
    $('#whom').change(function(){
        if($(this).val() == 'Staff'){
           $('.vendor').hide();
        }else if($(this).val() == 'Vendor'){
           $('.vendor').show();
        }else{
          $('.vendor').hide();
        }
      });
  });
