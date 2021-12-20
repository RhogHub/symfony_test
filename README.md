# ASP-Test

# About

Test for Alter Solutions 2021-2022.
The application has two main features: Create a new user (with first name, last name, e-mail and age) and create a password for a user.


# Layout
![img-1](https://user-images.githubusercontent.com/31027616/146717769-a0f9d35b-673a-4a82-9a4c-dfff35a9bf0f.png)



# Requirements
- PHP v^7.4
- MySQL(MariaDB) v^10.4.
- Installed dependencies.

# How to execute
- In the MATERIAL folder there is an sql dump to properly create the database.
- In the folder "..\src\Database\" there is a config.php file for the database connection string.
- In the terminal run the desired command.

## Commands
With the terminal pointed at the project folder:
- php asptest.php - display available commands.
- php asptest.php USER:CREATE [First name][Last name][E-mail][Age] - For create a new User (the field Age is optional).
- php asptest.php USER:CREATE-PWD [userID][New password][Confirm the new password] - To create a password for the user with the userID.
- vendor\bin\phpunit test\CreateUserTest.php - To test USER:CREATE.
- vendor\bin\phpunit.bat test\CreateUserTest.php - To test USER:CREATE in Windows OS.
- vendor\bin\phpunit test\CreatePwdTest.php - To test USER:CREATE-PWD.
- vendor\bin\phpunit.bat test\CreatePwdTest.php - To test USER:CREATE-PWD in Windows OS.

# Technologies

## Database
- MySQL (MariaDB) v10.4.13

## Back end
- PHP v7.4.7 (for Windows)
- Composer v2.1.5

## Fron end
- symfony console v5.4

## Tests 
- PHPUnit v9.5

## Others
- xampp v3.2.4
- VS Code v1.63
- GIT v2.21.0.windows.1
- phpMyAdmin SQL v5.0.2
- VMware Workstation Pro v16.1.0 

# Author
Rodrigo Henrique de Oliveira Godoi


