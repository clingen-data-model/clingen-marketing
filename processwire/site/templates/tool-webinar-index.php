<?  
/**
 * Child Pages
 */
$fetch = $page->children("template=tool-webinar-series-show");
include("App/Views/Partials/render_repeater_webinar_episode_all.php"); 

//$fetch = $page->children("event_date>today, sort=event_date");

$fetch = $page->children("template=tool-webinar-series-show, limit=1, event_date>today, sort=event_date");
include("App/Views/Partials/render_repeater_webinar_episode_next.php"); 
$fetch = $page->children("template=tool-webinar-series-show, limit=1, event_date<today, sort=event_date");
include("App/Views/Partials/render_repeater_webinar_episode_recent.php");  

?>

<?
$img = ($page->image_icon_1) ? $page->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

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
				<div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
			</div>
			<div class="col-sm-2 hidden-xs ">
				<img src="<?=$img?>" class="img-fluid img-thumbnail" />
			</div>
		</div>
		<ul class="nav-tabs-affiliates nav nav-tabs">
			<?=$pageTabs ?>
		</ul>
	</div>
</div>


<div pw-append="section_content">

	<div class="row">
		<div class="col-md-8">
			<span edit='body_2'>
				<?=$page->body_2 ?>
			</span>
			<div class="row">
				<? if($render_webinar_episode_next) { ?>
				<div class="col-md-6">
					<h3>Next</h3>
					<?=$render_webinar_episode_next ?>
				</div>
				<? } ?>
				<? if($render_webinar_episode_recent) { ?>
				<div class="col-md-6">
					<h3>Recent</h3>
					<?=$render_webinar_episode_recent ?>
				</div>
				<? } ?>
			</div>
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