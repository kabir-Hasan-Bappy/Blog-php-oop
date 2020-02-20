<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>

<?php

if (!isset($_GET['viewpostid']) || $_GET['viewpostid'] == null) {
  header("Location: postlist.php");
}else{
  $viewpostid = $_GET['viewpostid'];
}
?>
<div class="grid_10">
   <div class="box round first grid">
    <h2>View Post</h2>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'postlist.php'</script>";
    }

?>
    <div class="block">    
       <?php
       $query = "SELECT * FROM post WHERE id = '$viewpostid' ORDER BY id DESC";
       $post = $db->select($query);
       if ($post) {

           while ( $postresult= $post->fetch_assoc()) {
             ?>           
             <form action="" method="post" enctype="multipart/form-data">
               <table class="form">

                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $postresult['title'];?>" readonly placeholder="Enter Post Title..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Category</label>
                    </td>

                    <td>
                        <select id="select" readonly>
                            <option>Select Category</option>
                            <?php
                            $query = "SELECT * FROM category";
                            $select = $db->select($query);
                            if ($select) {
                              while ( $result = $select->fetch_assoc()) {?>
                                <option

                                <?php
                                if ($postresult['cat']== $result['id']) {?>
                                 selected = "selected";
                             <?php } ?> 

                             style="color:black;" value="<?php echo $result['id'];?>"><?php echo $result['c_name'];?></option>
                         <?php }}?>
                     </select>

                 </td>

             </tr>
             <tr>
                <td>
                    <label>Image</label>
                </td>
                <td>
                    <img src="<?php echo $postresult['image'];?>" alt="" height="80px" width="200px"><br>
                    
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce" readonly=""><?php echo $postresult['body'];?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Author</label>
                </td>
                <td>
                    <input value="<?php echo $postresult['author'];?>" readonly type="text"  placeholder="Enter Author Name..." class="medium" />
                    <input name="userid" type="hidden"  value="<?php echo Session::get('userId');?>" class="medium" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Tags</label>
                </td>
                <td>
                    <input value="<?php echo $postresult['tags'];?>" readonly type="text"  class="medium" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Back" />
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