<?php   

	 function confirm_query($result_set) {
	   	if (!$result_set) {
     	 die("Database query failed.");

		    }
		  }

  	function find_all_menuitems(){
  		global $connection;
  		$query  = "SELECT *" ;
        $query .= " FROM menu ";
        //$query .= "WHERE visible = 1 ";
        $query .= "ORDER BY position ASC ";
        $menu_result = mysqli_query($connection, $query);
        confirm_query($menu_result);
        return  $menu_result;
    	}
      function find_all_pages(){
      global $connection;
      $query  = "SELECT *" ;
        $query .= " FROM pages ";
        //$query .= "WHERE visible = 1 ";
        $query .= "ORDER BY position ASC ";
        $pages_result = mysqli_query($connection, $query);
        confirm_query($pages_result);
        return  $pages_result;
      }

    function find_sub_menus($menu_id){
    	
        global $connection;
        $safe_subject_id = mysqli_real_escape_string($connection,$menu_id);

        
    	   $query  = "SELECT * " ;
        $query .= " FROM pages ";
        $query .= "WHERE visible = 1 ";
        $query .= " AND menu_id = {$safe_subject_id} ";
        $query .= "ORDER BY position ASC ";
        $page_set = mysqli_query($connection, $query);
        confirm_query($page_set);
        return $page_set;
        

          }

    function find_subject_by_id($subject_id){
        global $connection;
        //$safesubject es una medida para evitar mysql injection.
        $safe_subject_id = mysqli_real_escape_string($connection,$subject_id);      
        $query  = "SELECT *" ;
        $query .= " FROM menu ";
        $query .= "WHERE menu_id = {$safe_subject_id} ";
        $query .= "LIMIT 1 ";
        $menu_result = mysqli_query($connection, $query);
        confirm_query($menu_result);

        if($item = mysqli_fetch_assoc($menu_result)) {
        return  $item;
        }else { return null;}

       }

    function find_page_by_id($page_id){
        global $connection;
        //$safesubject es una medida para evitar mysql injection.
        $safe_page_id = mysqli_real_escape_string($connection,$page_id);      
        $query  = "SELECT *" ;
        $query .= " FROM pages ";
        $query .= "WHERE id = {$safe_page_id} ";
        $query .= "LIMIT 1 ";
        $page_result = mysqli_query($connection, $query);
        confirm_query($page_result);

        if($item = mysqli_fetch_assoc($page_result)) {
        return  $item;
        }else { return null;}

      }



    function find_selected_page() {
        global $current_subject;
        global $current_page;
        
        if (isset($_GET["menu"])) {
            $current_subject = find_subject_by_id($_GET["menu"]);
            $current_page = null;
        } elseif (isset($_GET["page"])) {
            $current_subject = null;
            $current_page = find_page_by_id($_GET["page"]);
        } else {
            $current_subject = null;
            $current_page = null;

        }
        }

   //navigation takes two arguments
   //-the current  subject array or null
   //the current page array  if any 
    function navigation($subject_array, $page_array){
        $output = "<ul class=\"subjects\">";
        $menu_result = find_all_menuitems();
        while($menu_item = mysqli_fetch_assoc($menu_result)) {
            $output .= "<li"; 
            if($subject_array && $menu_item["menu_id"] == $subject_array["menu_id"]) {
                $output .=" class=\"selected\"";
            }

           $output .= ">" ; 
           $output .= "<a href=\"manage_content.php?menu=";
           $output .= urlencode($menu_item['menu_id']); 
           $output .= "\">";
           $output .= htmlentities($menu_item['menu_name']) ;
           $output .= "</a>";
          
            $page_set = find_sub_menus($menu_item["menu_id"]);   
            $output .= "<ul class=\"pages\" >";
                
                  
             while($page = mysqli_fetch_assoc($page_set)) {
                    $output .=  "<li"; 
                     if($page_array && $page["id"] ==  $page_array["id"]) {
                        $output .= " class=\"selected\"";
                    }
                    $output .= ">" ; 
                    $output .= "<a href=\"manage_content.php?page=";
                    $output .= urlencode($page["id"]);
                    $output .= "\">" ;
                    $output .= htmlentities($page['menu_name']) ; 
                    $output .= "</a></li> ";
                  
                }
                mysqli_free_result($page_set); 
                $output .= "</ul> </li>";
          
        }
            
        mysqli_free_result($menu_result); 
         $output .="</ul> ";
         return $output;
      }

    function redirect_to($new_location) {
      header("Location: " . $new_location);
      exit;
        }

    function mysql_prep($string){  
        global $connection;
        $escaped_string = mysqli_real_escape_string($connection,$string);
        return $escaped_string;
        }
       
    function form_errors($errors=array()) {
        $output = "";
        if (!empty($errors)) {
          $output .= "<div class=\"error\">";
          $output .= "Please fix the following errors:";
          $output .= "<ul>";
          foreach ($errors as $key => $error) {
            $output .= "<li>";
            $output .= htmlentities($error);
            $output .="</li>";
          }
          $output .= "</ul>";
          $output .= "</div>";
        }
        return $output;
        }
