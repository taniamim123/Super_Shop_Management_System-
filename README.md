Super Shop Management System - Project Overview
SuperShop Management System is a full-stack, web-based software application designed to digitalize and streamline daily pharmacy operations. It eliminates manual record-keeping by providing automated inventory control, real-time invoicing, customer management, and comprehensive sales reporting.

🏗️ Repository Architecture & Folder Structure
My repository is structured cleanly into logical directories to ensure scalability and maintainability:
├── 📁 css/                 # Custom styling files (style.css)
├── 📁 js/                  # Client-side scripts (app.js)
├── 📁 php/                 # Backend scripts, database connection & form handlers
│   ├── db.php              # MySQL database connection module
│   ├── login.php           # Admin authentication handler
│   ├── add_inventory.php   # Adds new medicine records
│   ├── update_stock.php   # Updates existing stock counts
│   ├── delete_product.php  # Removes items from inventory
│   └── save_bill.php       # Processes sales and generates invoices
├── 📁 database/            # SQL database backup schema (pharmacy.sql)
├── 📄 index.php            # Admin login interface
├── 📄 dashboard.php        # Core analytics overview
├── 📄 billing.php          # Interactive POS billing & invoice preview
├── 📄 inventory.php        # Stock management console
├── 📄 customers.php        # Customer directory with live search
├── 📄 history.php          # Complete sales records with print feature
├── 📄 logout.php           # Secure session termination
└── 📄 README.md            # Project documentation

🔥 Key Modules & Functionalities1. 🔒 Admin Authentication (index.php, logout.php)Secures the system using PHP session validation.   Protects all internal management pages from unauthorized URL access.   

2. 📊 Interactive Dashboard (dashboard.php)Live Analytics: Displays key performance metrics such as Total Available Products, Total Revenue Earned, and Low-Stock Alerts.   Low-Stock Warnings: Automatically flags items with fewer than 10 units remaining so administrators can restock promptly.   Recent Transactions: Shows the 5 most recent sales on the main dashboard.
3. 📦 Inventory Management (inventory.php)Stock Management: Enables adding, updating, and deleting medicine records with parameters like name, category, price, stock, and expiry dates.   Dynamic Status Badges: Automatically updates item status to In Stock or Low Stock.   Instant Filter: Includes client-side JavaScript searching to find medicines quickly.
4. 🧾 Billing System & POS (billing.php)Unique Invoice Generator: Automatically assigns unique order identifiers (e.g., INV-4821).   Real-time Price & Stock Calculation: Dynamically updates item price, stock validation, and total cost using JavaScript.   Stock Guard: Prevents sales if the requested order quantity exceeds current available stock.   Live Receipt Preview: Shows a real-time digital invoice layout before confirming the bill.
   5. 👤 Customer Management (customers.php)Stores customer records including contact details and registration dates.   Provides real-time filtering to locate specific customers instantly.
   6. 📜 Sales History & Reporting (history.php)Retains a complete audit trail of all completed sales.   Includes a single-click Print Report button (window.print()) for printing physical receipts or saving PDF reports.
   7.  🛠️ Technology StackFrontend: HTML5, CSS3 (Google Fonts Poppins), JavaScript (ES6 DOM manipulation)   Backend: PHP (Procedural)   Database: MySQL (mysqli driver)   Would you like me to refine your README.md on GitHub with this exact layout?Do you need assistance setting up the database connection settings (php/db.php) for local testing?
