# Task Management API

A RESTful Task Management API built using Laravel and structured with a Clean Architecture approach.

This project is part of my Backend Engineer preparation journey (March – May 2026) and focuses on building production-ready backend systems.

---

## 🚀 Features

- Create, update, delete tasks
- Task status management (todo, in_progress, done)
- Project-task relationship
- Filtering & searching
- Pagination
- Standardized JSON response structure
- Form request validation
- Global exception handling
- Clean architecture structure (Controller → Service → Repository)

---

## 🛠 Tech Stack

- PHP 8+
- Laravel
- MySQL
- Eloquent ORM
- REST API
- Git

---

## 📦 API Response Format

All responses follow this standardized structure:

Success response:

{
  "success": true,
  "message": "Task retrieved successfully",
  "data": {...}
}

Error response:

{
  "success": false,
  "message": "Validation error",
  "errors": {...}
}

---

## 📚 API Endpoints

| Method | Endpoint        | Description            |
|--------|-----------------|------------------------|
| GET    | /api/tasks      | Get all tasks          |
| POST   | /api/tasks      | Create new task        |
| GET    | /api/tasks/{id} | Get task detail        |
| PUT    | /api/tasks/{id} | Update task            |
| DELETE | /api/tasks/{id} | Delete task            |

---

## ⚙️ Installation

1. Clone repository
2. Run composer install
3. Copy .env.example to .env
4. Configure database
5. Run php artisan migrate
6. Run php artisan serve

---

## 🧠 Architecture Approach

This project follows a layered architecture:

- Controller → Handles HTTP request/response
- Service → Contains business logic
- Repository → Handles database operations
- Resource → Transforms API responses

The goal is to maintain separation of concerns and scalability.

---

## 🧪 Future Improvements

- Authentication with Laravel Sanctum
- Role-based access control
- Feature testing with PHPUnit
- Deployment to production server