🚀 Laravel E-commerce Website
Welcome to this fully functional e-commerce platform built with the Laravel framework. This project includes a comprehensive set of features for both customers and administrators, providing a complete online shopping experience from product browsing to order management.

✨ Key Features
Customer Frontend: A beautiful and responsive storefront for customers to browse products, add items to their cart, and complete checkout.

User Authentication: Secure registration and login for both customers and administrators.

Admin Panel: A powerful dashboard for administrators to manage products, view orders, and oversee user accounts.

Shopping Cart: Persistent shopping cart functionality.

Database Seeding: Pre-populated with sample data for immediate testing.

🌐 Live Demo
You can view a live demo of the application here:
eshop.as-storitve.si

🔑 Login Credentials
Use the following credentials to explore the different roles within the application.

User Account
Email: user@gmail.com

Password: password

Administrator Account
Email: admin@gmail.com

Password: password

🛠️ Installation Guide
Follow these steps to get the project up and running on your local machine.

## 1. Clone the Repository
First, clone this repository to your local machine using Git.

git clone https://github.com/anze25/eshop.git
cd eshop

## 2. Install Dependencies
Install the required PHP dependencies using Composer.

composer install

## 3. Create Environment File
Copy the .env.example file to create your local environment configuration.

cp .env.example .env

## 4. Generate Application Key
Generate a unique application key.

php artisan key:generate

## 5. Configure Your .env File
Open the .env file and update your database credentials. This is a mandatory step.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

Remember to also configure your mail driver and other settings as needed.

## 6. Run Migrations & Seed the Database
Execute the database migrations and seeders to create the schema and populate it with initial data.

php artisan migrate --seed

Alternatively, you can run them separately:

# Run migrations first
php artisan migrate

# Then run the seeders
php artisan db:seed

## 7. Install Frontend Dependencies
Install the necessary Node.js dependencies.

npm install

## 8. Compile Frontend Assets
Compile the JavaScript and CSS assets.

npm run dev

## 9. Serve the Application
Finally, start the local development server.

php artisan serve

Your Laravel e-commerce site is now running at http://127.0.0.1:8000.

💻 Technologies Used
Backend: Laravel, PHP

Frontend: Blade, JavaScript, CSS

Database: MySQL (or other configured SQL database)

📄 License
This project is open-source and available under the MIT License.