## 🚀 How to Run the Project

Follow the steps below to run the **Artcademy** project locally.

---

### 1️⃣ Prepare Local Server

* Open **XAMPP Control Panel**
* Start the following modules:

  * **Apache**
  * **MySQL**

---

### 2️⃣ Create Database

Create a new database via phpMyAdmin:

[http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

Database name:

```
artcademy
```

---

### 3️⃣ Clone Repository

```bash
git clone https://github.com/verenavynne/Artcademy.git
cd Artcademy
```

---

### 4️⃣ Open Project

Open the project using **Visual Studio Code**:

```bash
code .
```

Or open the folder manually via VS Code.

---

### 5️⃣ Setup Environment File

The `.env` file containing important keys and credentials has been provided inside the project ZIP file.

---

### 6️⃣ Install Dependencies

```bash
composer install
npm install
```

---

### 7️⃣ Run Migration & Seeder

```bash
php artisan migrate
php artisan db:seed
```

---

### 8️⃣ Create Storage Link

```bash
php artisan storage:link
```

---

### 9️⃣ Run the Application

```bash
php artisan serve
```

---

### 🔟 Access the Website

Open in browser:

[http://127.0.0.1:8000/](http://127.0.0.1:8000/)

---

## 🧰 Tech Stack & Libraries

This project is built using:

* **Laravel** — Main PHP Framework
* **DOMPDF** — PDF generation
* **Three.js** — 3D visualization
* **OpenAPI** — API documentation / integration
* **MySQL** — Database
* **XAMPP** — Local development server

---

## ⚠️ Notes

If you encounter configuration/cache issues, run:

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```
