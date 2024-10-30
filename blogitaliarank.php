<?php
/*
Plugin Name: BlogItalia Rank
Plugin URI: http://www.dreamsworld.it/emanuele/2007-07-26/wordpress-plugin-blogItalia-rank/
Description: Visualizza il rank di BlogItalia sul tuo blog.
Version: 1.1
Author: Emanuele (aka P|xeL)
Author URI: http://www.dreamsworld.it/emanuele/
*/

/*
Per utilizzare questo plugin inserire nel proprio template la seguente stringa:
<?php if(function_exists(wp_blogitaliarank)) { wp_blogitaliarank("ID"); } ?>
Sostituire in "ID" il numero assegnato da BlogItalia nell'url verso il proprio blog.
Per trovarlo, andate su http://www.blogitalia.it/i_tuoi_blog.asp dopo aver effettuato il login e posizionate il mouse sul titolo del blog di vostro interesse.
L'url indicato avrà una forma tipo: http://www.blogitalia.it/leggi_blog.asp?id=XXXX --> i quattro numeri finali sono il nostro ID.
Ad esempio, per visualizzare il rank del mio blog, utilizzerò:
<?php if(function_exists(wp_blogitaliarank)) { wp_blogitaliarank("7596"); } ?>
---
Per utilizzare la forma testuale, inserite sul vostro blog il seguente codice:
<?php if(function_exists(wp_blogitaliarank_text)) { wp_blogitaliarank_text("ID"); } ?>
Sostituire in "ID" il numero assegnato da BlogItalia nell'url verso il proprio blog.
Ad esempio:
<?php if(function_exists(wp_blogitaliarank_text)) { wp_blogitaliarank_text("7596"); } ?>
Il risultato sarà un numero con un link verso la pagina del vostro rank su BlogItalia.
Tramite CSS è possibile personalizzare graficamente il testo, usando le seguenti classi: "blogitalia-green" e "blogitalia-red".
Ad esempio, per visualizzare il risultato verde o rosso in base all'incremento o decremento di posizioni su BlogItalia, basterà aggiungere il seguente codice al vostro foglio di stile:
.blogitalia-green { color: #00FF00; }
.blogitalia-red { color: #ff0000; }
---


Per rispetto del mio lavoro, vi sarei grato se i credits rimanessero intatti ;-)

Emanuele (aka P|xeL)
- http://www.dreamsworld.it/emanuele/ -
*/

@define("BI_API_URL", "http://www.blogitalia.it/informazioni_sul_blog.asp?id=");
@define("BI_LINK_URL",		"http://www.blogitalia.it/elenco_dei_blog.asp?pl=");
@define('BI_BLOG_URL',	get_bloginfo('url'));


function bir_getRank($blog) {
	$host = BI_API_URL.$blog;
	$contents = file_get_contents($host);
	if($contents != "") {
		$contents = str_replace("º","",$contents);
		$s = '<b>Top Italia: ';
		$e = '&#176;</b>';
		$pos = strpos($contents, $s);
		$g = $f = $pos+strlen($s);
		$rank = substr($contents, $f, (strpos($contents,$e,$f)-$f));
		$m = "alt='Variazione: ";
		$n = "' />";
		$clas = strpos($contents, $m);
		$o = $p = $clas+strlen($m);
		$mov = substr($contents, $p, (strpos($contents,$n,$p)-$p));
		$mm = "(<b>";
		$nn = "</b>)";
		$urla = strpos($contents, $mm);
		$oo = $pp = $urla+strlen($mm);
		$url = substr($contents, $pp, (strpos($contents,$nn,$pp)-$pp));
		if ($mov = "=") { return array("$rank","$url","1"); }
		elseif ($mov >= 0) { return array("$rank","$url","1"); }
		else { return array("$rank","$url","-1"); }
	}
}

function bir_expired($file) {
	if (!file_exists($file) || (filemtime($file) < time() - 64800 && gmstrftime("%H", time()) <= 21 && gmstrftime("%H", time()) >= 02 )) {
		return true;
	}
	return false;	
}

function bir_createImage($pos) {
	$uploadpath = get_option('upload_path');
	if (!$saveFile) $saveFile = ABSPATH . $uploadpath . '/bir.png';
	$im = @ImageCreate (80, 15)
	or die ('Cannot create a new GD image.');
	$white	= ImageColorAllocate ($im, 255,255,255);
	$grey		= ImageColorAllocate ($im, 51,51,51);
	$red		= ImageColorAllocate ($im, 255,0,0);
	$green	= ImageColorAllocate ($im,0,153,0);
  $back_color = $grey; # colore contorno
  $box_color_right = $red;
  if ($pos[2] >= 0 ) { $box_color_right = $green; } # colore sfondo testo BlogItalia
	$text_color = $white; # colore testo
	imagefill($im, 0, 0, $back_color);
	imagefilledrectangle($im,1,1,78,13,$box_color);
	imagefilledrectangle($im,30,2,77,12,$box_color_right);
	imagerectangle($im,2,2,28,12,$box_color_right);
	imagestring($im, 0, 32, 4, "TOPITALIA", $text_color);
	imagestring($im, 0, 6, 4, $pos[0], $back_color);
	ImagePNG ($im,$saveFile);
	echo '<a href="'.BI_LINK_URL.$pos[1].'" target="_blank" ><img src="'.BI_BLOG_URL.'/'. $uploadpath .'/bir.png" border="0" alt="BlogItalia Rank Plus - Realizzato da Emanuele aka P|xeL - http://www.dreamsworld.it/emanuele/" /></a>';
}

function bir_blogitaliarank_text($id) {
	$rank = bir_getRank($id);
	$blog= str_replace("http://","",BI_BLOG_URL);
	if ($rank[2] >= 0) {
		echo '<a class="blogitalia-green" href="'.BI_LINK_URL.$blog.'" title="BlogItalia Rank" target="_blank">' . $rank[0] . '</a>';
	} else {
		echo '<a class="blogitalia-red" href="'.BI_LINK_URL.$blog.'" title="BlogItalia Rank" target="_blank">' . $rank[0] . '</a>';
	}
}

function wp_blogitaliarank_text($id) {
	$uploadpath = get_option('upload_path');
	$saveFile = ABSPATH . $uploadpath . '/bir.txt';
	if (bir_expired($saveFile)) {
		ob_start();
		bir_blogitaliarank_text($id);
		$file = fopen($saveFile, 'w');
		fwrite($file, ob_get_contents());
		fclose($file);
		chmod($saveFile, 0644);
		ob_end_flush();
	} else {
		include($saveFile);
	}
}

function wp_blogitaliarank($id){
	$uploadpath = get_option('upload_path');
	if (!$saveFile) $saveFile = ABSPATH . $uploadpath . '/bir.png';
	if (bir_expired($saveFile)) {
		$rank = bir_getRank($id);
		bir_createImage($rank);
	}
	else {
		$blog= str_replace("http://","",BI_BLOG_URL);
		echo '<a href="'.BI_LINK_URL.$blog.'" target="_blank"><img src="'.BI_BLOG_URL.'/'. $uploadpath .'/bir.png" border="0" alt="BlogItalia Rank - Realizzato da Emanuele aka P|xeL - http://www.dreamsworld.it/emanuele/" /></a>';
	}	
}

?>