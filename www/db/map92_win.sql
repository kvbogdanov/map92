--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: -
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: information; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE information (
    id_inf integer NOT NULL,
    inf_date date NOT NULL,
    cost_oil numeric(7,2) NOT NULL,
    id_user integer NOT NULL,
    id_point integer NOT NULL,
    brand integer
);


--
-- Name: information_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE information_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: information_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE information_id_seq OWNED BY information.id_inf;


--
-- Name: information_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('information_id_seq', 1, false);


--
-- Name: list_brands; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE list_brands (
    id_b integer NOT NULL,
    name_brand character varying(50)
);


--
-- Name: list_brands_id_b_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE list_brands_id_b_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: list_brands_id_b_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE list_brands_id_b_seq OWNED BY list_brands.id_b;


--
-- Name: list_brands_id_b_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('list_brands_id_b_seq', 1, false);


--
-- Name: points; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE points (
    id_p integer NOT NULL,
    coordinate point NOT NULL,
    city_type character varying(10),
    city_name character varying(100) NOT NULL
);


--
-- Name: points_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE points_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: points_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE points_id_seq OWNED BY points.id_p;


--
-- Name: points_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('points_id_seq', 1, false);


--
-- Name: users; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE users (
    id_u integer NOT NULL,
    name character varying(20),
    last_name character varying(30),
    nickname character varying(100),
    email character varying(100),
    id_sn character varying(200),
    login character varying(20) NOT NULL,
    password character varying(1024) NOT NULL,
    ban boolean DEFAULT false NOT NULL
);


--
-- Name: users_id_u_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE users_id_u_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_id_u_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE users_id_u_seq OWNED BY users.id_u;


--
-- Name: users_id_u_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('users_id_u_seq', 1, false);


--
-- Name: id_inf; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY information ALTER COLUMN id_inf SET DEFAULT nextval('information_id_seq'::regclass);


--
-- Name: id_b; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY list_brands ALTER COLUMN id_b SET DEFAULT nextval('list_brands_id_b_seq'::regclass);


--
-- Name: id_p; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY points ALTER COLUMN id_p SET DEFAULT nextval('points_id_seq'::regclass);


--
-- Name: id_u; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY users ALTER COLUMN id_u SET DEFAULT nextval('users_id_u_seq'::regclass);


--
-- Data for Name: information; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: list_brands; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: points; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Name: information_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY information
    ADD CONSTRAINT information_pkey PRIMARY KEY (id_inf);


--
-- Name: list_brands_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY list_brands
    ADD CONSTRAINT list_brands_pkey PRIMARY KEY (id_b);


--
-- Name: points_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY points
    ADD CONSTRAINT points_pkey PRIMARY KEY (id_p);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_u);


--
-- Name: fki_information_fk_brand; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX fki_information_fk_brand ON information USING btree (brand);


--
-- Name: fki_information_fk_user; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX fki_information_fk_user ON information USING btree (id_user);


--
-- Name: information_fk_brand; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY information
    ADD CONSTRAINT information_fk_brand FOREIGN KEY (brand) REFERENCES list_brands(id_b) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: information_fk_point; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY information
    ADD CONSTRAINT information_fk_point FOREIGN KEY (id_point) REFERENCES points(id_p) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: information_fk_user; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY information
    ADD CONSTRAINT information_fk_user FOREIGN KEY (id_user) REFERENCES users(id_u) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: -
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

