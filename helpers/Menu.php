<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => '', 
			'label' => '', 
			'icon' => ''
		)
	);
		
			public static $navbartopright = array(
		array(
			'path' => 'home', 
			'label' => 'home', 
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'product', 
			'label' => 'product', 
			'icon' => '<i class="fa fa-shopping-cart "></i>'
		),
		
		array(
			'path' => 'user', 
			'label' => 'user', 
			'icon' => '<i class="fa fa-user "></i>'
		),
		
		array(
			'path' => 'pemesanan2', 
			'label' => 'Pembelian', 
			'icon' => '<i class="fa fa-shopping-bag "></i>'
		)
	);
		
	
	
			public static $role = array(
		array(
			"value" => "User", 
			"label" => "User", 
		),
		array(
			"value" => "Admin", 
			"label" => "Admin", 
		),
		array(
			"value" => "Penjual", 
			"label" => "Penjual", 
		),);
		
}