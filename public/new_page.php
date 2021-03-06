<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>


<?php  find_selected_page(); ?>

  <?php
  // Can't add a new page unless we have a subject as a parent!
  if (!$current_subject) {
    // subject ID was missing or invalid or 
    // subject couldn't be found in database
    redirect_to("manage_content.php");
  }
?>

<?php
if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("menu_name", "position", "content");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("menu_name" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    // Perform Create

    // make sure you add the subject_id!
    $subject_id = $current_subject["menu_id"];
    $menu_name = mysql_prep($_POST["menu_name"]);
    $position = (int) $_POST["position"];
    $visible = (int) $_POST["visible"];
    // be sure to escape the content
    $content = mysql_prep($_POST["content"]);
   
    $query  = "INSERT INTO pages (";
    $query .= "  menu_id, menu_name, position, visible , content";
    $query .= ") VALUES (";
    $query .= "  {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Page created.";
      redirect_to("manage_content.php?menu=" . urlencode($current_subject["menu_id"]));
    } else {
      // Failure
      $_SESSION["message"] = "Page creation failed.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>


<!htmlstart >
<?php $layout_context = "admin"; ?>

<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
    <?php  echo navigation($current_subject,$current_page ); ?>  
   </div>
  <div id="page">
      <?php  echo message(); ?>
      <?php $errors = errors(); ?>
      <?php echo form_errors($errors); ?>
      <h2> Crear Pagina</h2>

      <form action="new_page.php?menu=<?php echo urlencode($current_subject["menu_id"]); ?>" method="post">
      <p>Menu name:
        <input type="text" name="menu_name" value="" />
        </p>
      <p>Position:
        <select name="position">
      
        <?php
        $page_set = find_pages_for_subject($current_subject["menu_id"]);
        $page_count = mysqli_num_rows($page_set); 
        
        for($count=1; $count <=($page_count + 1); $count++){

          echo "<option value=\"{$count}\">{$count}</option>";
        }
        ?>

        </select>

       </p>
      <p>Visible:
        <input type="radio" name="visible" value="0" /> No
        &nbsp;
        <input type="radio" name="visible" value="1" /> Yes
      </p>
      <p>Content:<br />
        <textarea name="content" rows="20" cols="80"></textarea>
      </p>





      <input type="submit" name="submit" value="Crear Pagina" />
    </form>
     <br/> 
  
  <a href="manage_content.php">Cancelar</a>
   </div>
</div>
   
<?php include("../includes/layouts/footer.php"); ?>   


