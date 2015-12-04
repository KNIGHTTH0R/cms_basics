<?php if (!isset($layout_context)){

	$layout_context = "public";

}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>Acounting x <?php 
		
      if ($layout_context == "admin")
      	{echo " Consola Admin"; }

      ?></title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
	</head>
	<body>
    <div id="header">
      <h1>AccountingX <?php 

      if ($layout_context == "admin")
      	{echo " Consola de Administrador " ;}

      ?></h1>
    </div>