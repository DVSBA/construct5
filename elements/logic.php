<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

// Call the Construct Template Helper Class
if (JFile::exists(dirname(__FILE__) . '/helper.php')) {
    include dirname(__FILE__) . '/helper.php';
}

// To get an application object
$app = JFactory::getApplication();
// Returns a reference to the global document object
$doc = JFactory::getDocument();
// Checks for any system messages
$messageQueue = $app->getMessageQueue();
// Define relative path to the  current template directory
$template = 'templates/' . $this->template;
// Define absolute path to the template directory
$templateDir = JPATH_THEMES . '/' . $this->template;
// Get the current URL
$url = clone(JURI::getInstance());
// To access the current user object
$user = JFactory::getUser();
// Get the current view
$view = JRequest::getCmd('view');

// Define shortcuts for template parameters
$customStyleSheet        = $this->params->get('customStyleSheet');
$customStyleSheetVersion = htmlspecialchars($this->params->get('customStyleSheetVersion'));
$enableSwitcher          = $this->params->get('enableSwitcher');
$fluidMedia              = $this->params->get('fluidMedia');
$fullWidth               = $this->params->get('fullWidth');
$googleWebFont           = $this->params->get('googleWebFont');
$googleWebFontTargets    = htmlspecialchars($this->params->get('googleWebFontTargets'));
$googleWebFont2          = $this->params->get('googleWebFont2');
$googleWebFontTargets2   = htmlspecialchars($this->params->get('googleWebFontTargets2'));
$googleWebFont3          = $this->params->get('googleWebFont3');
$googleWebFontTargets3   = htmlspecialchars($this->params->get('googleWebFontTargets3'));
$gridSystem              = $this->params->get('gridSystem');
$IECSS3                  = $this->params->get('IECSS3');
$IECSS3Targets           = htmlspecialchars($this->params->get('IECSS3Targets'));
$IE6TransFix             = $this->params->get('IE6TransFix');
$IE6TransFixTargets      = htmlspecialchars($this->params->get('IE6TransFixTargets'));
$loadMoo                 = $this->params->get('loadMoo');
$loadModal               = $this->params->get('loadModal');
$loadjQuery              = $this->params->get('loadjQuery');
$setGeneratorTag         = htmlspecialchars($this->params->get('setGeneratorTag'));
$showDiagnostics         = $this->params->get('showDiagnostics');
$siteWidth               = htmlspecialchars($this->params->get('siteWidth'));
$siteWidthType           = $this->params->get('siteWidthType');
$siteWidthUnit           = $this->params->get('siteWidthUnit');
$stickyFooterHeight      = htmlspecialchars($this->params->get('stickyFooterHeight'));
$useStickyFooter         = $this->params->get('useStickyFooter');

// Get the template's XML for versioning
$xmlfile = $templateDir . '/templateDetails.xml';
$data    = JApplicationHelper::parseXMLInstallFile($xmlfile);
$version = $data['version'];

// Define fallback version number for custom style sheet
if ($customStyleSheetVersion == '') {
	$customStyleSheetVersion = $version;
}

// Change generator tag
$this->setGenerator($setGeneratorTag);

// Enable Mootols
if ($loadMoo) {
    JHtml::_('behavior.framework', true);
}

// Enable modal pop-ups
if ($loadMoo && $loadModal) {
    JHtml::_('behavior.modal');
}

// Remove MooTools if set to no.
if (!$loadMoo) {
    unset($doc->_scripts[$this->baseurl . '/media/system/js/mootools-core.js']);
    unset($doc->_scripts[$this->baseurl . '/media/system/js/mootools-more.js']);
    unset($doc->_scripts[$this->baseurl . '/media/system/js/core.js']);
    unset($doc->_scripts[$this->baseurl . '/media/system/js/caption.js']);
    unset($doc->_scripts[$this->baseurl . '/media/system/js/modal.js']);
}

// Change Google Web Font name for CSS
$googleWebFontFamily = str_replace(array('+', ':bold', ':italic'), " ", $googleWebFont);
$googleWebFontFamily2 = str_replace(array('+', ':bold', ':italic'), " ", $googleWebFont2);
$googleWebFontFamily3 = str_replace(array('+', ':bold', ':italic'), " ", $googleWebFont3);

// Get the name of the extended template override group
$overrideTheme = str_replace(".css", "", $customStyleSheet);

#----------------------------- Module Counts -----------------------------#
// from http://groups.google.com/group/joomla-dev-general/browse_thread/thread/b54f3f131dd173d

$headerAboveCount1 = (int)($this->countModules('header-above-1') > 0);
$headerAboveCount2 = (int)($this->countModules('header-above-2') > 0);
$headerAboveCount3 = (int)($this->countModules('header-above-3') > 0);
$headerAboveCount4 = (int)($this->countModules('header-above-4') > 0);
$headerAboveCount5 = (int)($this->countModules('header-above-5') > 0);
$headerAboveCount6 = (int)($this->countModules('header-above-6') > 0);

$headerAboveCount = $headerAboveCount1 + $headerAboveCount2 + $headerAboveCount3 + $headerAboveCount4 + $headerAboveCount5 + $headerAboveCount6;

if ($headerAboveCount) : $headerAboveClass = 'count-' . $headerAboveCount; endif;

#--------------------------------------------------------------------------#

$headerBelowCount1 = (int)($this->countModules('header-below-1') > 0);
$headerBelowCount2 = (int)($this->countModules('header-below-2') > 0);
$headerBelowCount3 = (int)($this->countModules('header-below-3') > 0);
$headerBelowCount4 = (int)($this->countModules('header-below-4') > 0);
$headerBelowCount5 = (int)($this->countModules('header-below-5') > 0);
$headerBelowCount6 = (int)($this->countModules('header-below-6') > 0);

$headerBelowCount = $headerBelowCount1 + $headerBelowCount2 + $headerBelowCount3 + $headerBelowCount4 + $headerBelowCount5 + $headerBelowCount6;

if ($headerBelowCount) : $headerBelowClass = 'count-' . $headerBelowCount; endif;

#--------------------------------------------------------------------------#

$navBelowCount1 = (int)($this->countModules('nav-below-1') > 0);
$navBelowCount2 = (int)($this->countModules('nav-below-2') > 0);
$navBelowCount3 = (int)($this->countModules('nav-below-3') > 0);
$navBelowCount4 = (int)($this->countModules('nav-below-4') > 0);
$navBelowCount5 = (int)($this->countModules('nav-below-5') > 0);
$navBelowCount6 = (int)($this->countModules('nav-below-6') > 0);

$navBelowCount = $navBelowCount1 + $navBelowCount2 + $navBelowCount3 + $navBelowCount4 + $navBelowCount5 + $navBelowCount6;

if ($navBelowCount) : $navBelowClass = 'count-' . $navBelowCount; endif;

#--------------------------------------------------------------------------#

$contentAboveCount1 = (int)($this->countModules('content-above-1') > 0);
$contentAboveCount2 = (int)($this->countModules('content-above-2') > 0);
$contentAboveCount3 = (int)($this->countModules('content-above-3') > 0);
$contentAboveCount4 = (int)($this->countModules('content-above-4') > 0);
$contentAboveCount5 = (int)($this->countModules('content-above-5') > 0);
$contentAboveCount6 = (int)($this->countModules('content-above-6') > 0);

$contentAboveCount = $contentAboveCount1 + $contentAboveCount2 + $contentAboveCount3 + $contentAboveCount4 + $contentAboveCount5 + $contentAboveCount6;

if ($contentAboveCount) : $contentAboveClass = 'count-' . $contentAboveCount; endif;

#--------------------------------------------------------------------------#

$contentBelowCount1 = (int)($this->countModules('content-below-1') > 0);
$contentBelowCount2 = (int)($this->countModules('content-below-2') > 0);
$contentBelowCount3 = (int)($this->countModules('content-below-3') > 0);
$contentBelowCount4 = (int)($this->countModules('content-below-4') > 0);
$contentBelowCount5 = (int)($this->countModules('content-below-5') > 0);
$contentBelowCount6 = (int)($this->countModules('content-below-6') > 0);

$contentBelowCount = $contentBelowCount1 + $contentBelowCount2 + $contentBelowCount3 + $contentBelowCount4 + $contentBelowCount5 + $contentBelowCount6;

if ($contentBelowCount) : $contentBelowClass = 'count-' . $contentBelowCount; endif;

#--------------------------------------------------------------------------#

$footerAboveCount1 = (int)($this->countModules('footer-above-1') > 0);
$footerAboveCount2 = (int)($this->countModules('footer-above-2') > 0);
$footerAboveCount3 = (int)($this->countModules('footer-above-3') > 0);
$footerAboveCount4 = (int)($this->countModules('footer-above-4') > 0);
$footerAboveCount5 = (int)($this->countModules('footer-above-5') > 0);
$footerAboveCount6 = (int)($this->countModules('footer-above-6') > 0);

$footerAboveCount = $footerAboveCount1 + $footerAboveCount2 + $footerAboveCount3 + $footerAboveCount4 + $footerAboveCount5 + $footerAboveCount6;

if ($footerAboveCount) : $footerAboveClass = 'count-' . $footerAboveCount; endif;

#------------------------------ Column Layout -----------------------------#

$column1Count = (int)($this->countModules('column-1') > 0);
$column2Count = (int)($this->countModules('column-2') > 0);

$columnGroupAlphaCount = $column1Count + $column2Count;

if ($columnGroupAlphaCount) : $columnGroupAlphaClass = 'count-' . $columnGroupAlphaCount; endif;

$column3Count = (int)($this->countModules('column-3') > 0);
$column4Count = (int)($this->countModules('column-4') > 0);

$columnGroupBetaCount = $column3Count + $column4Count;
if ($columnGroupBetaCount) : $columnGroupBetaClass = 'count-' . $columnGroupBetaCount; endif;

$columnLayout = 'main-only';

if (($columnGroupAlphaCount > 0) && ($columnGroupBetaCount == 0)) :
    $columnLayout = 'alpha-' . $columnGroupAlphaCount . '-main';
elseif (($columnGroupAlphaCount > 0) && ($columnGroupBetaCount > 0)) :
    $columnLayout = 'alpha-' . $columnGroupAlphaCount . '-main-beta-' . $columnGroupBetaCount;
elseif (($columnGroupAlphaCount == 0) && ($columnGroupBetaCount > 0)) :
    $columnLayout = 'main-beta-' . $columnGroupBetaCount;
endif;

#-------------------------------- Item ID ---------------------------------#

$itemId = JRequest::getInt('Itemid', 0);

#------------------------------- Article ID -------------------------------#

if ($view == 'article')
    $articleId = JRequest::getInt('id');
else ($articleId = NULL);

#------------------------------- Section ID -------------------------------#

function getSection($id)
{
    $database = JFactory::getDBO();
    if ((substr(JVERSION, 0, 3) >= '1.6')) {
        return NULL;
    }
    elseif (JRequest::getCmd('view', 0) == "section") {
        return $id;
    }
    elseif (JRequest::getCmd('view', 0) == "category") {
        $sql = "SELECT section FROM #__categories WHERE id = $id ";
        $database->setQuery($sql);
        return $database->loadResult();
    }
    elseif (JRequest::getCmd('view', 0) == "article") {
        $temp = explode(":", $id);
        $sql = "SELECT sectionid FROM #__content WHERE id = " . $temp[0];
        $database->setQuery($sql);
        return $database->loadResult();
    }
}

$sectionId = getSection(JRequest::getInt('id'));

#------------------------------ Category ID -------------------------------#

function getCategory($id)
{
    $database = JFactory::getDBO();
    if (JRequest::getCmd('view', 0) == "section") {
        return null;
    }
    elseif ((JRequest::getCmd('view', 0) == "category") || (JRequest::getCmd('view', 0) == "categories")) {
        return $id;
    }
    elseif (JRequest::getCmd('view', 0) == "article") {
        $temp = explode(":", $id);
        $sql = "SELECT catid FROM #__content WHERE id = " . $temp[0];
        $database->setQuery($sql);
        return $database->loadResult();
    }
}

$catId = getCategory(JRequest::getInt('id'));

#------------------------------------- Alias -------------------------------------#

if ($itemId) {
    $currentAlias = $app->getMenu()->getActive()->alias;
}

#----------------------------- Component Name -----------------------------#

$currentComponent = JRequest::getCmd('option');

#---------------------------------------------------------------------------------#

$layoutOverride = new ConstructTemplateHelper ();
$layoutOverride->includeFile = array();
$layoutOverride->includeFile[] = $template . '/layouts/' . $overrideTheme . '-index.php';
$layoutOverride->includeFile[] = $template . '/layouts/index.php';

#---------------------------- Head Elements ---------------------------------#

// Custom tags

// Always force latest IE rendering engine (even in intranet) & Chrome Frame
$doc->setMetadata('X-UA-Compatible', 'IE=edge,chrome=1');
// Set initial scale of mobile viewport to 100% - see http://bit.ly/sK7Zty
$doc->setMetadata('viewport', 'width=device-width, initial-scale=1.0');
// Define copyright of site content
$doc->setMetadata('copyright', htmlspecialchars($app->getCfg('sitename')));

// Site icons
$doc->addFavicon($template . '/favicon.png', 'image/png', 'shortcut icon');
$doc->addFavicon($template . '/apple-touch-icon.png', 'image/png', 'apple-touch-icon');

// Style sheets
$doc->addStyleSheet($template . '/css/screen.css?' . $version, 'text/css', 'screen');
$doc->addStyleSheet($template . '/css/print.css?' . $version, 'text/css', 'print');
if ($gridSystem != '-1') {
    $doc->addStyleSheet($template . '/css/grids/' . $gridSystem . '?' . $version, 'text/css', 'screen');
}
if ($customStyleSheet > -1) {
    $doc->addStyleSheet($template . '/css/' . $customStyleSheet . '?' . $customStyleSheetVersion, 'text/css', 'screen');
}
if ($this->direction == 'rtl') {
    $doc->addStyleSheet($template . '/css/rtl.css?' . $version, 'text/css', 'screen');
}

// Style sheet switcher
if ($enableSwitcher) {
    $doc->addCustomTag('<link rel="alternate stylesheet" href="' . $template . '/css/diagnostic.css" type="text/css" media="screen" title="diagnostic" />');
    $doc->addCustomTag('<link rel="alternate stylesheet" href="' . $template . '/css/wireframe.css" type="text/css" media="screen" title="wireframe" />');
    $doc->addScript($template . '/js/styleswitch.js');
}

// Typography
if ($googleWebFont) {
    $doc->addStyleSheet('http://fonts.googleapis.com/css?family=' . $googleWebFont . '');
    $doc->addStyleDeclaration($googleWebFontTargets . ' {font-family:' . $googleWebFontFamily . ', serif;}');
}
if ($googleWebFont2) {
    $doc->addStyleSheet('http://fonts.googleapis.com/css?family=' . $googleWebFont2 . '');
    $doc->addStyleDeclaration($googleWebFontTargets2 . ' {font-family:' . $googleWebFontFamily2 . ', serif;}');
}
if ($googleWebFont3) {
    $doc->addStyleSheet('http://fonts.googleapis.com/css?family=' . $googleWebFont3 . '');
    $doc->addStyleDeclaration($googleWebFontTargets3 . ' {font-family:' . $googleWebFontFamily3 . ', serif;}');
}

// JavaScript

//Quick port of Modernizer's method of replacing "no-js" HTML class with "js" - NOTE: removes all other classes added to HTML element
$doc->addScriptDeclaration('docElement = document.documentElement;docElement.className = docElement.className.replace(/\bno-js\b/, \'js\');');

$doc->addScriptDeclaration('window.addEvent(\'domready\',function(){new SmoothScroll({duration:1200},window)});');
if ($loadjQuery) {
    $doc->addCustomTag('<script type="text/javascript" src="' . $loadjQuery . '"></script>');
    $doc->addCustomTag('<script type="text/javascript">jQuery.noConflict();</script>');
}

// Layout Declarations
if ($siteWidth) {
    $doc->addStyleDeclaration('#body-container, #header-above {' . $siteWidthType . ':' . $siteWidth . $siteWidthUnit . ';}');
}
if (($siteWidthType == 'max-width') && $fluidMedia) {
    $doc->addStyleDeclaration('img, object {max-width:100%;}');
}
if ($siteWidth && !$fullWidth) {
    $doc->addStyleDeclaration('#header, #footer {' . $siteWidthType . ':' . $siteWidth . $siteWidthUnit . '; margin:0 auto;}');
}
if ($useStickyFooter && $stickyFooterHeight != '') {
    $doc->addStyleDeclaration('.sticky-footer #body-container {padding-bottom:' . $stickyFooterHeight . 'px;}');
    $doc->addStyleDeclaration('.sticky-footer #footer {margin-top:-' . $stickyFooterHeight . 'px;height:' . $stickyFooterHeight . 'px;}');
}

// Internet Explorer Fixes
$doc->addCustomTag('<!--[if lt IE 9]>');
$doc->addCustomTag('<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>');
if ($IECSS3) {
    $doc->addCustomTag('<style type="text/css">' . $IECSS3Targets . ' {behavior:url("' . $this->baseurl . '/templates/' . $this->template . '/js/PIE.htc")}</style>');
}
$doc->addCustomTag('<![endif]-->');

// Internet Explorer 6 Fixes
$doc->addCustomTag('<!--[if lt IE 7]>');
$doc->addCustomTag('<link rel="stylesheet" href="' . $template . '/css/ie6.css" type="text/css" media="screen" />');
$doc->addCustomTag('<style type="text/css">');
$doc->addCustomTag('body {text-align:center;}');
$doc->addCustomTag('#body-container {text-align:left;}');
if ($useStickyFooter) {
    $doc->addCustomTag('body.sticky-footer #footer-push {display:table;height:100%;}');
}
if ($siteWidth && !$fullWidth) {
    $doc->addCustomTag('#body-container, #header-above, #header, #footer {width: expression( document.body.clientWidth >' . ($siteWidth - 1) . ' ? "' . $siteWidth . $siteWidthUnit . '" : "auto" );margin:0 auto;}');
}
else {
    $doc->addCustomTag('#body-container, #header-above {width: expression( document.body.clientWidth >' . ($siteWidth - 1) . ' ? "' . $siteWidth . $siteWidthUnit . '" : "auto" );margin:0 auto;}');
}
$doc->addCustomTag('</style>');
if ($IE6TransFix) {
    $doc->addCustomTag('<script type="text/javascript" src="' . $template . '/js/DD_belatedPNG_0.0.8a-min.js"></script>');
    $doc->addCustomTag('<script type="text/javascript">DD_belatedPNG.fix(\'' . $IE6TransFixTargets . '\');</script>');
}
$doc->addCustomTag('<![endif]-->');

