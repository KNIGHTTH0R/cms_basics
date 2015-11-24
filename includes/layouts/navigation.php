
    <ul class="subjects">
      <?php //query
       $menu_result = find_all_menuitems();
        ?> 
        <?php
        while($menu_item = mysqli_fetch_assoc($menu_result)) {
            ?>
          
           <?php 
           echo "<li"; 
           if($menu_item["menu_id"] == $selected_subject_id) {
              echo " class=\"selected\"";
            }
           echo ">" ; 
           ?>
          <a href="manage_content.php?menu=<?php echo urlencode($menu_item['menu_id']); ?>"><?php echo $menu_item['menu_name'] ;?></a>
          <?php
            $page_set = find_sub_menus($menu_item["menu_id"]);    
            ?> 

          <ul class="pages" >
            <?php
              
              while($page = mysqli_fetch_assoc($page_set)) {
              ?>
                <?php 
                 echo "<li"; 
                 if($page["id"] ==  $selected_page_id) {
                    echo " class=\"selected\"";
                  }
                 echo ">" ; 
                 ?>
                <a href="manage_content.php?page=<?php echo urlencode($page["id"]);?>">
                 <?php echo $page['menu_name']; ?></a>
                </li>  
              <?php 
                }
                ?>
                <?php mysqli_free_result($_GET["menu"],$_GET["page"]); ?>
           </ul>
         </li>
      <?php
          }
        ?>

        
         <?php mysqli_free_result($menu_result); ?>
         
     </ul>    
   