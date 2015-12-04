<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php  find_selected_page(true); ?>

<?php $layout_context = "public";?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
 

  <div id="navigation">
  
    <?php  echo public_navigation($current_subject,$current_page ); ?>  
    <br/>
    <br/>
   
   </div> 
   

   <div id="page">
  
        <?php if($current_subject){

          ?>
        <h2> <?php echo $current_subject["menu_name"];?></h2>
          Nombre del menu : <?php echo htmlentities($current_subject["menu_name"]); ?><br/>
          <br/>
           <h3>Subpaginas de este menu:</h3>
              <ul>
                  <?php 
                      $subject_pages = find_all_sub_menus($current_subject["menu_id"]);
                      while($page = mysqli_fetch_assoc($subject_pages)) {
                        echo "<li>";
                        $safe_page_id = urlencode($page["id"]);
                        echo "<a href=\"index.php?page={$safe_page_id}\">";
                        echo htmlentities($page["menu_name"]);
                        echo "</a>";
                        echo "</li>";
                      }
                    ?>
                    </ul>
                    <br>  

<!-- optional code in case you want the first sub page to display as default on a menu screen-->
            
 <!--  Pagina default: 
				<br>
               <?php echo $current_page["menu_name"] ; ?>
				<br>
               <?php echo $current_page["content"] ; ?> -->
      <!--     <br />
           -->
          </a>

       		 <?php } elseif($current_page) { ?>
            
            <h2> <?php echo  $current_page["menu_name"]; ?> </h2> 
          
            <div class= "view-content">

 <!-- Here, if we didnt want the content of the pages to display html, or only txt then
 here  we can use the functions 'htmlentities' ,'htmlspecialchars' or 'strip_tags' 
Also here we can use funtion 'nl2br', new line to turn new lines into brakes.*nl2br should be used before htmlsecurity functions
This just to make it more user friendly . Leo-->
              <?php echo $current_page["content"]; ?>
            </div>
                <br />
                  <br />
             
<!--                                                        -->
            <?php } 
            else { 

            	echo "<p>Bienvenido a Acountingx v 1.0  </p>" ;  }?>

        </div>
    </div>
  
<div>
<?php include("../includes/layouts/footer.php"); ?>   
</div>

