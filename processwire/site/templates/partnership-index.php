<?

	$fetch = $page->children;
	if($fetch->count()) {
	  foreach ($fetch as $key => $value) {

	    $img = ($value->image_1) ? $value->image_1->width(800)->url : $config->imgSquareStandard;
	    $website = ($value->url_general) ? "<a href=\"$value->url_general\" target='_blank' class=\"btn btn-sm btn-primary\">Website</a>" : "";

	    $render_page_children_item .= "
	      <div class='col-md-6 '>
	        <div class=\"card mb-3  \">
	           <div class=\" \">
	              <div class=\"card-body\">
	              	<img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->title}\">
	                <h5 class=\"card-title\">{$value->title}</h5>
	                <p class=\"small\">{$value->summary}</p>
	                {$website}
	              </div>
	          </div>
	        </div>
	      </div>
	    ";
	  }
	  $render_children = "<div class='row'>".$render_page_children_item."</div>";
	  unset($render_page_children_item);
	}
?>




<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9">
			<span  edit="body_1">
	<?=$page->body_1?>
</span>
			<?=$render_children ?>
		</div>
		<div class="col-sm-3">
	     <? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
	  </div>
	</div>
</div>