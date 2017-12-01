-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: amazon1.cdw2navziivl.us-west-2.rds.amazonaws.com:3306
-- Generation Time: Dec 01, 2017 at 05:08 PM
-- Server version: 5.6.27-log
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `centinela`
--

-- --------------------------------------------------------

--
-- Table structure for table `acciones`
--

CREATE TABLE `acciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ctime` timestamp NULL DEFAULT NULL,
  `accion` varchar(32) NOT NULL,
  `controladorId` int(11) UNSIGNED NOT NULL,
  `caption` varchar(64) DEFAULT NULL,
  `publica` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acciones`
--

INSERT INTO `acciones` (`id`, `mtime`, `ctime`, `accion`, `controladorId`, `caption`, `publica`) VALUES
(1, '2017-11-29 16:36:19', '2017-11-27 18:43:09', 'index', 1, 'Home del sitio', 1),
(2, '2017-11-29 18:30:53', '2017-11-27 18:45:00', 'index', 4, 'Lista de controladores', 0),
(3, '2017-11-27 18:45:36', '2017-11-27 18:45:35', 'create', 4, 'Crear controlador', 0),
(4, '2017-11-27 18:45:59', '2017-11-27 18:45:59', 'edit', 4, 'Editar controlador', 0),
(5, '2017-11-27 18:46:20', '2017-11-27 18:46:20', 'delete', 4, 'Borrar controlador', 0),
(6, '2017-11-27 18:47:42', '2017-11-27 18:47:42', 'index', 6, 'Lista de acciones', 0),
(7, '2017-11-27 23:49:48', '2017-11-27 18:48:41', 'create', 6, 'Crear acción', 0),
(8, '2017-11-27 23:49:13', '2017-11-27 18:49:00', 'edit', 6, 'Editar acción', 0),
(9, '2017-11-27 23:49:57', '2017-11-27 18:49:24', 'delete', 6, 'Borrar acción', 0),
(10, '2017-11-27 18:50:10', '2017-11-27 18:50:09', 'index', 2, 'Lista de perfiles', 0),
(11, '2017-11-27 18:50:31', '2017-11-27 18:50:31', 'create', 2, 'Crear perfil', 0),
(12, '2017-11-27 18:50:47', '2017-11-27 18:50:47', 'edit', 2, 'Editar perfil', 0),
(13, '2017-11-27 18:52:08', '2017-11-27 18:52:08', 'privilegios', 2, 'Editar privilegios de un perfil', 0),
(14, '2017-11-29 23:37:13', '2017-11-27 19:21:49', 'registro', 1, 'Auto registro de nuevo usuario', 0),
(15, '2017-11-27 19:24:50', '2017-11-27 19:24:50', 'index', 5, 'Lista de usuarios', 0),
(16, '2017-11-27 19:32:47', '2017-11-27 19:32:47', 'create', 5, 'Crear nuevo usuario', 0),
(17, '2017-11-27 19:39:30', '2017-11-27 19:39:30', 'edit', 5, 'Editar usuario', 0),
(18, '2017-11-27 19:40:07', '2017-11-27 19:40:07', 'delete', 5, 'Borrar usuario', 0),
(19, '2017-11-27 19:41:30', '2017-11-27 19:41:30', 'password', 5, 'Resetear password a usuario', 0),
(20, '2017-11-29 23:37:26', '2017-11-29 17:23:41', 'login', 1, 'Autenticar usuario', 1),
(21, '2017-11-29 23:37:40', '2017-11-29 17:24:14', 'logout', 1, 'Cerrar sesión', 1),
(22, '2017-11-29 19:21:52', '2017-11-29 19:21:52', 'show404', 8, 'No encontrado', 1),
(23, '2017-11-30 17:01:54', '2017-11-30 17:01:54', 'password', 1, 'Cambiar password propio', 0),
(24, '2017-11-30 18:35:51', '2017-11-30 18:35:51', 'cuenta', 1, 'Información del usuario', 0),
(25, '2017-12-01 22:25:58', '2017-12-01 22:25:58', 'instalacion', 1, 'Instalación', 1);

-- --------------------------------------------------------

--
-- Table structure for table `controladores`
--

CREATE TABLE `controladores` (
  `id` int(11) UNSIGNED NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ctime` timestamp NULL DEFAULT NULL,
  `controlador` varchar(32) NOT NULL,
  `prioridad` smallint(5) UNSIGNED NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `controladores`
--

INSERT INTO `controladores` (`id`, `mtime`, `ctime`, `controlador`, `prioridad`) VALUES
(1, '2017-11-28 16:23:46', '2017-10-01 21:16:34', 'index', 1),
(2, '2017-11-28 16:24:20', '2017-11-16 05:51:04', 'perfiles', 4),
(4, '2017-11-28 16:24:29', '2017-11-16 16:24:03', 'controladores', 5),
(5, '2017-11-28 16:24:12', '2017-11-17 18:18:36', 'usuarios', 3),
(6, '2017-11-28 16:24:32', '2017-11-27 18:47:16', 'acciones', 6),
(8, '2017-11-29 19:21:19', '2017-11-29 19:21:19', 'error', 100);

-- --------------------------------------------------------

--
-- Table structure for table `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(11) UNSIGNED NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ctime` timestamp NULL DEFAULT NULL,
  `nombre` varchar(32) NOT NULL,
  `caption` varchar(32) NOT NULL,
  `permanente` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perfiles`
--

INSERT INTO `perfiles` (`id`, `mtime`, `ctime`, `nombre`, `caption`, `permanente`, `activo`) VALUES
(1, '2017-11-23 06:44:32', '2017-10-01 21:11:29', 'super', 'Super Usuario', 1, 1),
(2, '2017-11-23 06:43:55', '2017-10-01 21:11:29', 'admin', 'Administrador', 1, 1),
(3, '2017-11-23 05:51:25', '2017-10-01 21:11:29', 'registrado', 'Registrado', 1, 1),
(4, '2017-11-28 22:18:25', '2017-10-01 21:11:29', 'visita', 'Visita', 1, 1),
(5, '2017-11-29 20:02:11', '2017-11-10 18:57:11', 'capturista', 'Capturista', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `privilegios_acciones`
--

CREATE TABLE `privilegios_acciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ctime` timestamp NULL DEFAULT NULL,
  `perfilId` int(11) UNSIGNED NOT NULL,
  `accionId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilegios_acciones`
--

INSERT INTO `privilegios_acciones` (`id`, `mtime`, `ctime`, `perfilId`, `accionId`) VALUES
(33, '2017-11-28 16:32:32', '2017-11-28 16:32:32', 5, 1),
(35, '2017-11-28 20:40:11', '2017-11-28 20:40:11', 4, 1),
(36, '2017-11-28 20:40:11', '2017-11-28 20:40:11', 4, 14),
(74, '2017-11-30 18:36:28', '2017-11-30 18:36:28', 2, 24),
(75, '2017-11-30 18:36:28', '2017-11-30 18:36:28', 2, 23),
(76, '2017-11-30 18:36:28', '2017-11-30 18:36:28', 2, 16),
(77, '2017-11-30 18:36:28', '2017-11-30 18:36:28', 2, 18),
(78, '2017-11-30 18:36:28', '2017-11-30 18:36:28', 2, 17),
(79, '2017-11-30 18:36:29', '2017-11-30 18:36:29', 2, 15),
(80, '2017-11-30 18:36:29', '2017-11-30 18:36:29', 2, 19),
(100, '2017-11-30 18:37:07', '2017-11-30 18:37:07', 3, 24),
(101, '2017-11-30 18:37:07', '2017-11-30 18:37:07', 3, 23),
(120, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 23),
(121, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 24),
(122, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 15),
(123, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 16),
(124, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 17),
(125, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 18),
(126, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 19),
(127, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 10),
(128, '2017-12-01 22:27:03', '2017-12-01 22:27:03', 1, 11),
(129, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 12),
(130, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 13),
(131, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 2),
(132, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 3),
(133, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 4),
(134, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 5),
(135, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 6),
(136, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 7),
(137, '2017-12-01 22:27:04', '2017-12-01 22:27:04', 1, 8),
(138, '2017-12-01 22:27:05', '2017-12-01 22:27:05', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `mtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ctime` timestamp NULL DEFAULT NULL,
  `nombre` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` char(60) NOT NULL,
  `perfilId` int(11) UNSIGNED NOT NULL,
  `bloqueado` tinyint(1) NOT NULL DEFAULT '0',
  `borrado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `mtime`, `ctime`, `nombre`, `email`, `password`, `perfilId`, `bloqueado`, `borrado`) VALUES
(1, '2017-12-01 19:05:11', '2017-10-20 22:39:05', 'John Doe', 'john.doe@gmail.com', '$2y$08$ZHhnZG43YXZHZ0tXdUlnU.oKP4euJ1QFaCbl6tOczh7MfXcHgOJmW', 1, 0, 0),
(2, '2017-12-01 19:05:52', '2017-10-20 22:40:44', 'Juan Perez', 'juan.perez@gmail.com', '$2y$08$amovd0duMGpGRGlNT09qauhwatkChkitOsBrSQQfQ5n4fpey6E82e', 2, 0, 0),
(3, '2017-12-01 19:06:35', '2017-11-08 23:40:52', 'Fulano Díaz', 'abc@a.com', '$2y$08$R2l4UndiUVNDUmcyWUd2d.S0Z6OTBFT3kbIwCSkTP0UHjj08Yh.IO', 5, 0, 0),
(4, '2017-12-01 19:06:56', '2017-11-09 22:21:38', 'Perengano Noches', 'b@gmail.com', '$2y$08$TjdDU1J2aGpXU01uRXNSYeutQWBMOyyPK6DoPt8MpK1qj3OnAd12W', 3, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acciones`
--
ALTER TABLE `acciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accionAtControlador` (`controladorId`,`accion`),
  ADD KEY `ctime` (`ctime`),
  ADD KEY `accion` (`accion`) USING BTREE,
  ADD KEY `controladorId` (`controladorId`) USING BTREE,
  ADD KEY `publica` (`publica`);

--
-- Indexes for table `controladores`
--
ALTER TABLE `controladores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `controlador` (`controlador`),
  ADD KEY `ctime` (`ctime`),
  ADD KEY `prioridad` (`prioridad`);

--
-- Indexes for table `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`) USING BTREE,
  ADD KEY `activo` (`activo`),
  ADD KEY `caption` (`caption`),
  ADD KEY `ctime` (`ctime`),
  ADD KEY `permanente` (`permanente`);

--
-- Indexes for table `privilegios_acciones`
--
ALTER TABLE `privilegios_acciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ctime` (`ctime`),
  ADD KEY `perfilId` (`perfilId`),
  ADD KEY `accionId` (`accionId`) USING BTREE;

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bloqueado` (`bloqueado`),
  ADD KEY `ctime` (`ctime`),
  ADD KEY `perfilId` (`perfilId`) USING BTREE,
  ADD KEY `borrado` (`borrado`);

