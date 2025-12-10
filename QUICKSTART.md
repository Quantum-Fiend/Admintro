# Quick Start Guide

## Prerequisites Check

Before starting, ensure you have:
- ✅ PHP 7.4+ installed
- ✅ MySQL 5.7+ running
- ✅ Composer installed
- ✅ Node.js 14+ and NPM installed
- ✅ Apache with mod_rewrite enabled

## Installation (5 Minutes)

### 1. Install Dependencies (2 min)

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 2. Configure Environment (1 min)

```bash
# Copy environment file
cp .env.example .env
```

Edit `.env` and set your database credentials:
```env
DB_DATABASE=todays-task
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 3. Setup Database (1 min)

```bash
# Create database
mysql -u root -p -e "CREATE DATABASE \`todays-task\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Run migrations
php database/migrate.php
```

### 4. Compile Assets (1 min)

```bash
# Compile SCSS to CSS
npm run scss:build
```

### 5. Access Application

Navigate to: `http://localhost/project-admin`

**Login with:**
- Email: `admin@admin.com`
- Password: `admin123`

**⚠️ IMPORTANT:** Change the default password immediately!

---

## Common Commands

```bash
# Development - Watch SCSS changes
npm run scss

# Production - Compile and minify
npm run scss:build

# Update dependencies
composer update
npm update

# Run migrations
php database/migrate.php
```

---

## Troubleshooting

**Issue:** CSS not loading
```bash
npm run scss:build
# Clear browser cache
```

**Issue:** Database connection failed
- Check `.env` database credentials
- Ensure MySQL is running
- Verify database exists

**Issue:** 500 Internal Server Error
- Check Apache error logs
- Ensure mod_rewrite is enabled
- Verify `.htaccess` is being read

---

## Next Steps

1. Change default admin password
2. Create additional users
3. Explore the dashboard
4. Customize colors in `assets/scss/_variables.scss`
5. Read full documentation in `README.md`

---

**Need Help?** Check `INSTALLATION.md` for detailed instructions.
