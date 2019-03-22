<?

/**
 * Child Pages
 */
$documentation_items = $fetch = $pages->get("template=document-index")->children("relate_groups=$page->id");
if($documentation_items) {

  $render_documents_array = array();

  $render_documents_array["types"]['all']["count"] = $documentation_items->count();
  $render_documents_array["types"]['all']["title"] = "All Documents";

  foreach ($documentation_items as $key => $value) {
    //$render_array["{$value->template->name}"] = "{$value->template->title}";

    $render_documents_array["types"]["{$value->relate_type_document->name}"]["title"] = 
      "{$value->relate_type_document->title}";

    $count = $render_documents_array["types"]["{$value->relate_type_document->name}"]["count"];
    $count = $count + 1;
    $render_documents_array["types"]["{$value->relate_type_document->name}"]["count"] = $count;


    if($value->relate_type_document->title){
      $relate_type_document = "<div class='small'><i class=\"fas fa-angle-right\"></i> {$value->relate_type_document->title}</div>";
    } else {
      $relate_type_document = "";
    }

    $render_documents .= "
      <li class=' list-group-item'>
          <div class='col-10'>
            <div class='mr-auto pr-3'>
            </div>
            <div class='mr-auto  flex-grow-1'>
              <a class='title' href='{$value->httpUrl}'><strong>{$value->title}</strong></a>
              <div class='small text-muted'><strong><i class='far fa-file'></i> {$value->relate_type_document->title}  - </strong> {$value->document_date} {$render_summary}</div>
              {$render_relate_groups}
              
            </div>
          </div>
          <div class='ml-auto col-1'>
            {$value->documentation_date}
          </div>
      </li>
    ";

    }
    foreach ($render_documents_array["types"] as $key => $value) {
      $render_documents_nav .= "
        <a href='#{$key}' class='small list-group-item list-group-item-action d-flex justify-content-between align-items-center'>
            {$value['title']} <span class=\"badge badge-pill badge-secondary\">{$value['count']}</span>
        </a>
      ";
    }
  }


if($documentation_items->count()) {

  $nav_pill['documents'] = "<a href='#heading_documents' class='badge badge-pill badge-info p-2 mr-2'>Documents <i class='fas fa-arrow-circle-down'></i></a>";

  $render_documents = "
  <h3 id='heading_documents' class=\"mt-5\">Documents</h3>
  <span class='badge badge-warning mb-3'>TEMP NOTE - This features sort/filting isn't fully completed. In process</span>
    <div class='row no-gutters'>
      <div class='col-md-9'>
        <div class='card mb-3' id='list_documentation_table'>
          <div class='card-header w-100 input-group mb-0'>
            <input type='text' class='form-control search' placeholder='Filter list...' aria-label='Filter list'>
        </div>
        <ul class='list-group list-group-flush list'>
            {$render_documents}
            </ul>
        </div>
      </div>
      <div class='col-md-3'>
        <ul class='list-group list-group-flush border-bottom-1'>
            {$render_documents_nav}
          </ul>
      </div>
    </div>

  ";

  unset($render_documents_nav);
}
?>