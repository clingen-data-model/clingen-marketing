<?  
/**
 * Child Pages
 */
$fetch = $page->parent->children("template=tool-webinar-series-show");
include("App/Views/Partials/render_repeater_webinar_episode_all.php"); 

?>

<?
$img = ($page->parent->image_icon_1) ? $page->parent->image_icon_1->size(600,600)->url : $config->imgSquareStandard;

include("App/Views/Partials/render_tools_webinar_tabs.php"); 


	
$pos = strrpos($page->url_youtube, '/');
$url_youtube  = $pos === false ? $page->url_youtube : substr($page->url_youtube, $pos + 1);
$tweetUrl = urlencode($page->title." ".$page->httpUrl);

$render_file_download = ($page->file_1) ? "<li class='mb-2'><a href='{$page->file_1->httpUrl}' target='slides'><i class='glyphicon glyphicon-download-alt'></i> View Slides</a></li>" : "";

	
if($page->repeater_callout_text_summary->count()) {
	$render_link .= "<hr />";
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
}

if($page->repeater_callout_rich_media_6){
	foreach ($page->repeater_callout_rich_media_6 as $key => $member) {
		$presenter_img = ($member->image_1) ? $member->image_1->size(600,600)->url : $config->imgUserSquareStandard;
		$key_members++;
		$render_presenter .= "
			<div class='col-sm-3 text-center mb-3'>
				<div class='col-sm-12'><img src='{$presenter_img}' class='img-thumbnail' alt='{$member->user_name_full}'></div>
				<div class='col-sm-12 mt-1'> 
					<div>{$member->label_1}</div>
					<div class='small'>{$member->label_2}</div>
				</div>
			</div>
		";
	}
	$render_presenters = "{$render_presenter}";
}


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
		<? if($page->url_youtube) { ?>
		<div class="col-md-12 mb-3">
			<h2><?=$page->title ?></h2>
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe src="https://www.youtube.com/embed/<?=$url_youtube ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
			<div class="small"><a href='<?=$page->url_youtube ?>' target="youtube">Watch on YouTube</a></div>
		</div>
		<? } else { ?>
		<div class="col-md-12 mb-3">
			<div class="thumbnail p-4 text-center bg-light">
				<strong class="text-muted">The recording will be available a few days after the presentation.</strong>
			</div>
		</div>
		<? } ?>
		<div class="col-md-12">
			<h3><?=$page->title ?></h3>
		</div>
		<div class="col-md-8">
			<? if($key_members == 1) { ?>
				<div class="row">
					<?=$render_presenters ?>
					<div class="col-sm-9">
						<span edit='body_2'>
							<?=$page->body_2 ?>
						</span>
					</div>
				</div>
			<? } else { ?>
				<span edit='body_2'>
					<?=$page->body_2 ?>
				</span>
				<div class="row">
				<?=$render_presenters ?>
				</div>
			<? } ?>
		</div>
		<div class="col-md-3 col-lg-offset-1">
			<ul class="list-unstyled">
				<? if($page->url_youtube) { ?>
				<li class="mb-2"><a href='<?=$page->url_youtube ?>' target="youtube"><i class="glyphicon glyphicon-play-circle"></i> Watch on YouTube</a></li>
				<? } ?>
				<li class="mb-2"><a href="https://twitter.com/intent/tweet?text=<?=$tweetUrl ?>" target="twitter"><i class="glyphicon glyphicon-send"></i> Share on Twitter</a></li>
				<?=$render_file_download ?>
				<?=$render_link ?>
			</ul>
		</div>
		<div class="col-sm-12">
			<hr />
			<h3>Complete Series</h3>
			<?=$render_webinar_episode_all ?>
		</div>
	</div>
	
</div>