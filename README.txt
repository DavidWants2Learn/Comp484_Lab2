This project contains two folders, Client and Service. Where Client contains index.php and homepage.php.
Client Folder
	Index.php is the initial page where the user registers or logins to their account. 
	Homepage.php is the page that populates after the user verifies their credentials and where the user will be able to press a button to turn on the lights in the lab.

Service Folder
	Connection.php contains the database credentials, and connection to that database.
	ServiceLogin.php contains registration and login button logic. IE, checks to make sure username and password fields are NOT empty. Registation button checks for duplicate usernames. And Login button checks to see if user exists. The ServiceLogin.php file also salts and hashes the password, so that the user must know the password in order to login. The admin does not know the password.

This lab is 108% complete. The program communicates with the lights in the lab, blinks 4 times, and we've also completed the user password salt and hash extra credit.

No known bugs.

Teammates Mark Siegmund.
	  David Oh
