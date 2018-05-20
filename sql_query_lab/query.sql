use dblab01;

-- Question 01
select *
from FILM, ONSHOW, THEATER
where FILM.FID=ONSHOW.FID and ONSHOW.TID=THEATER.TID
	and FNAME="战狼一" and TAREA="洪山区" and YEAR=2017;

-- Question 02
select *
from FILM
where not exists(
	select *
    from ACTIN
    where FILM.FID=ACTIN.FID
)
order by FNAME ASC, GRADE DESC;

-- Question 03
select FID, FNAME, DNAME
from FILM
where FID in(
	select FID
    from ONSHOW
    group by FID
    having MAX(YEAR) < 2018
);

-- Question 04
select FID
from (
	select distinct FID, count(FID) as NUM
	from ONSHOW, THEATER
	where ONSHOW.TID=THEATER.TID
	group by FID
) as FO_NUM
where FO_NUM.NUM in (
	select count(*) as NUM
    from THEATER
);

-- Question 05
select FID, FNAME, DNAME, GRADE
from FILM
where GRADE not between 80 and 89;

-- Question 06
select DNAME, max(GRADE) as MAXGRADE, min(GRADE) MINGRADE
from FILM
group by DNAME;

-- Qusetion 07
select DNAME, count(DNAME) as NUM
from FILM
group by DNAME
having NUM >= 2;

-- Question 08
select DNAME, count(DNAME) as NUM, avg(GRADE) as AVG_GRADE
from FILM
where DNAME in (
	select DNAME
	from FILM
	where GRADE > 80
	group by DNAME
	having count(DNAME) >= 2
)
group by DNAME;

-- Question 09
select distinct DNAME, ACTOR.ACTID, ANAME
from FILM, ACTIN, ACTOR
where DNAME in (
	select DNAME
	from FILM
	group by DNAME
	having count(DNAME) >= 2
) and FILM.FID=ACTIN.FID and ACTIN.ACTID=ACTOR.ACTID;

-- Question 10
select ANAME, avg(ACTIN.GRADE) as AVG_GRADE
from FILM, ACTIN, ACTOR
where FILM.FID=ACTIN.FID and ACTIN.ACTID=ACTOR.ACTID
	and ISLEADING="Y"
group by ANAME;

-- Question 11
select FNAME, MIN_YEAR, min(MONTH) as MIN_MONTH
from (
	select FILM.FID, FNAME, min(YEAR) as MIN_YEAR
	from FILM, ONSHOW
	where FILM.FID=ONSHOW.FID and GRADE > 80
	group by FNAME
) as FMY, ONSHOW
where FMY.FID=ONSHOW.FID
group by FNAME;

-- Question 12
select FNAME, MIN_YEAR, min(MONTH) as MIN_MONTH, TID
from (
	select FILM.FID, FNAME, min(YEAR) as MIN_YEAR
	from FILM, ONSHOW
	where FILM.FID=ONSHOW.FID and GRADE > 80
	group by FNAME
) as FMY, ONSHOW
where FMY.FID=ONSHOW.FID
group by FNAME;

-- Question 13
select FNAME, count(FNAME)
from FILM, ONSHOW
where FILM.FID=ONSHOW.FID
group by FNAME;

-- Question 14
select distinct DNAME
from FILM
where FTYPE in ("动作", "警匪", "枪战");

-- Question 15
select FILM.FID, DNAME, TNAME, YEAR, MONTH
from FILM, ONSHOW, THEATER
where FILM.FID=ONSHOW.FID and ONSHOW.TID=THEATER.TID
	and FNAME like "战狼%";

-- Question 16
select osa.TID
from ONSHOW osa, ONSHOW osb
where osa.FID=1 and osb.FID=2
	and osa.YEAR=osb.YEAR and osa.MONTH=osb.MONTH;

-- Question 17
select distinct ACTOR.ACTID, ANAME
from ACTOR, ACTIN
where ACTOR.ACTID=ACTIN.ACTID
	and FID not in (
		select FID
		from FILM
		where GRADE < 85
    );

-- Question 18
select distinct ANAME
from ACTOR, ACTIN
where ACTOR.ACTID=ACTIN.ACTID
	and FID in (
		select FID
		from FILM
		where DNAME="吴宇森"
    );

-- Question 19
select ACTOR.ACTID, ANAME, FILM.FNAME
from ACTIN left join FILM on (ACTIN.FID=FILM.FID)
	right join ACTOR on (ACTIN.ACTID=ACTOR.ACTID);

-- Question 20
select FID, FNAME
from FILM
where FNAME in (
	select FNAME
	from FILM, ONSHOW
	where FILM.FID=ONSHOW.FID
	group by FNAME
	having count(FNAME) >= 3
) and GRADE is null;