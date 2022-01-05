create table users
(
    id       int auto_increment,
    email    varchar(50)                  not null,
    active   tinyint(1) default 0     not null,
    password varchar(72)              not null,
    created  datetime   default now() not null,
    updated  datetime   default now() not null,
    constraint users_pk
        primary key (id)
);

create unique index users_email_uindex
    on users (email);

create unique index users_id_uindex
    on users (id);

create table roles
(
    id      int auto_increment,
    name    varchar(100)                  not null,
    title   varchar(255)                  not null,
    active  tinyint(1) default 1     not null,
    created datetime   default now() not null,
    updated datetime   default now() not null,
    constraint table_name_pk
        primary key (id)
);

create unique index roles_id_uindex
    on roles (id);

create table user_role
(
    id      int auto_increment,
    user_id int                    not null,
    role_id int                    not null,
    created datetime default now() not null,
    updated datetime default now() not null,
    constraint user_role_pk
        primary key (id)
);

create table user_scores
(
    id      int auto_increment,
    user_id int                    not null,
    amount  decimal                not null,
    created datetime default now() not null,
    constraint user_scores_pk
        primary key (id)
);

create unique index user_scores_id_uindex
    on user_scores (id);


create table user_money
(
    id      int auto_increment,
    user_id int                    not null,
    amount  decimal                not null,
    status tinyint(1) not null,
    created datetime default now() not null,
    constraint user_money_pk
        primary key (id)
);

create unique index user_money_id_uindex
    on user_money (id);

create table user_item
(
    id        int auto_increment,
    name      varchar(255)                  not null,
    amount    decimal                  not null,
    status tinyint(1) not null,
    has_taken tinyint(1) default 0     not null,
    created   datetime   default now() not null,
    constraint user_item_pk
        primary key (id)
);

create unique index user_item_id_uindex
    on user_item (id);

create table prizes
(
    id      int auto_increment,
    kind    int                      not null,
    amount  decimal                  not null,
    active  tinyint(1) default 1     not null,
    created datetime   default now() not null,
    updated datetime   default now() not null,
    constraint prizes_pk
        primary key (id)
);

create unique index prizes_id_uindex
    on prizes (id);

