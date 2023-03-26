<?php
include('connect.php');

function get_authors_by_book_id($book_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "SELECT authors.* FROM authors, books_authors WHERE authors.id = books_authors.author_id and $book_id = books_authors.book_id";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function get_all_authors()
{
    $con = get_connection();
    $arr = array();
    $select_query = "SELECT * FROM authors";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function get_all_genres()
{
    $con = get_connection();
    $arr = array();
    $select_query = "SELECT * FROM genre";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}


function get_readable_books_by_user_id($user_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "SELECT books.id as id, books.title as title, books.date as date, readers.date as deadline FROM readers, books
WHERE readers.user_id = $user_id and readers.book_id = books.id;";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function add_user($name, $email, $password)
{
    $con = get_connection();
    $select_query = "INSERT INTO users (name, login, password, role) VALUES ('$name', '$email', '$password', 'USER');";
    $res = mysqli_query($con, $select_query);
    mysqli_close($con);
    return $res;
}

function get_user_by_login($login)
{
    $con = get_connection();
    $arr = array();
    $select_query = "SELECT * FROM users WHERE users.login = '$login';";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    if (!empty($arr)) {
        return $arr[0];
    } else {
        return $arr;
    }

}

function get_favourites_books_by_user_id($user_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "SELECT books.id as id,
		books.title as title,
		books.date as date,
        books.pages_count as pages_count,
        books.free_count as free_count
       FROM books, favourites_books
                        where favourites_books.user_id = $user_id
                        and favourites_books.book_id = books.id;";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function delete_from_favourites_by_user_id_and_book_id($user_id, $book_id)
{
    $con = get_connection();
    $select_query = "DELETE FROM favourites_books WHERE favourites_books.user_id = $user_id and favourites_books.book_id = $book_id;";
    mysqli_query($con, $select_query);
    mysqli_close($con);
}

//Авторы в худшем случае могут быть "Выберите значение" или []
//Жанры могут быть не всегда и если их нет, передаётся пустой массив
//юзер_айди есть всегда и он всегда корректный
function get_unique_books($user_id, $authors, $genres)
{
    $con = get_connection();
    $arr = array();
    $genres_text = '';
    $num = 0;
    if (!empty($genres)) {
        $num = count($genres);
    }
    $author = null;
    if (!empty($authors)) {
        if ($authors[0] != "Выберите значение") {
            $author = $authors[0];
        }
    }

    for ($i = 0; $i < $num; $i++) {
        if ($i == $num - 1) {
            $genres_text .= '"' . $genres[$i] . '"';
        } else {
            $genres_text .= '"' . $genres[$i] . "\", ";
        }
    }
    $select_query = "SELECT min(books.id) as id, books.title as title, books.free_count as free_count, books.date as date
FROM books, books_genres, books_authors, authors, genre
where NOT EXISTS (
  SELECT 1
  FROM favourites_books
  WHERE favourites_books.user_id = $user_id AND favourites_books.book_id = books.id
)
and NOT EXISTS (
  SELECT 1
  FROM readers
  WHERE readers.user_id = $user_id AND readers.book_id = books.id
)
and books_genres.book_id = books.id
and books_genres.genre_id = genre.id
and books_authors.book_id = books.id
and books_authors.author_id = authors.id";
    if ($num > 0) {
        $select_query .= " and genre.title in ( $genres_text )";
    }
    if (!empty($author)) {
        $select_query .= " and \"$author\" = authors.id";
    }
    $select_query .= " group by title, free_count, date;";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function get_favourites_books_by_user_id_and_book_id($user_id, $book_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "SELECT *
       FROM favourites_books
                        where favourites_books.user_id = $user_id
                        and favourites_books.book_id = $book_id";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function add_to_favourites($book_id, $user_id)
{
    $con = get_connection();
    $select_query = "INSERT INTO favourites_books (user_id, book_id) VALUES ($user_id, $book_id);";
    mysqli_query($con, $select_query);
    mysqli_close($con);

}

function get_books_by_filters($author_name, $author_surname, $title, $genre)
{
    $con = get_connection();
    $arr = array();
    if (empty($author_name) && empty($author_surname) && empty($title) && empty($genre)) {
        $sql = "SELECT * FROM books;";
    } else {
        $sql = "SELECT DISTINCT books.id, books.title, books.date, books.pages_count, books.free_count 
            FROM books
            LEFT JOIN books_genres ON books_genres.book_id = books.id
            LEFT JOIN genre ON books_genres.genre_id = genre.id
            LEFT JOIN books_authors ON books_authors.book_id = books.id
            LEFT JOIN authors ON books_authors.author_id = authors.id
            WHERE 1=1";
        if (!empty($author_name)) {
            $sql .= " AND authors.name LIKE '%" . $author_name . "%'";
        }
        if (!empty($author_surname)) {
            $sql .= " AND authors.surname LIKE '%" . $author_surname . "%'";
        }
        if (!empty($title)) {
            $sql .= " AND books.title LIKE '%" . $title . "%'";
        }
        if (!empty($genre)) {
            $sql .= " AND genre.title LIKE '%" . $genre . "%'";
        }
    }


// Выполнение запроса и вывод результатов

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function get_genres_by_book_id($book_id){
    $con = get_connection();
    $arr = array();
    $select_query = "SELECT genre.* FROM genre, books_genres WHERE genre.id = books_genres.genre_id and $book_id = books_genres.book_id";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}


function get_user_by_id($user_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "
    SELECT *
    FROM users
    WHERE users.id = $user_id";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function get_book_by_id($book_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "
    SELECT *
    FROM books
    WHERE books.id = $book_id";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function get_readble_by_user_id_and_book_id($user_id, $book_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "
    SELECT *
    FROM readers
    WHERE readers.user_id = $user_id and readers.book_id = $book_id;";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function add_readble($user_id, $book_id, $date)
{
    $book = get_book_by_id($book_id);
    $user = get_user_by_id($user_id);
    if (strtotime($date) === false || empty($book) || empty($user)) {
        return false; // дата не соответствует формату
    }
    $res = change_count_book_by_book_id($book_id, -1);
    if ($res) {
        $con = get_connection();
        $select_query = "INSERT INTO readers (user_id, book_id, date) VALUES ($user_id, $book_id, '$date');";
        $res = mysqli_query($con, $select_query);
        mysqli_close($con);
        return $res;
    } else {
        return false;
    }
}

function change_count_book_by_book_id($book_id, $count)
{

    $book = get_book_by_id($book_id);
    if (!empty($book)) {
        $book = $book[0];
    } else {
        return false;
    }
    $con = get_connection();
    if (($book['free_count'] + $count) >= 0) {
        $count = $book['free_count'] + $count;
    } else {
        return false;
    }
    $select_query = 'UPDATE books SET free_count = ' . $count . ' WHERE books.id = ' . $book_id . ';';
    $res = mysqli_query($con, $select_query);
    mysqli_close($con);
    return $res;
}

function delete_book_from_readble_by_book_id_and_user_id($book_id, $user_id)
{

    $readble = get_readble_by_user_id_and_book_id($user_id, $book_id);
    if (empty($readble)) {
        return false;
    }

    $res = change_count_book_by_book_id($book_id, 1);
    if ($res) {
        $con = get_connection();
        $select_query = 'DELETE FROM readers WHERE readers.book_id = ' . $book_id . ' AND readers.user_id = ' . $user_id;
        $res = mysqli_query($con, $select_query);
        mysqli_close($con);
        return $res;
    } else {
        return false;
    }

}

function create_book_by_title_and_date_and_count($book_title, $book_date, $book_page_count)
{
    if (strtotime($book_date) === false) {
        return false;
    }
    // Проверяем, есть ли книга с таким названием и датой выпуска в базе данных
    $existing_book = get_book_by_title_and_date($book_title, $book_date);
    if (!empty($existing_book)) {
        // Если есть, то увеличиваем количество свободных экземпляров книги на 1
        change_count_book_by_book_id($existing_book[0]['id'], 1);
        return true;
    }

    $con = get_connection();
    $select_query = "
    INSERT INTO books(title, date, pages_count, free_count)
    VALUES ('$book_title', '$book_date', $book_page_count, 1);";
    mysqli_query($con, $select_query);
    mysqli_close($con);
    return true;
}

function get_book_by_title_and_date($book_title, $book_date)
{
    $con = get_connection();
    $arr = array();
    $select_query = "
    SELECT *
    FROM books
    WHERE title = '$book_title'
    AND date = '$book_date'";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function get_genre_by_title($title)
{
    $con = get_connection();
    $arr = array();
    $select_query = "
    SELECT * FROM genre
    WHERE title = '$title'";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function create_genre($title)
{
    $con = get_connection();
    $select_query = "
    INSERT INTO genre(title)
    VALUES('$title')";
    mysqli_query($con, $select_query);
    mysqli_close($con);
}

function get_books_genres_by_genre_id_and_book_id($genre_id, $book_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "
    SELECT * FROM books_genres
    WHERE book_id = $book_id
    AND genre_id = $genre_id";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function add_genre_to_book($book_id, $book_genre)
{
    //1) проверить, существует ли такая книга
    //2) если книга не существует, то выбросить ошибку
    //3) проверить, существует ли такой жанр
    //4) если не существует, то создать его
    //иначе gроверить, нет ли у книги уже такого жанра. Если есть, то остановить программу
    //5) добавить книге жанр
    $book = get_book_by_id($book_id);
    if (empty($book)) {
        return false;
    }

    $genre = get_genre_by_title($book_genre);

    if (empty($genre)) {
        create_genre($book_genre);
        $genre = get_genre_by_title($book_genre);
    } else {
        $books_genres = get_books_genres_by_genre_id_and_book_id($genre[0]['id'], $book_id);
        if (!empty($books_genres)) {
            return;
        }
    }
    $genre = $genre[0];
    $genre_id = $genre['id'];

    $con = get_connection();
    $select_query = "INSERT INTO books_genres(book_id, genre_id)
                         VALUES($book_id, $genre_id)";
    mysqli_query($con, $select_query);
    mysqli_close($con);
    return true;
}

function get_author_by_name_and_surname($book_author_name, $book_author_surname)
{
    $con = get_connection();
    $arr = array();
    $select_query = "
    SELECT * FROM authors
    WHERE name = '$book_author_name'
    AND surname = '$book_author_surname'";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function create_author($book_author_name, $book_author_surname)
{
    $con = get_connection();
    $select_query = "
    INSERT INTO authors(name, surname)
    VALUES('$book_author_name', '$book_author_surname')";
    mysqli_query($con, $select_query);
    mysqli_close($con);
}

function get_books_authors_by_author_id_and_book_id($author_id, $book_id)
{
    $con = get_connection();
    $arr = array();
    $select_query = "
    SELECT * FROM books_authors
    WHERE book_id = $book_id
    AND author_id = $author_id";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}

function add_author_to_book($book_id, $book_author_name, $book_author_surname)
{
    //1) проверить, существует ли такая книга
    //2) если книга не существует, то выбросить ошибку
    //3) проверить, существует ли такой автор
    //4) если не существует, то создать его
    //иначе gроверить, нет ли у книги уже такого автора. Если есть, то остановить программу
    //5) добавить книге автора
    $book = get_book_by_id($book_id);
    if (empty($book)) {
        return false;
    }

    $author = get_author_by_name_and_surname($book_author_name, $book_author_surname);

    if (empty($author)) {
        create_author($book_author_name, $book_author_surname);
        $author = get_author_by_name_and_surname($book_author_name, $book_author_surname);
    } else {
        $books_authors = get_books_authors_by_author_id_and_book_id($author[0]['id'], $book_id);
        if (!empty($books_authors)) {
            return false;
        }
    }
    $author = $author[0];
    $author_id = $author['id'];

    $con = get_connection();
    $select_query = "INSERT INTO books_authors(book_id, author_id)
                         VALUES($book_id, $author_id)";
    mysqli_query($con, $select_query);
    mysqli_close($con);
    return true;
}


?>