CREATE TABLE User_(
   Id_User INT IDENTITY,
   nom VARCHAR(50) ,
   prenom VARCHAR(50) ,
   email VARCHAR(115) ,
   mot_de_passe VARCHAR(150) ,
   PRIMARY KEY(Id_User),
   UNIQUE(email)
);

CREATE TABLE Artiste(
   Id_Artiste INT IDENTITY,
   nom VARCHAR(50) ,
   description VARCHAR(500) ,
   setlist VARCHAR(1000) ,
   genre_musical VARCHAR(50) ,
   photo VARCHAR(255) ,
   PRIMARY KEY(Id_Artiste)
);

CREATE TABLE Representation(
   Id_representation INT IDENTITY,
   date_debut DATE,
   date_fin DATE,
   PRIMARY KEY(Id_representation)
);

CREATE TABLE Participe(
   Id_Artiste INT,
   Id_representation INT,
   PRIMARY KEY(Id_Artiste, Id_representation),
   FOREIGN KEY(Id_Artiste) REFERENCES Artiste(Id_Artiste),
   FOREIGN KEY(Id_representation) REFERENCES Representation(Id_representation)
);

CREATE TABLE Reservation(
   Id_User INT,
   Id_representation INT,
   date_reservation DATE,
   heure_debut TIME,
   heure_fin TIME,
   PRIMARY KEY(Id_User, Id_representation),
   FOREIGN KEY(Id_User) REFERENCES User_(Id_User),
   FOREIGN KEY(Id_representation) REFERENCES Representation(Id_representation)
);

GO

INSERT INTO dbo.Artiste (
    nom,
    genre_musical,
    description,
    setlist, 
    photo
)

VALUES 
(N'Drake',
N'Rap / Hip-Hop', 
N'Drake est un rappeur Canadien connu pour ses musique comme Gods plan, Controlla, Headlines,... ou aussi pour son role dans Degrassi.' , 
N'Shabang, One dance, Too Good, Over my dead body, The Motto, Trust Issues',
'drake.jpg' 
),
(N'Travis Scott',
N'Trap / Hip-hop / Psychedelic Rap',
N'Un show très énergique avec grosses productions visuelles, basses puissantes et ambiance de festival.',
N'SICKO MODE, goosebumps, FE!N, HIGHEST IN THE ROOM, Antidote, BUTTERFLY EFFECT, 4X4, goosebumps (Remix)',
'travis-scott.jpg'
),
(N'SZA',
N'R&B/Soul/Alternative R&B',
N'Une grande figure du R&B contemporain, avec un univers plus émotionnel et mélodique.',
N'Kill Bill, Snooze, Good Days, Love Galore, The Weekend, Nobody Gets Me, Luther, 30 for 30 ',
'sza.jpg'
),
(N'Tyler, The Creator',
N'Hip-Hop/Alternative Rap/ Neo-Soul',
N'Artiste très créatif mélangeant rap, soul, funk et esthétique visuelle originale.',
N'EARFQUAKE, See You Again, New Magic Wand, Wusyaname, Yonkers, LUMBERJACK, Sticky, Like Him',
'tyler-the-creator.jpg'
),
(N'Cardi B',
N'Hip-Hop/Trap/Rap',
N'Rapper new-yorkaise connue pour son énergie, son charisme et ses morceaux très orientés festival.',
N'Bodak Yellow, I Like it, WAP, Up, Money, Be Careful, Press, Outside',
'cardi-b.jpg'
),
(N'Doja Cat',
N'Hip-Hop/Pop/R&B',
N'Une artiste polyvalente capable de passer du rap à la pop et au R&B avec une forte identité visuelle.',
N'Paint The Town Red, Woman, Say So, Kiss Me More, Agora Hills, Need to Know, Tia Tamera, Boss Bitch ',
'doja-cat.jpg'
),
(N'Future',
N'Trap / Hip-hop / Southern Rap',
N'Une figure majeure de la trap américaine, idéale pour apporter une ambiance sombre et très bass-heavy.',
N'Mask Off, March Madness, Life Is Good, Low Life, Stick Talk, Wicked, Turn On the Lights, Throw Away',
'future.jpg'
),
(N'21 Savage',
N'Trap / Hip-hop',
N'Flow posé et sombre, avec un style reconnaissable et beaucoup de collaborations populaires.',
N'a lot, Bank Account, redrum, Jimmy Cooks, Rich Flex, Runnin, Glock in My Lap, No Heart',
'21-savage.jpg'
),
(N'Megan Thee Stallion',
N'Hip-hop / Southern Rap / Trap',
N'Une performeuse très énergique qui apporte une grosse dimension dansante au festival.',
N'Savage, HISS, Body, Mamushi, Thot Shit, Her, Plan B, WAP',
'megan-the-stallion.jpg'
),
(N'Playboi Carti',
N'Trap / Rage / Hip-hop',
N'Sonorités très modernes, performances chaotiques et ambiance particulièrement adaptée à une grande scène.',
N'Magnolia, Sky, FE!N, Shoota, R.I.P., Stop Breathing, Carnival, Rather Lie',
'playboi-carti.jpg'
),
(N'J.Cole',
N'Hip-hop / Conscious Rap',
N'Un rappeur davantage axé sur l''écriture, les histoires personnelles et les performances live.',
N'No Role Modelz, Middle Child, Wet Dreamz, A Lot, Love Yourz, MIDDLE CHILD, Work Out, Power Trip',
'j-cole.jpg'
),
(N'Lil Baby',
N'Trap / Hip-hop',
N'Une des figures importantes de la trap moderne d''Atlanta, avec un style très rythmé.',
N'Drip Too Hard, Freestyle, Yes Indeed, Woah, The Bigger Picture, Emotionally Scarred, On Me, Pure Cocaine',
'lil-baby.jpg'
),
(N'Gunna',
N'Trap / Hip-hop / Melodic Rap',
N'Flow mélodique et productions trap très aérées, parfaits pour une partie plus chill du festival.',
N'fukumean, Drip Too Hard, Lemonade, Pushin P, Skybox, Banking On Me, bread & butter, wgft',
'gunna.jpg'
),
(N'Beyonce',
N'R&B/Pop/Hip-Hop',
N'rtiste américaine mondialement reconnue, Beyoncé est célèbre pour sa puissance vocale, ses performances scéniques spectaculaires et ses chorégraphies. Son univers mélange R&B, pop, soul, hip-hop et influences afro-américaines. Elle est idéale comme tête d’affiche pour un festival grâce à ses nombreux hits et à ses shows très travaillés.',
N'Crazy in Love, Formation, Run the World (Girls), Diva, Cuff It, Break My Soul, Alien Superstar, Love on Top, Drunk in Love, America Has a Problem, Pure/Honey, Summer Renaissance',
'beyonce.jpg'
),
(N'Justin Bieber',
N'Pop / R&B / Pop-R&B / Dance-pop',
N'chanteur canadien mondialement connu pour ses nombreux succès dans la pop et le R&B. Révélé très jeune, il s''est imposé grâce à sa voix, ses mélodies accrocheuses et ses performances scéniques. Son style a évolué au fil des années, passant de la pop adolescente à un son plus mature mêlant R&B, pop et musique électronique. Il apporte au festival une ambiance à la fois énergique, dansante et romantique.',
N'Baby, Sorry, What Do You Mean?, Where Are Ü Now, Love Yourself, Company, Peaches, Hold On, Ghost, Stay, Beauty and a Beat, Never Say Never',
'justin-bieber.jpg'
),
(N'Bruno Mars',
N'Pop / Funk / R&B / Soul',
N'Une véritable machine à hits, avec un spectacle très dansant et beaucoup de musiciens live.',
N'24K Magic, Uptown Funk, That''s What I Like, Locked Out of Heaven, Treasure, Grenade, Just the Way You Are, I Just Might',
'bruno-mars.jpg'
),
(N'GloRilla',
N'Memphis Rap / Trap / Hip-hop',
N'Une énergie brute et un rap très direct, idéale pour faire monter l''ambiance.',
N'F.N.F. (Let''s Go), Tomorrow 2, Yeah Glo!, Wanna Be, TGIF, Lick Or Sum, Whatchu Kno About Me, O Let''s Do It',
'glorilla.jpg'
);

GO

INSERT INTO dbo.Representation (
    date_debut,
    date_fin
)

VALUES
('2027-07-10', '2027-07-10'),
('2027-07-10', '2027-07-10'),
('2027-07-10', '2027-07-10'),
('2027-07-10', '2027-07-10'),
('2027-07-10', '2027-07-10'),
('2027-07-11', '2027-07-11'),
('2027-07-11', '2027-07-11'),
('2027-07-11', '2027-07-11'),
('2027-07-11', '2027-07-11'),
('2027-07-11', '2027-07-11'),
('2027-07-11', '2027-07-11'),
('2027-07-12', '2027-07-12'),
('2027-07-12', '2027-07-12'),
('2027-07-12', '2027-07-12'),
('2027-07-12', '2027-07-12'),
('2027-07-12', '2027-07-12'),
('2027-07-12', '2027-07-12');

Go

INSERT INTO dbo.Participe (
    Id_Artiste,
    Id_representation
)
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17);

GO

SELECT 
    a.nom AS Artiste,
    COUNT(p.Id_representation) AS nb_representations
FROM dbo.Artiste AS a
LEFT JOIN dbo.Participe AS p
    ON a.Id_Artiste = p.Id_Artiste
GROUP BY a.Id_Artiste, a.nom
ORDER BY nb_representations DESC;
