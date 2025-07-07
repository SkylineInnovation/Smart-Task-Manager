# Smart Task Manager

A comprehensive **Enterprise Task Management System** built with Laravel 9, designed for enterprise-level project and employee management across multiple departments and branches.

## 🚀 Features

### 📋 Task Management
- **Hierarchical Structure**: Main tasks with sub-tasks support
- **Priority Levels**: Low, Medium, High, Urgent with color coding
- **Status Tracking**: Pending → Active → Auto/Manual Finished
- **Time Management**: Duration calculations, remaining time alerts
- **Automated Workflows**: Tasks auto-generated from daily task templates
- **Task Reopening**: Ability to reopen completed tasks

### 👥 User Management
- **Multi-Role System**: Owner, Manager, Employee roles
- **Permission System**: Granular permissions for each action
- **Department Assignments**: Users belong to departments
- **Manager-Employee Relationships**: Clear reporting structure
- **Firebase Integration**: Mobile app authentication and notifications

### 🏢 Organization Structure
- **Companies**: Multi-company support
- **Branches**: Company branch management with location tracking
- **Departments**: Departmental organization
- **Areas**: Geographic area management
- **Employee-Manager Hierarchy**: Clear reporting relationships

### 💬 Communication & Collaboration
- **Multi-level Comments**: Task discussions with reply threading
- **File Attachments**: Document sharing on tasks
- **Real-time Notifications**: WebSocket-powered live updates
- **Email Notifications**: Status change alerts

### ⏰ Time & Leave Management
- **Extra Time Requests**: Overtime approval system
- **Leave Management**: Leave requests with approval workflow
- **Performance Tracking**: Discount system for performance monitoring

### 📊 Reporting & Analytics
- **13+ Report Types**: Comprehensive reporting suite
- **Performance Metrics**: Employee productivity tracking
- **Time Tracking Reports**: Duration and overtime analysis
- **Communication Analytics**: Task discussion patterns
- **Data Export**: Excel-based reporting

## 🛠️ Technology Stack

### Backend
- **Laravel 9.19**: Modern PHP framework
- **Laravel Passport**: OAuth2 API authentication
- **Laratrust 7.1**: Role-based permissions
- **Laravel WebSockets**: Real-time features
- **Queue System**: Background job processing

### Frontend
- **Livewire 2.10**: Dynamic, reactive components
- **Laravel Breeze**: Authentication scaffolding
- **Responsive Design**: Mobile-friendly interface
- **Multi-language Support**: Arabic and English

### Database
- **MySQL**: Relational database with proper foreign key constraints
- **Soft Deletes**: Data integrity preservation
- **Comprehensive Migrations**: Version-controlled schema

### Integration
- **Firebase**: Mobile app authentication and notifications
- **Maatwebsite Excel**: Data import/export
- **Email System**: SMTP-based notifications

## 📦 Installation

### Prerequisites
- PHP 8.0.2 or higher
- Composer
- Node.js & NPM
- MySQL 5.7 or higher

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/SkylineInnovation/Smart-Task-Manager.git
   cd Smart-Task-Manager
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # Configure your database in .env file
   php artisan migrate
   php artisan db:seed
   ```

6. **Laravel Passport setup**
   ```bash
   php artisan passport:install
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Start the application**
   ```bash
   php artisan serve
   ```

## ⚙️ Configuration

### Environment Variables
```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_task_manager
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Firebase (for mobile app)
FIREBASE_PROJECT_ID=your_project_id
FIREBASE_PRIVATE_KEY=your_private_key
FIREBASE_CLIENT_EMAIL=your_client_email

# WebSocket
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster

# Mail
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
```

## 🔐 Default Roles & Permissions

### Roles
- **Owner**: Full system access
- **Manager**: Department and team management
- **Employee**: Task execution and reporting

### Key Permissions
- Task management (create, read, update, delete)
- User management
- Report generation
- Department management
- Permission administration

## 📱 API Documentation

### Authentication Endpoints
```
POST /api/auth/user/sign-up
POST /api/auth/user/log-in
POST /api/auth/user/send-otp
POST /api/auth/user/check-otp
POST /api/auth/user/forgot/password
```

### Protected Endpoints (OAuth2)
```
GET  /api/auth/user/user
POST /api/auth/user/update-info
GET  /api/auth/user/log-out
```

## 🎯 Usage

### Dashboard
Access the main dashboard at `/admin/dashboard` after login.

### Task Management
1. Create daily task templates
2. Generate tasks from templates
3. Assign tasks to employees
4. Track progress and completion
5. Generate reports

### User Management
1. Create users with appropriate roles
2. Assign to departments and managers
3. Set permissions based on roles
4. Track user activities

## 📊 Reports Available

1. Task Comments Report
2. Closed Tasks Coming Soon
3. Discount Tasks Report
4. Incoming Task Discounts
5. Outgoing Task Movements
6. Incoming Task Movements
7. Employee Follow-up Reports
8. Performance Analytics
9. Time Tracking Reports
10. Communication Patterns
11. Department Performance
12. Branch Analytics
13. Custom Reports

## 🔧 Development

### Running Tests
```bash
php artisan test
```

### Code Style
```bash
./vendor/bin/pint
```

### Database Refresh
```bash
php artisan migrate:refresh --seed
```

### Queue Workers
```bash
php artisan queue:work
```

### WebSocket Server
```bash
php artisan websockets:serve
```

## 📝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 🐛 Troubleshooting

### Common Issues

**Vite Manifest Error**
```bash
npm install
npm run build
```

**Permission Denied**
```bash
sudo chown -R $USER:$USER storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

**Database Connection**
- Verify database credentials in `.env`
- Ensure MySQL service is running
- Check database exists

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Check the documentation

## 🏆 Credits

Developed by **SkylineInnovation** - A comprehensive enterprise task management solution.

---

**Smart Task Manager** - Streamlining enterprise task management and team collaboration.
