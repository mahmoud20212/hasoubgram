# Hasoubgram

## Short Description
Hasoubgram is a social media web app built with Laravel where users can create posts, interact through likes and comments, follow other users, and explore content from the community.

## Technologies
- PHP 8.2
- Laravel 12
- Livewire 4
- Wire Elements Modal
- MySQL (or any Laravel-supported SQL database)
- Tailwind CSS
- Vite
- Alpine.js
- Intervention Image

## Features
- Authentication and user profiles
- Create, edit, and delete posts
- Upload and handle post images
- Add comments to posts
- Like and unlike posts
- Follow and unfollow users
- User profile pages by username slug
- Explore page for discovering posts
- Notifications for social interactions
- Language switching (Arabic/English)

## The Process
The project follows a standard Laravel monolith workflow:

1. Define routes and middleware in `routes/web.php`.
2. Handle business logic in controllers and Livewire components.
3. Store data using Eloquent models and database migrations.
4. Render UI with Blade + Tailwind, enhanced with Livewire/Alpine.
5. Process interactions (likes, comments, follows, notifications) through dedicated controllers, policies, and notifications.
6. Build frontend assets with Vite.

## Running the Project

### Prerequisites
- PHP 8.2+
- Composer
- Node.js + npm
- Database server (for example MySQL)

### Setup
1. Clone the repository.
2. Install backend dependencies:
	```bash
	composer install
	```
3. Create environment file:
	```bash
	copy .env.example .env
	```
4. Generate app key:
	```bash
	php artisan key:generate
	```
5. Configure database credentials in `.env`.
6. Run migrations:
	```bash
	php artisan migrate
	```
7. Install frontend dependencies:
	```bash
	npm install
	```

### Start Development
Run backend and frontend in separate terminals:

```bash
php artisan serve
```

```bash
npm run dev
```

You can also use the combined Composer command:

```bash
composer run dev
```

Then open the app at:

`http://127.0.0.1:8000`
