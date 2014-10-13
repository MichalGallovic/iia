// return table
SELECT osoby.`name`, osoby.`surname`, oh.`year`, oh.`city`, oh.`country`, oh.`type`, umiestnenia.`discipline`, umiestnenia.`place`
FROM umiestnenia
INNER JOIN oh
ON umiestnenia.`id_oh`=oh.`id`
INNER JOIN osoby
ON umiestnenia.`id_person`=osoby.`id`
<!--WHERE umiestnenia.`place` <= 3-->

//ordery
ORDER BY type, year DESC
//...

//EDIT
SELECT *
FROM umiestnenia
INNER JOIN osoby
ON umiestnenia.`id_person` = osoby.`id`
INNER JOIN oh
ON umiestnenia.`id_oh` = oh.`id`
<!--WHERE osoby.`id` = 3;-->

// delete cascade osoby
DELETE FROM osoby
WHERE id=$id

//since we have foreign key constraints set
// no need to crawl db for deleting in other tables - automatic
<!--DELETE FROM umiestnenia-->
<!--WHERE id_person=$id;-->

//add primary keys
ALTER TABLE osoby
ADD PRIMARY KEY (id);

ALTER TABLE oh
ADD PRIMARY KEY (id);

ALTER TABLE umiestnenia
ADD CONSTRAINT fk_osoby
FOREIGN KEY (id_person)
REFERENCES osoby(id)
ON DELETE CASCADE;

ALTER TABLE umiestnenia
ADD CONSTRAINT fk_oh
FOREIGN KEY (id_oh)
REFERENCES oh(id)
ON DELETE CASCADE;

