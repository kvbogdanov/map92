
CREATE TABLE public.points (
    id serial,
    coordinate point,
    city_type varchar(10),
    city_name varchar(100),
    id_user integer,
CONSTRAINT points_pkey PRIMARY KEY (id)
) WITHOUT OIDS;


CREATE TABLE public.information (
    id serial,
    u_date date,
    cost numeric(7,2),
    id_user integer,
    id_point integer,
    status varchar(100),
CONSTRAINT information_pkey PRIMARY KEY (id),
CONSTRAINT information_fk_point FOREIGN KEY (id_point) REFERENCES points(id) ON UPDATE CASCADE ON DELETE CASCADE
) WITHOUT OIDS;
