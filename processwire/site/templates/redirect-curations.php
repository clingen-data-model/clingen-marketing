<?
	if($page->url_curations) {
	  $session->redirect($page->url_curations);
	} else {
		$session->redirect($page->parent->url);
	}
?>