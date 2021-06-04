<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'mysql');
define('DB_PASS', 'mysql');
define('DB_NAME', 'bookstore');

function connect()
{
    $link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    return $link;
}

createDB();
createTableBooks();
createTableAuthors();
createTableCustomers();
/***
 * Creating Data Base
 */
function createDB()
{
    $link = new mysqli(DB_HOST, DB_USER, DB_PASS);

    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }

    $query = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . "";

    if ($link->query($query)) {
    } else {
        echo "Error creating database: " . $link->errno;
    }

    $link->close();
}

/***
 * Create table for saving product List
 *
 * @param string $tableName
 */
function createTableBooks()
{
    $link = connect();

    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }

    $query = "CREATE TABLE IF NOT EXISTS books(
    book_id INT(11) NOT NULL AUTO_INCREMENT,
    book_name VARCHAR(255) COLLATE utf8_general_ci NOT NULL, 
    price FLOAT NOT NULL ,
    PRIMARY KEY (book_id)) 
    CHARSET = utf8 COLLATE utf8_general_ci";

    if ($link->query($query)) {
    } else {
        echo "Error creating Table books: " . $link->errno;
    }

    $link->close();
}

function createTableAuthors()
{
    $link = connect();

    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }

    $query = "CREATE TABLE IF NOT EXISTS authors(
    author_id INT(11) NOT NULL AUTO_INCREMENT,
    author_name VARCHAR(30) COLLATE utf8_general_ci  NOT NULL, 
    PRIMARY KEY (author_id))
    CHARSET = utf8 COLLATE utf8_general_ci";

    if ($link->query($query)) {
    } else {
        echo "Error creating Table author: " . $link->error;
    }

    $link->close();

}

function createTableCustomers()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    $query = "CREATE TABLE IF NOT EXISTS customers(
    cust_id INT(11) NOT NULL AUTO_INCREMENT,
    cust_name VARCHAR(30) COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (cust_id))
    CHARSET = utf8 COLLATE utf8_general_ci";
    if ($link->query($query)) {
    } else {
        echo "Error creating Table customers: " . $link->error;
    }

    $link->close();
}

createTableOrders();
function createTableOrders()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    $query = "CREATE TABLE IF NOT EXISTS orders(
    order_id INT(11) NOT NULL AUTO_INCREMENT,
    cust_id INT(11)  NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (cust_id) REFERENCES customers(cust_id) ON DELETE CASCADE)";

    if ($link->query($query)) {
    } else {
        echo "Error creating Table orders: " . $link->error . '<br>';
    }

    $link->close();
}


function createTableOrderBook()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    $query = "CREATE TABLE IF NOT EXISTS order_book(
    order_id INT(11) NOT NULL,
    book_id INT(11)  NOT NULL, 
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE
    )";

    if ($link->query($query)) {
    } else {
        echo "Error creating Table order_book: " . $link->error;
    }

    $link->close();
}


function createTableBooksToAuthors()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    $query = "CREATE TABLE IF NOT EXISTS books_to_authors(
    author_id INT(11), 
    book_id INT(11),
    FOREIGN KEY (author_id) REFERENCES authors(author_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE)
    CHARSET = utf8 COLLATE utf8_general_ci";
    if ($link->query($query)) {
    } else {
        echo "Error creating Table books_to_authors: " . $link->error;
    }

    $link->close();
}

function insertAuthors()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    $query = "INSERT INTO `authors` 
    (`author_name`) 
    VALUES 
           ('JRR Tolkien'),
           ('Jane Austen'),
           ('Philip Pullman'),
           ('Douglas Adams'),
           ('Arthur Conan Doyle')";

    if ($link->query($query)) {
    } else {
        echo "Error creating Table order_book: " . $link->error;
    }

    $link->close();
}

$books = [
    'The Hobbit',
    'The Lord of the Rings',
    'The Lay of Aotrou and Itroun',
    'Farmer Giles of Ham',
    'The Homecoming of Beorhtnoth Beorhthel Son',
    'Sense & Sensibility',
    'Pride & Prejudice',
    'Mansfield Park',
    'The Amber Spyglass',
    'The Subtle Knife',
    'The Golden Compass',
    'The Restaurant at the End of the Universe',
    'Life, the Universe and Everything',
    'Mostly Harmless',
    'The Hound of the Baskervilles.',
    'A Study in Scarlet.',
    'The Sign of Four',
    'The Valley of Fear',
    'A Case of Identity'
];

function insertBooks($books)
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    foreach ($books as $book) {
        $price = (rand(0, 250) / 2);
        $query = "INSERT INTO `books`(`book_name`, `price`) VALUES ('$book','$price');";
        if ($link->query($query)) {
        } else {
            echo "Error creating Table order_book: " . $link->error;
        }
    }

    $link->close();
}

$customers = [
    'Liam',
    'Olivia',
    'Emma',
    'Farmer',
    'Beorth',
    'Sansy'
];

function insertCustomers($customers)
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    foreach ($customers as $cust) {
        $query = "INSERT INTO `customers`(`cust_name`) VALUES ('$cust')";
        if ($link->query($query)) {
        } else {
            echo "Error creating Table order_book: " . $link->error;
        }
    }

    $link->close();
}

function insertBooksToAuthor()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    $query = "INSERT INTO 
    `books_to_authors`
        (`author_id`,`book_id`) 
    VALUES 
           ('1', '1'),
           ('1', '2'),
           ('1', '3'),
           ('1', '4'),
           ('1', '5'),
           ('2', '6'),
           ('2', '7'),
           ('3', '8'),
           ('3', '9'),
           ('3', '10'),
           ('4', '11'),
           ('4', '12'),
           ('4', '13'),
           ('5', '14'),
           ('5', '15'),
           ('5', '16'),
           ('5', '17'),
           ('5', '18'),
           ('5', '19')";

    if ($link->query($query)) {
    } else {
        echo "Error creating Table order_book: " . $link->error;
    }

    $link->close();
}

function insertOrders()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }

    for ($i = 0; $i < 20; $i++) {
        $custId = rand(1, 6);
        $query = "INSERT INTO `orders`(`cust_id`) VALUES ('$custId')";

        if ($link->query($query)) {
        } else {
            echo "Error creating Table order_book: " . $link->error;
        }

    }

    $link->close();
}

function insertOrderBooks()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    for ($i = 0; $i < 20; $i++) {
        $ordId = random_int(1, 20);
        $bookId = random_int(1, 19);
        $query = "INSERT INTO `order_book`(`order_id`,`book_id`) VALUES ('$ordId', '$bookId')";

        if ($link->query($query)) {
        } else {
            echo "Error creating Table order_book: " . $link->error;
        }

    }

    $link->close();
}

function checkFillingTable($tableName)
{
    $link = connect();

    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }

    $query = "SELECT COUNT(*) FROM $tableName";
    $result = $link->query($query)->fetch_all();

    ($result[0][0] === "0") ? $res = true : $res = false;
    if ($link->query($query)) {
    } else {
        echo "Error crerrr Table order_book: " . $link->error;
    }
    return $res;
}

if (checkFillingTable('books')) insertBooks($books);
if (checkFillingTable('customers')) insertCustomers($customers);
if (checkFillingTable('authors')) insertAuthors();
if (checkFillingTable('orders')) insertOrders();
if (!checkFillingTable('authors') && !checkFillingTable('books')) {
    createTableBooksToAuthors();
}
if (checkFillingTable('books_to_authors')) insertBooksToAuthor($books);
if (!checkFillingTable('books') && !checkFillingTable('orders')) {
    createTableOrderBook();
    insertOrderBooks();
}


function selectArthurCDBooks()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    $name = 'Arthur Conan Doyle';
        $query = "SELECT `book_name` FROM `books_to_authors` AS bta
JOIN `books` AS b ON (bta.book_id = b.book_id) 
JOIN `authors` AS a ON (bta.author_id = a.author_id)
WHERE `author_name` = 'Arthur Conan Doyle'";
    $bookNames = [];
//        var_dump($link->query($query)->fetch_all());
        $res = $link->query($query)->fetch_all();
        foreach ($res as $result){
            foreach ($result as $book){
                array_push($bookNames, $book);
                echo $book.'<br>';
            }
        }

        if ($link->query($query)) {
        } else {
            echo "segError creating Table order_book: " . $link->error;
        }

    $link->close();
}

function selectCustomers()
{
    $link = connect();
    if ($link->connect_errno) {
        echo "Unable MySQL connection: " . $link->connect_error;
    }
    $name = 'Arthur Conan Doyle';
    $query = "SELECT `cast_name` FROM `books_to_authors` AS bta
JOIN `books` AS b ON (bta.book_id = b.book_id) 
JOIN `authors` AS a ON (bta.author_id = a.author_id)
WHERE `author_name` = 'Arthur Conan Doyle'";
    $bookNames = [];
//        var_dump($link->query($query)->fetch_all());
    $res = $link->query($query)->fetch_all();
    foreach ($res as $result){
        foreach ($result as $book){
            array_push($bookNames, $book);
            echo $book.'<br>';
        }
    }

    if ($link->query($query)) {
    } else {
        echo "segError creating Table order_book: " . $link->error;
    }

    $link->close();
}

selectArthurCDBooks();