# Voting Website for Universities

This repository contains the source code for a voting website designed specifically for universities. The website allows students to participate in elections by logging in or signing up using their student identifiers. Additionally, students have the option to apply for candidature in any of the available elections displayed on their dashboard. The admin has exclusive privileges to manage elections and approve or reject candidature applications.

## Table of Contents
- [Voting Website for Universities](#Voting-Website-for-Universities)
  - [Table of Contents](#table-of-contents)
  - [Features](#features)
  - [Website Overview](#website-overview)
  - [Installation and Configuration](#installation-and-configuration)
  - [System Operation](#system-operation)

## Features

- **User Authentication**: Students can securely log in or sign up using their student identifiers, and the application utilizes hashing and salting techniques to ensure the security of user credentials.
- **User Roles Management**: The website supports dual user roles, encompassing admin and regular users, with varying levels of access rights.
- **Candidature Application**: Students can apply for candidature in any available election, expressing their interest in becoming a candidate. The admin will review and either approve or reject these applications.
- **Election Participation**: Students can view and participate in any election by voting for their preferred candidates, excluding themselves if they are a candidate for a given election.
- **Admin Privileges**: The admin has special privileges to manage elections, including adding new elections, modifying and deleting existing ones. They also have the authority to approve or reject candidature applications and visualize the voting results.
- **Campaign Programs**: Each candidate has a campaign program that voters can view, providing additional information about the candidates and their goals.
- **Election Management**: Elections with end dates that have passed are closed and no longer appear in the dashboard, preventing further voting.
- **Visualization of Results**: The admin can view the results of each election in a visual format (a pie chart).


## Screenshots

Here are some screenshots showcasing the user interface and functionality of the voting website:

1. Login Page:
   ![Login Page](https://github.com/imanerh/Examen_Final/assets/65502022/1e8caa29-7a4d-4166-9156-b36d4d720379)

2. Dashboard:
    - Student:
      ![Dashboard Student](https://github.com/imanerh/Examen_Final/assets/65502022/30d23319-e4ac-48d4-8977-59b2aaa3a29f)
    - Admin: 
      ![Dashboard Admin](https://github.com/imanerh/Examen_Final/assets/65502022/2b55c2d2-01aa-419c-a3c5-6cfd68ec271e)

4. Candidature Application:
   ![Candidature Application](https://github.com/imanerh/Examen_Final/assets/65502022/7ea73b20-835c-402c-9a46-6f51806ced1c)

5. Voting Results:
   ![Voting Results](https://github.com/imanerh/Examen_Final/assets/65502022/0c13e565-fb50-4af7-896e-146f38d16d88)
   
Feel free to explore the repository to gain further insights into the implementation of this voting website for universities.


## Installation and Configuration

Follow these detailed steps for a smooth and error-free installation and setup:

1. Clone the repository onto your local machine.
2. Ensure the [WAMP Server](https://www.wampserver.com/en/) is installed on your machine.
3. Relocate the project folder to the `www` directory within your WAMP Server installation.
4. Initiate the WAMP Server, ensuring the MySQL and Apache services are active.
5. Import the provided SQL file from the repository to configure the database schema, tables, and populate preliminary data.
6. Update the `config.php` file with your unique database credentials: username, password, and database name.
7. Launch your preferred browser and navigate to `http://localhost/{your_project_folder_name}` to access the application.

## System Operation

## Student

- **Registration and Login**:
  - Visit the website and click on the "Sign Up" button to create an account using your student identifier.
  - If you already have an account, click on the "Log In" button and enter your credentials to access your account.

- **Dashboard**:
  - Upon successful login, you will be redirected to your dashboard.
  - The dashboard displays the available elections where you can cast your votes and apply for candidature.
  - Click on an election to view the candidates running for it.
  - You can also view the campaign programs of the candidates to make an informed decision.

- **Voting**:
  - To cast your vote, select the candidate you wish to vote for and click on "Vote".
  - You can vote in any election, but you cannot vote for yourself if you are a candidate.
 
 - **Candidature Application**:
  - If you are interested in becoming a candidate, click on the "Be a candidate" button.
  - Fill the form and submit your application. The admin will review your application and either approve or reject it.

## Admin

- **Admin Login**:
Use these credentials for admin access:
   - **Student Identifier**: 1 (the student identifier 1 is reserved for the Admin)
   - **Password**: Admin12345

- **Election Management**:
  - In the admin panel, you have the authority to manage elections.
  - Add a New Election: Click on the "Add Election" button and provide the necessary details.
  - Modify an Existing Election: Select the election you want to modify and update the relevant information.
  - Delete an Election: Remove an election from the system by clicking on the "delete" button.
 
- **Candidature Approval**:
  - As the admin, you will receive candidature applications from students.
  - Review the applications in the admin panel and decide whether to approve or reject them based on the eligibility criteria.

- **Voting Results Visualization**:
  - The admin can view the results of each election.
  - In the admin panel, click on the "Statistics" button.
  - You will see a pie chart representing the distribution of votes among the candidates, alongside the number of votes each candidate has received, and the total number of votes.
  - This allows you to analyze the outcome of the elections and make informed decisions based on the results.

