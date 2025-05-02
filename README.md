# Soil Testing & Fertilizer Recommendation System

A full-stack PHP application for soil testing and fertilizer recommendations.

## Features

- User authentication (login/register)
- Soil test management
- Fertilizer recommendations
- Dashboard for monitoring soil health
- Mobile-responsive design

## Requirements

- XAMPP (PHP 7.4 or higher)
- MySQL 5.7 or higher
- Apache web server

## Quick Setup with XAMPP

1. Make sure XAMPP is installed and running (Apache and MySQL services)

2. Place the project files in your XAMPP htdocs folder:
   - Copy all files to `C:\xampp\htdocs\soil` (or your preferred directory)

3. Run the setup script:
   - Open your web browser
   - Navigate to `http://localhost/soil/setup.php`
   - This will automatically:
     - Create the database
     - Create all necessary tables
     - Create a test user (email: test@example.com, password: test123)

4. Access the application:
   - Open your web browser
   - Navigate to `http://localhost/soil`
   - Login with the test credentials or register a new account

## Manual Setup (Alternative)

If you prefer to set up manually:

1. Create a MySQL database named `soil_testing`
2. Import the database schema from `database.sql`
3. Update database credentials in `config/database.php` if needed

## Directory Structure

```
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── auth/
│   ├── login.php
│   ├── register.php
│   └── logout.php
├── config/
│   └── database.php
├── includes/
│   └── functions.php
├── index.php
├── dashboard.php
├── setup.php
└── database.sql
```

## Security Considerations

- All passwords are hashed using PHP's password_hash() function
- Input sanitization is implemented for all user inputs
- Session management is used for authentication
- SQL injection prevention using prepared statements

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details. 