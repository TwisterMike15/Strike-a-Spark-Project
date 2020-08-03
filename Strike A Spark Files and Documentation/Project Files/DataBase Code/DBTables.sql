/*Strike A Spark Web Application

Group Members with emails:
Michael Gorse- gor9632@calu.edu
Anthony Carrola- car3766@calu.edu
Paul MacLean- mac7537@calu.edu
Brittany Marietta- mar0274@calu.edu
Ryan Merow- mer3942@calu.edu
Zachary Smith- smi2479@calu.edu
*/

create table judge
(    judge_ID int auto_increment 
,    judge_name varchar(50)
,    primary key (judge_ID, judge_name)
);

create table poster
(    poster_ID int
,    title varchar(50)
,    primary key (poster_ID)
);

create table presenter
(    presenter_ID int auto_increment
,    presenter_name varchar(50)
,    title varchar(50)
,    department varchar(50)
,    category varchar(50)
,    academic_level varchar(50)
,    class_level varchar(50)
,    area_of_study varchar(50)
,    sponsor varchar(50)
,    primary key (presenter_ID, presenter_name)
);

create table scores
(    judge_ID int
,    judge_name varchar(50)
,    poster_ID int
,    visual int
,    clarity int
,    thoroughness int
,    breadth int
,    depth int
,    quality int
,    discussion int
,    understanding int
,    overall int
,    total int
,    constraint FK_JudgeScores
    foreign key (judge_ID, judge_name) references judge (judge_ID, judge_name)
,    constraint FK_PosterScores
    foreign key (poster_ID) references poster (poster_ID)
);

create table owns
(    poster_ID int
,    presenter_ID int
,    presenter_name varchar(50)
,    constraint FK_PosterOwns
    foreign key (poster_ID) references poster (poster_ID)
,    constraint FK_PresenterOwns
    foreign key (presenter_ID, presenter_name) references presenter (presenter_ID, presenter_name)
);