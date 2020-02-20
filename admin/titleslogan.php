<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<style>
    .leftside{
    float: left;
    width: 70%;
    }
    .rightside{
     float: left;
    width: 20%;
    }
    .rightside img{
    height: 160px;
    width: 170px;
    }
</style>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>

   <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $title = $fm->validation($_POST['title']);
     $slogan = $fm->validation($_POST['slogan']);
     $title = mysqli_real_escape_string($db->link, $title);
     $slogan = mysqli_real_escape_string($db->link, $slogan);

     $permited  = array('png');
     $file_name = $_FILES['logo']['name'];
     $file_size = $_FILES['logo']['size'];
     $file_temp = $_FILES['logo']['tmp_name'];

     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $same_image = 'logo'.'.'.$file_ext;
     $uploaded_logo = "upload/logo/".$same_image;

     if (empty($title) || empty($slogan)) {
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

               move_uploaded_file($file_temp, $uploaded_logo);

               $query = "UPDATE title_slogan
               SET 
               title = '$title',
               slogan = '$slogan',
               logo = '$uploaded_logo'

               WHERE id = '1' "; 

               $updatepost = $db->update($query);
               if ($updatepost) {
                echo "<span class='successmsg'>Data Updated Successfully!</span>";
            }else{
                echo "<span class='failmsg'>Data Not Updated!</span>";
            }    }
        }else{
            $query = "UPDATE title_slogan
               SET 
               title = '$title',
               slogan = '$slogan'
               WHERE id = '1' "; 

            $updatepost = $db->update($query);
            if ($updatepost) {
                echo "<span class='successmsg'>Data Updated Successfully!</span>";
            }else{
                echo "<span class='failmsg'>Data Not Updated!</span>";
            }    }

        }
    }

?>

                <?php

                    $query = "SELECT * FROM title_slogan WHERE id = '1'";
                    $logo = $db->select($query);
                    if ($logo) {
                        while ($result = $logo->fetch_assoc()) {  ?>
                <div class="block sloginblock">
                    

                <div class="leftside">          
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                            </td>
                        </tr>
						 
                         <tr>
                            <td>
                                <label>Website Logo</label>
                            </td>
                            <td>
                                <input type="file"  name="logo" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    </div> 
                
                    <div class="rightside">
                        <img src="<?php echo $result['logo']; ?>" alt="">
                    </div>   
                </div>
            <?php }} ?>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php include 'inc/a_footer.php'; ?>