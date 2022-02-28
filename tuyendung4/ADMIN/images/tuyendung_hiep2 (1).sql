-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2021 lúc 02:26 PM
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
-- Cơ sở dữ liệu: `tuyendung_hiep2`
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
('HD00001', '2021-11-01', 'HS00004', '2021-11-02', 2134567, '2021-12-01', 234567, '2021-11-26', 2345, 2371479, 'NV00002', ''),
('HD00002', '2021-11-21', 'HS00003', '2021-12-01', 12345, '0000-00-00', 0, '0000-00-00', 0, 12345, 'NV00002', '345'),
('HD00003', '2021-12-14', 'HS00005', '2021-12-14', 222, '2021-12-08', 111, '0000-00-00', 0, 333, 'NV00003', '132');

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
  `nguyenvong` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`KHID`, `NAMEKH`, `PHONEKH`, `EMAIL`, `DIACHI`, `USERID`, `gioitinh`, `bangcap`, `nangluc`, `nguyenvong`) VALUES
('KH00004', '111111111111111', '111111111111', '11111111111@gmail.com', '1111111111111', 32, 'nam', '32132', '1111', '23243567689'),
('KH00005', 'Nguyễn thanh tùng', '232132', ' 321321@12a', '21323', 33, 'nu', '32132', '1111', '2313213213'),
('KH00006', 'Nguyễn thanh tùng', '3123123', ' admin2@gmail.com', '0982436274', 34, 'nam', '321312', '32312312', '1231'),
('KH00008', 'Nguyễn thanh tùng', '2121', ' 0982436274@1', '212', 36, 'nu', '2121', '2121', '1212'),
('KH00009', 'Nguyễn thanh tùng', '21212', ' tungcf69@gmail.com', '0982436274', 0, 'nam', '32132', '2121', '212'),
('KH00010', 'Nguyễn thanh tùng', '32323213', ' tungcf69@gmail.com', '0982436274', 44, 'nam', '32132', '213456', '123456786'),
('KH00011', '2345657', '32323213', ' tungcf69@gmail.com', '0982436274', 45, 'nam', '213425364756', '123456789', '2345678'),
('KH00012', 'Nguyễn thanh tùng', '32323213', ' tungcf69@gmail.com', '111111', 46, 'nam', '32132', '32321313', '321321321321');

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
  `USERID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`NVID`, `NAMENV`, `PHONE`, `EMAIL`, `DIACHI`, `USERID`) VALUES
('NV00002', '122222', '21212', '0982436274@1', '21323', 28),
('NV00003', '23124', '234', '23245678@1234', '1222222222222', 29),
('NV00004', 'TUNG', '21212', 'tungcf69@gmail.com', '2133213', 37);

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
('NEW00001', 'Tuyển dụng công nhân', '2021-11-11', '212', '20-30 triệu', ' img/1.jpg', '321323', '1', '1', '2 năm', '', '213', 'công nhân', '1', '1', 'nam', '12', 'vip', 22),
('NEW00002', '23213', '2021-11-12', '3213', '3213', ' img/view_quan_4.jpg', '23213', '2', 'xyz', '321323', '', '32132', '23213', '32132', '321321', 'nam', '2331', 'xuhuong', 1),
('NEW00003', '32132', '2021-11-12', '21323', '32132', ' img/view_quan_4.jpg', '312321', '1', 'xxx', '32132', '32132', '321321', '3123', '3123', '321', 'nu', '3213', 'thuong', 21),
('NEW00004', '212', '2021-11-04', '32323213', '3213231', ' img/view_quan_4.jpg', '234', '1', 'xyz', '321323', '32132', '213', 'công nhân', '32132', '321321', 'nam & nu', '3213', 'thuong', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `USERID` int(11) NOT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PASS` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PHANQUYEN` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`USERID`, `NAME`, `PASS`, `PHANQUYEN`) VALUES
(16, 'admin', '123456', '0'),
(24, 'admin213', '123456', '2'),
(25, 'kh1', '123456', '2'),
(26, 'nv1', '123456', '1'),
(27, 'kh2', '123456', '2'),
(28, 'adminvbn', '123456', '1'),
(29, 'admin123', '123456', '1'),
(31, '111111', '123456', '2'),
(32, 'admin11111111', '123456', '2'),
(33, 'admin212121', '123456', '2'),
(34, 'admin12323123', '123456', '2'),
(36, 'admin121212', '123456', '2'),
(37, 'admin12345', '123456', '1'),
(38, 'admin11111', '123456', '2'),
(39, 'admin1111111', '123456', '2'),
(40, 'admin11111111111111111111', '123456', '2'),
(41, 'admin11111111111111', '123456', '2'),
(42, 'admin212hello', '123456', '2'),
(43, 'admin212121212', '123456', '2'),
(44, 'admin11112222111', '123456', '2'),
(45, 'admin1234567', '123456', '2'),
(46, 'admin111111sadd111111111111111111', '123456', '2');

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
  `Mota` varchar(1000) NOT NULL,
  `trangthaiviec` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `visa`
--

INSERT INTO `visa` (`VISAID`, `TENVISA`, `NGAYXIN`, `NGAYCAP`, `NGAYHET`, `CONGTYXIN`, `TRANGTHAI`, `LOAIVISA`, `LSID`, `KHID`, `NVID`, `NV2ID`, `NGAYLAP`, `name_file`, `Mota`, `trangthaiviec`) VALUES
('HS00002', 'gsg', '2021-11-18', '2021-11-18', '2021-11-18', 'fvwsgsa', 'đã duyệt', '2133', 'LS00001', 'KH00001', 'NV00002', 'NV00003', '2021-11-18', 'Copywwriter.pdf', '', ''),
('HS00003', '11111111111', '2021-12-01', '2021-11-01', '2021-11-01', '1111111111111', 'đã duyệt', '[value-1]', '1111111111111', 'KH00004', 'NV00002', 'NV00002', '2021-11-28', '', '111111111111111', 'đã chúng tuyển'),
('HS00004', '3213', '2021-12-01', '2021-12-11', '2021-12-09', '3213213', 'chờ duyệt', '[value-1]', 'LS00001', 'KH00005', 'NV00002', 'NV00002', '2021-12-10', 'bg4k2.jpg', '234567', 'hủy yêu cầu'),
('HS00005', 'De', '2021-11-10', '2021-11-25', '2021-12-02', '32132', 'đã duyệt', '[value-1]', 'LS00001', 'KH00006', 'NV00002', 'NV00002', '2021-12-04', '', '12345678', 'đã chúng tuyển'),
('HS00006', '32123', '2021-11-26', '2021-12-03', '2021-11-25', '3213', 'chờ duyệt', '31232', 'LS00001', 'KH00008', 'NV00002', 'NV00002', '2021-12-02', '5181000B-NguyenThanhTung.docx', '2456789', 'chưa phỏng vấn'),
('HS00007', 'De', '2021-12-09', '2021-12-03', '2021-12-02', '32132', 'đã duyệt', '2133', '21212', 'KH00009', 'NV00003', 'NV00002', '2021-12-04', '2020_11_26_20_11_IMG_0183.JPG', '2121212', 'đang chờ kết quả'),
('HS00008', '34253647586', '2021-11-26', '2021-11-26', '2021-12-08', '3456789', 'hết hạn', '2132', '2345678', 'KH00010', 'NV00002', 'NV00002', '2021-11-24', 'TB gửi chủ nhiệm các khoa về SV còn nợ môn GDTC.pdf', '23456', 'đang chờ kết quả'),
('HS00009', '213456789', '2021-11-20', '2021-11-26', '2021-11-26', '213456789', 'đã duyệt', '[value-1]', '2131456789', 'KH00011', 'NV00002', 'NV00002', '2021-12-02', 'TB gửi chủ nhiệm các khoa về SV còn nợ môn GDTC.pdf', '234536475', 'chưa phỏng vấn'),
('HS00010', 'De', '2021-11-26', '2021-11-26', '2021-12-02', '32132', 'chờ duyệt', '[value-1]', '1111', 'KH00012', 'NV00002', 'NV00002', '2021-12-09', 'TB gửi chủ nhiệm các khoa về SV còn nợ môn GDTC.pdf', '234567', 'chưa phỏng vấn');

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
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
