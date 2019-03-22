<div pw-replace="section_heading" class="pb-0">
  <div  class="container">
  	<div class="content" edit="body_1">
	    <?= $page->body_1 ?>
	  </div>
    <ul class="nav-tabs-affiliates nav nav-tabs nav-fill row text-center">
      <li class="nav-item col-sm-6">
        <a class="nav-link active" href="<?=$pages->get("template=working-group-type-cdwg-index")->httpUrl?>">
        	<div class="row">
        		<div class="col-12 strong">
        			Clinical Domain Working Groups
        		</div>
        		<div class="col-sm-6 small">
        			Gene Curation Expert Panels
        		</div>
        		<div class="col-sm-6 small">
        			Variant Curation Expert Panels
        		</div>
        	</div>
        </a>
      </li>
      <li class="nav-item col-sm-2">
        <a class="nav-link" href="<?=$pages->get(1043)->httpUrl?>">
        	<div class="row">
        		<div class="col-12 strong">
        			Gene Curation Working Group
        		</div>
        	</div>
      	</a>
      </li>
      <li class="nav-item col-sm-2">
        <a class="nav-link" href="<?=$pages->get(1038)->httpUrl?>">
        	<div class="row">
        		<div class="col-12 strong">
			        Dosage Sensitivity Working Group
			      </div>
			    </div>
      	</a>
      </li>
      <li class="nav-item col-sm-2">
        <a class="nav-link" href="<?=$pages->get(1032)->httpUrl?>">
        	<div class="row">
        		<div class="col-12 strong">
        			Clinical Actionability Working Group
			      </div>
			    </div>
	      </a>
      </li>
    </ul>
  </div>
</div>
<div pw-before="section_content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?= $page->body_2 ?>
			</div>
			<div class="col-sm-6">
				<div class="card">
				  <div class="card-body">
				    <?= $page->body_3 ?>
				  </div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
				  <div class="card-body">
				    <?= $page->body_4 ?>
				  </div>
				</div>
			</div>
		</div>
		<hr />
	</div>
</div>
<div pw-append="section_content">
	<? include("App/Views/Partials/render_cdwg_eps_rich_list.php"); ?>
</div>
