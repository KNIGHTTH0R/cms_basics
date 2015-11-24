<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php  find_selected_page(); ?>


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

        <?php } elseif($current_page) { ?>
            
            <h2> <?php echo  $current_page["menu_name"]; ?> </h2> 
            Pagina: <?php echo  htmlentities($current_page["menu_name"]); ?> <br/>
            Posicion actual: <?php echo  htmlentities($current_page["position"]); ?> <br/>
            Visible?: <?php echo  htmlentities($current_page["visible"] == 1 ? "Si" :"No"); ?> <br/>
            <a href="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>">
            Editar Pagina<br/><br/><a />
            Content:<br/>
            <div class= "view-content">
              <?php echo $current_page["content"]; ?>



            <?php } 
            else { echo "Porfavor seleccione una opcion en la barra lateral." ;  }?>

        </div>
    </div>
  
   
<?php include("../includes/layouts/footer.php"); ?>   


