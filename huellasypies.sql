-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2021 a las 16:44:35
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `huellasypies`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210506144841', '2021-05-06 16:50:05', 1290),
('DoctrineMigrations\\Version20210507162844', '2021-05-07 18:28:50', 748),
('DoctrineMigrations\\Version20210509070741', '2021-05-09 09:07:52', 69),
('DoctrineMigrations\\Version20210511152622', '2021-05-11 17:26:34', 287),
('DoctrineMigrations\\Version20210516082157', '2021-05-16 10:22:07', 320),
('DoctrineMigrations\\Version20210516102912', '2021-05-16 12:29:20', 46),
('DoctrineMigrations\\Version20210518145021', '2021-05-18 16:50:34', 222),
('DoctrineMigrations\\Version20210518155759', '2021-05-18 17:58:04', 42),
('DoctrineMigrations\\Version20210522134023', '2021-05-22 15:40:31', 220),
('DoctrineMigrations\\Version20210602164828', '2021-06-02 18:48:48', 809),
('DoctrineMigrations\\Version20210605142549', '2021-06-05 16:44:01', 41);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_mascota`
--

CREATE TABLE `estado_mascota` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_mascota`
--

INSERT INTO `estado_mascota` (`id`, `estado`) VALUES
(1, 'Disponible'),
(2, 'Urgente'),
(3, 'Tramitando'),
(4, 'Adoptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_noticia`
--

CREATE TABLE `estado_noticia` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_noticia`
--

INSERT INTO `estado_noticia` (`id`, `estado`) VALUES
(1, 'borrador'),
(2, 'publicada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `requisitos` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_alta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_adopcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vacunado` tinyint(1) NOT NULL,
  `desparasitado` tinyint(1) NOT NULL,
  `esterilizado` tinyint(1) NOT NULL,
  `microchip` tinyint(1) NOT NULL,
  `aprobada` tinyint(1) NOT NULL,
  `rechazada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id`, `tipo_id`, `estado_id`, `usuario_id`, `nombre`, `foto`, `descripcion`, `requisitos`, `fecha_alta`, `fecha_adopcion`, `vacunado`, `desparasitado`, `esterilizado`, `microchip`, `aprobada`, `rechazada`) VALUES
(1, 2, 1, 1, 'Bola de nieve', 'bola-de-nieve-60b24e9828bb3.jpg', '<p>Bola de nieve es un gato muy cari&ntilde;oso, le gusta jugar con nosotros y le encanta defender su lugar en el sof&aacute;. Adem&aacute;s, tiene la extra&ntilde;a habilidad de no tirar al suelo ninguno de los objetos de la casa.</p>\r\n<p>&nbsp;</p>', NULL, '2021-05-29', NULL, 1, 1, 1, 1, 0, 0),
(2, 1, 4, 3, 'Baxter', 'Baxter-60b24fe849efd.jpg', '<p>Baxter es un perro sociable al que le gusta perseguir cualquier tipo de pelota.</p>', NULL, '2021-05-29', NULL, 1, 1, 1, 0, 1, 0),
(3, 1, 3, 3, 'Idefix', 'Idefix-60b2509b6e54f.jpg', '<p>Idefix es un perro tan bravo como el famoso perro de Obelix, pero detr&aacute;s de toda esa bravura hay un perro cari&ntilde;oso y siempre atento a lo que necesite su due&ntilde;o.</p>', NULL, '2021-05-29', NULL, 1, 1, 1, 1, 1, 0),
(4, 1, 2, 3, 'Laika', 'Laika-60b2512414014.jpg', '<p>A Laika le gusta explorar los alrededores y cualquier cosa que est&eacute; en movimiento, a pesar de ello es una perrita muy t&iacute;mida y con problemas para acercarse a otros animales.</p>', '<p>Ser&iacute;a conveniente que el futuro propietario no tuviera otras mascotas.</p>', '2021-05-30', NULL, 1, 1, 1, 0, 1, 0),
(5, 2, 1, 3, 'Félix', 'Felix-60b251959d7b0.jpg', '<p>F&eacute;lix tiene 2 a&ntilde;os y es el gato m&aacute;s tranquilo que hemos conocido nunca. Lo que m&aacute;s le gusta es estar en la cocina ojo avizor para ver que es capaz de llevarse a la boca. Lo que m&aacute;s le gusta es el jam&oacute;n de York reci&eacute;n cortado.</p>', NULL, '2021-05-30', NULL, 1, 1, 1, 1, 1, 0),
(6, 1, 3, 4, 'Scooby Doo', 'Scooby-Doo-60b257cd56218.jpg', '<p>A diferencia del perro del que hereda el nombre, este perro tan mono no le tiene miedo a casi nada, s&oacute;lo los rayos son capaces de asustarle, no obstante, cuando esto sucede siempre se le puede encontrar en el ba&ntilde;o m&aacute;s cercano, escondido detr&aacute;s de la pila.</p>', '<p>Un lugar con buen clima en donde no haya tormentas</p>', '2021-05-30', NULL, 1, 1, 1, 1, 1, 0),
(7, 2, 1, 4, 'Gardfield', 'Gardfield-60b2581191ddb.jpg', '<p>Al igual que el gato original, a nuestro Gardfield le encanta comer lasagna, bueno y cualquier cosa que caiga entre sus zarpas.</p>', NULL, '2021-05-29', NULL, 1, 1, 1, 1, 1, 0),
(8, 2, 1, 4, 'Silvestre', 'Silvestre-60b25890d08f3.jpg', '<p>Un gato con todas las letras de la palabra, siempre va a la suya y hace lo que le da la gana, por ello su instinto natural est&aacute; intacto y lo convierte en un buen cazador. Ideal para los lugares donde aparezcan muchas ratas y ratones.</p>', NULL, '2021-05-29', NULL, 1, 1, 0, 1, 1, 0),
(9, 1, 1, 4, 'Snoopy', 'Snoopy-60b258d866bf0.jpg', '<p>Fiel amigo y a diferencia del Snoopy original, a este perro no le gusta pasarse el dia vagueando. Cada vez que sale a pasear es capaz de revolucionar al resto de perros.</p>', NULL, '2021-05-29', NULL, 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `autor_id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cuerpo` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publicada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resumen` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`id`, `estado_id`, `autor_id`, `titulo`, `cuerpo`, `foto`, `publicada`, `resumen`) VALUES
(1, 2, 4, 'El fin de las razas potencialmente peligrosas', '<p class=\"MsoNormal\" style=\"line-height: 21.0pt; mso-outline-level: 2; margin: 12.0pt 0cm 0cm 0cm;\"><span style=\"font-size: 15.0pt; font-family: \'Times New Roman\',serif; mso-fareast-font-family: \'Times New Roman\'; color: black; mso-fareast-language: ES;\">El Ejecutivo quiere evitar prejuicios &ldquo;injustos&rdquo; sobre detemrinados ejemplares. La Ley obliga a los due&ntilde;os no tener antecedentes penales y aportar un certificado de aptitud psicol&oacute;gica</span></p>\r\n<p class=\"MsoNormal\" style=\"line-height: 21.0pt; mso-outline-level: 2; margin: 12.0pt 0cm 0cm 0cm;\">&nbsp;</p>\r\n<p style=\"margin: 0cm;\"><span style=\"font-size: 13.5pt; color: black;\">Los due&ntilde;os de perros como Pitbulls o Rottweilers est&aacute;n obligados por ley a no haber sido condenados por homicidio, lesiones, tortuta, la libertad sexual o la salud p&uacute;blica, entre otros delitos, pero todo apunta a que pronto dejar&aacute; de ser as&iacute;.&nbsp;<strong>Estas razas son consideradas como peligrosas</strong>, por lo que su tenencia debe cumplir las normas establecidas en la&nbsp;<strong>Ley 50/1999, de 23 de diciembre, sobre el R&eacute;gimen Jur&iacute;dico de la Tenencia de Animales Potencialmente Peligrosos</strong>. Ahora, el Gobierno quiere presentar el pr&oacute;ximo mes de mayo un anteproyecto de ley que&nbsp;<strong>acabe con la &ldquo;lista negra&rdquo; de razas peligrosas.</strong>&nbsp;En su defecto, esta clasificaci&oacute;n se determinar&aacute; en base al comportamiento individual de cada animal sin tener en cuenta &ldquo;la raza concreta con la que ha nacido&rdquo;.</span></p>\r\n<p style=\"margin: 18.0pt 0cm 0cm 0cm;\"><span style=\"font-size: 13.5pt; color: black;\">La medida busca&nbsp;<strong>evitar prejuicios &ldquo;injustos&rdquo;</strong>&nbsp;sobre determinados ejemplares. Para ello, la norma establecer&aacute; un mecanismo de valizaci&oacute;n de comportamiento de cada ejemplar y prev&eacute; que aquellos animales que necesiten un &ldquo;manejo particular&rdquo; se deben adiestrar con t&eacute;cnicas de mejora de comportamiento para que dejen de ser peligrosos, seg&uacute;n ha explicado el director general de Derechos Animales del Gobierno, Sergio Garc&iacute;a Torres, durante la &lsquo;I Jornada Pol&iacute;tica&rsquo; organizada por la Real Sociedad Canina Espa&ntilde;ola (RSCE).</span></p>\r\n<p style=\"margin: 18.0pt 0cm 0cm 0cm;\"><span style=\"font-size: 13.5pt; color: black;\">Por su parte, la RSCE propuso el desarrollo de una nueva ley que incluya la&nbsp;<strong>identificaci&oacute;n universal de perros, educaci&oacute;n de ni&ntilde;os y j&oacute;venes en valores que fomenten el respeto y la empat&iacute;a animal</strong>, protecci&oacute;n y fomento de razas aut&oacute;ctonas y reconocimiento al trabajo de criadores &eacute;ticos y responsables para acabar con el abandono de los animales.</span></p>\r\n<p style=\"margin: 18.0pt 0cm 0cm 0cm;\"><strong><span style=\"font-size: 13.5pt; color: black;\">Tener un perro potencialmente peligroso implica que durante el paseo en lugares p&uacute;blicos el due&ntilde;o debe llevar consigo la licencia administrativa&nbsp;</span></strong><span style=\"font-size: 13.5pt; color: black;\">y la certificaci&oacute;n que acredite la inscripci&oacute;n del animal en el Registro Municipal de animales potencialmente peligrosos. Adem&aacute;s, los perros deben llevar obligatoriamente un&nbsp;<strong>bozal&nbsp;</strong>adaptado a su raza, estar atados con cadena o correa no extensible de al menos dos metros y no se permite llevar m&aacute;s de uno de estos perros por persona.</span></p>', 'noticia-4-60b25bff37e0c.webp', '2021-05-19', 'El Ejecutivo quiere evitar prejuicios &ldquo;injustos&rdquo; sobre detemrinados ejemplares. La Ley obliga a los due&ntilde;os no tener antecedentes penales y aportar un certificado de aptitud psicol&oacute;gica\r\n&nbsp;\r\nLos due&ntilde;os de perros como Pi'),
(2, 2, 3, 'Terapia con perros para agilizar la recuperación', '<h2 style=\"margin-top: 12.0pt; line-height: 21.0pt;\"><strong><span style=\"font-size: 15.0pt; color: black;\">La Fundaci&oacute;n Affinity ha puesto en marcha una prueba piloto que demuestra los beneficios del trabajo con estos animales para mejorar los v&iacute;nculos y la relaci&oacute;n entre padres y menores bajo tutela de la DGAIA</span></strong></h2>\r\n<p class=\"MsoNormal\">&nbsp;</p>\r\n<p style=\"margin: 0cm;\"><span style=\"font-size: 13.5pt; color: black;\">Pipa, Solet, Darwen y Bruc est&aacute;n listos para empezar la sesi&oacute;n de esta semana. Estos cuatro perros, todos ellos recogidos tras haber vivido situaciones dif&iacute;ciles, participan desde el mes de octubre en CRAE Parental, una terapia pionera impulsada por la Fundaci&oacute;n Affinity con el objetivo de mejorar el v&iacute;nculo entre los padres, que han perdido la custodia de sus hijos, normalmente por negligencia, y sus hijos tutelados por la Generalitat de Catalu&ntilde;a.</span></p>\r\n<p style=\"margin: 18.0pt 0cm 0cm 0cm;\"><span style=\"font-size: 13.5pt; color: black;\">La actividad de esta semana, en la que participan, adem&aacute;s de los perros, 12 adultos -principalmente madres- y 10 ni&ntilde;os tutelados de entre 6 y 15 a&ntilde;os, consiste en llevar a cabo un ejercicio que se conoce como Agility, en el que los progenitores deben intentar que el animal complete un circuito con obst&aacute;culos siguiendo sus indicaciones. &ldquo;A trav&eacute;s de este ejercicio se pretende que los padres trabajen la organizaci&oacute;n que han de tener aquellos d&iacute;as en que sus hijos van a poder estar con ellos&rdquo;, explica Maribel Vila, encargada de Terapias Asistidas de Fundaci&oacute;n Affinity, quien, en alternancia con una pedagoga, dirige las sesiones junto con una educadora del centro.</span></p>\r\n<p style=\"margin: 18.0pt 0cm 0cm 0cm;\"><span style=\"font-size: 13.5pt; color: black;\">En definitiva, tal y como se&ntilde;ala Vila, se trata de &ldquo;<strong>hacer una radiograf&iacute;a de c&oacute;mo estos padres act&uacute;an en la vida a trav&eacute;s de lo que hacen con los perros&rdquo;</strong>, los cuales, por su car&aacute;cter y forma de ser, permiten trabajar diferentes aspectos de lo que ser&iacute;a la relaci&oacute;n entre padres e hijos tutelados. Pipa es una perra peque&ntilde;a, de unos 7 kilos, &ldquo;que hace de todo, pero para ello has de darle un mensaje claro, con lo cual es ideal para trabajar con aquellas personas que no son claras a la hora de hablar y dar indicaciones&rdquo;, comenta Vila. Por su parte, Solet, una labradora hiperafectiva, es muy adecuada para tomar conciencia de lo importante que es &ldquo;hablar bien, dirigirse al otro de forma calmada y con respeto&rdquo;; mientras que Darwen &ldquo;es una perra muy lista, que hace todo lo que se le dice de forma inmediata, por lo que es ideal para trabajar con personas inseguras&rdquo;.</span></p>\r\n<p style=\"margin: 18.0pt 0cm 0cm 0cm;\"><span style=\"font-size: 13.5pt; color: black;\">Por &uacute;ltimo, Bruc es un Border Collie &ldquo;al que le encanta que le toquen, pero que no soporta las actitudes invasivas, lo cual nos permite hacer que los padres tomen conciencia de que, a veces, el lenguaje corporal es m&aacute;s intenso de lo que creen, por lo que no es conveniente recurrir a una expresi&oacute;n f&iacute;sica tan potente&rdquo;, explica Vila, quien adem&aacute;s recuerda que &ldquo;al ser todos ellos perros recogidos, con experiencias duras y desagradables a sus espaldas, sirven tambi&eacute;n para lanzar el mensaje a los padres de que hay segundas oportunidades y es posible reconducir la situaci&oacute;n&rdquo;.</span></p>\r\n<p style=\"margin: 18.0pt 0cm 0cm 0cm;\"><span style=\"font-size: 13.5pt; color: black;\">En definitiva, esta actividades, como todas las que se celebran semanalmente en el contexto del programa CRAE Parental, busca&nbsp;<strong>&ldquo;mejorar las posibilidades de que esos padres puedan recuperar la custodia de sus hijos, que ahora est&aacute; en manos de la DGAIA, lo antes posible o, al menos, puedan mejorar sus v&iacute;nculos y relaciones con ellos</strong>&rdquo;, explica Maribel Vila, quien al respecto comenta que &ldquo;los animales hacen como de espejo en el que los padres se pueden ver reflejados en lo que se refiere a c&oacute;mo es su relaci&oacute;n y comunicaci&oacute;n con los hijos&rdquo;. Y es que como apunta la encargada de Terapias Asistidas de la Fundaci&oacute;n Affinity, &ldquo;<strong>educar perros tiene mucho que ver con educar a ni&ntilde;os</strong>&rdquo;.</span></p>\r\n<p class=\"MsoNormal\">&nbsp;</p>', 'noticia-3-60b25da0b296d.webp', '2021-05-19', 'La Fundaci&oacute;n Affinity ha puesto en marcha una prueba piloto que demuestra los beneficios del trabajo con estos animales para mejorar los v&iacute;nculos y la relaci&oacute;n entre padres y menores bajo tutela de la DGAIA\r\n&nbsp;\r\nPipa, Solet, Darwe'),
(3, 2, 3, 'Los perros pueden detectar la Covid-19 con un 94% de precisión', '<p class=\"MsoNormal\"><span style=\"font-size: 13.5pt; line-height: 107%; color: #161616;\">Los perros biodetectores pueden identificar el olor de la&nbsp;</span><a title=\"covid-19\" href=\"https://www.informacion.es/tags/covid-19/\"><span style=\"font-size: 13.5pt; line-height: 107%; color: #84194c; border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">covid-19</span></a><span style=\"font-size: 13.5pt; line-height: 107%; color: #161616;\">&nbsp;con&nbsp;<strong><span style=\"font-family: \'Calibri\',sans-serif; mso-ascii-theme-font: minor-latin; mso-hansi-theme-font: minor-latin; mso-bidi-font-family: \'Times New Roman\'; mso-bidi-theme-font: minor-bidi; border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">una tasa de precisi&oacute;n de hasta el 94 %,&nbsp;</span></strong>seg&uacute;n un estudio preliminar de la asociaci&oacute;n brit&aacute;nica Medical Detection Dogs publicado este lunes.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"font-size: 13.5pt; line-height: 107%; color: #161616;\">&nbsp;</span><span style=\"font-size: 13.5pt; color: #161616;\">Los resultados iniciales, a&uacute;n pendientes de&nbsp;<strong><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">revisi&oacute;n externa por parte de otros cient&iacute;ficos,&nbsp;</span></strong>apuntan que los&nbsp;</span><a title=\"perros\" href=\"https://www.informacion.es/tags/perros/\"><span style=\"font-size: 13.5pt; color: #84194c; border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">perros</span></a><span style=\"font-size: 13.5pt; color: #161616;\"> fueron capaces de identificar la enfermedad en el 94 % de los casos, una precisi&oacute;n superior a la que ofrecen las pruebas de ant&iacute;genos, de entre el 58 y el 77 %.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"color: #161616; font-size: 13.5pt;\">El estudio preliminar refleja, adem&aacute;s, que un solo perro puede examinar hasta 250 personas en una hora, considerablemente m&aacute;s r&aacute;pido que&nbsp;</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">el resto de m&eacute;todos de detecci&oacute;n de la covid-19</span></strong><span style=\"color: #161616; font-size: 13.5pt;\">, apuntan los expertos.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"color: #161616; font-size: 13.5pt;\">La investigaci&oacute;n indica que los perros entrenados podr&iacute;an ser de gran ayuda como una primera herramienta de detecci&oacute;n r&aacute;pida en espacios p&uacute;blicos, como aeropuertos, si se utilizaran junto con m&eacute;todos tradicionales, como las</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">&nbsp;pruebas PCR,&nbsp;</span></strong><span style=\"color: #161616; font-size: 13.5pt;\">para confirmar los resultados.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"color: #161616; font-size: 13.5pt;\">\"Saber que podemos aprovechar el asombroso poder de la nariz de un perro para detectar la covid-19 de forma r&aacute;pida y no invasiva nos da la esperanza de volver a una forma de vida m&aacute;s normal\", asegura en un comunicado Claire Guest, directora cient&iacute;fica de</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">&nbsp;Medical Detection Dogs&nbsp;</span></strong><span style=\"color: #161616; font-size: 13.5pt;\">y autora principal del ensayo.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"color: #161616; font-size: 13.5pt;\">En el estudio, los perros -</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">cuatro Labradores, un Golden Retriever y un Working Cocker Spaniel</span></strong><span style=\"color: #161616; font-size: 13.5pt;\">- olfateaban muestras en un sistema de soportes que requer&iacute;a una decisi&oacute;n de \"s&iacute; o no\" en cada caso.</span></p>\r\n<p class=\"MsoNormal\"><span style=\"color: #161616; font-size: 13.5pt;\">Si identificaban presencia de covid-19, los perros daban indicaciones como&nbsp;</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">sentarse, empujar o mirar fijamente hacia delante,&nbsp;</span></strong><span style=\"color: #161616; font-size: 13.5pt;\">y si acertaban, recib&iacute;an como recompensa comida o juguetes.&nbsp;</span></p>', 'noticia-1-60b25e08c7439.jpg', '2021-05-20', 'Los perros biodetectores pueden identificar el olor de la&nbsp;covid-19&nbsp;con&nbsp;una tasa de precisi&oacute;n de hasta el 94 %,&nbsp;seg&uacute;n un estudio preliminar de la asociaci&oacute;n brit&aacute;nica Medical Detection Dogs publicado este lun'),
(4, 1, 3, 'Gatos: ¿Sabes cómo se comunican contigo?', '<h2 style=\"margin-top: 0cm; line-height: 20.25pt;\"><span style=\"font-size: 16.5pt; color: #161616;\">Nuestros compa&ntilde;eros felinos tienen muchas formas de expresarse con nosotros y, a veces, pasan desapercibidas por su sutileza</span></h2>\r\n<p>&nbsp;</p>\r\n<p><span style=\"color: #161616; font-size: 13.5pt;\">Solo quien ha tenido la suerte de convivir con un gato sabe lo que significa realmente disfrutar de su compa&ntilde;&iacute;a. Y es que los felinos&nbsp;</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">arrastran mala fama&nbsp;</span></strong><span style=\"color: #161616; font-size: 13.5pt;\">y muchas</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">&nbsp;leyendas urbanas</span></strong><span style=\"color: #161616; font-size: 13.5pt;\"> detr&aacute;s debido a su continua comparaci&oacute;n con los perros. S&iacute;, puede que su comportamiento sea distinto, que son independientes y no reclaman tanta atenci&oacute;n continua, pero, &iquest;qu&eacute; cosas sabemos y no sabemos sobre los gatos? &iquest;Sabemos interpretar los mensajes que estos nos mandan cuando est&aacute;n preocupados, tienen miedo o quieren darnos cari&ntilde;o?</span><span style=\"color: #161616; font-size: 13.5pt;\">Aqu&iacute; tienes algunas de las curiosidades sobre los gatos que te ayudar&aacute;n a</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">&nbsp;interpretar sus gestos, su lenguaje con los humanos</span></strong><span style=\"color: #161616; font-size: 13.5pt;\">&nbsp;y a conocer</span><strong style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">&nbsp;algunos datos curiosos</span></strong><span style=\"color: #161616; font-size: 13.5pt;\">&nbsp;sobre estos animales.</span></p>\r\n<p>&nbsp;</p>\r\n<h2 style=\"margin: 28.5pt 0cm 28.5pt 0cm;\"><span style=\"font-size: 21.0pt; line-height: 107%; color: #161616;\">Cuando saludan</span></h2>\r\n<p style=\"margin: 28.5pt 0cm 28.5pt 0cm;\"><strong>Los gatos se saludan entre ellos rozando su nariz: Si te despiertan as&iacute; por la ma&ntilde;ana lo m&aacute;s seguro es que te est&eacute;n dando los buenos d&iacute;as. Adem&aacute;s, &iquest;te has fijado en como mantienen la<span style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">&nbsp;cola erguida&nbsp;</span></span><span style=\"color: #161616; font-size: 13.5pt;\">cuando abres la puerta de casa y est&aacute;n ah&iacute;, esper&aacute;ndote? Significa que est&aacute;n muy contentos de verte, &iexcl;por fin! Y es que, a pesar de la fama que puedan tener, a los gatos no les gusta nada estar solos y</span><span style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">&nbsp;son</span></span><span style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\"> mu</span><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">y </span></span><span style=\"color: #161616; font-size: 13.5pt;\"><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">familiares</span></span><span style=\"color: #161616; font-size: 13.5pt;\">&nbsp;(por eso aprovechan cada momento contigo cuando est&aacute;s en casa). Eso s&iacute;, si la mueven de un lado a otro insistentemente con cara de malas pulgas mejor que lo dejes tranquilo, porque algo le est&aacute; molestando.</span></strong></p>\r\n<p>&nbsp;</p>\r\n<h2 style=\"margin: 28.5pt 0cm 28.5pt 0cm;\"><span style=\"font-size: 21.0pt; line-height: 107%; color: #161616;\">Cuando te lamen</span></h2>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-size: 13.5pt; color: #161616;\">Los gatos son animales especialmente&nbsp;<strong><span style=\"border: none windowtext 1.0pt; mso-border-alt: none windowtext 0cm; padding: 0cm;\">cuidadosos con la higiene y la limpieza</span></strong>. Si alguna vez tu gato ha aprovechado el \"momento sof&aacute; y peli\" para lamerte de arriba a abajo has de saber que, en realidad, te est&aacute; dando una ducha.</span></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'noticia-2-60b25e54db758.jpg', '2021-05-29', 'Nuestros compa&ntilde;eros felinos tienen muchas formas de expresarse con nosotros y, a veces, pasan desapercibidas por su sutileza\r\n&nbsp;\r\nSolo quien ha tenido la suerte de convivir con un gato sabe lo que significa realmente disfrutar de su compa&ntilde;&iacute;a. Y es ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_mascota`
--

CREATE TABLE `tipo_mascota` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_mascota`
--

INSERT INTO `tipo_mascota` (`id`, `tipo`) VALUES
(1, 'Perro'),
(2, 'Gato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poblacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provincia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_alta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reiniciar_password` tinyint(1) NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `poblacion`, `provincia`, `password`, `activo`, `email`, `telefono`, `fecha_alta`, `reiniciar_password`, `direccion`, `rol`, `login`) VALUES
(1, 'José Luis', 'Callosa d\'en Sarrià', 'Alicante', '$2y$12$sNo6k996JKVrcExru99Be.nDpk9XsbUQIzaku5hSkbP/AOKmeDFXG', 1, 'jlpb@email.com', '666000660', '2021-05-29', 0, NULL, 'ROLE_PARTICULAR', 'jlpb@email.com'),
(2, 'Ana', 'Altea', 'Alicante', '$2y$12$sozpWOjy2V37henFiWft2u43H6p/25jL6gu25xTZpCt73ZTQ9/o0.', 1, 'apb@email.com', '666000661', '2021-05-29', 0, NULL, 'ROLE_PARTICULAR', 'apb@email.com'),
(3, 'Animals Benidorm', 'Benidorm', 'Alicante', '$2y$12$7T.3EF97HdgvIW/Q5hpjxOAuPLeDZc3As/fBRVFw1YOaOzHHINI/u', 1, 'protectora@animalsbenidorm.daw', '666000662', '2021-05-29', 0, 'www.animalsbenidorm.daw', 'ROLE_PROTECTORA', 'protectora@animalsbenidorm.daw'),
(4, 'Animals Valencia', 'Valencia', 'Valencia', '$2y$12$6QWoi.ENjI7CxyOX7VEmhO/0KzvzETn4XlbavCRe1p/PBjHxdWNWO', 1, 'protectora@animalsvalencia.daw', '666000663', '2021-05-29', 0, 'www.animalsvalencia.daw', 'ROLE_PROTECTORA', 'protectora@animalsvalencia.daw');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `estado_mascota`
--
ALTER TABLE `estado_mascota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_noticia`
--
ALTER TABLE `estado_noticia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_11298D77A9276E6C` (`tipo_id`),
  ADD KEY `IDX_11298D779F5A440B` (`estado_id`),
  ADD KEY `IDX_11298D77DB38439E` (`usuario_id`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_31205F969F5A440B` (`estado_id`),
  ADD KEY `IDX_31205F9614D45BBE` (`autor_id`);

--
-- Indices de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estado_mascota`
--
ALTER TABLE `estado_mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_noticia`
--
ALTER TABLE `estado_noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_mascota`
--
ALTER TABLE `tipo_mascota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `FK_11298D779F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_mascota` (`id`),
  ADD CONSTRAINT `FK_11298D77A9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_mascota` (`id`),
  ADD CONSTRAINT `FK_11298D77DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `FK_31205F9614D45BBE` FOREIGN KEY (`autor_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_31205F969F5A440B` FOREIGN KEY (`estado_id`) REFERENCES `estado_noticia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
