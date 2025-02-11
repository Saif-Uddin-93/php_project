DROP TABLE IF EXISTS jamaat_times;
CREATE TABLE jamaat_times (
    date SERIAL Primary Key,
    day TEXT,
    fajr TEXT,
    zuhr TEXT,
    asr TEXT,
    maghrib TEXT,
    isha TEXT
);
