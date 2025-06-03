-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 09:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citadin`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrador`
--

CREATE TABLE `administrador` (
  `administradorID` int(11) NOT NULL,
  `nombreAdministrador` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evento`
--

CREATE TABLE `evento` (
  `eventoID` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `administradorID` int(11) DEFAULT NULL,
  `timeStampEdicion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evento_imagen`
--

CREATE TABLE `evento_imagen` (
  `imagenID` int(11) NOT NULL,
  `eventoID` int(11) NOT NULL,
  `rutaImagen` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`administradorID`),
  ADD UNIQUE KEY `nombreAdministrador` (`nombreAdministrador`);

--
-- Indexes for table `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`eventoID`),
  ADD KEY `administradorID` (`administradorID`);

--
-- Indexes for table `evento_imagen`
--
ALTER TABLE `evento_imagen`
  ADD PRIMARY KEY (`imagenID`),
  ADD KEY `eventoID` (`eventoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `administradorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evento`
--
ALTER TABLE `evento`
  MODIFY `eventoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evento_imagen`
--
ALTER TABLE `evento_imagen`
  MODIFY `imagenID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evento`
--
ALTER TABLE `evento`
  ADD CONSTRAINT `evento_ibfk_1` FOREIGN KEY (`administradorID`) REFERENCES `administrador` (`administradorID`) ON DELETE SET NULL;

--
-- Constraints for table `evento_imagen`
--
ALTER TABLE `evento_imagen`
  ADD CONSTRAINT `evento_imagen_ibfk_1` FOREIGN KEY (`eventoID`) REFERENCES `evento` (`eventoID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
