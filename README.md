# 🚀 Laravel E-commerce Website

Welcome to this fully functional e-commerce platform built with the **Laravel** framework. This project includes a comprehensive set of features for both customers and administrators, providing a complete online shopping experience—from product browsing to order management.

---

## ✨ Key Features

- **Customer Frontend**: Beautiful and responsive storefront for browsing products, adding items to cart, and completing checkout.
- **User Authentication**: Secure registration and login for both customers and administrators.
- **Admin Panel**: Powerful dashboard for managing products, viewing orders, and overseeing user accounts.
- **Shopping Cart**: Persistent cart functionality for a seamless shopping experience.
- **Database Seeding**: Pre-populated with sample data for immediate testing.

---

## 📸 Screenshot

![Screenshot](https://github.com/anze25/eshop/blob/e1d1a64ba4aeab91654d74c9bb5ff3c12ef8e19a/Screenshot.jpg)

---

## 🌐 Live Demo

Check out the live demo here:  
🔗 [eshop.as-storitve.si](http://eshop.as-storitve.si)

---

## 🔑 Login Credentials

Explore the app using these demo accounts:

### 👤 User Account
- **Email**: `user@gmail.com`  
- **Password**: `password`

### 🛡️ Administrator Account
- **Email**: `admin@gmail.com`  
- **Password**: `password`

---

## 🛠️ Installation Guide

Follow these steps to set up the project locally:

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/your-repository-name.git
cd your-repository-name

```
### 2. Install PHP Dependencies
```bash
composer install

### 3. Create Environment File
```bash
cp .env.example .env
```
### 4. Generate Application Key
```bash
php artisan key:generate
```
### 5. Configure .env File
```Env
Update your database credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```
### 6. Run Migrations & Seed Database
```bash
php artisan migrate
php artisan db:seed
```
### 7. Install Frontend Dependencies
```bash
npm install
```
### 8. Compile Frontend Assets
```bash
npm run dev
```
### 9. Serve the Application
```bash
php artisan serve
```
Your site will be available at: 🌐 http://127.0.0.1:8000

💻 Technologies Used

Layer	Technologies
Backend	Laravel, PHP
Frontend	Blade, JavaScript, CSS
Database	MySQL (or other SQL)

📄 License
This project is open-source and available under the MIT License.



