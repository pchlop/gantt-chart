CREATE DATABASE gantt;

USE gantt;

DROP TABLE IF EXISTS gantt.zadania;
DROP TABLE IF EXISTS gantt.projekty;
DROP TABLE IF EXISTS gantt.uzytkownicy;

CREATE TABLE uzytkownicy
(
    id_uzytkownika INT NOT NULL AUTO_INCREMENT,
    imie VARCHAR (30),
    nazwisko VARCHAR (30),
    login VARCHAR (20),
    email VARCHAR (60),
    haslo VARCHAR(200),
    PRIMARY KEY(id_uzytkownika)
);

CREATE TABLE projekty
(
    id_projektu INT NOT NULL AUTO_INCREMENT,
    nazwa VARCHAR (40),
    wlasciciel INT,
    PRIMARY KEY(id_projektu),
    FOREIGN KEY(wlasciciel) REFERENCES uzytkownicy(id_uzytkownika)
);

CREATE TABLE zadania
(
    id_zadania INT NOT NULL AUTO_INCREMENT,  
    nazwa VARCHAR (50),
    startzadania DATE,
    konieczadania DATE,
    wprojekcie INT,
    PRIMARY KEY(id_zadania),
    FOREIGN KEY(wprojekcie) REFERENCES projekty(id_projektu)
);

INSERT INTO uzytkownicy (imie, nazwisko, login, email, haslo)
    VALUES
    ('Jan', 'Kowalski', 'jankowal', 'email1@wg.com' ,'$2y$10$cCsRKvf.LivbU5O7LhZ7eulwMykDova6SalEz3XnzZP3UrEkGb.SC'), 
    ('Marek', 'Nowak', 'mnowak', 'email2@wg.com' ,'$2y$10$hzvVoxyciM/WscbD1nQhjuppVBjEGEen2qRNZ.W.u/Qge.fjCw/Hm'), 
    ('Zofia', 'Nowacka', 'zoska', 'email3@wg.com' ,'$2y$10$apSheFzcQ6N1Qx7.3PuL2upwGlNEQkYHPIC.5qhDP/2VzJS6cXzx.'), 
    ('Artur', 'Sowicki', 'sowa88', 'email4@wg.com' ,'$2y$10$iuAzx9TbbyJb3O0P8Uj7FuG68gfWHI4ZyMegfsUlK0BAMCaeZcF5K'), 
    ('Cezary', 'Pazura', 'czaruspazur', 'email5@wg.com' ,'$2y$10$AfaEkmqRe4pz8JshbnQIhOtozC2AmTpBV9IVQCcSdHAvZya5rs1YW'), 
    ('Mariusz', 'Rutkowski', 'detektyw', 'email6@wg.com' ,'$2y$10$Mbh7YfGZ9hlpesge7lzsN.buSVulHz6Eef1gm0hNDcoGCR5F3Sp8C'), 
    ('Piotr', 'Chlopski', 'padmin', 'padmin@wg.com' ,'$2y$10$yR9TuWwx51CSTsmL2qyvne0axEBfc4v0PHJtn/ZqqN6m731BKCazW'); 

        /*
    qwerty,
    asdfgh,
    zxcvbn,
    123456,
    098765,
    111111,
    mojehaslo,
    */
    

INSERT INTO projekty (nazwa, wlasciciel)
    VALUES
    ('Projekt1_1', 1),
    ('Projekt1_2', 1),
    ('Projekt1_3', 1),
    ('Projekt1_4', 1),
    ('Projekt1_5', 1),
    ('Projekt1_6', 1),
    ('Projekt2_1', 2),
    ('Projekt2_2', 2),
    ('Projekt3_1', 3),
    ('Projekt3_2', 3),
    ('Projekt3_3', 3),
    ('Projekt5_1', 5),
    ('Projekt5_zdluganazwa', 5),
    ('Projekt5_3', 5),
    ('Projekt5_4', 5),
    ('Projekt5_5', 5),
    ('Projekt_BE', 7),
    ('Projekt_PWI', 7),
    ('Projekt_Grupowy', 7);
    



    

INSERT INTO zadania (nazwa, startzadania, konieczadania, wprojekcie)
    VALUES
    ('P1_Zadanie1', '2020-12-12', '2020-12-17', 1),
    ('P1_Zadanie2', '2020-12-14', '2020-12-18', 1),
    ('P1_Zadanie3', '2020-12-16', '2020-12-17', 1),
    ('P1_Zadanie4', '2020-12-17', '2020-12-21', 1),
    ('P1_Zadanie5', '2020-12-17', '2020-12-26', 1),
    ('P1_Zadanie6', '2020-12-18', '2020-12-29', 1),
    ('P1_Zadanie7', '2020-12-19', '2020-12-28', 1),
    ('P1_Zadanie8', '2020-12-22', '2020-12-24', 1),
    ('P1_Zadanie9', '2020-12-23', '2020-12-26', 1),
    ('P1_Zadanie10', '2020-12-25', '2020-12-28', 1),
    ('P1_Zadanie11', '2020-12-27', '2020-12-29', 1),
    ('P1_Zadanie12', '2020-12-29', '2020-12-31', 1),
    ('P1_Zadanie13', '2020-12-30', '2020-12-30', 1),
    ('P1_Zadanie14', '2020-12-31', '2020-12-31', 1),
    ('P1_Zadanie15', '2020-12-31', '2021-01-06', 1),
    ('P1_Zadanie16', '2020-12-31', '2021-01-11', 1),
    ('P1_Zadanie17', '2020-12-31', '2021-11-07', 1),

    ('P4_Zadanie1', '2020-10-23', '2020-10-26', 4),
    ('P4_Zadanie2', '2020-10-27', '2020-10-30', 4),
    ('P4_Zadanie3', '2020-10-30', '2020-11-09', 4),
    ('P4_Zadanie4', '2020-10-31', '2020-11-20', 4),
    ('P4_Zadanie5', '2020-11-02', '2020-11-04', 4),
    ('P4_Zadanie6', '2020-11-08', '2020-11-11', 4),
    ('P4_Zadanie7', '2020-11-09', '2020-11-21', 4),

    ('P10_Zadanie1', '2020-11-01', '2020-11-26', 10),
    ('P10_Zadanie1', '2020-11-03', '2020-11-06', 10),
    ('P10_Zadanie1', '2020-11-07', '2020-11-10', 10),
    ('P10_Zadanie1', '2020-11-09', '2020-11-12', 10),
    ('P10_Zadanie1', '2020-11-12', '2020-11-24', 10),
    ('P10_Zadanie1', '2020-11-14', '2020-11-20', 10),
    ('P10_Zadanie1', '2020-11-16', '2020-11-26', 10),
    ('P10_Zadanie1', '2020-11-15', '2020-11-25', 10),
    ('P10_Zadanie1', '2020-11-18', '2020-11-27', 10),
    ('P10_Zadanie1', '2020-11-22', '2020-11-24', 10),
    ('P10_Zadanie1', '2020-11-23', '2020-11-29', 10),
    ('P10_Zadanie1', '2020-11-25', '2020-11-30', 10),

    ('Motywy', '2020-12-12', '2020-12-24', 18),
    ('Ciasteczka', '2020-12-15', '2020-12-26', 18),
    ('Ajax', '2020-12-20', '2020-12-30', 18),
    ('Dyniamiczne menu', '2020-12-20', '2020-12-30', 18),
    ('SQL injection', '2020-12-27', '2021-01-06', 18),
    ('Hashowanie haseł', '2020-12-27', '2021-01-10', 18),
    ('Udoskonalenie logiki appki', '2020-12-27', '2021-01-12', 18);


    