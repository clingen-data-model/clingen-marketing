<?
		$img = ($page->image_icon_1) ? "<img src=".$page->image_icon_1->width(600)->url." edit='image_icon_1' class='img-fluid'>" : "";

  if($page->children) {
    
    $render_tab .="<li role='presentation' class='active'><a href='{$page->httpUrl}' class=' small'>Overview</a></li>";
    foreach($page->children as $key => $value ) {
      $render_tab .="<li role='presentation' class='{$active}'><a href='{$value->httpUrl}' class=' small'>{$value->title}</a></li>";
    }
    $render_tabs = "<ul class='nav nav-tabs mb-4'>{$render_tab}</ul>";
    unset($render_tab);
  }
?>

<div pw-replace="section_heading">
  <div  class="container">
  	<div class="row">
	  	<div class="col-sm-9 content ">
				<div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
		  </div>
		  <div class="col-sm-3 ">
		  	<?=$img?>
		  </div>
		</div>
	</div>
</div>


<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9" edit="body_2">
			<?=$render_tabs?>
			<?=$page->body_2?> 
		</div>
		<div class="col-sm-3">
	     <? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
	  </div>
	</div>
</div>