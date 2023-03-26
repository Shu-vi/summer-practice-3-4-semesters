use library;

DELIMITER //

CREATE TRIGGER check_role
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    IF NEW.role NOT IN ('ADMIN', 'USER') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Role should be either ADMIN or USER.';
    END IF;
END//


CREATE FUNCTION check_password_length(password VARCHAR(20))
RETURNS BOOLEAN
DETERMINISTIC
BEGIN
    RETURN CHAR_LENGTH(password) >= 6;
END//

CREATE TRIGGER users_check_password_length
BEFORE INSERT ON users
FOR EACH ROW
BEGIN
    IF NOT check_password_length(NEW.password) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Password must be at least 6 characters long.';
    END IF;
END//

DELIMITER ;