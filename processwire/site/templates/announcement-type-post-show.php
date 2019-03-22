<div pw-prepend="section_content">

	<?=$page->body_1?>

</div>


<div pw-append="section_content">
	<? include("App/Views/Partials/render_child_pages_as_list.php"); ?>
</div>
<div pw-append="section_content">

	<h1><?=$page->template->name?></h1>

</div>