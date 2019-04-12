<?

$out = '';

if($q = $sanitizer->selectorValue($input->get->q)) {

	// Send our sanitized query 'q' variable to the whitelist where it will be
	// picked up and echoed in the search box by the head.inc file.
	$input->whitelist('q', $q); 

	// Search the title, body and sidebar fields for our query text.
	// Limit the results to 50 pages. 
	// Exclude results that use the 'admin' template. 
	$matches = $pages->find("title|body_1|body_2|body_3|body_4|body_5|user_name_full|metadata_search_terms%=$q, limit=50, template!=variable-default|variable-icon"); 

	$count = count($matches); 

	if($count) {
		$out .= "<h6 class='pb-3 pt-3'>$count pages matching your query for '{$q}'.</h6>" . 
		"<ul class='list-unstyled'>";



		foreach($matches as $m) {
			
			$title = ($m->title) ? $m->title    : $m->user_name_full;
			$summary = ($m->summary) ? $m->summary  : $m->user_title;

			if($m->template == "user"){
				$out .= "<li class='padding-bottom-md pb-2'><a class='padding-none text-bold strong' href='/about/people/{$m->user_name_last}-{$m->id}'>{$title}</a><div></li>";
			} else {
				$out .= "<li class='padding-bottom-md pb-2'><a class='padding-none text-bold strong' href='{$m->httpUrl}'>{$title}</a><div><a href='{$m->httpUrl}' class='text-muted small'>{$m->httpUrl}</a></div>{$summary}</li>";

			}
		}

		$out .= "</ul>";

	} else {
		$out .= "<h6 class='text-left'>Sorry, no results were found.</h6>";
	}
} else {
	$out .= "<h6 class='text-left'>Please enter a search term in the search box.</h6><br /><br /><br /><br /><br /><br />";
}


include("App/Helpers/functions.php");
include("App/Views/Partials/render_search_bar.php"); 
?>


<div pw-replace="section_heading" class="">
	<div  class="container">
		<div class="">
			<div class="content">
				<div class="section-heading-content" edit="body_1"><?=($page->body_1) ? $page->body_1 : "<h1>".$page->title."</h1>"; ?></div>
			</div>
		</div>
		
	</div>
</div>


<div pw-append="section_content">
	<div class="row">
		<div class="col-sm-12">
			<?=$page->body_2?>
			
			<hr />
			<form class="form-search form-inline"   method="get" action="<? echo $pages->get(3182)->url; ?>">
				<div class="input-group input-group-lg w-100">
					<input type="text" name="q" placeholder="Search website text" value="<?=$q?>" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit">Go!</button>
					</span>
					
				</div>
			</form>
			<small><a href="https://search.clinicalgenome.org/kb">Click here to search curated gene and diseases</a></small>
			
			<?=$out; ?>
		</div>
	</div>
</div>