<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Slider</h2>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $title = mysqli_real_escape_string($db->link, $_POST['title']);
         $permited  = array('jpg', 'jpeg', 'png', 'gif');
         $file_name = $_FILES['image']['name'];
         $file_size = $_FILES['image']['size'];
         $file_temp = $_FILES['image']['tmp_name'];

         $div = explode('.', $file_name);
         $file_ext = strtolower(end($div));
         $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
         $uploaded_image = "upload/slider_image/".$unique_image;

         if (empty($title) || empty($file_name)) {
            echo "<span class='failmsg'>Field must not be empty!</span>";
        }elseif ($file_size >1048567) {
           echo "<span class='error'>Image Size should be less then 1MB!
           </span>";
       } elseif (in_array($file_ext, $permited) === false) {
           echo "<span class='error'>You can upload only:-"
           .implode(', ', $permited)."</span>";
       } else{
        move_uploaded_file($file_temp, $uploaded_image);

        $query = "INSERT INTO slider (slider_title, slider_image) VALUES ('$title', '$uploaded_image')";
        $insetSlider = $db->insert($query);
        if ($insetSlider) {
            echo "<span class='successmsg'>Slider Image Uploaded Successfully!</span>";
        }else{
            echo "<span class='failmsg'>Slider Image Not Uploaded!</span>";
        }    }
    }
    ?>
    <div class="block">               
       <form action="" method="post" enctype="multipart/form-data">
        <table class="form">

            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Upload Image</label>
                </td>
                <td>
                    <input type="file" name="image" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Upload" />
                </td>
            </tr>
        </table>
    </form>
</div>
</div>
</div>
<?php include 'inc/a_footer.php'; ?>

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>