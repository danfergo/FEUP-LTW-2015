CREATE TABLE User (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name VARCHAR,
	password VARCHAR,
	email VARCHAR
);

CREATE TABLE Poll (
	id1 INTEGER PRIMARY KEY AUTOINCREMENT,
  client_id INTEGER,
	description VARCHAR,
	thumbnail VARCHAR,
  privacy VARCHAR,
  created_time INTEGER,
  updated_time INTEGER,
  FOREIGN KEY (client_id) REFERENCES User(id)
);

CREATE TABLE  Question (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  poll_id INTEGER,
  title VARCHAR,
  description VARCHAR,
  n_choices INTEGER,
  idkwhatisthis INTEGER,
  FOREIGN KEY (poll_id) REFERENCES Poll(id)
);

CREATE TABLE  Answer (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  question_id INTEGER,
  title VARCHAR,
  FOREIGN KEY (question_id) REFERENCES Question(id)
);

CREATE TABLE  chooseAnswer (
  user_id INTEGER,
  anwser_id INTEGER,
  title VARCHAR,
  FOREIGN KEY (user_id) REFERENCES User,
  FOREIGN KEY (anwser_id) REFERENCES Answer(id),
  PRIMARY KEY (user_id,anwser_id)
);
