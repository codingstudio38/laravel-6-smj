<!DOCTYPE html>
<html>
 <head>
  <title>Ajax Autocomplete Textbox in Laravel using JQuery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Ajax Autocomplete Textbox</h3><br />
   
   <div class="form-group">
    <input type="text" name="board_name_ajax" id="board_name_ajax" class="form-control input-lg" placeholder="Enter board Name" />
    <div id="boardList">
    </div>
   </div>
   {{ csrf_field() }}
  </div>
 </body>
</html>

<script>
$(document).ready(function(){

 $('#board_name_ajax').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.fetch') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#boardList').fadeIn();  
                    $('#boardList').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        $('#board_name_ajax').val($(this).text());  
        $('#boardList').fadeOut();  
    });  

});
</script>
