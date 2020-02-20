<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<?php

?>
<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == null) {
  header("Location: inbox.php");
}else{
  $msgid = $_GET['msgid'];
}
?>
<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {;  
        echo "<script>window.location = 'inbox.php'; </script>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View Message</h2>
   
    <div class="block">
    <?php
            $query = "SELECT * FROM contact WHERE id = '$msgid'";
                        $getcontactData = $db->select($query);
                        if ($getcontactData) {
                            while ($inbox = $getcontactData->fetch_assoc()) { ?>               
       <form action="" method="post">
        <table class="form">

            <tr>
                <td>
                    <label>Name</label>
                </td>
                <td>
                    <input readonly type="text" value="<?php echo $inbox['firstname'];?> <?php echo $inbox['lastname'];?>" class="medium" />
                </td>
            </tr>

             <tr>
                <td>
                    <label>Email</label>
                </td>
                <td>
                    <input readonly type="text" value="<?php echo $inbox['email'];?>" class="medium" />
                </td>
            </tr>

             <tr>
                <td>
                    <label>Date</label>
                </td>
                <td>
                    <input readonly type="text" value="<?php echo $fm->formatDate($inbox['date']);?>" class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Message</label>
                </td>
                <td>
                    <textarea style="margin: 0px; width: 542px; height: 172px;" readonly><?php echo $inbox['msg'];?></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Ok" />
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