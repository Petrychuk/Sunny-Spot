


CREATE DATABASE sunnyspot;

CREATE TABLE Admin (
                staffID BIGINT AUTO_INCREMENT NOT NULL,
                userName VARCHAR(100) NOT NULL,
                password VARCHAR(100) NOT NULL,
                firstName VARCHAR(50) NOT NULL,
                lastName VARCHAR(200) NOT NULL,
                address VARCHAR(200) NOT NULL,
                mobile VARCHAR(8) NOT NULL,
                PRIMARY KEY (staffID)
);


CREATE TABLE Log (
                logID BIGINT AUTO_INCREMENT NOT NULL,
                staffID BIGINT NOT NULL,
                loginDateTime DATETIME NOT NULL,
                logoutDateTime DATETIME NOT NULL,
                PRIMARY KEY (logID)
);


CREATE TABLE Inclusion (
                incID BIGINT AUTO_INCREMENT NOT NULL,
                incName VARCHAR(50) NOT NULL,
                incDetails VARCHAR(255) NOT NULL,
                PRIMARY KEY (incID)
);


CREATE TABLE Cabin (
                cabinID BIGINT AUTO_INCREMENT NOT NULL,
                cabinType VARCHAR(150) NOT NULL,
                cabinDescription VARCHAR(255) NOT NULL,
                pricePerNight BIGINT NOT NULL,
                pricePerWeek DECIMAL(10,2) NOT NULL,
                photo VARCHAR(50) NOT NULL,
                PRIMARY KEY (cabinID)
);


CREATE TABLE CabinInclusion (
                cabinIncID BIGINT AUTO_INCREMENT NOT NULL,
                cabinID BIGINT NOT NULL,
                incID BIGINT NOT NULL,
                PRIMARY KEY (cabinIncID),
                FOREIGN KEY (cabinID) REFERENCES Cabin(cabinID),
                FOREIGN KEY (incID) REFERENCES Inclusion(incID)
);


ALTER TABLE Log ADD CONSTRAINT admin_log_fk
FOREIGN KEY (staffID)
REFERENCES Admin (staffID)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE CabinInclusion ADD CONSTRAINT inclusion_cabininclusion_fk
FOREIGN KEY (incID)
REFERENCES Inclusion (incID)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE CabinInclusion ADD CONSTRAINT cabin_cabininclusion_fk
FOREIGN KEY (cabinID)
REFERENCES Cabin (cabinID)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

INSERT INTO Cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo)
VALUES 
('Standard cabin sleeps 4', 'A 2 bedroom cabin with double in main and either double or 2 singles in the second bedroom', 100, 500, 'stCabin.jpg'),
('Standard open plan cabin sleeps 4', 'An open plan cabin with double bed and set of bunks', 120, 600, 'stOpenCabin.jpg'),
('Deluxe cabin sleeps 4', 'A 2 bedroom cabin with queen bed and 2 singles in the second bedroom', 140, 700, 'deluxCabin.jpg'),
('Villa sleeps 4', 'A 2 bedroom cabin with queen bed plus another bedroom with 2 single beds', 150, 750, 'villa.jpg'),
('Spa villa sleeps 4', 'A 2 bedroom cabin with queen bed plus another bedroom with 2 single beds and spa bath', 200, 1000, 'spaVilla.jpg'),
('Grass powered site', 'Powered sites on grass', 40, 200, 'grassPower.jpg'),
('Slab powered', 'Powered sites with slab', 50, 250, 'slabPower.jpg');


INSERT INTO Inclusion (incName, incDetails)
VALUES 
('1 bathroom', ''),
('1+ bathroom', '1 bathroom and separate toilet'),
('2 bathroom', ''),
('Air conditioner', 'Reverse cycle'),
('Ceiling fans', ''),
('Bunk bed', ''),
('2 single beds', ''),
('Double bed', ''),
('Dishwasher', ''),
('Hair dryer', '');

INSERT INTO Admin (userName, password, firstName, lastName, address, mobile)
VALUES 
('Admin2', '000000', 'Nataliia', 'Petrychuk', 'Sydney', '041458992'),
('Admin', 'Admin', 'Pinky', 'Gajjir', 'Sydney', '0423457165');



INSERT INTO Cabininclusion (cabinIncID, cabinID, incID) 
VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 3),
(5, 5, 3),
(6, 3, 4),
(7, 4, 4),
(8, 5, 4),
(9, 2, 5),
(10, 1, 6),
(11, 2, 6),
(12, 3, 7),
(13, 4, 7),
(14, 5, 7),
(15, 1, 8),
(16, 2, 8),
(17, 3, 8),
(19, 4, 8),
(20, 5, 8),
(21, 4, 9),
(22, 5, 9),
(23, 3, 10),
(24, 4, 10),
(25, 5, 10),
(26, 1, 11),
(27, 3, 11),
(28, 4, 11),
(29, 5, 11);

