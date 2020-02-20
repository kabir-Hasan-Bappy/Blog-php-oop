<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Post</h2>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         $title = mysqli_real_escape_string($db->link, $_POST['title']);
         $category = mysqli_real_escape_string($db->link, $_POST['category']);
         $body = mysqli_real_escape_string($db->link, $_POST['body']);
         $author = mysqli_real_escape_string($db->link, $_POST['author']);
         $tag = mysqli_real_escape_string($db->link, $_POST['tags']);
         $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

         $permited  = array('jpg', 'jpeg', 'png', 'gif');
         $file_name = $_FILES['image']['name'];
         $file_size = $_FILES['image']['size'];
         $file_temp = $_FILES['image']['tmp_name'];

         $div = explode('.', $file_name);
         $file_ext = strtolower(end($div));
         $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
         $uploaded_image = "upload/img/".$unique_image;

         if (empty($title) || empty($category) || empty($body) || empty($author) ||empty($tag) || empty($uploaded_image)) {
            echo "<span class='failmsg'>Field must not be empty!</span>";
        }elseif ($file_size >1048567) {
           echo "<span class='error'>Image Size should be less then 1MB!
           </span>";
       } elseif (in_array($file_ext, $permited) === false) {
           echo "<span class='error'>You can upload only:-"
           .implode(', ', $permited)."</span>";
       } else{
        move_uploaded_file($file_temp, $uploaded_image);

        $query = "INSERT INTO post (cat, title, body, image, author, tags, userid) VALUES ('$category','$title','$body','$uploaded_image','$author','$tag', '$userid')";
        $insetpost = $db->insert($query);
        if ($insetpost) {
            echo "<span class='successmsg'>Post Inserted Successfully!</span>";
        }else{
            echo "<span class='failmsg'>Category Not Inserted!</span>";
        }    }
    }
    ?>
    <div class="block">               
       <form action="" method="post" enctype="multipart/form-data">
        <table class="form">

            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>

            <tr>
                <td>
                    <label>Category</label>
                </td>

                <td>
                    <select id="select" name="category">
                        <option value="">Select Category</option>
                        <?php
                        $query = "SELECT * FROM category";
                        $select = $db->select($query);
                        if ($select) {
                          while ( $result = $select->fetch_assoc()) {?>
                            <option style="color:black;" value="<?php echo $result['id'];?>"><?php echo $result['c_name'];?></option>
                        <?php }} ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Upload Image</label>
                </td>
                <td>
                    <input type="file" name="image" />
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea name="body" class="tinymce"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Author</label>
                </td>
                <td>
                    <input name="author" type="text"  value="<?php echo Session::get('name');?>" class="medium" />
                    <input name="userid" type="hidden"  value="<?php echo Session::get('userId');?>" class="medium" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Tags</label>
                </td>
                <td>
                    <input name="tags" type="text"  placeholder="Enter Tags..." class="medium" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
    </form>
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