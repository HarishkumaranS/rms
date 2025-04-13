
# Restaurant & Event Hall Management System (R&EHMS)

This project is a web-based Restaurant and Event Hall Management System developed using PHP and MySQL. It provides features for users to browse food items, place orders, and book event halls, while admins and billers can manage orders, products, bookings, and reports efficiently through a dedicated admin panel.

---

## 🔐 Login Details

### Admin
- **Username**: Admin  
- **Password**: Admin@123

### Biller
- **Username**: Biller  
- **Password**: Biller@123

### User
- **Phone Number**: 9632587410  
- **Password**: User@123

---

## 💡 Features

### User Module
- View food items
- Add food to favorites
- Place food orders online
- Track order status
- View available event hall booking dates
- Create account and login
- Reset password (Forgot Password)

### Admin Module
- Manage categories and products (add, update, delete)
- Generate reports
- View customer details
- Handle all orders and bookings

### Biller Module
- View and process orders (pending or delivered)
- Manage event hall bookings
- View product stock and update availability

---

## 🛠️ Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL

---

## 📁 Folder Structure

```
r&ehms/
│
├── admin/               # Admin dashboard files
├── assets/              # CSS, JS, and images
├── Config/              # Configuration files (e.g., DB connection)
├── database/            # SQL files (if any)
├── fav.php              # Manage user favorites
├── fav_place_order.php  # Place order from favorites
├── index.php            # Home page
├── login_logout.php     # Login/logout logic
├── order_page.php       # Order interface
├── oreder_summary.php   # Order summary view
├── place_order.php      # Final order placement
├── product.php          # Product detail page
├── second page.php      # Likely a secondary UI page
├── view_more.php        # View more product details
└── README.MD            # Project information
```

---

## 🚀 Setup Instructions

1. Clone or download the project zip and extract it.
2. Move the project folder to your local server directory (e.g., `htdocs` for XAMPP).
3. Import the SQL file into your MySQL database using phpMyAdmin.
4. Configure database settings in `Config/db_connect.php`.
5. Open the project in your browser via `http://localhost/r&ehms`.

---

## 📌 Note

- Ensure Apache and MySQL are running in your local server environment (e.g., XAMPP).
- The project supports multiple roles with role-specific access.

---

## 📧 Contact

For any issues, feel free to reach out or modify the code as per your project needs.
