<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
        <div class="grid_10">
         <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $copyright = $fm->validation($_POST['copyright']);

     $copyright = mysqli_real_escape_string($db->link, $copyright);


     if (empty($copyright)) {
        echo "<span class='failmsg'>Field must not be empty!</span>";
    }
    else{

               $query = "UPDATE copyright
               SET 
               text = '$copyright'

               WHERE id = '1' "; 

               $updatepost = $db->update($query);
               if ($updatepost) {
                echo "<span class='successmsg'>Copyright Data Updated Successfully!</span>";
            }else{
                echo "<span class='failmsg'>Copyright Data Not Updated!</span>";
            }    }
        }
?>
                <div class="block copyblock"> 
                 <form action="" method="post">
                    <?php 
              $query = "SELECT * FROM copyright WHERE id = '1' ";
                    $copyright = $db->select($query);
                    if ($copyright) {
                        while ($result = $copyright->fetch_assoc()) {?>
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['text'];?>" name="copyright" class="large" />
                            </td>
                        </tr>
                    <?php }}?>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
     <?php include 'inc/a_footer.php'; ?>