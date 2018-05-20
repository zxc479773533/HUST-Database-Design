use dblab01;

delimiter $$
create trigger ZHOUXINGCHI before insert
on FILM for each row
begin
	if new.GRADE > 100 then
		set new.GRADE = 100;
	else if new.GRADE < 0 then
		set new.GRADE = 0;
		end if;
    end if;
    if new.DNAME = "周星驰" then
		set new.FTYPE = "喜剧";
        end if;
end$$

create trigger GRADE_LIMIT before insert
on ACTIN for each row
begin
	if new.GRADE > 100 then
		set new.GRADE = 100;
	else if new.GRADE < 0 then
		set new.GRADE = 0;
		end if;
    end if;
end$$
delimiter ;
