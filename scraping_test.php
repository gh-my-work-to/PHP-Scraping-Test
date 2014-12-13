<?php
include_once ('./simple_html_dom.php');

ini_set('user_agent', 'My-Application/2.5');

$ret = getData();
showData($ret);
exit();
//
function showData($ret)
{
	foreach ( $ret as $v )
	{
		echo $v ['title'] . "<br>\n";
	}
}
//
function getData()
{
	$ret = array ();
	
	// create HTML DOM
	$html = file_get_html('http://localhost/sample.html');
	// get news block
	$ary = $html->find('ul.newslistTextTop', 0)->children;
	foreach ( $ary as $ent )
	{
		$item ['title'] = $ent->find('a', 0)->plaintext;
		array_push($ret, $item);
	}
	// clean up memory
	$html->clear();
	unset($html);
	
	return $ret;
}

?>