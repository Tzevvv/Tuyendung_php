-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 12, 2022 lúc 08:27 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

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
('00001', '0000-00-00', '00003', '2022-02-11', 1, '0000-00-00', 0, '0000-00-00', 0, 1, '00004', '111'),
('00002', '0000-00-00', '00002', '2022-02-12', 1, '0000-00-00', 0, '0000-00-00', 0, 1, '00003', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `ID` int(11) NOT NULL,
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
  `CONGTYXIN` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `NGAYLAP` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`ID`, `KHID`, `NAMEKH`, `PHONEKH`, `EMAIL`, `DIACHI`, `USERID`, `gioitinh`, `bangcap`, `nangluc`, `nguyenvong`, `trangthaiviec`, `quoctich`, `CONGTYXIN`, `NGAYLAP`) VALUES
(12, '00002', 'tenkhach', '0982436274', 'tungcf69@gmail.com', '32323213', 19, 'nam', '32132', '1111', '0982436274', '結果待ち', '32132', '32132', '2022-02-11'),
(13, '00004', 'tenkhach', '(+84) 982436274', 'tungcf69@gmail.com', '12323', 20, 'nam', '1', '21212', '(+84) 982436274', '面接まだ', '1', '32132', '2022-02-11'),
(14, '00003', 'Nguyễn thanh tùng', '1234', ' tungcf69@gmail.com1', '(+84) 982436274', 21, 'nam', '2342', '2121', '222', '結果待ち', 'ハローベイビー', '1 ', '2022-02-11');

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
('医療滞在ビザ – Iryō taizai biza', 'Visa lưu trú y tế để chữa bệnh'),
('定住 – Teijuu', 'Visa cư trú lâu dài '),
('家族滞在 Kazoku taizai', 'Sống cùng gia đình'),
('就労ビザ – Shuurou biza', 'Visa lao động'),
('日本人配偶者 – Nihonjin haiguusha', 'Vợ/chồng của người Nhật'),
('永住 – Eijuu', 'Visa cư trú vĩnh viễn'),
('永住者配偶者 – Eijuusha haiguusha', 'Người là vợ/chồng của người có vĩnh trú'),
('留学 Ryuugaku', 'Visa du học'),
('観光ビザ – Kankou biza', 'Visa du lịch (cá nhân)'),
('難民 – Nanmin', 'Dân tị nạn');

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
  `ID` int(11) NOT NULL,
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

INSERT INTO `nhanvien` (`ID`, `NVID`, `NAMENV`, `PHONE`, `EMAIL`, `DIACHI`, `USERID`, `NVCONGTY`) VALUES
(17, '00003', 'TUNG', '21212', 'tungcf69@gmail.com', '1', 17, '21212'),
(18, '00004', 'DUAN', '321321', 'tungcf69@gmail.com', '1', 18, '321321');

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
(17, 'nv1', '123456', '1', '0'),
(18, 'nv2', '123456', '1', '0'),
(19, 'kh1', '123456', '2', 'BZN3QR'),
(20, 'kh2', '123456', '2', 'UALT4H'),
(21, 'kh3', '123456', '2', 'CUWHYR');

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
  `ID` int(11) NOT NULL,
  `VISAID` varchar(255) NOT NULL,
  `TENVISA` varchar(100) NOT NULL,
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

INSERT INTO `visa` (`ID`, `VISAID`, `TENVISA`, `NGAYXIN`, `NGAYCAP`, `NGAYHET`, `CONGTYXIN`, `TRANGTHAI`, `LOAIVISA`, `LSID`, `KHID`, `NVID`, `NV2ID`, `NGAYLAP`, `name_file`, `Mota`) VALUES
(9, '00003', 'De', '2022-02-11', '2022-02-19', '2022-03-04', '1 ', '321', '医療滞在ビザ – Iryō taizai biza', '1232133', '00003', '00004', '00004', '2022-02-11', 'favicon.png', '1234'),
(10, '00002', 'De', '2022-02-04', '2022-02-11', '2022-02-11', '3213213', '321', '医療滞在ビザ – Iryō taizai biza', 'LS00001', '00002', '00003', '00004', '2022-02-11', 'favicon.png', '1111');

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
  ADD PRIMARY KEY (`ID`);

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
  ADD PRIMARY KEY (`ID`);

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
-- Chỉ mục cho bảng `visa`
--
ALTER TABLE `visa`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tag`
--
ALTER TABLE `tag`
  MODIFY `tagid` int(110) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `USERID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `visa`
--
ALTER TABLE `visa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
