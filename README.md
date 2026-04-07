XSS Attack & Cookie Theft - Educational Demonstration

![Security](https://img.shields.io/badge/Security-XSS%20Demo-red)
![PHP](https://img.shields.io/badge/PHP-7.4+-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)

Project Overview

This project demonstrates **Cross-Site Scripting (XSS)** vulnerabilities and cookie theft attacks in a controlled, educational environment.

**EDUCATIONAL PURPOSE ONLY**  
This simulation is designed for learning cybersecurity concepts. Never test these techniques on real websites without authorization.

Features

**Vulnerable Website** - Demonstrates XSS attack vectors
**Secure Website** - Shows proper protection implementation
**Cookie Theft Simulation** - Silent data exfiltration demo
**Attack Logging** - Tracks stolen cookies for analysis


Files Description

`config.php` | Database connection configuration 
`index.php` | **Vulnerable** forum (XSS exploitable) 
`index_secure.php` | **Secure** forum (XSS protected)
`voleur.php` | Attacker's server simulation (logs stolen cookies)
Installation

### Prerequisites
- XAMPP (Apache + MySQL + PHP)
- Web browser (Chrome recommended)

### Setup Steps

1. **Clone this repository**
2. **Move files to XAMPP**
3. **Start XAMPP**
4. **Create database**
  
CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    commentaire TEXT,
    date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

6. **Configure database connection**
7. **Access the sites**
Vulnerable: http://localhost/projet_xss/index.php
Secure: http://localhost/projet_xss/index_secure.php
   
