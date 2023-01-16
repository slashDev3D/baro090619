<?php
/*
Plugin Name: KBoard 포럼원 커뮤니티 스킨
Plugin URI: https://www.cosmosfarm.com/wpstore/product/kboard-forum-one-skin
Description: KBoard 포럼원 커뮤니티 스킨 스킨입니다.
Version: 1.6
Author: 코스모스팜 - Cosmosfarm
Author URI: https://www.cosmosfarm.com/
*/

if(!defined('ABSPATH')) exit;

add_filter('kboard_skin_list', 'kboard_skin_list_forum_one', 10, 1);
function kboard_skin_list_forum_one($list){
    
	$skin = new stdClass();
	$skin->dir = dirname(__FILE__);
	$skin->url = plugins_url('', __FILE__);
	$skin->name = basename($skin->dir);
    
	$list[$skin->name] = $skin;
    
	return $list;
}
?>