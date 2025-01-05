
# Cinema Seat Reservation System

A simple web application for reserving tickets and seats in a small cinema. The project supports two cinema screens and uses technologies like HTML, CSS, PHP, MySQL (MariaDB), and JavaScript.

## Features

- **Movie Listings:** Displays available movies, their descriptions, and showtimes.
- **Seat Reservations:** Allows users to select seats, provide their details, and reserve tickets.
- **Dynamic Content:** Movie posters and showtimes are dynamically retrieved from a database.
- **Responsive Design:** Optimized for various screen sizes.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL (MariaDB)
- **Other:** SQL for database structure and queries

## Setup and Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yanuzs/cinema-reservation.git
   ```
2. Navigate to the project directory:
   ```bash
   cd cinema-reservation
   ```
3. Import the database:
   - Use the `kino.sql` file to create the database and tables.
   - Example command (using MySQL CLI):
     ```bash
     mysql -u root -p < kino.sql
     ```
4. Configure database connection:
   - Edit the `db.php` file and update the credentials for your database server:
     ```php
     $servername = "your-server";
     $username = "your-username";
     $password = "your-password";
     $dbname = "kino";
     ```
5. Run the project:
   - Deploy the files in a web server supporting PHP (e.g., XAMPP, WAMP, LAMP).
   - Access the project in a browser: `http://localhost/cinema-reservation`.

## File Structure

- `index.php` - Homepage with movie listings and showtimes.
- `rezerwacja.php` - Ticket reservation page.
- `db.php` - Database connection script.
- `kino.sql` - SQL script for database creation and initial data.
- `style.css` - Styling for the application.
- `script.js` - JavaScript for the image slider.
