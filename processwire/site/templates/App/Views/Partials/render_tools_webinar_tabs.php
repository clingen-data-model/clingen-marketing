<?
  
	if($page->template == "tool-webinar-index") {
			$section = $page;
		} else {
			$section = $page->parent("template=tool-webinar-index");
		}

		if($section->id == $page->id) {
		  $option['css'] = 'active';
		} else {
		  $option['css'] = null;
		}

		$pageTabs .= "
		<li class=\"nav-item  \">
		  <a class=\"nav-link pl-2 pr-2 {$option['css']}\" href=\"{$section->httpUrl}\">
		  			Overview
			</a>
		</li>
		";

	 foreach($section->children("template!=tool-webinar-series-show") as $key => $child) {
    
		if ($page->parent("template=tool-sharedata-category")->id == $child->id || $page->id == $child->id ){
		  $option['child-css'] = 'active';
		} else {
		  $option['child-css'] = null;
		}

	  $return = "<a class=\"nav-link pl-2 pr-2 {$option['child-css']}\" href=\"{$child->httpUrl}\">{$child->title}</a>";
		$pageTabs .= "<li class=\"nav-item\">{$return}</li>";
	}