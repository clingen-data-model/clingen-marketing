<?

$fetch = $page->repeater_external_genomic_resources('sort=label_1');
if($fetch) {
  foreach ($fetch as $key => $value) {
    
    
    $img = ($value->image_1->url) ? $value->image_1->size(600,600)->url : $config->imgSquareStandard;

    $render_item .= "
      <div class='col-md-12 '>
        <div class=\"card mb-2  \">
           <div class=\"row no-gutters bg-light \">
            <div class=\"col-md-1 hidden-sm hidden-xs align-self-top \">
             <a class='' target='resource' href='{$value->url_general}'> <img src=\"{$img}\" class=\"card-img p-3\" alt=\"{$value->label_1}\"></a>
            </div>
            <div class=\"col-md-11 bg-white\">
              <div class=\"card-body\">
                <a class='' target='resource' href='{$value->url_general}'><h5 class=\"card-title\">{$value->label_1} <i class=\"fas fa-external-link-alt\"></i></h5></a>
                <p class=\"small\">{$value->summary}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    ";
    
     // This is how to equitabily handle wrapping nicely without having to clear.  Downside is it wraps in div
    // but offers more possibilities 
    if(($key + 1) == count($fetch) ){
      $render_items .=  "<div class='wrap-row row'>{$render_item}</div>"; 
      unset($render_item);
    } else if(($key + 1)%2 == 0) {
      $render_items .=  "<div class='wrap-row row'>{$render_item}</div>"; 
      unset($render_item);
    } 
  }
  $render_items = "<div class='row pt-3'>".$render_items."</div>";
  unset($render_item);
}

    $img = ($page->image_1) ? $page->image_1->width(800)->url : $config->imgSquareStandard;

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

<div pw-prepend="section_content">
  <div edit="body_2"><img src="/site/assets/files/1020/tool-image.800x0.jpg" class="pull-right" style="width:400px;"><?=$page->body_2 ?></div>
  <div class=" text-center pt-5 pb-5"><span class="btn-group" role="group"><a href="#rich_media_1" class="btn btn-outline-primary">Overview &amp; Getting Started</a><a href="#rich_media_2" class="btn btn-outline-primary">infoButton Overview</a><a href="#rich_media_2" class="btn btn-outline-primary">ClinGen's InfoButton Profile</a><a href="#rich_media_3" class="btn btn-outline-primary">List Of Genomic Resources</a></span></div>
  <hr />
  <table class="w-100">
    <tr>
      <td width="25%" valign="top"><img src="/site/assets/files/1020/tool-image.800x0.jpg" class="img-fluid">
      </td>
      <td class="pl-5">
        <h2>Overview</h2>
        <p>Lorem ipsum dolor sit amet, vis partem detraxit facilisi ut. An eos nulla graeci possit, dico diceret usu ex, has autem dicat nobis ad. Te alii etiam partem qui, labore pertinax temporibus an qui. Sed cu summo tacimates.</p>
        <p>Lorem ipsum dolor sit amet, vis partem detraxit facilisi ut. An eos nulla graeci possit, dico diceret usu ex, has autem dicat nobis ad. Te alii etiam partem qui, labore pertinax temporibus an qui. Sed cu summo tacimates.</p>
        <h3 class="pt-4">Steps to Get Started</h3>
        <p>Lorem ipsum dolor sit amet, vis partem detraxit facilisi ut. An eos nulla graeci possit, dico diceret usu ex, has autem dicat nobis ad. Te alii etiam partem qui, labore pertinax temporibus an qui. Sed cu summo tacimates.</p>
        <ul>
          <li>Ea eos meliore nusquam accumsan, graecis consulatu pri no, ut commodo eripuit detraxit mea.</li>
          <li>Qui quodsi appetere an, vix soleat euismod lucilius no. </li>
          <li>Ex nec integre evertitur forensibus, at nullam senserit vim.</li>
          <li>Dolorum luptatum at est, id alia aeque vituperatoribus mei, est at verear intellegebat consectetuer.</li>
        </ul>
      </td>
      </tr>
    <tr>
      <td width="" class="pt-4 pb-4" colspan="2">
        <hr class="" />
        </td>
      </tr>
    <tr>
      <td width="25%" valign="top"><img src="https://clingen2019v2.creationproject.net/site/assets/files/2270/project_logo.jpg" class="img-fluid">
      </td>
      <td class="pl-5">
        <h2>About infoButton</h2>
        <p>Lorem ipsum dolor sit amet, vis partem detraxit facilisi ut. An eos nulla graeci possit, dico diceret usu ex, has autem dicat nobis ad. Te alii etiam partem qui, labore pertinax temporibus an qui. Sed cu summo tacimates.</p>
        <ul>
          <li>Qui quodsi appetere an, vix soleat euismod lucilius no. </li>
          <li>Ex nec integre evertitur forensibus, at nullam senserit vim.</li>
          <li>Dolorum luptatum at est, id alia aeque vituperatoribus mei, est at verear intellegebat consectetuer.</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, vis partem detraxit facilisi ut. An eos nulla graeci possit, dico diceret usu ex, has autem dicat nobis ad. Te alii etiam partem qui, labore pertinax temporibus an qui. Sed cu summo tacimates.</p>
      </td>
      </tr>
    <tr>
      <td width="" class="pt-4 pb-4" colspan="2">
        <hr />
        </td>
      </tr>
    <tr>
      <td width="25%" valign="top"><img src="https://clingen2019v2.creationproject.net/site/assets/files/2270/project_logo_copy_copy.jpg" class="img-fluid">
      </td>
      <td class="pl-5">
        <h2>ClinGen's infoButton Profile</h2>
        <p>Lorem ipsum dolor sit amet, vis partem detraxit facilisi ut. An eos nulla graeci possit, dico diceret usu ex, has autem dicat nobis ad. Te alii etiam partem qui, labore pertinax temporibus an qui. Sed cu summo tacimates.</p>
        <ul>
          <li>Qui quodsi appetere an, vix soleat euismod lucilius no. </li>
          <li>Ex nec integre evertitur forensibus, at nullam senserit vim.</li>
          <li>Dolorum luptatum at est, id alia aeque vituperatoribus mei, est at verear intellegebat consectetuer.</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, vis partem detraxit facilisi ut. An eos nulla graeci possit, dico diceret usu ex, has autem dicat nobis ad. Te alii etiam partem qui, labore pertinax temporibus an qui. Sed cu summo tacimates.</p>
      </td>
      </tr>
    </table>
  <hr />
  <h3>List of Genomic Resources</h3>
  Navigate each genomic resources below and query each resource individually. 
	<?=$render_items ?>
</div>
