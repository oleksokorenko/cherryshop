SELECT `phone` AS 'tel', `email` as 'mail' FROM `users` WHERE `name` = 'olek'
-- wybor po imieniu a potem zmienili pole
SELECT `phone` AS 'tel', `email` as 'mail' ,`name` FROM `users` WHERE `name` LIKE '%t%'
-- szuka po literze znak % znaczy gdzie to  jest
SELECT * FROM `users` WHERE `name` LIKE '%t%' ORDER BY `id` DESC LIMIT 2
-- order by -> wyruwnanie desc/asc 
SELECT `name` FROM `users` WHERE `id` = ( SELECT `user` FROM `orders` WHERE `status` = 'received')
-- pod zapros 
SELECT * FROM `users` WHERE `email` REGEXP '[:a-z:]@[:a-z:][:.com:]'
-- Справка по составлению регулярных выражений
SELECT * FROM `users` WHERE `id` >= 2
SELECT * FROM `users` WHERE `id` <> 2
SELECT * FROM `products` WHERE `description` is not null
-- null pusto
SELECT * from `products` WHERE `title` in ('t-short' , 'short')
-- in pereczen towarow
SELECT COUNT(*) from `users` 
-- count ilosc danych zlicza
SELECT MAX(id) FROM `users`
-- max znacz.pola
SELECT * from `users` INNER JOIN `orders` on `users`.`id` = `orders`.`user` where `users`.`name` = "tolik"
-- slijanie tablic(join tablicy)
SELECT * from `users` u INNER JOIN `orders` o on u.`id` = o.`user` where u.`name` = "tolik"
-- aliasy skrot tablic(users=u, orders=o) 
SELECT u.`phone`, u.`email`, u.`name` AS 'user', o.`date`, o.`fullprise`, o.`address`, o.`discount`from `users` u INNER JOIN `orders` o on u.`id` = o.`user` where u.`name` = "tolik"
-- pole kotoryje nuzno pokazac
SELECT u.`phone`, u.`email`, u.`name` AS 'user', 
o.`date`, o.`fullprise`, o.`address`, o.`discount`,
pur.`total`,
p.`description`, p.`img`, p.`prise`, p.`title`,
s.`value` AS 'size',
c.`label` AS 'color'
from `users` u 
INNER JOIN `orders` o on u.`id` = o.`user` 
INNER JOIN `purchers_by_order` pbo on o.`id` = pbo.`order`
INNER JOIN `purchases` pur on pbo.`purchase` = pur.`id`
INNER JOIN `products` p on pur.`product` = p.`id`
INNER JOIN `colors` c on pur.`color` = c.`id`
INNER JOIN `sizes` s on pur.`size` = s.`id`
where o.`id` = 1
-- polnaja infa o zakazie
SELECT u.`phone`, u.`email`, u.`name` AS 'user', 
o.`date`, o.`fullprise`, o.`address`, o.`discount`,
pur.`total`, 
GROUP_CONCAT(p.`title`) AS 'titles',
GROUP_CONCAT(pur.`total`) AS 'totals',
GROUP_CONCAT(s.`value`) AS 'sizes',
GROUP_CONCAT(c.`label`) AS 'colors',
SUM(pur.`total`) AS 'total_count'
from `users` u 
INNER JOIN `orders` o on u.`id` = o.`user` 
INNER JOIN `purchers_by_order` pbo on o.`id` = pbo.`order`
INNER JOIN `purchases` pur on pbo.`purchase` = pur.`id`
INNER JOIN `products` p on pur.`product` = p.`id`
INNER JOIN `colors` c on pur.`color` = c.`id`
INNER JOIN `sizes` s on pur.`size` = s.`id`
where o.`id` = 1
-- infa o zakazie (polnaja)
-- jak niema znaczenia pola,w tablece LEFT JOIN (pole budet so znaczeniem NULL)
INSERT INTO `users` (`email`,`name`,`phone`) VALUES ('erfff@mai.ru', 'NIKOLA', '+380978503747')
-- dawac nowego usera
INSERT INTO `products` (`description`, `price`,`title`, `img`) VALUES ('didd', 134, 'cap is yellow', 'img/dg'),
('didwwd', 13, 'cap is blur', 'img/dkig'),
(NULL, 134, 'cap is yello]]]w', 'img/dgplmokjn')
-- VALUES!!! mozna dodac mnogo zapisej odnim zaprosom
INSERT INTO `users` SET `email` = 'didujsi@cuhj.com', `name` = 'Ivan', `phone` = '+380975674534'
-- 2 warian dodawac nomego usera kak stroka 60
UPDATE `products` SET `title` = 'cap', `description` = 'yes good', `price` = 25
WHERE `description` is NULL
-- redaktirowac zapis ile obnowlenie 1 ili neskolko zawisimo od uslowia (WHERE OBEZATELNO!!!)
DELETE FROM `products` WHERE `title` LIKE 'cap%'
-- delete iz tablicy (WHERE!!!) JEST OBEZATELNO


-- zapros towarow 


SELECT p.`id`, pr.`title`, pr.`price`, pr.`description`, pr.`img`, s.`value` AS 'size', c.`label` AS 'color', p.`amount`
FROM `purchases` p 
INNER JOIN `products` pr ON p.`product` = pr.`id`
INNER JOIN `colors` c ON p.`color` = c.`id`
INNER JOIN `sizes` s ON p.`size` = s.`id`