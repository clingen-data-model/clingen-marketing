<?

//if (isset($_SERVER["HTTP_ORIGIN"]) === true) {
//	$origin = $_SERVER["HTTP_ORIGIN"];
//	$allowed_origins = array(
//		"http://localhost:3000",
//		"https://www.clinicalgenome.org"
//	);
//	if (in_array($origin, $allowed_origins, true) === true) {
//		header('Access-Control-Allow-Origin: ' . $origin);
//		header('Access-Control-Allow-Credentials: true');
//		header('Access-Control-Allow-Methods: GET');
//		header('Access-Control-Allow-Headers: Content-Type');
//	}
//	if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
//		exit; // OPTIONS request wants only the policy, we can stop here
//	}
//}



$siteRoot               = $pages->get('/');
$pageTitle         =  ($page->id == $pages->get('/')->id) ?  $page->title : "{$page->title} - ClinGen | Clinical Genome Resource";
$pageSeoDesc       =  ($page->seo_description) ?  $page->seo_description : $page->summary;
$pageSeoKeywords       =  ($page->metadata_search_terms) ?  $page->metadata_search_terms : $pageTitle;

$feedback_url     = $page->httpUrl;
$feedback_title   = $page->title;
$feedback_title   = rawurlencode($feedback_title);
$feedback_url     = rawurlencode($feedback_url);
$feedback_ref     = "edwg";
$typeahead_url    = $pages->get(3530)->url_general;


$showSearchBar    = ($page->rootParent == "1018") ? "" : "style='display: none'";

include("App/Views/Partials/render_search_bar.php"); 
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?=$pageSeoDesc ?>">
  <meta name="keywords" content="<?=$pageSeoKeywords ?>">
  <meta name="author" content="Clinical Genome Resource">

  <title><?=$pageTitle ?></title>

  <!-- Bootstrap core CSS -->
  <!--    <link href="<?= $config->urls->templates ?>resources/packages/bootstrap/css/bootstrap.css" rel="stylesheet">-->
  <link href="<?= $config->urls->templates ?>resources/packages/bootstrap-3-4-1/css/bootstrap.css" rel="stylesheet">
  <!--    <link href="<?= $config->urls->templates ?>resources/packages/bootstrap-4-3-1/css/bootstrap.css" rel="stylesheet">-->

  <!-- Custom styles for this template -->
  <link href="<?= $config->urls->templates ?>resources/css/master.css" rel="stylesheet">

  <link href="<?= $config->urls->templates ?>resources/packages/fontawesome/css/all.min.css" rel="stylesheet">
  
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-49947422-1', 'auto');    //7
    ga('send', 'pageview');

  </script>

</head>

<body>

  <? include("App/Views/Partials/render_header_options.php"); ?>

  <header>

    <nav class="navbar navbar-light">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="btn btn-lg mt-4 btn-outline-primary navbar-toggle pull-right collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            Navigation <i class="fas fa-bars"></i>
          </button>
          <a class="navbar-brand" href="/"><img style="height:80px" src="<?= $config->urls->templates ?>resources/img/logo/logo-clinical-genome-logo-vector.svg" class="img-fluid p-0" alt="Responsive image"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right mt-4">
            
            <? include("App/Views/Partials/render_header_navigation_main.php") ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
      <div id="navSearchBar" <?=$showSearchBar  ?>>
        <div class="container">
          
          <?=$search_main ?>
        </div>
      </div>
    </nav>
  </header>

  <main id='section_main' role="main">

    <section id='section_heading' class="section-heading section-heading-groups text-light">
      <div  class="container">
        <h1><?= $page->title ?></h1>
      </div>
    </section>
    <section id='section_content' class="container">
    </section>

  </main>

  <div class="" id="clingen_contact">
    <a href="<?=$pages->get(1140)->httpUrl ?>?title=<?=$feedback_title ?>&page=<?=$feedback_url ?>&ref=<?=$feedback_ref ?>">
      <i class="far fa-envelope clingen_contact_icon"></i>
      <div class="">Send Feedback</div>
    </a>
  </div>

  <footer class="text-muted">
    <div id='section_footer' class="container">
      <? include("App/Views/Partials/render_footer.php") ?>
      <p class="float-right">
        <a href="#">Back to top</a>
      </p>
      <p> &copy; ClinGen</p>
    </div>
  </footer>




  <? include("App/Views/Partials/_footer_for_admin.php") ?>

    <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script  src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

      <script src="<?= $config->urls->templates ?>resources/packages/popper/popper.min.js"></script>
      <!--    <script src="<?= $config->urls->templates ?>resources/packages/bootstrap/js/bootstrap.min.js"></script>-->
      <script src="<?= $config->urls->templates ?>resources/packages/bootstrap-3-4-1/js/bootstrap.js"></script>
      <!--    <script src="<?= $config->urls->templates ?>resources/packages/bootstrap-4-3-1/js/bootstrap.js"></script>-->
      <script src="<?= $config->urls->templates ?>resources/packages/list/list.js"></script>
      <script src="<?= $config->urls->templates ?>resources/js/master.js"></script>
      <script src="<?= $config->urls->templates ?>resources/js/tooltips.js"></script>
      <script src="<?= $config->urls->templates ?>resources/js/list-filters.js"></script>
      <?=$footer_js ?>
      <script>
       
        $( "#navSearchToggle" ).click(function() {
          $( "#navSearchBar" ).toggle();
        });
        
      // Allows Tabs to show on page load
      $(function(){
        var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');

        $('.nav-tabs a').click(function (e) {
          $(this).tab('show');
          var scrollmem = $('body').scrollTop() || $('html').scrollTop();
          window.location.hash = this.hash;
          $('html,body').scrollTop(scrollmem);
        });
      });
      
      // Update Address bar on tab state change
      $('.nav-url-state a').click(function() {
        var location  = "<?=$page->httpUrl ?>";
        var href      = $(this).attr("href");
        var update    = location + href;
        var stateObj = { state: update };
        history.pushState(stateObj, "<?=$page->title ?>", update);
      });
      
    </script>
    <script src="<?= $config->urls->templates ?>resources/js/typeahead.js"></script>    
    <script>
      $( ".typeQueryGene" ).click(function() {
        $( ".inputQueryGene" ).show();
        $( ".inputQueryDisease" ).hide();
        $( ".typeQueryLabel").text("Gene");
      });
      $( ".typeQueryDisease" ).click(function() {
        $( ".inputQueryGene" ).hide();
        $( ".inputQueryDisease" ).show();
        $( ".typeQueryLabel").text("Disease");
      });
      
      
      var term = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: '<?=$typeahead_url?>/home.json?term=%QUERY',
          wildcard: '%QUERY'
        }
      });
      
      var termGene = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: '<?=$typeahead_url?>/home.json?termGene=%QUERY',
          wildcard: '%QUERY'
        }
      });
      
      var termDisease = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('label'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
          url: '<?=$typeahead_url?>/home.json?termDisease=%QUERY',
          wildcard: '%QUERY'
        }
      });


      $('.queryTerm').typeahead(null,
      {
        name: 'term',
        display: 'label',
        source: term,

        limit: 20,
        minLength: 3,
        highlight: true,
        hint: false,
        autoselect:true,
      }).bind('typeahead:selected',function(evt,item){
        window.location = item.url;
      });
      
      $('.queryDisease').typeahead(null,
      {
        name: 'termDisease',
        display: 'label',
        source: termDisease,

        limit: 20,
        minLength: 3,
        highlight: true,
        hint: false,
        autoselect:true,
      }).bind('typeahead:selected',function(evt,item){
        window.location = item.url;
      });
      
      $('.queryGene').typeahead(null,
      {
        name: 'termGene',
        display: 'label',
        source: termGene,

        limit: 20,
        minLength: 3,
        highlight: true,
        hint: false,
        autoselect:true,
      }).bind('typeahead:selected',function(evt,item){
        window.location = item.url;
      });

    </script>
    
    <script type="text/javascript">
      // Used to toggle the documents
      $(document).ready(function () {
        $('#filter_list :checkbox').click(function () {
          
          // First, clear all
          $('.list-group-item-document').hide();
          // Make sure the show all at bottom is hidden
          $('.btn_list_all_documents_bottom').hide();
          
          // Now do the smart stuff
          if ($('input:checkbox:checked').length) {
            $('#list_documentation_table li').hide();
            $('input:checkbox:checked').each(function () {
              $('li[data-' + $(this).prop('name') + '*="' + $(this).val() + '"]').show();
            });
          } else {
            $("#list_documentation_table li").show();
          }
        });
        
        // Used to show all of the documents
        $('.btn_list_all_documents').click(function () {
            // Make all checked filters unchecked
            $('#filter_list :checkbox'). prop("checked", false);
            // Show all the documents
            $('.list-group-item-document').hide();
            $('.list-group-item-document').show();
            // Hide buttom button
            $('.btn_list_all_documents_bottom').hide();
        });
        
        
      });

    </script>

    
  </body>
  </html>
