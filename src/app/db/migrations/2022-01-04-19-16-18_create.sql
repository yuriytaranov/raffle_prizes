create table users
(
    id       serial
        constraint users_pk
            primary key,
    email    varchar,
    active   boolean default false,
    password varchar,
    created  timestamp,
    updated  timestamp
);

create unique index users_email_uindex
    on users (email);

create table roles
(
    id      serial
        constraint roles_pk
            primary key,
    name    varchar,
    title   varchar,
    active  boolean,
    created timestamp,
    updated timestamp
);

create unique index roles_name_uindex
    on roles (name);

create table user_role
(
    id      serial,
    user_id integer,
    role_id integer,
    created timestamp,
    updated timestamp
);

create table user_scores
(
    id      serial
        constraint user_scores_pk
            primary key,
    user_id integer,
    amount  numeric,
    created timestamp
);

create table user_money
(
    id      serial,
    user_id integer,
    amount  numeric,
    created timestamp
);

create table user_item
(
    id      serial,
    name    varchar,
    amount  integer,
    created integer
);
create table prizes
(
    id      serial,
    kind    integer,
    amount  numeric,
    active  boolean default true,
    created timestamp,
    updated timestamp
);

