<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged_in(); ?>


<?php
  $admin = find_admin_by_id($_GET["id"]);
  
  if (!$admin) {
    // admin ID was missing or invalid or 
    // admin couldn't be found in database
    redirect_to("manage_admins.php");
  }
?>

<?php


if (isset($_POST['submit'])) {
  // Process the form
  
  // validations
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);
  


  if (empty($errors)) {
    // Perform update

    $id = $admin["id"];
    $username = mysql_prep($_POST["username"]);
   
    $hashed_password = password_encrypt($_POST["password"]);
    
    $query  = "UPDATE usuarios set ";
    $query .= "  nombre_de_usuario = '{$username}', ";
    $query .= "hashed_password = '{$hashed_password}' ";
    $query .= "where id = {$id} ";
    $query .= " LIMIT 1  ";
  
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      $_SESSION["message"] = "Usuario modificado correctamente.";
      redirect_to("manage_admins.php");
    } else {
      // Failure
      $_SESSION["message"] = "Modificacion de usuario  fallo.";
    }
  }
} else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    
    <h2>Editar Administrador: <?php echo htmlentities($admin["nombre_de_usuario"]); ?></h2>
    <form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
      <p>Nombre de usuario:<br><br>
        <input type="text" name="username" value="<?php echo htmlentities($admin["nombre_de_usuario"]); ?>"  />
      </p>
      <p>Password: </p>

        <input type="password" name="password" value="" />
        <br><br><br />
      <input type="submit" name="submit" value="Ingresar cambios" />
    </form>
    <br />
    <a href="manage_admins.php">Cancelar</a>
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
