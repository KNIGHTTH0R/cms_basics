In order for the system to work you first need to set up the data base.

Database conecction is defined in a file called db_connection

Database tables and fields go as follow:
1.mysql> show tables
    -> ;
+-------------------+
| Tables_in_leosoft |
+-------------------+
| categorias        |
| menu              |
| pages             |
| terceros          |
| usuarios          |
+-------------------+
5 rows in set (0.00 sec)


2.mysql> describe menu;
+-----------+-------------+------+-----+---------+----------------+
| Field     | Type        | Null | Key | Default | Extra          |
+-----------+-------------+------+-----+---------+----------------+
| menu_id   | int(11)     | NO   | PRI | NULL    | auto_increment |
| menu_name | varchar(30) | NO   |     | NULL    |                |
| position  | int(3)      | NO   |     | NULL    |                |
| visible   | tinyint(1)  | NO   |     | NULL    |                |
+-----------+-------------+------+-----+---------+-------

3.mysql> describe pages
    -> ;
+-----------+-------------+------+-----+---------+----------------+
| Field     | Type        | Null | Key | Default | Extra          |
+-----------+-------------+------+-----+---------+----------------+
| id        | int(11)     | NO   | PRI | NULL    | auto_increment |
| menu_id   | int(11)     | NO   | MUL | NULL    |                |
| menu_name | varchar(30) | NO   |     | NULL    |                |
| position  | int(3)      | NO   |     | NULL    |                |
| content   | text        | YES  |     | NULL    |                |
| visible   | int(3)      | YES  |     | NULL    |                |
+-----------+-------------+------+-----+---------+----------------+
6 rows in set (0.01 sec)


Other info about tables will be uploaded soon. For now the system should work with those tables.


