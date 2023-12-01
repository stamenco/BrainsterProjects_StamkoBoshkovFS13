# BrainsterProjects

Projects Repository

# BrainsterLibrary -> Project02

Project SETUP Before start:

1. Create DATABASE, importing file (brainsterlibrary (populated).sql) is located in folder named "db_files"

   - in "user-info.txt" are information about already created users

2. Go to /source/consts.php and define:

   - "PATH" is location of the project
   - "DB_HOST", "DB_NAME", "DB_USER" and "DB_PASSWORD" are properties about connection to DATABASE
     - "DB_HOST" -> DATABASE server adress (localhost)
     - "DB_NAME" -> DATABASE name (same as you created)
     - "DB_USER" and "DB_PASSWORD" -> DATABASE credentials

3. Go to /source/assets/js/modules.js:
   - at Line 1 set the value of "path" same as "PATH" from point "2" (location of the project)
