<?php   


//"QUERRY RELATED FUNCTIONS"   
	function confirm_query($result_set) {
	   	if (!$result_set) {
     	 die("Database query failed.");

		    }
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
        $output .= "Por favor verifique los siguientes campos:";
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


//"FIND QUERRY FUNCTIONS"    

  function find_all_menuitems($public=true){
  		global $connection;
  		$query  = "SELECT *" ;
        $query .= " FROM menu ";
        if ($public){
        $query .= "WHERE visible = 1 ";}
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

  function find_sub_menus($menu_id,$public=true){
    	
        global $connection;
        $safe_subject_id = mysqli_real_escape_string($connection,$menu_id);

        
    	   $query  = "SELECT * " ;
        $query .= " FROM pages ";
        $query .= "WHERE menu_id = {$safe_subject_id} " ;
             if ($public){
             $query .= " AND visible = 1 "; 
             }
        $query .= "ORDER BY position ASC ";
        $page_set = mysqli_query($connection, $query);
        confirm_query($page_set);
        return $page_set;
        

          }

  function find_all_sub_menus($menu_id){
      
        global $connection;
        $safe_subject_id = mysqli_real_escape_string($connection,$menu_id);

        
        $query  = "SELECT * " ;
        $query .= " FROM pages ";
       
        $query .= " where menu_id = {$safe_subject_id} ";
        $query .= "ORDER BY position ASC ";
        $page_set = mysqli_query($connection, $query);
        confirm_query($page_set);
        return $page_set;
        

          }     

  function find_subject_by_id($subject_id,$public=true){
        global $connection;
        //$safesubject es una medida para evitar mysql injection.
        $safe_subject_id = mysqli_real_escape_string($connection,$subject_id);      
        $query  = "SELECT *" ;
        $query .= " FROM menu ";
        $query .= "WHERE menu_id = {$safe_subject_id} ";
        if($public){
          $query .= "AND visible = 1 ";

        }
        $query .= "LIMIT 1 ";
        $menu_result = mysqli_query($connection, $query);
        confirm_query($menu_result);

        if($item = mysqli_fetch_assoc($menu_result)) {
        return  $item;
        }else { return null;}

       }

  function find_pages_for_subject($subject_id, $public=true ) {
    global $connection;
    
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);
    
    $query  = "SELECT * ";
    $query .= "FROM pages ";
    $query .= "WHERE visible = 1 ";
    $query .= "AND menu_id = {$safe_subject_id} ";
    $query .= "ORDER BY position ASC";
    $page_set = mysqli_query($connection, $query);
    confirm_query($page_set);
    return $page_set;
     }

  function find_all_admins() {
    global $connection;
    
    $query  = "SELECT * ";
    $query .= "FROM usuarios ";
    $query .= "ORDER BY nombre_de_usuario ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
  }
  function find_admin_by_id($admin_id) {
    global $connection;
    
    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
    
    $query  = "SELECT * ";
    $query .= "FROM usuarios ";
    $query .= "WHERE id = {$safe_admin_id} ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
      return $admin;
    } else {
      return null;
    }
  }

  function find_admin_name_by_id($admin_id) {
    global $connection;
    
    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
    
    $query  = "SELECT nombre_de_usuario ";
    $query .= "FROM usuarios ";
    $query .= "WHERE id = '{$safe_admin_id}' ";
    $query .= "LIMIT 1";
    $admin_name = mysqli_query($connection, $query);
   
    return $admin_name;
    }
  

  function find_admin_by_username($username) {
    global $connection;
    
    $safe_user_name = mysqli_real_escape_string($connection, $username);
    
    $query  = "SELECT * ";
    $query .= "FROM usuarios ";
    $query .= "WHERE nombre_de_usuario = '{$safe_user_name}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
      return $admin;
    } else {
      return null;
    }
  }
  
  function find_page_by_id($page_id, $public=true){
      global $connection;
      //$safesubject es una medida para evitar mysql injection.
      $safe_page_id = mysqli_real_escape_string($connection,$page_id);      
      $query  = "SELECT *" ;
      $query .= " FROM pages ";
      $query .= "WHERE id = {$safe_page_id} ";
      if($public){
        $query .= "AND visible = 1 ";

      }
      $query .= "LIMIT 1 ";
      $page_result = mysqli_query($connection, $query);
      confirm_query($page_result);

      if($item = mysqli_fetch_assoc($page_result)) {
      return  $item;
      }else { return null;}

      }

  function find_default_page_for_subject($subject_id){

      $page_set = find_sub_menus($subject_id);

       if($first_page = mysqli_fetch_assoc($page_set)) {
        return  $first_page;
        }else { return null;}



     }

  function find_selected_page($public= false) {
      global $current_subject;
      global $current_page;
      
      if (isset($_GET["menu"])) {
          $current_subject = find_subject_by_id($_GET["menu"],$public);
          if ($current_subject && $public){
          $current_page = find_default_page_for_subject($current_subject["menu_id"]);
           
          }else{
          $current_page = null;

            }
          } elseif (isset($_GET["page"])) {
            $current_subject = null;
            $current_page = find_page_by_id($_GET["page"], $public);
          } else {
          $current_subject = null;
          $current_page = null;

       }
      }
  function find_selected_admin() {
    
      
      if (isset($_GET["id"])) {
          $selected_admin = find_admin_by_id($_GET["id"]);
         
          } else {
          $selected_admin = null;
       

       }
      }



  //NAVIGATION FUNCTIONS

  function navigation($subject_array, $page_array){

       //navigation takes two arguments
       //-the current  subject array or null
       //the current page array  if any 
        $output = "<ul class=\"subjects\">";
        $menu_result = find_all_menuitems(false);
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
          
            $page_set = find_sub_menus($menu_item["menu_id"],false);   
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


  function public_navigation($subject_array, $page_array) {

    $output = "<ul class=\"subjects\">";

    $menu_result = find_all_menuitems();

    while($menu_item = mysqli_fetch_assoc($menu_result)) {
          $output .= "<li"; 
           if($subject_array && $menu_item["menu_id"] == $subject_array["menu_id"]) {

           $output .=" class=\"selected\"";
           }
           $output .= ">" ; 
           $output .= "<a href=\"index.php?menu=";
           $output .= urlencode($menu_item['menu_id']); 
           $output .= "\">";
           $output .= htmlentities($menu_item['menu_name']) ;
           $output .= "</a>";
            
            //The next if statement is used to group the navigation pages under theyr parent subjects.
              //It shows the subpages when the menu is selecte and while the page is open using the if and || (or) //leo

           if($subject_array["menu_id"] == $menu_item["menu_id"] || 
                   $page_array["menu_id"] == $menu_item["menu_id"] ) {


               $page_set = find_sub_menus($menu_item["menu_id"]);   
               $output .= "<ul class=\"pages\" >";
              
                  
                while($page = mysqli_fetch_assoc($page_set)) {
                    $output .=  "<li"; 

                     if($page_array && $page["id"] ==  $page_array["id"]) {
                        $output .= " class=\"selected\"";
                    }
                    $output .= ">" ; 
                    $output .= "<a href=\"index.php?page=";
                    $output .= urlencode($page["id"]);
                    $output .= "\">" ;
                    $output .= htmlentities($page['menu_name']) ; 
                    $output .= "</a></li> "; //end of the subject
                  
                }
                $output .= "</ul> ";
                mysqli_free_result($page_set); 
                
              }

                $output .="</li>";
            
        }
         
        mysqli_free_result($menu_result); 
         $output .="</ul> ";
         return $output;
    }       
    

 
  function redirect_to($new_location) {
      header("Location: " . $new_location);
      exit;
      }
      

      
      
//login functions

  function password_encrypt($password){

      $hash_format ='$2y$10$'; //tells blowfish to use  a "cost "of 10
      $salt_length  = 22; //Blowfish salts should be 22-characters or more
      $salt = generate_salt($salt_length);
      $format_and_salt = $hash_format . $salt;
      $hash = crypt($password,$format_and_salt);

      return $hash;
  

    }

  function generate_salt($length){

        //Not 100% unique, not 100% random, but good enough for a salt
        //MD5 returns 32 characters
       $unique_random_string = md5(uniqid(mt_rand(),true));

        //Valid Characters for a salt are [a-zA-Z0-9./]

        $base64_String = base64_encode($unique_random_string);

        //But not '+' sign wich is valid in base 64 encoding

       $modified_base64_string = str_replace('+', '.', $base64_String);

        //Truncate string to the correct length

       $salt =  substr($modified_base64_string,0, $length);

       return $salt;

  }

  function password_check($password, $existing_hash){
    //existing hash contains format and salt at start
    $hash = crypt($password, $existing_hash);
    if ($hash === $existing_hash) {

        return true ;

          } else {

          return false ;  

          }

    }

  function attempt_login($username, $password){

      $admin = find_admin_by_username($username);
      if ($admin) {
        //found admin, now check password
        if (password_check($password, $admin["hashed_password"])){
          //password matches
          return $admin;
          } else {
        //PAssword does not match
         return false; 
        }}
        else {
        //admin not found
        return false; 
          }


        }

  function logged_in(){
      return isset($_SESSION['admin_id']);

      }      

  function confirm_logged_in(){

    if(!logged_in()){

      redirect_to("login.php");


      }
    
    }
        

  

?>

