<?
	if($page->relate_page) {
	  $session->redirect($page->relate_page->httpUrl);
	} else if($page->url_general) {
	  $session->redirect($page->url_general);
	} else {
		$session->redirect($page->parent->url);
	}
?>