/*Strike A Spark Web Application

Group Members with emails:
Michael Gorse- gor9632@calu.edu
Anthony Carrola- car3766@calu.edu
Paul MacLean- mac7537@calu.edu
Brittany Marietta- mar0274@calu.edu
Ryan Merow- mer3942@calu.edu
Zachary Smith- smi2479@calu.edu
*/

insert into judge
values (001, "Leeroy Jenkins"),
(007, "James Bond"),
(002, "Spongebob Squarepants"),
(003, "Eric Aundrey"),
(004, "John Doe");

insert into poster
values (1, "Investigations into Fibonacci Inequalities", "p"),
(2, "tractatus logico-philosophicus", "p"),
(3, "The Principles of Mathematics", "p"),
(4, "Principia Mathematica", "p"),
(5, "Esquisse d'un programme", "p");

insert into presenter (presenter_name, department, category, academic_level, class_level, area_of_study, sponsor
)
values ("Kyle One", "Biology and Environmental Science", "Class project", "Undergraduate", "Senior", "Liberal Arts", "Dr. Rebecca Regeth"),
("Kyle Two", "Communication Disorders", "Class project", "Graduate", "Graduate", "Education, Health Sciences", "Dr. BeesKnees" ),
("Kyle Three", "Mathematics", "Individual project", "Undergraduate", "Freshmen", "Science Technology Business", "Dr. PeanutButter" ),
("Kyle Four", "Biology", "Individual project", "Undergraduate", "Junior", "Liberal Arts", "Dr. Soandso"),
("Kyle Five", "Chemistry", "Class project", "Graduate", "Graduate", "Science Technology Business", "Dr. Potato");

insert into owns
values (1, 1, "Kyle One"),
(2, 2, "Kyle Two"),
(3, 3, "Kyle Three"),
(4, 4, "Kyle Four"),
(5, 5, "Kyle Five");

insert into scores
/* |judge_ID| |judge_name| |poster_id|
|visual| |clarity| |thoroughtness|
|breadth| |depth| |quality|
|discussion| |understanding| |overall| */
value
(1, "Leeroy Jenkins", 1, 1, 2, 3, 4, 3, 2, 1, 1, 10),
(1, "Leeroy Jenkins", 2, 1, 1, 2, 2, 3, 3, 2, 2, 1),
(2, "Spongebob Squarepants", 1, 2, 3, 1, 2, 3, 1, 1, 3, 2),
(2, "Spongebob Squarepants", 3, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(3, "Eric Aundrey", 1, 1, 1, 1, 2, 3, 2, 2, 3, 1),
(3, "Eric Aundrey", 2, 1, 2, 3, 2, 2, 3, 1, 2, 5),
(3, "Eric Aundrey", 3, 2, 2, 2, 3, 3, 3, 1, 1, 6),
(3, "Eric Aundrey", 4, 1, 1, 2, 3, 3, 1, 2, 2, 5),
(3, "Eric Aundrey", 5, 3, 3, 3, 2, 1, 2, 3, 2, 10),
(4, "John Doe", 1, 1, 2, 3, 4, 2, 1, 2, 1, 3),
(4, "John Doe", 2, 2, 3, 4, 2, 2, 3, 1, 1, 7),
(4, "John Doe", 3, 2, 2, 1, 3, 4, 2, 2, 2, 4),
(4, "John Doe", 4, 2, 1, 1, 3, 2, 3, 2, 3, 2),
(4, "John Doe", 5, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(7, "James Bond", 1, 5, 5, 5, 5, 5, 3, 2, 5, 8),
(7, "James Bond", 2, 2, 3, 4, 2, 3, 4, 2, 3, 4),
(7, "James Bond", 3, 4, 5, 3, 4, 5, 3, 4, 5, 7),
(7, "James Bond", 4, 5, 6, 4, 5, 6, 7, 5, 6, 7),
(7, "James Bond", 5, 2, 3, 4, 2, 4, 3, 5, 6, 10);
