<?php include 'inc/a_header.php'; ?>
<?php include 'inc/a_sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Slider List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th width="20%">Sl No.</th>
                            <th width="30%">Title</th>
                            <th width="30%">Image</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
        $query = "SELECT * FROM slider";
        $slider = $db->select($query);
        if ($slider) { 
            $i=0;
            while ( $result = $slider->fetch_assoc()) {
                $i++;
             ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i;?></td>
                            <td><?php echo $result['slider_title'];?></td>
                            <td><img src="<?php echo $result['slider_image'];?>" alt="" height="40px" width="60px"></td>
                            <td>
                                <?php if (Session::get('userRole') == '0') { ?>
                                <a href="editSlider.php?edit_slider_id=<?php echo $result['id'];?>">Edit</a> || 
                                <a onclick= "return confirm('Are u sure to Delete?')" href="delSlider.php?del_slider_id=<?php echo $result['id'];?>">Delete</a>

                                <?php } ?>
                            </td>
                        </tr>
                    <?php }}?>
                    </tbody>
                </table>
    
               </div>
            </div>
        </div>
         <?php include 'inc/a_footer.php'; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
            setSidebarHeight();
        });
    </script>
    