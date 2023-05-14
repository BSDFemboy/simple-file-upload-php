<?php
if(isset($_POST["submit"])) {
	$file = $_FILES["file"];

	$file_name = basename($file["name"]);
	$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name_without_ext = pathinfo($file_name, PATHINFO_FILENAME);

	$counter = 1;
	while(file_exists("uploads/" . $file_name)) {
		$file_name = $file_name_without_ext . "_" . $counter . "." . $file_ext;
		$counter++;
	}

	$allowed_extensions = array("jpg", "jpeg", "png", "gif", "webp", "mp3", "ogg", "aac", "flac", "mp2", "gz", "xz", "tar");
	if($_FILES["file"]["error"] == UPLOAD_ERR_OK 
		&& $_FILES["file"]["size"] < 5000000 
	    && in_array($file_ext, $allowed_extensions)) {
	    move_uploaded_file($file["tmp_name"], "uploads/" . $file_name);
	    echo "File uploaded successfully.";
	} else {
	    echo "Invalid file type or size.";
	}
}
?>

<html>
  <head>
    <title>Upload File</title>
  </head>
  <body>
    <form method="post" enctype="multipart/form-data">
      <label for="file">Select file to upload:</label>
      <input type="file" name="file" id="file" required><br>
      <input type="submit" name="submit" value="Upload">
    </form>
  </body>
</html>
