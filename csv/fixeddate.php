<!DOCTYPE html>
<html>
<body>

<?php
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l")."<br>";


?>

<label for="meeting">Meeting Date : </label><input id="meeting" type="date" value="2016-12-22"/>


<p>
Depending on browser support:<br>
A date picker can pop-up when you enter the input field.
</p>

<form action="action_page.php">
  Birthday:
  <input type="date" name="bday" value="2016-12-22">
  <input type="submit">
</form>

<p><strong>Note:</strong> type="date" is not supported in Firefox, or Internet Explorer 11 and earlier versions.</p>

</body>
</html>