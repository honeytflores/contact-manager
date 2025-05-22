## Database Setup

To set up the MySQL database:

1. Open your MySQL client (e.g. phpMyAdmin, MySQL CLI)
2. Run the SQL script in `database.sql` or paste the following:

```sql
CREATE DATABASE contact_manager;
USE contact_manager;
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20)
);
