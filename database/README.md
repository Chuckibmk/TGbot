This Folder contains the object that connects your TG-Bot to your database
Database of choice is MySQL

in connection.php: 
There is a PHP class named `Connection` that provides a basic database connection using PDO (PHP Data Objects) to connect to a MySQL database. Here's a breakdown of the class:

- The class has protected properties: `$isConn` to track the connection status, `$datab` to hold the PDO object for the database connection, and `$transaction` to hold the transaction object.
- The class constructor `__construct` takes several parameters to configure the database connection: `$username`, `$password`, `$host`, `$dbname`, and `$options` (an optional array of additional options).
- Inside the constructor, the code attempts to establish a connection to the MySQL database using the provided parameters. It creates a new PDO object and assigns it to the `$datab` property.
- The `setAttribute` method is called on the `$datab` object to set the error mode to `PDO::ERRMODE_EXCEPTION`, which means PDO will throw exceptions for errors instead of silent failures.
- The `$transaction` property is set to the `$datab` object, which allows the class to perform transactions using the same connection.
- The `setAttribute` method is called again to set the default fetch mode to `PDO::FETCH_ASSOC`, which means the result sets will be returned as associative arrays.
- If an exception occurs during the connection process, it is caught using a `catch` block, and the error message can be accessed using `$e->getMessage()`. However, the caught exception is not currently being used or displayed.
- The class also includes a public method named `Disconnect` that can be used to close the database connection by setting `$datab` to `NULL` and updating the connection status.

At the end of the code, there is a commented-out line `$con = new Connection();` which creates an instance of the `Connection` class. This line is likely used for debugging purposes.

This class provides a basic database connection setup and can be extended to include more advanced database operations and functionalities.


in Database.php:
There is an extended PHP class named `database` that inherits from the `connection` class. It adds various database operations and methods. Let's go through the code:

- The code begins with an inclusion of the `connection.php` file, which contains the parent `connection` class.
- The `database` class extends the `connection` class using the `extends` keyword. This allows the `database` class to inherit the properties and methods of the `connection` class.
- The `database` class has a constructor that calls the parent constructor using `parent::__construct()`. This ensures that the database connection is established by invoking the constructor of the parent class.
- The class includes several methods for performing database operations: `getRow`, `getRows`, `getNoRows`, `insertRow`, `updateRow`, `deleteRow`, and `lastID`.
  - The `getRow` method is similar to the one you previously provided. It executes a prepared SQL statement and returns a single row of results.
  - The `getRows` method also executes a prepared SQL statement but returns an array of all rows of results.
  - The `getNoRows` method executes a prepared SQL statement and returns a single value from the first column of the first row of results. This is useful when you only need a single value, such as a count or a specific field.
  - The `insertRow` method executes a prepared SQL statement to insert a row into the database.
  - The `updateRow` method calls the `insertRow` method to execute an SQL statement for updating a row.
  - The `deleteRow` method is similar to the `updateRow` method but for deleting a row.
  - The `lastID` method retrieves the last inserted ID from the database using the `lastInsertId` method provided by PDO.
- Finally, there is a `test` method that simply echoes "database class test". This method can be used for testing purposes.

This extended class provides additional functionality for performing various database operations using the established database connection. It leverages the PDO library for executing prepared statements and handling exceptions.