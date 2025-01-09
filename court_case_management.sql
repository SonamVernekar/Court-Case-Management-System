SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `lawyer_login` (
  `lawyer_id` int(11) NOT NULL,
  `lawyer_first_name` varchar(50) NOT NULL,
  `lawyer_last_name` varchar(50) NOT NULL,
  `lawyer_email` varchar(50) NOT NULL,
  `lawyer_password` varchar(200) NOT NULL,
  `lawyer_phone_no` int(11) DEFAULT NULL,
  `lawyer_city` varchar(100) DEFAULT NULL,
  `lawyer_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `lawyer_login` (`lawyer_id`, `lawyer_first_name`, `lawyer_last_name`, `lawyer_email`, `lawyer_password`, `lawyer_phone_no`, `lawyer_city`, `lawyer_address`) VALUES
(1, 'Abhimanyu', 'shandilya', 'abhim@gmail.com', '$2y$10$qAcymah83jGXeHSnHa7fmOpXA8rYdzABIG260jbzbirSppAAIE/Cm', 2147483647, 'Delhi', 'Near Sarojini Market');

-- --------------------------------------------------------


CREATE TABLE `cases` (
  `case_id` int(11) NOT NULL,
  `case_type` varchar(50) NOT NULL,
  `case_details` varchar(200) NOT NULL,
  `hearing_date` date DEFAULT NULL,
  `case_status` varchar(50) NOT NULL,
  `court_name` varchar(50) DEFAULT NULL,
  `clientforcase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `cases` (`case_id`, `case_type`, `case_details`, `hearing_date`,  `case_status`, `court_name`, `clientforcase_id`) VALUES 
(1, 'Murder', 'Murdered someone', '2022-12-30', 'finished', 'supreme court,Delhi', 1);




CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_first_name` varchar(50) NOT NULL,
  `client_last_name` varchar(50) NOT NULL,
  `client_email` varchar(50) NOT NULL,
  `client_password` varchar(200) NOT NULL,
  `phone_no` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `client` (`client_id`, `client_first_name`, `client_last_name`, `client_email`, `client_password`, `phone_no`) VALUES
(1, 'Samreen', 'Kour', 'samr@gmail.com', '$2y$10$EyVZH14tO1Ti4/LHRpE0IOs8OHkQ1HDt0GFRkfncxVvc1fKUwFnMW', '9149797345');


CREATE TABLE `notifications` (
  `Notif_id` int(4) NOT NULL,
  `Client_id` int(4) DEFAULT NULL,
  `Lawyer_id` int(4) DEFAULT NULL,
  `Case_details` varchar(200) DEFAULT NULL,
  `Case_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `notifications` (`Notif_id`, `Client_id`, `Lawyer_id`, `Case_details`, `Case_type`) VALUES
(1, 1, 1, 'Murdered someone', 'Murder');


ALTER TABLE `lawyer_login`
  ADD PRIMARY KEY (`lawyer_id`);

ALTER TABLE `cases`
  ADD PRIMARY KEY (`case_id`);

  ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

  ALTER TABLE `notifications`
  ADD PRIMARY KEY (`Notif_id`);


  -- AUTO_INCREMENT for table `lawyer_login`
--
ALTER TABLE `lawyer_login`
  MODIFY `lawyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


 ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  ALTER TABLE `notifications`
  MODIFY `Notif_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;




