<?  
/**
 * Child Pages
 */
$fetch = $page->parent->children("template=tool-webinar-series-show");
include("App/Views/Partials/render_repeater_webinar_episode_all.php"); 
 
?>

<?
$img = ($page->parent->image_icon_1) ? $page->parent->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

if($page->repeater_callout_rich_media_7_group->count()) {
	$render_faq .= "";
	foreach ($page->repeater_callout_rich_media_7_group as $key => $value) {
		foreach ($value->repeater_callout_rich_media_7 as $key1 => $item) {
			$render_faq_item  .= "
				<div class='mt-2'><strong><a data-toggle='collapse' href='#element-{$key}-{$key1}' aria-expanded='false' aria-controls='element-{$key}-{$key1}'>{$item->label_1}</a></strong></div>
				<div class='collapse mb-1' id='element-{$key}-{$key1}'>
					<div class=' bg-light pl-3 pr-3 pt-3 pb-2 mb-3'>{$item->body_1}</div>
				</div>
				";
		}
		$render_faq .= "
		<div class=''><hr /></div>
		<h3>{$value->label_1}</h3>
		<div class='mb-4'>{$render_faq_item}</div>
		";
		unset($render_faq_item);
	}
	$render_faqs = "<div class=''>{$render_faq}</div>";
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
		<div class="col-sm-12">
			<span edit='body_2'>
				<?=$page->body_1 ?>
			</span>
			<div class="mt-3">
				<?=$render_faqs ?>
			</div>
		</div>
		<div class="col-sm-12">
			<hr />
			<h3>Complete Series</h3>
			<?=$render_webinar_episode_all ?>
		</div>
	</div>
	
</div>