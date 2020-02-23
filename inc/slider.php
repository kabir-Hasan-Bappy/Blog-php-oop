	<div class="slidersection templete clear">
        <div id="slider">
         <?php
        $query = "SELECT * FROM slider ORDER BY id LIMIT 3";
        $slider = $db->select($query);
        if ($slider) { 
            while ( $result = $slider->fetch_assoc()) { ?>
                  

            <a href="#"><img src="admin/<?php echo $result['slider_image']; ?>" alt="<?php echo $result['slider_title']; ?>" title="<?php echo $result['slider_title']; ?>" /></a>
		 <?php } } ?>
          
        </div>

</div>