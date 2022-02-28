-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 23, 2021 lúc 06:12 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `tuyendung_hiep`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(255) NOT NULL,
  `name_cm` varchar(255) NOT NULL,
  `noidung_cm` varchar(255) NOT NULL,
  `TID` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `name_cm`, `noidung_cm`, `TID`) VALUES
(1, 'user', '1234', 'NEW00003'),
(2, 'user', '234', 'NEW00003'),
(3, 'user', '234', 'NEW00003'),
(4, 'user', '32323213', 'NEW00003'),
(5, 'user', '32323213', 'NEW00003'),
(6, 'user', '32323213', 'NEW00003'),
(7, 'user', '32323213', 'NEW00003'),
(8, 'user', '32323213', 'NEW00003'),
(9, 'user', 'h', 'NEW00003'),
(10, 'user', '12312321321', 'NEW00004'),
(11, 'user', '12312321321', 'NEW00004'),
(12, 'user', '12312321321', 'NEW00004'),
(13, 'user', '12312321321', 'NEW00004'),
(14, 'user', '2345678', 'NEW00001'),
(15, 'user', '2345678', 'NEW00001');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `DMID` int(255) NOT NULL,
  `TENDM` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`DMID`, `TENDM`) VALUES
(1, 'vieclam'),
(2, 'tuyen dung');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `file`
--

CREATE TABLE `file` (
  `id_pdf` int(11) NOT NULL,
  `KHID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `idhoadon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NGAYLAP` date NOT NULL,
  `IDHOSO` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `NGAYDONGTIEN` date NOT NULL,
  `TIEN` int(100) NOT NULL,
  `NGAYDONG2` date NOT NULL,
  `TIEN2` int(100) NOT NULL,
  `NGAYDONG3` date NOT NULL,
  `TIEN3` int(110) NOT NULL,
  `TONGTIEN` int(100) NOT NULL,
  `NVID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Motahd` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`idhoadon`, `NGAYLAP`, `IDHOSO`, `NGAYDONGTIEN`, `TIEN`, `NGAYDONG2`, `TIEN2`, `NGAYDONG3`, `TIEN3`, `TONGTIEN`, `NVID`, `Motahd`) VALUES
('HD00001', '2021-12-17', 'HS00001', '2021-12-17', 2, '2021-12-17', 5, '0000-00-00', 0, 211116, 'NV00002', '1212'),
('HD00002', '2021-12-17', 'HS00002', '2021-12-10', 10, '0000-00-00', 0, '0000-00-00', 0, 10, 'NV00003', '321321');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `KHID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NAMEKH` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PHONEKH` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DIACHI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `USERID` int(11) NOT NULL,
  `gioitinh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bangcap` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nangluc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nguyenvong` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trangthaiviec` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quoctich` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NVID` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `NV2ID` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `CONGTYXIN` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `NGAYLAP` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`KHID`, `NAMEKH`, `PHONEKH`, `EMAIL`, `DIACHI`, `USERID`, `gioitinh`, `bangcap`, `nangluc`, `nguyenvong`, `trangthaiviec`, `quoctich`, `NVID`, `NV2ID`, `CONGTYXIN`, `NGAYLAP`) VALUES
('KH00003', 'tenkhach', '0974907417', 'tdung2383@gmail.com', '122321', 33, 'nam', 'DH', '', '0974907417', '結果待ち', 'DH', '', '', '', ''),
('KH00004', 'tenkhach', '3231', 'tungcf69@gmail.com1', '32323213', 34, 'nam', '32132', '', '3231', '内定した', '32132', 'NV00002', 'NV00003', '3213213', ''),
('KH00006', 'Nguyễn thanh tùng', '32323213', ' tungcf69@gmail.com', '0982436274', 37, 'nam', '32132', '432432', '321323', '結果待ち', '3213213', '', '', '', ''),
('KH00007', 'tenkhach', '0982436274', 'tungcf69@gmail.com', '32323213', 38, 'nam', '32132', '', '0982436274', '面接まだ', '32132', 'NV00002', 'NV00002', '3213213', ''),
('KH00008', 'Nguyễn thanh tùng3231', '21212', ' tungcf69@gmail.com', '0982436274', 39, 'nu', '32132', '32312312', '3213213123', '結果待ち', '3213213', 'NV00002', 'NV00004', '32132132', ''),
('KH00009', 'Nguyễn thanh tùng', '32323213', ' tungcf69@gmail.com', '0982436274', 40, 'nu', '32132', '1111', '21212', '結果待ち', '3213213', 'NV00005', 'NV00004', '234', ''),
('KH00010', 'Nguyễn thanh tùng', '32323213', ' tungcf69@gmail.com', '0982436274', 41, 'nam', '32132', '2121', '3123231', '内定した', '3213213', 'NV00003', 'NV00004', '234', ''),
('KH00011', 'Nguyễn thanh tùng', '32323213', ' tungcf69@gmail.com', '0982436274', 42, 'nam', '21323', '32312312', '321321323', '結果待ち', '3213213', 'NV00003', 'NV00004', '1 ', ''),
('KH00012', 'Nguyễn thanh tùng', '21212', ' tungcf69@gmail.com', '0982436274', 43, 'nam', '32132', '3232132133', '213213', '結果待ち', '3213213', 'NV00004', 'NV00002', '3213213', ''),
('KH00013', 'Nguyễn thanh tùng', '32323213', ' tungcf69@gmail.com', '0982436274', 44, 'nam', '32132', '2121', '3123213', '結果待ち', '3213213', 'NV00005', 'NV00002', '1 ', ''),
('KH00014', 'tenkhach', '0982436274', 'tungcf69@gmail.com', '32323213', 45, 'nam', '32132', '', '0982436274', 'キャンセル', '32132', 'NV00002', 'NV00002', '1111111111111', '2021-12-24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaivisa`
--

CREATE TABLE `loaivisa` (
  `LVISAID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TENLOAI` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaivisa`
--

INSERT INTO `loaivisa` (`LVISAID`, `TENLOAI`) VALUES
('[value-1]', 'a'),
('2132', 'D'),
('2133', '3213213'),
('31232', '213232'),
('3212133', '213213213'),
('3213', '32321'),
('32132', '32123'),
('32132321', '3123211111111111111');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `luatsu`
--

CREATE TABLE `luatsu` (
  `LSID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PHONE` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `luatsu`
--

INSERT INTO `luatsu` (`LSID`, `NAME`, `PHONE`, `EMAIL`) VALUES
('LS00001', 'ẻdd', '0982222222', '0982436274');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `NVID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NAMENV` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PHONE` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DIACHI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `USERID` int(11) NOT NULL,
  `NVCONGTY` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`NVID`, `NAMENV`, `PHONE`, `EMAIL`, `DIACHI`, `USERID`, `NVCONGTY`) VALUES
('00005', 'TUNG', '321312', '23245678@1234', '2321323', 47, ''),
('00006', 'TUNG', '2121', '2121@s', '2121212', 46, ''),
('00007', 'TUNGGGGG', '321321', 'tungcf69@gmail.com1', '312312', 49, ''),
('00008', 'TUNG', '32132131', 'tungcf69@gmail.com1', '3123123', 50, ''),
('00009', 'TUNG312', '1232456yhgb', 'tungcf69@gmail.com', '321321', 51, ''),
('00010', 'TUNGGGG', '1232456yhgb', 'tungcf69@gmail.com1', '2132331', 52, ''),
('00011', 'TUNG', '321321', '1111@1212', '323213213', 53, '331232'),
('NV00002', '122222', '21212', '0982436274@1', '21323', 28, ''),
('NV00003', '23124', '234', '23245678@1234', '1222222222222', 29, ''),
('NV00004', 'TUNG', '21212', 'tungcf69@gmail.com', '2133213', 37, ''),
('NV00005', 'ハローベイビー', 'ハローベイビー', 'tungcf69@gmail.com', 'ハローベイビー', 35, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tag`
--

CREATE TABLE `tag` (
  `tagid` int(110) NOT NULL,
  `tentag` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tag`
--

INSERT INTO `tag` (`tagid`, `tentag`) VALUES
(1, 'xyz'),
(2, 'abc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tintuc`
--

CREATE TABLE `tintuc` (
  `TID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TIEUDE` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NGAYDANG` date NOT NULL,
  `DIACHI` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MUCLUONG` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DUONGDAN` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MOTA` varchar(9999) COLLATE utf8_unicode_ci NOT NULL,
  `DMID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TAGID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `KINHNGHIEM` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `BANGCAP` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `SOLUONGTUYEN` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `NGHANHNGHE` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `CHUCVU` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `THOIGIANLAMVIEC` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `YEUCAUGIOITINH` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `YEUCAUTUOI` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `TRANGTHAI` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `LUOTXEM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tintuc`
--

INSERT INTO `tintuc` (`TID`, `TIEUDE`, `NGAYDANG`, `DIACHI`, `MUCLUONG`, `DUONGDAN`, `MOTA`, `DMID`, `TAGID`, `KINHNGHIEM`, `BANGCAP`, `SOLUONGTUYEN`, `NGHANHNGHE`, `CHUCVU`, `THOIGIANLAMVIEC`, `YEUCAUGIOITINH`, `YEUCAUTUOI`, `TRANGTHAI`, `LUOTXEM`) VALUES
('NEW00001', 'Tuyển dụng công nhân', '2021-12-18', '212', '20-30 triệu', ' img/1.jpg', '321323', '1', '1', '2 năm', '', '213', 'công nhân', '1', '1', 'nam', '12', 'vip', 52),
('NEW00002', '23213', '2021-11-12', '3213', '3213', ' img/view_quan_4.jpg', '23213', '2', 'xyz', '321323', '', '32132', '23213', '32132', '321321', 'nam', '2331', 'xuhuong', 5),
('NEW00003', '32132', '2021-11-12', '21323', '32132', ' img/view_quan_4.jpg', '312321', '1', 'xxx', '32132', '32132', '321321', '3123', '3123', '321', 'nu', '3213', 'thuong', 21),
('NEW00004', '212', '2021-11-04', '32323213', '3213231', ' img/view_quan_4.jpg', '234', '1', 'xyz', '321323', '32132', '213', 'công nhân', '32132', '321321', 'nam & nu', '3213', 'thuong', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `USERID` int(11) NOT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PASS` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PHANQUYEN` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MAVIDEO` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`USERID`, `NAME`, `PASS`, `PHANQUYEN`, `MAVIDEO`) VALUES
(16, 'admin', '123456', '0', ''),
(26, 'nv1', '123456', '1', ''),
(28, 'adminvbn', '123456', '1', ''),
(29, 'admin123', '123456', '1', ''),
(32, '', '', '2', ''),
(33, 'kh3', '123456', '2', ''),
(34, '1111', '123456', '2', ''),
(35, 'nv22', '123456', '1', ''),
(37, 'kh2222', '123456', '2', ''),
(38, 'adminkh44', '123456', '2', ''),
(39, '3231323', '123456', '2', ''),
(40, '111112121212', '123456', '2', ''),
(41, 'tunggggg', '123456', '2', '1'),
(42, 'admintungggg', '123456', '2', ''),
(43, 'rrrrr', '123456', '2', 'K4XT9C'),
(44, 'admin1111', '123456', '2', 'RYM1A7'),
(45, 'admin111111112121', '123456', '2', 'YRH58W'),
(46, 'adminnv3', '123456', '1', ''),
(47, 'admin23233213', '123456', '1', ''),
(48, '321321323', '123456', '1', ''),
(49, 'HELO1111', '123456', '1', ''),
(50, 'adminMEDUANNNN', '123456', '1', ''),
(51, 'AAAAAAAAAAAAAAAAAA', '123456', '1', ''),
(52, 'AAAAAAAAAAASASA', '123456', '1', ''),
(53, '321323321', '123456', '1', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `video`
--

CREATE TABLE `video` (
  `IDVIDEO` varchar(255) NOT NULL,
  `NGAYDANG` date NOT NULL,
  `TITLEVIDEO` varchar(1000) NOT NULL,
  `MOTAVIDEO` varchar(1000) NOT NULL,
  `DUONGDAN` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `video`
--

INSERT INTO `video` (`IDVIDEO`, `NGAYDANG`, `TITLEVIDEO`, `MOTAVIDEO`, `DUONGDAN`) VALUES
('VIDEO00001', '2021-12-27', '3213', '1212', 'nhac.mp4'),
('VIDEO00002', '2021-12-06', '3213', '2', 'nhac2.mp4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `visa`
--

CREATE TABLE `visa` (
  `VISAID` varchar(100) NOT NULL,
  `TENVISA` varchar(1000) NOT NULL,
  `NGAYXIN` date NOT NULL,
  `NGAYCAP` date NOT NULL,
  `NGAYHET` date NOT NULL,
  `CONGTYXIN` varchar(1000) NOT NULL,
  `TRANGTHAI` varchar(100) NOT NULL,
  `LOAIVISA` varchar(1000) NOT NULL,
  `LSID` varchar(1000) NOT NULL,
  `KHID` varchar(1000) NOT NULL,
  `NVID` varchar(1000) NOT NULL,
  `NV2ID` varchar(255) NOT NULL,
  `NGAYLAP` date NOT NULL,
  `name_file` varchar(255) NOT NULL,
  `Mota` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `visa`
--

INSERT INTO `visa` (`VISAID`, `TENVISA`, `NGAYXIN`, `NGAYCAP`, `NGAYHET`, `CONGTYXIN`, `TRANGTHAI`, `LOAIVISA`, `LSID`, `KHID`, `NVID`, `NV2ID`, `NGAYLAP`, `name_file`, `Mota`) VALUES
('HS00001', 'De', '2021-12-21', '2021-12-21', '2021-12-21', '32132', 'chờ duyệt', '[value-1]', 'LS00001', 'KH00003', 'NV00002', 'NV00002', '2021-12-21', 'tuyendung_hiep.sql', '4332321321');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`DMID`);

--
-- Chỉ mục cho bảng `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id_pdf`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`idhoadon`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`KHID`);

--
-- Chỉ mục cho bảng `loaivisa`
--
ALTER TABLE `loaivisa`
  ADD PRIMARY KEY (`LVISAID`);

--
-- Chỉ mục cho bảng `luatsu`
--
ALTER TABLE `luatsu`
  ADD PRIMARY KEY (`LSID`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`NVID`);

--
-- Chỉ mục cho bảng `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tagid`);

--
-- Chỉ mục cho bảng `tintuc`
--
ALTER TABLE `tintuc`
  ADD PRIMARY KEY (`TID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERID`);

--
-- Chỉ mục cho bảng `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`IDVIDEO`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `DMID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `file`
--
ALTER TABLE `file`
  MODIFY `id_pdf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tag`
--
ALTER TABLE `tag`
  MODIFY `tagid` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
