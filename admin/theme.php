<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
?>
        <div class="grid_10">
          <div class="box round first grid">
                <h2>Select Theme</h2>
               <div class="block copyblock">
               <?php
               if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               $theme = mysqli_real_escape_string($db->link, $_POST['theme']);
              
                $query = "UPDATE theme SET theme_name = '$theme' WHERE id= '1'";
                $updatetheme = $db->update($query);
                if ($updatetheme) {
                    echo "<span class='successmsg'>Theme Updated Successfully!</span>";
                }else{
                    echo "<span class='failmsg'>Theme Not Updated!</span>";
                }
               

               
           }
               ?> 
               <?php 
               $query = "SELECT * FROM theme WHERE id = '1'";
               $theme = $db->select($query);
               while ( $result= $theme->fetch_assoc()) { 
               ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input <?php if ($result['theme_name'] == 'default') { echo "checked";} ?> type="radio" name="theme" value="default">Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if ($result['theme_name'] == 'green') { echo "checked";} ?> type="radio" name="theme" value="green">Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input <?php if ($result['theme_name'] == 'red') { echo "checked";} ?> type="radio" name="theme" value="red">Red
                            </td>
                        </tr>
						            <tr> 
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }?>
                </div>
            </div>
        </div>
 <?php include 'inc/a_footer.php'; ?>   