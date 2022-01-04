-- migration create created 2019-08-07-21-23-46

create table `hello`(`id` int auto_increment, `name` varchar(30), `created_at` datetime, `modified_at` datetime default now(), primary key(`id`));