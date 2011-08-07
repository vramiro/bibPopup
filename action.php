<?php
/**
 * Bibtex PopUp Action Plugin:
 * Requires jslink
 */
 
if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');
 
class action_plugin_bibPopup extends DokuWiki_Action_Plugin {
 
  /**
   * return some info
   */
  function getInfo(){
    return array(
		 'author' => 'Victor Ramiro',
		 'email'  => 'vramiro@gmail.com',
		 'date'   => '2007-10-17',
		 'name'   => 'Bibtex Popup Plugin', 
		 'desc'   => 'Creates a Bibtex popup window from a bibtex reference (created with BibtexTools) in an ACM Style', 
		 'url'    => 'http://victor.cl/',
		 );
  }
 
  /*
   * Register its handlers with the dokuwiki's event controller
   */
  function register(&$controller) {
    $controller->register_hook('PARSER_WIKITEXT_PREPROCESS', 'BEFORE',  $this, '_hookBibpopup');
    $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE',  $this, '_hookMetaheader');
  }

  function _hookBibpopup(&$event, $param){
    $pattern = '/\{\{bib>([^}]*)\|([^}]*)\}\}/';
    $replace = '{{js>bibtex(\'$1\')|$2}}';
    $event->data = preg_replace($pattern,$replace,$event->data);
  }
 

  function _hookMetaheader(&$event, $param) {
	$event->data["script"][] = array ("type" => "text/javascript",
                                          "charset" => "utf-8",
					  "_data" => "",
					  "src" => DOKU_BASE."lib/plugins/bibPopup/prototype.js"
				          );
        $event->data["script"][] = array ("type" => "text/javascript",
             				  "charset" => "utf-8",
                                          "_data" => "",
                                          "src" => DOKU_BASE."lib/plugins/bibPopup/bibtex.js"
                                          );
  	$event->data['link'][] = array('rel'=>'stylesheet', 
					'media'=>'all', 
				 	'type'=>'text/css',
                          	 	'href'=>DOKU_BASE.'lib/plugins/bibPopup/bibtex.css'
					);

        $event->data["script"][] = array ("type" => "text/javascript",
                                          "charset" => "utf-8",
                                          "_data" => "",
                                          "src" => DOKU_BASE."lib/plugins/folded/script.js"
                                          );

        $event->data["link"][] = array ("rel" => "stylesheet",
                                          "media" => "all",
                                          "type" => "text/css",
                                          "href" => DOKU_BASE."lib/plugins/folded/style.css"
                                          );


  }
}
