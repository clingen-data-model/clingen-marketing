<?

/**
 * Main Navigation
 */
foreach ($siteRoot->children as $key => $value) {

  // Set the title here so it can get overridden
  $pageTitle = $value->title;
  
  if($value->id == $page->id) {
    $option['css'] = 'active';
  } else {
    $option['css'] = null;
  }

  if($value->children->count() > 30) {
    $option['footer-col'] = 'col-md-6 text-truncate';
    $option['dropdown-li'] = 'dropdown';
    $option['dropdown-li-a'] = 'dropdown-toggle';
    $option['dropdown-child-li'] = 'col-md-6 float-right pt-1 pl-3 pr-4';
    $option['dropdown-children-ul'] = 'row dropdown-menu dropdown-width-triple dropdown-menu-right dropdown-menu-lg-left';
    //$option['dropdown-li-a-data'] = ' data-toggle="dropdown"';
  } else if($value->children->count() > 20) {
    $option['footer-col'] = 'col-md-6 text-truncate';
    $option['dropdown-li'] = 'dropdown';
    $option['dropdown-li-a'] = 'dropdown-toggle';
    $option['dropdown-child-li'] = 'col-md-6 float-right pt-1 pl-3 pr-4';
    $option['dropdown-children-ul'] = 'row dropdown-menu dropdown-width-double dropdown-menu-right dropdown-menu-lg-left';
    //$option['dropdown-li-a-data'] = ' data-toggle="dropdown"';
  } else if($value->children->count() > 10) {
    $option['footer-col'] = 'col-md-6 text-truncate';
    //$option['dropdown-li-a-data'] = ' data-toggle="dropdown"';
  } else if ($value->children->count()) {
    $option['footer-col'] = 'col-md-12 text-truncate';
    $option['dropdown-li'] = 'dropdown';
    $option['dropdown-li-a'] = 'dropdown-toggle';
    $option['dropdown-child-li'] = '';
    $option['dropdown-children-ul'] = 'row dropdown-menu dropdown-width-normal  dropdown-menu-right dropdown-menu-lg-left';
    //$option['dropdown-li-a-data'] = ' data-toggle="dropdown"';
  } 

  if($value->template == "tool-index") {
    unset($option);
    unset($nav_child);
  }else if($value->id == 1015) {
    
    $option['dropdown-li'] = 'dropdown';
    $option['dropdown-li-a'] = 'dropdown-toggle';
    $option['dropdown-child-li'] = '';
    $option['dropdown-children-ul'] = 'row dropdown-menu dropdown-width-triple dropdown-menu-right dropdown-menu-lg-left';
    
    foreach ($value->children as $key => $child) {
      if($child->expert_panel_type == "1") {
        $nav_child_gcep  .= "
        <li class='nav-item {$option['dropdown-child-li']}'>
          <a class='nav-link nav-link-header mb-0' href='{$child->httpUrl}'><span class=' d-inline-block text-truncate'>{$child->title_short}</span></a>
        </li>
      ";
      } else {
      $nav_child_vcep  .= "
        <li class='nav-item {$option['dropdown-child-li']}'>
          <a class='nav-link nav-link-header mb-0' href='{$child->httpUrl}'><span class=' d-inline-block text-truncate'>{$child->title_short}</span></a>
        </li>
      ";
      }
      $nav_footer_child  .= "
        <li class='{$option['footer-col'] }'>
          <a class='text-dark small' href='{$child->httpUrl}'><span class=' d-inline-block '>{$child->title}</span></a>
        </li>
      ";
    }
    $nav_children = "
      <ul class=' {$option['dropdown-children-ul']}'>
        <li class='col-md-6 float-left pt-1 pl-3 pr-4'>
          <div class='text-muted'><strong>Gene Curation Expert Panels</strong></div>
          <ul class='list-unstyled border-top-1'>
            {$nav_child_gcep}
          </ul>
        </li>
        <li class='col-md-6 float-left pt-1 pl-3 pr-4'>
          <div class='text-muted'><strong>Variant Curation Expert Panels</strong></div>
          <ul class='list-unstyled border-top-1'>
            {$nav_child_vcep}
          </ul>
        </li>
      </ul>
    ";
    $nav_footer_children = "
      <ul class='list-unstyled row'>{$nav_footer_child}</ul>
    ";
    unset($nav_child);
    unset($nav_footer_child);
  }else if($value->id == 1018) {
    // Curation Activities
    $option['dropdown-li'] = 'dropdown';
    $option['dropdown-li-a'] = 'dropdown-toggle';
    $option['dropdown-child-li'] = '';
    $option['dropdown-children-ul'] = 'row dropdown-menu dropdown-width-normal  dropdown-menu-right dropdown-menu-lg-left';
    
    foreach ($value->children() as $key => $child) {
      if($child->id == "2234") {
        $nav_child  .= "
          <li class='divider'></li>
        ";
      }
      $nav_child  .= "
        <li class='nav-item {$option['dropdown-child-li']}'>
          <a class='nav-link nav-link-header' href='{$child->httpUrl}'><span class=' d-inline-block text-truncate'> {$child->title}</span></a>
        </li>
      ";
//      if($child->children()->first){
//        $nav_child  .= "
//          <li class='nav-item {$option['dropdown-child-li']}'>
//            <a class='nav-link nav-link-small pl-4' href='{$child->children()->first->httpUrl}'><span class=' d-inline-block text-truncate'><i class='fas fa-angle-double-right text-muted-more'></i> {$child->children()->first->title}</span></a>
//          </li>
//        ";
//      }
      if($child->children("template=curation-training-index")->first){
        
        $child_title = ($child->children("template='curation-training-index")->first->title_tab) ? $child->children("template='curation-training-index")->first->title_tab : $child->children("template='curation-training-index")->first->title;
        $nav_child  .= "
          <li class='nav-item {$option['dropdown-child-li']}'>
            <a class='nav-link nav-link-small pl-4' href='{$child->children("template='curation-training-index")->first->httpUrl}'><span class=' d-inline-block text-truncate'><i class='fas fa-angle-double-right text-muted-more'></i> {$child_title}</span></a>
          </li>
        ";
      }
      if($child->children("template=redirect-curations")->first){
        $child_title = ($child->children("template='redirect-curations")->first->title_tab) ? $child->children("template='redirect-curations")->first->title_tab : $child->children("template='redirect-curations")->first->title;
        
        $nav_child  .= "
          <li class='nav-item {$option['dropdown-child-li']}'>
            <a class='nav-link nav-link-small pl-4' href='{$child->children("template='redirect-curations")->first->httpUrl}'><span class=' d-inline-block text-truncate'><i class='fas fa-angle-double-right text-muted-more'></i> {$child->children("template='redirect-curations")->first->title}</span></a>
          </li>
        ";
      }
      $nav_footer_child  .= "
        <li class='{$option['footer-col'] }'>
          <a class='text-dark small' href='{$child->httpUrl}'><span class='d-inline-block text-truncate'>{$child->title}</span></a>
        </li>
      ";
    }
    $nav_children = "
      <ul class=' {$option['dropdown-children-ul']}'>{$nav_child}</ul>
    ";
    $nav_footer_children = "
      <ul class='list-unstyled row'>{$nav_footer_child}</ul>
    ";
    unset($nav_child);
    unset($nav_footer_child);
  } else if($value->id == 1019) {
    
    $pageTitle = "Documents <span class='visible-inline-lg hidden-md visible-inline-xl visible-inline-sm visible-inline-xs'> &amp; Annoucements</span>";
    
    $option['dropdown-li'] = 'dropdown';
    $option['dropdown-li-a'] = 'dropdown-toggle';
    $option['dropdown-child-li'] = '';
    $option['dropdown-children-ul'] = 'row dropdown-menu dropdown-width-normal  dropdown-menu-right dropdown-menu-lg-left';
    
    foreach ($pages->get(2113)->children() as $key => $child) {
      $nav_child  .= "
        <li class='nav-item {$option['dropdown-child-li']}'>
          <a class='nav-link nav-link-header' href='{$value->httpUrl}?doc-type={$child->name}#list_documentation_table'><span class=' d-inline-block text-truncate'><img src=\"{$child->image_svg->url}\" class='svg-h-text' alt=\"{$child->title}\">{$child->title}</span></a>
        </li>
      ";
      $nav_footer_child  .= "
        <li class='{$option['footer-col'] }'>
          <a class='text-dark small' href='{$value->httpUrl}?doc-type={$child->name}#list_documentation_table'><span class=' d-inline-block text-truncate'><img src=\"{$child->image_svg->url}\" class='svg-h-text' alt=\"{$child->title}\">{$child->title}</span></a>
        </li>
      ";
    }
    $nav_children = "
      <ul class=' {$option['dropdown-children-ul']}'>{$nav_child}</ul>
    ";
    $nav_footer_children = "
      <ul class='list-unstyled row'>{$nav_footer_child}</ul>
    ";
    unset($nav_child);
    unset($nav_footer_child);
  }else if($value->children->count()) {
    foreach ($value->children() as $key => $child) {
      
      $nav_child  .= "
        <li class='nav-item {$option['dropdown-child-li']}'>
          <a class='nav-link nav-link-header' href='{$child->httpUrl}'><span class=' d-inline-block text-truncate'>{$child->title}</span></a>
        </li>
      ";
      $nav_footer_child  .= "
        <li class='{$option['footer-col'] }'>
          <a class='text-dark small' href='{$child->httpUrl}'><span class='d-inline-block text-truncate'>{$child->title}</span></a>
        </li>
      ";
    }
    $nav_children = "
      <ul class=' {$option['dropdown-children-ul']}'>{$nav_child}</ul>
    "; 
    $nav_footer_children = "
      <ul class='list-unstyled row'>{$nav_footer_child}</ul>
    ";
    unset($nav_child);
    unset($nav_footer_child);
  }
  
  if($value->id == "1020") {
    unset($nav_children);
  }
  $render_nav_main_item .= "
    <li class='nav-item  {$option['css']} {$option['dropdown-li']}'>
      <a class='nav-link nav-link-header {$option['dropdown-li-a']}' {$option['dropdown-li-a-data']} href='{$value->httpUrl}'>{$pageTitle}</a>
      {$nav_children}
    </li>
  ";
  
  $render_nav_footer_item["id_{$value->id}"] .= "
      <a class='' href='{$value->httpUrl}'><h6>{$value->title}</h6></a>
      {$nav_footer_children}
  ";
  unset($nav_footer_children);
  /* <li class="nav-item dropdown">
        <a class="nav-link nav-link-header dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
     */
}



$render_nav_main_item .= "
    
      <li class='navbar-text navbar-text-hover' id='navSearchToggle'><i class='fas fa-search text-muted'></i></li>
  ";

echo $render_nav_main_item;
unset($render_nav_main_item);

?>
