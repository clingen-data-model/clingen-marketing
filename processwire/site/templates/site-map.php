<?

function sitemapListPage($page) {

	echo "<li class='pb-2'><a href='{$page->url}'>{$page->title}</a><div class='text-muted small'>{$page->summary}</div> ";	

	if($page->numChildren) {
		echo "<ul>";
		foreach($page->children as $child) sitemapListPage($child); 
		echo "</ul>";
	}

	echo "</li>";
}

?>


<div pw-prepend="section_content">
	<span  edit="body_1">
		<?=$page->body_1?>
	</span>
  <ul class='sitemap'>
    <?= sitemapListPage($pages->get("/")) ?>
  </ul>
</div>


<div pw-append="section_content">
	<? include("App/Views/Partials/render_child_pages_as_list.php"); ?>
</div>