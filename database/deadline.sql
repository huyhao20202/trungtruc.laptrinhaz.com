-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2017 lúc 09:16 AM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `deadline`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` text,
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(255) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`, `picture`, `created`, `created_by`, `modified`, `modified_by`, `status`) VALUES
(10, 'Khóa học PHP tại ZendVN', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png', '0000-00-00', NULL, '2017-11-20', 'admin', 0),
(12, 'qwert', '', '2017-11-20', 'admin', '2017-11-20', 'admin', 1),
(13, 'trung', '', '2017-11-20', 'admin', '0000-00-00', NULL, 0),
(14, 'qwertty', '22809643_1928333160712818_379516853_n.jpg', '2017-11-20', 'admin', '0000-00-00', NULL, 0),
(15, 'qwertty', '22809643_1928333160712818_379516853_n.jpg', '2017-11-20', 'admin', '0000-00-00', NULL, 0),
(16, 'trung', '22835306_1928333164046151_1796223782_n.jpg', '2017-11-20', 'admin', '0000-00-00', NULL, 0),
(17, 'afsdfsdf', '', '2017-11-20', 'admin', '0000-00-00', NULL, 0),
(18, 'afsdfsdf', '', '2017-11-20', 'admin', '0000-00-00', NULL, 0),
(19, 'qwertt', '22835306_1928333164046151_1796223782_n.jpg', '2017-11-20', 'admin', '0000-00-00', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `playlist_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date NOT NULL DEFAULT '0000-00-00',
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modified` date NOT NULL DEFAULT '0000-00-00',
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `group_acp` tinyint(1) DEFAULT '0',
  `created` date DEFAULT '0000-00-00',
  `created_by` varchar(45) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  `privilege_id` text NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `group`
--

INSERT INTO `group` (`id`, `name`, `group_acp`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `privilege_id`, `picture`) VALUES
(1, 'Admin', 1, '2013-11-11', 'admin', '2013-11-12', 'admin', 1, 5, '1,2,3,4,5,6,7,8,9,10', ''),
(2, 'Manager', 1, '2013-11-07', 'admin', '2013-12-03', 'admin', 1, 4, '1,2,3,4,6,7,8,9,10', ''),
(3, 'Member', 0, '2013-11-12', 'admin', '2013-12-03', 'admin', 1, 2, '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `privilege`
--

CREATE TABLE `privilege` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `module` varchar(45) NOT NULL,
  `controller` varchar(45) NOT NULL,
  `action` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `module`, `controller`, `action`) VALUES
(1, 'Hiển thị danh sách người dùng', 'admin', 'user', 'index'),
(2, 'Thay đổi status của người dùng', 'admin', 'user', 'status'),
(3, 'Cập nhật thông tin của người dùng', 'admin', 'user', 'form'),
(4, 'Thay đổi status của người dùng sử dụng Ajax', 'admin', 'user', 'ajaxStatus'),
(5, 'Xóa một hoặc nhiều người dùng', 'admin', 'user', 'trash'),
(6, 'Thay đổi vị trí hiển thị của các người dùng', 'admin', 'user', 'ordering'),
(7, 'Truy cập menu Admin Control Panel', 'admin', 'index', 'index'),
(8, 'Đăng nhập Admin Control Panel', 'admin', 'index', 'login'),
(9, 'Đăng xuất Admin Control Panel', 'admin', 'index', 'logout'),
(10, 'Cập nhật thông tin tài khoản quản trị', 'admin', 'index', 'profile');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created` date DEFAULT '0000-00-00',
  `created_by` int(11) DEFAULT NULL,
  `modified` date DEFAULT '0000-00-00',
  `modified_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `ordering` int(11) DEFAULT '10',
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `fullname`, `password`, `created`, `created_by`, `modified`, `modified_by`, `status`, `ordering`, `group_id`) VALUES
(1, 'nva', 'nvan@gmail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00', 1, '0000-00-00', NULL, 0, 4, 1),
(2, 'nvb', 'nvb@gmail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00', 1, '0000-00-00', NULL, 0, 3, 2),
(3, 'nvc', 'nvc@gmail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00', 1, '0000-00-00', NULL, 0, 2, 3),
(4, 'admin', 'admin@gmail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', '0000-00-00', 1, '0000-00-00', NULL, 0, 1, 4);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `privilege`
--
ALTER TABLE `privilege`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
