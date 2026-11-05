# AgriPortal 🌾

AgriPortal is a modern agricultural web platform connecting farmers and buyers. It features product listings, order management, real-time chats, weather updates, market price tracking, and AI-driven recommendations.

---

## 🛠️ Prerequisites

To run this project on your system, ensure you have the following installed:

- **PHP**: `^8.2`
- **Composer** (PHP Package Manager)
- **Node.js** (includes NPM)
- **Database**: MySQL, PostgreSQL, or SQLite

---

## 🚀 Setup Instructions

Follow these step-by-step instructions to clone, configure, and run the project locally.

### 1. Clone the Repository
Clone the project repository to your local machine:
```bash
git clone https://github.com/Kunalkumar82/agriportal.git
cd agriportal
```

### 2. Install PHP Dependencies
Use Composer to install the required Laravel framework dependencies:
```bash
composer install
```

### 3. Install Frontend Dependencies
Use NPM to install frontend packages (Tailwind CSS, Vite, etc.):
```bash
npm install
```

### 4. Set Up Configuration File
Copy the environment template file to create a local `.env` configuration file:

**On Windows (PowerShell):**
```powershell
copy .env.example .env
```

**On macOS/Linux:**
```bash
cp .env.example .env
```

### 5. Generate Application Key
Generate the unique application encryption key required by Laravel:
```bash
php artisan key:generate
```

### 6. Configure the Database
Open the `.env` file in your text editor and update the database configuration section to match your local setup:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

> [!NOTE]
> Make sure to create the database in your database management system (e.g., phpMyAdmin, TablePlus) before running the migrations.

### 7. Run Database Migrations
Create the database tables and schema structures:
```bash
php artisan migrate
```
*(Optional) If there are any database seeders, you can run them using:*
```bash
php artisan migrate --seed
```

### 8. Link Storage Directory
Generate the storage symlink so that user-uploaded files (like product images) are publicly accessible:
```bash
php artisan storage:link
```

### 9. Build Frontend Assets
Compile the CSS and JS files for local development:
```bash
npm run dev
```

### 10. Start the Laravel Server
In a separate terminal tab or window, launch the Laravel local development server:
```bash
php artisan serve
```

---

## 🌐 Access the Application

Once both development servers are running:
- **Backend (Laravel Serve)**: Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your web browser.
- **Frontend (Vite Server)**: Runs dynamically alongside Laravel to hot-reload styling and scripts.
