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
    return $arr;
}

function get_books_by_genres_and_author($genres, $authors)
{

    $con = get_connection();
    $genres_text = '';
    $num = 0;
    if (isset($genres)) {
        $num = count($genres);
    }
    $author = null;
    if (isset($authors)) {
        if (count($authors) > 0 and $authors[0] != "Выберите значение") {
            $author = $authors[0];
        } else {
            $authors = null;
        }
    }
    for ($i = 0; $i < $num; $i++) {
        if ($i == $num - 1) {
            $genres_text .= '"' . $genres[$i] . '"';
        } else {
            $genres_text .= '"' . $genres[$i] . "\", ";
        }
    }
    $arr = array();
    $select_query = null;
    if (isset($genres) && (!isset($authors) || $authors == null)) {
        if (count($genres) > 0) {
            $select_query = "SELECT books.* FROM genre, books_genres, books
               WHERE genre.title in ( $genres_text ) and 
                     books.id = books_genres.book_id and books_genres.genre_id = genre.id;";
        }
    }
    if ((!isset($genres) || $genres == null) && isset($authors)) {
        if (count($authors) > 0) {
            $select_query = "SELECT books.* FROM books, books_authors, authors
               WHERE \"$author\" = authors.surname
                        and books.id = books_authors.book_id and books_authors.author_id = authors.id;";
        }
    }
    if (isset($genres) && isset($authors)) {
        if ((count($genres) > 0) && (count($authors) > 0)) {
            $select_query = "SELECT books.* FROM genre, books_genres, books, books_authors, authors
               WHERE genre.title in ( $genres_text ) and \"$author\" = authors.surname and 
                     books.id = books_genres.book_id and books_genres.genre_id = genre.id
                        and books.id = books_authors.book_id and books_authors.author_id = authors.id;";
        } elseif (count($genres) > 0) {
            $select_query = "SELECT books.* FROM genre, books_genres, books
               WHERE genre.title in ( $genres_text ) and 
                     books.id = books_genres.book_id and books_genres.genre_id = genre.id;";
        } elseif (count($authors) > 0) {
            $select_query = "SELECT books.* FROM books, books_authors, authors
               WHERE \"$author\" = authors.surname
                        and books.id = books_authors.book_id and books_authors.author_id = authors.id;";
        } else {
            $select_query = "SELECT * FROM books;";
        }
    }
    if (!isset($genres) && !isset($authors)) {
        $select_query = "SELECT * FROM books;";
    }
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
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
    return $arr;
}

function add_user($name, $email, $password)
{
    if ($name != null && $email != null && $password != null) {
        $con = get_connection();
        $select_query = "INSERT INTO users (name, login, password, role) VALUES ('$name', '$email', '$password', 'USER');";
        mysqli_query($con, $select_query);
    }
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
    return $arr;
}

function delete_from_favourites_by_user_id_and_book_id($user_id, $book_id)
{
    $con = get_connection();
    $select_query = "DELETE FROM favourites_books WHERE favourites_books.user_id = $user_id and favourites_books.book_id = $book_id;";
    mysqli_query($con, $select_query);
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
    if (!empty($authors)){
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
    $select_query = "SELECT min(books.id) as id, books.title as title 
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
    if ($num > 0){
        $select_query .= " and genre.title in ( $genres_text )";
    }
    if (!empty($author)){
        $select_query .= " and \"$author\" = authors.id";
    }
    $select_query .= " group by title;";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $arr[] = $row;
    }
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
    return $arr;
}

function add_to_favourites($book_id, $user_id)
{
    $con = get_connection();
    $select_query = "INSERT INTO favourites_books (user_id, book_id) VALUES ($user_id, $book_id);";
    mysqli_query($con, $select_query);

}

function get_books_by_filters($author_name = '', $author_surname = '', $title = '', $genre = '')
{
    $con = get_connection();
    $arr = array();
    $sql = "SELECT DISTINCT books.id, books.title, books.date, books.pages_count, books.free_count 
            FROM books, books_genres, genre, books_authors, authors WHERE
                                                                             books_genres.book_id = books.id
                                                                             AND books_genres.genre_id = genre.id
                                                                             AND books_authors.author_id = authors.id
                                                                             AND books_authors.book_id = books.id";
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

// Выполнение запроса и вывод результатов

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $arr[] = $row;
    }
    mysqli_close($con);
    return $arr;
}


?>