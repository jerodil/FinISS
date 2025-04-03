-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 04:25 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
  `ce_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assess_tbl`
--

INSERT INTO `assess_tbl` (`ass_id`, `bene_cat`, `bene_sub_cat`, `other_cat`, `assess`, `mem1_fname`, `mem1_mname`, `mem1_lname`, `mem1_ext`, `mem1_rel_bene`, `mem1_age`, `mem1_work`, `mem1_kita`, `mem2_fname`, `mem2_mname`, `mem2_lname`, `mem2_ext`, `mem2_rel_bene`, `mem2_age`, `mem2_work`, `mem2_kita`, `mem3_fname`, `mem3_mname`, `mem3_lname`, `mem3_ext`, `mem3_rel_bene`, `mem3_age`, `mem3_work`, `mem3_kita`, `toa`, `toa_medical`, `toa_funeral`, `toa_financial`, `toa_material`, `pur`, `amount`, `moa`, `fund_source`, `social_worker`, `ciu_head`, `date_assess`, `ce_id`) VALUES
(1, 'YOUTH', 'Street_Dwellers', '', 'Eligible', 'Glenn', 'C', 'Lopez', '', 'Brother', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Medical', 'Hospital_Bill', '', '', '', 'Allowance', '5000', 'CASH', 'CA', 'Julius Taguiam', 'Jervin Regio', '2023-09-18', 1);

--
-- Triggers `assess_tbl`
--
DELIMITER $$
CREATE TRIGGER `update_mem_stat` AFTER INSERT ON `assess_tbl` FOR EACH ROW UPDATE ce_tbl
     SET status_bene = 'ASSESSED'
   WHERE ce_id= NEW.ce_id
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
  `amount_ca` int(30) NOT NULL,
  `responsible_center` varchar(50) NOT NULL,
  `ors_num` varchar(50) NOT NULL,
  `dv_num` varchar(50) NOT NULL,
  `uacs_object_num` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ca_tbl`
--

INSERT INTO `ca_tbl` (`ca_id`, `sdo_id`, `noca`, `amount_ca`, `responsible_center`, `ors_num`, `dv_num`, `uacs_object_num`) VALUES
(1, 1, 'Medical', 1500000, 'RICTMS', '20-01-00116', '20-01-00116', '52011990-00'),
(2, 2, 'Financial_Assistance', 500000, 'PPD', '2000-000-111', '2000-000-111', '50211990-11'),
(3, 3, 'Financial_Assistance', 100000, 'sample', '12345', '12345', '12345');

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
  `amount` int(30) NOT NULL,
  `a_year` varchar(30) NOT NULL,
  `social_worker` varchar(30) NOT NULL,
  `ciu_head` varchar(30) NOT NULL,
  `sdo_id` int(11) NOT NULL,
  `ca_id` int(11) NOT NULL,
  `swo_admin` varchar(30) NOT NULL,
  `status_bene` varchar(30) NOT NULL DEFAULT 'NEW'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ce_tbl`
--

INSERT INTO `ce_tbl` (`ce_id`, `category`, `date_assess`, `ben_lname`, `ben_fname`, `ben_mname`, `ben_ext`, `ben_sex`, `ben_age`, `ben_reg`, `ben_prov`, `ben_city`, `ben_bgy`, `ben_st`, `rep_lname`, `rep_fname`, `rep_mname`, `rep_ext`, `rep_rel_ben`, `other_rel`, `gis`, `pantawid_id`, `just`, `med_cert_abs`, `prescript`, `soa`, `treat_proc`, `quotation`, `dis_sum`, `lab_req`, `charge_slip`, `funeral_cont`, `death_cert`, `det_sum`, `ref_let`, `soc_cas_stud_rep`, `val_id`, `other_doc`, `toa`, `toa_medical`, `toa_funeral`, `toa_financial`, `toa_material`, `amount`, `a_year`, `social_worker`, `ciu_head`, `sdo_id`, `ca_id`, `swo_admin`, `status_bene`) VALUES
(1, 'New', '2023-09-18', 'Lopez', 'Glenn', 'C', '', 'Male', '35', 'NCR', 'NCR_District_1_Manila', 'Manila', '365', 'Blumintritt', 'Almazan', 'Mike', 'C', '', 'Brother', '', 'GIS,Justification,Medical Certificate/Abstract', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'GIS,Justification,Medical Cert', 'BGY ID', 'Bgy Certification', 'Medical', 'Hospital_Bill', '', '', '', 5000, '2023', 'Julius Taguiam', 'Jervin Regio', 1, 1, 'Michael Mercado', 'ASSESSED'),
(2, 'New', '2023-09-18', 'Cometa', 'Cha', 'D', '', 'Male', '25', 'NCR', 'NCR_District_1_Manila', 'Makati', 'cembo', '24', 'Almazan', 'Albert', 'V', '', 'Brother', '', 'GIS,Medical Certificate/Abstract', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'GIS,Medical Certificate/Abstra', 'BGY ID', 'Bgy Certification', 'Financial_Assistance', '', '', 'Financial_Assistance', '', 5000, '2023', 'Julius Taguiam', 'Jervin Regio', 2, 2, 'Michael Mercado', 'NEW');

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
(1, 1, '123456', '2023-09-18', 1),
(2, 2, '234567', '2023-09-18', 2);

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
(7, 'De Luna', 'Axe axx', 'buco', 'sample', 'manila', 'calabao', 'Makati', 'NCR_District_2', 'NCR', 'sample', '2022-12-08', 'sample', 'Female', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'sample', 'Makati', 'NCR_District_1_Manila', 'NCR', 'sample', '2023-01-06', 'other_relation', 'sample', 'Medical', '', '', 'Assessed'),
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
(1, 1, 'Screenshot 2023-07-25 101954.png', 'sdo_upload/Screenshot 2023-07-25 101954.png'),
(2, 1, 'Screenshot 2023-07-25 102037.png', 'sdo_upload/Screenshot 2023-07-25 102037.png'),
(3, 1, 'Screenshot 2023-07-25 102046.png', 'sdo_upload/Screenshot 2023-07-25 102046.png'),
(4, 2, 'asasa.PNG', 'sdo_upload/asasa.PNG'),
(5, 2, 'iaccess2.PNG', 'sdo_upload/iaccess2.PNG'),
(6, 2, 'pass.png', 'sdo_upload/pass.png');

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
(1, 'Rostom', 'DL', 'Barboza', '', '1234', 'RCITMS', 'MIS', 'AA IV', 'Permanent', '2023', '09208246213', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond'),
(2, 'Rose Sharon', 'G', 'Alcantara', '', '23456', 'PDPS', 'PPD', 'Planning Officer II', 'Permanent', '2023', '09208246213', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond', 'Obligation Request Statement,Disbursement Voucher,Regional Special Order,RSO authorizing the payment of grants,Certificate of No Unliquidated Cash Advance,Copy of SDOs valid Fidelity Bond'),
(3, 'Jeric', 'Encarnacion', 'Rodil', '', '12345', 'RICTMS', 'PPD', 'ITO I', '', '2024', '', '', '', '', '', '', '');

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
  MODIFY `ass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `ce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cheque_tbl`
--
ALTER TABLE `cheque_tbl`
  MODIFY `cheque_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `imgsdo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sdo_tbl`
--
ALTER TABLE `sdo_tbl`
  MODIFY `sdo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
