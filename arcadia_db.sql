CREATE DATABASE arcadia_db;
USE arcadia_db;

CREATE TABLE roles (
    role_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL
);

CREATE TABLE users (
    user_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    role_id INT(11),
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

CREATE TABLE veterinarian_reports (
    veterinarian_report_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date DATETIME NOT NULL,
    detail TEXT(1000) NOT NULL,
    food_quantity DECIMAL(2) NOT NULL,
    user_id INT(11) NOT NULL,
    food_type_id INT(11) NOT NULL,
    food_unit_id INT(11) NOT NULL,
    animal_id INT(11) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (food_type_id) REFERENCES food_types(food_type_id),
    FOREIGN KEY (animal_id) REFERENCES animals(animal_id),
    FOREIGN KEY (food_unit_id) REFERENCES food_units(food_unit_id)
);

CREATE TABLE food_types (
    food_type_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(75) NOT NULL
);

CREATE TABLE animals (
    animal_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(25) NOT NULL,
    state VARCHAR(100),
    breed_id INT(11),
    habitat_id INT(11),
    FOREIGN KEY (breed_id) REFERENCES breeds(breed_id),
    FOREIGN KEY (habitat_id) REFERENCES habitats(habitat_id)
);

CREATE TABLE animal_images (
    animal_image_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    animal_id INT(11),
    FOREIGN KEY (animal_id) REFERENCES animals(animal_id)
);

CREATE TABLE breeds (
    breed_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE habitats (
    habitat_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT(500),
    veterinarian_comments TEXT(500)
);

CREATE TABLE habitat_images (
    habitat_image_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    habitat_id INT(11),
    FOREIGN KEY (habitat_id) REFERENCES habitats(habitat_id)
);

CREATE TABLE food_units (
    food_unit_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(10) NOT NULL
);

CREATE TABLE employee_reports (
    employee_report_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    food_quantity DECIMAL(2) NOT NULL,
    food_type_id INT(11) NOT NULL,
    food_unit_id INT(11) NOT NULL,
    animal_id INT(11) NOT NULL,
    FOREIGN KEY (food_type_id) REFERENCES food_types(food_type_id),
    FOREIGN KEY (animal_id) REFERENCES animals(animal_id),
    FOREIGN KEY (food_unit_id) REFERENCES food_units(food_unit_id)
);