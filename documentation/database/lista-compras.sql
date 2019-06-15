-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jun-2019 às 22:43
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lista-compras`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `access_levels`
--

CREATE TABLE `access_levels` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `access_levels`
--

INSERT INTO `access_levels` (`id`, `description`, `code`) VALUES
(1, 'Root', 1000),
(2, 'Administrador', 100),
(4, 'Usuário', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart`
--

CREATE TABLE `cart` (
  `shoppinglist` int(11) NOT NULL,
  `products` int(11) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cart`
--

INSERT INTO `cart` (`shoppinglist`, `products`, `amount`) VALUES
(20, 29, 3),
(21, 2, 2),
(21, 11, 1),
(21, 13, 2),
(21, 14, 1),
(21, 19, 2),
(21, 20, 10),
(21, 26, 1),
(21, 29, 1),
(24, 11, 1),
(24, 20, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`id`, `description`) VALUES
(1, 'Graos AL'),
(2, 'Biscoitos'),
(3, 'Bebidas'),
(4, 'Frutas'),
(5, 'Pães'),
(6, 'Frios'),
(7, 'Legumes'),
(8, 'Carnes'),
(9, 'Verduras'),
(10, 'Cereais'),
(11, 'Ovos'),
(12, 'Farinhas'),
(20, 'aawqqqqq'),
(21, 'teste 222'),
(22, 'editado'),
(23, 'editado de boas'),
(24, 'Graos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id`, `description`, `price`, `category`) VALUES
(1, 'Costela', 21.5, 8),
(2, 'Patinho', 20, 8),
(3, 'Picanha', 25.8, 8),
(4, 'Arroz Integral', 5.75, 1),
(5, 'Arroz Branco', 5.25, 1),
(6, 'Feijão Preto', 3.5, 1),
(7, 'Feijão Carioca', 4.1, 1),
(8, 'Farinhas Trigo', 7.8, 12),
(9, 'Farinha de rosca', 4.86, 12),
(10, 'Leite Integral', 1.75, 3),
(11, 'Refrigerante Coca-Cola', 3.5, 3),
(12, 'Cerveja', 3.99, 3),
(13, 'Ovos de Galinha', 6.99, 11),
(14, 'Ovos de Codorna', 8.75, 11),
(15, 'Aipim', 12.2, 7),
(16, 'Alface', 2.13, 7),
(17, 'Bolacha Recheada', 3.5, 2),
(18, 'Cenoura', 3.45, 9),
(19, 'Salmão', 35.1, 6),
(20, 'Sobrecoxa  Frango', 8.7, 6),
(21, 'Laranja', 5.4, 4),
(22, 'Maça', 3.5, 4),
(23, 'Granola', 6.1, 10),
(24, 'Pão Integral', 2.75, 5),
(25, 'Carne de Soja', 18.5, 6),
(26, 'Presunto', 7.55, 6),
(28, 'aaa', 22, 23),
(29, 'teste de vir a', 5.63, 22),
(31, '1aaa', 12, 1),
(32, '2aaa', 22.44, 12),
(33, 'meu produto', 200.6, 5),
(34, 'meu prod', 88, 12),
(35, 'meu prod 2', 55.55, 10),
(36, 'Feijão bom', 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `shoppinglist`
--

CREATE TABLE `shoppinglist` (
  `id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `spending` float NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `shoppinglist`
--

INSERT INTO `shoppinglist` (`id`, `date`, `spending`, `user`) VALUES
(12, '2019-06-01 23:34:00', 22, 22),
(20, '2019-06-02 00:38:14', 15, 23),
(21, '2019-06-15 20:09:52', 245.36, 1),
(23, '2019-06-06 20:59:03', 0, 25),
(24, '2019-06-15 20:11:16', 12.2, 26);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(45) DEFAULT NULL,
  `access_levels` int(11) DEFAULT '4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `phone`, `email`, `token`, `access_levels`) VALUES
(1, 'geranielmotta', '698dc19d489c4e4db73e28a713eab07b', 'Geraniel Motta', '(55) 54155-4448', 'geranielmotta@gmail.com', '66c8bfcca5058f11be29488ac53ab5ad', 1),
(2, 'SUPER ROOT', '698dc19d489c4e4db73e28a713eab07b', 'SUPER ROOT', '12154544455', 'root@super.com', 'ad985e3af071adc3dbccb5703ecf164b', 4),
(21, 'usuário 32', '698dc19d489c4e4db73e28a713eab07b', 'user', '11111111111', 'user@user.com', '60731efce828749866386fa5cd5fd0aa', 4),
(22, 'geranielmotta', '698dc19d489c4e4db73e28a713eab07b', 'user 2', '11111111111', 'user2@user2.com', '939652dadad7e15982650745e0fcd217', 4),
(23, 'teste', '698dc19d489c4e4db73e28a713eab07b', 'usuário teste 02', '22222222222', 'user02@user.com', 'cce0676c08fd67cdc27dce5de1c0a07b', 4),
(24, 'teste 22', '698dc19d489c4e4db73e28a713eab07b', 'teste aaa', '45454545454', 'teste@teste.com', NULL, 4),
(25, NULL, '698dc19d489c4e4db73e28a713eab07b', 'geraniel', NULL, 'geraniel@gmail.com', 'e8cdc08a2ade0a15f42f8b9fc0aa85a4', 4),
(26, NULL, '698dc19d489c4e4db73e28a713eab07b', 'novo', NULL, 'novo@novo.com', '7c7b57a697e4e7a8d208362fe071470d', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_levels`
--
ALTER TABLE `access_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`shoppinglist`,`products`),
  ADD KEY `fk_shoppinglist_has_products_products1_idx` (`products`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_category1_idx` (`category`);

--
-- Indexes for table `shoppinglist`
--
ALTER TABLE `shoppinglist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_list_user_idx` (`user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_access_levels1_idx` (`access_levels`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_levels`
--
ALTER TABLE `access_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `shoppinglist`
--
ALTER TABLE `shoppinglist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_shoppinglist_has_products_products1` FOREIGN KEY (`products`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_shoppinglist_has_products_shoppinglist1` FOREIGN KEY (`shoppinglist`) REFERENCES `shoppinglist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_category1` FOREIGN KEY (`category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `shoppinglist`
--
ALTER TABLE `shoppinglist`
  ADD CONSTRAINT `fk_list_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_access_levels1` FOREIGN KEY (`access_levels`) REFERENCES `access_levels` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
