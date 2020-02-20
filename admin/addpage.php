<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Page</h2>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         $pageName = mysqli_real_escape_string($db->link, $_POST['pageName']);
         $content = mysqli_real_escape_string($db->link, $_POST['content']);
         

         
         if (empty($pageName) || empty($content) ) {
            echo "<span class='failmsg'>Field must not be empty!</span>";
        }
       else{
        
        $query = "INSERT INTO pages (page_name, content) VALUES ('$pageName','$content')";
        $insetpost = $db->insert($query);
        if ($insetpost) {
            echo "<span class='successmsg'>Page created Successfully!</span>";
        }else{
            echo "<span class='failmsg'>Page Not created!</span>";
        }    }}
       ?>
    <div class="block">               
       <form action="" method="post">
        <table class="form">

            <tr>
                <td>
                    <label>Page Name</label>
                </td>
                <td>
                    <input type="text" name="pageName" placeholder="Enter Post Title..." class="medium" />
                </td>
            </tr>

            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea name="content" class="tinymce"></textarea>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Create" />
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