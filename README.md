# 📚 Courses Management System

A full-featured **Courses Management System** built using **Laravel 12**, **Bootstrap**, and **MySQL**.
This system is designed to efficiently manage instructors, students, courses, invoices, attendance, and reports.

---

## 🚀 Features

### 👥 User & Role Management

* Manage system users (Admins / Staff)
* Role-based access control (RBAC)
* Permissions management for each role

### 🧑‍🏫 Instructor Management

* Add, edit, and delete instructors
* Assign instructors to courses

### 🎓 Student Management

* Register and manage students
* Track student data
* Enroll students in courses

### 📚 Course Management

* Create and manage courses
* Assign instructors to courses
* Manage student enrollments

### 💰 Invoice System

* Generate invoices for students
* Payment status tracking:

  * ✅ Fully Paid
  * ⚠️ Partially Paid
  * ❌ Unpaid

### 📅 Attendance System

* Track student attendance and absence
* Attendance reports

### 📊 Reports

* Generate detailed system reports
* Export reports as:

  * PDF
  * Excel

---

## 🛠️ Tech Stack

* **Backend:** Laravel 12
* **Frontend:** Bootstrap
* **Database:** MySQL
* **Packages:**

  * laravel maatwebsite excel
  * SnappyPDF

---

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/courses-management-system.git
```

### 2. Navigate to the project directory

```bash
cd courses-management-system
```

### 3. Install dependencies

```bash
composer install
npm install
```

### 4. Copy environment file

```bash
cp .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Configure database

Update your database credentials inside the `.env` file.

### 7. Run migrations

```bash
php artisan migrate
```

### 8. Seed database (optional)

```bash
php artisan db:seed
```

### 9. Run the development server

```bash
php artisan serve
```

---

## 🔐 Default Admin

Run database seeders and use Admin account email: admin@mail.com , and Password: 123456 .

---

## 📂 Project Structure

* `app/Models` → Application models
* `app/Http/Controllers` → Controllers
* `resources/views` → Blade templates
* `routes/web.php` → Web routes

---


## 🤝 Contributing

Contributions are welcome!
Feel free to fork this repository and submit a pull request.

---

## 📄 License

This project is open-source and available under the **MIT License**.

---

## 👨‍💻 Author

Developed by **Mohamed Adel**

---

## ⭐ Support

If you find this project helpful, please give it a ⭐ on GitHub!
