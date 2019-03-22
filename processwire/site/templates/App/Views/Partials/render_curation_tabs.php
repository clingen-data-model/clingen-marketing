<?
	if($page->template == "curation-show") {
			$section = $page;
		} else {
			$section = $page->parent("template=curation-show");
		}

		if($section->id == $page->id) {
		  $option['css'] = 'active';
		} else {
		  $option['css'] = null;
		}

		$pageTabs .= "
		<li class=\"nav-item  \">
		  <a class=\"nav-link pl-2 pr-2 {$option['css']}\" href=\"{$section->httpUrl}\">
		  			{$section->title}
			</a>
		</li>
		";

	$pageTabs .= $section->children()->each(function($child) {

		if($child->id == $page->id) {
		  $option['child-css'] = 'active';
		} else {
		  $option['child-css'] = null;
		}

		if($child->url_general){
	  	$return = "<a class=\"nav-link pl-2 pr-2 {$option['child-css']}\" href=\"{$child->url_general}\">{$child->title} <i class=\"fas fa-external-link-alt\"></i></a>";
		} else if($child->url_curations){
	  	$return = "<a class=\"nav-link pl-2 pr-2 {$option['child-css']}\" href=\"{$child->url_curations}\">{$child->title} <i class=\"fas fa-external-link-alt\"></i></a>";
		} else if($child->url_interface){
	  	$return = "<a class=\"nav-link pl-2 pr-2 {$option['child-css']}\" href=\"{$child->url_interface}\">{$child->title} <i class=\"fas fa-external-link-alt\"></i></a>";
		} else {
	  	$return = "<a class=\"nav-link pl-2 pr-2 {$option['child-css']}\" href=\"{$child->httpUrl}\">{$child->title}</a>";
		}
		return "<li class=\"nav-item\">{$return}</li>";
	});