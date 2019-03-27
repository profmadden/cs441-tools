# cs441-tools
Toolkit for the project submission website

The database framework is in build.sql; connect to your database using the mysql command line tool, and then "source build.sql" should create all the tables.

The database tables are:
* users, where everyone has a unique integer user ID, their first and last name, email address (used for the log in), and a pass code (integer, also used for log in).  There's a secret session key that might be used in the future.

* submissions are the individual entries; this is tied to the user ID number, and contains the project title, readme, git log, and binary for the uploaded screen shots.  Each project is assigned a unique ID number.

* review contains the individual project reviews -- this is inserted into the database by the project assignment scripts.  Using a list of the submitted projects (with author ID and project number, and the ID number of the user who is assigned to review the project).

* points contains the author id, project number, and then points for each of the grading criteria.  Scripts update this table.

Major scripts are:

* allocpoints.php -- this scans through the entries for a given project number, and fills out the points checking for a readme file, git log, and screen shots.

* votepoints.php -- this computes the average score for each project, based on the reviews from other users.  It updates the points table.

* prespoints.php -- each set of presentations belongs to a different group -- with the first project, the two classes were "group 0" and "group 1."  The second project was groups 2 and 3, and so on.  High scoring projects are added to the "bonus" table with a group number assigned, and then the presentation evaluations are placed into "bonuspoints."  The "prespoints.php" script runs through the scores, and updates the presentation score for each project.

* totalpoints.php -- Scores are build iteratively -- with allocpoints doing the first pass, votepoints doing the secon, and prespoints allocating for the presentations.  totalpoints updates the total.

