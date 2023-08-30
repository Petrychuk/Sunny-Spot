/* Display all cabins showing the following details:  
Cabin Type, Cabin description, Price per night, Price per week,Photo name */ 

SELECT * FROM cabin;

/*Show the cabin type and price per night of the cabin with the price per week = $1000*/

SELECT cabinType, pricePerNight FROM cabin WHERE pricePerWeek = 1000;


/*Show the cabin type and photo of the cabin with the price per night = $40*/

SELECT cabinType, photo FROM cabin WHERE pricePerNight = 40; 


/*Display the number of cabins with a hairdryer */

SELECT COUNT(*) AS num_of_cabins_with_hairdryer
FROM cabin
JOIN cabinInclusion ON cabin.cabinID = cabinInclusion.cabinID
JOIN inclusion ON cabinInclusion.incID = inclusion.incID
WHERE inclusion.incName = 'Hair dryer';


/*Show the cabin type and photo name of all the cabins with a bunk bed */
SELECT cabinType, photo
FROM cabin
WHERE cabinID IN (
    SELECT cabinID
    FROM cabinInclusion
    JOIN inclusion ON cabinInclusion.incID = inclusion.incID
    WHERE inclusion.incName = 'Bunk bed'
);

/*Display the cabin type price per night and all inclusion names for the Spa Villa*/
SELECT c.cabinType, c.pricePerNight, i.incName
FROM cabin c
JOIN cabinInclusion ci ON c.cabinID = ci.cabinID
JOIN inclusion i ON ci.incID = i.incID
WHERE c.cabinType = 'Spa Villa sleeps 4';

/*⦁	Add new cabin type to the cabin table with the following data:
⦁	cabinType - sample 
⦁	cabinDescription  - details of sample cabin  
⦁	pricePerNight  - 50 
⦁	pricePerWeek  - 500 
⦁	photo  - cabAdded.jpg */

INSERT INTO cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo) 
VALUES ('sample', 'details of sample cabin', 50, 500, 'cabAdded.jpg');


/*	Update new cabin details to */

UPDATE Cabin
SET cabinDescription = 'updated details of sample cabin',
    pricePerNight = 60,
    pricePerWeek = 600,
    photo = 'updatedCabAdded.jpg'
WHERE cabinType = 'sample';

/*Delete the added cabin.*/

DELETE FROM Cabin
WHERE cabinType = 'sample';

