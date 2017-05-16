<?php defined('BASEPATH') OR exit('No direct script access allowed');

// $config["menu_id"]               = 'id';
// $config["menu_label"]            = 'name';
// $config["menu_parent"]           = 'parent';
// $config["menu_icon"] 			 = 'icon';
$config["menu_key"]              = 'slug';
$config["menu_order"]            = 'number';

$config["nav_tag_open"]          = '';
$config["nav_tag_close"]         = '</ul>';
$config["item_tag_open"]         = '<li>'; 
$config["item_tag_close"]        = '</li>';	
$config["parent_tag_open"]       = '<li>';	
$config["parent_tag_close"]      = '</li>';	
$config["item_anchor"]     = '<a href="%s"><span class="nav-label">%s</span></a>';	
$config["parent_anchor"]     = '<a href="%s"><span class="nav-label">%s</span> <span class="fa arrow"></span></a>';	
$config["children_tag_open"]     = '<ul class="nav nav-second-level collapse">';	
$config["children_tag_close"]    = '</ul>';	
$config['icon_position']		 = 'left'; // 'left' or 'right'
$config['menu_icons_list']		 = array();
// these for the future version
$config['icon_img_base_url']	 = ''; 