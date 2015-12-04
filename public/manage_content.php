<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php  find_selected_page(); ?>



<?php $layout_context = "admin";?>


<?php include("../includes/layouts/header.php"); ?>

<div id="main">
 

  <div id="navigation">
    <a href ="admin.php">&laquo;  Menu principal</a><br />
    <?php  echo navigation($current_subject,$current_page ); ?>  
    <br/>
    <a href="new_menu.php">+Añadir menu</a>
   </div> 
   

   <div id="page">
      <?php  echo message();?>
      
        <?php if($current_subject){

          ?>
        <h2> <?php echo $current_subject["menu_name"];?></h2>
          Nombre del menu : <?php echo htmlentities($current_subject["menu_name"]); ?><br/>
          Posicion actual: <?php echo  htmlentities($current_subject["position"]); ?> <br/>
          Visible?: <?php echo  htmlentities($current_subject["visible"] == 1 ? "Si" : "No"); ?> <br/>
          <br/>

          
          <br />
          <a href="edit_subject.php?menu=<?php echo urlencode($current_subject["menu_id"]); ?>">Editar Menu
          </a>

            <div>
              <h3>Subpaginas de este menu:</h3>
              <ul>
                  <?php 
                      $subject_pages = find_all_sub_menus($current_subject["menu_id"]);
                      while($page = mysqli_fetch_assoc($subject_pages)) {
                        echo "<li>";
                        $safe_page_id = urlencode($page["id"]);
                        echo "<a href=\"manage_content.php?page={$safe_page_id}\">";
                        echo htmlentities($page["menu_name"]);
                        echo "</a>";
                        echo "</li>";
                      }
                    ?>
                    </ul>
                       + <a href="new_page.php?menu=<?php echo urlencode($current_subject["menu_id"]); ?>">Anadir una subpagina</a>




                </div>

            <?php } elseif($current_page) { ?>
            
            <h2> <?php echo  $current_page["menu_name"]; ?> </h2> 
            <a href="edit_page.php?page=<?php echo urlencode($current_page['id']); ?>">Editar pagina</a>
            <br> <br>
            Pagina: <?php echo  htmlentities($current_page["menu_name"]); ?> <br/>
            Posicion actual: <?php echo  htmlentities($current_page["position"]); ?> <br/>
            Visible?: <?php echo  htmlentities($current_page["visible"] == 1 ? "Si" :"No"); ?> <br/>
           
            Content:<br/>
            <div class= "view-content">
              <?php echo $current_page["content"]; ?>
            </div>
                <br />
                  <br />
             

            <?php } 
            else { echo "Porfavor seleccione una opcion en la barra lateral." ;  }?>

        </div>
    </div>
  
<div>
<?php include("../includes/layouts/footer.php"); ?>   
</div>

