use library;

DELIMITER //

CREATE TRIGGER IF NOT EXISTS check_role_insert
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    IF NEW.role NOT IN ('ADMIN', 'USER') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Role should be either ADMIN or USER.';
    END IF;
END//

CREATE TRIGGER IF NOT EXISTS check_role_update
BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
    IF NEW.role NOT IN ('ADMIN', 'USER') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Role should be either ADMIN or USER.';
    END IF;
END//


CREATE FUNCTION IF NOT EXISTS check_password_length(password VARCHAR(20))
RETURNS BOOLEAN
DETERMINISTIC
BEGIN
    RETURN CHAR_LENGTH(password) >= 6;
END//

CREATE TRIGGER IF NOT EXISTS users_check_password_length_insert
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    IF NOT check_password_length(NEW.password) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Password must be at least 6 characters long.';
    END IF;
END//

CREATE TRIGGER IF NOT EXISTS users_check_password_length_update
BEFORE UPDATE ON users
FOR EACH ROW
BEGIN
    IF NOT check_password_length(NEW.password) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Password must be at least 6 characters long.';
    END IF;
END//

DELIMITER ;