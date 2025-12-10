# Installation Guide

## Prerequisites

Before installing the Modern PHP Admin Dashboard, ensure you have:

- **PHP 7.4+** with extensions: PDO, MySQL, mbstring, JSON
- **MySQL 5.7+** or MariaDB 10.2+
- **Composer** (PHP dependency manager)
- **Node.js 14+** and NPM
- **Apache 2.4+** with mod_rewrite enabled
- **Git** (optional, for cloning)

## Step-by-Step Installation

### 1. Download/Clone the Project

**Option A: Clone from Git**
```bash
git clone https://github.com/yourusername/modern-admin-dashboard.git
cd modern-admin-dashboard
```

**Option B: Download ZIP**
- Download and extract the ZIP file
- Navigate to the extracted directory

### 2. Install PHP Dependencies

```bash
composer install
```

If you encounter memory issues:
```bash
php -d memory_limit=-1 /path/to/composer.phar install
```

### 3. Install Node.js Dependencies

```bash
npm install
```

### 4. Environment Configuration

Copy the environment template:
```bash
cp .env.example .env
```

Edit `.env` with your settings:
```env
# Application
APP_NAME="Modern Admin Dashboard"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=todays-task
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Security (CHANGE THESE!)
JWT_SECRET=your-random-secret-key-here
```

**Important:** Generate a secure JWT secret:
```bash
php -r "echo bin2hex(random_bytes(32));"
```

### 5. Create Database

Create a new MySQL database:
```sql
CREATE DATABASE `todays-task` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Run Migrations

Execute the migration script:
```bash
php database/migrate.php
```

You should see:
```
Running migrations...
Creating users table... Done!
Creating activity_logs table... Done!
Creating notifications table... Done!
Creating default super admin... Done!
✅ All migrations completed successfully!
```

### 7. Compile Assets

**For Development:**
```bash
npm run scss
```

**For Production:**
```bash
npm run scss:build
```

This compiles SCSS to CSS in `public/css/app.css`.

### 8. Set Permissions

Ensure proper file permissions:

**Linux/Mac:**
```bash
chmod -R 755 .
chmod -R 775 storage
chmod 644 .env
```

**Windows:**
- Right-click project folder → Properties → Security
- Ensure IIS_IUSRS or IUSR has read/write permissions on `storage` folder

### 9. Configure Web Server

#### Apache Configuration

**Option A: Virtual Host (Recommended)**

Create a new virtual host file:
```apache
<VirtualHost *:80>
    ServerName admin.local
    ServerAlias www.admin.local
    DocumentRoot "C:/path/to/project-admin"
    
    <Directory "C:/path/to/project-admin">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog "logs/admin-error.log"
    CustomLog "logs/admin-access.log" common
</VirtualHost>
```

Add to your hosts file (`C:\Windows\System32\drivers\etc\hosts` on Windows):
```
127.0.0.1 admin.local
```

Restart Apache:
```bash
# Windows
httpd -k restart

# Linux
sudo service apache2 restart
```

**Option B: XAMPP/WAMP**

1. Place project in `htdocs` or `www` folder
2. Access via `http://localhost/project-admin`

#### Nginx Configuration (Alternative)

```nginx
server {
    listen 80;
    server_name admin.local;
    root /path/to/project-admin;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 10. Access the Application

Navigate to your configured URL:
- Virtual Host: `http://admin.local`
- Direct: `http://localhost/project-admin`

### 11. First Login

Use the default credentials:
- **Email:** admin@admin.com
- **Password:** admin123

**⚠️ CRITICAL:** Change the default password immediately!

## Post-Installation

### Security Checklist

- [ ] Change default admin password
- [ ] Update JWT_SECRET in `.env`
- [ ] Set APP_DEBUG=false in production
- [ ] Enable HTTPS (SSL certificate)
- [ ] Configure firewall rules
- [ ] Set up regular database backups
- [ ] Review file permissions

### Optional Enhancements

**Enable HTTPS:**
```apache
# Uncomment in .htaccess
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

**Set up Cron Jobs (for scheduled tasks):**
```bash
# Add to crontab
* * * * * php /path/to/project/cron.php
```

## Troubleshooting

### Issue: "500 Internal Server Error"

**Solution:**
1. Check Apache error logs
2. Ensure `.htaccess` is being read (AllowOverride All)
3. Verify mod_rewrite is enabled:
   ```bash
   a2enmod rewrite
   sudo service apache2 restart
   ```

### Issue: "Database connection failed"

**Solution:**
1. Verify database credentials in `.env`
2. Ensure MySQL service is running
3. Check database exists:
   ```sql
   SHOW DATABASES;
   ```

### Issue: "Composer dependencies not found"

**Solution:**
```bash
composer dump-autoload
```

### Issue: "CSS not loading"

**Solution:**
1. Compile SCSS:
   ```bash
   npm run scss:build
   ```
2. Check `public/css/app.css` exists
3. Clear browser cache

### Issue: "Permission denied" errors

**Solution:**
```bash
# Linux/Mac
sudo chown -R www-data:www-data .
chmod -R 755 .
chmod -R 775 storage

# Windows
# Run as Administrator and set IIS_IUSRS permissions
```

## Updating

To update the application:

```bash
# Pull latest changes
git pull origin main

# Update dependencies
composer update
npm update

# Recompile assets
npm run scss:build

# Run new migrations (if any)
php database/migrate.php
```

## Support

For issues or questions:
- Check the [README.md](README.md)
- Open an issue on GitHub
- Email: support@example.com

---

**Congratulations! Your Modern PHP Admin Dashboard is now installed and ready to use! 🎉**
