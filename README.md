# Knižnica - Library Management System

A comprehensive library management system built with Laravel that enables schools to manage their book collections, handle user loans, and provide a seamless experience for both administrators and students.

## 📚 Features

### User Management
- **User Authentication** - Secure login and registration system
- **Email Verification** - Verify user accounts via email
- **Password Reset** - Forgot password functionality
- **Role-Based Access** - Admin and regular user roles
- **User Profiles** - Manage personal information and view loan history
- **School & Classroom Integration** - Users are associated with schools and classrooms

### Book Management
- **CRUD Operations** - Create, read, update, and delete books
- **Soft Deletes** - Books can be soft-deleted and restored
- **Book Catalog** - Browse and search through available books
- **Book Details** - View comprehensive information including author, genre, language, description, and availability
- **Book Images** - Upload and display book cover images
- **Comments & Ratings** - Users can rate and comment on books

### Loan System
- **Book Reservations** - Users can reserve books for borrowing
- **Loan Approval** - Admin approval workflow for loan requests
- **User Confirmation** - Users must confirm receipt of reserved books
- **Loan Renewal** - Extend loan periods
- **Return Management** - Track and process book returns
- **Reservation Time Limits** - Automatic cancellation of expired reservations
- **Loan History** - View borrowing history for each user

### Administrative Features
- **Admin Dashboard** - Centralized management interface
- **User Management** - View, edit, and delete users
- **Book Management** - Manage entire book catalog
- **Loan Management** - Oversee all active and pending loans
- **Author Management** - Add and manage book authors
- **Genre Management** - Organize books by categories
- **Language Management** - Track books in different languages
- **School Management** - Manage schools in the system
- **Classroom Management** - Manage classrooms within schools
- **Reports** - Generate system reports (feature available)

### Additional Features
- **Advanced Search** - Search functionality across the book catalog
- **Responsive Design** - Built with TailwindCSS for modern UI
- **Email Notifications** - Account verification and notifications

## 🛠️ Technology Stack

- **Backend**: Laravel 8.x (PHP 7.3+/8.0+)
- **Frontend**: Blade Templates, TailwindCSS 2.x
- **Authentication**: Laravel Sanctum, Laravel UI
- **Database**: MySQL/PostgreSQL (via Eloquent ORM)
- **Build Tools**: Laravel Mix, NPM
- **Additional Packages**:
  - Guzzle HTTP client
  - Laravel CORS
  - Laravel Tinker

## 📋 Requirements

- PHP >= 7.3 or 8.0
- Composer
- Node.js & NPM
- MySQL or PostgreSQL
- Web Server (Apache/Nginx)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Kniznica
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   
   Edit `.env` file and set your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kniznica
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Configure Mail Settings**
   
   Set up email settings in `.env` for account verification:
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=your_smtp_host
   MAIL_PORT=587
   MAIL_USERNAME=your_email
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your_email
   MAIL_FROM_NAME="${APP_NAME}"
   ```

7. **Run Migrations**
   ```bash
   php artisan migrate
   ```

8. **Seed Database (Optional)**
   ```bash
   php artisan db:seed
   ```

9. **Build Frontend Assets**
   ```bash
   npm run dev
   # or for production
   npm run prod
   ```

10. **Start Development Server**
    ```bash
    php artisan serve
    ```

The application will be available at `http://localhost:8000`

## 📱 Usage

### For Regular Users
1. Register for an account
2. Verify your email address
3. Browse the book catalog
4. Reserve books for borrowing
5. Confirm receipt of reserved books
6. View your loan history and active loans
7. Rate and comment on books you've read

### For Administrators
1. Log in with admin credentials
2. Access the admin dashboard at `/adminHome`
3. Manage users, books, authors, genres, languages, schools, and classrooms
4. Approve or reject loan requests
5. Process book returns
6. View system reports

## 🗂️ Project Structure

```
app/
├── Http/Controllers/     # Application controllers
├── Models/              # Eloquent models
├── Policies/            # Authorization policies
└── Mail/                # Mail templates

database/
├── migrations/          # Database migrations
├── factories/           # Model factories
└── seeders/            # Database seeders

resources/
├── views/              # Blade templates
├── css/                # Stylesheets
└── js/                 # JavaScript files

routes/
├── web.php             # Web routes
└── api.php             # API routes
```

## 🔐 Default User Roles

The system supports two user types:
- **Admin** - Full access to all management features
- **User** - Access to book browsing, reservations, and personal dashboard

## 📝 Key Models

- **User** - System users (students, teachers, admins)
- **Book** - Book catalog entries
- **Author** - Book authors
- **Genre** - Book categories
- **Language** - Book languages
- **Loan** - Book borrowing records
- **Comment** - Book reviews and ratings
- **School** - Educational institutions
- **Classroom** - Class groups within schools

## 🧪 Testing

Run the test suite:
```bash
php artisan test
# or
./vendor/bin/phpunit
```

## 📊 Development

### Watch Mode
For automatic asset compilation during development:
```bash
npm run watch
# or for hot reload
npm run hot
```

### Code Style
The project follows Laravel coding standards and best practices.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
