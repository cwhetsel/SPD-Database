DROP TABLE IF EXISTS organization_involvement;
DROP TABLE IF EXISTS pledge_class;
DROP TABLE IF EXISTS positions_history;
DROP TABLE IF EXISTS jobs_history;
DROP TABLE IF EXISTS positions;
DROP TABLE IF EXISTS organizations;
DROP TABLE IF EXISTS jobs;
DROP TABLE IF EXISTS all_members;
DROP TABLE IF EXISTS authentication;

/*CREATE TABLE authentication(
    tables stuff
);*/

CREATE TABLE all_members(
    id int NOT NULL AUTO_INCREMENT,
    pawprint varchar(6) UNIQUE NOT NULL,
    first_name varchar(64),
    last_name varchar(64),
    email varchar(64),
    phone varchar(14),
    address varchar(256),
    pledge_class varchar(32),
    major varchar(64),
    major2 varchar(64),
    pledge_father_pawprint varchar(6),
    grad_semester varchar(5),
    grad_year varchar(4),
	shirt_size ENUM('M', 'XS', 'S', 'L', 'XL', 'XXL', 'XXXL'),
    current_job_id int,
    status ENUM('Active', 'Alumni', 'Inactive'),
    cumulative_gpa float,
    last_sem_gpa float,
    emphasis varchar(64),
	access_level ENUM('General', 'Exec', 'Admin') DEFAULT 'General' NOT NULL,
	last_update Date,
    PRIMARY KEY(id),
	KEY `fk_father_pawprint` (`pledge_father_pawprint`),
    CONSTRAINT `fk_father_id` FOREIGN KEY (`pledge_father_pawprint`) REFERENCES `all_members` (`pawprint`),
	FOREIGN KEY(pawprint) REFERENCES authentication(username)
);


CREATE TABLE positions(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(32),
	type ENUM('Elected', 'Appointed'),
    PRIMARY KEY(id)
);

CREATE TABLE jobs(
    id int NOT NULL AUTO_INCREMENT,
    company varchar(64),
    title varchar(64),
    PRIMARY KEY(id) 
);

CREATE TABLE organizations(
    id int NOT NULL AUTO_INCREMENT,
    name varchar(32),
    PRIMARY KEY(id)
);

CREATE TABLE positions_history(
    id int NOT NULL AUTO_INCREMENT,
    position_id int NOT NULL,
    member_id int NOT NULL,
	semester varchar(5), 
	year varchar(4),
    PRIMARY KEY (id),
	FOREIGN KEY (member_id) REFERENCES all_members(id),
    FOREIGN KEY (position_id) REFERENCES positions(id)
);

CREATE TABLE jobs_history(
    id int NOT NULL AUTO_INCREMENT,
    job_id int NOT NULL,
    member_id int NOT NULL,
    PRIMARY KEY (id),
	FOREIGN KEY (member_id) REFERENCES all_members(id),
    FOREIGN KEY (job_id) REFERENCES jobs(id)
);


CREATE TABLE organization_involvement(
    id int NOT NULL AUTO_INCREMENT,
    org_id int NOT NULL,
    member_id int NOT NULL,
    PRIMARY KEY (id),
	FOREIGN KEY (member_id) REFERENCES all_members(id),
    FOREIGN KEY (org_id) REFERENCES organizations(id)
);

CREATE TABLE pledge_class(
	id int NOT NULL AUTO_INCREMENT, 
	class_name VARCHAR(64) NOT NULL,
	PRIMARY KEY(id)
);

INSERT INTO `pledge_class` (class_name) VALUES("Alpha");
INSERT INTO `pledge_class` (class_name) VALUES("Beta");
INSERT INTO `pledge_class` (class_name) VALUES("Gamma");
INSERT INTO `pledge_class` (class_name) VALUES("Delta");
INSERT INTO `pledge_class` (class_name) VALUES("Epsilon");
INSERT INTO `pledge_class` (class_name) VALUES("Zeta");
INSERT INTO `pledge_class` (class_name) VALUES("Eta");
INSERT INTO `pledge_class` (class_name) VALUES("Theta");
INSERT INTO `pledge_class` (class_name) VALUES("Iota");
INSERT INTO `pledge_class` (class_name) VALUES("Kappa");
INSERT INTO `pledge_class` (class_name) VALUES("Lambda");
INSERT INTO `pledge_class` (class_name) VALUES("Mu");
INSERT INTO `pledge_class` (class_name) VALUES("Nu");
INSERT INTO `pledge_class` (class_name) VALUES("Xi");
INSERT INTO `pledge_class` (class_name) VALUES("Omicron");
INSERT INTO `pledge_class` (class_name) VALUES("Pi");
INSERT INTO `pledge_class` (class_name) VALUES("Rho");
INSERT INTO `pledge_class` (class_name) VALUES("Sigma");
INSERT INTO `pledge_class` (class_name) VALUES("Tau");
INSERT INTO `pledge_class` (class_name) VALUES("Upsilon");
INSERT INTO `pledge_class` (class_name) VALUES("Phi");
INSERT INTO `pledge_class` (class_name) VALUES("Chi");
INSERT INTO `pledge_class` (class_name) VALUES("Psi");
INSERT INTO `pledge_class` (class_name) VALUES("Omega");


/*INSERT INTO `authentication` ;
INSERT INTO `authentication` ;
INSERT INTO `authentication` */

INSERT INTO `all_members` (pawprint, access_level) VALUES("cjwgr5", "Admin");
INSERT INTO `all_members` (pawprint, access_level) VALUES("exec", "Exec");
INSERT INTO `all_members` (pawprint, access_level) VALUES("general", "General");

INSERT INTO `positions` (name) VALUES("Chief Engineer");
INSERT INTO `positions` (name) VALUES("Internal Vice Chief Engineer");
INSERT INTO `positions` (name) VALUES("External Vice Chief Engineer");
INSERT INTO `positions` (name) VALUES("Buisiness Manager");
INSERT INTO `positions` (name) VALUES("Secretary");

INSERT INTO `positions` (name) VALUES("Webmaster");
INSERT INTO `positions` (name) VALUES("New Member Educator");
INSERT INTO `positions` (name) VALUES("Alumni Relations");
INSERT INTO `positions` (name) VALUES("Chapter Relations");
INSERT INTO `positions` (name) VALUES("Greek Correspondent");
INSERT INTO `positions` (name) VALUES("FIRST Correspondent");
INSERT INTO `positions` (name) VALUES("Guide");
INSERT INTO `positions` (name) VALUES("Chaplain");
INSERT INTO `positions` (name) VALUES("Historian");
INSERT INTO `positions` (name) VALUES("Sergeant At Arms");

INSERT INTO `positions` (name) VALUES("House Manager");
INSERT INTO `positions` (name) VALUES("Assistant Business Manager");

INSERT INTO `positions` (name) VALUES("New Member Education Board Chairman");
INSERT INTO `positions` (name) VALUES("Judicial Board Chairman");
INSERT INTO `positions` (name) VALUES("Recruitment Chairman");
INSERT INTO `positions` (name) VALUES("Philanthropy Chairman");
INSERT INTO `positions` (name) VALUES("Athletic Chairman");
INSERT INTO `positions` (name) VALUES("Social Chairman");
INSERT INTO `positions` (name) VALUES("Fundraising Chairman");
INSERT INTO `positions` (name) VALUES("Greek Week Chairman");
INSERT INTO `positions` (name) VALUES("Professional Chairman");
INSERT INTO `positions` (name) VALUES("Merchandise Chairman");
INSERT INTO `positions` (name) VALUES("Acdemic Chairman");
INSERT INTO `positions` (name) VALUES("Expansion Chairman");
INSERT INTO `positions` (name) VALUES("Risk Management Chairman");
INSERT INTO `positions` (name) VALUES("Brotherhood Development Chairman");

INSERT INTO `jobs` (title, company) VALUES("Software Developer Intern", "Missouri Employers Mutual");
INSERT INTO `jobs` (company) VALUES("NASA");
INSERT INTO `jobs` (company) VALUES("Power Engineers");
INSERT INTO `jobs` (company) VALUES("True Manufacturing");
INSERT INTO `jobs` (company) VALUES("Boeing");
INSERT INTO `jobs` (company) VALUES("Pella Corp");

INSERT INTO `organizations` (name) VALUES("Racquetball Club");
INSERT INTO `organizations` (name) VALUES("Bowling Club");
INSERT INTO `organizations` (name) VALUES("Running Club");
INSERT INTO `organizations` (name) VALUES("Mizzou Computing Association");



