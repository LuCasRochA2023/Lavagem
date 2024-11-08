

DROP TABLE IF EXISTS apiftw.services CASCADE;
DROP TABLE IF EXISTS apiftw.users CASCADE;

CREATE TABLE apiftw.users (
    id SERIAL PRIMARY KEY,  
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);

CREATE TABLE apiftw.services (
    id SERIAL PRIMARY KEY,  
    preco FLOAT NOT NULL,
    tempoDeEspera TIME NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES apiftw.users(id)  
);
