<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

---

# Event Registration System

## About This Project

This project is a **Laravel-based Event Registration System** developed as part of a **technical assessment**.

It demonstrates real-world backend and frontend concepts using Laravel, including authentication, CRUD operations, scheduling, and data export.

---

## Features

### Public Features
- View upcoming events
- View event details (date, location, description, price)
- See remaining capacity in real time
- Register for events
- Prevent overbooking
- Display fully booked events

### Admin Features
- Secure admin authentication
- Create, edit, and delete events
- View event registrations per event
- Cancel registrations
- Export registrations as CSV
- Auto-mark past events as **completed**

---

## Tech Stack

- **Laravel**
- **PHP**
- **SQLite / MySQL**
- **Blade Templates**
- **Tailwind CSS**
- **Laravel Breeze (Authentication)**

---

## Installation & Setup

### 1. Clone the Repository
- git clone https://github.com/MahdYassien/event-registration-system
- cd event-registration

### 2. Install Dependencies
- composer install
- npm install
- npm run build

### 3. Environment Setup
- cp .env.example .env
- php artisan key:generate

### 4. Database Migration
- php artisan migrate

### 5. Run the Application
- php artisan serve
- The app will be available at:
http://127.0.0.1:8000

---

## Admin Access
- Login page: /login
- Admin dashboard: /admin/events
- Admin routes are protected using authentication middleware

---

## Scheduled Tasks (Auto-Complete Past Events)
 The application includes a custom Artisan command that automatically updates past events to completed.
- php artisan events:complete-past
- Scheduled via Laravel Scheduler
- This command is configured to run automatically using Laravel’s scheduling system.

---

## CSV Export
Admins can export event registrations as a CSV file, including:
- Attendee name
- Email
- Status
- Registration date
**This demonstrates practical reporting functionality.**

---

## Project Structure Overview
app/
 ├── Console/Commands
 ├── Http/Controllers
 │   ├── Admin
 │   └── Public
 ├── Models
routes/
 └── web.php
resources/
 └── views
database/
 └── migrations

---

## Assessment Notes
This project was completed as part of a time-bound assessment, with emphasis on:
- Clean MVC architecture
- Laravel best practices
- Realistic feature implementation
- Git version control
- Clear separation of public and admin functionality

---

## Submission
Repository URL:
https://github.com/MahdYassien/event-registration-system

**How to Run:**
- Clone repository
- Install dependencies
- Configure .env
- Run migrations
- Serve the application

---

## Admin Credentials:
Use the registration page to create an admin account, then log in via /login.

---

## License
This project is built using the Laravel framework, which is open-sourced software licensed under the MIT license.