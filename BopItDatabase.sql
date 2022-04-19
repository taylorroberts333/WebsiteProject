/*CREATE SCHEMA BOP_IT;*/

CREATE TABLE colors (
    color varchar(255)
);

CREATE TABLE userInfo (
    username varchar(255),
    password varchar(255)
);

CREATE TABLE scores (
    username varchar(255),
    score int
);

INSERT INTO colors (color) value ('blue');
INSERT INTO colors (color) value ('green');
INSERT INTO colors (color) value ('yellow');
INSERT INTO colors (color) value ('red');
INSERT INTO colors (color) value ('orange');
INSERT INTO colors (color) value ('purple');
INSERT INTO colors (color) value ('pink');