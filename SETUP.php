<?php

//     							    __
//   							   |  \
//   ______              ______    | $$                                    __            __    __     
//  /      \            /      \    \$                                    |  \          |  \  |  \    
// |  $$$$$$\  ______  |  $$$$$$\ ______          ______   __    __       | $$  ______   \$$ _| $$_   
// | $$   \$$ |      \ | $$_  \$$/      \        |      \ |  \  |  \      | $$ |      \ |  \|   $$ \  
// | $$        \$$$$$$\| $$ \   |  $$$$$$\        \$$$$$$\| $$  | $$      | $$  \$$$$$$\| $$ \$$$$$$  
// | $$   __  /      $$| $$$$   | $$    $$       /      $$| $$  | $$      | $$ /      $$| $$  | $$ __ 
// | $$__/  \|  $$$$$$$| $$     | $$$$$$$$      |  $$$$$$$| $$__/ $$      | $$|  $$$$$$$| $$  | $$|  \
//  \$$    $$ \$$    $$| $$      \$$     \       \$$    $$ \$$    $$      | $$ \$$    $$| $$   \$$  $$
//   \$$$$$$   \$$$$$$$ \$$       \$$$$$$$        \$$$$$$$  \$$$$$$        \$$  \$$$$$$$ \$$    \$$$$ 
//
//  Created By CodeShady
//   _____  _____  _____  _____  _____ 
//  |   __||   __||_   _||  |  ||  _  |
//  |__   ||   __|  | |  |  |  ||   __|
//  |_____||_____|  |_|  |_____||__|   
                                                                                                                     
//  To Get Started, please run this page in your browser. - http://MYSITE.com/SETUP.php


// TITLE
define("TITLE", "My Developer Team");

// TEAM IMAGE URL
define("TEAM_IMAGE_URL", "INVITATION-IMAGE-URL");

// DATABASE SETUP
define("DB_HOST", "127.0.0.1");
define("DB_NAME", "CAFE-DATABASE");
define("DB_USER", "MYSQL-USERNAME");
define("DB_PASSWORD", "MYSQL-PASSWORD");





// Don't worry about this stuff below. It's all automatic... ;)

// SET UP MYSQL SERVER
$hostname = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$databaseName = DB_NAME;

//Connect to database
$database = mysqli_connect($hostname, $username, $password, $databaseName);

if (!$database) {
    die('Hmmm.. We Couldn\'t connect to servers! <br /><br /> Error: ' . mysqli_error($database));
}


// Check if sql database and table was already created
if(!mysqli_query($database, "SELECT 1 FROM `publicchat` LIMIT 1;")) {
    $create_publicchat = mysqli_query($database, "CREATE TABLE publicchat(name TEXT, email TEXT, post TEXT, absoluteTime TEXT, formattedTime TEXT, id TEXT);");

    if(!$create_publicchat) {
    	echo "ERROR, Creating 'publicchat' table!";
    }
}
if(!mysqli_query($database, "SELECT 1 FROM `cafeusers` LIMIT 1")) {
	$create_cafeusers = mysqli_query($database, "CREATE TABLE cafeusers(name TEXT, email TEXT, password TEXT, salt TEXT, ipAddress TEXT, dateJoined TEXT, id TEXT);");

    if(!$create_publicchat) {
    	echo "ERROR, Creating 'cafeusers' table!";
    }
}

?>