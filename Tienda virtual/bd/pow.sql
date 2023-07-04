-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2022 at 07:49 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pow`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `precio` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `id_producto` int(11) NOT NULL,
  `tipo_producto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ciudades`
--

CREATE TABLE `ciudades` (
  `nombre` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ciudades`
--

INSERT INTO `ciudades` (`nombre`, `id`) VALUES
('Albacete', 1),
('Alicante', 3),
('Almería', 4),
('Álava', 5),
('Asturias', 6),
('Ávila', 7),
('Badajoz', 8),
('Balears, Illes', 9),
('Barcelona', 10),
('Bizkaia', 11),
('Burgos', 12),
('Cáceres', 13),
('Cádiz', 14),
('Cantabria', 15),
('Castellón', 16),
('Ciudad Real', 17),
('Córdoba', 18),
('Coruña', 19),
('Cuenca', 20),
('Gipuzkoa', 21),
('Girona', 22),
('Granada', 23),
('Guadalajara', 24),
('Huelva', 25),
('Huesca', 26),
('Jaén', 27),
('León', 28),
('Lleida', 29),
('Lugo', 30),
('Madrid', 31),
('Málaga', 32),
('Murcia', 33),
('Navarra', 34),
('Ourense', 35),
('Palencia', 36),
('Palmas, Las', 37),
('Pontevedra', 38),
('Rioja, La', 39),
('Salamanca', 40),
('Santa Cruz de Tenerife', 41),
('Segovia', 42),
('Sevilla', 43),
('Soria', 44),
('Tarragona', 45),
('Teruel', 46),
('Toledo', 47),
('Valencia', 48),
('Valladolid', 49),
('Zamora', 50),
('Zaragoza', 51),
('Ceuta', 52),
('Melilla', 53);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `precio` double NOT NULL,
  `stock` int(11) NOT NULL,
  `tipo` text NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `stock`, `tipo`, `imagen`) VALUES
(1, 'Avengers - The Defenders', 15, 449, 'comic', 'https://pictures.abebooks.com/isbn/9781302923174-es.jpg'),
(2, 'X-Men', 15, 21, 'comic', 'https://hablandodecomics.files.wordpress.com/2012/01/portada-95-x-men.jpg?w=723'),
(3, 'the Amazing Spider-Man', 8, 2, 'comic', 'https://www.allcitycanvas.com/wp-content/uploads/2019/07/las-portadas-marvel-sinister-six.jpg'),
(4, 'Classic Spider-man', 15, 50, 'comic', 'https://cloud10.todocoleccion.online/cine-posters-carteles/tc/2018/09/29/14/134835882.jpg'),
(5, 'The Avengers - Captain America', 25, 10, 'comic', 'https://www.sddistribuciones.com/Portadas/RDSRS033167.JPG'),
(6, 'Iron-Man', 15, 24, 'comic', 'https://i.pinimg.com/originals/3d/6b/5f/3d6b5f51337e755637832a49b216d1ea.jpg'),
(7, 'The incredible hulk', 20, 14, 'comic', 'https://uvn-brightspot.s3.amazonaws.com/assets/vixes/btg/10-portadas-de-hulk-que-retratan-su-transformacion-y-doble-personalidad-4.jpg'),
(8, 'Venom', 25, 0, 'comic', 'https://www.sddistribuciones.com/Portadas/RDSRS033184.JPG'),
(9, 'Thanos', 12, 30, 'comic', 'https://3.bp.blogspot.com/-ELszfGVxOSE/WCRqtiZpndI/AAAAAAAAfbk/dmLL2cc_smkeM9QfNIGPvg2DSxXiuVoRwCLcB/s1600/tumblr_ofcxnoRkJK1qiknbco1_1280.jpg'),
(10, 'Thor', 15, 48, 'comic', 'https://i.pinimg.com/originals/9f/11/87/9f1187bf3c8b8df5f74fdc7fca4fbe04.jpg'),
(11, 'Pantera - Vulgar display of power', 15, 47, 'disco', 'https://mariskalrock.com/wp-content/uploads/2020/03/vulgar-display-of-power-pantera.jpg'),
(12, 'Metallica - Kill\'em all', 16, 50, 'disco', 'https://ep00.epimg.net/elpais/imagenes/2016/07/11/fotorrelato/1468233518_168779_1468312778_album_normal.jpg'),
(13, 'Iron Maiden - Powerslave', 20, 22, 'disco', 'https://www.nacionrock.com/wp-content/uploads/powerslave-1.jpg'),
(14, 'Iron Maiden - Fear of the dark', 25, 180, 'disco', 'https://www.nacionrock.com/wp-content/uploads/379.jpg'),
(15, 'Rammstein - lie its fur alle da', 10, 100, 'disco', 'https://mariskalrock.com/wp-content/uploads/2009/09/ram3.jpg'),
(16, 'Pantera - Cowboys from hell', 20, 24, 'disco', 'https://cuarteldelmetal.com/wp-content/uploads/2020/07/1-134.jpg'),
(17, 'Eminem - the Eminem show', 15, 50, 'disco', 'https://m.media-amazon.com/images/I/71n0xmxpw7L._SX522_.jpg'),
(18, 'BlackPink - BlackPink', 15, 33, 'disco', 'https://www.lahiguera.net/musicalia/artistas/blackpink/disco/10721/blackpink_the_album-portada.jpg'),
(19, 'La polla records - y ahora que?', 25, 28, 'disco', 'https://www.publico.es/uploads/2018/05/27/5b0ae1c58677a.jpg'),
(20, 'Avenged Sevenfold -  City of evil', 15, 20, 'disco', 'https://i.ebayimg.com/images/g/8j8AAOSwuLZY6Cm~/s-l500.jpg'),
(21, 'Pink Floyd - Dark side of the moon', 25, 24, 'vinilo', 'https://e00-elmundo.uecdn.es/elmundo/imagenes/2013/04/27/cultura/1367093951_extras_ladillos_3_0.jpg'),
(22, 'Judas Priest - Painkiller', 10, 25, 'vinilo', 'https://m.media-amazon.com/images/I/81WCr-L10EL._SX450_.jpg'),
(23, 'U2 - War', 25, 15, 'vinilo', 'https://www.efeeme.com/wp-content/uploads/u2-23-10-13-a.jpg'),
(24, 'David Bowie - Aladdin sane', 12, 72, 'vinilo', 'https://m.media-amazon.com/images/I/91lAnG7d-bL._SL1500_.jpg'),
(25, 'Killingswitch engage - As daylight Dies', 25, 100, 'vinilo', 'https://m.media-amazon.com/images/I/91KJzJka5tL._SS500_.jpg'),
(26, 'System of a down - Toxicity', 35, 23, 'vinilo', 'https://i.scdn.co/image/ab67616d0000b27330d45198d0c9e8841f9a9578'),
(27, 'System of a down - Mezmerize', 45, 13, 'vinilo', 'https://www.todorock.com/wp-content/uploads/2019/08/soad-mezmerize.jpg'),
(28, 'My Chemical Romance - The black parade', 15, 76, 'vinilo', 'https://m.media-amazon.com/images/I/61VJjmbjZOL.jpg'),
(29, 'Three days grace - Outsiders', 10, 5, 'vinilo', 'https://www.lahiguera.net/musicalia/artistas/varios/disco/8950/three_days_grace_outsider-portada.jpg'),
(30, 'Megadeth - peace sells', 36, 24, 'vinilo', 'https://m.media-amazon.com/images/I/815LXdw3NwL._SL1300_.jpg'),
(31, 'Naruto', 6, 24, 'manga', 'https://m.media-amazon.com/images/I/61QtkQ-mH9L._SX325_BO1,204,203,200_.jpg'),
(32, 'One Piece', 8, 40, 'manga', 'https://m.media-amazon.com/images/I/91XwYkbfN-L.jpg'),
(33, 'Jujutsu no kaisen', 8, 40, 'manga', 'https://www.normaeditorial.com/upload/media/albumes/0001/07/thumb_6547_albumes_big.jpeg'),
(34, 'Berserk', 12, 97, 'manga', 'https://i1.whakoom.com/large/0a/33/ad5e15822aee4a1583e7a816f8238cfa.jpg'),
(35, 'Jojo\'s', 10, 32, 'manga', 'https://ramenparados.com/wp-content/uploads/2019/10/JOJOS-BIZARRE-ADVENTURE-Vento-Aureo-300x426.jpg'),
(36, 'Bluelock', 8, 55, 'manga', 'https://m.media-amazon.com/images/I/51jMLFs0YBL.jpg'),
(37, 'Haikyuu', 8, 20, 'manga', 'https://m.media-amazon.com/images/I/51yAcjV5vuL.jpg'),
(38, 'Drifters', 12, 58, 'manga', 'https://m.media-amazon.com/images/I/51IjdMj727L.jpg'),
(39, 'Hellsing', 15, 41, 'manga', 'https://ramenparados.com/wp-content/uploads/2017/11/01223600101_g-1.jpg'),
(40, 'Terraformars', 8, 19, 'manga', 'https://i1.whakoom.com/large/38/1a/9cf35aa3a79d439d9e170a1d2b087b0d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `Nombre` text NOT NULL,
  `Email` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombre`, `Email`, `Password`) VALUES
(1, 'Mario', 'mariogutierrezgonzalez123@gmail.com', 'Cinamon11'),
(10, 'Gygas', 'gygas@gmail.com', 'Pochita'),
(11, 'Sonichi', 'Sonichi@gmail.com', 'Sonichi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
