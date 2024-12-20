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
    role_id INT(11) UNSIGNED,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
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

CREATE TABLE food_types (
    food_type_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(75) NOT NULL
);

CREATE TABLE animals (
    animal_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(25) NOT NULL,
    state VARCHAR(100),
    breed_id INT(11) UNSIGNED,
    habitat_id INT(11) UNSIGNED,
    FOREIGN KEY (breed_id) REFERENCES breeds(breed_id),
    FOREIGN KEY (habitat_id) REFERENCES habitats(habitat_id)
);

CREATE TABLE food_units (
    food_unit_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(10) NOT NULL
);

CREATE TABLE veterinarian_reports (
    veterinarian_report_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    detail TEXT(1000) NOT NULL,
    food_quantity DECIMAL(2) NOT NULL,
    user_id INT(11) UNSIGNED NOT NULL,
    food_type_id INT(11) UNSIGNED NOT NULL,
    food_unit_id INT(11) UNSIGNED NOT NULL,
    animal_id INT(11) UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (food_type_id) REFERENCES food_types(food_type_id),
    FOREIGN KEY (animal_id) REFERENCES animals(animal_id),
    FOREIGN KEY (food_unit_id) REFERENCES food_units(food_unit_id)
);

CREATE TABLE animal_images (
    animal_image_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    animal_id INT(11) UNSIGNED,
    FOREIGN KEY (animal_id) REFERENCES animals(animal_id) ON DELETE CASCADE
);

CREATE TABLE habitat_images (
    habitat_image_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    habitat_id INT(11) UNSIGNED,
    FOREIGN KEY (habitat_id) REFERENCES habitats(habitat_id)
);

CREATE TABLE employee_reports (
    employee_report_id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    food_quantity DECIMAL(2) UNSIGNED NOT NULL,
    food_type_id INT(11) UNSIGNED NOT NULL,
    food_unit_id INT(11) UNSIGNED NOT NULL,
    animal_id INT(11) UNSIGNED NOT NULL,
    FOREIGN KEY (food_type_id) REFERENCES food_types(food_type_id),
    FOREIGN KEY (animal_id) REFERENCES animals(animal_id),
    FOREIGN KEY (food_unit_id) REFERENCES food_units(food_unit_id)
);

CREATE TABLE schedule_hours (
    schedule_hour_id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    hour VARCHAR(10) NOT NULL
);

CREATE TABLE week_days (
    week_day_id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    day VARCHAR(15) NOT NULL
);

CREATE TABLE schedules (
    schedule_id INT(11) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    schedule_hour_id INT(11) UNSIGNED NOT NULL,
    week_day_id INT(11) UNSIGNED NOT NULL,
    is_opened TINYINT(1) UNSIGNED NOT NULL,
    FOREIGN KEY (schedule_hour_id) REFERENCES schedule_hours(schedule_hour_id),
    FOREIGN KEY (week_day_id) REFERENCES week_days(week_day_id)
);