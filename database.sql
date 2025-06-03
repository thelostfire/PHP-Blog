DROP TABLE IF EXISTS publication;
DROP TABLE IF EXISTS comment;

CREATE TABLE publication (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(80) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    date DATETIME NOT NULL,
    likes INT NOT NULL,
    author VARCHAR(40),
    imageURL VARCHAR(100)
);

CREATE TABLE comment (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    date DATETIME,
    likes INT, 
    author VARCHAR(40),
    publicationID INT,
    FOREIGN KEY (publicationID) REFERENCES publication(id) ON DELETE CASCADE
);

INSERT INTO publication (title,content,date,likes,author,imageURL) VALUES 
("Le Tabac", "Le tabac est un composant extrêmement important de la pipe.", '2025-05-28 16:00:00',0,"Jean Bond", "./../assets/images/truc.png"),
("Modèle PIP-BOY", "Smokey nous livre un nouveau modèle de pipe incroyable.", '2025-05-28 16:15:15',0,"Trucmmuche", "./../assets/images/muche.png"),
("Meetup 30 juin", "Nous organisons une rencontre entre amateurs de pipes cigares.", '2025-05-28',0,"xXKillerRoxx69Xx", "./../assets/images/chose.png");

INSERT INTO comment (content,date,likes,author,publicationID) VALUES
("J'ai du bon tabac dans ma tabatière !", '2025-05-29 08:20:13',0,"Martin Matin",1),
("Tout ça me rappelle Fallout...", '2025-05-29 09:14:50',0,"John Doe",2),
("On va fumer du tabac... N'est-ce pas ?", '2025-05-29 12:01:55',0,"Stallone666",3);
   