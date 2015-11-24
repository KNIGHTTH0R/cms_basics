<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php find_selected_page(); ?>
<?php if(!$current_page){

	redirect_to("manage_content.php");
	
		}?>
<?php
	if (isset($_POST['submit'])) {
	// Process the form
	// validationsrererre
	$required_fields =array("menu_name","position","visible");
 	validate_presences($required_fields);

	$fields_with_max_lengths = array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

		if (empty($errors)) {
		
		$id = $current_page["id"];
		$menu_name = mysql_prep($_POST["menu_name"]);
		$position = (int) $_POST["position"]; 
		$visible = (int) $_POST["visible"] ;
		$content = mysql_prep($_POST["content"]);

		$query  = "UPDATE pages set ";
		$query .= "menu_name = '{$menu_name}', ";
		$query .= "position = {$position}, ";
		$query .= "visible = {$visible}, ";
		$query .= "content = '{$content}' ";
		$query .= "WHERE id = {$id} ";
		//$query .= "LIMIT 1";
		$result = mysqli_query($connection, $query);
		
			if ($result && mysqli_affected_rows($connection) >= 1 ) {
				// Success
				$_SESSION["message"] = "Edicion exitosa";
				redirect_to("manage_content.php");
			} else {
				// Failure
				$message = "Fallo Edicion del menu.";
				
			}
		}
	}
 				

 	 else {}
?>


<! end of self processing form>


<?php include("../includes/layouts/header.php"); ?>


<div id="main">
<div id="navigation">
			<?php echo navigation($current_subject, $current_page); ?>
  		</div>
  <div id="page">
		<?php if(!empty($message)){
			echo "<div class=\"message\">" . htmlentities($message) ."</div>";
		}
		?>
		
		<?php echo form_errors($errors); ?>
		<h2>Editar pagina:

		 <?php echo  htmlentities($current_page["menu_name"])  ?> </h2> 

		<form action="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>" method="post">
		  <p>Menu name:
		    <input type="text" name="menu_name" value="<?php echo htmlentities($current_page["menu_name"]) ?> " />
		  </p>
		  <p>Position:
		    <select name="position">
				<?php
					$subject_set = find_all_pages();
					$subject_count = mysqli_num_rows($subject_set);
					for($count=1; $count <= $subject_count; $count++) {
						echo "<option value=\"{$count}\"";
						if ($current_page["position"] == $count) {
							echo " selected";
						}
						echo ">{$count}</option>";
					}
					
				?>
		    </select>
		  </p>
		
		  <p>Visible:
		    <input type="radio" name="visible" value="0" <?php    
		    	if($current_page["visible"] == 0){echo "checked";}
		    	?>
		    /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" 

		    <?php    
		    	if($current_page["visible"] == 1){echo "checked";}
		    	?> /> Yes
		  </p>
		  <br/>
		  Contenido de la pagina:
		  <br/><br/>
		  <textarea name = "content" value="content">Ingrese su contenido aqui</textarea/><br/>
		  <input type="submit" name="submit" value="Editar Pagina" />


		</form>
		<br />
		<a href="admin.php"> Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_subject.php?page=<?php echo urlencode($current_page["id"]) ?>" onclick="return confirm('Esta seguro?')"> Borrar Menu</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>



