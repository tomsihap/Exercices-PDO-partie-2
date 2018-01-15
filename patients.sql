#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: patients
#------------------------------------------------------------

CREATE TABLE patients(
        id        int (11) Auto_increment  NOT NULL ,
        lastname  Varchar (25) NOT NULL ,
        firstname Varchar (25) NOT NULL ,
        birthdate Date NOT NULL ,
        phone     Varchar (25) ,
        mail      Varchar (25) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: appointments
#------------------------------------------------------------

CREATE TABLE appointments(
        id          int (11) Auto_increment  NOT NULL ,
        date_hour   Datetime NOT NULL ,
        id_patients Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;

ALTER TABLE appointments ADD CONSTRAINT FK_appointments_id_patients FOREIGN KEY (id_patients) REFERENCES patients(id);
