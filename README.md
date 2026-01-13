# 🛡️ Modern PHP Admin Dashboard

A robust, secure, and aesthetically futuristic Admin Dashboard built with vanilla PHP, modern SCSS, and MySQL. This project demonstrates a structured MVC architecture, secure authentication, and a responsive "Glassmorphism" UI design.

![Dashboard Preview](https://via.placeholder.com/800x400?text=Dashboard+Preview)
_(Note: Replace with actual screenshot)_

## ✨ Features

### 🔐 Security & Authentication

- **Secure Login System**: Built with modern password hashing (Bcrypt) and session management.
- **CSRF Protection**: Integrated Cross-Site Request Forgery protection on all forms.
- **Validation**: Strict server-side input validation using `Respect/Validation`.
- **Authorization**: Role-based access control (Admin/User).

### 🎨 UI/UX Design

- **Futuristic Theme**: Custom Dark Gradient composed of linear gradients and neon accents.
- **Glassmorphism**: Frosted glass effects on cards, tables, and sidebars using backdrop-filter.
- **Responsive Layout**: Mobile-first grid system that adapts to all screen sizes.
- **Micro-animations**: Smooth transitions, hover effects, and loading states.

### 🛠️ Functionalities

- **User Management**: Create, Read, Update, Delete (CRUD) users with specific roles.
- **Dashboard Analytics**: Real-time overview of key metrics (Users, Activity, etc.).
- **Activity Logging**: Tracks key actions (Login, User Creation) for auditing.
- **Routing System**: Custom `router.php` for clean URLs without requiring heavy servers.

## 🏗️ Tech Stack

- **Backend**: PHP 8.0+
- **Frontend**: HTML5, SCSS (Sass), JavaScript (Vanilla)
- **Database**: MySQL 8.0
- **Dependencies**:
  - `vlucas/phpdotenv` (Environment Config)
  - `respect/validation` (Data Validation)
  - `symfony/var-dumper` (Debugging)
- **Tooling**: Composer, Sass

## 📂 Project Structure

```
project-admin/
├── assets/             # Raw assets (SCSS, JS)
├── config/             # Configuration (DB, Environment)
├── public/             # Publicly accessible files (Compiled CSS, Images)
├── src/                # Application Source Code
│   ├── Controllers/    # MVC Controllers
│   ├── Models/         # Database Models
│   ├── Helpers/        # Helper functions
│   └── Middleware/     # Auth & CSRF Middleware
├── views/              # PHP View Templates
│   ├── auth/           # Login/Register views
│   ├── dashboard/      # Dashboard views
│   └── users/          # User Management views
├── database/           # Migration and Setup scripts
└── index.php           # Entry point (Router)
```

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.0
- Composer
- MySQL

### Installation

1.  **Clone the repository**

    ```bash
    git clone https://github.com/yourusername/project-admin.git
    cd project-admin
    ```

2.  **Install Dependencies**

    ```bash
    composer install
    ```

3.  **Environment Setup**
    Copy `.env.example` to `.env` and update your database credentials:

    ```bash
    cp .env.example .env
    ```

    _Update `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` in `.env`._

4.  **Database Setup**
    Run the included setup script to create the database and tables:

    ```bash
    php setup.php
    ```

5.  **Compile Assets (Optional)**
    If you modified SCSS, run:
    ```bash
    sass assets/scss/main.scss public/css/app.css
    ```

### 🏃 Running the Application

Start the built-in development server:

```bash
php -S localhost:8000 router.php
```

Visit `http://localhost:8000` in your browser...!

### 🔑 Default Credentials

- **Email**: `admin@admin.com`
- **Password**: `admin123`

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
