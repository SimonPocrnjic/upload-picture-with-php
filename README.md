# Upload images with php

Simple application that uploads images using simple PHP. 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

If you want to try the project on your local machine you will have to install a LOCAL HOST SERVER.

My recommendations: XAMPP, WAMP Server, AMMPS Stack, Laragon

Once you have installed the local host server, setup the root folder to point to your projects folder or you can use the programs default WWW folder (it's located in the installed directory)

### Installing

How to setup and run the project

Most important files

functions > upload.php (most important file)
server > config.php connect.php (you can of course use your own server settings to connect to your database, i'm using MYSQLI just change the $myserver variable to something else)

Example files

Index.php (most of the stuff is just for example, importent part is the FORM tag)
css > app.css (you can customize it or use your own)
js > app.js (the preview image function is useful, might make a separat project out of it)

Other files 

functions > getImages.php (mainly to fetch and display images) deleteImage.php (deletes the selected image from the database and images folder)
images (contains the uploaded images)
test.sql (you can use this to create database test and the table images)

IMPORTANT!!

You must create a table NAMED images (i still have not made it so you can use your own custom table, you can of course customize the code yourself)

Most crucial variables `image_name` and `title`

```
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `image_name` longtext COLLATE utf8mb4_bin NOT NULL,
  `size` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)

```

Files you might want to change

server > config.php 

```
<?php
define('server', 'localhost'); //server name (url, ip)
define('server_username', 'root'); //server user 
define('server_password', ''); //server user password
define('database', 'test'); //database name
define('home_url', 'http://localhost/'); //url to you homepage (not really that important)

```

## Authors

* **Simon** - *Simon Pocrnjic* - [SipoDev](https://github.com/SimonPocrnjic)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

