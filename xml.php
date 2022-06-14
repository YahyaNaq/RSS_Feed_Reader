<?php

class Xml {
	public $title;
	public $description;
	public $date;
	public $art_link;
	public function __construct($article) {
		$this->title=$article->title;
		$this->description=$this->BuildDesc($article->description);
		$this->date=substr($article->pubDate,0,16);
		$this->art_link=$article->link;
		}
	public function BuildDesc($desc) {
		foreach (['</p>','</ul>','</ol>'] as $endtag) {
			$end=strpos($desc, $endtag);
			if ($end!=false) {
				break;
			}
			else {
				$end=150;
			}
		}
		return $end==150 ? substr($desc, 0,$end)."..." : substr($desc, 0,$end);
	}
	public static function CheckUrl($url) {
	    libxml_use_internal_errors(true);
	    $Isxml = simplexml_load_file($url,"SimpleXMLElement",LIBXML_NOCDATA);
	    return $Isxml;
	}
}
