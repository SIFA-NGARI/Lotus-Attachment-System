# lotus attachment system
Optimizing University Attachments using a Web-Based System for Streamlined Document Collection and Planning


### project description
The process of planning and documentation of student attachments in universities can be a time-consuming and challenging task. The evaluation procedure involves site visits and manual submissions of document reports. Planning site visits poses logistical difficulties due to ineffective communication. In addition, the submission of hardcopy reports leads to long-term environmental degradation. This project aims to alleviate these problems by developing an attachment system to automate the process. The proposed approach is designed to address gaps in existing solutions by offering novel features, such as a platform for the online documentation of weekly logs and reports, synchronized planning, and communication between the faculty supervisor and the student using a coordinated calendar and chatting module, among other features.

## features
### i.	**authentication module**
this module is a security plug-in that will be used to verify the user profiles that exist in the system against entries in the database. 

### ii. **logbook module**
this module provides features for the documentation of weekly logs that entail the activities carried out by the student during the attachment period.

### iii.  **attachment initialization module**
This module is necessary for attachment application and allocation. 

### iv.	**attachment report collection module** 
This module supports the submission of pdf attachments by the student user.  

###	v.  **chat module** 
This module provides a platform for communication between the student and supervisor users. 

### vi.	**grading module**
The grading module oversees displaying the final grade of the student user. This will be achieved through automatic calculations by the system based on assigned marks and assessment weights.

### vii.  **admin module**
this module will be used for an overall view of the entire system by a super administrator. 

### viii.	**calendar** 
This module will integrate the Google Calendar API. This will improve the efficiency of planning for events such as site visits. 

### ix.	**maps** 
This module will integrate the Google Maps API. This module will aim to improve the site visit experience for the supervisor user as they locate the student users for on-site visits and assessments. 


## project dependencies 
* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

## Installation 
```
git clone https://github.com/SIFA-NGARI/Lotus-Attachment-System.git

cd my-project

composer install

npm install
```
## database configuration 
If you use MySQL, copy the file ".env.example", and change its name to ".env". Then in the file ".env" complete this database configuration:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
## next steps 
In your app directory, generate the Laravel APP_KEY, run the database migrations, and seed. Complete by running the npm run dev command is used to run the corresponding script from the scripts section of your package .json file
```
php artisan key:generate

php artisan migrate:refresh --seed

npm run dev
```
## usage 
start the local server using the following command
```
php artisan serve
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



