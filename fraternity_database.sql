# this is to drop tables im working with
DROP TABLE IF EXISTS exec, chair, alum, major, minor, brother, minor_student, major_student, location, event, host, DOE, brother_chair;


CREATE TABLE exec (
  exec_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NUll
);

CREATE TABLE chair (
  chair_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NUll
);

CREATE TABLE minor (
  minor_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE major (
  major_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE alum (
  alum_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  job_title VARCHAR(255),
  work_organization VARCHAR(255),
  current_city VARCHAR(255),
  current_state CHAR(2)
);

CREATE TABLE brother (
  brother_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  class VARCHAR(255),
  city VARCHAR(255),
  state CHAR(2),
  graduation_year VARCHAR(255),
  phone BIGINT,
  email VARCHAR(255),
  photo LONGBLOB,
  exec_id INT,
  alum_id INT,
  CONSTRAINT brother_fk_1 FOREIGN KEY (exec_id) REFERENCES exec(exec_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT brother_fk_2 FOREIGN KEY (alum_id) REFERENCES alum(alum_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE brother_chair (
  brother_id INT NOT NULL,
  chair_id INT NOT NULL,
  CONSTRAINT brother_chair_fk_1 FOREIGN KEY (chair_id) REFERENCES chair(chair_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT brother_chair_fk_2 FOREIGN KEY (brother_id) REFERENCES brother(brother_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE minor_student (
  brother_id INT,
  minor_id INT NOT NULL,
  CONSTRAINT minor_fk_2 FOREIGN KEY (brother_id) REFERENCES brother(brother_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT minor_fk_1 FOREIGN KEY (minor_id) REFERENCES minor(minor_id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (brother_id, minor_id)
);

CREATE TABLE major_student (
  brother_id INT,
  major_id INT NOT NULL,
  CONSTRAINT major_fk_2 FOREIGN KEY (brother_id) REFERENCES brother(brother_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT major_fk_1 FOREIGN KEY (major_id) REFERENCES major(major_id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (brother_id, major_id)
);

CREATE TABLE location (
  location_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE event (
  event_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  type VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL
);

CREATE TABLE host (
  brother_id INT NOT NULL,
  event_id INT NOT NULL,
  CONSTRAINT host_fk_1 FOREIGN KEY (brother_id) REFERENCES brother(brother_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT host_fk_2 FOREIGN KEY (event_id) REFERENCES `event`(event_id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (brother_id, event_id)
);

CREATE TABLE DOE (
  event_id INT NOT NULL,
  `DATETIME` DATETIME NOT NULL,
  location_id INT NOT NULL,
  CONSTRAINT DOE_fk_1 FOREIGN KEY (location_id) REFERENCES location(location_id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT DOE_fk_2 FOREIGN KEY (event_id) REFERENCES `event`(event_id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (location_id, event_id, `DATETIME`)
);

INSERT INTO `major` (`major_id`, `name`)
VALUES (1,'Nursing'),
(2,'Accounting'),
(3,'American Studies'),
(4,'Chemistry'),
(5,'Physics/Pre-Engineering'),
(6,'Art History'),
(7,'Biochemistry'),
(8,'Biology'),
(9,'Biomedical Physics'),
(10,'Business Intelligence and Analytics'),
(11,'Applied Chemistry'),
(12,'Classical and Near Eastern Civilizations'),
(13,'Classical Languages'),
(14,'Communication Studies'),
(15,'Computer Science'),
(16,'Criminal Justice'),
(17,'Cultural Anthropology'),
(18,'Data Science'),
(19,'Physics/Engineering'),
(20,'Economics'),
(21,'Elementary Education'),
(22,'English'),
(23,'Environmental Science'),
(24,'Exercise Science'),
(25,'Finance'),
(26,'FinTech'),
(27,'French and Francophone Studies'),
(28,'German Studies'),
(29,'Health Administration and Policy'),
(30,'History'),
(31,'International Relations'),
(32,'Journalism'),
(33,'Justice and Society'),
(34,'Leadership'),
(35,'Management'),
(36,'Marketing'),
(37,'Mathematics'),
(38,'Medical Anthropology'),
(39,'Music'),
(40,'Musical Theatre'),
(41,'Neuroscience'),
(42,'Paramedicine'),
(43,'Philosophy'),
(44,'Physics'),
(45,'Political Science'),
(46,'Pre-Health Science Program'),
(47,'Psychological Science'),
(48,'Public Health'),
(49,'Social Work'),
(50,'Sociology'),
(51,'Spanish and Hispanic Studies'),
(52,'Sustainability'),
(53,'Theatre'),
(54,'Theology'),
(55, 'Pre-Law 3-3');

INSERT INTO `minor` (`minor_id`, `name`)
VALUES
(1, 'African American and Black Diasporic Studies'),
(2, 'African Studies'),
(3, 'Asian Studies'),
(4, 'Biology'),
(5, 'Business Administration'),
(6, 'Classical and Near Eastern Civilaizations'),
(7, 'Criminal Justice'),
(8, 'Cultural Anthropology'),
(9, 'Dance'),
(10, 'Digital Humanities'),
(11, 'Film Studies'),
(12, 'German Studies'),
(13, 'Global Health Equity'),
(14, 'Health Administration and Policy'),
(15, 'Justice and Peace Studies'),
(16, 'Marketing'),
(17, 'Medical Anthropology'),
(18, 'Military Science'),
(19, 'Public Health'),
(20, 'Science and Medicine in Society'),
(21, 'Sociology'),
(22, 'Spanish and Hispanic Studies'),
(23, 'Studio Art'),
(24, 'Theatre'),
(25, 'Women''s and Gender Studies');

INSERT INTO location (location_id, name)
VALUES
(1, 'Harper Ballroom'),
(2, 'Harper Center'),
(3, 'Reinert-Alumni Memorial Library'),
(4, 'Skutt Student Center'),
(5, 'Kiewit Fitness Center'),
(6, 'Hixson-Lied Science Building'),
(7, 'Rigge Science Building'),
(8, 'Dowling Hall'),
(9, 'Creighton Hall'),
(10, 'Kiewit Hall'),
(11, 'Gallagher Hall'),
(12, 'Heider Hall'),
(13, 'Swanson Hall'),
(14, 'McGloin Hall'),
(15, 'Deglman Hall'),
(16, 'Kenefick Hall'),
(17, 'Kiewit Residence Hall'),
(18, 'Opus Hall'),
(19, 'Davis Square'),
(20, 'Jelinek Building'),
(21, 'Creighton Sports Complex'),
(22, 'CU Soccer Stadium'),
(23, 'Morrison Stadium'),
(24, 'Kitty Gaughan Pavilion'),
(25, 'Ahmanson Law Center'),
(26, 'Boyne Building'),
(27, 'Criss Health Sciences Building'),
(28, 'Parle Sarpy Dental Building'),
(29, 'School of Dentistry Clinic'),
(30, 'Beirne Research Tower'),
(31, 'Cardiac Center'),
(32, 'Creighton University Medical Center'),
(33, 'Bio-Information Center'),
(34, 'Lied Education Center for the Arts'),
(35, 'Hitchcock Building'),
(36, 'Vinardi Center'),
(37, 'Ryan Athletic Center'),
(38, 'D.J. Sokol Arena'),
(39, 'Rasmussen Fitness and Sports Center'),
(40, 'Championship Center'),
(41, 'Creighton Business Institute'),
(42, 'Mike and Josie Harper Center'),
(43, 'Heider College of Business'),
(44, 'Eppley Building'),
(45, 'Brandeis Hall'),
(46, 'Creighton Pediatric Therapy');

INSERT INTO exec (exec_id, title)
VALUES (1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'AMC'),
(8, 'Social'),
(9, 'Recruitment');

INSERT INTO chair (chair_id, title)
VALUES (1, 'Chartering'),
(2, 'Philanthropy'),
(3, 'Brotherhood'),
(4, 'Community Service'),
(5, 'Fundraising'),
(6, 'Historian'),
(7, 'Intramurals'),
(8, 'Member Development'),
(9, 'Social Media'),
(10, 'DEI'),
(11, 'Faith and Sprituality'),
(12, 'Awards'),
(13, 'Academic'),
(14, 'Dance Marathon');



# selecting exec
SELECT title, first_name, last_name
FROM brother b
INNER JOIN exec e using(exec_id);

# find alumni 
SELECT first_name, last_name, job_title, current_state
FROM brother
INNER JOIN alum using(alum_id)
WHERE alum_id IS NOT NULL;

# find not alumni 
SELECT first_name, last_name, exec_id
FROM brother
WHERE alum_id IS NULL;

# show major for Jackson Drenth
SELECT b.first_name, b.last_name, m.major_id
FROM brother b
INNER JOIN major_student ms on b.brother_id = ms.brother_id
INNER JOIN major m on ms.major_id = m.major_id
where b.brother_id = 1;

# select events on a datetime 
SELECT d.DATETIME, e.name
FROM DOE d 
INNER JOIN event e using(event_id);


# 3 users that need access
# exec, brothers, alumni 
# this will play into access on the websitre