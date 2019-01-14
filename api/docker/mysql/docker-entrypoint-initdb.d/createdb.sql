
CREATE USER 'notes'@'mysql' IDENTIFIED WITH mysql_native_password BY 'asf9#89hf9384h';
GRANT ALL PRIVILEGES ON *.* TO 'notes'@'mysql' WITH GRANT OPTION;
CREATE USER 'notes'@'%' IDENTIFIED WITH mysql_native_password BY 'asf9#89hf9384h';
GRANT ALL PRIVILEGES ON *.* TO 'notes'@'%' WITH GRANT OPTION;
#
CREATE DATABASE IF NOT EXISTS `notes` COLLATE 'utf8_general_ci' ;
GRANT ALL ON `notes`.* TO 'notes'@'%' ;
FLUSH PRIVILEGES ;