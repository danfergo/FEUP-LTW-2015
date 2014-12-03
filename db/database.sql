/*DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS poll;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS answer;
DROP TABLE IF EXISTS choose_answer;
DROP TABLE IF EXISTS messages;
DROP VIEW IF EXISTS answer_chosen;
DROP VIEW IF EXISTS num_answer;*/

CREATE TABLE user (
  user_id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT,
  password TEXT,
  email TEXT,
  birthday TEXT
);

CREATE TABLE poll (
  poll_id INTEGER PRIMARY KEY AUTOINCREMENT,
  owner_id INTEGER REFERENCES user(user_id),
  title TEXT,
  description TEXT,
  privacy INTEGER,
  created_time TEXT,
  updated_time TEXT
);

CREATE TABLE  question (
  question_id INTEGER PRIMARY KEY AUTOINCREMENT,
  poll_id INTEGER REFERENCES poll(poll_id),
  title TEXT,
  description TEXT,
  min_possible_choices INTEGER,
  max_possible_choices INTEGER
);

CREATE TABLE  answer (
  answer_id INTEGER PRIMARY KEY AUTOINCREMENT,
  question_id INTEGER REFERENCES question(question_id),
  title TEXT
);

CREATE TABLE  choose_answer (
  user_id INTEGER REFERENCES user(user_id),
  answer_id INTEGER REFERENCES answer(answer_id),
  PRIMARY KEY (user_id,answer_id)
);

CREATE TABLE messages (
  message_id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER,
  e_mail TEXT,
  name TEXT,
  message TEXT
);


CREATE VIEW answer_chosen AS
  SELECT question.question_id,answer.answer_id,question.poll_id,choose_answer.user_id
  FROM answer, question, choose_answer
  WHERE answer.question_id = question.question_id
        AND choose_answer.answer_id = answer.answer_id
;

CREATE VIEW num_answer AS
  SELECT answer_id, question_id, poll_id, COUNT(*) AS counter
  FROM answer_chosen
  GROUP BY question_id, poll_id,answer_id
;