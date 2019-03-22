<?
	if($page->url_interface) {
	  $session->redirect($page->url_interface);
	} else {
		$session->redirect($page->parent->url);
	}
?>