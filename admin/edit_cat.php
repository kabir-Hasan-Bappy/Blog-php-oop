<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<?php
if (!isset($_GET['cat_edit_id']) || $_GET['cat_edit_id'] == null) {
  header("Location: catlist.php");
}else{
  $catid = $_GET['cat_edit_id'];
}
?>
        <div class="grid_10">
          <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock">
               <?php
               if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $category = $_POST['category'];
               $category = mysqli_real_escape_string($db->link, $category);
               if (empty($category)) {
                echo "<span class='failmsg'>Field must not be empty!</span>";
                  
               }else{
                $query = "UPDATE category SET c_name = '$category' WHERE id= '$catid'";
                $updatecat = $db->update($query);
                if ($updatecat) {
                    echo "<span class='successmsg'>Category Updated Successfully!</span>";
                }else{
                    echo "<span class='failmsg'>Category Not Updated!</span>";
                }
               }

               
           }
               ?> 
               <?php
               $query = "SELECT * FROM category WHERE id = '$catid' ORDER BY id DESC";
               $cat = $db->select($query);
               if ($cat) {

                 while ( $result= $cat->fetch_assoc()) {
               ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['c_name']; ?>" name="category" placeholder="Enter Category Name..." class="medium" />
                            </td>
                          <?php }}else{
                            echo "Failed!";
                          }?>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
 <?php include 'inc/a_footer.php'; ?>   