<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<?php
if (!isset($_GET['msgid']) || $_GET['msgid'] == null) {
  header("Location: inbox.php");
}else{
  $msgid = $_GET['msgid'];
}
?>
<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $toEmail   = $fm->validation($_POST['toEmail']);
    $fromEmail = $fm->validation( $_POST['fromEmail']);
    $subject   = $fm->validation($_POST['subject']);
    $msg       = $fm->validation($_POST['msg']);
    $sendMail  = mail($toEmail, $subject, $msg, $fromEmail);
    if ($sendMail) {
        echo "<span style='color:green;'>'Message Sent Successful!'</span>";
    }else{
        echo "<span style='color:red;'>'Message Not Sent!'</span>";
    }
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
                    <label>To</label>
                </td>
                <td>
                    <input  type="text" name="toEmail" readonly value="<?php echo $inbox['email'];?>" class="medium" />
                </td>
            </tr>

             <tr>
                <td>
                    <label>From</label>
                </td>
                <td>
                    <input  type="text" name="fromEmail" class="medium" />
                </td>
            </tr>

             <tr>
                <td>
                    <label>Subject</label>
                </td>
                <td>
                    <input  type="text" name="subject" class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Message</label>
                </td>
                <td>
                    <textarea class="tinymce" name="msg" >
                        
                    </textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Send" />
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