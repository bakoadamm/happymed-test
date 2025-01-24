CREATE TABLE rentals (
     id INTEGER PRIMARY KEY AUTO_INCREMENT,
     movie_id INTEGER NOT NULL,
     customer_name TEXT NOT NULL,
     rental_date DATE NOT NULL,
     return_date DATE,
     FOREIGN KEY (movie_id) REFERENCES movies(id)
);
