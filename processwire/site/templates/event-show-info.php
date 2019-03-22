<?
		$img = ($page->parent->image_icon_1) ? "<img src=".$page->parent->image_icon_1->width(600)->url." class='img-fluid'>" : "";

  if($page->parent->children) {
    
    $render_tab .="<li role='presentation' class=''><a href='{$page->parent->httpUrl}' class=' small'>Overview</a></li>";
    foreach($page->parent->children as $key => $value ) {
      $active = ($value->id == $page->id) ? "active" : "";
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
				<div class="section-heading-content"><?=($page->parent->body_1) ? $page->parent->body_1 : "<h1>".$page->parent->title."</h1>"; ?></div>
		  </div>
		  <div class="col-sm-3 ">
		  	<?=$img?>
		  </div>
		</div>
	</div>
</div>

<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9" edit="body_1">
			<?=$render_tabs?>
			<?=$page->body_1?>
		</div>
		<div class="col-sm-3">
	     <? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
	  </div>
	</div>
</div>
