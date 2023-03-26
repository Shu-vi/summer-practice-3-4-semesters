USE library;

CREATE TABLE genre
(
    id    INT         NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE authors
(
    id      INT         NOT NULL AUTO_INCREMENT,
    name    VARCHAR(60) NOT NULL,
    surname VARCHAR(60) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE books
(
    id          INT          NOT NULL AUTO_INCREMENT,
    title       VARCHAR(150) NOT NULL,
    date        DATE         NOT NULL,
    pages_count INT          NOT NULL,
    free_count  INT          NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE users
(
    id       INT         NOT NULL AUTO_INCREMENT,
    login    VARCHAR(35) NOT NULL,
    password VARCHAR(20) NOT NULL,
    role     VARCHAR(20) NOT NULL,
    name     VARCHAR(60) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE favourites_books
(
    id      INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (book_id) REFERENCES books (id)
);

CREATE TABLE books_authors
(
    id        INT NOT NULL AUTO_INCREMENT,
    book_id   INT NOT NULL,
    author_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (book_id) REFERENCES books (id),
    FOREIGN KEY (author_id) REFERENCES authors (id)
);

CREATE TABLE books_genres
(
    id       INT NOT NULL AUTO_INCREMENT,
    book_id  INT NOT NULL,
    genre_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (book_id) REFERENCES books (id),
    FOREIGN KEY (genre_id) REFERENCES genre (id)
);

CREATE TABLE readers
(
    id      INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT          NOT NULL,
    book_id INT          NOT NULL,
    date    DATE         NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (book_id) REFERENCES books (id)
);

INSERT INTO users(login, password, role, name)
VALUES ('admin', '123456', 'ADMIN', 'Егор'),
       ('user', '123456', 'USER', 'Паша');

INSERT INTO genre(title)
VALUES ('Триллер'),
       ('Современная русская и зарубежная проза'),
       ('Мистика'),
       ('Ужасы'),
       ('Фэнтези'),
       ('Боевик'),
       ('Зарубежный детектив'),
       ('Детектив'),
       ('Авантюрный роман'),
       ('Современные любовные романы');

INSERT INTO authors(name, surname)
VALUES ('Стивен', 'Кинг'),
       ('Ларссон', 'Стиг'),
       ('Диккер', 'Жоэль'),
       ('Дэн', 'Браун'),
       ('Даниэль М.', 'Браун'),
       ('Кристина', 'Старк');

INSERT INTO books(title, date, pages_count, free_count)
VALUES ('Зелёная миля', '1996-01-01', 440, 0),
       ('Девушка с татуировкой дракона', '2005-01-01', 321, 1),
       ('Сияние', '1977-01-01', 119, 1),
       ('Правда о деле Гарри Квеберта', '2012-01-01', 800, 1),
       ('Девушка, которая играла с огнем', '2006-01-01', 404, 1),
       ('Долгая прогулка', '1979-01-01', 550, 4),
       ('Мизери', '1987-01-01', 560, 1),
       ('Ангелы и демоны', '2000-01-01', 213, 1),
       ('Стигмалион', '2018-01-01', 313, 1);

INSERT INTO books_genres(book_id, genre_id)
VALUES (1, 1),
       (2, 1),
       (1, 2),
       (1, 3),
       (1, 4),
       (1, 5),
       (2, 6),
       (2, 7),
       (2, 2),
       (2, 8),
       (3, 1),
       (3, 4),
       (3, 3),
       (3, 8),
       (3, 5),
       (4, 1),
       (4, 8),
       (5, 1),
       (5, 8),
       (6, 1),
       (6, 8),
       (7, 1),
       (7, 4),
       (8, 6),
       (8, 9),
       (8, 1),
       (9, 1),
       (9, 10),
       (9, 8);

INSERT INTO books_authors(book_id, author_id)
VALUES (1, 1),
       (2, 2),
       (3, 1),
       (4, 3),
       (5, 2),
       (6, 1),
       (7, 1),
       (8, 4),
       (8, 5),
       (9, 6);