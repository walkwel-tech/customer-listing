# Introduction

This project is a basic implementation of Table listing using PHP.

## Customers Table
Display Listing of the table in given database.
The table has following fields
* **First name** *varchar(30)*
* **Last name** *varchar(30)*
* **Street** *varchar(30)*
* **City** *varchar(30)*
* **State** *char(2)*
* **Zip** *char(5)*


## Index
Displays **Paginated** list of *Customers*. With all the details mentioned above.

### Example
| First Name | Last Name | Street | City | State |  Zip  |
|------------|-----------|--------|------|-------|-------|
| Customer 1 | Last 1    | Street | City |   ST  | 14488 |
| Customer 2 | Last 2    | XYZ    | City |   ST  | 14488 |
| Customer 3 | Last 3    | ABC    | City |   ST  | 14488 |

### Additional Information
* By default Records are **paginated** ***10 rows per page***.
* Pagination can be changed to as many rows as user prefers.
* **Background** of the screen should be *light green*
* Line separators of heading and data should be white
* Column headings should be black
* Data color should be yellow


# Standards
This project follows PSR-2.
* Indentation is done using 4-spaces
* Class names are **StudlyCaps**
* Properties of a Class also follow *camleCase*
* Function and Methods follow **camelCase** as well


# Installation
The project is built with PHP and MySQL as primary technologies and PDO is used to interact with the database.
In order to run this project on a **Linux** server

* Put the project on the document root of the server.
    * Either by Downloading or Cloning the repository
* Setup the database connection.
 > File **includes/config.php** contains all the necessary constants which are required to be filled for a successful connection with MySQL server.
