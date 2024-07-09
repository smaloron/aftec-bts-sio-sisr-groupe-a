SELECT IF(ISNULL(user_id), "total",userfullname) as label , count(*) as nb
FROM 
tasks inner join users on user_id = users.id
GROUP BY user_id
WITH ROLLUP;