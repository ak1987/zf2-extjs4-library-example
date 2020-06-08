--
-- PostgreSQL database dump
--

-- Dumped from database version 10.12 (Ubuntu 10.12-0ubuntu0.18.04.1)
-- Dumped by pg_dump version 10.12 (Ubuntu 10.12-0ubuntu0.18.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: author; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.author (
    id integer NOT NULL,
    name character varying(64) NOT NULL
);


ALTER TABLE public.author OWNER TO postgres;

--
-- Name: author_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.author_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.author_id_seq OWNER TO postgres;

--
-- Name: author_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.author_id_seq OWNED BY public.author.id;


--
-- Name: book; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.book (
    id integer NOT NULL,
    isbn bigint,
    author_id integer NOT NULL,
    title character varying(127) NOT NULL
);


ALTER TABLE public.book OWNER TO postgres;

--
-- Name: book_exemplar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.book_exemplar (
    id integer NOT NULL,
    book_id integer NOT NULL,
    user_id integer
);


ALTER TABLE public.book_exemplar OWNER TO postgres;

--
-- Name: book_exemplar_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.book_exemplar_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.book_exemplar_id_seq OWNER TO postgres;

--
-- Name: book_exemplar_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.book_exemplar_id_seq OWNED BY public.book_exemplar.id;


--
-- Name: book_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.book_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.book_id_seq OWNER TO postgres;

--
-- Name: book_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.book_id_seq OWNED BY public.book.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    email character varying(32) NOT NULL,
    password_hash character(32) NOT NULL,
    salt character(32) NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: author id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.author ALTER COLUMN id SET DEFAULT nextval('public.author_id_seq'::regclass);


--
-- Name: book id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book ALTER COLUMN id SET DEFAULT nextval('public.book_id_seq'::regclass);


--
-- Name: book_exemplar id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book_exemplar ALTER COLUMN id SET DEFAULT nextval('public.book_exemplar_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: author; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.author (id, name) FROM stdin;
1	Shakespeare, William
2	King, Stephen
3	Bukowski, Charles
4	Seneca
5	Tolstoy, Leo
6	Dostoevsky, Fyodor
7	Hemingway, Ernest
8	Alighieri, Dante
9	Aristotle
\.


--
-- Data for Name: book; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.book (id, isbn, author_id, title) FROM stdin;
1	9781626860988	1	The Complete Works of William Shakespeare (Leather-bound Classics)
2	9780743477109	1	Macbeth (Folger Shakespeare Library)
3	9781982137977	2	If It Bleeds
4	9781982110567	2	The Institute: A Novel
5	9780876856833	3	You Get So Alone at Times That It Just Makes Sense
6	9780061177590	3	Women: A Novel
7	9781941129425	4	On The Shortness Of Life
8	9780691175577	4	How to Die: An Ancient Guide to the End of Life (Ancient Wisdom for Modern Readers)
9	9781400079988	5	War and Peace (Vintage Classics)
10	9781537188485	5	The Kingdom of God is Within You
11	9780374528379	6	The Brothers Karamazov
12	9780679734505	6	Crime and Punishment: Pevear & Volokhonsky Translation (Vintage Classics)
13	9780684801223	7	The Old Man and The Sea
14	9780684803357	7	For Whom the Bell Tolls
15	9780679433132	8	The Divine Comedy: Inferno; Purgatorio; Paradiso (Everyman's Library)
16	9780199540655	8	Vita Nuova (Oxford World's Classics)
17	9780342236275	9	The Nicomachean Ethics of Aristotel
\.


--
-- Data for Name: book_exemplar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.book_exemplar (id, book_id, user_id) FROM stdin;
1	1	\N
2	1	\N
3	1	\N
4	1	\N
5	2	\N
6	2	\N
7	2	\N
8	3	\N
9	4	\N
10	5	\N
11	6	\N
12	7	\N
13	8	\N
14	9	\N
15	10	\N
16	11	\N
17	12	\N
18	13	\N
19	14	\N
20	15	\N
21	16	\N
22	17	\N
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, email, password_hash, salt) FROM stdin;
\.


--
-- Name: author_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.author_id_seq', 9, true);


--
-- Name: book_exemplar_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.book_exemplar_id_seq', 22, true);


--
-- Name: book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.book_id_seq', 17, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 1, false);


--
-- Name: author author_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.author
    ADD CONSTRAINT author_name_key UNIQUE (name);


--
-- Name: author author_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.author
    ADD CONSTRAINT author_pkey PRIMARY KEY (id);


--
-- Name: book_exemplar book_exemplar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book_exemplar
    ADD CONSTRAINT book_exemplar_pkey PRIMARY KEY (id);


--
-- Name: book book_isbn_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book
    ADD CONSTRAINT book_isbn_key UNIQUE (isbn);


--
-- Name: book book_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book
    ADD CONSTRAINT book_pkey PRIMARY KEY (id);


--
-- Name: user user_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_email_key UNIQUE (email);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: book_author_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX book_author_id ON public.book USING btree (author_id);


--
-- Name: book_exemplar_book_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX book_exemplar_book_id ON public.book_exemplar USING btree (book_id);


--
-- Name: book_exemplar_user_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX book_exemplar_user_id ON public.book_exemplar USING btree (user_id);


--
-- Name: book book_author_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book
    ADD CONSTRAINT book_author_id_fkey FOREIGN KEY (author_id) REFERENCES public.author(id) ON DELETE CASCADE;


--
-- Name: book_exemplar book_exemplar_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book_exemplar
    ADD CONSTRAINT book_exemplar_book_id_fkey FOREIGN KEY (book_id) REFERENCES public.book(id) ON DELETE CASCADE;


--
-- Name: book_exemplar book_exemplar_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book_exemplar
    ADD CONSTRAINT book_exemplar_user_id_fkey FOREIGN KEY (user_id) REFERENCES public."user"(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--
