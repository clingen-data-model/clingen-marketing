<div class="">

<?php
  /*
if($user->isSuperuser()) {
	// If the page is editable, then output a link that takes us straight to the page edit screen:

	$siblings = $pages->find("parent=$page->id")->not("title=Admin, id=1101, title=Trash");
	echo "<div class='mt-5 p-3 container card bg-light'>";
		echo "<fieldset><label>ADMIN - Visable Children</label><ul class='nav'>";
	
		foreach($siblings as $child) {
			echo "<li class='col-md-4'><p><a href='{$child->url}'>{$child->title}</a></p></li>"; 
		}
	
		echo "</ul></fieldset>";
	
	$siblings = $pages->find("parent=$page->id, status=hidden")->not("title=Admin, id=1101, title=Trash");
		echo "<fieldset><label>ADMIN - Hidden Children</label><ul class='nav'>";
	
		foreach($siblings as $child) {
			echo "<li class='col-md-4'><p><a href='{$child->url}'>{$child->title}</a></p></li>"; 
		}
	
		echo "</ul></fieldset>";
	
	$siblings = $pages->find("parent=1, include=hidden")->not("title=Admin, id=1101, title=Trash");
		echo "<fieldset><label>ADMIN - Root Pages (All)</label><ul class='nav'>";
	
		foreach($siblings as $child) {
			echo "<li class='col-md-4'><p><a href='{$child->url}'>{$child->title}</a></p></li>"; 
		}
	
		echo "</ul></fieldset>";

		echo "<fieldset><label>ADMIN - Template Info</label><ul class='nav'>";
	
			echo "<div class='row'><li class='col-md-4'><p>Template: <strong>{$page->template->name}</strong> </p></li>";
			echo "<li class='col-md-4'><p>Title: <strong>{$page->title}</strong> </p></li>";
			echo "<li class='col-md-4'><p>uri: <strong>{$page->name}</strong> </p></li>";
			echo "<li class='col-md-4'><p>ID: <strong>{$page->id}</strong> </p></li>";
			echo "<li class='col-md-4'><p>Parent: <strong>{$page->parent}</strong> </p></li>
			</div><div class='row'>";
				echo "<li class='col-md-12'><p>URL: <strong>{$page->url}</strong> </p></li>"; 
				echo "<li class='col-md-12'><p>Template: ";
							foreach($page->template->fields as $child) {
							echo "<strong>{$child->name} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> "; 
						} echo "</li>"; 
				echo "<li class='col-md-12'><p>Children: ";
							foreach($page->children as $child) {
							echo "<strong><a title='{$child->title}' href='{$child->url}'>{$child->title}  ({$child->id})</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "; 
						} echo "</li>"; 
				echo "<li class='col-md-12'><p>Siblings: ";
							foreach($page->siblings as $child) {
							echo "<strong><a title='{$child->title}' href='{$child->url}'>{$child->title}  ({$child->id})</a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; "; 
						} echo "</li>"; 
				echo "<li class='col-md-12'><p>SEO Title: <strong>{$page->seotitle}</strong> </p></li>"; 
				echo "<li class='col-md-12'><p>SEO Summary: <strong>{$page->seosummary}</strong> </p></li>
			</div>"; 
		echo "</ul></fieldset>";
		echo "</div>";
	 
}

*/
?>
</div>