CREATE TABLE user (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR,
    password VARCHAR,
    email VARCHAR,
    birthday TEXT
);

CREATE TABLE poll (
    poll_id INTEGER PRIMARY KEY AUTOINCREMENT,
    client_id INTEGER REFERENCES user(user_id),
    description VARCHAR,
    thumbnail VARCHAR,
    privacy VARCHAR,
    created_time TEXT,
    updated_time TEXT
);

CREATE TABLE  question (
    question_id INTEGER PRIMARY KEY AUTOINCREMENT,
    poll_id INTEGER REFERENCES poll(poll_id),
    title VARCHAR,
    description VARCHAR,
    num_possible_choices INTEGER
);

CREATE TABLE  answer (
    answer_id INTEGER PRIMARY KEY AUTOINCREMENT,
    question_id INTEGER REFERENCES question(question_id),
    title VARCHAR
);

CREATE TABLE  choose_answer (
    user_id INTEGER REFERENCES user(user_id),
    anwser_id INTEGER REFERENCES answer(answer_id),
    title VARCHAR,
    PRIMARY KEY (user_id,anwser_id)
);
