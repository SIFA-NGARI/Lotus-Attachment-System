# Project Title
Optimizing University Attachments using a Web-Based System for Streamlined Document Collection and Planning

## Project Description
The process of planning and documentation of student attachments in universities can be a time-consuming and challenging task. The evaluation procedure involves site visits and manual submissions of document reports. Planning site visits poses logistical difficulties due to ineffective communication. In addition, the submission of hardcopy reports leads to long-term environmental degradation. This project aims to alleviate these problems by developing an attachment system to automate the process. The proposed system is designed to address gaps in existing solutions by offering novel features, such as a platform for the online documentation of weekly logs and reports, synchronized planning, and communication between the faculty supervisor and the student using a coordinated calendar and chatting module, among other features.


## Features
### i.	**Authentication module**
this module is a security plug-in that will be used to verify the user profiles that exist in the system against entries in the database. 

### ii. **Logbook module**
this module provides features for the documentation of weekly logs that entail the activities carried out by the student during the attachment period.

### iii.  **Attachment initialization module**
This module is necessary for attachment application and allocation. 

### iv.	**Attachment report collection module** 
This module supports the submission of pdf attachments by the student user.  

###	v.  **Chat module** 
This module provides a platform for communication between the student user and the supervisor user. 

### vi.	**Grading module**
The grading module oversees displaying the final grade of the student user. This will be achieved through automatic calculations by the system based on assigned marks and assessment weights.

### vii.  **Admin module**
this module will be used for an overall view of the entire system by a super administrator. 

### viii.	**Calendar** 
This module will integrate the Google Calendar API. This will improve the efficiency of planning for events such as site visits. 

### ix.	**Maps** 
This module will integrate the Google Maps API. This module will aim to improve the site visit experience for the supervisor user as they locate the student users for on-site visits and assessments. 

# Project Dependancies 
### PHP >= 7.1.3
### OpenSSL PHP Extension
### PDO PHP Extension
### Mbstring PHP Extension
### Tokenizer PHP Extension
### XML PHP Extension
## Installation 
```
# clone the repo
$ git clone https://github.com/SIFA-NGARI/Lotus-Attachment-System.git

# Go into the app's directory
$ cd my-project

# install the app's dependencies
$ composer install

# install the app's dependencies
$ npm install
```
## Database Configuration 
If you choose to use MySQL, copy the file ".env.example", and change its name to ".env". Then in the file ".env" complete this database configuration:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
## Next Steps 
```
# in your app directory
# generate laravel APP_KEY
$ php artisan key:generate

# run database migration and seed
$ php artisan migrate:refresh --seed

# generate mixing
$ npm run dev
```
## Usage 
```
# start the local server
$ php artisan serve
```
Open your browser with the address: localhost:8000 
> Register a user under the email domain [@strathmore.edu](www.strathmore.edu) and verify the email before logging in

## Creators 
### Olive Menorah 
https://github.com/MenorahOlive

### Sifa Ngari 
https://github.com/SIFA-NGARI

## Copyright and Licenses 
copyright 2023 Lotus Attachments. Code released under Strathmore University.



