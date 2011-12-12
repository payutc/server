<?php
set_include_path(dirname( _FILE_ ).'/../');
require_once 'db/Db_buckutt.class.php';
require_once 'db/Mysql.class.php';
$db = Db_buckutt::getInstance();

//TABLE TS_USER_USR (buckutt_user et buckutt_user_identity)
/*
$res = $db->query("
SELECT 
u.id_user, 
u.pass, 
i.firstname, 
i.lastname, 
i.nickname, 
i.mail, 
u.credit, 
u.id_image, 
u.temporary, 
u.fail_auth, 
u.blocked 
FROM 
buckutt_user u, 
buckutt_user_identity i 
WHERE u.id_user = i.id_user 
ORDER BY u.id_user;
		",array());
		

while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO ts_user_usr (usr_id, usr_pwd, usr_firstname, usr_lastname, usr_nickname, usr_mail, usr_credit, img_id, usr_temporary, usr_fail_auth, usr_blocked) VALUES('%u', '%s', '%s', '%s', '%s', '%s', '%u', '%u', '%u', '%u', '%u');", Array($don['id_user'], $don['pass'], $don['firstname'], $don['lastname'], $don['nickname'], $don['mail'], $don['credit'], $don['id_image'], $don['temporary'], $don['fail_auth'], $don['blocked']));
	echo $don['id_user'].'<br />';
}
*/

//TABLE TJ_USR_MOL_JUM (buckutt_user_mean_of_login)
/*
$res = $db->query("SELECT data, id_mean, id_user FROM buckutt_user_mean_of_login",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO tj_usr_mol_jum (usr_id, mol_id, jum_data) VALUES('%u', '%u', '%s');", Array($don['id_user'], $don['id_mean'], $don['data']));
	//echo $don['id_user'].'<br />';
}
*/

//TABLE tj_usr_rig_jur & t_period_per (buckutt_link_user_droit)
/*
$res = $db->query("SELECT id, id_user, id_droit, date_start, date_end, id_fundation, id_point, removed FROM buckutt_link_user_droit",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO t_period_per (fun_id, per_date_start, per_date_end) VALUES('%u','%s', '%s');", Array($don['id_fundation'], $don['date_start'], $don['date_end']));
	$per_id = $db->insertId();
	$db->query("INSERT INTO tj_usr_rig_jur (jur_id, usr_id, rig_id, per_id, fun_id, poi_id, jur_removed) VALUES('%u', '%u', '%u', '%u', '%u', '%u', '%u');", Array($don['id'], $don['id_user'], $don['id_droit'], $per_id, $don['id_fundation'], $don['id_point'], $don['removed']));
	echo $don['date_start'].'<br />';
}
*/

//TABLE tj_usr_grp_jug & t_period_per (buckutt_link_user_group)
/*
$res = $db->query("SELECT id, id_user, id_group, date_start, date_end, removed FROM buckutt_link_user_group",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO t_period_per (fun_id, per_date_start, per_date_end) VALUES('%u','%s', '%s');", Array(0, $don['date_start'], $don['date_end']));
	$per_id = $db->insertId();
	$db->query("INSERT INTO tj_usr_grp_jug (jug_id, usr_id, grp_id, per_id, jug_removed) VALUES('%u', '%u', '%u', '%u', '%u');", Array($don['id'], $don['id_user'], $don['id_group'], $per_id, $don['removed']));
	echo $don['date_start'].'<br />';
}
*/

//TABLE t_object_obj & buckutt_object (buckutt_categorie)
/*
$res = $db->query("SELECT id_object, name_object, isunique, stock, id_image, id_fundation, o.removed FROM buckutt_object o, buckutt_categorie c WHERE o.id_categorie = c.id_categorie",array());
while ($don = $db->fetchArray($res)) {
	if ($don['stock'] > 147483647)
		$stock = '-1';
	else
		$stock = $don['stock'];
	$db->query("INSERT INTO t_object_obj (obj_id, obj_name, obj_type, obj_stock, obj_single, img_id, fun_id, obj_removed) VALUES('%u', '%s', 'product', '%d', '%u', '%u', '%u', '%u');", Array($don['id_object'], $don['name_object'], $stock, $don['isunique'], $don['id_image'], $don['id_fundation'], $don['removed']));
	echo $don['id_object'].'<br />';
}
*/

//TABLE tj_obj_poi_jop & buckutt_point_constraint
/*
$res = $db->query("SELECT id_point, id_object FROM buckutt_point_constraint",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO tj_obj_poi_jop (obj_id, poi_id) VALUES('%u', '%u');", Array($don['id_object'], $don['id_point']));
	echo $don['id_object'].'<br />';
}
*/

//TABLE t_price_pri & buckutt_prix
/*
$res = $db->query("SELECT id_prix, id_group, id_object, credit, removed FROM buckutt_prix",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO t_price_pri (pri_id, obj_id, grp_id, per_id, pri_credit, pri_removed) VALUES('%u', '%u', '%u', '%u', '%u', '%u');", Array($don['id_prix'], $don['id_object'], $don['id_group'], 1515, $don['credit'], $don['removed']));
	echo $don['id_object'].'<br />';
}
*/

//TABLE t_sale_sal & buckutt_vente
/*
$res = $db->query("SELECT id_vente, id_object, name, removed FROM buckutt_vente",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO t_sale_sal (sal_id, sal_name, per_id, obj_id, sal_removed) VALUES('%u', '%s', '%u', '%u', '%u');", Array($don['id_vente'], $don['name'], 1515, $don['id_object'], $don['removed']));
	echo $don['id_object'].'<br />';
}
*/
  	
//TABLE t_recharge_rec & buckutt_recharge
/*
$res = $db->query("SELECT id_recharge, id_type_recharge, id_user, id_operateur, id_point, date, credit, trace, removed FROM buckutt_recharge",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO t_recharge_rec (rec_id, rty_id, usr_id_buyer, usr_id_operator, poi_id, rec_date, rec_credit, rec_trace, rec_removed) VALUES('%u', '%u', '%u', '%u', '%u', '%s', '%u', '%s', '%u');", Array($don['id_recharge'], $don['id_type_recharge'], $don['id_user'], $don['id_operateur'], $don['id_point'], $don['date'], $don['credit'], $don['trace'], $don['removed']));
	echo $don['id_object'].'<br />';
}
*/

//TABLE t_purchase_pur & buckutt_historique
/*
$res = $db->query("SELECT h.id_historique, h.date, o.id_object, h.credit, h.id_user, h.id_seller, h.id_point, h.id_fundation, h.ip, h.removed FROM buckutt_historique h LEFT JOIN buckutt_object o ON  h.object = o.name_object",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO t_purchase_pur (pur_id, pur_date, pur_type, obj_id, pur_price, usr_id_buyer, usr_id_seller, poi_id, fun_id, pur_ip, pur_removed) VALUES('%u', '%s', '%s', '%u', '%u', '%u', '%u', '%u', '%u', '%s', '%u');", Array($don['id_historique'], $don['date'], 'product', $don['id_object'], $don['credit'], $don['id_user'], $don['id_seller'], $don['id_point'], $don['id_fundation'], $don['ip'], $don['removed']));
	echo $don['id_object'].'<br />';
}
*/

//SELECT h.object, h.id_object, o.name_object, o.id_object FROM buckutt_historique h LEFT JOIN buckutt_object o ON  h.object = o.name_object
//SELECT h.object, h.id_object, o.name_object, o.id_object FROM buckutt_historique h LEFT JOIN buckutt_object o ON  h.object = o.name_object AND o.name_object IS NULL GROUP BY h.object

//TABLE t_object_obj & buckutt_categorie
/*
$res = $db->query("SELECT id_fundation, name_categorie, removed FROM buckutt_categorie",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO t_object_obj (obj_name, obj_type, fun_id, obj_removed) VALUES('%s', '%s', '%u', '%u');", Array($don['name_categorie'], 'category', $don['id_fundation'], $don['removed']));
	echo $don['id_object'].'<br />';
}
*/

//TABLE t_sherlocks_she & buckutt_sherlocks
/*
$res = $db->query("SELECT id, id_user, step, amount, date, id_parent, state, trace FROM buckutt_sherlocks",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO t_sherlocks_she (she_id, usr_id, she_step, she_amount, she_date, she_parent_id, she_state, she_trace) VALUES('%u', '%u', '%u', '%u', '%s', '%u', '%u', '%s');", Array($don['id'], $don['id_user'], $don['step'], $don['amount'], $don['date'], $don['id_parent'], $don['state'], $don['trace']));
	echo $don['id'].'<br />';
}
*/

//TABLE ts_error_err & buckutt_error
/*
$res = $db->query("SELECT id, name, description FROM buckutt_error;",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO ts_error_err (err_code, err_name, err_description, err_removed) VALUES(%u, '%s', '%s', 0);", Array($don['id'], $don['name'], $don['description'], 0));
	echo $don['id'].'<br />';
}
*/

$res = $db->query("SELECT id_image, mime, width, length, content FROM buckutt_image;",array());
while ($don = $db->fetchArray($res)) {
	$db->query("INSERT INTO ts_image_img (img_id, img_mime, img_width, img_length, img_content, img_removed) VALUES(%u, '%s', %u, %u, '%s', 0);", Array($don['id_image'], $don['mime'], $don['width'], $don['length'], $don['content'], 0));
	echo $don['id_image'].'<br />';
}

// coder ici ts_mean_of_login recharge_type t_fundation t_point ts_right_rig



  	






?>
