-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 10:46 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(6, 'social_worker', 'user@123');

-- --------------------------------------------------------

--
-- Table structure for table `assess_tbl`
--

CREATE TABLE `assess_tbl` (
  `ass_id` int(11) NOT NULL,
  `bene_cat` varchar(30) NOT NULL,
  `bene_sub_cat` varchar(30) NOT NULL,
  `other_cat` varchar(30) NOT NULL,
  `assess` varchar(100) NOT NULL,
  `mem1_fname` varchar(30) NOT NULL,
  `mem1_mname` varchar(30) NOT NULL,
  `mem1_lname` varchar(30) NOT NULL,
  `mem1_ext` varchar(30) NOT NULL,
  `mem1_rel_bene` varchar(30) NOT NULL,
  `mem1_age` varchar(30) NOT NULL,
  `mem1_work` varchar(30) NOT NULL,
  `mem1_kita` varchar(30) NOT NULL,
  `mem2_fname` varchar(30) NOT NULL,
  `mem2_mname` varchar(30) NOT NULL,
  `mem2_lname` varchar(30) NOT NULL,
  `mem2_ext` varchar(30) NOT NULL,
  `mem2_rel_bene` varchar(30) NOT NULL,
  `mem2_age` varchar(30) NOT NULL,
  `mem2_work` varchar(30) NOT NULL,
  `mem2_kita` varchar(30) NOT NULL,
  `mem3_fname` varchar(30) NOT NULL,
  `mem3_mname` varchar(30) NOT NULL,
  `mem3_lname` varchar(30) NOT NULL,
  `mem3_ext` varchar(30) NOT NULL,
  `mem3_rel_bene` varchar(30) NOT NULL,
  `mem3_age` varchar(30) NOT NULL,
  `mem3_work` varchar(30) NOT NULL,
  `mem3_kita` varchar(30) NOT NULL,
  `toa` varchar(30) NOT NULL,
  `toa_medical` varchar(30) NOT NULL,
  `toa_funeral` varchar(30) NOT NULL,
  `toa_financial` varchar(30) NOT NULL,
  `toa_material` varchar(30) NOT NULL,
  `pur` varchar(30) NOT NULL,
  `amount` varchar(30) NOT NULL,
  `moa` varchar(30) NOT NULL,
  `fund_source` varchar(30) NOT NULL,
  `social_worker` varchar(30) NOT NULL,
  `ciu_head` varchar(30) NOT NULL,
  `date_assess` date NOT NULL DEFAULT current_timestamp(),
  `mem_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assess_tbl`
--

INSERT INTO `assess_tbl` (`ass_id`, `bene_cat`, `bene_sub_cat`, `other_cat`, `assess`, `mem1_fname`, `mem1_mname`, `mem1_lname`, `mem1_ext`, `mem1_rel_bene`, `mem1_age`, `mem1_work`, `mem1_kita`, `mem2_fname`, `mem2_mname`, `mem2_lname`, `mem2_ext`, `mem2_rel_bene`, `mem2_age`, `mem2_work`, `mem2_kita`, `mem3_fname`, `mem3_mname`, `mem3_lname`, `mem3_ext`, `mem3_rel_bene`, `mem3_age`, `mem3_work`, `mem3_kita`, `toa`, `toa_medical`, `toa_funeral`, `toa_financial`, `toa_material`, `pur`, `amount`, `moa`, `fund_source`, `social_worker`, `ciu_head`, `date_assess`, `mem_id`) VALUES
(1, 'YOUTH', 'others', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'Aunt', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'Uncle', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'Family-friend', 'sample', 'sample', 'sample', 'Financial_Assistance', '', '', 'Educational_Assistance', '', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2023-01-18', NULL),
(2, 'PWD', '4PS_DSWD_Beneficiary', '', 'sample', 'sample2', 'sample2', 'sample2', 'sample2', 'Uncle', 'sample', 'sample', 'sample', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Financial_Assistance', '', '', 'Financial_Assistance', '', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2023-01-18', 9),
(3, 'PLHIV', '4PS_DSWD_Beneficiary', '', 'sample lang', 'sample4', 'sample3', 'sample3', 'sample3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Material_Assistance', '', '', '', 'Hygiene_or_Sleeping_kits', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', '2023-01-18', 1);

--
-- Triggers `assess_tbl`
--
DELIMITER $$
CREATE TRIGGER `update_mem_stat` AFTER INSERT ON `assess_tbl` FOR EACH ROW UPDATE member
     SET status = 'Assessed'
   WHERE mem_id= NEW.mem_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ca_tbl`
--

CREATE TABLE `ca_tbl` (
  `ca_id` int(11) NOT NULL,
  `sdo_id` int(11) NOT NULL,
  `noca` varchar(50) NOT NULL,
  `amount_ca` int(11) NOT NULL,
  `responsible_center` varchar(50) NOT NULL,
  `ors_num` varchar(50) NOT NULL,
  `dv_num` varchar(50) NOT NULL,
  `uacs_object_num` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_tbl`
--

INSERT INTO `ca_tbl` (`ca_id`, `sdo_id`, `noca`, `amount_ca`, `responsible_center`, `ors_num`, `dv_num`, `uacs_object_num`) VALUES
(1, 2, 'Financial_Assistance', 111111, 'sample', '', '', ''),
(2, 2, 'Educational', 222222, 'sample', '', '', ''),
(3, 1, 'Material_Assistance', 333333, 'sample2', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cd_tbl`
--

CREATE TABLE `cd_tbl` (
  `cd_id` int(11) NOT NULL,
  `sdo_id` int(11) NOT NULL,
  `pay_date` date NOT NULL,
  `dv` varchar(30) NOT NULL,
  `ors` varchar(30) NOT NULL,
  `responsible_center` varchar(255) NOT NULL,
  `bene_id` int(11) NOT NULL,
  `uacs_object` varchar(30) NOT NULL,
  `nop` varchar(30) NOT NULL,
  `amount` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ce_tbl`
--

CREATE TABLE `ce_tbl` (
  `ce_id` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `date_assess` date NOT NULL,
  `ben_lname` varchar(30) NOT NULL,
  `ben_fname` varchar(30) NOT NULL,
  `ben_mname` varchar(30) NOT NULL,
  `ben_ext` varchar(30) NOT NULL,
  `ben_sex` varchar(30) NOT NULL,
  `ben_age` varchar(30) NOT NULL,
  `ben_reg` varchar(30) DEFAULT NULL,
  `ben_prov` varchar(30) DEFAULT NULL,
  `ben_city` varchar(30) DEFAULT NULL,
  `ben_bgy` varchar(30) NOT NULL,
  `ben_st` varchar(30) NOT NULL,
  `rep_lname` varchar(30) NOT NULL,
  `rep_fname` varchar(30) NOT NULL,
  `rep_mname` varchar(30) NOT NULL,
  `rep_ext` varchar(30) NOT NULL,
  `rep_rel_ben` varchar(30) DEFAULT NULL,
  `other_rel` varchar(30) NOT NULL,
  `gis` varchar(255) NOT NULL,
  `pantawid_id` varchar(30) NOT NULL,
  `just` varchar(30) NOT NULL,
  `med_cert_abs` varchar(30) NOT NULL,
  `prescript` varchar(30) NOT NULL,
  `soa` varchar(30) NOT NULL,
  `treat_proc` varchar(30) NOT NULL,
  `quotation` varchar(30) NOT NULL,
  `dis_sum` varchar(30) NOT NULL,
  `lab_req` varchar(30) NOT NULL,
  `charge_slip` varchar(30) NOT NULL,
  `funeral_cont` varchar(30) NOT NULL,
  `death_cert` varchar(30) NOT NULL,
  `det_sum` varchar(30) NOT NULL,
  `ref_let` varchar(30) NOT NULL,
  `soc_cas_stud_rep` varchar(30) NOT NULL,
  `val_id` varchar(30) NOT NULL,
  `other_doc` varchar(30) NOT NULL,
  `toa` varchar(30) DEFAULT NULL,
  `toa_medical` varchar(30) DEFAULT NULL,
  `toa_funeral` varchar(30) DEFAULT NULL,
  `toa_financial` varchar(30) DEFAULT NULL,
  `toa_material` varchar(30) DEFAULT NULL,
  `amount` varchar(30) NOT NULL,
  `a_year` varchar(30) NOT NULL,
  `social_worker` varchar(30) NOT NULL,
  `ciu_head` varchar(30) NOT NULL,
  `sdo_id` int(11) NOT NULL,
  `swo_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ce_tbl`
--

INSERT INTO `ce_tbl` (`ce_id`, `category`, `date_assess`, `ben_lname`, `ben_fname`, `ben_mname`, `ben_ext`, `ben_sex`, `ben_age`, `ben_reg`, `ben_prov`, `ben_city`, `ben_bgy`, `ben_st`, `rep_lname`, `rep_fname`, `rep_mname`, `rep_ext`, `rep_rel_ben`, `other_rel`, `gis`, `pantawid_id`, `just`, `med_cert_abs`, `prescript`, `soa`, `treat_proc`, `quotation`, `dis_sum`, `lab_req`, `charge_slip`, `funeral_cont`, `death_cert`, `det_sum`, `ref_let`, `soc_cas_stud_rep`, `val_id`, `other_doc`, `toa`, `toa_medical`, `toa_funeral`, `toa_financial`, `toa_material`, `amount`, `a_year`, `social_worker`, `ciu_head`, `sdo_id`, `swo_admin`) VALUES
(1, 'Walkin', '2023-02-02', 'sample11', 'sample11', 'sample', 'sample11', 'Male', 'sample11', 'National_Capital_Region', 'NCR_District_1_Manila', 'Caloocan', 'sample11', 'sample11', 'sample11', 'sample11', 'sample', 'sample11', '1', 'sample11', 'Discharge Summary,Laboratory Request,Charge Slip', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', '', '', '1', 'Hospital_Bill', 'Transfer_of_Cadever', '1', '', 'sample11', 'sample11', 'sample11', '', 1, 'sample11'),
(2, 'New', '2023-02-02', 'sample1', 'sample1', 'sample1', 'sample1', 'Male', 'sample1', 'NCR', 'NCR_District_1_Manila', 'Caloocan', 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', 'Uncle', 'sample1', 'GIS,4PS DSWD ID,Justification,Medical Certificate/Abstract', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', 'GIS,4PS DSWD ID,Justification,', '', '', 'Financial_Assistance', '', '', 'Transportation_Assistance', '', 'sample1', 'sample1', 'sample1', '', 2, 'sample1'),
(3, 'Walkin', '2023-02-02', 'sample2', 'sample2', 'sample2', 'sample2', 'Male', 'sample2', 'NCR', 'NCR_District_1_Manila', 'Caloocan', 'sample2', 'sample2', 'sample2', 'sample2', 'sample2', 'sample2', 'Grandmother', '', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'Discharge Summary,Laboratory R', 'sample2', 'sample2', 'Financial_Assistance', '', '', 'Medical_Assistance', '', 'sample2', 'sample2', 'sample2', 'sample2', 2, 'sample2'),
(4, 'Referral', '2023-02-02', 'sample3', 'sample3', 'sample3', 'sample3', 'Male', 'sample3', 'NCR', 'NCR_District_1_Manila', 'Caloocan', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'Grandfather', '', 'Medical Certificate/Abstract,Discharge Summary,Laboratory Request,Charge Slip,Social Case Study Report', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'Medical Certificate/Abstract,D', 'sample3', 'sample3', 'Financial_Assistance', '', '', 'Medical_Assistance', '', 'sample3', 'sample3', 'sample3', 'sample3', 2, 'sample3'),
(5, 'Referral', '2023-02-02', 'sample4', 'sample4', 'sample4', 'sample4', 'Male', 'sample4', 'NCR', 'NCR_District_1_Manila', 'Caloocan', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'Grandmother', 'sample4', 'GIS,Medical Certificate/Abstract,Statement of Account,Treatment Protocol,Laboratory Request,Referral Letter,Social Case Study Report', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'sample4', 'sample4', 'Financial_Assistance', '', '', 'Medical_Assistance', '', 'sample4', 'sample4', 'sample4', 'sample4', 2, 'sample4'),
(6, 'New', '2023-03-24', 'sample5', 'sample5', 'sample5', 'sample5', 'Male', 'sample5', 'NCR', 'NCR_District_1_Manila', 'Caloocan', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'Uncle', 'sample5', 'GIS,4PS DSWD ID,Discharge Summary,Laboratory Request', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'GIS,4PS DSWD ID,Discharge Summ', 'sample5', 'sample5', 'Financial_Assistance', '', '', 'Medical_Assistance', '', 'sample5', 'sample5', 'sample5', 'sample5', 2, 'sample5'),
(7, 'Walkin', '2023-03-28', 'sample6', 'sample6', 'sample6', 'sample6', 'Male', 'sample6', 'NCR', 'NCR_District_1_Manila', 'Caloocan', 'sample6', 'sample6', 'sample6', 'sample6', 'sample6', 'sample6', 'Grandfather', '', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'GIS,4PS DSWD ID,Justification', 'sample6', '', 'Financial_Assistance', '', '', 'Financial_Assistance', '', 'sample6', 'sample6', 'sample6', 'sample6', 7, 'sample6'),
(8, 'Returning', '2023-03-29', 'sample7', 'sample7', 'sample7', 'sample7', 'Male', 'sample7', 'NCR', 'NCR_District_1_Manila', 'Malabon', 'sample7', 'sample7', 'sample7', 'sample7', 'sample7', 'sample7', 'Aunt', '', 'Medical Certificate/Abstract,Prescription,Statement of Account', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'Medical Certificate/Abstract,P', 'sample7', 'sample7', 'Educational', '', '', '', '', 'sample7', 'sample7', 'sample7', 'sample7', 2, 'sample7'),
(9, 'Returning', '2023-03-29', 'sample8', 'sample8', 'sample8', 'sample8', 'Male', 'sample8', 'NCR', 'NCR_District_1_Manila', 'Caloocan', 'sample8', 'sample8', 'sample8', 'sample8', 'sample8', 'sample8', 'Uncle', 'sample8', 'Statement of Account,Treatment Protocol,Quotation', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'Statement of Account,Treatment', 'sample8', 'sample8', 'Educational', '', '', '', '', 'sample8', 'sample8', 'sample8', 'sample8', 2, ''),
(10, 'Returning', '2023-03-29', 'sample9', 'sample9', 'sample9', 'sample9', 'Male', 'sample9', 'NCR', 'NCR_District_2', 'Las_Pinas', 'sample9', 'sample9', 'sample9', 'sample9', 'sample9', 'sample9', 'Grandfather', '', 'Death Summary,Referral Letter,Social Case Study Report', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'Death Summary,Referral Letter,', 'sample9', 'sample9', 'Educational', '', '', '', '', 'sample9', 'sample9', 'sample9', 'sample9', 2, 'sample9'),
(11, 'Referral', '2023-03-29', 'sample10', 'sample10', 'sample10', 'sample10', 'Male', 'sample10', 'NCR', 'NCR_District_1_Manila', 'Makati', 'sample10', 'sample10', 'sample10', 'sample10', 'sample10', 'sample10', 'Mother', 'sample10', 'Treatment Protocol,Quotation,Social Case Study Report', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'Treatment Protocol,Quotation,S', 'sample10', 'sample10', 'Educational', '', '', '', '', 'sample10', 'sample10', 'sample10', 'sample10', 1, 'sample10');

-- --------------------------------------------------------

--
-- Table structure for table `cheque_tbl`
--

CREATE TABLE `cheque_tbl` (
  `cheque_id` int(11) NOT NULL,
  `sdo_id` int(11) NOT NULL,
  `cheque_no` varchar(30) NOT NULL,
  `cheque_date` date NOT NULL,
  `ca_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cheque_tbl`
--

INSERT INTO `cheque_tbl` (`cheque_id`, `sdo_id`, `cheque_no`, `cheque_date`, `ca_id`) VALUES
(1, 1, 'sample', '2023-01-24', 0),
(2, 1, '12345', '2023-01-24', 0),
(3, 1, '11111', '2023-01-24', 0),
(4, 1, '22222', '2023-01-24', 0),
(5, 1, '33333333', '2023-01-24', 0),
(6, 1, '333333', '2023-01-24', 0),
(7, 2, 'sample1', '2023-01-24', 0),
(8, 2, 'sample2', '2023-01-24', 0),
(9, 2, '44444', '2023-01-24', 0),
(10, 2, '55555', '2023-01-24', 0),
(11, 1, '77777', '2023-01-24', 0),
(12, 1, '88888', '2023-01-24', 0),
(13, 2, '99999', '2023-01-26', 0),
(14, 5, '1111111111', '2023-03-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `club_id` int(11) NOT NULL,
  `club_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`club_id`, `club_name`) VALUES
(1, 'PSP'),
(3, 'SOCPEN'),
(4, 'sample'),
(5, 'sample2');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `group_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `club_id`, `mem_id`) VALUES
(4, 1, 1),
(5, 3, 7),
(6, 1, 12),
(7, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `ce_id` int(11) NOT NULL,
  `filename` varchar(80) NOT NULL,
  `filepath` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `ce_id`, `filename`, `filepath`) VALUES
(1, 1, 'Acer_Wallpaper_01_5000x2813.jpg', 'upload/Acer_Wallpaper_01_5000x2813.jpg'),
(2, 1, 'Acer_Wallpaper_02_5000x2813.jpg', 'upload/Acer_Wallpaper_02_5000x2813.jpg'),
(3, 1, 'Acer_Wallpaper_03_5000x2813.jpg', 'upload/Acer_Wallpaper_03_5000x2813.jpg'),
(4, 1, 'Planet9_Wallpaper_5000x2813.jpg', 'upload/Planet9_Wallpaper_5000x2813.jpg'),
(5, 1, 'Capture.PNG', 'upload/Capture.PNG'),
(6, 1, 'vac id front.PNG', 'upload/vac id front.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_id` int(11) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `ext` varchar(10) NOT NULL,
  `st` varchar(30) NOT NULL,
  `bgy` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `region` varchar(30) NOT NULL,
  `cp` varchar(30) NOT NULL,
  `bdate` date NOT NULL,
  `age` varchar(30) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `work` varchar(30) NOT NULL,
  `kita` varchar(30) NOT NULL,
  `rep_lname` varchar(30) NOT NULL,
  `rep_fname` varchar(30) NOT NULL,
  `rep_mname` varchar(30) NOT NULL,
  `rep_ext` varchar(30) NOT NULL,
  `rep_st` varchar(30) NOT NULL,
  `rep_bgy` varchar(30) NOT NULL,
  `rep_city` varchar(30) NOT NULL,
  `rep_prov` varchar(30) NOT NULL,
  `rep_region` varchar(30) NOT NULL,
  `rep_cp` varchar(30) NOT NULL,
  `rep_bdate` varchar(30) NOT NULL,
  `rep_rel_bene` varchar(30) NOT NULL,
  `rep_rel` varchar(30) NOT NULL,
  `type_of_assistance` varchar(30) NOT NULL,
  `toa_med` varchar(30) NOT NULL,
  `toa_fun` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'NEW'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_id`, `lastname`, `firstname`, `middlename`, `ext`, `st`, `bgy`, `city`, `province`, `region`, `cp`, `bdate`, `age`, `sex`, `work`, `kita`, `rep_lname`, `rep_fname`, `rep_mname`, `rep_ext`, `rep_st`, `rep_bgy`, `rep_city`, `rep_prov`, `rep_region`, `rep_cp`, `rep_bdate`, `rep_rel_bene`, `rep_rel`, `type_of_assistance`, `toa_med`, `toa_fun`, `status`) VALUES
(1, 'Dela Cruz', 'Juan', 'toma', '', 'malabon', 'balong bato', 'Caloocan', 'NCR_District_3', 'NCR', '', '2022-12-05', '', 'Female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Transportation', '', '', 'Assessed'),
(7, 'De Luna', 'Axe axx', 'buco', 'sample', 'manila', 'calabao', 'Makati', 'NCR_District_2', 'NCR', 'sample', '2022-12-08', 'sample', 'Female', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'Makati', 'NCR_District_1_Manila', 'NCR', 'sample', '2023-01-06', 'other_relation', 'sample', 'Medical', '', '', 'NEW'),
(8, 'member', 'member', 'member', 'jr', 'manila', '123', 'Makati', 'NCR_District_1_Manila', 'NCR', '', '2022-12-05', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Financial', '', '', 'NEW'),
(9, 'Abayato', 'Chris bon', 'M', '', 'manila', '123', 'Manila', 'NCR_District_1_Manila', 'NCR', '', '2012-05-09', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Financial', '', '', 'Assessed'),
(10, 'SAM', 'TOM', 'c', '', 'manila', 'calabao', 'Manila', 'NCR_District_1_Manila', 'NCR', '', '2023-01-03', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Financial', '', '', 'NEW'),
(12, 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'Caloocan', 'NCR_District_1_Manila', 'NCR', '', '2023-01-04', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Financial', '', '', 'NEW'),
(13, 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', 'Caloocan', 'NCR_District_2', 'NCR', '', '2023-01-04', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Financial', '', '', 'NEW'),
(14, 'sample2', 'sample22', 'sample2', 'sample2', 'sample2', 'sample2', 'Caloocan', 'NCR_District_1_Manila', 'NCR', '', '2023-01-04', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Financial', '', '', 'NEW'),
(15, 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'Caloocan', 'NCR_District_1_Manila', 'NCR', '', '2023-01-04', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Financial', '', '', 'NEW'),
(16, 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'Caloocan', 'NCR_District_1_Manila', 'NCR', '', '2023-01-05', '', 'Male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Medical', '', '', 'NEW'),
(17, 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'Malabon', 'NCR_District_2', 'NCR', 'sample5', '2023-01-05', 'sample5', 'Female', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'Las_Pinas', 'NCR_District_4', 'NCR', 'sample5', '2023-01-05', 'other_relation', 'sample5', 'Medical', 'Medicine', 'Select Type of Assistance', 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `req_tbl`
--

CREATE TABLE `req_tbl` (
  `req_id` int(11) NOT NULL,
  `ce_id` int(11) NOT NULL,
  `gis` varchar(255) DEFAULT NULL,
  `pantawid_id` varchar(255) DEFAULT NULL,
  `just` varchar(255) DEFAULT NULL,
  `med_cert_abs` varchar(255) DEFAULT NULL,
  `prescript` varchar(255) DEFAULT NULL,
  `soa` varchar(255) DEFAULT NULL,
  `treat_proc` varchar(255) DEFAULT NULL,
  `quotation` varchar(255) DEFAULT NULL,
  `dis_sum` varchar(255) DEFAULT NULL,
  `lab_req` varchar(255) DEFAULT NULL,
  `charge_slip` varchar(255) DEFAULT NULL,
  `funeral_cont` varchar(255) DEFAULT NULL,
  `death_cert` varchar(255) DEFAULT NULL,
  `det_sum` varchar(255) DEFAULT NULL,
  `ref_let` varchar(255) DEFAULT NULL,
  `soc_cas_stud_rep` varchar(255) DEFAULT NULL,
  `valid_id` varchar(255) DEFAULT NULL,
  `cert_indigency` varchar(255) DEFAULT NULL,
  `other_req` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `req_tbl`
--

INSERT INTO `req_tbl` (`req_id`, `ce_id`, `gis`, `pantawid_id`, `just`, `med_cert_abs`, `prescript`, `soa`, `treat_proc`, `quotation`, `dis_sum`, `lab_req`, `charge_slip`, `funeral_cont`, `death_cert`, `det_sum`, `ref_let`, `soc_cas_stud_rep`, `valid_id`, `cert_indigency`, `other_req`) VALUES
(1, 1, 'Acer_Wallpaper_01_5000x2813.jpg', 'Acer_Wallpaper_02_5000x2813.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'Acer_Wallpaper_03_5000x2813.jpg', 'Planet9_Wallpaper_5000x2813.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, '4.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'qr_code_PNG25.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9ebeacb2-4272-4f7f-845e-0bec7bbd6db2.jpg'),
(6, 1, NULL, NULL, NULL, NULL, NULL, NULL, '4.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sdo_img`
--

CREATE TABLE `sdo_img` (
  `imgsdo_id` int(11) NOT NULL,
  `sdo_id` int(11) NOT NULL,
  `filename` varchar(80) NOT NULL,
  `filepath` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sdo_img`
--

INSERT INTO `sdo_img` (`imgsdo_id`, `sdo_id`, `filename`, `filepath`) VALUES
(1, 1, 'engas.PNG', 'sdo_upload/engas.PNG'),
(2, 1, 'error caloocans.PNG', 'sdo_upload/error caloocans.PNG'),
(3, 1, 'error.PNG', 'sdo_upload/error.PNG'),
(4, 1, 'ewwoww.PNG', 'sdo_upload/ewwoww.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `sdo_tbl`
--

CREATE TABLE `sdo_tbl` (
  `sdo_id` int(11) NOT NULL,
  `sdo_fname` varchar(30) NOT NULL,
  `sdo_mname` varchar(30) NOT NULL,
  `sdo_lname` varchar(30) NOT NULL,
  `sdo_ext` varchar(30) NOT NULL,
  `sdo_emp_id` varchar(30) NOT NULL,
  `sdo_office` varchar(30) NOT NULL,
  `sdo_unit` varchar(30) NOT NULL,
  `sdo_pos` varchar(30) NOT NULL,
  `sdo_emp_status` varchar(30) NOT NULL,
  `year_sdo` varchar(30) NOT NULL,
  `cp` varchar(30) NOT NULL,
  `ors` varchar(255) NOT NULL,
  `dv` varchar(255) NOT NULL,
  `rso` varchar(255) NOT NULL,
  `rso_ben` varchar(255) NOT NULL,
  `conca` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sdo_tbl`
--

INSERT INTO `sdo_tbl` (`sdo_id`, `sdo_fname`, `sdo_mname`, `sdo_lname`, `sdo_ext`, `sdo_emp_id`, `sdo_office`, `sdo_unit`, `sdo_pos`, `sdo_emp_status`, `year_sdo`, `cp`, `ors`, `dv`, `rso`, `rso_ben`, `conca`, `fb`) VALUES
(1, 'samplee', 'samplee', 'samplee', 'samplee', 'samplee', 'samplee', 'samplee', 'samplee', 'samplee', '2022', 'sample6', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond'),
(2, 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', 'sample1', '2022', 'sample1', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond'),
(3, 'sample2', 'sample2', 'sample2', 'sample2', 'sample2', 'sample2', 'sample2', 'sample2', 'sample2', '2024', 'sample1', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond'),
(4, 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', 'sample3', '2023', 'sample3', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond'),
(5, 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', 'sample4', '2020', 'sample4', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond'),
(6, 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', 'sample5', '2023', 'sample5', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond'),
(7, 'sample6', 'sample6', 'sample6', 'sample6', 'sample6', 'sample6', 'sample6', 'sample6', 'sample6', '2023', 'sample6', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assess_tbl`
--
ALTER TABLE `assess_tbl`
  ADD PRIMARY KEY (`ass_id`);

--
-- Indexes for table `ca_tbl`
--
ALTER TABLE `ca_tbl`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `cd_tbl`
--
ALTER TABLE `cd_tbl`
  ADD PRIMARY KEY (`cd_id`);

--
-- Indexes for table `ce_tbl`
--
ALTER TABLE `ce_tbl`
  ADD PRIMARY KEY (`ce_id`);

--
-- Indexes for table `cheque_tbl`
--
ALTER TABLE `cheque_tbl`
  ADD PRIMARY KEY (`cheque_id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `req_tbl`
--
ALTER TABLE `req_tbl`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `sdo_img`
--
ALTER TABLE `sdo_img`
  ADD PRIMARY KEY (`imgsdo_id`);

--
-- Indexes for table `sdo_tbl`
--
ALTER TABLE `sdo_tbl`
  ADD PRIMARY KEY (`sdo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assess_tbl`
--
ALTER TABLE `assess_tbl`
  MODIFY `ass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ca_tbl`
--
ALTER TABLE `ca_tbl`
  MODIFY `ca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cd_tbl`
--
ALTER TABLE `cd_tbl`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ce_tbl`
--
ALTER TABLE `ce_tbl`
  MODIFY `ce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cheque_tbl`
--
ALTER TABLE `cheque_tbl`
  MODIFY `cheque_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `req_tbl`
--
ALTER TABLE `req_tbl`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sdo_img`
--
ALTER TABLE `sdo_img`
  MODIFY `imgsdo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sdo_tbl`
--
ALTER TABLE `sdo_tbl`
  MODIFY `sdo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
