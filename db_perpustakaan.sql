CREATE DATABASE IF NOT EXISTS db_perpustakaan;
USE db_perpustakaan;

-- Tabel Users untuk Login
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert User Default (username: admin, password: admin123)
INSERT INTO users (username, password) VALUES 
('admin', '$2y$10$w09d7q5N1V2j7g.XU5yE0u79jZ7MvT6h4qE9X3R7B8C9D0E1F2G3H');

-- Tabel Buku untuk CRUD
CREATE TABLE IF NOT EXISTS buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    tahun_terbit INT(4) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    sampul VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);