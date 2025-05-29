CREATE DATABASE projeto_tea;
CREATE USER 'dbusertea'@'localhost' IDENTIFIED BY 'ProjetoInterdisciplinar';
GRANT ALL PRIVILEGES ON projeto_tea.* TO 'dbusertea'@'localhost';
FLUSH PRIVILEGES;