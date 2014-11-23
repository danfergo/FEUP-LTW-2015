CREATE TABLE User (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name VARCHAR,
	password VARCHAR,
	email VARCHAR,
  birthday TEXT
);

CREATE TABLE Poll (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
  client_id INTEGER REFERENCES User(id),
	description VARCHAR,
	thumbnail VARCHAR,
  privacy VARCHAR,
  created_time TEXT,
  updated_time TEXT
);

CREATE TABLE  Question (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  poll_id INTEGER REFERENCES Poll(id),
  title VARCHAR,
  description VARCHAR,
  num_possible_choices INTEGER
);

CREATE TABLE  Answer (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  question_id INTEGER REFERENCES Question(id),
  title VARCHAR
);

CREATE TABLE  chooseAnswer (
  user_id INTEGER REFERENCES User(id),
  anwser_id INTEGER REFERENCES Answer(id),
  title VARCHAR,
  PRIMARY KEY (user_id,anwser_id)
);
