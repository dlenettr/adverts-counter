<?php
/*
=====================================================
 MWS Adverts Counter v1.0 - by MaRZoCHi
-----------------------------------------------------
 http://www.dle.net.tr/
-----------------------------------------------------
 Copyright (c) 2014 - DLE.NET.TR
-----------------------------------------------------
 License : GPL License
=====================================================
*/

if( ! defined( 'DATALIFEENGINE' ) ) {
	die( "Hacking attempt!" );
}


if ( isset( $_REQUEST['link'] ) ) {

	$link = $db->safesql( $_REQUEST['link'] );

	$advert = $db->super_query( "SELECT code FROM " . PREFIX . "_banners WHERE click_link = '{$link}'" );

	if ( preg_match( "#href=[\"|\'](.+?)[\"|\']#", $advert['code'], $match ) ) {

		// kontrol daha önce tıkladımı
		// tıklamadıysa 1 arttır
		// + veritabanına kaydet kullanıcı İP ve adını
		$db->query( "UPDATE " . PREFIX . "_banners SET clicks = clicks+1 WHERE click_link = '{$link}'" );
		// tıkladıysa arttırma

		$link = $match[1];
		header( "Location: {$link}" );
		exit();
	}

} else {
	echo "Link girilmedi";
}

?>