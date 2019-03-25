<?php
   if($user->isSuperuser() || $user->hasRole('coordinator')) {
      // If the page is editable, then output a link that takes us straight to the page edit screen:
      if($page->editable()) {
         $editable = "<ul class='visible-inline-md visible-inline-lg visible-inline-xl m-0 p-1 list-inline pull-left'><li class='text-light'>LOGGED IN:</li><li class=''><a class=' text-white' href='{$config->urls->admin}'><i class='fas fa-list-ul'></i> Pages</a></li><li class=''>|</li><li class=''><a class=' text-white' href='{$config->urls->admin}page/edit/?id={$page->id}'><i class='fas fa-edit'></i> Edit Page</a></li><li class=''>|</li><li class=''><a class=' text-white' href='/clingensidedoor/page/add/?parent_id=1019'><i class='fas fa-file'></i> Add Doc</a></li><li class=''>|</li><li class=''><a class=' text-white' href='{$config->urls->admin}login/logout/'><i class='fas fa-sign-out-alt'></i> Logout</a></li></ul>"; 
      }
   }
?>

<div class="section-heading section-heading-groups">
  <div class="container text-right small text-muted">
    <div class="container">
      	<?=$editable ?>
      	<ul class="list-inline pull-right m-0 p-1">
      	  <li class=''>
      	    <a class=' text-white' href='<?=$pages->get(3053)->httpUrl ?>'><span class="visible-inline-md visible-inline-lg visible-inline-xl">Data Sharing Resources</a>
      	  </li>
      	  <li class=''>
      	    <a class=' text-white' href='<?=$pages->get(2303)->httpUrl ?>'>GenomeConnect</a>
      	  </li>
      	  <li class='visible-inline-md visible-inline-lg visible-inline-xl'>
      	    <a class=' text-white' href='<?=$pages->get(1086)->httpUrl ?>'>Events</a>
      	  </li>
      	  <li class='visible-inline-md visible-inline-lg visible-inline-xl'>
      	    <a class=' text-white' href='<?=$pages->get(3482)->httpUrl ?>'>Contact</a>
      	  </li>
      	</ul>
      </div>
  </div>
    </div>



