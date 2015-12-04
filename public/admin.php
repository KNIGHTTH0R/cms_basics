<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

 <?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
    <div id="main">
      <div id="navigation">

        &nbsp;
      </div>
      <div id="page">
        <h2>Menu de Administrador</h2>
        <p><?php echo htmlentities($_SESSION["username"]);?> bienvenido al area de administrador </p>
        
        <ul>
          <li><a href="manage_content.php">Administrar Contenidos</a></li>
          <li><a href="manage_admins.php">Administrar Usuarios</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>

<?php include("../includes/layouts/footer.php"); ?>   