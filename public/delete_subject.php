<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php find_selected_page(); ?>

<?php $current_subject =find_subject_by_id($_GET["menu"], false);?>
<?php if(!$current_subject){

	redirect_to("manage_content.php");
	
		} ?>

<?php $pages_set = find_sub_menus($current_subject["menu_id"]);
if(mysqli_num_rows($pages_set)>0){
	$_SESSION["message"] = "No se puede borrar un menu con subpaginas.";
		redirect_to("manage_content.php?menu={$current_subject["menu_id"]}");

}
?>

<?php 
	$id =$current_subject["menu_id"]; 	
	$query = "DELETE FROM  menu WHERE menu_id = {$id} LIMIT 1";
	$result = mysqli_query($connection, $query);
	

	if($result && mysqli_affected_rows($connection) == 1){
		$_SESSION["message"] = "Borrado Exitoso";
				redirect_to("manage_content.php");
			} else {
			$_SESSION["message"] = "Borrado Fallo.";
		redirect_to("manage_content.php?menu={$id}");



	};