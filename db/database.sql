CREATE TABLE user (
    user_id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR,
    password VARCHAR,
    email VARCHAR,
    birthday TEXT
);

CREATE TABLE poll (
    poll_id INTEGER PRIMARY KEY AUTOINCREMENT,
    owner_id INTEGER REFERENCES user(user_id),
    title TEXT,
    description VARCHAR,
    privacy INTEGER,
    created_time TEXT,
    updated_time TEXT
);

CREATE TABLE  question (
    question_id INTEGER PRIMARY KEY AUTOINCREMENT,
    poll_id INTEGER REFERENCES poll(poll_id),
    title VARCHAR,
    description VARCHAR,
    min_possible_choices INTEGER,
    max_possible_choices INTEGER
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
