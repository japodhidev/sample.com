USE test_db_2;
CREATE TABLE IF NOT EXISTS test (id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(20), owner VARCHAR(20), species VARCHAR(20),
age INT, PRIMARY KEY (id));

INSERT INTO test (name, owner, species, age)
 VALUES ('spike', 'foo', 'dog', 6);
INSERT INTO test (name, owner, species, age)
 VALUES ('whiskers', 'bob', 'cat', 2);
 INSERT INTO test (name, owner, species, age)
  VALUES ('macbeth', 'jane', 'goat', 4);
