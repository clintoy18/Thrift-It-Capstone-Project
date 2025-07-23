# Thrift-It Capstone Project

## Project Description
Thrift-It is a web application for booking and managing upcycling appointments, product listings, and user interactions. The platform connects users with upcyclers, allowing for appointment scheduling, product management, reviews, chat, and more.

## Features
- User authentication and roles (user, upcycler, admin)
- Product listing and management
- Appointment booking and management
- Upcycler dashboard and appointment status updates
- Review and comment system
- Admin dashboard and reporting
- Email notifications for appointment status changes
- Real-time private chat system between users
- Service-Repository pattern for clean, maintainable code

## Tech Stack
- **Backend:** Laravel (PHP)
- **Frontend:** Blade, Tailwind CSS
- **Database:** MySQL (or compatible)
- **Mail:** Laravel Mailables

## Project Structure
- `app/Models/` — Eloquent models
- `app/Http/Controllers/` — Controllers (now thin, using services)
- `app/Services/` — Business logic (Service layer)
- `app/Repositories/` — Data access (Repository layer)
- `resources/views/` — Blade templates
- `routes/` — Route definitions

## Service-Repository Pattern
This project is refactored to use the Service-Repository pattern:
- **Controllers** handle HTTP requests and responses only.
- **Services** contain business logic and call repositories.
- **Repositories** handle all data access (CRUD, queries).

## Setup Instructions
1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd Thrift-It-Capstone-Project
   ```
2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run dev
   ```
3. **Copy and configure environment:**
   ```bash
   cp .env.example .env
   # Edit .env with your DB and mail settings
   php artisan key:generate
   ```
4. **Run migrations:**
   ```bash
   php artisan migrate
   ```
5. **(Optional) Seed the database:**
   ```bash
   php artisan db:seed
   ```
6. **Start the server:**
   ```bash
   php artisan serve
   ```

## Usage
- Register as a user or upcycler
- Book and manage appointments
- Upcyclers can update appointment statuses (triggers email notifications)
- Admins can manage users, products, and reports
- Users can send and receive private messages in real time

## Contribution
Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](LICENSE)
