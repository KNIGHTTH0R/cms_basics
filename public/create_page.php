<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
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
  $required_fields = array("menu_name", "position", "visible", "content");
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
    $query .= "  subject_id, menu_name, position, visible, content";
    $query .= ") VALUES (";
    $query .= "  {$subject_id}, '{$menu_name}', {$position}, {$visible}, '{$content}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Page created.";
      redirect_to("manage_content.php?subject=" . urlencode($current_subject["id"]));
    } else {
      // Failure
      $_SESSION["message"] = "Page creation failed.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>