<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<?php
$userid = Session::get('userId');
$userrole = Session::get('userRole');
?>
<div class="grid_10">
   <div class="box round first grid">
    <h2>Update  Post</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $name = mysqli_real_escape_string($db->link, $_POST['name']);
     $username = mysqli_real_escape_string($db->link, $_POST['username']);
     $email = mysqli_real_escape_string($db->link, $_POST['email']);
     $details = mysqli_real_escape_string($db->link, $_POST['details']);

     if (empty($name) || empty($username) || empty($email) || empty($details)) {
        echo "<span class='failmsg'>Field must not be empty!</span>";
    }
    else{
            $query = "UPDATE users
            SET 
            name = '$name',
            username = '$username',
            email = '$email',
            details = '$details'
            WHERE id = '$userid' "; 

            $updateuser = $db->update($query);
            if ($updateuser) {
                echo "<span class='successmsg'>User data Updated Successfully!</span>";
            }else{
                echo "<span class='failmsg'>User data Not Updated!</span>";
            }    

        }
    }

?>
    <div class="block">    
       <?php
       $query = "SELECT * FROM users WHERE id = '$userid' AND role = '$userrole'";
       $userdata = $db->select($query);
       if ($userdata) {

           while ( $result= $userdata->fetch_assoc()) {
             ?>           
             <form action="" method="post" enctype="multipart/form-data">
               <table class="form">

                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['name'];?>" name="name"  class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>User Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['username'];?>" name="username"  class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['email'];?>" name="email"  class="medium" />
                    </td>
                </tr>
               
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Details</label>
                </td>
                <td>
                    <textarea value="" name="details" class="tinymce"><?php echo $result['details'];?></textarea>
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