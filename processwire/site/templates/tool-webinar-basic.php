<?  
/**
 * Child Pages
 */
$fetch = $page->parent->children("template=tool-webinar-series-show");
include("App/Views/Partials/render_repeater_webinar_episode_all.php"); 

?>

<?
$img = ($page->parent->image_icon_1) ? $page->parent->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

if($page->repeater_callout_text_summary->count()) {
	$render_link .= "";
	foreach ($page->repeater_callout_text_summary as $key => $value) {

		$render_link .= "
		<li class='mb-2 rounded bg-primary p-2'><a class='text-white' href='{$value->url_general}' target='slides'> <strong>{$value->label_1}</strong>
			<div class='small text-white'>
			<i>{$value->label_2}</i>
			<div>{$value->summary}</div>
			</a>
			</div>
		</li>
		";
	}
	$render_links = "<ul class='list-unstyled'>{$render_link}</ul>";
}

include("App/Views/Partials/render_tools_webinar_tabs.php"); 

?>

<div pw-replace="section_heading" class="pb-0">
	<div  class="container">
		<div class="row">
			<div class="content col-sm-9 pr-md-5 pt-md-4 pb-md-3">
				<div class="section-heading-content"><?=($page->parent->body_1) ? $page->parent->body_1 : "<h1>".$page->title."</h1>"; ?></div>
			</div>
			<div class="col-sm-2 hidden-xs ">
				<img src="<?=$img?>" class="img-fluid img-thumbnail">
			</div>
		</div>
		<ul class="nav-tabs-affiliates nav nav-tabs">
			<?=$pageTabs ?>
		</ul>
	</div>
</div>


<div pw-append="section_content">

	<div class="row">
		<div class="col-sm-8">
			<span edit='body_2'>
				<?=$page->body_2 ?>
			</span>
		</div>
		<div class="col-md-3 col-lg-offset-1">
			<?=$render_links ?>
		</div>
		<div class="col-sm-12">
			<hr />
			<h3>Complete Series</h3>
			<?=$render_webinar_episode_all ?>
		</div>
	</div>
	
</div>