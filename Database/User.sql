CREATE USER IF NOT EXISTS "player"@"localhost" IDENTIFIED BY "dbaw";

SELECT * FROM MySQL.user;

REVOKE ALL PRIVILEGES, GRANT OPTION FROM "player"@"localhost";

FLUSH PRIVILEGES;

GRANT SELECT ON db_memory_game_bl.* TO "player"@"localhost";

FLUSH PRIVILEGES;

SHOW GRANTS FOR "player"@"localhost";