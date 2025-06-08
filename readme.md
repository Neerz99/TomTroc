# TomTroc

Plateforme d’échange de livres entre particuliers en PHP (MVC)

---

## 🚀 Présentation

TomTroc est une petite application web de troc de livres, développée en PHP selon une architecture **MVC** légère.  
Fonctionnalités principales :
- **Inscription / Connexion** d’utilisateurs
- **Profils** personnalisables (avatar, bio)
- **CRUD** de livres : ajout, modification, suppression, liste, détail
- **Messagerie interne** entre deux membres

---

## ⚙️ Prérequis

- PHP ≥ 8.2
- Ext PDO + driver MySQL
- Serveur web (XAMPP, Apache / Nginx, etc...)
- MySQL / MariaDB

---

## 🛠️ Installation

1. **Clonez** le dépôt
   ```bash
   git clone https://github.com/Neerz99/TomTroc.git
   cd TomTroc
   ```
   
2. **Créez la base de données** `tomtroc` et importez le fichier `sql/tomtroc.sql` pour initialiser les tables.

3. **Configurez** le fichier `config.php` avec vos paramètres de connexion à la base de données :
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'tomtroc');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```
   
4. **Démarrez votre serveur web** et accédez à l'application via `http://localhost/TomTroc/`.

