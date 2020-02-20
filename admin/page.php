<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<style>
    .actiondel{
        margin-left: 10px;
    }
    .actiondel a{
    border: 1px solid #ddd;
    color: #444;
    cursor: pointer;
    font-size: 20px;
    padding: 2px 10px;
    font-weight: normal;
    }
</style>

<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == null) {
  header("Location: index.php");
}else{
  $pageid = $_GET['pageid'];
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Page</h2>
<?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         $pageName = mysqli_real_escape_string($db->link, $_POST['pageName']);
         $content = mysqli_real_escape_string($db->link, $_POST['content']);
         

         
         if (empty($pageName) || empty($content) ) {
            echo "<span class='failmsg'>Field must not be empty!</span>";
        }
       else{
        
        $query = "UPDATE pages
               SET 
               page_name = '$pageName',
               content = '$content'

               WHERE id = '$pageid' "; 
        $updatePage = $db->update($query);
        if ($updatePage) {
            echo "<span class='successmsg'>Page Update Successfully!</span>";
        }else{
            echo "<span class='failmsg'>Page Not Update!</span>";
        }    }}
       ?> 

    <div class="block">  
      <?php 
      $query = "SELECT * FROM pages WHERE id = '$pageid'";
                    $getpage = $db->select($query);
                    if ($getpage) {
                        while ($pageresult = $getpage->fetch_assoc()) { ?>             
       <form action="" method="post">
        <table class="form">

            <tr>
                <td>
                    <label>Edit Page</label>
                </td>
                <td>
                    <input type="text" name="pageName"  value="<?php echo $pageresult['page_name'];?>" class="medium" />
                </td>
            </tr>

            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea name="content" class="tinymce"><?php echo $pageresult['content'];?></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Update" />
                    <span class="actiondel"><a onclick="return confirm('Are you sure want to Delete?')" href="delpage.php?delpageid=<?php echo $pageresult['id'];?>">Delete</a></span>
                </td>
            </tr>
        </table>
    </form>
<?php } }?>
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