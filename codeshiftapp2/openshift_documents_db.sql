
CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `document_title` text DEFAULT NULL,
  `document_extraction` text DEFAULT NULL,
  `document_type` varchar(20) DEFAULT NULL,
  `timing` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;



CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(200) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `timing` varchar(200) DEFAULT NULL,
 `api_key` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
