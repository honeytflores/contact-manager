# PHP Contact Manager

A simple contact manager built with PHP and MySQL.

## Features
- Add, edit, delete contacts
- Search contacts by name, email, or phone
- Pagination

## Setup
1. Import `contacts` table using provided SQL:
```sql
CREATE DATABASE contact_manager;
USE contact_manager;
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20)
);
