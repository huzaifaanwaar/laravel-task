# Laravel Task Management System

A comprehensive Laravel application featuring user authentication, post management, activity logging, and API endpoints with token-based authentication.

## Features
- **Authentication System**: Complete user registration, login, and logout functionality
- **Post Management**: Create and manage posts with validation
- **Activity Logging**: Automatic tracking of user actions with event-driven system
- **API Endpoints**: RESTful API with Laravel Sanctum authentication
- **Middleware Protection**: Custom middleware for route protection
- **Responsive UI**: Bootstrap 5 with modern, clean design
- **Queue System**: Asynchronous processing for better performance

## Requirements
- PHP 8.2 or higher
- Composer
- Node.js & NPM (for frontend assets)
- SQLite (default) or MySQL/PostgreSQL

## Installation
1. **Clone the repository**
   ```bash
   git clone https://github.com/huzaifaanwaar/laravel-task.git
   cd laravel-task
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate --seed
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

The application will be available at `http://127.0.0.1:8000`

## Default User Account
After running the seeder, you can log in with:
- **Email**: `admin@admin.com`
- **Password**: `password123`

## Project Structure
### Models & Relationships
- **User**: Has many Posts and ActivityLogs
- **Post**: Belongs to User (user_id, title, body)
- **ActivityLog**: Belongs to User (user_id, description, ip_address, user_agent)

### Key Features
#### Authentication
- User registration with strong password validation
- Login/logout functionality
- Automatic API token generation on login/registration
- Token revocation on logout

#### Post Management
- Create posts with title (max 100 chars) and body (min 10 chars)
- Form validation with custom error messages
- Activity logging for post creation

#### Activity Logging
- Event-driven system using Laravel events and listeners
- Queued listeners for better performance
- Tracks user actions: registration, login, post creation
- Stores IP address and user agent information

#### API Endpoints
- `GET /api/user/activities` - Get authenticated user's activity logs
- Protected with Laravel Sanctum
- Returns paginated JSON response with metadata

#### Middleware
- `EnsureUserHasPosts` - Redirects users without posts to create their first post
- Applied to `/stats` route

## API Usage
### Authentication
All API endpoints require authentication using Bearer tokens. Tokens are automatically created when users log in or register.

### Example API Request
```bash
curl -H "Authorization: Bearer {your-token}" \
     -H "Accept: application/json" \
     http://localhost:8000/api/user/activities
```

### API Response Format
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "description": "User logged in successfully",
      "ip_address": "127.0.0.1",
      "user_agent": "Mozilla/5.0...",
      "created_at": "2025-09-02T12:00:00.000000Z",
      "updated_at": "2025-09-02T12:00:00.000000Z"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 15,
    "total": 1,
    "from": 1,
    "to": 1
  },
  "meta": {
    "user_id": 1,
    "user_name": "John Doe",
    "total_activities": 1
  }
}
```

## Routes
### Web Routes
- `GET /` - Redirects to dashboard
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Registration form
- `POST /register` - Process registration
- `GET /dashboard` - User dashboard with activity logs
- `GET /posts/create` - Create post form
- `POST /posts` - Store new post
- `GET /stats` - Statistics page (requires posts)
- `POST /logout` - Logout user

### API Routes
- `GET /api/user` - Get authenticated user info
- `GET /api/user/activities` - Get user's activity logs

## Queue Processing
The application uses queues for activity logging. Start the queue worker:
```bash
php artisan queue:work
```

## Technologies Used
- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: Bootstrap 5, Bootstrap Icons
- **Database**: SQLite (default)
- **Authentication**: Laravel Sanctum
- **Queue**: Database driver

## Development
### Code Quality
- Follows Laravel conventions and best practices
- Uses Form Requests for validation
- Implements proper Eloquent relationships
- Event-driven architecture for activity logging
- Comprehensive test coverage

### Key Components
- **Controllers**: AuthController, PostController, StatsController, UserActivityController
- **Models**: User, Post, ActivityLog
- **Events**: UserActionOccurred
- **Listeners**: StoreUserActivity, StoreLoginActivity
- **Middleware**: EnsureUserHasPosts
- **Form Requests**: LoginRequest, RegisterRequest, StorePostRequest

## License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).