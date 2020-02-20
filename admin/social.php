<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Social Media</h2>
                 <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $fb = $fm->validation($_POST['facebook']);
     $tw = $fm->validation($_POST['twitter']);
     $ln = $fm->validation($_POST['linkedin']);
     $gp = $fm->validation($_POST['googleplus']);

     $fb = mysqli_real_escape_string($db->link, $fb);
     $tw = mysqli_real_escape_string($db->link, $tw);
     $ln = mysqli_real_escape_string($db->link, $ln);
     $gp = mysqli_real_escape_string($db->link, $gp);


     if (empty($fb) || empty($tw) || empty($ln) || empty($gp)) {
        echo "<span class='failmsg'>Field must not be empty!</span>";
    }
    else{

               $query = "UPDATE social
               SET 
               fb = '$fb',
               tw = '$tw',
               ln = '$ln',
               gp = '$gp'

               WHERE id = '1' "; 

               $updatepost = $db->update($query);
               if ($updatepost) {
                echo "<span class='successmsg'>Social Data Updated Successfully!</span>";
            }else{
                echo "<span class='failmsg'>Social Data Not Updated!</span>";
            }    }
        }
?>
                <div class="block">               
                 <form action="" method="post">
                    <?php 
                    $query = "SELECT * FROM social WHERE id = '1' ";
                    $socialData = $db->select($query);
                    if ($socialData) {
                        while ($result = $socialData->fetch_assoc()) {?>
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $result['fb'];?>"  class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['tw'];?>" name="twitter" class="medium" />
                            </td>
                        </tr>
						 
						 <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['ln'];?>" name="linkedin" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['gp'];?>" name="googleplus" class="medium" />
                            </td>
                        </tr>
						
						 <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                <?php }}?>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
   <?php include 'inc/a_footer.php'; ?>