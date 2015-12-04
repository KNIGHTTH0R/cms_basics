
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_de_usuario` varchar(50) NOT NULL,
  `hashed_password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios'
--

INSERT INTO `usuarios` VALUES (1,'Leo','$2y$10$NzAyZjMyOGY4MDI0ZTAyMO4.19DFge1nW4RGZo0a79uzkoT20911y'),(3,'johndoe','$2y$10$NTdmODYxZWQ0OGMwYmMxZ.Q3I4i0FtO/X9DWv1tpsF5hiS9LBXqmu');
--Password for user Leo is "secret"
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` VALUES (1,1,'Nuestra mision',1,1,'Nuestra mision siempre ha sido...'),(2,1,'Nuestra historia',2,1,'Fundado en 2015 por los hermanos Rueda...\r\n\r\nRecientemente...'),(3,2,'Software',1,1,'Nuestro software est a la vanguardia ...'),(4,2,'Servicios',2,1,'Aca estan nuestros servicios...'),(5,3,'Mejoras a software',1,1,'Amamos arreglar software...'),(6,3,'Certification',2,0,'certificamos nuestro software, ...');

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `subjects` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` VALUES (1,'Acerca de Acountingx',1,1),(2,'Productos',2,1),(3,'Services',3,1),(6,'Today\'s progress',4,0);


