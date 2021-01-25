-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2020 at 09:23 AM
-- Server version: 8.0.20
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_applyjob`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `ad_ID` int(4) UNSIGNED ZEROFILL NOT NULL,
  `ad_username` varchar(50) NOT NULL,
  `ad_password` varchar(50) NOT NULL,
  `ad_name` varchar(100) NOT NULL,
  `emp_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`ad_ID`, `ad_username`, `ad_password`, `ad_name`, `emp_ID`) VALUES
(0001, 'admintest', 'admintest', 'Yanika Muangmee', '630500037');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE `tbl_answer` (
  `ans_ID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `q_ID` int NOT NULL,
  `ans` varchar(255) NOT NULL,
  `score` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`ans_ID`, `q_ID`, `ans`, `score`) VALUES
(000001, 1, '0', 0),
(000002, 1, '1', 0),
(000003, 1, '2', 1),
(000004, 1, '3', 0),
(000005, 1, '4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cate_ID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `cate_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cate_ID`, `cate_name`) VALUES
(001, 'ข้อสอบวัด IQ'),
(002, 'ข้อสอบวัด EQ'),
(003, 'ข้อสอบคณิต'),
(009, 'สวยๆ'),
(010, 'สวยๆ'),
(011, 'เทส'),
(012, 'รรร'),
(013, ''),
(014, 'mvdvds');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_eamdetail`
--

CREATE TABLE `tbl_eamdetail` (
  `exd_ID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ex_ID` int NOT NULL,
  `ans_ID` int NOT NULL,
  `score` int NOT NULL,
  `emp_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE `tbl_exam` (
  `ex_ID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `u_ID` int NOT NULL,
  `cate_ID` int NOT NULL,
  `ex_start` datetime NOT NULL,
  `ex_done` datetime NOT NULL,
  `ex_check` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_person`
--

CREATE TABLE `tbl_person` (
  `per_ID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `per_name` varchar(255) NOT NULL,
  `per_position1` varchar(100) NOT NULL,
  `per_position2` varchar(100) NOT NULL,
  `per_birthdate` varchar(50) NOT NULL,
  `per_gender` varchar(50) NOT NULL,
  `per_phone` varchar(50) NOT NULL,
  `per_line` varchar(50) NOT NULL,
  `per_email` varchar(100) NOT NULL,
  `per_edu` varchar(100) NOT NULL,
  `per_major` varchar(100) NOT NULL,
  `per_academy` varchar(255) NOT NULL,
  `per_gpa` varchar(100) NOT NULL,
  `per_work` varchar(510) NOT NULL,
  `per_pos` varchar(100) NOT NULL,
  `per_salary` varchar(50) NOT NULL,
  `per_news` varchar(100) NOT NULL,
  `per_pic` varchar(100) NOT NULL,
  `per_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_person`
--

INSERT INTO `tbl_person` (`per_ID`, `per_name`, `per_position1`, `per_position2`, `per_birthdate`, `per_gender`, `per_phone`, `per_line`, `per_email`, `per_edu`, `per_major`, `per_academy`, `per_gpa`, `per_work`, `per_pos`, `per_salary`, `per_news`, `per_pic`, `per_file`) VALUES
(000001, 'ddd', 'ddd', 'ddd', '25/06/2020', 'หญิง', 'ddd', 'ddd', 'yanika.naja@gj', 'ปริญญาตรี', 's', 'ssss', 'sss', 'ss', 'ss', 'sss', 'ss', 'images/ddd.jpg', 'images/ddd.jpg'),
(000002, 'ญานิกา ม่วงหมี', 'โปรแกรมเมอร์', '', '25/06/2020', 'หญิง', '0806599023', 'yanikanaka', 'yanika.naja@gj', 'ปริญญาตรี', 'เทคโนโลยีสารสนเทศ', 'มหาวิทยาลัยธนบุรี', '3.88', 'บมจ. อาซีฟา', 'โปรแกรมเมอร์', '15000', 'line', 'images/ญานิกา ม่วงหมี.jpg', 'images/ญานิกา ม่วงหมี.jpg'),
(000003, 'ญานิกา ม่วงหมี', 'โปรแกรมเมอร์', '', '25/06/2020', 'หญิง', '0806599023', 'yanikanaka', 'yanika.naja@gj', 'ปริญญาตรี', 'เทคโนโลยีสารสนเทศ', 'มหาวิทยาลัยธนบุรี', '3.88', 'บมจ. อาซีฟา', 'โปรแกรมเมอร์', '15000', 'line', 'images/ญานิกา ม่วงหมี-profile.jpg', 'images/ญานิกา ม่วงหมี-file.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `q_ID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `cate_ID` int NOT NULL,
  `q_type` int NOT NULL,
  `detail` varchar(510) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`q_ID`, `cate_ID`, `q_type`, `detail`) VALUES
(000001, 1, 1, '1+1 เท่ากับเท่าไร?');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `u_ID` int(6) UNSIGNED ZEROFILL NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `u_idcard` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `u_date` date NOT NULL,
  `u_status` int NOT NULL,
  `u_username` varchar(20) NOT NULL,
  `u_password` varchar(20) NOT NULL,
  `cate_IDs` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `u_details` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `u_picture` varchar(100) DEFAULT NULL,
  `u_file1` varchar(100) DEFAULT NULL,
  `u_file2` varchar(100) DEFAULT NULL,
  `u_file3` varchar(100) DEFAULT NULL,
  `u_file4` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`u_ID`, `u_name`, `u_idcard`, `u_date`, `u_status`, `u_username`, `u_password`, `cate_IDs`, `u_details`, `u_picture`, `u_file1`, `u_file2`, `u_file3`, `u_file4`) VALUES
(000001, 'สมพงษ์ อนันตาสาร', '888888888888', '2020-07-08', 0, 'user', '12345', '001,003,007', NULL, NULL, NULL, NULL, NULL, NULL),
(000002, '11111', '', '2020-07-10', 0, 'yanika', '11111', '', NULL, NULL, NULL, NULL, NULL, NULL),
(000003, '11111', '', '2020-07-10', 0, 'yanika2', '11111', '', NULL, NULL, NULL, NULL, NULL, NULL),
(000004, '11111', '', '2020-07-10', 0, 'yanika3', '11111', '', NULL, NULL, NULL, NULL, NULL, NULL),
(000005, '11111', '', '2020-07-10', 0, 'yanika4', '11111', '', NULL, NULL, NULL, NULL, NULL, NULL),
(000006, '11111', NULL, '2020-07-10', 0, 'yanika5', '11111', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(000007, '11111', NULL, '2020-07-10', 0, 'yanika6', '22222', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`ad_ID`);

--
-- Indexes for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD PRIMARY KEY (`ans_ID`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cate_ID`);

--
-- Indexes for table `tbl_eamdetail`
--
ALTER TABLE `tbl_eamdetail`
  ADD PRIMARY KEY (`exd_ID`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD PRIMARY KEY (`ex_ID`);

--
-- Indexes for table `tbl_person`
--
ALTER TABLE `tbl_person`
  ADD PRIMARY KEY (`per_ID`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`q_ID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`u_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `ad_ID` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  MODIFY `ans_ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cate_ID` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_eamdetail`
--
ALTER TABLE `tbl_eamdetail`
  MODIFY `exd_ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  MODIFY `ex_ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_person`
--
ALTER TABLE `tbl_person`
  MODIFY `per_ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `q_ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `u_ID` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
