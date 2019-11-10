# Styx Fide CMS

![Styx Fide Homepage](https://i.imgur.com/L3WTO7k.png)

## A simple CRUD Application written in vanilla PHP and SQL in the procedural paradigm

### This project was made as part of my studies @SAE Institute Munich in the module Database and Back-end Development

## The medium is posts, written in a collaborative Blog managed and overviewed by mods & admins

![Styx Fide Homepage](https://i.imgur.com/BICvGoZ.png)


## Features:

- Sign up
- Log in
- Reset Password per E-Mail(Gmail configured)
- Create Posts
- Comment
- WYSIWYG Editor(Bold, Italic, Underline, Left/Right Align)
- Post in different categories(subjects) such as PHP, MySQL et cetera
- Administrator privileges
    - The admin can:
        - create, edit, delete users,
        - create, edit, delete posts
        - give other users another permission

## Administrative rights overview

![Permissions Overview](https://i.imgur.com/S80L2yM.png)

## Database Model Overview:

### The database is a relational one, focused on 1-to-n and n-to-m relations, as seen below:

![Relations Overview](https://i.imgur.com/LrChHPk.png)

# Installation

- ``` composer install ``` in order to get phpmailer
- copy includes/dbConfig.example.php into dbConfig.php and set up the connection to your own database,
- copy includes/mailCredentials.example.php into mailCredentials.php and use your credentials

## For Vagrant users:

Set up a simple virtual host in apache on your guest OS and forward it into ```drivers/etc/hosts``` of the host OS

## MySQL

Either forward port 3306 or in MySQL Workbench create connection with 'Standard TCP/IP over SSH' like:

- SSH Port: 2222
- SSH Username: vagrant
- SSH key file: needs to be your VM key
- MySQL Hostname & Port: 127.0.0.1:3306
- Username: root
- Password: yourpassword

Also, don't forget to set up your privileged user in MySQL cli in the guest machine:

``` GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost'; ```