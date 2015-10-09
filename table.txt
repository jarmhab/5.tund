CREATE TABLE car_plates (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  number_plate VARCHAR(200),   
  color TEXT
);