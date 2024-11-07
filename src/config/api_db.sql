
USE api_db;


DROP TABLE IF EXISTS apiftw.users;  
CREATE TABLE apiftw.users (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);

DROP TABLE IF EXISTS apiftw.services;  
CREATE TABLE apiftw.services (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    preco FLOAT NOT NULL,
    tempoDeEspera TIME NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES apiftw.users(id)  
);
