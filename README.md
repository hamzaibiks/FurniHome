#  FurniHome - E-Commerce Platform

A fully functional, modern furniture e-commerce web application. Designed with an intuitive UI/UX to maximize customer conversion, seamless navigation, and an optimized product catalog.


###  Features
* **Dynamic Product Catalog:** Browse and manage furniture listings smoothly.
* **Responsive UI/UX:** Built to look great on all devices.
* **Secure Backend Architecture:** Powered by Laravel's robust routing and MVC structure.
* **Relational Database:** Efficiently manages user data, products, and transactions.

###  Tech Stack
* **Backend:** Laravel (PHP)
* **Frontend:** HTML5, CSS3, JavaScript
* **Database:** MySQL
* **Environment:** XAMPP, VS Code

###  Local Setup Instructions
If you want to run this code on your local machine:
1. Clone this repository: `git clone https://github.com/hamzaibiks/FurniHome.git`
2. Navigate to the folder: `cd FurniHome`
3. Install dependencies: `composer install` and `npm install`
4. Copy the environment file: `cp .env.example .env`
5. Generate an app key: `php artisan key:generate`
6. Import the `furnihome_db.sql` file into your local MySQL server (via phpMyAdmin).
7. Update the `.env` file with your database credentials.
8. Run the local server: `php artisan serve`
