<div pw-prepend="section_content">
	<div class="row">
		<div class="col-sm-9">
			<span  edit="body_1">
	<?=$page->body_1?>
</span>
			<? include("App/Views/Partials/render_child_pages_as_list.php"); ?>
		</div>
		<div class="col-sm-3">
	     <? include("App/Views/Partials/render_root_parent_pages_as_side_nav.php"); ?>
	  </div>
	</div>
</div>