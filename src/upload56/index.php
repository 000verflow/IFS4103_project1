
<!DOCTYPE html>
<html>
<head>
    <title>File upload</title>
    </head>
<body>
<div id="main">
    <div class="container">
        <div class="row">
            <h1>File upload</h1>
        </div>
        <div class="row">
            <p class="lead">
                Welcome to file server application.<br />
            </p>
        </div>
    </div>
</div>
<div class="container">

    <div class="row">
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Your name (Keep it secret)" required>
                <input type="file" id="fileToUpload" name="fileToUpload" required><br>
                <input type="submit" value="Upload" class="form-control btn btn-default" name="submit">
            </div>
        </form>
    </div>

    <?php
    
    if(isset($_POST["submit"])) {
        $file=basename($_FILES["fileToUpload"]["name"]);
        $name=$_POST["username"];
        $ext = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (!preg_match ("/^[a-z]+$/i",$name)) {
            echo "<p class=\"alert-danger\">Sorry, Your name can only contain letters.</p>";
        }
        else{
            $target_dir=$name."/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            if (!is_dir($target_dir) && !mkdir($target_dir)){
                die("Error creating folder $target_dir");
            }
            else{
                copy("htaccess_sample", $target_dir.".htaccess");
            }
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "<p class=\"alert-success\">The file has been uploaded here: <a href=\"$target_file\">$target_file</a>.</p>";
            } else {
                echo "<p class=\"alert-danger\">Sorry, there was an error uploading your file.</p>";
            }
        }

    }
    ?>
</body>
</html>
<!--White-list--!>
<?php
include ("../footer.php");
?>