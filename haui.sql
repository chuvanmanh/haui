-- Adminer 4.8.1 MySQL 8.0.28 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `haui`;

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
                          `id` int NOT NULL AUTO_INCREMENT,
                          `course_code` varchar(50) NOT NULL DEFAULT '0',
                          `room` varchar(50) DEFAULT NULL,
                          `teacher_code` varchar(50) NOT NULL,
                          `subject_code` varchar(50) NOT NULL,
                          `number_lesson` varchar(5) DEFAULT NULL,
                          `day_of_week` varchar(50) DEFAULT NULL,
                          PRIMARY KEY (`course_code`),
                          KEY `id` (`id`),
                          KEY `fk_course_teacher1_idx` (`teacher_code`),
                          KEY `fk_course_subject1_idx` (`subject_code`),
                          CONSTRAINT `fk_course_subject1` FOREIGN KEY (`subject_code`) REFERENCES `subject` (`subject_code`) ON DELETE CASCADE ON UPDATE CASCADE,
                          CONSTRAINT `fk_course_teacher1` FOREIGN KEY (`teacher_code`) REFERENCES `teacher` (`teacher_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `course` (`id`, `course_code`, `room`, `teacher_code`, `subject_code`, `number_lesson`, `day_of_week`) VALUES
    (1,	'KH001',	'403',	'GV001',	'M001',	'5',	'tue');

DROP TABLE IF EXISTS `course_has_student`;
CREATE TABLE `course_has_student` (
                                      `id` int NOT NULL AUTO_INCREMENT,
                                      `chs_code` varchar(50) NOT NULL,
                                      `course_code` varchar(50) NOT NULL,
                                      `student_code` varchar(50) NOT NULL,
                                      PRIMARY KEY (`chs_code`),
                                      UNIQUE KEY `id_UNIQUE` (`id`),
                                      KEY `fk_course_has_student_student1_idx` (`student_code`),
                                      KEY `fk_course_has_student_course1_idx` (`course_code`),
                                      CONSTRAINT `fk_course_has_student_course1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE,
                                      CONSTRAINT `fk_course_has_student_student1` FOREIGN KEY (`student_code`) REFERENCES `student` (`student_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `course_has_student` (`id`, `chs_code`, `course_code`, `student_code`) VALUES
    (1,	'KH001_Student_1',	'KH001',	'Student_1');

DROP TABLE IF EXISTS `point`;
CREATE TABLE `point` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `chs_code` varchar(50) NOT NULL,
                         `point_l1` int DEFAULT NULL,
                         `point_l2` int DEFAULT NULL,
                         `point_l3` int DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                         PRIMARY KEY (`id`,`chs_code`),
                         KEY `id` (`id`),
                         KEY `fk_result_course_has_student1_idx` (`chs_code`),
                         CONSTRAINT `fk_result_course_has_student1` FOREIGN KEY (`chs_code`) REFERENCES `course_has_student` (`chs_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


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
                                                                                                                                     (1,	'Student_1',	'Chu Van Man',	'reis@gmail.com',	'',	'2001-07-07',	942768,	'Ha Noi',	'/reissdf',	'2022-01-19 19:11:57'),
                                                                                                                                     (2,	'Student_2',	'Dang Duc Tho',	'tho@gmail.com',	'Nu',	'2001-01-07',	94276866,	'Thanh Hoa',	'/reis',	'2022-01-19 19:11:57'),
                                                                                                                                     (3,	'Student_3',	'Nguyen Viet Duong',	'duong@gmail.com',	'Nam',	'2001-02-07',	94276866,	'Ha Noi',	'/reis',	'2022-01-19 19:11:57'),
                                                                                                                                     (4,	'Student_4',	'Nguyen Lan Duy',	'duy@gmail.com',	'Nu',	'2001-04-07',	94276866,	'Soc Son',	'/reis',	'2022-01-19 19:11:57'),
                                                                                                                                     (5,	'Student_5',	'Le Minh Hieu',	'hieu@gmail.com',	'Nam',	'2001-08-07',	94276866,	'Hung Yen',	'/reis',	'2022-01-19 19:11:57'),
                                                                                                                                     (6,	'Student_6',	'Reis',	'reiss@gmail.com',	'Nam',	'2022-04-07',	945651133,	'Bac Ninh',	'/abc.jpg',	'2022-04-23 14:38:16');

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `subject_code` varchar(50) NOT NULL,
                           `name` varchar(200) DEFAULT NULL,
                           `num_credit` varchar(50) NOT NULL,
                           `major` varchar(50) DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                           PRIMARY KEY (`subject_code`),
                           UNIQUE KEY `subject_code` (`subject_code`),
                           KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `subject` (`id`, `subject_code`, `name`, `num_credit`, `major`, `created_at`) VALUES
    (1,	'M001',	'Test',	'3',	'CNTT',	'2022-05-14 18:22:58');

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

INSERT INTO `teacher` (`id`, `teacher_code`, `name`, `email`, `specialize`, `gender`, `phone_number`, `address`, `image`, `created_at`) VALUES
                                                                                                                                            (1,	'GV001',	'Phạm Tiến Huy',	'phamhuy@gmail.com',	'Lập trinh',	'Nam',	168465555,	'Ha Noi',	'thayhuy.jpg',	'2022-05-14 18:22:34'),
                                                                                                                                            (2,	'GV002',	'Lê Thị Cúc ',	'lecuc@gmail.com',	'Mạng máy tính ',	'Nam',	658585858,	'Ha Noi',	'cocuc.jpg',	'2022-05-14 18:22:34'),
                                                                                                                                            (3,	'GV003',	'Nguyễn Thu Thủy ',	'thuthuy@mail.vn',	'Chủ nhiệm',	'Nam',	25454987,	'Ha Noi',	'cothuy.jpg',	'2022-05-14 18:22:34'),
                                                                                                                                            (4,	'GV004',	'Bill Gate',	'billgate@dollar.com',	'Computer Science ',	'Nam',	3548787878,	'Ha Noi',	'billgates.jpg',	'2022-05-14 18:22:34');

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

INSERT INTO `user` (`id`, `username`, `password`, `type`, `created_at`) VALUES
                                                                            (1,	'Student_1',	'reis123!@#',	2,	'2022-05-14 18:22:34'),
                                                                            (2,	'Student_2',	'reis123!@#',	2,	'2022-05-14 18:22:34'),
                                                                            (3,	'Student_3',	'reis123!@#',	2,	'2022-05-14 18:22:34'),
                                                                            (4,	'Student_4',	'reis123!@#',	2,	'2022-05-14 18:22:34'),
                                                                            (5,	'Student_5',	'reis123!@#',	2,	'2022-05-14 18:22:34'),
                                                                            (6,	'Student_6',	'reis123!@#',	2,	'2022-05-14 18:22:34'),
                                                                            (7,	'GV001',	'reis123!@#',	1,	'2022-05-14 18:22:34'),
                                                                            (8,	'GV002',	'reis123!@#',	1,	'2022-05-14 18:22:34'),
                                                                            (9,	'GV003',	'reis123!@#',	1,	'2022-05-14 18:22:34'),
                                                                            (10,	'GV004',	'reis123!@#',	1,	'2022-05-14 18:22:34');

-- 2022-05-16 03:29:44