-- Top Districts Table
CREATE TABLE top_districts (
    district_id INT PRIMARY KEY AUTO_INCREMENT,
    district_name VARCHAR(100) NOT NULL,
    about_the_district TEXT
);

-- District Pictures Table
CREATE TABLE district_pics (
    district_pic_id INT PRIMARY KEY AUTO_INCREMENT,
    district_id INT,
    image_location VARCHAR(255),
    FOREIGN KEY (district_id) REFERENCES top_districts(district_id) ON DELETE CASCADE
);

-- Attractions Table
CREATE TABLE attractions (
    attraction_id INT PRIMARY KEY AUTO_INCREMENT,
    district_id INT,
    attraction_name VARCHAR(100) NOT NULL,
    description_paragraph1 TEXT,
    description_paragraph2 TEXT,
    description_paragraph3 TEXT,
    iframe VARCHAR(255),
    FOREIGN KEY (district_id) REFERENCES top_districts(district_id) ON DELETE CASCADE
);

-- Attraction Pictures Table
CREATE TABLE attraction_pics (
    attraction_pic_id INT PRIMARY KEY AUTO_INCREMENT,
    attraction_id INT,
    image_location VARCHAR(255),
    FOREIGN KEY (attraction_id) REFERENCES attractions(attraction_id) ON DELETE CASCADE
);

-- Things to Do Table
CREATE TABLE things_to_do (
    todo_id INT PRIMARY KEY AUTO_INCREMENT,
    attraction_id INT,
    icon_class VARCHAR(100),
    activity_name VARCHAR(100),
    activity_description TEXT,
    FOREIGN KEY (attraction_id) REFERENCES attractions(attraction_id) ON DELETE CASCADE
);