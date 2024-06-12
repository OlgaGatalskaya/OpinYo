-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         8.4.0 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para opiniyo
CREATE DATABASE IF NOT EXISTS `opiniyo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `opiniyo`;

-- Volcando estructura para tabla opiniyo.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `IDAdmin` int unsigned NOT NULL AUTO_INCREMENT,
  `FechaAltaAdmin` timestamp NULL DEFAULT NULL,
  `FechaModificacionAdmin` timestamp NULL DEFAULT NULL,
  `ActivoAdmin` varchar(2) COLLATE utf8mb4_general_ci DEFAULT 'Si',
  `EmailAdmin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `LoginAdmin` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `PasswordAdmin` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IDAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla opiniyo.admin: ~1 rows (aproximadamente)
INSERT INTO `admin` (`IDAdmin`, `FechaAltaAdmin`, `FechaModificacionAdmin`, `ActivoAdmin`, `EmailAdmin`, `LoginAdmin`, `PasswordAdmin`) VALUES
	(1, '2024-05-21 10:47:47', NULL, 'Si', 'olga@gmail.com', 'olga', 'olga');

-- Volcando estructura para tabla opiniyo.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `IDCategoria` int unsigned NOT NULL AUTO_INCREMENT,
  `FechaAltaCategoria` timestamp NULL DEFAULT NULL,
  `FechaModificacionCategoria` timestamp NULL DEFAULT NULL,
  `ActivoCategoria` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Si',
  `NombreCategoria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IDCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla opiniyo.categoria: ~6 rows (aproximadamente)
INSERT INTO `categoria` (`IDCategoria`, `FechaAltaCategoria`, `FechaModificacionCategoria`, `ActivoCategoria`, `NombreCategoria`) VALUES
	(1, '2024-05-22 07:15:31', NULL, 'Si', 'Belleza'),
	(2, '2024-05-22 07:16:42', NULL, 'Si', 'Ropa'),
	(3, '2024-05-22 07:16:49', NULL, 'Si', 'Para niños'),
	(4, '2024-05-22 07:16:55', NULL, 'Si', 'Electrodomésticos'),
	(6, '2024-05-22 09:08:08', NULL, 'Si', 'Mueble'),
	(14, '2024-06-10 10:05:35', NULL, 'Si', 'Otro');

-- Volcando estructura para tabla opiniyo.navmenu
CREATE TABLE IF NOT EXISTS `navmenu` (
  `IDNavmenu` int unsigned NOT NULL AUTO_INCREMENT,
  `FechaAltaNavemenu` timestamp NULL DEFAULT NULL,
  `FechaModificacionNavmen` timestamp NULL DEFAULT NULL,
  `ActivoNavemenu` varchar(2) COLLATE utf8mb4_general_ci DEFAULT 'Si',
  `NombreNavmenu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `UrlNavmenu` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `OrdenNavmenu` int DEFAULT NULL,
  PRIMARY KEY (`IDNavmenu`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla opiniyo.navmenu: ~3 rows (aproximadamente)
INSERT INTO `navmenu` (`IDNavmenu`, `FechaAltaNavemenu`, `FechaModificacionNavmen`, `ActivoNavemenu`, `NombreNavmenu`, `UrlNavmenu`, `OrdenNavmenu`) VALUES
	(1, '2024-05-22 07:20:47', NULL, 'Si', 'Inicio', 'index.php', 1),
	(2, '2024-05-22 07:21:12', NULL, 'Si', 'Opiniones', 'todasOpiniones.php', 2),
	(3, '2024-05-22 07:22:56', NULL, 'Si', 'Añadir opinion', 'opinion1.php', 3);

-- Volcando estructura para tabla opiniyo.opinion
CREATE TABLE IF NOT EXISTS `opinion` (
  `IDOpinion` int unsigned NOT NULL AUTO_INCREMENT,
  `FechaAltaOpinion` timestamp NULL DEFAULT NULL,
  `FechaModificacionOpinion` timestamp NULL DEFAULT NULL,
  `ActivoOpinion` varchar(2) COLLATE utf8mb4_general_ci DEFAULT 'Si',
  `ClasificacionOpinion` int DEFAULT NULL,
  `ComentarioOpinion` text COLLATE utf8mb4_general_ci,
  `FechaOpinion` datetime DEFAULT NULL,
  `ProductoOpinion` int unsigned NOT NULL,
  `UsuarioOpinion` int unsigned NOT NULL,
  PRIMARY KEY (`IDOpinion`),
  KEY `FK__producto` (`ProductoOpinion`),
  KEY `FK__usuario` (`UsuarioOpinion`),
  CONSTRAINT `FK__producto` FOREIGN KEY (`ProductoOpinion`) REFERENCES `producto` (`IDProducto`) ON DELETE CASCADE,
  CONSTRAINT `FK__usuario` FOREIGN KEY (`UsuarioOpinion`) REFERENCES `usuario` (`IDUsuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla opiniyo.opinion: ~12 rows (aproximadamente)
INSERT INTO `opinion` (`IDOpinion`, `FechaAltaOpinion`, `FechaModificacionOpinion`, `ActivoOpinion`, `ClasificacionOpinion`, `ComentarioOpinion`, `FechaOpinion`, `ProductoOpinion`, `UsuarioOpinion`) VALUES
	(1, '2024-06-04 21:34:21', NULL, 'Si', 4, '<p>El peinado de cejas está tan arraigado en mi vida que no puedo imaginarme las mañanas sin él.\r\n\r\nAunque no vaya a ninguna parte, ni vaya a hacer ningún recado, me peino las cejas, ¡es como si se hubiera convertido en un hábito para mí!\r\n\r\nHe probado muchos productos para peinarme las cejas y cada uno de ellos era bueno a su manera, pero cuando conocí esta máscara de pestañas para cejas, ¡me di cuenta de que existe el producto perfecto para todos los días sin complicaciones!\r\n\r\n</p>\r\n', '2024-06-04 23:34:21', 14, 10),
	(17, '2024-06-08 18:41:35', NULL, 'Si', 2, '<p><strong>Es dif&iacute;cil escribir sobre fragancias</strong> que no te gustan. Y una cosa es cuando una fragancia provoca rechazo, y queda claro qu&eacute; es exactamente lo que no te gusta de ella. Otra cosa es Acqua Di Gio de Giorgio Armani. Parece agradable en general, pero a m&iacute; me produce una firme aversi&oacute;n. Cuando la huelo, se me arruga la nariz y se me amarga la boca, de lo que s&oacute;lo puedo librarme eliminando esta fragancia de mi entorno.</p>\r\n', '2024-06-08 20:41:35', 15, 12),
	(30, '2024-06-09 01:38:53', NULL, 'Si', 3, '<p>El color es un poco <s>p&aacute;lido</s> para m&iacute;, sobre todo se nota en contraste con otro tono rosa, as&iacute; que la llevaremos debajo de una braguita m&aacute;s oscura. Y la camiseta es una pasada, &iexcl;me encantan estas ideas para los ni&ntilde;os!</p>\r\n', '2024-06-09 03:38:53', 30, 5),
	(31, '2024-06-09 18:17:34', NULL, 'Si', 5, '<p>Hoy quiero hablaros de un agua de tocador muy chula para hombres: <strong><em>Hugo boss unlimited.</em></strong><br />\r\nEl eau de toilette est&aacute; en una burbuja blanca, no transparente.<br />\r\nEsta fragancia es bastante fuerte y persistente. Sobre la firmeza hablar&eacute; un poco m&aacute;s abajo. Pero sobre la fuerza. Empiezo a sentir las primeras notas de la pir&aacute;mide en el momento de abrir la tapa blanca.<br />\r\nEs decir, incluso antes del momento de la aplicaci&oacute;n, se siente el olor del perfume. Pero, por supuesto, sobre la piel se abre con una fragancia totalmente nueva y sorprendente.</p>\r\n', '2024-06-09 20:17:34', 31, 13),
	(33, '2024-06-09 18:25:18', NULL, 'Si', 4, '<p>Los puertos funcionan correctamente. Muchas veces conect&eacute; memorias USB y vi pel&iacute;culas descargadas en ellas, tambi&eacute;n conect&eacute; una consola de juegos por HDMI y todo funcion&oacute; perfectamente.Quiero advertirte que no existe la llamada &laquo;SMART TV&raquo; en el televisor. Solo se puede conectar a internet con cables. Intent&eacute; hacerlo, pero despu&eacute;s de hablar con especialistas en este campo, desist&iacute; de esta idea, ya que seg&uacute;n ellos es muy dif&iacute;cil y tendr&aacute;s que gastar porque s&iacute;.Durante 8 a&ntilde;os el televisor nunca ha fallado. Ni una sola vez he tenido que repararlo. Lo asombroso es que ha resistido los muchos apagones y apagones repentinos que ocurren muy a menudo en mi MH. Una vez dieron por error una luz de alto voltaje despu&eacute;s de otro apag&oacute;n e incluso despu&eacute;s de eso el televisor no se da&ntilde;&oacute;.En pocas palabras: TV Samsung UE40D5000PW para hoy puedo recomendar a aquellas personas que quieren comprar un producto de calidad para ver c&oacute;modamente la televisi&oacute;n por sat&eacute;lite o televisi&oacute;n digital sin necesidad de ir en l&iacute;nea. <strong>Lo recomendo</strong></p>\r\n', '2024-06-09 20:25:18', 33, 13),
	(34, '2024-06-09 18:29:00', NULL, 'Si', 3, '<p>El altavoz es excelente, la marca Alexa no me es familiar, pero despu&eacute;s de leer sobre ella, me di cuenta de que la calidad debe ser de alto nivel. Se trata de una empresa danesa conocida en Europa por sus sistemas de altavoces. <strong>El precio es superior al de los modelos econ&oacute;micos</strong>, pero en este caso la calidad de los materiales utilizados para fabricar la carcasa y los altavoces es mucho mejor. Lo que deber&iacute;a proporcionar una larga vida &uacute;til y un sonido excelente. Sobre la larga vida &uacute;til vamos a comprobar en el tiempo, y sobre la calidad del sonido voy a escribir en mi opini&oacute;n. Llevo 2 meses usando el altavoz, fue el modelo City que me atrajo con su dise&ntilde;o fresco.</p>\r\n', '2024-06-09 20:29:00', 34, 13),
	(35, '2024-06-09 18:36:26', NULL, 'Si', 5, '<p>Definitivamente recomiendo la cafetera a todo el mundo, pero si tienes la oportunidad de poner una algarroba, ponla mejor, el sabor sigue siendo diferente no importa que mezclas no haga el fabricante.<br />\r\nNo voy a bajar la puntuaci&oacute;n por la diferencia de sabor, sab&iacute;a a lo que iba.</p>\r\n', '2024-06-09 20:36:26', 35, 14),
	(36, '2024-06-09 18:44:35', NULL, 'Si', 4, '<p>La bater&iacute;a se agota bastante despacio, no hace falta estar pendiente del enchufe. No se calienta y funciona sin ruido. No se ralentiza. El touchpad es bueno. La imagen con una resoluci&oacute;n de 3000*2000, la calidad es top. Funci&oacute;n genial - multipantalla. Esta es una proyecci&oacute;n de m&oacute;vil en el port&aacute;til, pero s&oacute;lo si usted tiene un tel&eacute;fono Huawei, se conecta con un solo clic. Puede escribir texto (en el teclado, por supuesto, es m&aacute;s conveniente), ver v&iacute;deos en la pantalla grande, llevar archivos entre el ordenador port&aacute;til y el tel&eacute;fono inteligente.</p>\r\n', '2024-06-09 20:44:35', 36, 14),
	(37, '2024-06-09 19:02:13', NULL, 'Si', 3, '<p>Buen producto\r\nLa composición, desde luego, si la resuelves en Alcoyano, te puede asustar. Te lo digo desde ya, no soy de los miedosos))) En primer lugar, la lista parece larga, llama la atención. En segundo lugar, hay ingredientes de origen sintético, que pueden provocar alergias. Adjunto inmediatamente para mayor claridad una pantalla de la ekogolik, tal vez será útil para especialmente exigente y exigente a la composición de las personas. Pero aún así, hay muchas veces más buenos ingredientes aquí.</p>\r\n', '2024-06-09 21:02:13', 37, 14),
	(38, '2024-06-09 19:05:35', NULL, 'Si', 5, '<p>La calidad de Lego es excelente, como siempre. Las piezas son de pl&aacute;stico grueso, las conexiones de los ra&iacute;les son seg&uacute;n<br />\r\ntipo puzzle, sencillas y no quebradizas. Si pisas una pieza con el pie, &iexcl;ser&aacute; el pie el que sufra, no la pieza!<br />\r\nLas piezas son grandes, coloridas y f&aacute;ciles de montar, de excelente calidad.<br />\r\nEl montaje es f&aacute;cil y f&aacute;cil de seguir las instrucciones.</p>\r\n', '2024-06-09 21:05:35', 38, 15),
	(39, '2024-06-09 19:43:14', NULL, 'Si', 5, '<p>La textura de la crema es un poco l&iacute;quida, hace honor a su nombre y realmente parece un tinte. Al mismo tiempo, el nivel de pigmentaci&oacute;n es excelente y la cobertura es alta. Incluso una peque&ntilde;a gota se puede extender bien.Tengo la piel mixta. Es m&aacute;s propensa a la grasa (por eso antes prefer&iacute;a los t&oacute;nicos matificantes), pero ahora la situaci&oacute;n no es tan cr&iacute;tica. Tengo algunas zonas con posible descamaci&oacute;n, as&iacute; que para m&iacute; es importante que la base de maquillaje no las acent&uacute;e.</p>\r\n', '2024-06-09 21:43:14', 39, 15),
	(40, '2024-06-09 19:47:01', NULL, 'Si', 5, '<p>Caracter&iacute;sticas bastante interesantes de este rat&oacute;n. No todos los ratones en esta categor&iacute;a de precio tiene tales caracter&iacute;sticas:<br />\r\n1. Sensor &oacute;ptico con resoluci&oacute;n real 6400 DPI (PIxArt PAW 3328, pero no del todo est&aacute;ndar, es ligeramente modificado por la empresa. Este sensor es lo suficientemente fiable, y no habr&aacute; problemas con &eacute;l, no habr&aacute; que el rat&oacute;n vuela fuera del lugar en la pantalla o va en alguna parte en la direcci&oacute;n equivocada).<br />\r\n2. Velocidad de seguimiento de hasta 220 IPS (pulgadas por segundo) / aceleraci&oacute;n de hasta 30 g.<br />\r\n3. 5 botones programables<br />\r\n4. Vida &uacute;til del interruptor mec&aacute;nico de 10 millones de pulsaciones.<br />\r\n5. Forma ergon&oacute;mica para usuarios diestros (este rat&oacute;n no es sim&eacute;trico y no se adaptar&aacute; a usuarios zurdos).<br />\r\n6. Inserciones laterales de pl&aacute;stico texturizado para un agarre seguro.<br />\r\n7. Rueda de desplazamiento t&aacute;ctil (muy suave al tacto, el desplazamiento es suave, sin esfuerzo, al igual que los clics).<br />\r\n8. Frecuencia de sondeo Utlrapolling de 1000 Hz.<br />\r\n9. Ajuste de sensibilidad en software especial (modos est&aacute;ndar: 400/800/1600/3200/6400 DPI, pero puede ajustar el valor usted mismo)<br />\r\n10. Software de gesti&oacute;n de ajustes Razer Synapse 3 (se instala en cuanto conectas el rat&oacute;n al ordenador).<br />\r\n11.Compatibilidad con el modo Hypershift para asignar segundas funciones a las copkas (tambi&eacute;n personalizable en un software especial)<br />\r\n12.Retroiluminaci&oacute;n verde<br />\r\n13.Deslizamientos Ultraslick ultrasuaves (en realidad muy suaves, el rat&oacute;n se desliza sobre la alfombrilla como ning&uacute;n otro)<br />\r\n14. Longitud del cable 1,7m.<br />\r\n15. Dimensiones del rat&oacute;n 126x73x43mm<br />\r\n16. Peso sin cable 96g.</p>\r\n', '2024-06-09 21:47:01', 40, 15),
	(59, '2024-06-12 18:42:47', NULL, 'Si', 5, '<p>Tacto agradable y juguet&oacute;n</p>\r\n\r\n<p>Es el peluche favorito de mi hijo</p>\r\n', '2024-06-12 20:42:47', 53, 12);

-- Volcando estructura para tabla opiniyo.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `IDProducto` int unsigned NOT NULL AUTO_INCREMENT,
  `FechaAltaProducto` timestamp NULL DEFAULT NULL,
  `FechaModificacionProducto` timestamp NULL DEFAULT NULL,
  `ActivoProducto` varchar(2) COLLATE utf8mb4_general_ci DEFAULT 'Si',
  `NombreProducto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ImagenProducto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `SubcategoriaProducto` int unsigned NOT NULL,
  PRIMARY KEY (`IDProducto`),
  KEY `FK_producto_subcategoria` (`SubcategoriaProducto`),
  CONSTRAINT `FK_producto_subcategoria` FOREIGN KEY (`SubcategoriaProducto`) REFERENCES `subcategoria` (`IDSubcategoria`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla opiniyo.producto: ~13 rows (aproximadamente)
INSERT INTO `producto` (`IDProducto`, `FechaAltaProducto`, `FechaModificacionProducto`, `ActivoProducto`, `NombreProducto`, `ImagenProducto`, `SubcategoriaProducto`) VALUES
	(14, '2024-05-26 22:29:08', NULL, 'Si', 'Mascara Lancome', 'Captura de pantalla 2024-05-22 162047.png', 3),
	(15, '2024-05-30 09:20:22', NULL, 'Si', 'Perfume Armani', 'Captura de pantalla 2024-05-26 113057.png', 4),
	(16, '2024-05-30 11:43:23', NULL, 'Si', 'Mascara Benefit', 'Captura de pantalla 2024-05-30 134246.png', 3),
	(30, '2024-06-09 01:38:53', NULL, 'Si', 'Camiseta Baby Go', 'Captura de pantalla 2024-06-09 023828.png', 19),
	(31, '2024-06-09 18:17:34', NULL, 'Si', 'Hugo Boss Bottled Unlimited', 'Captura de pantalla 2024-06-09 201542.png', 4),
	(33, '2024-06-09 18:25:18', NULL, 'Si', 'LED-tele Samsung UE40D5000PW', 'Captura de pantalla 2024-06-09 201908.png', 11),
	(34, '2024-06-09 18:29:00', NULL, 'Si', 'Altavoz Bluetooth Alexa', 'Captura de pantalla 2024-06-09 202744.png', 11),
	(35, '2024-06-09 18:36:26', NULL, 'Si', 'Cafetera Nespresso Essenza', 'Captura de pantalla 2024-06-09 203243.png', 12),
	(36, '2024-06-09 18:44:35', NULL, 'Si', 'Portatil Huawei Matebook X Pro', 'Captura de pantalla 2024-06-09 204343.png', 14),
	(37, '2024-06-09 19:02:13', NULL, 'Si', 'CeraVe Limpiadora', 'Captura de pantalla 2024-06-09 210126.png', 3),
	(38, '2024-06-09 19:05:35', NULL, 'Si', 'Lego2', 'Captura de pantalla 2024-06-09 210454.png', 17),
	(39, '2024-06-09 19:43:14', NULL, 'Si', 'Lancome Teint Idole Ultra Wear SPF15', 'Captura de pantalla 2024-06-09 214157.png', 3),
	(40, '2024-06-09 19:47:01', NULL, 'Si', 'Ratón para ordenador Razer', 'Captura de pantalla 2024-06-09 214544.png', 14),
	(53, '2024-06-12 18:42:47', NULL, 'Si', 'Peluche Gatón', '51tnBS+U3tL._AC_UF894,1000_QL80_.jpg', 17);

-- Volcando estructura para tabla opiniyo.subcategoria
CREATE TABLE IF NOT EXISTS `subcategoria` (
  `IDSubcategoria` int unsigned NOT NULL AUTO_INCREMENT,
  `FechaAltaSubcategoria` timestamp NULL DEFAULT NULL,
  `FechaModificacionSubcategoria` timestamp NULL DEFAULT NULL,
  `ActivoSubcategoria` varchar(2) COLLATE utf8mb4_general_ci DEFAULT 'Si',
  `NombreSubcategoria` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `CategoriaSubcategoria` int unsigned NOT NULL,
  PRIMARY KEY (`IDSubcategoria`),
  KEY `FK__categoria` (`CategoriaSubcategoria`),
  CONSTRAINT `FK__categoria` FOREIGN KEY (`CategoriaSubcategoria`) REFERENCES `categoria` (`IDCategoria`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla opiniyo.subcategoria: ~16 rows (aproximadamente)
INSERT INTO `subcategoria` (`IDSubcategoria`, `FechaAltaSubcategoria`, `FechaModificacionSubcategoria`, `ActivoSubcategoria`, `NombreSubcategoria`, `CategoriaSubcategoria`) VALUES
	(3, '2024-05-22 09:56:46', NULL, 'Si', 'Cosmética decorativa', 1),
	(4, '2024-05-22 09:57:41', NULL, 'Si', 'Perfumería', 1),
	(5, '2024-05-22 10:00:46', NULL, 'Si', 'Parte superior', 2),
	(7, '2024-05-22 10:01:28', NULL, 'Si', 'Parte inferior', 2),
	(11, '2024-05-22 10:19:13', NULL, 'Si', 'Para casa', 4),
	(12, '2024-05-22 10:20:52', NULL, 'Si', 'Para cocina', 4),
	(13, '2024-05-22 11:34:28', NULL, 'Si', 'Acesorios', 2),
	(14, '2024-05-22 11:35:43', NULL, 'Si', 'Ordenadores', 4),
	(15, '2024-05-22 11:36:02', NULL, 'Si', 'Para casa', 6),
	(16, '2024-05-22 11:36:09', NULL, 'Si', 'Para cocina', 6),
	(17, '2024-05-22 11:36:43', NULL, 'Si', 'Juguetes infantiles', 3),
	(18, '2024-05-22 11:37:16', NULL, 'Si', 'Ropa para chicos', 3),
	(19, '2024-05-22 11:37:20', NULL, 'Si', 'Ropa para chicas', 3),
	(20, '2024-05-22 11:37:30', NULL, 'Si', 'Ropa para bebes', 3),
	(23, '2024-06-10 13:30:12', NULL, 'Si', 'Zapatos', 2),
	(26, '2024-06-10 13:47:32', NULL, 'Si', 'Otro', 14);

-- Volcando estructura para tabla opiniyo.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `IDUsuario` int unsigned NOT NULL AUTO_INCREMENT,
  `FechaAltaUsuario` timestamp NULL DEFAULT NULL,
  `FechaModificacionUsuario` timestamp NULL DEFAULT NULL,
  `ActivoUsuario` varchar(2) COLLATE utf8mb4_general_ci DEFAULT 'Si',
  `LoginUsuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `EmailUsuario` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `PasswordUsuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ImagenUsuario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`IDUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla opiniyo.usuario: ~7 rows (aproximadamente)
INSERT INTO `usuario` (`IDUsuario`, `FechaAltaUsuario`, `FechaModificacionUsuario`, `ActivoUsuario`, `LoginUsuario`, `EmailUsuario`, `PasswordUsuario`, `ImagenUsuario`) VALUES
	(5, '2024-05-30 00:58:01', NULL, 'Si', 'usuario2', 'usuario2@gmail.com', '$2y$10$3qWrdXGtU5rF1A7mE2C4A.zLTr5DRC.66mLSZgbqyWWFXKtvUPB9i', NULL),
	(6, '2024-05-30 01:05:01', NULL, 'Si', 'usuario4', 'usuario4@gmail.com', '$2y$10$N79034yOlepr6.Afv8isjO.Mbe9STgAfJiugIC1nDKM9585B/4tnG', NULL),
	(10, '2024-05-30 02:22:45', NULL, 'Si', 'olga', 'gatalolia86@gmail.com', '$2y$10$mRHUePLvEnm5EyCVQ9A4F.fo5cspEicSQi05DfmNb04kr8DSyBkZC', NULL),
	(11, '2024-05-30 03:22:39', NULL, 'Si', 'olguita', 'olguita86@gmail.com', '$2y$10$mqyfC4d6uSk.YlIO3IcQAetxFua5qz.9ZR./M4EilZG.0Zlw955tu', NULL),
	(12, '2024-05-30 15:23:33', NULL, 'Si', 'vale', 'vale@gmail.com', '$2y$10$oZhhJEY5LuczH56HDNt1c.MV9SaoXg1gF5.hbtJXv/aXnL61BrPku', NULL),
	(13, '2024-06-09 18:14:23', NULL, 'Si', 'Veronica', 'veronica@gmail.com', '$2y$10$hn6nT3c5YjotvbEa9vlfR.qgoywpbjEZKGnUEEXRgVV3HnZGiCul.', NULL),
	(14, '2024-06-09 18:31:02', NULL, 'Si', 'Linda', 'linda@gmail.com', '$2y$10$iORhek3fYH1t1.XT64x58ezAbY7hDE6PEfqyXyRnfmS9xfgg.DnCK', NULL),
	(15, '2024-06-09 19:03:38', NULL, 'Si', 'Carlitos', 'carlitos@gmail.com', '$2y$10$bRKqjPBtiIkAR6.dJRNRJ.HsnNVJ.oOZj3PLVul.3sf9itNu.QbFC', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
