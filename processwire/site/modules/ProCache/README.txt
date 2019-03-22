ProcessWire Pro Cache
=====================

Copyright 2017 by Ryan Cramer Design, LLC

Read the more detailed HTML version of this README at: 
https://processwire.com/api/modules/procache/


PLEASE DO NOT DISTRIBUTE
========================

This service/software is authorized for use only for the site it was 
purchased for. It should not be distributed beyond the site you 
registered it for, except for staging and/or development servers 
related to the site. 

You may register for a new site at: https://processwire.com/ProCache/


ABOUT PROCACHE
==============

ProCache provides the ultimate performance for your website by 
completely bypassing PHP and MySQL and enabling your web server to 
deliver pages of your ProcessWire site as if they were static HTML 
files. 

The performance benefits are major and visible. Using ApacheBench with 
the homepage of the Skyscrapers site profile, we completed 500 requests 
(10 concurrent) to the homepage. The amount of time occupied to 
complete each of these was as follows:

  * 29 seconds: no cache enabled
  * 6 seconds: built-in cache enabled
  * 0.017 seconds: ProCache enabled

These are typical results. As you can see, the performance benefits are
huge. ProCache gives you the ability to drastically reduce server 
resources and exponentially increase the amount of traffic your server
could handle. This is especially useful for traffic spikes. 

Beyond measurements, ProCache makes your website feel faster to users,
respond faster to search spiders (which can help with SEO), and helps
to conserve server resources for requests that actually need PHP and
MySQL. ProcessWire is already very fast, and not everybody necessarily 
needs what ProCache delivers. But regardless of whether you need it or
not, there is little doubt that you can benefit greatly from ProCache. 


REQUIREMENTS
============

  * ProcessWire 2.7.3 or newer (ProCache 3.0)
  * ProcessWire 2.5.3 or newer (ProCache 2.0)
  * Apache web server or 100% compatible


BEFORE INSTALLING
=================

ProCache changes the way your website delivers pages. While it is both
safe and easily reversible, make sure you have a full backup of your 
website before installing ProCache.

ProCache writes to your .htaccess file. It also removes any changes it
makes if you uninstall ProCache. However, for good housekeeping, we 
recommend you also backup your .htaccess file if you have modified it 
from the default ProcessWire htaccess file. 


HOW TO INSTALL
==============

1. Copy the ProCache files into this directory: /site/modules/ProCache/ 
2. In your ProcessWire admin, go to Modules and "Check for new modules".
3. Click "Install" for the ProCache module. 
4. Enter your license key in the field provided and 'submit'.
5. Go to Setup > Pro Cache and configure your Pro Cache settings. 


USING PROCACHE
==============

ProCache is never running when you are logged-in, so you'll want to 
test the results from another browser, or after logging out. 

After making changes on the ProCache configuration screen, if you don't
see your changes reflected on the front-end of your site, be sure to 
clear the cache. 

If you want to verify what pages are being cached, turn on the test/debug
mode from the ProCache module config screen. This will make it add a line
of text before your closing </body> tag indicating when the page was 
cached. You will only see it on a cached page. If you know a page should
be cached and you don't see it, 1) make sure you aren't logged in; 
2) hit 'reload' in your browser; 3) if you haven't cleared the cache since
enabling test/debug mode, clear it. 

If you are testing on localhost, or on another server where you have
multiple ProcessWire installations, this may prevent ProCache from 
delivering cached pages to you. Clear your cookies, specifically one
called "wire_challenge" and that should fix it. 

ProCache can be used in combination with other caches, such as the built-in
Page caching that you set per-template in the template editor. However, 
there isn't necessarily a reason to keep using it when you are using
ProCache. To reduce confusion, we recommend you stop using the built-in
page caching features when you are using ProCache. However, if you are 
currently using MarkupCache, you should continue to do so. 


PROCACHE MAINTENANCE
====================

ProCache runs a maintenance task every 30-60 seconds to remove expired 
cache files. However, this maintenance is dependent upon the occurrence 
of non-cached pageviews. Since ProcessWire itself never actually runs 
when a cached page is displayed, it doesn't have the opportunity to run 
maintenance tasks. Most sites have some cached pages and some uncached 
pages, so this is not an issue. However, if most of your site's pages
are cached, you should add a cron job to trigger maintenance. Otherwise
your cached pages may never expire. Likewise, even if you just want high 
accuracy with regard to when cache files are expired, you should add a 
cron job to trigger maintenance.

Your cron job should execute the following command every minute:

   curl --data "procache=maintenance" http://domain.com/ > /dev/null

Replace "domain.com" above with your ProcessWire-powered site's URL,
including the trailing slash (and subdirectory, if applicable). 

Set this command to execute every minute or so. If you aren't too 
worried about being exact, every 5 minutes should also be fine. 


PROCACHE FROM THE API
=====================

ProCache provides a few public methods that you may use from the API
side if you find it useful to do so. First, you'd want to have a copy
of ProCache to call methods from:

   $cache = wire('modules')->get('ProCache');

You may execute the following commands from it: 

   // Manually clear the entire cache
   $cache->clearAll();

   // Manually clear the cache for a page
   $cache->clearPage($page); 

   // Return the number of cached pages
   $n = $cache->numCachedPages();

   // Is the given page cached? Returns false if not, or array of 
   // page info if yes: array('/path/to/page' => 'date cached') 
   $info = $cache->pageInfo($page);


CACHING OTHER CONTENT TYPES
===========================
As of version 2.0.2 of ProCache and version 2.5.26 of ProcessWire, 
ProCache can cache and deliver other content types in addition html.
For example, perhaps you want to cache an XML sitemap or a JSON feed
with ProCache. 

Content types can be defined in your /site/config.php file like this:

  $config->contentTypes = array(
    'html' => 'text/html',
    'txt' => 'text/plain', 
    'json' => 'application/json',
    'xml' => 'application/xml', 
   );

The above setting represents the default as available in
/wire/config.php, so if the above is consistent with your needs 
then you do not need to set it up in /site/config.php.*

If you do modify it, you may add as many other content types as you'd 
like. The array keys should represent the file extension defined by 
an Apache mime-type. The array values represent the content type 
header that ProcessWire sends before outputting the page. 

Each template has one of the defined content types specified for it.
This is specified by editing a template in the admin, by going to:
Setup > Templates > [any-template] > Files > Content Types. Select
which content type the template should output. If nothing is selected
then PHP's default "text/html" content type is used. 


*Note that ProCache only uses the file extensions (array keys). In 
using those file extensions for the physical cache files, Apache 
recognizes them and sends the appropriate content-type headers 
just as ProcessWire does. This is what enables you to cache non-HTML 
content with ProCache, despite the fact that PHP is never loaded 
when the cached output is delivered. 


TROUBLESHOOTING CACHE ISSUES
============================

If the cache does not appear to be working: 

  1. Make sure you are not logged in to ProcessWire, as the cache is always 
     disabled when you are logged in. 
     
  2. If you have been logged in recently, sometimes certain cookies
     will still be present that prevent caching. Try testing from 
     a new Incognito (Private Mode) browser window.
     
  3. While rare, some servers need specific adjustments to the .htaccess 
     file. In the rules that ProCache adds to it, try removing this 
     string of text on the lines where it appears (with the trailing slash): 
     
     %{DOCUMENT_ROOT}\
     
  4. If step 3 didn't solve it, try instead to replace that %{DOCUMENT_ROOT}
     above with the actual server path to the document root. You can get this
     information from phpinfo(); or if logged in to a shell on the server, you 
     can reveal it by typing "pwd" and hit enter. 


JS/CSS/SCSS/LESS MERGE AND MINIFY FROM THE API
==============================================

Files can be merged and minified from the API, which gives you more control 
compared to using auto-detection of <link> or <script> tags. To do this, do 
not select the CSS/JS “Merge” options in the ProCache Minify tab. Instead use 
the built-in API methods for JS, CSS, or both; described below. 

SCSS and LESS files are automatically compiled and may be substituted for any 
CSS file mentioned here. The $procache->css() and $procache->js() methods 
output the minified filename. Pass them an array or CSV string of 
URLs/filenames to merge and minify:

  <link rel="stylesheet" href="<?= $procache->css(
    [
      'styles/a.css', 
      'styles/b.scss', 
      'styles/c.less'
    ]
  ) ?>">
  
  <script src="<?= $procache->js(
    [
      'scripts/a.js', 
      'scripts/b.js'
    ]
  ]) ?>"></script>
  
The following is the same as above, but using a CSV string for the list 
of files, rather than an array:

  <link rel="stylesheet" href="<?= $procache->css('styles/a.css, styles/b.scss, styles/c.less') ?>">
  <script src="<?= $procache->js('scripts/a.js, scripts/b.js') ?>"></script>
  
The link() and script() methods work the same as the css() and js() 
methods, except that they output the entire <link> or <script> tag, 
which might save you a step:

  <?= $procache->link("styles/a.css, styles/b.scss, styles/c.less") ?>
  <?= $procache->script("scripts/a.js, scripts/b.js") ?>
  
Provided files may be a CSV string of file URLs or an array of file 
URLs. File URLs that do not begin with a slash "/" are assumed to be 
relative to /site/templates/. Avoid different combinations of files 
depending on the page/template, as this will create multiple minified 
files with potentially redundant content. If you need files to be 
added in some cases and not others, then use a completely separate 
call for those files.



UPGRADES
========

Upgrades are made available through the ProcessWire ProCache support 
board at https://processwire.com/talk/. If you can't see the support board
there, please email ryan@processwire.com or send a PM to ryan from the
ProcessWire forums. 

To install an upgrade you would typically just replace the old files 
with the new. However, there may be more to it, depending on the version.
Always follow any instructions provided with the upgrade version in
the support board. 


PROCACHE VIP SUPPORT
====================

Your ProCache service includes 1-year of VIP support through the ProcessWire 
ProCache forum. In order to activate this service, you need to sign up for 
a forum account at http://processwire.com/talk/ (if you don't already have one). 

Please send a private message (PM) to 'ryan' or contact us at: 
https://processwire.com/contact/ and let us know what your forum name is so that 
we can upgrade your member access.

VIP support is also available by email: ryan@processwire.com


HAVE QUESTIONS OR NEED HELP?
============================

Send an email to ryan@processwire.com. You may also post in the ProcessWire 
forums at https://processwire.com/talk/. 


TERMS AND CONDITIONS
====================

You may not copy or distribute ProCache, except on site(s) you have registered it 
for with Ryan Cramer Design, LLC. It is okay to make copies for use on staging 
or development servers specific to the site you registered for. 

This service/software includes 1-year of support through the ProcessWire ProCache
Support forum and/or email. Please notify us of your forum name so that we can 
upgrade your access to the members-only ProCache Support forum.

In no event shall Ryan Cramer Design, LLC or ProcessWire be liable for any special, 
indirect, consequential, exemplary, or incidental damages whatsoever, including, 
without limitation, damage for loss of business profits, business interruption, 
loss of business information, loss of goodwill, or other pecuniary loss whether 
based in contract, tort, negligence, strict liability, or otherwise, arising out of 
the use or inability to use ProcessWire ProCache, even if Ryan Cramer Design, LLC / 
ProcessWire has been advised of the possibility of such damages. 

ProCache is provided "as-is" without warranty of any kind, either expressed or 
implied, including, but not limited to, the implied warranties of merchantability and
fitness for a particular purpose. The entire risk as to the quality and performance
of the program is with you. Should the program prove defective, you assume the cost 
of all necessary servicing, repair or correction. If within 7 days of purchase, you 
may request a full refund. Should you run into any trouble with ProCache, please
email for support or visit the ProCache Support forum. 


Thanks for using ProCache!

---

ProcessWire ProCache
Copyright 2017 by Ryan Cramer Design, LLC

