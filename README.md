# Hospital Management System (HMS)

## Overview

The Hospital Management System (HMS) is a comprehensive web-based application designed to streamline and automate hospital administrative operations. It provides a centralized platform for managing appointments, doctors, patients, departments, employees, and schedules, enabling healthcare facilities to operate more efficiently and effectively.

## Features

- **User Authentication**: Secure login system for administrators
- **Dashboard**: Overview of key metrics and quick access to modules
- **Appointment Management**: Schedule, view, edit, and cancel appointments
- **Doctor Management**: Add, update, and manage doctor profiles and specializations
- **Patient Management**: Maintain patient records and medical history
- **Department Management**: Organize hospital departments and assign staff
- **Employee Management**: Handle staff information and roles
- **Schedule Management**: Create and manage doctor schedules and availability
- **Reports and Analytics**: Generate insights using integrated charting tools

## Technologies Used

- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Framework/Library**: Bootstrap (for responsive design), jQuery (for interactivity)
- **Additional Libraries**:
  - DataTables (for data tables)
  - FullCalendar (for scheduling)
  - Chart.js (for analytics and charts)
  - Font Awesome (for icons)
  - Moment.js (for date/time handling)

## Prerequisites

Before running this application, ensure you have the following installed:

- PHP (version 7.4 or higher)
- MySQL (version 5.7 or higher)
- Apache or any web server supporting PHP
- A web browser (Chrome, Firefox, etc.)

## Installation

1. **Clone or Download the Repository**:
   - Download the project files to your local machine or clone the repository if available.

2. **Set Up the Database**:
   - Open your MySQL command line or phpMyAdmin.
   - Create a new database named `hos` (or update the connection settings in `includes/connection.php` if using a different name).
   - Import the provided SQL file (`hos.sql` or `hospital.sql`) into the database:
     ```
     mysql -u root -p hos < hos.sql
     ```
     (Replace `root` with your MySQL username if different, and enter your password when prompted.)

3. **Configure Database Connection**:
   - Open `includes/connection.php`.
   - Update the database credentials if necessary:
     ```php
     $server = "localhost";
     $username = "root";
     $password = "";
     $database = "hos";
     ```

4. **Deploy to Web Server**:
   - Copy the project files to your web server's root directory (e.g., `htdocs` for XAMPP).
   - Ensure the web server is running and PHP is enabled.

5. **Access the Application**:
   - Open your web browser and navigate to `http://localhost/hospital/` (adjust the path based on your setup).
   - Use the default admin credentials to log in:
     - Username: `admin`
     - Password: `AdminHMS@123#$`

## Usage

1. **Login**: Use the provided credentials to access the admin dashboard.
2. **Navigate Modules**: Use the sidebar to access different sections like Appointments, Doctors, Patients, etc.
3. **Manage Data**: Add, edit, or delete records as needed.
4. **View Reports**: Access the dashboard for visual analytics.

## Project Structure

```
hospital/
├── add-*.php          # Pages for adding new records
├── edit-*.php         # Pages for editing records
├── *.php              # Main pages (dashboard, appointments, etc.)
├── includes/
│   └── connection.php # Database connection file
├── assets/
│   ├── css/           # Stylesheets
│   ├── js/            # JavaScript files
│   ├── img/           # Images
│   └── fonts/         # Font files
├── plugins/           # Additional plugins (e.g., light-gallery, summernote)
├── *.sql              # Database schema and data
└── README.md          # This file
```

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and test thoroughly.
4. Submit a pull request with a clear description of your changes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

## Contact

For questions or support, please contact:
- Developer: [Your Name]
- Email: [akarbakr72@example.com]
- GitHub: [AKAR-sudo]

## Disclaimer

This application is for educational and demonstration purposes. It is not intended for production use in real healthcare environments without proper security audits, compliance with healthcare regulations (e.g., HIPAA), and professional testing.