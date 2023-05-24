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
    election_id VARCHAR(30) NOT NULL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    CHECK (TIMESTAMPDIFF(DAY, start_date, end_date) >= 0)
);

CREATE TABLE Candidates (
    candidate_id INT AUTO_INCREMENT PRIMARY KEY,
    election_id VARCHAR(30) NOT NULL,
    name VARCHAR(255) NOT NULL,
    photo VARCHAR(255),
    FOREIGN KEY (election_id) REFERENCES Elections(election_id)
);

-- The candidates that are awaiting for the approval of the admin alongside their programs
CREATE TABLE awaiting_candidates (
    candidate_id INT NOT NULL PRIMARY KEY,
    election_id VARCHAR(30) NOT NULL,
    name VARCHAR(255) NOT NULL,
    photo VARCHAR(255),
    program_title VARCHAR(255) NOT NULL,
    program_description VARCHAR(255) NOT NULL,
    program_video VARCHAR(255) NOT NULL,
    program_affiche VARCHAR(255) NOT NULL,
    FOREIGN KEY (election_id) REFERENCES Elections(election_id)
);

CREATE TABLE Votes (
    vote_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    election_id VARCHAR(30) NOT NULL,
    vote INT NOT NULL, -- Candidate's Id
    timestamp DATETIME NOT NULL,
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

-- Users

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `is_admin`) VALUES
(100, 'Tristian Morrison', 'tristan@gmail.com', '$2y$10$u.8mnCTmMS/209cKgbT.Q.wcEgsDwf43u1HnsO03zKoH4ZQOAVzG6', 0),
(200, 'Samir Cobb', 'samir@gmail.com', '$2y$10$XEu1U4auNoRyIv3dbblpu.Xn28KrsiCKfrXbAd0iLTLAlUqlIWjJa', 0),
(300, 'Kelsie Hull', 'kelsie@gmail.com', '$2y$10$Nv75A1ptIQ7SI56wBE9vzeEG9TOfvsh0M8.6zps6PWKFFG8Ph9hry', 0),
(400, 'Jacquelyn Cisneros', 'jac@gmail.com', '$2y$10$v0CgN6d0IjyTOXifqEfhEuBDX/guqj6TXiGgpFOGYrprvFNJkvQE2', 0),
(500, 'Rene Campos', 'rene@gmail.com', '$2y$10$d0QHlH5p7WnzuqFy/C6vMOAVN7vKhUIhKAnVJaw/Yq1j2/U1.X/FS', 0);

-- Elections

INSERT INTO `elections` (`election_id`, `title`, `description`, `start_date`, `end_date`) VALUES
('CPI1-2023', 'Class Delegate', 'Elections for class delegate for the year 2022/2023, Promotion 2026', '2023-05-02', '2023-06-30'),
('CPI1-2024', 'Class Delegate', 'Elections for class delegate for the year 2022/2023, Promotion 2027', '2023-04-03', '2023-07-18'),
('CPI2-2023', 'Class Delegate', 'Elections for class delegate for the year 2022/2023, Promotion 2028', '2023-04-03', '2023-08-15'),
('CPI3-2023', 'Class Delegate', 'Elections for class delegate for the year 2022/2023, Promotion 2029', '2023-02-13', '2023-09-12');

-- Candidates

INSERT INTO `candidates` (`candidate_id`, `election_id`, `name`, `photo`) VALUES
(100, 'CPI1-2023', 'Tristian Morrison', 'https://images.chesscomfiles.com/uploads/v1/images_users/tiny_mce/ColinStapczynski/phpEiKozG.jpg'),
(200, 'CPI1-2023', 'Samir Cobb', 'https://www.kindredgroup.com/globalassets/images/asset-library/news--insights/magnus-carlsen_unibet-copy.jpg?width=1920&format=webp&quality=78'),
(300, 'CPI1-2024', 'Kelsie Hull', ''),
(500, 'CPI2-2023', 'Rene Campos', 'https://louisville.edu/enrollmentmanagement/images/person-icon/image'),
(400, 'CPI3-2023', 'Jacquelyn Cisneros', 'https://louisville.edu/enrollmentmanagement/images/person-icon/image');

-- Programs

INSERT INTO `programs` (`program_id`, `candidate_id`, `program_title`, `program_description`, `program_video`, `program_affiche`) VALUES
(1, 100, 'My program', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', '', 'https://img.freepik.com/free-photo/white-painted-wall-texture-background_53876-138197.jpg?w=900&t=st=1684955356~exp=1684955956~hmac=bb23bc49aee01ef5c22d886336d8ea62e164a1981350eff26ce8028fef192de8'),
(2, 200, 'Wekcome to my program!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'OycYHUdAWfQ', 'https://img.freepik.com/free-photo/white-painted-wall-texture-background_53876-138197.jpg?w=900&t=st=1684955356~exp=1684955956~hmac=bb23bc49aee01ef5c22d886336d8ea62e164a1981350eff26ce8028fef192de8'),
(3, 300, 'My program', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'OycYHUdAWfQ', 'https://img.freepik.com/free-photo/white-painted-wall-texture-background_53876-138197.jpg?w=900&t=st=1684955356~exp=1684955956~hmac=bb23bc49aee01ef5c22d886336d8ea62e164a1981350eff26ce8028fef192de8'),
(4, 500, 'Wekcome to my program!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'OycYHUdAWfQ', 'https://img.freepik.com/free-photo/white-painted-wall-texture-background_53876-138197.jpg?w=900&t=st=1684955356~exp=1684955956~hmac=bb23bc49aee01ef5c22d886336d8ea62e164a1981350eff26ce8028fef192de8'),
(5, 400, 'Wekcome to my program!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'OycYHUdAWfQ', 'https://img.freepik.com/free-photo/white-painted-wall-texture-background_53876-138197.jpg?w=900&t=st=1684955356~exp=1684955956~hmac=bb23bc49aee01ef5c22d886336d8ea62e164a1981350eff26ce8028fef192de8');