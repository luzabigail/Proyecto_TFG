-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2026 a las 00:32:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `filmtoread`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `valoracion` int(11) DEFAULT NULL CHECK (`valoracion` between 1 and 5),
  `texto` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_material`, `usuario`, `valoracion`, `texto`, `fecha`) VALUES
(1, 31, 'Diego', 5, 'Buena recomendación!', '2026-01-18 01:08:41'),
(2, 25, 'Diego', 5, 'Estupendo!!!', '2026-01-18 01:44:49'),
(3, 25, 'Luz ', 5, 'Maravillosa pelicula!', '2026-01-18 14:21:15'),
(5, 25, 'Ramona', 3, 'No me gustó demasiado el libro, la peli es de mis favoritas pero el libro me pareció demasiado largo. Igualmente era entretenido. ', '2026-01-18 14:34:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guardados`
--

CREATE TABLE `guardados` (
  `usuario` varchar(50) NOT NULL,
  `id_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `guardados`
--

INSERT INTO `guardados` (`usuario`, `id_material`) VALUES
('Diego', 27),
('Diego', 5),
('Diego', 26),
('Luz ', 19),
('Luz ', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `anio` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `sinopsis` text DEFAULT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id`, `tipo`, `anio`, `titulo`, `autor`, `sinopsis`, `imagen`) VALUES
(1, 'Libro', 2022, 'El Mapa de los Anhelos', 'Alice Kellen', 'Grace Peterson vive sumergida en el duelo tras perder a su hermana Lucy. Su vida cambia cuando recibe \"El mapa de los anhelos\", un juego póstumo diseñado por Lucy para obligarla a salir de su caparazón. En este viaje de autodescubrimiento conoce a Will Tucker. Juntos enfrentan sus heridas en una historia conmovedora sobre la superación, el amor propio y la importancia de encontrar un propósito tras la tragedia.', 'imagenes/romance/1RN.jpg'),
(2, 'Película', 2014, 'Bajo la misma estrella', 'Josh Boone', 'Hazel y Augustus son dos adolescentes que comparten un vínculo especial: ambos padecen cáncer. Su relación nace en un grupo de apoyo y se fortalece a través de la literatura y el humor negro. Deciden viajar a Ámsterdam para conocer al autor de su libro favorito, enfrentando la fragilidad de la existencia. Es un relato valiente sobre el amor juvenil y la búsqueda de sentido ante la inevitabilidad de la muerte.', 'imagenes/romance/1RP.jpg'),
(3, 'Libro', 2017, 'Los siete maridos de Evelyn Hugo', 'Taylor Jenkins Reid', 'La mítica estrella de cine Evelyn Hugo decide contar su verdadera historia. Para ello, elige a la periodista Monique Grant. Evelyn relata su ascenso al estrellato y la verdad tras sus siete maridos, ocultando un secreto sobre su único amor verdadero. La novela recorre décadas de glamour y sacrificios en Hollywood, explorando la identidad y el precio de la fama en una industria implacable con la vida privada.', 'imagenes/romance/2RN.jpg'),
(4, 'Película', 2022, 'Babylon', 'Damien Chazelle', 'Ambientada en el Hollywood de los años 20, esta obra retrata la transición del cine mudo al sonoro. A través de personajes ambiciosos que buscan la fama, la película muestra una era de excesos, decadencia y sueños rotos. Con una puesta en escena frenética, captura el caos de la industria cinematográfica naciente. Es un homenaje crudo a la magia del cine y a quienes sacrificaron todo por formar parte de su historia.', 'imagenes/romance/2RP.jpg'),
(5, 'Libro', 2000, 'El duque y yo', 'Julia Quinn', 'Daphne Bridgerton y el rebelde Duque de Hastings pactan un falso noviazgo para beneficio mutuo: ella busca atraer pretendientes y él quiere evitar las presiones matrimoniales de la alta sociedad londinense. Sin embargo, la atracción real no tarda en surgir, desafiando sus propios planes. Enmarcada en la elegante época de la Regencia, la historia combina romance, secretos familiares y las estrictas convenciones sociales de la aristocracia británica.', 'imagenes/romance/3RN.jpg'),
(6, 'Película', 2005, 'Orgullo y prejuicio', 'Joe Wright', 'Elizabeth Bennet, inteligente e independiente, choca con el arrogante Sr. Darcy en la Inglaterra rural del siglo XIX. Mientras su familia busca matrimonios ventajosos, Elizabeth desafía las normas sociales. Ambos deben superar sus prejuicios y orgullo personal para reconocer sus verdaderos sentimientos. Es una crítica social satírica y brillante sobre la familia, la posición económica y la evolución de un amor que requiere honestidad y redención mutua.', 'imagenes/romance/3RP.jpg'),
(7, 'Libro', 2010, 'El camino de los reyes', 'Brandon Sanderson', 'En el mundo de Roshar, las \"Altas Tormentas\" moldean la vida. Kaladin, un soldado convertido en esclavo; Dalinar, un príncipe con visiones; y Shallan, una joven erudita, cruzan sus destinos en medio de una guerra interminable. Mientras fuerzas ancestrales despiertan, los personajes deben descubrir los secretos de los Caballeros Radiantes. Es una epopeya de fantasía monumental sobre el honor, la redención y la lucha por salvar una civilización en decadencia.', 'imagenes/fantasia/1FN.jpg'),
(8, 'Película', 2001, 'El señor de los anillos: La comunidad del anillo', 'Peter Jackson', 'El joven hobbit Frodo Bolsón hereda el Anillo Único, un objeto de poder absoluto creado por el Señor Oscuro Sauron. Acompañado por una compañía de elfos, enanos, hombres y magos, Frodo debe viajar al Monte del Destino para destruirlo. Es una lucha épica entre el bien y el mal que define la fantasía heroica, resaltando el valor de los pequeños ante la adversidad y la fuerza de la amistad.', 'imagenes/fantasia/1FP.jpg'),
(9, 'Libro', 2015, 'Seis de cuervos', 'Leigh Bardugo', 'Kaz Brekker reúne a un equipo de seis parias para un atraco imposible: infiltrarse en la Corte de Hielo y rescatar a un científico. Cada miembro del grupo tiene habilidades únicas y un pasado traumático. En un mundo de magia Grisha y mafias portuarias, deberán confiar los unos en los otros para sobrevivir. Es una historia de acción trepidante donde la lealtad es un arma tan peligrosa como el acero.', 'imagenes/fantasia/2FN.jpg'),
(10, 'Película', 2023, 'Dragones y mazmorras: Honor entre ladrones', 'John Francis Daley', 'Un carismático ladrón y un grupo de aventureros emprenden un robo épico para recuperar una reliquia perdida, pero las cosas se complican al enfrentarse a enemigos poderosos. Ambientada en el universo de Dungeons & Dragons, la película mezcla acción fantástica con un humor refrescante. El grupo aprenderá que, a pesar de sus fracasos previos, la redención y la familia se encuentran en la lucha compartida por el bien común.', 'imagenes/fantasia/2FP.jpg'),
(11, 'Libro', 2006, 'Elliot Tomclyde', 'Joaquin Londaiz', 'Elliot Tomclyde descubre que posee habilidades mágicas y es trasladado a un mundo oculto lleno de maravillas y peligros. Mientras entrena sus poderes, una amenaza antigua resurge para romper el equilibrio elemental. Elliot y sus amigos deberán resolver enigmas y enfrentar pruebas de valor para proteger su nuevo hogar. Es una aventura de crecimiento que invita a creer en lo extraordinario oculto tras la realidad cotidiana.', 'imagenes/fantasia/3FN.jpg'),
(12, 'Película', 2001, 'Harry Potter y la piedra filosofal', 'Chris Columbus', 'Harry Potter descubre en su undécimo cumpleaños que es un mago. Al ingresar en Hogwarts, conoce un mundo de magia, amistad y peligros. Junto a Ron y Hermione, investiga el misterio de la Piedra Filosofal mientras descubre su conexión con Lord Voldemort, el mago oscuro que mató a sus padres. Es el inicio de una saga icónica sobre el coraje, la lealtad y el descubrimiento del propio destino.', 'imagenes/fantasia/3FP.jpg'),
(13, 'Libro', 2020, 'Un payaso en el maizal', 'Adam Cesare', 'En una ciudad obsesionada con la tradición, un payaso asesino comienza una matanza de adolescentes que no respetan las normas locales. Quinn Maybrook se ve atrapada en medio de este horror mientras los campos de maíz se tiñen de sangre. Es un slasher moderno que critica la brecha generacional y el fanatismo social, ofreciendo tensión constante y una visión brutal de los secretos ocultos bajo pueblos aparentemente perfectos.', 'imagenes/terror/1TN.jpg'),
(14, 'Película', 1997, 'Sé lo que hicisteis el último verano', 'Jim Gillespie', 'Cuatro amigos encubren un atropello mortal durante una noche de graduación. Un año después, una nota anónima les revela que alguien conoce su secreto. Un asesino con un garfio empieza a cazarlos uno a uno en busca de venganza. Es un referente del terror juvenil de los 90 que explora la culpa, las consecuencias de los actos impulsivos y el terror de enfrentar un pasado que se niega a morir.', 'imagenes/terror/1TP.jpg'),
(15, 'Libro', 2023, 'Cómo vender una casa embrujada', 'Grady Hendrix', 'Dos hermanos distanciados deben unirse para vender la casa de su difunta madre. Al llegar, descubren que la propiedad alberga una presencia maligna vinculada a los extraños muñecos de su madre. Para sobrevivir, deberán enfrentar traumas familiares y secretos oscuros del pasado. La historia mezcla el terror sobrenatural con el drama psicológico, mostrando que los monstruos más temibles a menudo nacen en el núcleo familiar.', 'imagenes/terror/2TN.jpg'),
(16, 'Película', 1973, 'El exorcista', 'William Friedkin', 'Regan, una niña de doce años, comienza a mostrar comportamientos violentos y aterradores que la medicina no puede explicar. Su madre recurre a la Iglesia, donde dos sacerdotes enfrentan una posesión demoníaca mediante un exorcismo agotador. Obra cumbre del cine de terror, destaca por su atmósfera opresiva y su lucha entre la fe y el mal. Es un relato perturbador sobre la pérdida de la inocencia y el poder de lo demoníaco.', 'imagenes/terror/2TP.jpg'),
(17, 'Libro', 1983, 'Cementerio de animales', 'Stephen King', 'Louis Creed descubre un cementerio de mascotas cerca de su nuevo hogar que tiene el poder de resucitar a los muertos. Tras una tragedia familiar, Louis ignora las advertencias y utiliza el terreno para recuperar a su ser querido, desatando consecuencias fatales. Es una historia sombría sobre el duelo patológico y el miedo a la muerte, demostrando que jugar con las leyes de la naturaleza solo atrae un horror inimaginable.', 'imagenes/terror/3TN.jpg'),
(18, 'Película', 2018, 'Hereditary', 'Ari Aster', 'Tras la muerte de su matriarca, la familia Graham comienza a desentrañar secretos oscuros sobre su linaje. Sucesos inexplicables y tragedias brutales llevan a Annie a descubrir un culto demoníaco que ha planeado el destino de sus hijos durante generaciones. Es un ejercicio maestro de terror psicológico que explora el trauma intergeneracional y la falta de control sobre el destino, culminando en un horror inevitable y perturbador.', 'imagenes/terror/3TP.jpg'),
(19, 'Libro', 1946, 'El hombre en busca de sentido', 'Viktor Frankl', 'Viktor Frankl relata su supervivencia en los campos de concentración nazis desde una perspectiva psiquiátrica. Analiza cómo la búsqueda de un sentido vital permitió a algunos prisioneros resistir las peores atrocidades. A partir de esta experiencia, Frankl desarrolla la logoterapia, defendiendo que la motivación humana principal es encontrar un propósito. Es un testimonio poderoso sobre la libertad interior y la capacidad de resistencia del espíritu humano ante el sufrimiento extremo.', 'imagenes/belica/1BN.jpg'),
(20, 'Película', 2016, 'Hasta el último hombre', 'Mel Gibson', 'Desmond Doss se alista en el ejército durante la Segunda Guerra Mundial decidido a salvar vidas como médico sin portar armas. Tras sufrir maltratos por sus convicciones religiosas, demuestra su heroísmo en la batalla de Okinawa, donde rescata a 75 soldados bajo fuego enemigo sin disparar una sola bala. Basada en una historia real, la película resalta el valor moral y la fuerza de las convicciones en medio del caos bélico.', 'imagenes/belica/1BP.jpg'),
(21, 'Libro', 2024, 'Prohibida en Normandía', 'Rosario Raro', 'Martha Gellhorn, valiente corresponsal de guerra, desafía las prohibiciones militares para cubrir el desembarco de Normandía. Disfrazada de enfermera, se convierte en testigo directo del Día D, luchando por el derecho a informar en un mundo dominado por hombres. La novela rescata el papel fundamental de las mujeres periodistas en el conflicto bélico, narrando una historia de determinación, valentía y compromiso inquebrantable con la verdad histórica.', 'imagenes/belica/2BN.jpg'),
(22, 'Película', 2018, 'La corresponsal', 'Matthew Heineman', 'La película retrata la peligrosa carrera de Marie Colvin, una de las corresponsales de guerra más famosas. Marie arriesgó su vida en los conflictos más devastadores para dar voz a las víctimas civiles, enfrentándose a traumas personales y peligros constantes. Es un retrato crudo sobre el periodismo de guerra y el sacrificio necesario para mostrar al mundo las realidades más humanas y terribles de los enfrentamientos armados modernos.', 'imagenes/belica/2BP.jpg'),
(23, 'Libro', 1959, 'El día más largo', 'Cornelius Ryan', 'Crónica épica del 6 de junio de 1944, el desembarco aliado en Normandía. Basada en cientos de entrevistas, reconstruye la operación militar desde la perspectiva de mandos estratégicos y soldados rasos de ambos bandos. Captura el caos, el heroísmo y la magnitud de la jornada que cambió el curso de la Segunda Guerra Mundial. Es un documento histórico esencial que humaniza la estrategia militar mediante relatos personales intensos y veraces.', 'imagenes/belica/3BN.jpg'),
(24, 'Película', 1998, 'Salvar al soldado Ryan', 'Steven Spielberg', 'Tras el desembarco de Normandía, un grupo de soldados recibe la misión de rescatar al paracaidista James Ryan, cuyos hermanos han muerto en combate. Mientras atraviesan territorio ocupado, los hombres cuestionan el valor de arriesgar ocho vidas por una sola. La película destaca por su hiperrealismo bélico y su profunda reflexión sobre el deber, la humanidad y el sacrificio personal en medio de la brutalidad de la guerra.', 'imagenes/belica/3BP.jpg'),
(25, 'Libro', 2015, 'Tan poca vida', 'Hanya Yanagihara', 'Cuatro amigos se mudan a Nueva York buscando el éxito profesional. Con el tiempo, la historia se centra en Jude, un hombre brillante marcado por traumas infantiles que condicionan su capacidad de relacionarse sin dolor. La novela explora la amistad masculina, la resiliencia y los límites del sufrimiento. Es una obra emocionalmente devastadora sobre cómo el pasado nos persigue y cómo el amor incondicional intenta, a veces sin éxito, sanar heridas profundas.', 'imagenes/drama/1DN.jpg'),
(26, 'Película', 1997, 'El indomable Will Hunting', 'Gus Van Sant', 'Will Hunting es un genio matemático que trabaja como conserje, ocultando su talento tras una actitud rebelde. Un psicólogo, Sean Maguire, le ayuda a enfrentar sus traumas de infancia para que pueda aprovechar su potencial. La película es un drama conmovedor sobre el miedo al fracaso, la importancia de la terapia y el valor de las conexiones humanas. Demuestra que la verdadera sabiduría nace de la valentía de conocerse y aceptarse a uno mismo.', 'imagenes/drama/1DP.jpg'),
(27, 'Libro', 2023, 'La chica que escribía historias de amor en Auschwitz', 'Siobham Curham', 'En el horror de Auschwitz, una joven prisionera escribe historias de amor y esperanza para mantener viva la dignidad de sus compañeras. Sus relatos actúan como un refugio espiritual contra la brutalidad nazi. La novela explora la fuerza de la literatura como herramienta de supervivencia y la capacidad de encontrar luz en la oscuridad absoluta. Es un homenaje a la resistencia del espíritu humano y al poder redentor de las palabras ante la barbarie.', 'imagenes/drama/2DN.jpg'),
(28, 'Película', 1997, 'La vida es bella', 'Roberto Benigni', 'Guido utiliza su imaginación y humor para proteger a su hijo pequeño en un campo de concentración nazi. Le convence de que el cautiverio es un juego complejo para ganar un tanque de verdad. Es una obra maestra que mezcla comedia y tragedia, mostrando el sacrificio supremo de un padre y el poder de la fantasía para preservar la inocencia infantil frente a la crueldad más extrema de la historia humana.', 'imagenes/drama/2DP.jpg'),
(29, 'Libro', 1992, 'El paciente inglés', 'Michael Ondaatje', 'Al final de la Segunda Guerra Mundial, una enfermera cuida de un hombre quemado en una villa italiana. El paciente relata su trágica historia de amor en el desierto del Sahara, marcada por la intriga y la traición. La narrativa entrelaza el presente de posguerra con un pasado apasionado, explorando cómo la guerra desdibuja identidades y fronteras. Es un relato lírico sobre la memoria, el deseo y la fragilidad de los vínculos humanos.', 'imagenes/drama/3DN.jpg'),
(30, 'Película', 2007, 'Expiación', 'Joe Wright', 'Briony Tallis, una niña con demasiada imaginación, lanza una acusación falsa que destruye la relación entre su hermana Cecilia y Robbie Turner. La mentira marca sus vidas mientras Robbie es enviado al frente en la Segunda Guerra Mundial. Briony dedicará su vida a buscar la expiación a través de sus escritos. Es un drama épico sobre la culpa, el perdón y el poder de la narrativa para intentar reparar errores irreversibles del pasado.', 'imagenes/drama/3DP.jpg'),
(31, 'Libro', 1951, 'Fundación', 'Isaac Asimov', 'El matemático Hari Seldon predice la caída del Imperio Galáctico y crea la Fundación para preservar el conocimiento humano y reducir una era de barbarie. Utilizando la \"psicohistoria\", la colonia científica debe sobrevivir a crisis sucesivas para guiar el futuro de la civilización. Es una obra fundacional de la ciencia ficción que analiza la sociología, la política y el destino de la humanidad a gran escala entre las estrellas.', 'imagenes/cienfi/1CN.jpg'),
(32, 'Película', 1977, 'Star Wars', 'George Lucas', 'Luke Skywalker se une a un caballero Jedi y un piloto audaz para rescatar a la princesa Leia y salvar la galaxia del Imperio Galáctico. Descubre su conexión con la Fuerza mientras lucha contra la Estrella de la Muerte. Es un viaje del héroe clásico que revolucionó el cine, explorando la libertad, el valor y la lucha eterna contra el mal en un universo lleno de naves espaciales y mística.', 'imagenes/cienfi/1CP.jpg'),
(33, 'Libro', 1989, 'Hyperion', 'Dan Simmons', 'Siete peregrinos viajan al planeta Hyperion para realizar una petición al Alcaudón, una criatura letal. Durante el viaje, comparten sus historias personales, revelando sus conexiones con el tiempo, la religión y el destino de la galaxia. Sus relatos construyen un mosaico complejo de un universo al borde de la guerra. Es una obra maestra de la ciencia ficción filosófica que explora el futuro de la inteligencia artificial y el dolor humano.', 'imagenes/cienfi/2CN.jpg'),
(34, 'Película', 2021, 'Dune', 'Denis Villeneuve', 'Paul Atreides debe viajar al desértico planeta Arrakis, la única fuente de la \"especia\", para asegurar el futuro de su familia. En medio de traiciones imperiales y gusanos de arena gigantes, Paul se une a los nativos Fremen para cumplir su destino. La película es una epopeya visual sobre la ecología, la política y la religión, narrando la lucha por el control del recurso más valioso del universo.', 'imagenes/cienfi/2CP.jpg'),
(35, 'Libro', 1968, '¿Sueñan los androides con ovejas eléctricas?', 'Philip K. Dick', 'En un futuro postapocalíptico, Rick Deckard es un policía encargado de \"retirar\" androides rebeldes llamados replicantes. Mientras los caza, comienza a cuestionar la diferencia entre humanos y máquinas y el valor de la memoria. La novela es una reflexión melancólica sobre la empatía y la deshumanización en un mundo tecnológico, planteando qué es lo que realmente nos hace humanos en una sociedad que ha perdido su conexión con la naturaleza.', 'imagenes/cienfi/3CN.jpg'),
(36, 'Película', 2023, 'Mars Express', 'Jérémie Périn', 'En el año 2200, una detective privada y un androide investigan la desaparición de una estudiante en Marte. Lo que parece un caso simple revela una conspiración tecnológica sobre el futuro de la inteligencia artificial y los derechos robóticos. Es un thriller de cine negro animado que destaca por su visión realista del futuro cercano, explorando la ética cibernética y la evolución de la conciencia en una sociedad totalmente automatizada.', 'imagenes/cienfi/3CP.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portadas`
--

CREATE TABLE `portadas` (
  `id` int(11) NOT NULL,
  `tipoBase` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `portadas`
--

INSERT INTO `portadas` (`id`, `tipoBase`, `tipo`, `imagen`) VALUES
(1, 'Principal', 'PrincipalN', 'imagenes/portada/0PPN.jpg'),
(2, 'Principal', 'PrincipalP', 'imagenes/portada/0PPP.jpg'),
(3, 'Libro', 'Romance', 'imagenes/portada/1PRN.jpg'),
(4, 'Libro', 'Fantasia', 'imagenes/portada/1PFN.jpg'),
(5, 'Libro', 'Ciencia Ficcion', 'imagenes/portada/1PCN.jpg'),
(6, 'Libro', 'Terror', 'imagenes/portada/1PTN.jpg'),
(7, 'Libro', 'Drama', 'imagenes/portada/1PDN.jpg'),
(8, 'Libro', 'Belica', 'imagenes/portada/1PBN.jpg'),
(9, 'Peli', 'Romance', 'imagenes/portada/2PRP.jpg'),
(10, 'Peli', 'Fantasia', 'imagenes/portada/2PFP.jpg'),
(11, 'Peli', 'Ciencia Ficcion', 'imagenes/portada/2PCP.jpg'),
(12, 'Peli', 'Terror', 'imagenes/portada/2PTP.jpg'),
(13, 'Peli', 'Drama', 'imagenes/portada/2PDP.jpg'),
(14, 'Peli', 'Belica', 'imagenes/portada/2PBP.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `password`, `fecha_registro`) VALUES
(1, 'Maria', 'maria@gmail.com', '$2y$10$7i1K..c437r9aS083AOb4.bTEGhnfAHgbApviiVuyLLFI7pt8CliO', '2026-01-17 12:32:02'),
(2, 'Pepe', 'pepe@gmail.com', '$2y$10$5USIMktQsaLo/Q5OJCbug.CEgM7PGPDXy9UkXSgFV5FuNszsp8KuS', '2026-01-17 12:33:42'),
(3, 'Ramona', 'ramona@gmail.com', '$2y$10$h6rh0l2SPTgf0.dyo27BLOa.NKoSseXstWb3HkMaWJFq4YKcOBUKi', '2026-01-17 12:34:37'),
(4, 'Diego', 'diego@gmail.com', '$2y$10$d.GGdxsM2EMHZuuFyUfFO.akJ8cQE5WqRf.fXSNj/gaxtYh7JS.sa', '2026-01-17 16:10:05'),
(5, 'Luz ', 'luz@gmail.com', '$2y$10$ycc6ZSPacxCINyS0boqzGOZpTN7elRfJ2XDgM9dLj3/OkMeNthOne', '2026-01-17 20:24:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_comentarios_material` (`id_material`),
  ADD KEY `idx_comentarios_usuario` (`usuario`);

--
-- Indices de la tabla `guardados`
--
ALTER TABLE `guardados`
  ADD PRIMARY KEY (`usuario`, `id_material`),
  ADD KEY `idx_guardados_material` (`id_material`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `portadas`
--
ALTER TABLE `portadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `portadas`
--
ALTER TABLE `portadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Relaciones entre tablas para asegurar integridad referencial
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_material`
    FOREIGN KEY (`id_material`) REFERENCES `material` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentarios_usuario`
    FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`)
    ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `guardados`
  ADD CONSTRAINT `fk_guardados_material`
    FOREIGN KEY (`id_material`) REFERENCES `material` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_guardados_usuario`
    FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario`)
    ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
