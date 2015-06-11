<?php

defined('_JEXEC') or die('Restricted access'); // no direct access
$templateUrl = $this->baseurl . '/templates/' . $this->template;
$pie = $this->params->get('pie');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/reset.css" />
<!--<link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/template.css" />-->
<link rel="stylesheet" href="<?php echo $templateUrl; ?>/css/styles.css" />

<!--[if lte IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   
      <style> 
        {behavior:url(http://localhost<?php echo $templateUrl; ?>/js/PIE.htc);}
      </style>
    
  <![endif]-->
</head>
<body>

  <header class="clearfix">
    <section class="logo-in clearfix">
      <a href="<?php echo $this->baseurl?>"><img class="logo" src="images/logo.png" alt="logo"></a>
    </section><!--logo-in-->
    <section class="header-right">
		<nav class="short-navigation clearfix">
			<jdoc:include type="modules" name="menu-main" style="none" />  
		</nav>
		<section class="language-search-container">
			<section class="language">
				<jdoc:include type="modules" name="language" style="none" /> 
			</section><!--language-->		
			<div class="find">
				<jdoc:include type="modules" name="search" style="none" />
			</div>
		</section>
    </section><!--header-right-->
  </header><!--header-->
  
  <section id="container" class="clearfix">
    <nav class="navigation clearfix">
      <jdoc:include type="modules" name="menu-top" style="none" />
    </nav><!--navigation-->
	<section class="background-img">
		<section class="left-img">
			<img title="left-img" src="images/tomato.png" alt="tomato" ></img>
		</section>
		<section class="right-img">
			<img title="right-img" src="images/abrikos.png" alt="abrikos" ></img>
		</section>
	</section>
    <section class="container-on clearfix">
			<section class="banner">
                <jdoc:include type="modules" name="banner" style="none" />
            </section> 
	<?php if ($this->countModules('slideshow')) : ?>
            <section class="slideshow">
                        <jdoc:include type="modules" name="slideshow" style="none" />
            </section> 
			<?php endif; ?>
      <article class="info clearfix">
        <section class="content">
          <jdoc:include type="component" />
		  <section class="video">
				<jdoc:include type="modules" name="bottom-video" style="xhtml_unlink" />
			</section>
        </section><!--content-->
        <aside class="right">
                    <jdoc:include type="modules" name="right" style="xhtml_link" />
        </aside><!--right-->
      </article>
    </section><!--container-on-->
  </section><!--container-->
  <footer class="clearfix">
    <section class="footer-in">
      <p class="footer-left">&#169; Copyright 2015</p>
      <p class="footer-right">design by Grigoryan G.</p>
    </section><!--footer-in-->
  </footer><!--footer-->
</body>
</html>