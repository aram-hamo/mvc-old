CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  firstName TEXT ,
  lastName TEXT ,
  username TEXT UNIQUE,
  password TEXT,
  email TEXT,
  verified BOOLEAN,
  tokan TEXT UNIQUE
);
