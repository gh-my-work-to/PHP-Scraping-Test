<?php
/**
 * http://news.google.co.jp/news?pz=1&cf=all&ned=jp&hl=ja&q
 * からニュースのタイトル一覧を取得して表示する。
 */
include_once ('./simple_html_dom.php');

ini_set('user_agent', 'My-Application/2.5');

$ret = getData();
showData($ret);
exit();
//
/**
 * データを表示する
 *
 * @param 表示するデータ $ret        	
 */
function showData($ret)
{
	header('contentType:text/plain;charset=utf-8');
	
	foreach($ret as $v)
	{
		echo "●" . $v['title'] . "\n";
	}
}

/**
 * データを取得する
 *
 * @return multitype:
 */
function getData()
{
	$ret = array();
	
	// create HTML DOM
	$html = file_get_html('http://news.google.co.jp/news?pz=1&cf=all&ned=jp&hl=ja&q');
	
	// span.titletextを取得する
	$ary = $html->find('span.titletext');
	
	foreach($ary as $ent)
	{
		// データを格納する
		$item['title'] = trim($ent->plaintext);
		array_push($ret, $item);
	}
	
	// clean up memory
	$html->clear();
	unset($html);
	
	return $ret;
}

?>
