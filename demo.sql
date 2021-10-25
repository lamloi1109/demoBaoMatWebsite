-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2021 at 04:59 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorization`
--

CREATE TABLE `authorization` (
  `idauth` int(11) NOT NULL,
  `role_admin` int(11) NOT NULL,
  `role_sinhvien` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authorization`
--

INSERT INTO `authorization` (`idauth`, `role_admin`, `role_sinhvien`, `iduser`) VALUES
(1, 1, 1, 1),
(2, 0, 1, 2),
(3, 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` char(50) NOT NULL,
  `passwd` char(50) NOT NULL,
  `auth_token` varchar(200) NOT NULL,
  `ho` varchar(10) NOT NULL,
  `ten` varchar(50) NOT NULL,
  `gioitinh` bit(1) NOT NULL,
  `img` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `passwd`, `auth_token`, `ho`, `ten`, `gioitinh`, `img`) VALUES
(1, 'b1807572', '202CB962AC59075B964B07152D234B70', '', 'Lam', 'Phuoc Loi', b'1', '../img/user1/user1.jpg'),
(2, 'b1807600', '250cf8b51c773f3f8dc8b4be867a9a02', '', 'Vu', 'Ba Truong Tien', b'1', '../img/user2/user2.png'),
(3, 'b1807676', '68053af2923e00204c3ca7c6a3150cf7', '', 'Lam', 'Gia Toan', b'0', '../img/user3/user3.png');

-- --------------------------------------------------------

--
-- Table structure for table `userpost`
--

CREATE TABLE `userpost` (
  `userid` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `thoigian` date NOT NULL DEFAULT current_timestamp(),
  `title` varchar(200) NOT NULL,
  `idpost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userpost`
--

INSERT INTO `userpost` (`userid`, `content`, `thoigian`, `title`, `idpost`) VALUES
(3, 'tài khoản: b1807636\r\nmật khẩu: 789', '2021-10-10', 'Tài Khoản mật khẩu', 29),
(1, ':D', '2021-10-10', 'ahihi', 34),
(2, 'ahihi', '2021-10-12', 'tui dang demo', 36),
(2, 'dsa', '2021-10-13', 'dsadsa', 38);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authorization`
--
ALTER TABLE `authorization`
  ADD PRIMARY KEY (`idauth`),
  ADD KEY `test` (`iduser`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpost`
--
ALTER TABLE `userpost`
  ADD PRIMARY KEY (`idpost`),
  ADD KEY `user_userpost` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authorization`
--
ALTER TABLE `authorization`
  MODIFY `idauth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userpost`
--
ALTER TABLE `userpost`
  MODIFY `idpost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authorization`
--
ALTER TABLE `authorization`
  ADD CONSTRAINT `test` FOREIGN KEY (`iduser`) REFERENCES `user` (`id`);

--
-- Constraints for table `userpost`
--
ALTER TABLE `userpost`
  ADD CONSTRAINT `user_userpost` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
