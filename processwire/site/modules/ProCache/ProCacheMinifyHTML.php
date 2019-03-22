<?php

/**
 * ProcessWire Pro Cache: HTML Minifier
 *
 * Copyright (C) 2017 by Ryan Cramer
 *
 * This is a commercially licensed and supported module
 * DO NOT DISTRIBUTE
 *
 * @property bool $removeComments Remove HTML comments? (default=true)
 * @property bool $convertXHTML Convert XHTML style "/>" closing tags to HTML ">"? (default=true)
 * @property bool $unquoteAttr Remove quotes from attributes, where allowed by HTML5? (default=true)
 * @property bool $collapseBooleanAttr Collapse boolean attributes, where allowed by HTML5? (default=true)
 * @property bool $removeUnnecessaryAttr Remove unnecessary/redundant attributes from HTML tags? (default=true)
 * @property bool $removeUnnecessaryTags Remove unnecessary/redundant HTML tags? (default=true)
 * @property bool $removeBlankAttr Remove blank attributes, where allowed? (configurable, default=true)
 * @property string|array $ignoreTags Tags that should be ignored during minification (default=see _construct method)
 * @property string|array $blocks Tags that we will collapse whitespace around (default=see _construct method)
 * @property string|array $blankAttrs Attributes that may be removed when blank (default=see _construct method)
 * @property callable $cssMinifyFunction Function to use for CSS minification (default=null)
 * @property callable $jsminifyFunction Function to use for JS minification (default=null)
 * 
 */

class ProCacheMinifyHTML {

	/**************************************************************************************
	 * OPTIONS/TOGGLES
	 *
	 * Use the setOption('optionName', true|false); to configure these
	 *
	 * @var array
	 *
	 */
	protected $options = array(

		// remove HTML comments?
		'removeComments' => true,

		// convert XHTML style "/>" closing tags to HTML ">"?
		'convertXHTML' => true,

		// remove quotes from attributes, where allowed by HTML5?
		'unquoteAttr' => true,

		// collapse boolean attributes, where allowed by HTML5?
		'collapseBooleanAttr' => true,

		// remove unnecessary/redundant attributes from HTML tags?
		'removeUnnecessaryAttr' => true,

		// remove unnecessary/redundant HTML tags?
		'removeUnnecessaryTags' => true,

		// remove blank attributes, where allowed? (configurable)
		'removeBlankAttr' => true,

	);


	/**************************************************************************************
	 * SETTINGS AND RULES (default values are populated in _construct)
	 *
	 */

	/**
	 * Default tags to ignore/skip from minification
	 *
	 * @var array
	 *
	 */
	protected $ignoreTags = array();

	/**
	 * Block level elements that we trim whitespace around
	 *
	 * Can be modified with the setBlocks() method
	 *
	 * @var array
	 *
	 */
	protected $blocks = array();

	/**
	 * Attributes that will be removed when blank
	 *
	 * Requires the unquoteAttributes option.
	 * Can be modified with the setRemoveBlankAttributes() method.
	 *
	 * @var array
	 *
	 */
	protected $blankAttrs = array();

	/**
	 * Attributes like checked="checked" that can be converted to just "checked" (if collapseBoleanAttributes=true)
	 *
	 * @var array
	 *
	 */
	protected $collapsibleBooleans = array();

	/**
	 * Attributes that are unnecessary and can be removed (if removeUnnecessaryAttributes=true)
	 *
	 * @var array
	 *
	 */
	protected $unnecessaryAttrs = array();

	/**
	 * Tags that aren't technically required in HTML markup and can be removed
	 *
	 * According to these HTML5 rules:
	 * http://www.w3.org/TR/2014/REC-html5-20141028/syntax.html#optional-tags
	 *
	 * See the definition for this in the _construct() method for more details.
	 *
	 * @var array
	 *
	 */
	protected $unnecessaryTags = array();

	/**
	 * Callback function for JS minification
	 * 
	 * @var callable|null
	 * 
	 */
	protected $jsMinifyFunction = null;
	
	/**
	 * Callback function for CSS minification
	 *
	 * @var callable|null
	 *
	 */
	protected $cssMinifyFunction = null;


	/**************************************************************************************
	 * RUNTIME PROPERTIES
	 *
	 */

	/**
	 * Keys to skip in main minify loop
	 *
	 * @var array of (key => key)
	 *
	 */
	protected $skipKeys = array();

	/**
	 * Lines to replace in main minify loop
	 *
	 * @var array of (key => replacement-line)
	 *
	 */
	protected $replaceLines = array();

	/**
	 * Whether this line starts a markup tag, and if so, the name of the tag
	 *
	 * @var null|bool|string Null or false if line does not start a tag, tag name if it does
	 *
	 */
	protected $startsTag = null;

	/**
	 * If previous line ended with a markup tag, the name of the tag
	 *
	 * @var null|bool|string
	 *
	 */
	protected $prevEndsTag = null;

	/**
	 * Whether or not the loop is currently in an ignored tag
	 *
	 * @var bool
	 *
	 */
	protected $inIgnoreTag = false;

	/**
	 * Whether or not we are in a conditional comment
	 *
	 * @var bool
	 *
	 */
	protected $inCC = false;

	/**
	 * Whether or not we are in an HTML comment
	 *
	 * @var bool
	 *
	 */
	protected $inComment = false;

	/**
	 * Whether or not a NoMinify comment is present in any of the markup
	 *
	 * @var bool
	 *
	 */
	protected $hasNoMinify = false;

	/**
	 * Last character of the previous line
	 *
	 * @var string
	 *
	 */
	protected $lastLineLastChar = '';

	/**
	 * Whether or not current line had trailing whitespace
	 *
	 * @var bool
	 *
	 */
	protected $hadTrailingWhitespace = false;

	/**
	 * Whether or not current line had leading whitespace
	 *
	 * @var bool
	 *
	 */
	protected $hadLeadingWhitespace = false;

	/**
	 * Whether or not the previous line had trailing whitespace
	 *
	 * @var bool
	 *
	 */
	protected $lastHadTrailingWhitespace = false;

	/**
	 * Open tags that we collapse whitespace around
	 *
	 * @var array
	 *
	 */
	protected $openBlocks = array();

	/**
	 * Close tags that we collapse whitespace around
	 *
	 * @var array
	 *
	 */
	protected $closeBlocks = array();

	/**
	 * Whether or not the current line has any kind of markup on it
	 *
	 * @var bool
	 *
	 */
	protected $hasMarkup = false;

	/**
	 * Individual lines of markup
	 *
	 * @var array of strings
	 *
	 */
	protected $lines = array();

	/**
	 * Whether or not in-memory caches should be reset
	 *
	 * @var array
	 *
	 */
	protected $resetCaches = true;


	/**************************************************************************************
	 * Construct and populate default settings
	 *
	 */
	public function __construct() {

		/**
		 * Default tags to ignore/skip from minification
		 *
		 */
		$this->ignoreTags = array(
			'script', 'style', 'pre', 'textarea',
		);

		/**
		 * Block level elements that we trim whitespace around
		 *
		 */
		$this->blocks = array(
			'!doctype', 'address', 'article', 'aside', 'audio', 'blockquote', 'body', 'br', 'button',
			'canvas', 'caption', 'col', 'colgroup', 'dd', 'div', 'dl', 'dt', 'embed', 'fieldset',
			'figcaption', 'figure', 'footer', 'form', 'head', 'header', 'hgroup', 'hr', 'html', 'li',
			'link', 'main', 'map', 'meta', 'nav', 'noscript', 'object', 'ol', 'optgroup', 'option',
			'output', 'p', 'pre', 'progress', 'script', 'section', 'table', 'tbody', 'td', 'tfoot',
			'th', 'thead', 'title', 'tr', 'ul', 'video', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
		);

		/**
		 * Attributes that will be removed when blank
		 *
		 */
		$this->blankAttrs = array(
			'class', 'dir', 'for', 'id', 'lang', 'style', 'title',
		);

		/**
		 * Attributes like checked="checked" that can be converted to just "checked" (if collapseBoleanAttributes=true)
		 *
		 */
		$this->collapsibleBooleans = array(
			'allowfullscreen', 'async', 'autofocus', 'autoplay', 'checked', 'compact', 'controls',
			'declare', 'default', 'defaultchecked', 'defaultmuted', 'defaultselected', 'defer',
			'disabled', 'draggable', 'enabled', 'formnovalidate', 'hidden', 'indeterminate', 'inert',
			'ismap', 'itemscope', 'loop', 'multiple', 'muted', 'nohref', 'noresize', 'noshade',
			'novalidate', 'nowrap', 'open', 'pauseonexit', 'readonly', 'required', 'reversed',
			'scoped', 'seamless', 'selected', 'sortable', 'spellcheck', 'translate', 'truespeed',
			'typemustmatch', 'visible',
		);

		/**
		 * Attributes that are unnecessary and can be removed (if removeUnnecessaryAttributes=true)
		 *
		 */
		$this->unnecessaryAttrs = array(
			'input'  => array(
				'type'  => 'text',
				'value' => ''
			),
			'script' => array(
				'type' => 'text/javascript'
			),
			'style'  => array(
				'type' => 'text/css'
			),
			'link'   => array(
				'type'  => 'text/css',
				'media' => 'all'
			),
			'form'   => array(
				'method' => 'get'
			),
		);

		/**
		 * Tags that aren't technically required in HTML markup and can be removed
		 *
		 * According to these HTML5 rules:
		 * http://www.w3.org/TR/2014/REC-html5-20141028/syntax.html#optional-tags
		 *
		 * Format is: array('<tag>' =>
		 *    array('str_replace' => array('text to find' => 'text to replace'),  // for fast replacement
		 *    array('preg_replace' => array('regex to match' => 'regex replacement'), // slower, more thorough
		 *
		 * The str_replace (fast) is used first. If tags remain after that, then the preg_replace is used.
		 *
		 */
		$this->unnecessaryTags = array(
			'<html>'      => array(
				'str_replace'  => array(
					'<html><head' => '<head'
				),
				'preg_replace' => array(
					'<html>(<[^!])' => '$1',
				)
			),
			'<head>'      => array(
				'str_replace'  => array(
					'<head><link'  => '<link',
					'<head><meta'  => '<meta',
					'<head><title' => '<title',
				),
				'preg_replace' => array(
					'<head>\s*(<[a-z]+)' => '$1',
				),
			),
			'</head>'     => array(
				'str_replace'  => array(
					'</head><body' => '<body',
				),
				'preg_replace' => array(
					'</head>(<[^!])' => '$1',
				),
			),
			'<body>'      => array(
				'str_replace'  => array(
					'<body><div' => '<div',
				),
				'preg_replace' => array(
					'<body>(<[^!])' => '$1',
				)
			),
			'</body>'     => array(
				'str_replace'  => array(
					'</body></html>' => '</html>',
				),
				'preg_replace' => array(
					'</body>(<[^!])' => '$1',
					'</body>\s*$'    => '',
				)
			),
			'</html>'     => array( // intentionally after </body>
				'str_replace'  => array(),
				'preg_replace' => array(
					'</html>(\s*$|<[^!])' => '$1',
				),
			),
			'</tr>'       => array(
				'str_replace'  => array(
					'</tr><tr>'     => '<tr>',
					'</tr></table>' => '</table>',
				),
				'preg_replace' => array(
					'</tr>\s*(<tr|</)' => '$1'
				)
			),
			'</thead>'    => array(
				'str_replace'  => array(
					'</thead><tbody' => '<tbody',
					'</thead><tfoot' => '<tfoot',
				),
				'preg_replace' => array(
					'</thead>\s*(<tbody|<tfoot)' => '$1',
				),
			),
			'</tbody>'    => array(
				'str_replace'  => array(
					'</tbody></table>' => '</table>',
					'</tbody><tfoot'   => '<tfoot',
					'</tbody><tbody'   => '<tbody',
				),
				'preg_replace' => array(
					'</tbody>\s*(<tbody|<tfoot|</table)' => '$1',
				)
			),
			'</tfoot>'    => array(
				'str_replace'  => array(
					'</tfoot></table>' => '</table>',
				),
				'preg_replace' => array(
					'</tfoot>\s*(<tbody|</table)' => '$1',
				)
			),
			'</td>'       => array(
				'str_replace'  => array(
					'</td><td' => '<td',
					'</td><th' => '<th',
					'</td></'  => '</',
				),
				'preg_replace' => array(
					'</td>\s*(<td|<th|</)' => '$1',
				)
			),
			'</th>'       => array(
				'str_replace'  => array(
					'</th><td' => '<td',
					'</th><th' => '<th',
					'</th></'  => '</',
				),
				'preg_replace' => array(
					'</th>\s*(<td|<th|</)' => '$1',
				)
			),
			'</li>'       => array(
				'str_replace'  => array(
					'</li><li' => '<li',
					'</li></'  => '</',
				),
				'preg_replace' => array(
					'</li>\s*(<li|</)' => '$1',
				)
			),
			'</dt>'       => array(
				'str_replace'  => array(
					'</dt><dt'  => '<dt',
					'</dt><dd'  => '<dd',
					'</dt></dl' => '</dl',
				),
				'preg_replace' => array(
					'</dt>\s*(<dt|<dd|</dl)' => '$1',
				)
			),
			'</dd>'       => array(
				'str_replace'  => array(
					'</dd><dt'  => '<dt',
					'</dd><dd'  => '<dd',
					'</dd></dl' => '</dl',
				),
				'preg_replace' => array(
					'</dd>\s*(<dt|<dd|</dl)' => '$1',
				),
			),
			'</p>'        => array(
				'str_replace'  => array(
					'</p><p>'    => '<p>',
					'</p><p '    => '<p ',
					'</p></div>' => '</div>',
				),
				'preg_replace' => array(
					'</p>(\s*<)(/[a-z][a-z0-9]|address|article|aside|blockquote|div|dl|fieldset|' .
					'footer|form|h\d|header|hgroup|hr|main|nav|ol|p|pre|section|table|ul)(\s|>)' => '$1$2$3',
				)
			),
			'</option>'   => array(
				'str_replace'  => array(
					'</option><option'     => '<option',
					'</option><optgroup'   => '<optgroup',
					'</option></optgroup>' => '</optgroup>',
					'</option></select>'   => '</select>',
				),
				'preg_replace' => array(
					'</option>\s*(<option|</?optgroup|</select>)' => '$1'
				)
			),
			'</optgroup>' => array(
				'str_replace'  => array(
					'</optgroup><optgroup' => '<optgroup',
					'</optgroup></select>' => '</select>',
				),
				'preg_replace' => array(
					'</optgroup>\s*(<optgroup|</select>)' => '$1',
				),
			),
		);
	}

	/**
	 * Initialize all variables used by minify
	 * 
	 * @param string $html HTML markup that will be minified
	 * 
	 */
	protected function minifyInit(&$html) {
		
		$this->startsTag = null; // tag that current line starts with
		$this->prevEndsTag = null; // tag that previous line ended with
		$this->inIgnoreTag = false; // in an ignored tag
		$this->inCC = false; // in a -conditional comment
		$this->inComment = false; // in a <!-comment-->
		$this->hasNoMinify = false; // are any NoMinify comments present?
		$this->lastLineLastChar = ''; // last character from last line
		$this->hadTrailingWhitespace = false; // whether current line had trailing whitespace (before being trimmed)
		$this->hadLeadingWhitespace = false; // whether or not current line had leading whitespace (before being trimmed)
		$this->lastHadTrailingWhitespace = false; // whether last line had trailing whitespace (before being trimmed)
		$this->skipKeys = array(); // line keys that should be skipped over
		$this->replaceLines = array(); // lines to be replaced, indexed by key
		$this->resetCaches = true; 
		
		// make sure that there isn't more than one ignoreTag per line
		foreach($this->ignoreTags as $tag) {
			$tag = trim($tag);
			if($tag) $html = str_replace("<$tag", "\n<$tag", $html);
		}

		// setup open and close blocks
		$this->openBlocks = array(); 
		$this->closeBlocks = array();
		
		foreach($this->blocks as $block) {
			$this->openBlocks[" <$block>"] = "<$block>";
			$this->openBlocks[" <$block "] = "<$block ";
			$this->closeBlocks[" </$block>"] = "</$block>";
		}

		// force script and style elements to be ignored
		if(!in_array('script', $this->ignoreTags)) $this->ignoreTags[] = 'script';
		if(!in_array('style', $this->ignoreTags)) $this->ignoreTags[] = 'style';

		// determine if there are any <!--NoMinify--> comments in the markup
		if(stripos($html, 'NoMinify') !== false) {
			$html = preg_replace('/<!--\s*(\/?)(?:ProCache)?NoMinify\s*-->/i', '<$1ProCacheNoMinify>', $html);
			$this->ignoreTags[] = 'ProCacheNoMinify';
			$this->ignoreTags[] = 'NoMinify';
			$this->hasNoMinify = true;
		}
		
		// convert HTML markup to an array of lines
		$this->lines = explode("\n", str_replace(array("\r\n", "\r"), "\n", $html));
	}

	/***********************************************************************************************
	 * Minify and return the given HTML content
	 * 
	 * @param string $html HTML markup
	 * @param array $options Optionally specify an array of $options, or can use setOption() method.
	 * @return string Minified HTML markup
	 * 
	 */
	public function minify($html, array $options = array()) {
		
		if(count($options)) $this->setOptions($options);
		$this->minifyInit($html);
		unset($html);

		// iternate through all lines in the markup
		foreach($this->lines as $k => $line) {
		
			// handle skipped and replaced lines
			if(isset($this->skipKeys[$k])) {
				unset($this->lines[$k]);
				continue;
			} else if(isset($this->replaceLines[$k])) {
				$line = $this->replaceLines[$k];
			}
		
			// whether or not the line has any kind of tag markup on it
			$this->hasMarkup = strpos($line, '<') !== false;
		
			// pre-process the line and determine whether minify should continue with the line
			if(!$this->preProcessLine($line, $k)) continue; 

			// minify whitespace on the line and determine whether minify should continue with the line
			if(!$this->minifyLineWhitespace($line, $k)) continue;

			// identify and process multi-line attributes
			$this->joinMultilineAttributes($line, $k);
			
			// detect if this line ends with a tag
			$this->prevEndsTag = substr(trim($line), -1) == '>' ? $this->getLastTagName($line) : false;

			// trim line and remove empty lines
			if(!strlen(trim($line))) {
				unset($this->lines[$k]);
				continue;
			}

			// update markup for the line, applying various minify settings as configured
			if($this->hasMarkup) $this->updateLineMarkup($line);
		
			// post-process line and stuff it back into $this->lines
			$this->postProcessLine($line, $k);
		}
		
		// convert lines back to a string
		$html = implode("", $this->lines);
		$this->lines = array();
		
		// post-process minified markup
		$this->postProcessHTML($html);

		return $html; 
	}

	/**
	 * Apply post-processing to the minified string of HTML markup
	 * 
	 * @param $html
	 * 
	 */
	protected function postProcessHTML(&$html) {
		
		// replace additional unnecessary whitespace
		if(strpos($html, "\n</")) $html = str_replace("\n</", "</", $html);

		// remove unnecessary newline after an opening script tag
		// $out = preg_replace('{\s*(</?(?:script|style|!\[)[^>]*>)\s*}s', '$1', $out);

		if($this->removeUnnecessaryTags) $this->removeTags($html);
		
		$this->minifyInlineCSS($html);
		$this->minifyInlineJS($html);
	
		if(stripos($html, "</script> ") || stripos($html, "</script>\t")) {
			$re = '%</scr' . 'ipt>\s+<((?:' . implode('|', $this->blocks) . ')[\s>])%i';
			$html = preg_replace($re, '</script><$1', $html);
			// $html .= "<!-- $re -->";
		}

		// replace placeholders for NoMinify sections
		if($this->hasNoMinify) {
			$html = str_replace(array('<ProCacheNoMinify>', '</ProCacheNoMinify>'), '', $html);
		}

	}

	/**
	 * Post-process the line and stuff the minified version back into $this->lines
	 *
	 * @param string $line
	 * @param int $k Key of current line
	 *
	 */
	protected function postProcessLine(&$line, $k) {
		
		// remove unnecessary self closing tags, when asked (moved to pre-process)
		// if($this->convertXHTML && strpos($line, ' />')) $line = str_replace(' />', '>', $line);

		// stuff line back into lines
		$this->lines[$k] = $line;
		
		// identify information about this line for the next iteration
		$this->lastLineLastChar = substr($line, -1);
		if($this->lastLineLastChar == ';' && substr($line, -6) == '&nbsp;') $this->lastLineLastChar = ' ';
		$this->lastHadTrailingWhitespace = $this->hadTrailingWhitespace;
	}

	/**
	 * Pre-process the line to identify comments, condition comments and ignored tags
	 * 
	 * @param string $line
	 * @param int $k Key of current line
	 * @return bool Returns true if processing line can continue, false if not
	 * 
	 */
	protected function preProcessLine(&$line, $k) {
		
		// don't minify when in script, textarea, style or pre
		if($this->inIgnoreTag) {
			if($this->hasMarkup) { 
				if(stripos($line, "</$this->inIgnoreTag>") !== false) {
					$this->inIgnoreTag = false;
				}
			}
			// right trim allowed for any ignored tag line
			$this->lines[$k] = "\n" . rtrim($line);
			return false;
		}

		if($this->hasMarkup) {
			// remove unnecessary self closing tags, when asked
			if($this->convertXHTML && strpos($line, '/>')) {
				$line = str_replace(array(
					' />', 
					'"/>', 
					"'/>"
				), array(
					'>',
					'">', 
					"'>"
				), $line);
			}
			
			// don't minify content within conditional comments, except before it...
			$hasCloseCC = strpos($line, ']-->') !== false;
			if(!$this->inComment && strpos($line, '<!--[') !== false && !$hasCloseCC) {
				$this->inCC = true;
				$this->lines[$k] = trim($line);
				return false;
			} else if($this->inCC && $hasCloseCC) {
				// ...and minify after a conditional comment closes
				$this->inCC = false;
				$this->lines[$k] = trim($line);
				return false;
			}
		}

		// check for comments
		if($this->inComment && !$this->inCC) {
			if($this->removeComments) {
				// remove regular HTML comments
				if(strpos($line, '-->') !== false) {
					$line = preg_replace('/^.*?-->/', '', $line);
					$this->inComment = false;
				} else {
					unset($this->lines[$k]);
					return false;
				}
			} else {
				// leave comment alone
				return false;
			}
		}

		if($this->hasMarkup) {

			// detect if a comment begins on the line
			if($this->removeComments && strpos($line, '<!--[') === false && strpos($line, ']-->') === false) {
				while(strpos($line, '<!--') !== false) {
					if(strpos($line, '-->')) {
						$line = preg_replace('/<!--.*?-->/', '', $line);
					} else {
						$line = preg_replace('/<!--.*$/', '', $line);
						$this->inComment = true;
						break;
					}
				}
			}

			// detect ignored tag (pre, script, etc.)
			if(!$this->inIgnoreTag) foreach($this->ignoreTags as $tag) {
				$pos1 = stripos($line, "<$tag");
				if($tag && $pos1 !== false && (stripos($line, "<$tag>") !== false || strpos($line, "<$tag ") !== false)) {
					if($tag == 'script' && stripos($line, '></script>')) {
						// this one is okay to allow through
					} else {
						$pos2 = stripos($line, '>', $pos1);
						// ln1=line including everything before the content after the open of ignored tag
						$ln1 = substr($line, 0, $pos2+1); 
						// ln2=line after being modified by updateLineMarkup
						$ln2 = $ln1; 
						// update all markup before the contents of the ignored tag
						$this->updateLineMarkup($ln2);
						if($ln1 != $ln2) $line = str_replace($ln1, $ln2, $line); 
						$this->inIgnoreTag = strtolower($tag);
						break;
					}
				}
			}

			// detect end of ignored tag on same line as start of ignore tag
			if($this->inIgnoreTag && stripos($line, "</$this->inIgnoreTag>") !== false) {
				$this->lines[$k] = rtrim($line);
				$this->prevEndsTag = $this->inIgnoreTag;
				$this->inIgnoreTag = false;
				return false;
			}

		} // hasTag

		// ignored tag just started, only trim the part before the ignored tag
		if($this->inIgnoreTag) {
			$this->lines[$k] = ltrim($line);
			return false;
		}

		return true;
	}

	/**
	 * Minify whitespace in the line 
	 * 
	 * @param string $line
	 * @param int $k Current line key
	 * @return bool Returns true if minify should continue, false if not
	 * 
	 */
	protected function minifyLineWhitespace(&$line, $k) {
		
		// reduce whitespace where possible
		$line = str_replace("\t", " ", $line);
		while(strpos($line, '  ') !== false) $line = preg_replace('/  +/s', ' ', $line);
		
		if($this->hasMarkup) {
			if(strpos($line, '> </')) $line = str_replace(array_keys($this->closeBlocks), array_values($this->closeBlocks), $line);
			if(strpos($line, '> <')) $line = str_replace(array_keys($this->openBlocks), array_values($this->openBlocks), $line);
		}

		// remember if there was leading/trailing whitespace on this line
		$this->hadLeadingWhitespace = strpos($line, ' ') === 0;
		$this->hadTrailingWhitespace = substr($line, -1) === ' ';

		// trim line and remove empty lines (#1)
		$line = trim($line);
		if(!strlen($line)) {
			unset($this->lines[$k]);
			return false;
		}

		// detect if this line starts with a tag
		$this->startsTag = false;
		if($this->hasMarkup && strpos($line, '<') === 0) {
			$endPos = strpos($line, '>');
			$wsPos = strpos($line, ' ');
			if($wsPos && ($wsPos < $endPos || $endPos === false)) $endPos = $wsPos;
			$this->startsTag = trim(strtolower(substr($line, 1, $endPos-1)), '/');
		}

		// tag separations and whether or not they should have whitespace
		if($this->lastLineLastChar != "\n" && $this->lastLineLastChar != " ") {
			$prependWhitespace = false;
			if($this->prevEndsTag && !$this->startsTag && !in_array($this->prevEndsTag, $this->blocks)) {
				// prev line ended a non-block level tag, and this line starts some regular text
				// so there should be a whitespace between them
				$line = "\n$line";
			} else if($this->startsTag && $this->prevEndsTag === false) {
				// this line starts a new tag, but the previous line ended with some text
				$line = "\n$line";
			} else if($this->startsTag
				&& (!$this->prevEndsTag || !in_array($this->prevEndsTag, $this->blocks))
				&& !in_array($this->startsTag, $this->blocks)) {
				// this line starts a new non-block level tag with some leading whitespace
				// last line ended with a non-block level tag or some text
				$prependWhitespace = true;
			} else if(!$this->startsTag && !$this->prevEndsTag) {
				// line doesn't start a tag, nor did the previous end with a tag, so retain 1 whitespace
				$prependWhitespace = true;
			}
			if($prependWhitespace) {
				if($this->hadLeadingWhitespace || $this->lastHadTrailingWhitespace) {
					$line = " $line";
				} else {
					$line = "\n$line";
				}
			}
		}

		return true; 
	}

	/**
	 * Identify lines that have multi-line HTML tag attributes and join lines or update as appropriate
	 * 
	 * @param string $line
	 * @param int $k Currrent line key
	 * 
	 */
	protected function joinMultilineAttributes(&$line, $k) {
		
		$lastTagOpen = strrpos($line, '<');
		$lastTagClose = strrpos($line, '>');
		
		if($lastTagClose === false && $lastTagOpen === false) {
			// line no longer has any tags on it
			$line .= "\n";
			return;
		}
	
		// line completes an entire tag, no need to continue
		if($lastTagClose > $lastTagOpen) return;
	
		// line does not open a tag, but it does close one
		if($lastTagOpen === false && $lastTagClose !== false) return;

		// line opens a tag, but does not close it 
		// if($lastTagClose < $lastTagOpen || ($lastTagOpen !== false && $lastTagClose === false)) {

		// when this point is reached, we know that line splits in the middle of a tag
		$kk = $k + 1;

		// check if the line ends in the middle of an attribute value...
		$inAttributeRegex = '/(?:\s|^)[-_\w\d]+\s*=\s*([\'"])\s*([^\'"]*)$/'; // matches[1] is quote
		$inAttribute = preg_match($inAttributeRegex, substr($line, $lastTagOpen), $matches);

		// join the rest of the tag's attribute lines into this one
		while(isset($this->lines[$kk])) {
			
			$nextLine = $this->lines[$kk];
			$startsAnotherTag = strpos($nextLine, '<') !== false;
			if($startsAnotherTag) list($nextLine, $startsAnotherTag) = explode('<', $nextLine, 2);
			
			if($inAttribute && ($matches[2] != '{' && $matches[2] != '[')) { // JSON okay to collapse
				// no minify within a multi-line attribute value
				$line .= "\n$nextLine";
				// if closing quote, get out of inAttribute
				if(strpos($nextLine, $matches[1])) $inAttribute = false; 
			} else {
				$line .= ' ' . trim($nextLine);
			}
			
			if(!$inAttribute) $inAttribute = preg_match($inAttributeRegex, $nextLine, $matches);
			
			if($startsAnotherTag) {
				// tell outer loop to replace this line
				$this->replaceLines[$kk] = "<$startsAnotherTag"; 
			} else {
				// tell outer loop to skip this line
				$this->skipKeys[$kk] = $kk; 
			}
			
			if(strpos($nextLine, '>') !== false || $startsAnotherTag) break;
			$kk++;
		}
	}

	/**
	 * Apply settings specific to HTML tags and attributes, updating the line as needed
	 * 
	 * This method applies the settings for: 
	 * - removeBlankAttr
	 * - collapseBooleanAttr
	 * - removeUnnecessaryAttr
	 * - unquoteAttr
	 *
	 * @param string $line
	 *
	 */
	protected function updateLineMarkup(&$line) {
		
		if(	!$this->removeBlankAttr &&
			!$this->collapseBooleanAttr &&
			!$this->removeUnnecessaryAttr &&
			!$this->unquoteAttr) return; // nothing to do, so exit now
		
		static $removeBlankAttrs;
		static $collapseBooleanAttrs;
		static $unnecessaryAttrs;
		
		if($this->resetCaches) {
			$removeBlankAttrs = null;
			$collapseBooleanAttrs = null;
			$unnecessaryAttrs = null;
			$this->resetCaches = false;
		}
		
		// remove blank attributes, where allowed
		if($this->removeBlankAttr && (strpos($line, '=""') || strpos($line, "=''"))) {
			if(is_null($removeBlankAttrs)) {
				foreach($this->blankAttrs as $attrName) {
					$removeBlankAttrs[] = " $attrName=\"\"";
					$removeBlankAttrs[] = " $attrName=''";
				}
			}
		}

		if($this->collapseBooleanAttr) {
			if(is_null($collapseBooleanAttrs)) {
				foreach($this->collapsibleBooleans as $attrName) {
					$collapseBooleanAttrs[" $attrName=\"$attrName\""] = " $attrName";
					$collapseBooleanAttrs[" $attrName='$attrName'"] = " $attrName";
					$collapseBooleanAttrs[" $attrName=$attrName"] = " $attrName";
				}
			}
		}

		if($this->removeUnnecessaryAttr) {
			if(is_null($unnecessaryAttrs)) {
				foreach($this->unnecessaryAttrs as $tagName => $attrArray) {
					foreach($attrArray as $attrName => $attrValue) {
						if(!isset($unnecessaryAttrs[$tagName])) $unnecessaryAttrs[$tagName] = array();
						if(strlen($attrValue)) $unnecessaryAttrs[$tagName][] = " $attrName=$attrValue";
						$unnecessaryAttrs[$tagName][] = " $attrName=\"$attrValue\"";
						$unnecessaryAttrs[$tagName][] = " $attrName='$attrValue'";
					}
				}
			}
		}
		
		$tagReplacements = array();
		$tags = explode('<', $line);
		
		foreach($tags as $tag) {
			// $tag = sometag attr='value'> whatever comes after it before another tag
			
			if(strpos($tag, '/') === 0) continue; // closing tag, can be skipped
			$pos = strpos($tag, '>');
			if($pos === false) continue; // we don't handle multi-line tags here, since we only have one line
			$tagContent = substr($tag, 0, $pos); // i.e. "sometag attr='value'"
			$spacePos = strpos($tagContent, ' '); 
			list($tagName, $tagAttrs) = $spacePos !== false ? explode(' ', $tagContent, 2) : array($tagContent, '');
			$tagName = strtolower(trim($tagName));
			$tagAttrs = trim($tagAttrs);
			
			if(empty($tagAttrs)) {
				// just a tag, no attributes
				continue;
			}
			
			// leading space required for many matches
			$tagAttrs = ' ' . $tagAttrs;
		
			if($removeBlankAttrs) {
				$tagAttrs = str_ireplace($removeBlankAttrs, '', $tagAttrs);
			}
			
			if($collapseBooleanAttrs) {
				$tagAttrs = str_ireplace(array_keys($collapseBooleanAttrs), array_values($collapseBooleanAttrs), $tagAttrs);
			}
			
			if($unnecessaryAttrs && isset($unnecessaryAttrs[$tagName])) {
				$tagAttrs = str_ireplace($unnecessaryAttrs[$tagName], '', $tagAttrs);
			}

			if($this->unquoteAttr) {
				$this->unquoteAttributes($tagAttrs);
			}
			
			$tagContent = "<$tagContent>";
			$tagAttrs = trim($tagAttrs);
			$tagContentNew = "<" . trim("$tagName $tagAttrs") . ">";
			if(strcasecmp($tagContent, $tagContentNew) !== 0) {
				$tagReplacements[$tagContent] = $tagContentNew;
			}
		}
		
		if(count($tagReplacements)) {
			$line = str_ireplace(array_keys($tagReplacements), array_values($tagReplacements), $line);
		}
	}

	/**
	 * Remove unnecessary tags from the markup according to w3.org optional HTML5 tags
	 * 
	 * http://www.w3.org/TR/2014/REC-html5-20141028/syntax.html#optional-tags
	 * 
	 * @param $html
	 * 
	 */
	protected function removeTags(&$html) {
		
		$removeTags = $this->unnecessaryTags;
		$replacements = array();
	
		// pass 1: quick 'n dirty str_replace version, to hopefully get most of the work out of the way without regex
		
		foreach($removeTags as $tag => $rules) {
			if(stripos($html, $tag) === false) {
				unset($removeTags[$tag]); 
				continue;
			}
			$replacements = array_merge($replacements, $rules['str_replace']);
		}
	
		if(count($replacements)) {
			$html = str_ireplace(array_keys($replacements), array_values($replacements), $html);
			$replacements = array();
		}
		
		// pass 2: slower, but more thorough preg_replace version
		
		foreach($removeTags as $tag => $rules) {
			if(stripos($html, $tag) === false) continue;
			if(!isset($rules['preg_replace'])) continue;
			foreach($rules['preg_replace'] as $regex => $replace) {
				$replacements['#' . $regex . '#is'] = $replace;
			}
		}
		
		if(count($replacements)) {
			$html = preg_replace(array_keys($replacements), array_values($replacements), $html);
		}
	}

	/**
	 * Unquoted attribute values in the given line where allowed by HTML5 specs
	 * 
	 * @param string $attrStr
	 * 
	 */
	protected function unquoteAttributes(&$attrStr) {

		// now unquote attributes, where allowed
		$disallowed = array(' ', "\t", "\n", "=", "'", '"', "`", "<", ">"); 
		if(strpos($attrStr, '=') === false) return;
		$offset = 0;
		$replacements = array();
		
		while($offset < strlen($attrStr)) {
			$pos1 = strpos($attrStr, '="', $offset);
			$pos2 = strpos($attrStr, "='", $offset);
			if($pos1 && ($pos2 === false || $pos1 < $pos2)) {
				$pos = $pos1; 
				$quote = '"';
			} else if($pos2) {
				$pos = $pos2; 
				$quote = "'";
			} else {
				break;
			}
			$attrName = strtolower(trim(substr($attrStr, $offset, $pos)));
			$startPos = $pos+1; 
			//$endPos = strpos($attrStr, $quote, $startPos+2);
			$endPos = isset($attrStr[$startPos+2]) ? strpos($attrStr, $quote, $startPos+2) : 0; 
			if(!$endPos) break;
			$quotedValue = substr($attrStr, $startPos, $endPos - $startPos + 1);
			$unquotedValue = rtrim(substr($quotedValue, 1, -1));
			if($attrName == 'style') $unquotedValue = str_replace(array(': ', '; '), array(':', ';'), $unquotedValue);
			$allow = true; 
			foreach($disallowed as $chr) {
				if(strpos($unquotedValue, $chr) !== false) {
					$allow = false;
					break;
				}
			}
			if($allow) {
				$replacements[$quotedValue] = $unquotedValue; 
			}	
			$offset = $endPos;
		} 
		
		if(count($replacements)) {
			$attrStr = str_replace(array_keys($replacements), array_values($replacements), $attrStr);
		}
	}

	/**
	 * Convert URLs from absolute to relative where shorter
	 * 
	 * This is an optional extra minification function that can be applied after minify(). It can
	 * significantly shorten URLs by making them relative rather than absolute. However, it can also
	 * create issues, particularly when viewing a page that lacks a trailing slash when it was cached
	 * with a trailing slash, or the opposite. 
	 * 
	 * @param string $html HTML to apply conversion to
	 * @param string $rootURL Root/base URL for the site (i.e. "/" or "/my-site/", etc.)
	 * @param string $currentURL URL of page currently being viewed
	 * @param string $attr Attribute to convert (i.e. "href" or "src")
	 * 
	 */
	public function convertURLs(&$html, $rootURL, $currentURL, $attr = 'href') {
		$replaceFull = array();		
		$replaceBegin = array();
		$trailingSlash = substr($currentURL, -1) == '/' ? '/' : '';
		$replaceFull[$currentURL] = $trailingSlash ? './' : './' . substr($currentURL, strrpos($currentURL, '/')+1);
		if($currentURL == $rootURL) {
			$replaceBegin[$rootURL] = '';
		} else {
			$replaceBegin[$currentURL] = $trailingSlash ? '' : '' . substr($currentURL, strrpos($currentURL, '/')+1);
			$url = rtrim($currentURL, '/');
			$n = 0;
			while(strlen($url)) {
				$pos = strrpos($url, '/'); 
				if(!$pos) break;
				$url = substr($url, 0, $pos);
				$value = $trailingSlash ? '../' : '';
				for($i = $n; $i > 0; $i--) $value .= '../';
				if(!strlen($value)) $value = './';
				$replaceFull["$url"] = $value; 
				$replaceBegin["$url/"] = $value; 
				$n++;
			}
		}
		$replacements = array();
		foreach($replaceFull as $find => $replace) {
			if(strlen($find) <= strlen($replace)) continue; 
			$replacements['!\b' . $attr . '\s*=\s*(["\'](?=/[^/])|(?=/[^/]))' . $find . '/?("|\'|\s|>|\?|#)!'] = $attr . '=$1' . $replace . '$2';
		}
		foreach($replaceBegin as $find => $replace) {
			if(strlen($find) <= strlen($replace)) continue;
			$replacements['!\b' . $attr . '\s*=\s*(["\'](?=/[^/])|(?=/[^/]))' . $find . '!'] = $attr . '=$1' . $replace;
		}
		
		$html = preg_replace(array_keys($replacements), array_values($replacements), $html);

		if(stripos($html, "href=>")) {
			// disallow an invalid "<a href=>"
			$html = preg_replace('!<a\s([^<>]*)href=>!i', '<a $1href="./">', $html);
		}
	}

	/**
	 * Get the [a-z0-9] name last HTML tag on the given line
	 * 
	 * @param string $line
	 * @return string|bool Returns last tag name, or boolean false if no tag opening on the line
	 * 
	 */
	protected function getLastTagName($line) {
		$lastOpen = strrpos($line, '<');
		if($lastOpen === false) return false;
		$tag = substr($line, $lastOpen+1) . ' ';
		$pos = strpos($tag, ' ');
		$tag = substr($tag, 0, $pos);
		$tag = trim($tag, '/<>');
		return strtolower($tag);
	}
	
	/**
	 * Convert a space or newline separated string of tags to an array of tags
	 *
	 * If given an array, it will simply clean it, removing blank items.
	 *
	 * @param string|array $str
	 * @return array
	 *
	 */
	protected function tagsToArray($str) {
		if(is_string($str)) {
			$str = str_replace(array("\r\n", "\r", "\n", ","), ' ', strtolower($str));
			if(strpos($str, '<') !== false) $str = str_replace(array('<', '>'), '', $str);
			$a = explode(' ', $str);
		} else if(is_array($str)) {
			$a = $str;
		} else {
			$a = array();
		}
		foreach($a as $key => $value) {
			$a[$key] = trim($value, "<>\r\n ");
			if(empty($a[$key])) unset($a[$key]);
		}
		return $a;
	}

	/**
	 * Minify a CSS string, for inline CSS minification
	 * 
	 * This is a simple default handler if no external handler was provided. 
	 * 
	 * Source: https://github.com/GaryJones/Simple-PHP-CSS-Minification/
	 * 
	 * @param string $html
	 * @return int Number of CSS blocks that were minified
	 * 
	 */
	public function minifyInlineCSS(&$html) {
		if(!$this->cssMinifyFunction) return 0;
		if(stripos($html, '<style') == false) return 0;
		if(!preg_match_all('!(<style[^>]*>\s*)([^<].+?)</style>!is', $html, $matches)) return 0;
		$n = 0;
		foreach($matches[1] as $key => $tag) {
			$code = $matches[2][$key];
			if(strpos($code, 'NoMinify') !== false) continue;
			$minCode = call_user_func($this->cssMinifyFunction, $code);
			if($minCode && strlen($minCode) < strlen($code)) {
				$html = str_replace($tag . $code, trim($tag) . $minCode, $html);
				$n++;
			}
		}
		return $n;
	}

	/**
	 * Minify inline javascript within an HTML document
	 * 
	 * This is a simple default handler if no external handler was provided. 
	 * 
	 * @param string $html
	 * @return int Number of scripts that were minified
	 * 
	 */
	public function minifyInlineJS(&$html) {
		if(!$this->jsMinifyFunction) return 0;
		if(stripos($html, '<script') == false) return 0;
		if(!preg_match_all('!(<script[^>]*>\s*)([^<].+?)</script>!is', $html, $matches)) return 0;
		$n = 0;
		foreach($matches[1] as $key => $tag) {
			if(stripos($tag, 'src')) continue;
			$code = $matches[2][$key];
			if(strpos($code, 'NoMinify') !== false) continue;
			$minCode = call_user_func($this->jsMinifyFunction, $code);
			if($minCode && strlen($minCode) < strlen($code)) {
				$html = str_replace($tag . $code, trim($tag) . $minCode, $html);
				$n++;
			}
		}
		return $n;
	}

	
	/**************************************************************************************
	 * METHODS TO CONFIGURE SETTINGS
	 *
	 */
	
	/**
	 * Set a minify option
	 *
	 * @param string $name
	 * @param bool $value
	 * @return $this
	 * @throws Exception if given unknown option
	 *
	 */
	public function setOption($name, $value) {
		if(!isset($this->options[$name])) throw new WireException("Unknown option: $name");
		$this->options[$name] = (bool) $value;
		return $this;
	}

	/**
	 * Set multiple options at once in key => value array
	 *
	 * @param array $options
	 * @return $this
	 * @throws Exception if given unknown option
	 *
	 */
	public function setOptions(array $options) {
		foreach($options as $name => $value) {
			$this->setOption($name, $value);
		}
		return $this;
	}

	/**
	 * Get the value for an option
	 *
	 * @param $name
	 * @return null|bool
	 *
	 */
	public function getOption($name) {
		return isset($this->options[$name]) ? $this->options[$name] : null;
	}

	/**
	 * Get the current set options in key => value array
	 *
	 * @return array
	 *
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * Set the tags that should be ignored
	 *
	 * @param array|string $tags
	 * @return $this
	 *
	 */
	public function setIgnoreTags($tags) {
		$this->ignoreTags = $this->tagsToArray($tags);
		return $this;
	}

	/**
	 * Set the block level elements (whitespace removed around these elements)
	 *
	 * @param array|string $blocks Space separated string or array
	 * @return $this
	 *
	 */
	public function setBlocks($blocks) {
		$this->blocks = $this->tagsToArray($blocks);
		return $this;
	}

	/**
	 * Attribute names that will be removed when blank
	 * 
	 * Won't be applied unless the removeBlankAttr option is true. 
	 *
	 * @param array|string $attributes Specify space separated string or array of blank attributes that can be removed
	 * @return $this
	 *
	 */
	public function setRemoveBlankAttrs($attributes) {
		$this->blankAttrs = $this->tagsToArray($attributes);
		return $this;
	}

	/**
	 * Set the javascript minify callback function
	 *
	 * Given function will receive JS string as first argument, and it should return the minified JS.
	 * 
	 * @param callable $func
	 * @return $this
	 * @throws Exception
	 * 
	 */
	public function setJSMinifyFunction($func) {
		if(!is_callable($func)) throw new Exception("jsMinifyFunction is not callable");
		$this->jsMinifyFunction = $func;
		return $this;
	}

	/**
	 * Set the CSS minify callback function
	 * 
	 * Given function will receive CSS string as first argument, and it should return the minified CSS.
	 *
	 * @param callable $func
	 * @return $this
	 * @throws Exception
	 *
	 */
	public function setCSSMinifyFunction($func) {
		if(!is_callable($func)) throw new Exception("cssMinifyFuntion is not callable");
		$this->cssMinifyFunction = $func;
		return $this;
	}

	/**
	 * Provides shorter syntax for retrieving option or setting
	 * 
	 * @param $name
	 * @return bool|null|array
	 * 
	 */
	public function __get($name) {
		if(isset($this->$name)) return $this->$name;
		return $this->getOption($name);
	}

	/** 
	 * Provides shorder syntax for setting an option or setting
	 * 
	 * @param string $name
	 * @param bool|string|array $value
	 * @throws Exception if given an invalid option
	 * 
	 */
	public function __set($name, $value) {
		if($name == 'ignoreTags') $this->setIgnoreTags($value);
		if($name == 'blocks') $this->setBlocks($value);
		if($name == 'blankAttrs') $this->setRemoveBlankAttrs($value);
		if($name == 'jsMinifyFunction') $this->setJSMinifyFunction($value);
		if($name == 'cssMinifyFunction') $this->setCSSMinifyFunction($value);
		$this->setOption($name, $value);
	}

}
