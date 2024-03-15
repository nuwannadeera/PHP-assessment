# PHP-assessment
 A pharmacy with the stakeholders involved are the owner, manager and cashier requires a system to streamline its business processes, involving authentication, medication inventory management, and customer record management. The system needs to enforce user roles and permissions for different actions. This is a system to reduce their workload and a more efficient system than manual processes.
 
 **ER diagram**
  
  https://drive.google.com/file/d/1VLFVy9L5Dz6-uIF0yaLlfZIc7fymbikT/view?usp=sharing
 
 
  **Postman API collection link**
  
  https://www.postman.com/science-astronaut-83434735/workspace/laravel-projectendpoints/collection/28943578-6e895dc5-5392-4dec-a513-8cf199081592?action=share&creator=28943578
  
  
   
**Softwares that want to install**

###### _Mysql_   
MySQL is a popular relational database management system (RDBMS) that integrates seamlessly with Laravel, allowing you to define models and interact with the database    
###### _Xampp_
XAMPP provides a straightforward and quick way to set up a local server environment with the necessary components for running Laravel applications
###### _Composer_
Laravel uses Composer for dependency management. Make sure you have Composer installed on your system.
###### _PHP_
It also requires PHP. Make sure you have PHP installed on your system.


**How to run project locally**

After Installing above software and libraries,
Clone the repository using 
**`git clone <repository-url>`** 
with the actual URL of the GitHub repository

After that open the project using your own IDE and open the terminal in IDE to  install the project dependencies
`composer install`

After installing dependencies you have to Open the `.env file` and configure the database settings (database name, username, password).

After setup the database in mysql according to the .env file you have to run the database migrations to create tables:
`php artisan migrate`

Now you have setup the database configurations.then you can run the project in your local system
by using the following command to start the development server:

`php artisan serve`

open your browser (Chrome) and the application should be accessible at `http://localhost:8000` by default.











