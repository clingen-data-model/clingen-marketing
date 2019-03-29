<?
$img = ($page->image_icon_1) ? $page->image_icon_1->width(600)->url : $config->imgSquareStandard;
?>

<div pw-replace="section_heading">
	<div  class="container">
		<div class="row">
			<div class="col-sm-9 content  pr-md-5 pt-md-4 pb-md-3">
				<div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
			</div>
			<div class="col-sm-3 hidden-xs ">
				<img src="<?=$img?>" class="img-fluid" edit="image_icon_1">
			</div>
		</div>
	</div>
</div>

<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9" edit="body_2">
			<?=$page->body_2?>
		</div>
		<div class="col-sm-3">
			<? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
		</div>
	</div>
</div>

