<div pw-prepend="section_content">
  <span  edit="body_1">
	<?=$page->body_1?>
</span>
</div>


<div pw-append="section_content">
	<? include("App/Views/Partials/render_child_pages_as_list.php"); ?>
</div>
<div pw-append="section_content">

	<h1><?=$page->template->name?></h1>

</div>