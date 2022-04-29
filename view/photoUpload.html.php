
<?php

require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php';

 
?>
<form action="" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>

<?php

require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php";
?>