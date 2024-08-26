# LFC-Reservation-System

This project is a simple implementation of an online reservation system for Little Fishing Creek Golf Course. It's currently using Hostinger as the public domain where all the files and database are stored and maintained (until January 18, 2025): https://brady-blackstone.com/LFC-Reservation-System/ 
<br>

This is a mock website of the original website: https://www.littlefishingcreek.com/ 
<br>

It includes:    
&ensp; &ensp; &ensp; &ensp; - Client/Server User Authentication and Authorization    
&ensp; &ensp; &ensp; &ensp; - Cache history of current user logged in    
&ensp; &ensp; &ensp; &ensp; - Google Maps API for business location    
&ensp; &ensp; &ensp; &ensp; - A page to Book, Edit, or Cancel any member's reservations using JavaScript functions and AJAX (member access only; admins cannot reserve a tee time)    
&ensp; &ensp; &ensp; &ensp; - A page to dynamically search for member's reservations and financial transactions using a JavaScript function with AJAX (admin access only via PHP sessions)    
&ensp; &ensp; &ensp; &ensp; - And much more... 
<br><br>

-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

In order to run this locally, you can use XAMPP (I used version OS X 8.0.28 for Mac, but Windows 8.0.30 should work just fine) 
<br>

Once downloaded and installed, find the location where the XAMPP folder was installed on your computer and navigate to the htdocs folder. There are 2 differenet ways of doing this:    
&ensp; &ensp; &ensp; &ensp; 1. Clicking on the htdocs alias    
&ensp; &ensp; &ensp; &ensp; 2. xamppfiles --> htdocs 
<br>

After navigating to the htdocs folder, unzip the LFC-Reservation-System file and drop it in there.
<br>

Then, simply open up XAMPP's application manager (OS x -> manager-osx.app, Windows -> xampp-control.exe). 
&ensp; &ensp; &ensp; &ensp; - For Mac users, you will have to enter in your computer's password in order to access the XAMPP Manager. 
<br>

After opening up the application manager, turn on Apache and MySQL servers:    
&ensp; &ensp; &ensp; &ensp; - OS x -> Click on the "Manage Servers" tab and start MySQL Database and Apache Web Server    
&ensp; &ensp; &ensp; &ensp; - Windows -> Simply click start next to the Apache and MySQL services 
<br>

Once these servers are up and running, type in "http://localhost/dashboard/" into your web browser and it will pull up XAMPP's dashboard for the version you are working with. 
<br>

Click on the "phpMyAdmin" tab and you will be brought to phpMyAdmin's localhost page where you can manage all of youer databases. 
<br>

Once on the page, click on the "User Accounts" tab at the top to create a new user account that grants you Data and Structure privelages. Create a username and password, and enter in localhost inside of the "Host Name" input field. 
<br>

In order to create a new database, click on "New" in the top-left side of your screen and enter in you database name (mine was named LFC_DB). 
<br>

After creating your new database, click on the "SQL" tab at the top of the page and copy and paste the following SQL statements to create all the necessary tables and relationships. After pasting, click "Go" located in the bottom-middle of the page to execute the SQL statements:
<br>

                CREATE TABLE `ADMINS` (
                    `ADMIN_ID` int(11) NOT NULL,
                    `USERNAME` varchar(50) NOT NULL,
                    `PASSWORD` varchar(100) NOT NULL,
                    `FIRST_NAME` varchar(50) NOT NULL,
                    `LAST_NAME` varchar(50) NOT NULL,
                    `PHONE_NUM` varchar(20) NOT NULL,
                    `EMAIL` varchar(100) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `FINANCIAL_TRANSACTIONS` (
                    `FINANCIAL_ID` int(11) NOT NULL,
                    `MEMBER_ID` int(11) NOT NULL,
                    `CUR_DATE` date NOT NULL,
                    `AMOUNT` varchar(20) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `MEMBERS` (
                    `MEMBER_ID` int(11) NOT NULL,
                    `USERNAME` varchar(50) NOT NULL,
                    `PASSWORD` varchar(100) NOT NULL,
                    `FIRST_NAME` varchar(50) NOT NULL,
                    `LAST_NAME` varchar(50) NOT NULL,
                    `PHONE_NUM` varchar(20) NOT NULL,
                    `EMAIL` varchar(100) NOT NULL,
                    `STATUS` enum('ACTIVE','DEACTIVATED') NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE `RESERVATIONS` (
                    `RESERVATION_ID` int(11) NOT NULL,
                    `MEMBER_ID` int(11) NOT NULL,
                    `CUR_DATE` date NOT NULL,
                    `TRANS_TYPE` enum('BOOK','EDIT','CANCEL') NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                ALTER TABLE `ADMINS`
                    ADD PRIMARY KEY (`ADMIN_ID`),
                    ADD UNIQUE KEY `UNIQUE_USER` (`USERNAME`),
                    ADD UNIQUE KEY `UNIQUE_PHONE` (`PHONE_NUM`),
                    ADD UNIQUE KEY `UNIQUE_EMAIL` (`EMAIL`);

                ALTER TABLE `FINANCIAL_TRANSACTIONS`
                    ADD PRIMARY KEY (`FINANCIAL_ID`),
                    ADD KEY `Financial_Transactions_FK` (`MEMBER_ID`);

                ALTER TABLE `MEMBERS`
                    ADD PRIMARY KEY (`MEMBER_ID`),
                    ADD UNIQUE KEY `UNIQUE_USER` (`USERNAME`),
                    ADD UNIQUE KEY `UNIQUE_PHONE` (`PHONE_NUM`),
                    ADD UNIQUE KEY `UNIQUE_EMAIL` (`EMAIL`);

                ALTER TABLE `RESERVATIONS`
                    ADD PRIMARY KEY (`RESERVATION_ID`),
                    ADD KEY `Reservation_FK` (`MEMBER_ID`);

                ALTER TABLE `FINANCIAL_TRANSACTIONS`
                    ADD CONSTRAINT `Financial_Transactions_FK` FOREIGN KEY (`MEMBER_ID`) REFERENCES `MEMBERS` (`MEMBER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

                ALTER TABLE `RESERVATIONS`
                    ADD CONSTRAINT `Reservation_FK` FOREIGN KEY (`MEMBER_ID`) REFERENCES `MEMBERS` (`MEMBER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION; 
<br>

After creating a user account, the database, tables, and relationships, you can then finally start using this website locally on your computer. In order to access the database from your computer, modify the dbFuncs.php file in this way:    
&ensp; &ensp; &ensp; &ensp; $host = "localhost";    
&ensp; &ensp; &ensp; &ensp; $db = "[your database name]";    
&ensp; &ensp; &ensp; &ensp; $user = "[you username]";    
&ensp; &ensp; &ensp; &ensp; $pwd = "[your password]"; 
<br>

If you want to access the admin pages, you have to manually enter in an admin row in the Admins table. If you want to access all of the member pages, then simply use the sign up page by clicking on the sign up tab. 
<br>

Everytime you sign up a new row will be inserted into the Members table with all the information you entered in (not all fields are required). 
<br>

The credit card input fields are just for show and have no actual functionality beyond validating each input field. It will not be inserted into the database whatsoever.
<br>

Admins can view all Member's reservations and financial transactions records via the dashboard. They can dynamically lookup any member's records by using their Member ID as the search key. 
<br>

Members can Book, Edit, or Cancel any of their reservations and view all of them on the Reservations page. They can also view their profile with the current information in the database (Username, Name, Phone Number, and Email). If they choose to do so, they can delete their account (in which several warnings will be diplayed to make sure the member knows what they're doing). On the member's side their account is deleted, however in the database their account is deactivated and cannot be accessed or modified unless an admin goes in and manually changes their account.