#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: User
#------------------------------------------------------------

CREATE TABLE User(
        id     Int  Auto_increment  NOT NULL ,
        nom    Varchar (255) NOT NULL ,
        prenom Varchar (255) NOT NULL ,
        age    Smallint NOT NULL ,
        email  Varchar (255) NOT NULL
	,CONSTRAINT User_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Article
#------------------------------------------------------------

CREATE TABLE Article(
        id      Int  Auto_increment  NOT NULL ,
        titre   Varchar (1000) NOT NULL ,
        contenu Text NOT NULL ,
        date    Datetime NOT NULL ,
        slug    Varchar (1000) NOT NULL ,
        user_id Int NOT NULL
	,CONSTRAINT Article_PK PRIMARY KEY (id)

	,CONSTRAINT Article_User_FK FOREIGN KEY (user_id) REFERENCES User(id)
)ENGINE=InnoDB;

