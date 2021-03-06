# ACME Entertainment Movie Database




## FUNCTIONAL DESIGN AND ARCHITECTURAL REQUIREMENTS
### Requirements

The website requires a connection to a database with a front-end GUI for user access. The website has the following requirements:
1. Connect to a MySQL database
a.	Handle roughly 2300 movie records.
b.	Generate SQL queries.
2. Search Form
a.	Title
b.	Genre
c.	Year
d.	Rating
3.	Movie Details page
a.	Containing all database information on selected movie.
4.	Have a chart displaying the top 10 most popular movies.
5.	Use separate web modules. E.g. Header.


### Functionality

The site sources the information from the database tables, and populates the fields on the website. The database can also have records added to it through the website’s interface using MySQL.
The following basic flowchart demonstrates the flow of data in this project.

## DESIGN
Development Environments

### Structure
The basis of this webpage will be in HTML. This HTML can be generated by PHP or JavaScript scripting, which may be influenced by the results of MySQL queries. The HTML is also styled by Cascading Style Sheets (CSS). 
### Development Tools
The source for these files will be developed in VS Code as it is a versatile web programming tool that accommodates these file types. 
The PHP will be served locally by USBWebServer v8.0 for development and PHPMyAdmin will be used to handle database records. The movie database itself shall be imported through a provided .sql file into PHPMyAdmin.

### Run-time Environments

### Server Side
The server side environment for this website will be primarily PHP, served by USBWebServer. PHP will handle the output of HTML code and also the querying of databases and their tables in MySQL.
### Client Side
The client side of the application be served using HTML. The HTML will be exist in a structural form, and will be fleshed out with information using PHP through MySQL queries. The pages will also be augmented with JavaScript functionalities such as fetching images.
 
## Database Design
### Structure
The database ‘movies’ will contain two tables. The first table ‘moviesdb’ will contain the movie records containing the following items:
Field	Field Type	Length	Example Data
ID	INT	5	793
Title	VARCHAR	100	Kill Bill: Vol. 1
Studio	VARCHAR	50	Universal
Status	VARCHAR	20	Discontinued
Sound	VARCHAR	20	DTS 5.1
Versions	VARCHAR	50	4:03
Recommended Retail Price	DECIMAL	5,2	29.98
Rating	VARCHAR	5	PG
Year	INT	4	1999
Genre	VARCHAR	50	Action
Aspect	VARCHAR	50	2.35:1

The second table ‘mylist’ will contain movies selected from the previous table with the following information:
Field	Field Type	Length	Example Data
ID	INT	5	793
Title	VARCHAR	100	Kill Bill: Vol. 1

## Validation
The database has been created as per the design requirements, and tested to be working correctly. To implement the popular movies requirement and add some extra functionality 3 new columns were add to the table. These new columns are:
Field	Field Type	Length	Example Data
Search Count / Popularity	INT	5	92
Added to List Boolean	INT	1	0
A Star Rating	INT	1	5

The import file for this database has been included. 

 
