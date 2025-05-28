DROP TABLE IF EXISTS publication;
DROP TABLE IF EXISTS comment;

CREATE TABLE publication (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(40) NOT NULL,
    content TEXT,
    date DATETIME,
    LIKES INT,
    imageURL VARCHAR(100)
);

CREATE TABLE comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    date DATETIME,
    likes INT, 
    publicationID INT
);

INSERT INTO publication (title,content,date,likes,imageURL) VALUES 
("Le Tabac", "Le tabac est un composant extrêmement important de la pipe.", '2025-05-28 16:00:00',0, "./../assets/images/truc.png"),
("Modèle PIP-BOY", "Smokey nous livre un nouveau modèle de pipe incroyable.", '2025-05-28 16:15:15',0, "./../assets/images/muche.png"),
("Meetup 30 juin", "Nous organisons une rencontre entre amateurs de pipes cigares.", '2025-05-28',0, "./../assets/images/chose.png");

INSERT INTO comment (content,date,likes,publicationID) VALUES
("J'ai du bon tabac dans ma tabatière !", '2025-05-29 08:20:13',0,1),
("Tout ça me rappelle Fallout...", '2025-05-29 09:14:50',0,2),
("On va fumer du tabac... N'est-ce pas ?", '2025-05-29 12:01:55',0,3);
   