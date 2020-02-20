<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<?php
if (!isset($_GET['viewuserid']) || $_GET['viewuserid'] == null) {
  header("Location: userlist.php");
}else{
  $viewuserid = $_GET['viewuserid'];
}
?>

<div class="grid_10">
   <div class="box round first grid">
    <h2>User Details</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     echo "<script>window.location = 'userlist.php'</script>";
    }

?>
    <div class="block">    
       <?php
       $query = "SELECT * FROM users WHERE id = '$viewuserid'";
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
                        <input readonly type="text" value="<?php echo $result['name'];?>" name="name"  class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>User Name</label>
                    </td>
                    <td>
                        <input readonly type="text" value="<?php echo $result['username'];?>" name="username"  class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input readonly type="text" value="<?php echo $result['email'];?>" name="email"  class="medium" />
                    </td>
                </tr>
               
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Details</label>
                </td>
                <td>
                    <textarea readonly value="" name="details" class="tinymce"><?php echo $result['details'];?></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="OK" />
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
        