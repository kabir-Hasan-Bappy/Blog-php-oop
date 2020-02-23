<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<?php

if (!isset($_GET['edit_slider_id']) || $_GET['edit_slider_id'] == null) {
  header("Location: sliderlist.php");
}else{
  $edit_slider_id = $_GET['edit_slider_id'];
}
?>
<div class="grid_10">
   <div class="box round first grid">
    <h2>Edit Slider</h2>

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

     if (empty($title)) {
        echo "<span class='failmsg'>Field must not be empty!</span>";
    }
    else{



        if (!empty($file_name)) {

           if ($file_size >1048567) {
               echo "<span class='error'>Image Size should be less then 1MB!
               </span>";
           } elseif (in_array($file_ext, $permited) === false) {
               echo "<span class='error'>You can upload only:-"
               .implode(', ', $permited)."</span>";
           } else{

               move_uploaded_file($file_temp, $uploaded_image);

               $query = "UPDATE slider
               SET 
               slider_title = '$title',
               slider_image = '$uploaded_image'
               WHERE id = '$edit_slider_id' "; 

               $updateslider = $db->update($query);
               if ($updateslider) {
                echo "<span class='successmsg'>Slider Updated Successfully!</span>";
            }else{
                echo "<span class='failmsg'>Slider Not Updated!</span>";
            }    }
        }else{
            $query = "UPDATE slider
            SET 
            slider_title = '$title'
            WHERE id = '$edit_slider_id' "; 

            $updatepost = $db->update($query);
            if ($updatepost) {
                echo "<span class='successmsg'>Slider Updated Successfully!</span>";
            }else{
                echo "<span class='failmsg'>Slider Not Updated!</span>";
            }    }

        }
    }

?>
    <div class="block">    
       <?php
       $query = "SELECT * FROM slider WHERE id = '$edit_slider_id' ORDER BY id DESC";
       $slider = $db->select($query);
       if ($slider) {

           while ( $sliders= $slider->fetch_assoc()) {
             ?>           
             <form action="" method="post" enctype="multipart/form-data">
               <table class="form">

                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $sliders['slider_title'];?>" name="title"  class="medium" />
                    </td>
                </tr>
             <tr>
                <td>
                    <label>Upload Image</label>
                </td>
                <td>
                    <img src="<?php echo $sliders['slider_image'];?>" alt="" height="100px" width="200px"><br>
                    <input type="file" name="image" />
                </td>
            </tr>
            
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Update" />
                </td>

            </tr>
        </table>
    </form>
<?php }}?>
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