DROP DATABASE IF EXISTS voting_system;
CREATE DATABASE voting_system;
USE voting_system;

CREATE TABLE Users (
    user_id INT NOT NULL PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT false
);

CREATE TABLE Elections (
    election_id INT NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL
);

CREATE TABLE Candidates (
    candidate_id INT AUTO_INCREMENT PRIMARY KEY,
    election_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    FOREIGN KEY (election_id) REFERENCES Elections(election_id)
);

CREATE TABLE Votes (
    vote_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    election_id INT NOT NULL,
    vote INT NOT NULL, -- Candidate's Id
    timestamp DATE NOT NULL,
    FOREIGN KEY (election_id) REFERENCES Elections(election_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE Programs (
    program_id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT NOT NULL,
    program_title VARCHAR(255) NOT NULL,
    program_description VARCHAR(255) NOT NULL,
    program_video VARCHAR(255) NOT NULL,
    program_affiche VARCHAR(255) NOT NULL,
    FOREIGN KEY (candidate_id) REFERENCES Candidates(candidate_id)
);

-- Predefined Admin
INSERT INTO users VALUES (1, "Admin", "admin@gmail.com", "$2y$10$dFT7CXiTqD4wal8WxO/q8uWVbWo835f7iq/xOvy.3j8UAOZga6IJy", true); -- Password is Admin12345

-- Elections
INSERT INTO elections VALUES (100, "Class Delegate", "Elections for class delegate for the year 2022/2023, Promotion 2026", '2022-10-10', '2022-10-17');
INSERT INTO elections VALUES (200, "Class Delegate", "Elections for class delegate for the year 2022/2023, Promotion 2027", '2022-9-10', '2022-9-17');
INSERT INTO elections VALUES (300, "Class Delegate", "Elections for class delegate for the year 2022/2023, Promotion 2028", '2022-11-10', '2022-11-17');
INSERT INTO elections VALUES (400, "Class Delegate", "Elections for class delegate for the year 2022/2023, Promotion 2029", '2022-11-24', '2022-11-30');

-- Candidates
INSERT INTO Candidates(election_id, name, photo) VALUES (100, "Imane Rahali", '');
INSERT INTO Candidates(election_id, name, photo) VALUES (100, "Anas Kemmoune", '');
INSERT INTO Candidates(election_id, name, photo) VALUES (100, "Adam Ait Magourt", '');

INSERT INTO Candidates(election_id, name, photo) VALUES (200, "Imane Fjer", '');
INSERT INTO Candidates(election_id, name, photo) VALUES (200, "Anas Agourram", '');

INSERT INTO Candidates(election_id, name, photo) VALUES (300, "Imane Arnaoui", '');
INSERT INTO Candidates(election_id, name, photo) VALUES (300, "Anas Youss", '');

INSERT INTO Candidates(election_id, name, photo) VALUES (400, "Imane Hakkou", '');
INSERT INTO Candidates(election_id, name, photo) VALUES (400, "Anas Maftah", '');

-- Programs
-- INSERT INTO programs(candidate_id, program_title, program_description, program_video, program_affiche) VALUES (400, "My program", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.", "", "");