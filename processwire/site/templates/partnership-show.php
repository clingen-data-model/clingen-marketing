<?
	if($page->url_general) {
	  $session->redirect($page->url_general);
	} else {
		$session->redirect($page->parent->url);
	}
?>