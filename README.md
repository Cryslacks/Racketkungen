# Racketkungen
A simple website used to sell goods

## Files
This section has a short summary of how and why files are used in the website

### index.php
The main page of the website, this contains connections to **login.php**, **create.php** and **logout.php**

### db.php
A basic php file for easy re-using the database connection, which is used in all of the php files in this directory  

### login.php
Weblayout for loging into an already existing account, this connects to **login_user.php**

### login_user.php
A php file for handling SQL querying and checking if the provided login details sent from **login.php** are valid

### create.php
Weblayout for creating an account, connects to **create_user.php**

### create_user.php
A php file for handling SQL querying and checking if the provided creation details sent from **create.php** are going to be valid, ex: Checking if all provided inputs are covered and username doesnt exist

### logout.php
A php file for handling session reseting for when you are signed in

### debug.php
Just a simple debug file for easy loging into the root administration account. **WILL BE REMOVED ON DEPLOYMENT OF THE WEBSITE**
