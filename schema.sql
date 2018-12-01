
-- -----------------------------------------
-- SHOR10 DATABASE SCHEMA
-- MARIA PAPANAGIOTOU
-- TASOS PAPALYRAS
-- LOCAL_HACK DAY
-- -----------------------------------------

-- -----------------------------------------
-- URLs TABLE
-- -----------------------------------------

CREATE TABLE `urls` (
	`short_url` CHAR(4) NOT NULL PRIMARY KEY,
	`long_url` VARCHAR(2083) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
