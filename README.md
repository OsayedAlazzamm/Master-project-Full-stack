# 🍽️ TasteHub - Online Restaurant Menu (Laravel 12 + Bootstrap)

A simple Laravel web app where users can browse restaurants, view meals, add them to cart, and place orders.  
Admins can manage restaurants and meals from a dashboard.

---

## ⚙️ Installation Guide

### 1️⃣ Clone the Repository
git clone https://github.com/OsayedAlazzamm/Master-project-Full-stack.git<br>
cd orders-app<br>

### 2️⃣ Install Dependencies
composer install<br>
npm install<br>
npm run build<br>

### 3️⃣ Configure Environment
cp .env.example .env<br>
php artisan key:generate<br>

Edit the .env file and update your database connection:<br>

DB_DATABASE=orders_app<br>
DB_USERNAME=root<br>
DB_PASSWORD=<br>

🗃️ Import Database

1.Open phpMyAdmin (or any MySQL tool).<br>
2.Create a new database named orders_app.<br>
3.Import the SQL file located at: database/orders_app.sql <br>

🖼️ Storage & Images<br>

Run this command to link storage for images:<br>
php artisan storage:link<br>

Uploaded images are stored in:<br>
storage/app/public/logos<br>
storage/app/public/meals<br>

🚀 Run the Project:<br>
php artisan serve


