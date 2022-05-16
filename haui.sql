-- Adminer 4.8.1 MySQL 8.0.28 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `notice`;
CREATE TABLE `notice` (
      `id` int NOT NULL AUTO_INCREMENT,
      `title` mediumtext,
      `class_id` int DEFAULT NULL,
      `message` mediumtext,
      `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      KEY `notice_ibfk_1` (`class_id`),
      CONSTRAINT `notice_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `notice` (`id`, `title`, `class_id`, `message`, `created_at`) VALUES
(2,	'Marks of Unit Test.',	3,	'Meet your class teacher for seeing copies of unit test',	'2022-01-18 16:35:58'),
(3,	'Marks of Unit Test.',	2,	'Meet your class teacher for seeing copies of unit test',	'2022-01-18 16:35:58'),
(4,	'Test',	3,	'This is for testing.',	'2022-02-02 04:17:03');

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
    `id` int NOT NULL AUTO_INCREMENT,
    `page_type` varchar(200) DEFAULT NULL,
    `page_title` mediumtext,
    `content` mediumtext,
    `email` varchar(200) DEFAULT NULL,
    `phone_number` bigint DEFAULT NULL,
    `updated_at` date DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `page` (`id`, `page_type`, `page_title`, `content`, `email`, `phone_number`, `updated_at`) VALUES
       (1,	'aboutus',	'About Us',	'<div style=\"text-align: start;\"><font color=\"#7b8898\" face=\"Mercury SSm A, Mercury SSm B, Georgia, Times, Times New Roman, Microsoft YaHei New, Microsoft Yahei, ????, ??, SimSun, STXihei, ????, serif\"><span style=\"font-size: 26px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></font><br></div>',	NULL,	NULL,	NULL),
       (2,	'contactus',	'Contact Us',	'890,Sector 62, Gyan Sarovar, GAIL Noida(Delhi/NCR)',	'infodata@gmail.com',	7896541236,	NULL);

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
       `id` int NOT NULL AUTO_INCREMENT,
       `student_code` varchar(200) NOT NULL,
       `name` varchar(200) NOT NULL,
       `email` varchar(200) NOT NULL,
       `gender` varchar(50) DEFAULT NULL,
       `dob` date DEFAULT NULL,
       `phone_number` bigint NOT NULL,
       `address` mediumtext,
       `image` varchar(200) DEFAULT NULL,
       `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`id`),
       UNIQUE KEY `student_code` (`student_code`),
  CONSTRAINT `fk_student_user1` FOREIGN KEY (`student_code`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `student` (`id`, `student_code`, `name`, `email`, `gender`, `dob`, `phone_number`, `address`, `image`, `created_at`) VALUES
(1, 'Student_1',	'Chu Van Man',	'reis@gmail.com',	'',	'2001-07-07',	942768,	'Ha Noi',	'/reissdf',	'2022-01-19 19:11:57'),
(2,	'Student_2',	'Dang Duc Tho',	'tho@gmail.com',	'Nu',	'2001-01-07',	94276866,	'Thanh Hoa', '/reis',	'2022-01-19 19:11:57'),
(3,	'Student_3',	'Nguyen Viet Duong',	'duong@gmail.com',	'Nam',	'2001-02-07',	94276866,	'Ha Noi',	'/reis',	'2022-01-19 19:11:57'),
(4,	'Student_4',	'Nguyen Lan Duy',	'duy@gmail.com',	'Nu',	'2001-04-07',	94276866,	'Soc Son',	'/reis',	'2022-01-19 19:11:57'),
(5,	'Student_5',	'Le Minh Hieu',	'hieu@gmail.com',	'Nam',	'2001-08-07',	94276866,	'Hung Yen',	'/reis',	'2022-01-19 19:11:57'),
(6,	'Student_6',	'Reis',	'reiss@gmail.com',	'Nam',	'2022-04-07',	945651133,	'Bac Ninh',	'/abc.jpg',	'2022-04-23 14:38:16');

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `course_code` varchar(50)  NOT NULL DEFAULT '0',
                          `room` varchar(50)  DEFAULT NULL,
                          `teacher_code` varchar(50)  NOT NULL,
                          `subject_code` varchar(50)  NOT NULL,
                          `number_lesson` varchar(5)  DEFAULT NULL,
                          `day_of_week` varchar(50)  DEFAULT NULL,
                          PRIMARY KEY (`course_code`),
                          KEY `id` (`id`),
                          KEY `fk_course_teacher1_idx` (`teacher_code`),
                          KEY `fk_course_subject1_idx` (`subject_code`),
                          CONSTRAINT `fk_course_subject1` FOREIGN KEY (`subject_code`) REFERENCES `subject` (`subject_code`) ON DELETE CASCADE ON UPDATE CASCADE,
                          CONSTRAINT `fk_course_teacher1` FOREIGN KEY (`teacher_code`) REFERENCES `teacher` (`teacher_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `course_has_student`;
CREATE TABLE `course_has_student` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `chs_code` varchar(50)  NOT NULL,
         `course_code` varchar(50)  NOT NULL,
         `student_code` varchar(50)  NOT NULL,
         PRIMARY KEY (`chs_code`),
         UNIQUE KEY `id_UNIQUE` (`id`),
         KEY `fk_course_has_student_student1_idx` (`student_code`),
         KEY `fk_course_has_student_course1_idx` (`course_code`),
         CONSTRAINT `fk_course_has_student_course1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
         CONSTRAINT `fk_course_has_student_student1` FOREIGN KEY (`student_code`) REFERENCES `student` (`student_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

DROP TABLE IF EXISTS `point`;
CREATE TABLE `point` (
     `id` int NOT NULL,
     `chs_code` varchar(50)  NOT NULL,
     `point_l1` int DEFAULT NULL,
     `point_l2` int DEFAULT NULL,
     `point_l3` int DEFAULT NULL,
     `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY (`id`,`chs_code`),
     KEY `id` (`id`),
     KEY `fk_result_course_has_student1_idx` (`chs_code`),
     CONSTRAINT `fk_result_course_has_student1` FOREIGN KEY (`chs_code`) REFERENCES `course_has_student` (`chs_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `publicnotice`;
CREATE TABLE `publicnotice` (
   `id` int NOT NULL AUTO_INCREMENT,
   `title` varchar(200) DEFAULT NULL,
   `message` mediumtext,
   `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `publicnotice` (`id`, `title`, `message`, `created_at`) VALUES
   (1,	'School will re-open',	'Consult your class teacher.',	'2022-01-19 19:11:57'),
   (2,	'Test Public Notice',	'This is for Testing\r\n',	'2022-02-02 05:04:10');


DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
       `id` int NOT NULL AUTO_INCREMENT,
       `subject_code` varchar(50)  NOT NULL,
       `name` varchar(200) DEFAULT NULL,
       `num_credit` varchar(50) NOT NULL,
       `major` varchar(50) DEFAULT NULL,
       `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`subject_code`),
       UNIQUE KEY `subject_code` (`subject_code`),
       KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `teacher`;
CREATE TABLE `teacher` (
       `id` int NOT NULL,
       `teacher_code` varchar(200) NOT NULL,
       `name` varchar(200) DEFAULT NULL,
       `email` varchar(200) DEFAULT NULL,
       `specialize` varchar(200) DEFAULT NULL,
       `gender` varchar(50) DEFAULT NULL,
       `phone_number` bigint DEFAULT NULL,
       `address` mediumtext,
       `image` varchar(200) DEFAULT NULL,
       `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`id`),
       UNIQUE KEY `teacher_code` (`teacher_code`),
       CONSTRAINT `fk_teacher_user1` FOREIGN KEY (`teacher_code`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `teacher` (`id`, `teacher_code`, `name`, `email`, `specialize`, `gender`, `phone_number`, `address`,`image`) VALUES
(1, 'GV001', 'Phạm Tiến Huy', 'phamhuy@gmail.com','Lập trinh','Nam',  '168465555','Ha Noi', 'thayhuy.jpg'),
(2, 'GV002', 'Lê Thị Cúc ', 'lecuc@gmail.com','Mạng máy tính ', 'Nam', '0658585858','Ha Noi','cocuc.jpg'),
(3, 'GV003', 'Nguyễn Thu Thủy ', 'thuthuy@mail.vn','Chủ nhiệm', 'Nam', '025454987', 'Ha Noi','cothuy.jpg'),
(4, 'GV004', 'Bill Gate', 'billgate@dollar.com','Computer Science ', 'Nam', '03548787878', 'Ha Noi','billgates.jpg');
-- (5, 'GV005', 'Emma Watson', 'ema@hou.edu.vn', 'Computer Science , Machine Learning ', 'Nam',  '0145745869','Ha Noi','emma.jpg'),
-- (6, 'GV006', 'Harry Potter ', 'harry@potter.com', 'Magic. ', 'Nam', '0909900009', 'Ha Noi','harry.jpg'),
-- (7, 'GV007', 'Vũ Song Tùng ', 'email@email.com', 'Điện tử viễn thông ', 'Nam', 'Ha Noi', '09595959', ''),
-- (9, 'GV008', 'Kudo Shinichi', 'kudo@gmail.com', 'Mac - Lenin', 'Nam',  '254875557','Ha Noi', 'kudo.jpg');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(200) NOT NULL,
    `password` varchar(200) NOT NULL,
    `type` int NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user` (`id`, `username`, `password`, `type`) VALUES
(1,'Student_1','reis123!@#',2),
(2,'Student_2','reis123!@#',2),
(3,'Student_3','reis123!@#',2),
(4,'Student_4','reis123!@#',2),
(5,'Student_5','reis123!@#',2),
(6,'Student_6','reis123!@#',2),
(7,'GV001','reis123!@#',1),
(8,'GV002','reis123!@#',1),
(9,'GV003','reis123!@#',1),
(10,'GV004','reis123!@#',1);


-- 2022-04-24 10:05:53
