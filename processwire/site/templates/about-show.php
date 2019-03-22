<?
		$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;
?>

<div pw-replace="section_heading">
  <div  class="container">
  	<div class="">
	  	<div class="content  pr-md-5">
				<h1 class="section-heading-content"><?=$page->title ?></h1>
		  </div><!-- 
		  <div class="col-sm-2 ">
		  	<img src="<?=$img?>" class="img-fluid">
		  </div> -->
		</div>
	</div>
</div>

<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9" edit="body_1">
			<?=$page->body_1?>
		</div>
		<div class="col-sm-3">
	     <? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
	  </div>
	</div>
</div>

