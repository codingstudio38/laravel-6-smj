
<form action="{{url('/')}}/Update_contractdetails" method="post">
{!! csrf_field() !!} 
  <label for="fname">First name:</label><br>
  <input type="text" name="fname"><br>
  <input type="submit" value="Submit">
</form> 