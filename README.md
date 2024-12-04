# 🌟 ** Iventory Management System ** 🌟

** Description**:
- This project followed OOP, MVC
- This is project about manage inventory. You can manage Products, Suppliers, Customers, Invoices, Purchases,...

---

## 📋 **Main Features**
- 🧘‍♂️OOP, MVC
- 📝 Manage Management Board, Authentication & Authorization.
- 📂 CRUD Suppliers, Customers, Units, Categories, Products, Purchases, Invoice, Stock, Permissions, Role, Role In Permissions.
- Send Email, Reset Password, Active Password from google...
---

## 🚀 **Settings**
### 1. **System Required**
- **PHP** >= 8.0
- **MySQL** >= 5.7
- **Composer** 
- **Web Server** (Apache)

---

### 2. **Settings Steps**
#### ⬇️ **1. Clone Project**
```bash
- git clone [https://github.com/<user>/<repository-name>.git](https://github.com/TonyDuong0509/php-inventory-management.git)
- cd <repository-name>

**Install Composer**
- composer install
```

**🛠 3. Install And Config Database**
- Download MySQL (MySQLAdmin, Navicat...)
- Link Database: https://www.mediafire.com/file/m4jxq27gv49ad2y/inventory.sql/file
- Download and open it. And add 2 line like this: "CREATE DATABASE inventory; USE inventory;"

  **⚙️ 4. Config File .env**
- Create file .env in your cloned project and fill this information
SERVERNAME=...
USERNAME=...
PASSWORD=...
DBNAME=...

(This is config from your MySQL)

GOOGLE_ID=...
GOOGLE_SECRET=...
GOOGLE_REDIRECT=...

(This is config from your Oauth2 Google. You can search and do it in google or youtube)

APP_PASSWORD=...

(This is config from App Password of Google do send Email)

**5. Run Project**
- http://localhost to access. But if you want virtual domain you can search it in Google or Youtube to do that.
- Account Login:
email: admin@gmail.com
password: 123123

