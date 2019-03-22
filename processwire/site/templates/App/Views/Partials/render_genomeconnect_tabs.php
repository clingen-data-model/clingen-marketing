<?
  
	if($page->template == "tool-genomeconnect-index") {
			$section = $page;
		} else {
			$section = $page->parent("template=tool-genomeconnect-index");
		}

		if($section->id == $page->id) {
		  $option['css'] = 'active';
		} else {
		  $option['css'] = null;
		}

		$pageTabs .= "
		<li class=\"nav-item  \">
		  <a class=\"nav-link pl-2 pr-2 {$option['css']}\" href=\"{$section->httpUrl}\">
		  			<!--{$section->title}--> About
			</a>
		</li>
		";

	 foreach($section->children as $key => $child) {
    
		if ($page->parent("template=tool-genomeconnect-category")->id == $child->id || $page->id == $child->id ){
		  $option['child-css'] = 'active';
		} else {
		  $option['child-css'] = null;
		}

	  $return = "<a class=\"nav-link pl-2 pr-2 {$option['child-css']}\" href=\"{$child->httpUrl}\">{$child->title}</a>";
		$pageTabs .= "<li class=\"nav-item\">{$return}</li>";
	}