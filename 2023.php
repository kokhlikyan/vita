<?php	
	$year = substr(array_reverse(explode('/', $_SERVER['PHP_SELF']))[0], 0, 4);
	$edit = '5';
?>

<!DOCTYPE html>

<html>

	<head>
  
  	<title><?php echo $edit; ?>. Chopin Festival <?php echo $year; ?> Hamburg</title>
  
  	<meta charset="UTF-8">
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Wir, die Chopin-Gesellschaft Hamburg &amp; Sachsenwald e.V., laden Sie herzlich zum 5. Chopin Festival Hamburg <?php echo $year; ?> ein! Lassen Sie sich in ungewohnte und neue Klangsphären entführen. Das Chopin Festival Hamburg ist das erste und einzige Festival, das die Klangwelten moderner und historischer Flügel in den Wettbewerb schickt.">
    <meta name="keywords" content="Chopin, Festival, Hamburg, Flügel, Wettbewerb, Epoche, Kalvierabend, Musikinstrumente, Publikumsempfang, Künstlergespräch, Spiegelsaal, Musikerlebnis, Musikwelten, Klaviermusik, Matinee">
		
		<meta property="og:title" content="<?php echo $edit; ?>. Chopin Festival <?php echo $year; ?> Hamburg">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="de_DE">
    <meta property="og:url" content="https://www.chopin-festival.de/">
    <meta property="og:image" content="https://www.chopin-festival.de/img/logo/og.jpg">
    <meta property="og:image:type" content="image/jpeg" />
		<meta property="og:image:width" content="300" />
		<meta property="og:image:height" content="300" />
    <meta property="og:description" content="Lassen Sie sich in ungewohnte und neue Klangsphären entführen. Das 5. Chopin Festival Hamburg <?php echo $year; ?> ist das einzige Festival, das die Klangwelten moderner und historischer Flügel in den Wettbewerb schickt.">

		<link rel="apple-touch-icon" sizes="180x180" href="./img/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="128x128" href="./img/icon/favicon.png">
    
    <!--[if IE]>
    	<link rel="shortcut icon" href="./img/icon/favicon.ico">
    <![endif]-->
    
    <link rel="canonical" href="https://www.chopin-festival.de/">
  
    <link rel="stylesheet" type="text/css" href="./css/styles.css?version=19_091023">
    <link rel="stylesheet" type="text/css" href="./css/cslider.css">
		<link rel="stylesheet" type="text/css" href="https://vjs.zencdn.net/6.2.7/video-js.css">
		
		<script>window.HELP_IMPROVE_VIDEOJS = false;</script>

    <script type="text/javascript" src="./js/modernizr.js"></script>
    <script type="text/javascript" src="./js/respond.js"></script>
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/jquery.swipe.js"></script>
    <script type="text/javascript" src="./js/jquery.inview.js"></script>
    <script type="text/javascript" src="./js/jquery.validate.js"></script>
    <script type="text/javascript" src="./js/jquery.scroller.js"></script>
    <script type="text/javascript" src="./js/jquery.cslider.js"></script>
    <script type="text/javascript" src="./js/jquery.tabs.js"></script>
    <script type="text/javascript" src="./js/utils.js"></script>
		<script type="text/javascript" src="./js/galleria.js"></script>
    
    <noscript>
			<link rel="stylesheet" type="text/css" href="./css/nojs.css">
		</noscript>
    
	</head>

  <body class="cf-<?php echo $year; ?> page-homepage reboot">  
		<div class="overlay module">
  
  		<a class="logo-login" href="index.php"><span>Chopin-Gesellschaft<span>Hamburg &amp; Sachsenwald e.V.</span></span></a>
			
			<section class="video">
				
				<div class="videocontent">

					<video id="vjs-video" class="video-js vjs-default-skin vjs-big-play-centered vjs-show-big-play-button-on-pause vjs-16-9" controls preload="auto" poster="media/einladung.jpg" data-setup="{}">

						<source src="media/einladung.mp4" type="video/mp4">
						<source src="media/einladung.webm" type="video/webm">

						<p class="vjs-no-js">Um dieses Video anzusehen, aktivieren Sie bitte JavaScript und führen ein Upgrade auf einen Webbrowser durch, der <a href="https://videojs.com/html5-video-support/" target="_blank">HTML5 Video</a> unterstützt.</p>

					</video>/video-js

				</div>/videocontent
			
			</section>

			<section class="register">
  
  			<div class="content">

    			<h2>Ihr Anliegen</h2>

    			<form id="form-contact" method="post" action="form.php" target="_blank" novalidate>

      			<div class="output alert alert-info is-hidden" data-error="Leider ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.">Fehler</div>

			      <fieldset>
        
        			<ul>
              
          			<li>
            			
                  <label class="inset">Anrede:</label>
              		<label for="contact-herr" class="radio control-inline"><input type="radio" id="contact-herr" name="contact-anrede" value="Herr" required data-msg-required="Bitte wählen Sie eine Anrede.">Herr</label>
									<label for="contact-frau" class="radio control-inline"><input type="radio" id="contact-frau" name="contact-anrede" value="Frau" required data-msg-required="Bitte wählen Sie eine Anrede.">Frau</label>
          			
                </li>
                
                <li>
                
            			<label class="inset" for="contact-vorname">Vorname:</label>
            			<input type="text" id="contact-vorname" name="contact-vorname" placeholder="Vorname" required data-msg-required="Bitte geben Sie Ihren Vornamen an." maxlength="50" autocapitalize="off" autocomplete="off" autocorrect="off">
          			
                </li>
			          
                <li>
            		
                	<label class="inset" for="contact-nachname">Nachname:</label>
            			<input type="text" id="contact-nachname" name="contact-nachname" placeholder="Nachname" required data-msg-required="Bitte geben Sie Ihren Nachnamen an." maxlength="50" autocapitalize="off" autocomplete="off" autocorrect="off">
          			
                </li>
			          
                <li>
      			    
                  <label class="inset" for="contact-email">E-Mail:</label>
            			<input type="email" id="contact-email" name="contact-email" value="" placeholder="E-Mail" required data-msg-required="Bitte geben Sie Ihre E-Mail-Adresse an." data-msg-email="Diese Adresse ist nicht gültig." maxlength="100">
          			
                </li>
			          
                <li>
                
      			      <label class="inset" for="contact-telefon">Telefon:</label>
            			<input type="number" id="contact-telefon" name="contact-telefon" placeholder="Telefon" required data-msg-required="Bitte geben Sie Ihre Rufnummer an." maxlength="20">
          			
                </li>
                
                <li>
                
      			      <label class="inset" for="contact-nachricht">Ihre Nachricht:</label>
            			<textarea id="contact-nachricht" name="contact-nachricht" placeholder="Ihre Nachricht" required data-msg-required="Bitte hinterlassen Sie uns eine Nachricht." maxlength="1000"></textarea>
          			
                </li>
                
              </ul>
                
              <strong class="line-thru">Hinweis</strong>

              <p class="notice">Ihre Daten speichern und verwenden wir ausschließlich zum Zweck der individuellen Kommunikation mit Ihnen. Bitte haben Sie Verständnis dafür, dass wir auf diesem Wege keine rechtsverbindlichen Aufträge entgegennehmen.</p>
          									
            </fieldset>

						<button type="submit" class="button"><span>Nachricht senden</span></button>

					</form>
  
  			</div>

			</section>
			
			<section class="imprint">
  
  			<div class="content">

    			<h2>Impressum</h2>
					
					<p class="notice left-justified">Verantwortlich für die Inhalte gemäß § 10 Abs. 3 MDStV:</p>
					<p class="notice left-justified">Chopin-Gesellschaft Hamburg &amp; Sachsenwald e.V. (Alle Vorstandsmitglieder)<br>Kirchberg 8<br>21521 Wohltorf</p>
					<p class="notice left-justified">Fon: +49 4104 5913<br>Postfach: 800180 &middot; 21001 Hamburg<br>E-Mail: <a href="mailto:info@chopin-hamburg.de">info@chopin-hamburg.de</a></p>
					
					<hr>
					
					<p class="notice justify">Wir übernehmen keine Gewähr für die Aktualität, Korrektheit oder Vollständigkeit der Informationen. Haftungsansprüche, welche sich auf Schäden materieller oder ideeller Art beziehen, die durch die Nutzung oder Nichtnutzung unserer Inhalte verursacht wurden, sind daher grundsätzlich ausgeschlossen. Alle Angebote sind freibleibend und unverbindlich. Wir behalten uns ausdrücklich vor, einzelne Teile der Seiten oder das gesamte Angebot ohne gesonderte Ankündigung zu verändern, zu ergänzen, zu löschen oder die Veröffentlichung zeitweise oder endgültig einzustellen.</p>
					<p class="notice justify">Alle unsere Inhalte sind grundsätzlich urheberrechtlich geschützt. Die weitere Verwendung unserer Inhalte in jedweder Form, auch in Auszügen, in fremden Arbeiten oder Publikationen ist untersagt ohne die ausdrückliche Zustimmung der Chopin-Gesellschaft Hamburg &amp; Sachsenwald e.V.</p>
					<p class="notice justify">Folgende Bilder wurden uns freundlicherweise zur Verfügung gestellt:</p>
					<p  class="notice justify">&#9679; "Steinwayflügel mit Blick in den Spiegelsaal" vom Museum für Kunst und Gewerbe in Hamburg<br>&#9679; "Spiegelsaal" von Herrn Roman Raacke</p>
					
					<hr>
					
					<p class="notice left-justified"><a href="#" class="modal" data-start-section="disclaimer">&gt; Haftungsausschluss</a></p>

				</div>
				
			</section>
			
			<section class="disclaimer">
  
  			<div class="content">

    			<h2>Haftungsausschluss</h2>
					
					<p class="notice justify">Bei direkten oder indirekten Verweisen auf fremde Webseiten tritt grundsätzlich keinerlei Haftungsverpflichtung in Kraft. Auf die aktuelle und zukünftige Gestaltung, die Inhalte oder die Urheberschaft der verlinkten Seiten haben wir keinerlei Einfluss. Diese Feststellung gilt für alle innerhalb unseres Angebotes gesetzten Links und Verweise. Für illegale, fehlerhafte oder unvollständige Inhalte und insbesondere für Schäden, die aus der Nutzung oder Nichtnutzung solcher Informationen entstehen, haftet allein der Anbieter der Seite, auf welche verwiesen wurde.</p>
					
				</div>
				
			</section>
			
			<section class="retrospective">
  
  			<div class="content">

    			<h2>Retrospektive</h2>
					
					<p class="notice justify">Auf das erfolgreiche 1. Chopin Festival Hamburg 2018 folgte das 2. Festival 2019. Gleich und doch anders sollte es sich gestalten. In diesem Jahr fanden zwei Experimente statt, deren Ausgang selbst für die Festivalleitung und Künstler nicht vorhersehbar war. Die Experimente bestanden u. a. darin, dass an jedem einzelnen Konzertabend mindestens ein historisches und ein modernes Piano erklingen, so dass die Wirkung der Gegenüberstellung der Klänge direkt von den Gästen erfahren werden kann.</p>
					
					<p class="notice justify">Der vierte und der fünfte Abend ließen Überraschungen offen, denn der „Wettbewerb“ der Instrumente wurde hier anders als in den vorangegangenen Konzerten realisiert. Einmal spielten nämlich zwei Pianisten an einem Abend teilweise dieselben Stück auf unterschiedlichen Pianos – beim abschließenden Konzertabend trat ein Trio auf, in dem der Pianist sowohl einen historischen als auch einen modernen Flügel spielte, die Streichinstrumente aber dieselben blieben.</p>
					
					<hr>
					
					<p class="notice justify">Das Motto „Klaviermusik neu erleben – Historische und moderne Instrumente im Wettbewerb“ bekam in diesem Jahr eine neue, frisch-experimentelle Dynamik. Jeder einzelne Konzertabend steht mit dem Charakter des Künstlers, seiner Einmaligkeit für sich. Vielen herzlichen Dank, liebe Gäste, Künstler, Sponsoren und Organisatoren, dass Sie diese wunderbaren Festivalerlebnisse ermöglicht haben.</p>
					
					<p class="notice justify">Den Wünschen und Erwartungen der Veranstalter des 2. Chopin-Festivals Hamburg entsprach die Resonanz beim Publikum. Es kamen an allen fünf Abenden insgesamt 600 Besucher, von denen 273 die verteilten Fragebögen ausgefüllt zurückgaben. Eine vorläufige Auswertung zeigt, dass ungefähr die Hälfte lieber die historischen Klaviere gehört hatten, ein Viertel den modernen Shigeru Kawai, und das letzte Viertel beide gleich gern. Das Festivalkonzept wurde von den meisten Zuhörern positiv angenommen, und sie würden auch im Jahr 2020 wieder dabei sein. Das Museum-Ambiente und die Nähe zu den Pianistinnen und Pianisten begünstigen nach Zuhörermeinung die Bereitschaft, die Konfrontationen von alten und neuen Instrumenten auf zwei Ebenen differenziert wahrzunehmen.</p>
					
					<hr>

					<a href="https://www.chopin-hamburg.de/veranstaltungen/termine-2019/retrospektive-20062019/" target="_blank" rel="noopener noreferrer" class="button"><span>Ausführlicher Artikel</span></a>
					
				</div>
				
			</section>
			
			<section class="special">
  
  			<div class="content">

    			<h2>Vergleichen Sie Klangwelten</h2>
					
					<p>Das Klangwelt-Tester-Ticket für € 30,-<br>Den Code <span class="highlight">Klangwelttest</span> bei Ihrer Bestellung angeben!</p>
					
					<hr>
					
					<p class="notice justify">Hören Sie genau den Klang des historischen Flügels und anschließend den Klang des modernen Steinway-Flügels. Beantworten Sie nach dem Konzert ein paar Fragen auf dem Fragebogen, den Sie zu Beginn der Veranstaltung erhalten haben. Keine Angst! Es ist nicht kompliziert oder gar schwierig! Wir danken Ihnen für Ihre Teilnahme.</p>
					
					<hr>
					
					<p>Kartenbestellung per Formular unter:<br><a href="https://www.chopin-hamburg.de/karten/karten-bestellen/" target="_blank" rel="noopener noreferrer">www.chopin-hamburg.de/karten</a></p>
					<p>Oder:</p>

					<a href="mailto:karten@chopin-hamburg.de" class="button"><span>Per E-Mail bestellen</span></a>
					
				</div>
				
			</section>

		</div><!-- /overlay module -->

		<div class="wrap">
                  
			<header id="js-header-main" class="header-main" role="banner">
  
				<div class="container">

					<a class="logo" href="#"><span>Chopin-Gesellschaft<span>Hamburg &amp; Sachsenwald e.V.</span></span></a>

					<div id="js-nav-wrap" class="nav-wrap">

						<div id="js-toggle-nav" class="toggle-nav">

							<div id="js-icon-toggle-nav" class="icon-toggle-nav">

								<i class="icon-toggle"></i>

							</div>

						</div>

						<nav id="js-nav-header" class="nav-header" role="navigation">

							<ul id="js-nav-list" class="nav-list">
								<li class="nav-item first"><a href="#content_01" class="nav-link nav-link-01">Festival</a></li>
								<li class="nav-item"><a href="#content_02" class="nav-link nav-link-02">Intendant</a></li>
                <li class="nav-item"><a href="#content_04" class="nav-link nav-link-04">Künstler</a></li>
  							<li class="nav-item"><a href="#content_05" class="nav-link nav-link-05">Programm</a></li>
                <li class="nav-item"><a href="#content_06" class="nav-link nav-link-06">Veranstalter</a></li>
								<li class="nav-item"><a href="#section-content_07" class="nav-link nav-link-08">Karten</a></li>
								<li class="nav-item"><a href="#section-teaser" class="nav-link nav-link-07">Spenden</a></li>
							</ul>
              
            </nav>
					
          </div>
				
        </div>

			</header>

			<div class="preload"></div>

			<div id="content-main" class="content-main" role="main">
      
      	<div id="content_top" class="content" data-tooltip="Seitenanfang">

          <section id="section-content_top" class="content_top auto-size" data-auto-size="1">
          
            <div class="container">
  
              <div class="box inview">
  
                <div class="single-column">
  
                  <div class="intro">
										
										<a style="display: none;" class="modal" data-start-section="special"><img src="img/content/banderole_2.png" width="270" alt="Vergleichen Sie Klangwelten" style="position: absolute; right: -20px; top: -20px; z-index: 999; cursor: pointer;"></a>

										<!-- <img src="img/content/banderole_2.png" class="banderole-2023" width="270" alt="Special Edition: Online" style="position: absolute; right: -20px; top: -20px; z-index: 998; cursor: default;"> -->
										<img src="img/content/banderole_2.png" class="banderole-2023" width="270" alt="Special Edition: Online">
										
										
										<span class="icons-2023" style="">
											
											<?php include('inc/facebook.inc.php'); ?>
											<?php include('inc/instagram.inc.php'); ?>
											<?php include('inc/youtube.inc.php'); ?>
											
											<br>
											
											<!-- <a href="https://www.chopin-hamburg.de/home/" target="_block" style="color: white; text-decoration: none;">English Summary</a> -->
										
										</span>

                    <a class="logo" href="#"><span>Chopin-Gesellschaft<span>Hamburg &amp; Sachsenwald e.V.</span></span></a>
  
                    <h1><span><?php echo $edit; ?>. Chopin Festival Hamburg</span><br>Klaviermusik neu erleben</h1>
                    
                    <p>

											<a href="media/SDR_2023.mp4" class="button video-button modal" data-start-section="video"><span>Einladung von Prof. Hubert Rutkowski</span></a>
											
											Historische und moderne Klangwelten<br>
											Konzerte – Improvisationen – Meisterkurse<br>

											5. Oktober bis 11. Oktober <?php echo $year; ?>
											<div class="galleria galleria-2023">
												<a href="https://www.youtube.com/watch?v=2TPABUatj74"><span class="video" title="Einladung von Prof. Hubert Rutkowski" alt="Click to check video"></span></a>
												<img src="img/gallery/<?php echo $year; ?>/001-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/002-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/003-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/004-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/005-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/006-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/007-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/008-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/009-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/010-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<!-- <img src="img/gallery/<?php echo $year; ?>/011-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben"> -->
												<!-- <img src="img/gallery/<?php echo $year; ?>/012-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben"> -->
												<img src="img/gallery/<?php echo $year; ?>/013-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<!-- <img src="img/gallery/<?php echo $year; ?>/014-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben"> -->
												 <img src="img/gallery/<?php echo $year; ?>/015-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/016-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/017-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<!--<img src="img/gallery/<?php echo $year; ?>/018-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/019-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben">
												<img src="img/gallery/<?php echo $year; ?>/020-min.jpg" title="<?php echo $edit; ?>. Chopin Festival Hamburg" alt="Klaviermusik neu erleben"> -->
											</div><!-- /galleria -->
										
											<a href="#content_01" class="section-slider"></a>
										</p>
  
                  </div><!-- /col -->
  
                </div><!-- /single-column -->
  
              </div><!-- /box -->
  
            </div><!-- /container -->
  
          </section><!-- /content_top -->
  
          <div class="artwork-strip"></div>
          
        </div><!-- /content_top -->

				<div class="scroller-main" data-image="./img/scroller/desktop/<?php echo $year; ?>/01.jpg" data-image-mobile="./img/scroller/mobile/<?php echo $year; ?>/01.jpg" data-width="1600" data-height="900" data-extra-height="128"><!-- Image 01 --></div>

				<div id="content_01" class="content" data-tooltip="Festival">

					<section id="section-content_01" class="auto-size" data-auto-size="0.6">

						<div class="container">

							<div class="box">

								<div class="box-inner inview">

									<div class="two-columns two-columns-img">

										<div class="img-main-holder">

											<img src="./img/layout/blank.gif" class="img-main img-content_01" alt="2. Chopin Festival Hamburg <?php echo $year; ?>">

										</div><!-- /img-main-holder -->

									</div><!-- /two-columns-img -->

                  <div class="two-columns">
										
										<h1><?php echo $edit; ?>. Chopin Festival in Hamburg <?php echo $year; ?></h1>
										
										<p>Jedes Jahr lädt die Chopin-Gesellschaft Hamburg &amp; Sachsenwald e.V. zum weltweit ersten und einzigen Festival ein, bei dem die Konzertstücke sowohl auf historischen als auch auf modernen Flügeln gespielt werden.</p>
										<p>Bereits zum 5. Mal findet das Chopin Festival Hamburg statt. Diesmal steht Brahms im Fokus des Festivals. Seine Musik durchzieht das facettenreiche Programm, von internationalen InterpretInnen präsentiert. Verschiedene Epochen der Klaviermusik werden gegenübergestellt und auf historischen Flügeln aus dem 19. Jahrhundert sowie auf den modernen Flügeln von Shigeru Kawai dargeboten.</p>
										<p>Diese Konzerte finden u. a. im Museum für Kunst &amp; Gewerbe Hamburg statt. Das Chopin Festival Hamburg klingt mit einem festlichen Konzert in der Elbphilharmonie aus.</p>
										<p>Wir schätzen uns glücklich, dass wir mit unseren Unterstützern Orlen Deutschland und Kawai gute Partnerschaften pflegen und dadurch das Festival ausrichten und Ihnen ein abwechslungsreiches Programm bieten können.</p>
										<p>Genießen Sie das Festival und bleiben Sie beim Hören für neue klangliche Erfahrungen offen!</p>
										<p>Ihr Festival-Team der Chopin-Gesellschaft Hamburg &amp; Sachsenwald</p>
										<hr>
										
										<!-- <p>
											<a class="arrow modal" data-start-section="retrospective">Retrospektive zum 2. Chopin Festival Hamburg <?php echo $year; ?></a><br>
										</p> -->
										
										<!-- <hr> -->
										
										<p>
											<a href="media/Broschuere_2023_EN_2.pdf" target="_blank" class="arrow">Brochure (EN) on the <?php echo $edit; ?>. Chopin Festival Hamburg <?php echo $year; ?></a><br>
											<a href="media/Program_2023.pdf" target="_blank" class="arrow">Programmheft des  <?php echo $edit; ?>. Chopin Festival Hamburg <?php echo $year; ?></a><br>
										</p>
										
										<hr>
										
										<p>
											<a href="2022.php" class="arrow">Archiv-Website des 4. Chopin Festival Hamburg 2022</a><br>
											<a href="2021.php" class="arrow">Archiv-Website des 3. Chopin Festival Hamburg 2021</a><br>
											<a href="2019.php" class="arrow">Archiv-Website des 2. Chopin Festival Hamburg 2019</a><br>
											<a href="2018.php" class="arrow">Archiv-Website des 1. Chopin Festival Hamburg 2018</a>
										</p>

									</div><!-- /two-columns -->
									
                </div><!-- /box-inner -->
                
              </div><!-- /box -->
            
            </div><!-- /container -->
          
          </section><!-- /section-content_01 -->

					<div class="section-next"><a href="#content_02" class="section-slider"></a></div>

				</div><!-- /content_01 -->

				<div class="scroller-main" data-image="./img/scroller/desktop/<?php echo $year; ?>/02.jpg" data-image-mobile="./img/scroller/mobile/<?php echo $year; ?>/02.jpg" data-width="1600" data-height="900" data-extra-height="0"><!-- Image 02 --></div>
				
				<div id="content_02" class="content" data-tooltip="Intendant">

					<section id="section-content_02" class="auto-size" data-auto-size="0.6">

						<div class="container">

							<div class="box">

								<div class="box-inner inview">

									<div class="two-columns two-columns-img d-block">

										<div class="img-main-holder">

											<img src="./img/layout/blank.gif" class="img-main img-content_02" alt="Ihr Gastgeber Prof. Hubert Rutkowski">

										</div><!-- /img-main-holder -->

									</div><!-- /two-columns-img -->

                  <div class="two-columns">
																			
										<h1>Klaviermusik neu erleben</h1>
											
										<blockquote class="curly-quotes" cite="Ihr Gastgeber Prof. Hubert Rutkowski">
											<p>Wie empfindet man den Klang eines Flügels? Erhält man in den Konzertsälen des 21. Jahrhunderts nicht einen Klang, der in unserer Vorstellungskraft unbewusst oder bewusst vorprogrammiert ist? Heutzutage sind wir daran gewöhnt, dass uns die Musik vergangener Epochen auf modernen Instrumenten präsentiert wird. Das Chopin Festival Hamburg ist das erste und einzige Festival, das ein unmittelbares Eintauchen in die unterschiedlichen Klangwelten historischer und moderner Flügel und damit einen direkten Vergleich ermöglicht.</p>
											<p>Im Kontrast zu den Instrumenten des 19. Jahrhunderts wird diesen bei den drei Konzertabenden Brahms trifft Chopin, Chopin-Improvisationen, Brahms & Co. und Von Schubert bis Silvestrov ein moderner Shigeru Kawai-Flügel mit seinen klanglichen Möglichkeiten gegenübergestellt.</p>
											<p><em>Chopin und Deutschland</em>, ein wenig erforschtes Thema. Welche Verbindungen Chopin zu Deutschland hatte – das erfahren Sie bei einem Vortragskonzert. Internationale junge Talente erleben Sie im von uns zum ersten Mal bespielten Rittelmeyer-Saal. Zum Festivalabschluss laden wir zu zwei Klavierquintetten op. 34 von Brahms und Zarębski in die Elbphilharmonie.</p>
											<p>Noch zu besuchen: zwei Meisterkurse, in denen Studierende der HfMT Hamburg von renommierten ProfessorInnen auf historischen und modernen Flügeln unterrichtet werden.</p>
											<p>Wir laden Sie herzlich ein!</p>
										</blockquote>
										
										<p><span class="highlight">Ihr Gastgeber Prof. Hubert Rutkowski</span><br>Intendant des Chopin-Festivals<br>Präsident der Chopin-Gesellschaft Hamburg &amp; Sachsenwald</p>

									</div><!-- /two-columns -->

								</div><!-- /box-inner -->

							</div><!-- /box -->

						</div><!-- /container -->

					</section><!-- /section-content_05 -->

					<div class="section-next"><a href="#content_03" class="section-slider"></a></div>

				</div><!-- /content_02 -->

				<div class="scroller-main" data-image="./img/scroller/desktop/<?php echo $year; ?>/04.jpg" data-image-mobile="./img/scroller/mobile/<?php echo $year; ?>/04.jpg" data-width="1600" data-height="900" data-extra-height="0"><!-- Image 04 --></div>

				<div id="content_04" class="content" data-tooltip="Künstler">
        
					<section id="section-content_04" class="auto-size" data-auto-size="0.6">

						<div class="container">

							<div class="box">

								<div class="box-inner inview">
									
									<div class="single-column">
                  
                  	<h1>Künstler:innen</h1>

										<div id="content_04-slider" class="da-slider">
										<div class="da-slide">
                      
											<div id="slide_04-11">
											
												<h2>Matthias Kirschnereit, Klavier</h2>
												
												<a href="https://www.matthias-kirschnereit.de/" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												<p style="background: url(img/content/mki.png) 2px 5px no-repeat; padding-left: 137px;">
												Pleyel (1847) | Steinway (1872) | Shigeru Kawai (2018)<br>

													<br>
													Als „Poet am Klavier“ konzertiert Matthias Kirschnereit weltweit mit führenden Klangkörpern und Dirigenten sowie berühmten Kammermusikpartner:innenn. Eine umfangreiche Diskographie dokumentiert seit 1989 sein künstlerisches Schaffen. Seine Gesamtaufnahme der Klavierkonzerte W. A. Mozarts hat Maßstäbe gesetzt, für die Weltersteinspielung des rekonstruierten e-Moll Klavierkonzerts von Felix Mendelssohn Bartholdy erhielt er einen ECHO Klassik. Seit 2012 ist er künstlerischer Leiter der Gezeitenkonzerte. Er unterrichtet als Professor an der Hochschule für Musik und Theater Rostock und engagiert sich für die Initiative Rhapsody in School und das Kulturprojekt TONALi. Seit Januar 2021 ist er Präsident der Johannes-Brahms-Gesellschaft Hamburg.

													<br><br><a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_01').click()">Programm 5. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
													<br>
												</p>
										
											</div><!-- /slide_04-11 -->
										
										</div><!-- /da-slide -->

										<hr>

										<div class="da-slide">
                      
											<div id="slide_04-10">
											
												<h2>Artem Yasynskyy, Klavier</h2>
												
												<a href="https://www.artemyasynskyy.com/" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												<p style="background: url(img/content/ay.png) 2px 5px no-repeat; padding-left: 137px;">
													Pleyel (1847) | Shigeru Kawai (2018)<br>
													<br>
													Nach seiner Ausbildung in Donezk, Ukraine absolvierte er an der Bremer Hochschule für Künste sein Masterstudium und das Konzertexamen bei Prof. Patrick O'Byrne. Seit 2015 unterrichtet Yasynskyy an der HfK Bremen sowie als Professor am Conservatorio di Tartini, Trieste, Italien. Er ist Gewinner vieler Preise internationaler Wettbewerbe, darunter die Goldmedaille an der Cincinnati World Piano Competition, die Bronzemedaille bei der Gina Bachauer International Piano Artist Competition, die Bronzemedaille sowie der Publikumspreis bei der Sendai International Music Competition und der 3. Preis bei der Gian Battista Viotti International Piano Competition. CD-Aufnahmen sind im Naxos Label mit Werken von Josef Hofmann und Domenico Scarlatti erschienen.


													<br><br><a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_02').click()">Programm 6. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
													<br>
												</p>
										
											</div><!-- /slide_04-10 -->
										
										</div><!-- /da-slide -->

										<hr>

										<div class="da-slide">
                      
											<div id="slide_04-08">
											
												<h2>Gevorg Matinyan, Klavier</h2>
												
												<a href="https://www.deutsche-stiftung-musikleben.de/stipendiatinnen/gevorg-matinyan/" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												<p style="background: url(img/content/gm.png) 2px 5px no-repeat; padding-left: 137px;">
													Steinway (1990)<br><br>
													Gevorg Matinyan, geboren 2002 in Yerevan, wird seit seinem elften Lebensjahr von Prof. Villi Sargsyan und Dozent Areg Sargsyan unterrichtet und spielt seitdem jährlich Solokonzerte. Zu seinem musikalischen Anliegen äußert er sich folgendermaßen: „Es ist aus meiner Erfahrung leicht von der Technik ‚verführt‘ zu werden, aber ich tue alles dafür, damit sie ausschließlich der Musik dient und nicht im Vordergrund steht.“
In den vergangenen 3 Jahren wurde er mit dem 2. Preis am X „Maria Herrero“ internationalen Klavierwettbewerb in Granada, Spanien, dem 3. Preis am III internationalen Musik Wettbewerb in Paris und dem 3. Preis am IX „Cesar Franck“ internationalen Klavierwettbewerb in Brüssel ausgezeichnet. Mit 17 Jahren begann er das Studium an der Hochschule für Musik und Theater Hamburg und studiert derzeit bei Prof. Hubert Rutkowski.
	
													<br>										
													<br><a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_03').click()">Programm 7. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a>  -->
													<br>
												</p>
										
											</div><!-- /slide_04-08 -->
										
										</div>

										<hr>

										<div class="da-slide">
                      
											<div id="slide_04-04">
											
												<h2>Alexei Lubimov, Klavier</h2>
												
												<a href="https://de.wikipedia.org/wiki/Alexei_Borissowitsch_Ljubimow" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												<p style="background: url(img/content/al2.png) 2px 5px no-repeat; padding-left: 137px;">
													Brodmann (um 1815) |  Steinway (1872) | Shigeru Kawai (2018)<br>
													<br>
													Seine herausragende Position in der heutigen Musikszene verdankt Alexei Lubimov seinen überragenden Fähigkeiten in der historischen Aufführungspraxis. Er konzentrierte sich früh auf die Arbeit mit Originalinstrumenten, gründete 1976 das Moskauer Barock-Quartett sowie die Moskauer Kammerakademie. Auf Schallplatte und CD sind über 30 Einspielungen des Künstlers dokumentiert, die vom Barock bis hin zur zeitgenössischen Musik reichen. Alexei Lubimov war einer der Ersten, der auf historischen Instrumenten gespielt hat und gründete im Moskauer Konservatorium eine Abteilung für historische Aufführungspraxis. Er bekleidete auch viele Jahre eine Professur am Mozarteum in Salzburg.
													<br>
													<br>
													<a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_05').click()">Programm 10. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
													<br>
												</p>
										
											</div><!-- /slide_04-04 -->
										
										</div><!-- /da-slide -->
										
										<hr>

										<div class="da-slide">
                      
											<div id="slide_04-03">
											
												<h2>Hubert Rutkowski, Klavier</h2>
												
												<a href="http://hubertrutkowski.com/" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												<p style="background: url(img/content/hr.png) 2px 5px no-repeat; padding-left: 137px;">
													Shigeru Kawai (2017)<br>
													<!-- Werke von L. van Beethoven, F. Chopin, F. Liszt, F. Schubert<br> -->
													<br>
													Hubert Rutkowskis musikalische Interpretationen sind von einer leidenschaftlichen Bindung zur Ästhetik der alten Schule des 19. Jhs. geprägt. Die pianistischen Traditionen von Fryderyk Chopin, Theodor Leschetizky und ihren Nachfolgern bilden daher den Grundstein seines künstlerischen Profils. Er ist Gewinner des Chopin-Klavierwettbewerbs Hannover 2007. Der Pianist hat mehrere CD-Aufnahmen auf modernen und historischen Flügeln des 19. Jhs. eingespielt. Zum 1. März 2021 zu Chopins Geburtstag hat er in Hamburg die Weltpremiere eines wiederentdeckten Pleyel-Flügels von Chopin realisiert. Seit 2018 ist er Intendant des Chopin Festival Hamburg.<br>
													<br>
													<a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_06').click()">Programm 11. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
													<br>
												</p>
												
											</div><!-- /slide_04-03 -->
									 
										 </div><!-- /da-slide -->
										
										<hr>
										
                      <div class="da-slide">
                        
                        <div id="slide_04-02">
                        
                        	<h2>Ljudmila Minnibaeva, Violine</h2>

													<a href="https://www.ndr.de/orchester_chor/elbphilharmonieorchester/orchester/Ljudmila-Minnibaeva,ljudmilaminnibaeva100.html" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
													<p>Elphier-Quartett</p>
                        	<p style="background: url(img/content/lm.png) 2px 5px no-repeat; padding-left: 137px;">
														Pietro Landolfi (1760)<br>
														<!-- Werke von F. Chopin, M. Clementi, N. Medtner, J. Sibelius, J. Zarębski<br> -->
														<br>
														Ljudmila Minnibaeva wurde 1973 in Leninabad (heutiges Chudschand/Tadschikistan) geboren und studierte zunächst am Moskauer Konservatorium. Es folgten Studium und Konzertexamen an der Hochschule für Musik und Theater Hamburg bei Prof. Mark Lubotsky und Prof. Kolja Blacher. Sie erhielt den 1. Preis der Elise-Meyer-Stiftung und den 1. Preis beim Internationalen Johannes Brahms Wettbewerb in Österreich. Ferner wurde sie mit dem Masefield-Preis der Alfred-Toepfer-Stiftung ausgezeichnet. Als Mitglied des Evrus-Trios gewann Minnibaeva den 3. Preis beim Internationalen Joseph Haydn Kammermusikwettbewerb in Wien. Seit 2003 ist sie an der Hamburger Musikhochschule als Professorin tätig und seit 2011 Mitglied des NDR Elbphilharmonie Orchesters.
														<br>
														<br>
														<a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_06').click()">Programm 11. Oktober <?php echo $year; ?></a><br>
														<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
														<br>
													</p>
                      		
                        </div><!-- /slide_04-02 -->
                      
                      </div><!-- /da-slide -->
                      
                      <hr>
                      
                      <div class="da-slide">
                      
                      	<div id="slide_04-01">
                        
                          <h2>Yihua Jin-Mengel, Violine</h2>
													<p>Elphier-Quartett</p>
													<a href="https://www.ndr.de/orchester_chor/elbphilharmonieorchester/orchester/Yihua-Jin-Mengel,yihuajin101.html" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
                          
                          <p style="background: url(img/content/yjm.png) 2px 5px no-repeat; padding-left: 137px;">
														Sergio Peresson (1985)<br>
														<br>
														Yihua Jin-Mengel wurde 1983 in Yanji (China) geboren und studierte Violine im Zentralen Musikkonservatorium in Beijing. Es folgten Studium und Konzertexamen bei Prof. Ilan Gronich an der Universität der Künste Berlin sowie Kammermusik-Konzertexamen an der Hochschule für Musik Franz Liszt Weimar. Jin-Mengel erhielt den 1. Preis des Nationalen Wettbewerbs in China sowie den Spezialpreis für die beste Interpretation eines chinesischen Werkes. Für ihre erste eigene Komposition „Da-nuo Fest“ erhielt sie den chinesischen Kompositionspreis. Jin-Mengel erhielt den 1. Preis beim Ibolyka-Gyarfas-Violinwettbewerb und den 1. Preis beim Kammermusikwettbewerb der Alice-Samter-Stiftung Berlin. Seit 2009 ist sie Mitglied des NDR Elbphilharmonie Orchesters.
														<br>
														<br>
														<a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_06').click()">Programm 11. Oktober <?php echo $year; ?></a><br>
														<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
														<br>
													</p>
                      
                      	</div><!-- /slide_04-01 -->
                      
                      </div><!-- /da-slide -->
											
											<hr>
                      
                      <div class="da-slide">
                      
                      	<div id="slide_04-00">
                        
                          <h2>Alla Rutter, Viola</h2>
													<p>Elphier-Quartett</p>
													<a href="https://www.ndr.de/orchester_chor/elbphilharmonieorchester/orchester/Alla-Rutter,allarutter102.html" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
                          
                          <p style="background: url(img/content/ar.png) 2px 5px no-repeat; padding-left: 137px;">
														Bauer unbekannt, Mittenwald, ca. 18. Jahrhundert<br>
														<br>
														Alla Rutter wurde 1980 in Alma-Ata (heutiges Almaty/Kasachstan) geboren und studierte Violine an der Hochschule für Musik Carl Maria von Weber Dresden bei Prof. Reinhard Ulbricht. Es folgte ihre Anstellung bei den 1. Violinen der Hamburger Symphoniker. Nachdem sie dort bereits zehn Jahre lang gespielt hatte, folgte Rutter ihrem langjährigen Wunsch und wechselte das Instrument hin zur Bratsche. Im Sommer 2015 gewann sie das Probespiel des NDR Elbphilharmonie Orchesters für eine Bratschenstelle und ist seitdem Mitglied des Orchesters.														
														<br>
														<br><a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_06').click()">Programm 11. Oktober <?php echo $year; ?></a><br>
														<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
														<br>
													</p>
                      
                      	</div><!-- /slide_04-07 -->
                      
                      </div><!-- /da-slide -->
											
											<hr>
                      
                      <div class="da-slide">
                      
                      	<div id="slide_04-0">
                        
                          <h2>Phillip Wentrup, Violoncello </h2>
													<p>Elphier-Quartett</p>
													<a href="https://www.ndr.de/orchester_chor/elbphilharmonieorchester/orchester/Phillip-Wentrup,phillipwentrup100.html" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
                          
                          <p style="background: url(img/content/pw.png) 2px 5px no-repeat; padding-left: 137px;">
													Carlo Antonio Testore (1751)<br>
														<br>
														Phillip Wentrup, 1991 in Kaltenkirchen geboren, erhielt im Alter von sechs Jahren seinen ersten Violoncellounterricht. Nach langjähriger Ausbildung bei Edwin Koch wechselte er in die Klasse von Prof. Bernhard Gmelinn an der Hochschule für Musik und Theater Hamburg und absolvierte dort sein Bachelorstudium. Es folgte ein Masterstudium bei Prof. Sebastian Klinger.
														Auf internationalen Meisterkursen erhielt er wichtige musikalische Anregungen von Wolfgang Boettcher, David Geringas, Jens-Peter Maintz und Wolfgang Emanuel Schmidt.
														Phillip Wentrup ist vielfacher Preisträger diverser Wettbewerbe und wurde oft geehrt. 
														Er war Stipendiat der Oscar und Vera Ritter-Stiftung und wurde durch die Yehudi Menuhin Stiftung Live Music Now, den Lyceum Club Hamburg sowie das Career Center der HfMT Hamburg gefördert. Seit November 2016 ist er Mitglied im NDR Elbphilharmonie Orchester.
														<br>
														<br><a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_06').click()">Programm 11. Oktober <?php echo $year; ?></a><br>
														<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->

														<br>
													</p>
                      
                      	</div><!-- /slide_04-0 -->
                      
                      </div><!-- /da-slide -->
											<hr>
                      
											<div class="da-slide">
                      
											<div id="slide_04-06">
											
												<h2>Adam Wibrowski, Vortrag</h2>
												
												<a href="http://krakowpianosummer.pl/professors.html " target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												<p style="background: url(img/content/aw.png) 2px 5px no-repeat; padding-left: 137px;">
													<!-- Meisterkurs<br> -->
													<br>
													Adam Wibrowski ist Pianist und emeritierter Professor am Pariser Konservatorium und an der University of Southern California in Los Angeles. Er ist Absolvent der Musikakademie in Krakau in der Klasse von Prof. Ludwik Stefański, ehemaliger Berater der Kulturministerin in Polen und Frankreich, Urheber des europäischen Programms Das Klavier als Spiegel der europäischen Kulturen und hat das Chopin-Festivals Nohant (Frankreich) initiiert. Er ist Gründer und künstlerischer Leiter der Paderewski Days New York, des Paderewski Festival of Raleigh (USA) und des Krakow Piano Summer.
													<br>
													<br><a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_04').click()">Programm 9. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
													<br>
												</p>
										
											</div><!-- /slide_04-06 -->
										
										</div><!-- /da-slide -->
										
										<hr>

										<div class="da-slide">
                      
											<div id="slide_04-05">
											
												<h2>Mateusz Dubiel, Klavier</h2>
												
												<a href="https://muzeum.nifc.pl/pl/muzeum/koncert-artykul/152_mateusz-dubiel/" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												 <p style="background: url(img/content/mdm.png) 2px 5px no-repeat; padding-left: 137px;">
												 Steinway (1994)<br>
													<br>
													Ab Oktober wird er sein Studium an der Krzysztof-Penderecki-Musikakademie in Krakau in der Klavierklasse von Prof. Mirosław Herbowski aufnehmen. Er ist Preisträger nationaler und internationaler Wettbewerbe, darunter der 1. Preis beim 51. Nationalen Chopin-Wettbewerb in Warschau (2022), der 2. Preis beim 3. Internationalen Klavierwettbewerb Jeune Chopin in Lugano, Schweiz (unter der Ehrenschirmherrschaft von Martha Argerich, 2023), der 1. Preis und 4 weitere Preise beim 27. Internationalen Chopin-Klavierwettbewerb für Kinder und Jugendliche in Szafarnia, 6. Preis beim 12. Internationalen Wettbewerb für junge Pianisten Arthur Rubinstein in Memoriam in Bydgoszcz (2021).
													<br>
													<br>
													<a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_04').click()">Programm 9. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
													<br>
												</p>
												
											</div><!-- /slide_04-05 -->
										
										</div><!-- /da-slide -->
										
										<hr>

										<div class="da-slide">
                      
											<div id="slide_04-09">
											
												<h2>Stefania Neonato, Klavier</h2>
												
												<a href="https://www.stefanianeonato.com/" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												<p style="background: url(img/content/sn.png) 2px 5px no-repeat; padding-left: 137px;">
													Brodmann (um 1815) | Pleyel (1847)<br>
													Meisterkurs<br>
													<br>
													Mit Alexander Lonquich, Riccardo Zadra und Leonid Margarius setzte sie ihre musikalischen Studien fort, um später unter der Leitung von Stefano Fiuzzi an der Accademia Internazionale in Imola die Masterprüfung in Hammerklavier abzulegen. Den Doctor of Musical Arts in Historical Performance Practice erlangte sie an der Cornell University in New York mit Malcolm Bilson, an der sie von 2006 bis 2008 als Assistentin für Klavier tätig war. Im Jahr 2007 war sie Preisträgerin beim Internationalen Wettbewerb für Hammerklavier Musica Antiqua in Bruges, bei dem ihr auch der Publikumspreis verliehen wurde. Seither ist sie bei wichtigen europäischen sowie nordamerikanischen Festivals gern gesehener Gast. Seit 2013 ist sie Professorin für Hammerklavier an der Hochschule für Musik und Darstellende Kunst Stuttgart.														
													<br>
													<br><a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_07').click()">Programm 7. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
													<br>
												</p>
										
											</div><!-- /slide_04-09 -->
										
										</div><!-- /da-slide -->

										<hr>
                      
										<div class="da-slide">
                      
											<div id="slide_04-07">
											
												<h2>Joanna Ławrynowicz-Just, Klavier</h2>
												
												<a href="https://chopin.edu.pl/employees/82_joanna-lawrynowicz-just" target="_blank"><img src="img/layout/blank.gif" class="hidden-link"></a>
												
												<p style="background: url(img/content/jl2.png) 2px 5px no-repeat; padding-left: 137px;">
													Shigeru Kawai (2018)<br>
													Meisterkurs<br><br>
													<!-- Pleyel 1847 | moderner Steinway<br>
													<br> -->
													Joanna Ławrynowicz-Just ist Preisträgerin zahlreicher internationaler Klavierwettbewerbe (darunter der Chopin-Wettbewerb Darmstadt 1999) und betreibt seit vielen Jahren eine rege Konzerttätigkeit als Solistin und Kammermusikerin auf der ganzen Welt. Sie hat über 30 CD-Aufnahmen eingespielt und ist die erste polnische Pianistin, die Chopins Gesamtwerk aufgenommen hat. Joanna Ławrynowicz leitet weltweit Seminare und Meisterkurse und ist Jurorin bei zahlreichen nationalen und internationalen Wettbewerben. Derzeit ist die Professorin Leiterin der Klavierabteilung an der Chopin Universität für Musik in Warschau.														
													<br>
													<br><a class="arrow tab-remote" href="#content_05" onClick="$('#tab_05_07').click()">Programm 8. Oktober <?php echo $year; ?></a><br>
													<!-- <a class="arrow " href="https://www.chopin-hamburg.de/home/" target="_blank">Künstler-Interviews</a> -->
													<br>
												</p>
										
											</div><!-- /slide_04-07 -->
										
										</div><!-- /da-slide -->

										<hr>

                      <nav class="da-arrows">
                        <span class="da-arrows-prev"></span>
                        <span class="da-arrows-next"></span>
                      </nav>
                    
                    </div><!-- /da-slider -->
                      
                  </div><!-- /single-column -->

          			</div><!-- /box-inner -->
                
          		</div><!-- /box -->
          
          	</div><!-- /container -->

					</section><!-- /section-content_04 -->

					<div class="section-next"><a href="#content_05" class="section-slider"></a></div>

				</div><!-- /content_04 -->

				<div class="scroller-main" data-image="./img/scroller/desktop/<?php echo $year; ?>/05.jpg" data-image-mobile="./img/scroller/mobile/<?php echo $year; ?>/05.jpg" data-width="1600" data-height="900" data-extra-height="0"><!-- Image 05 --></div>

				<div id="content_05" class="content" data-tooltip="Programm">

					<section id="section-content_05" class="auto-size" data-auto-size="1.2">

						<div class="container">

							<div class="box">

								<div class="box-inner inview">

                  <div class="single-column">

										<h1>Programm</h1>
										
										<p>Die KünstlerInnen beim 5. Chopin Festival Hamburg sind international gefeierte MusikerInnen. Nicht nur auf modernen Flügeln sind sie versiert, sondern auch in der historischen Aufführungspraxis, auf originalen Flügeln aus vergangenen Zeiten. Die BesucherInnen werden die wunderbare Atmosphäre des Festivals erleben. Diese setzt sich u. a. aus der authentischen Klangwelt von Original-Flügeln aus dem 19. Jh. zusammen, die von den virtuosen PianistInnen für unser Publikum zum Klingen gebracht wird.</p>

										<div class="tabs">
   
                      <ul class="tabs-list">
                        <li class="tab"><a id="tab_05_01" href="#content_05-01">5. Oktober <?php echo $year; ?></a></li>
                        <li class="tab"><a id="tab_05_02" href="#content_05-02">6. Oktober <?php echo $year; ?></a></li>
												<li class="tab"><a id="tab_05_03" href="#content_05-03">7. Oktober <?php echo $year; ?></a></li>
												<li class="tab"><a id="tab_05_04" href="#content_05-04">9. Oktober <?php echo $year; ?></a></li>
												<li class="tab"><a id="tab_05_05" href="#content_05-05">10. Oktober <?php echo $year; ?></a></li>
												<li class="tab"><a id="tab_05_06" href="#content_05-06">11. Oktober <?php echo $year; ?></a></li>
												<li class="tab"><a id="tab_05_07" href="#content_05-07">Meisterkurse</a></li>
                      </ul>

                      <div class="panel">
                      
                        <div id="content_05-01">
													
													<p class="abstract">19.00 Uhr<br>Brahms trifft Chopin<br><br>Klavierabend<br>Museum für Kunst und Gewerbe Hamburg<br/>Sammlung Musikinstrumente / Spiegelsaal hinzufügen</p>
													
													<hr>
													
													<a href="https://www.matthias-kirschnereit.de/" target="_blank" class="static"><h2 class="avatar" style="background-image: url(img/content/mki.png);">Matthias Kirschnereit</h2></a>
													
													<hr>

													<h3>Flügel Steinway &amp; Sons, New York 1872</h3>													
													
													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Sechzehn Walzer op. 39</p>									
													<p>1. H-Dur – 2. E-Dur – 3. gis-Moll – 4. e-Moll – <br>5. E-Dur – 6. Cis-Dur – 7. cis-Moll – 8. B-Dur –<br>9. d-Moll – 10. G-Dur – 11. h-Moll – 12. E-Dur –<br>13. C-Dur – 14. a-Moll – 15. As-Dur – 16. d-Moll</p>		
													
													<h3>Flügel Pleyel, Paris 1847</h3>
													
													<p><span class="highlight">Frédéric Chopin (1810–1849)</span></p>
													<p>Nocturne cis-Moll op. posth.<br/>Scherzo b-Moll op. 31</p>

													<h3>Flügel Steinway & Sons, New York 1872</h3>
													
													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Scherzo es-Moll op. 4</p>

													<strong class="line-thru">Pause</strong>

													<h3>Flügel Shigeru Kawai, Hamamatsu 2018</h3>
													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Sonate f-Moll op. 5</p>
													<p>Allegro maestoso – Andante espressivo – Scherzo. Allegro energico – <br/> Intermezzo. Andante molto – Finale. Allegro moderato ma rubato</p>


													<a href="https://www.eventbrite.de/e/5-chopin-festival-hamburg-brahms-trifft-chopin-tickets-704484109937" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Klavierabend am 5.10.2023</span></a>

                        </div><!-- /content_05-01 -->
                        
                        <div id="content_05-02">
													
													<p class="abstract">19.00 Uhr<br>Chopin-Improvisationen, Brahms &amp; Co.<br><br>Klavierabend<br>Museum für Kunst und Gewerbe Hamburg<br>Sammlung Musikinstrumente</p>
													
													<hr>
													
													<a href="https://www.artemyasynskyy.com/" target="_blank" class="static"><h2 class="avatar" style="background-image: url(img/content/ay.png);">Artem Yasynskyy</h2></a>

													<hr>

                          <h3>Flügel Pleyel, Paris 1847</h3>
													
													<p><span class="highlight">Domenico Scarlatti (1685–1757)</span></p>
													<p>Sonate B-Dur K.503<br>Sonate g-Moll K.426<br>Sonate C-Dur K.513<br>Sonate D-Dur K.484</p>

													<p><span class="highlight">Johann Sebastian Bach (1685–1750)</span></p>
													<p>Partita G-Dur Nr. 5 BWV 829</p>

													<p><span class="highlight">Frédéric Chopin (1810–1849)</span></p>
													<p>Ballade g-Moll Op. 23</p>

													<strong class="line-thru">Pause</strong>
													
													<h3>Flügel Shigeru Kawai, Hamamatsu 2018</h3>

													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Paganini Variationen op. 35 Heft I und II</p>
													
													<p><span class="highlight">Frédéric Chopin (1810–1849)</span></p>
													<p>Bearbeitungen von Artem Yasynskyy<br/>Etüde a-Moll Op. 10  Nr. 2<br/>Etüde Ges-Dur Op. 10 Nr. 5<br/>Etüde F-Dur Op. 10 Nr. 8</p>

													<p>Improvisationen auf Mazurkas und Nocturnes</p>
													
													<a href="https://www.eventbrite.de/e/chopin-improvisationen-brahms-co-tickets-704545012097" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Klavierabend am 6.10.2023</span></a>

                        </div><!-- /content_05-02 -->
												
												<div id="content_05-03">
													
													<p class="abstract">19.00 Uhr<br>Internationale, junge Talente<br><br>Klavierabend<br>Rittelmeyer-Saal, Heimhuder Str. 34a</p>
													
													<hr>
													
													<a href="https://www.deutsche-stiftung-musikleben.de/stipendiatinnen/gevorg-matinyan/" target="_blank" class="static"><h2 class="avatar" style="background-image: url(img/content/gm.png);">Gevorg Matinyan</h2></a>
													
													<hr>
													
													<h3>Flügel Steinway &amp; Sons, Hamburg 1990</h3>

													<p><span class="highlight">Frédéric Chopin (1810–1849)</span></p>
													<p>Andante spianato et grande polonaise brillante op. 22</p>

													<p><span class="highlight">Komitas (1869–1935)<br>Bearbeitung Villi Sargsyan (* 1930)</span></p>
													<p>Armenische Volkslieder</p>
													<p>Schogher djan | Շողեր ջան | Liebe Schogher<br/>Kaqavi erg | Կաքավի երգ | Lied des Rebhuhns<br/>Garun a | Գարուն ա | Es ist Frühling<br/>Qele, qele | Քելե, քելե | Geh, lauf<br/>Tsitsernak | Ծիծեռնակ | Schwalbe</p>
													
													<p><span class="highlight">Franz Liszt (1811–1886)</span></p>
													<p><em>Après une lecture de Dante</em> Fantasie quasi Sonate S. 161/7</p>

													<strong class="line-thru">Pause</strong>
													
													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Intermezzo A-Dur op. 76 Nr. 6</p>
														
													<p><span class="highlight">Alexander Skriabin (1872–1915)</span></p>
													<p>Sonate Fantasie gis-Moll op. 19 Nr. 2<br>Andante – Presto</p>

													<p><span class="highlight">Franz Liszt (1811–1886)</span></p>
													<p>Ungarische Rhapsodie cis-Moll Nr. 12 S. 244/12</p>
                          
													<a href="https://www.eventbrite.de/e/5-chopin-festival-hamburg-internationale-junge-talente-tickets-704577659747" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Klavierabend am 7.10.2023</span></a>

                        </div><!-- /content_05-03 -->
												
												<div id="content_05-04" style="min-height: 1285px!important;">
													
													<p class="abstract">19.00 Uhr<br>Chopin und Deutschland – ein besonderes Verhältnis<br>Inspirationen, Reisen, Freunde<br><br>Vortragskonzert<br>Residenz des Generalkonsuls der Republik Polen<br>Maria-Louisen-Straße 137</p>
													
													<hr>
													<p>Das Leben von Fryderyk Chopin verbinden wir hauptsächlich mit Polen – Warschau und Masowien – und mit Frankreich – Paris und Nohant.</p>
													<p>Bekannt sind auch die wichtigen Episoden zweier längerer Aufenthalte in Wien in den Jahren 1829 und 1830 sowie Chopins romantischer Aufenthalt mit George Sand und ihren Kindern auf Mallorca in den Jahren 1838/39.</p>
													<p>Im Schatten dieser bekanntesten Orte und der mit ihnen verbundenen Ereignisse stehen Chopins Aufenthalte in verschiedenen deutschsprachigen Ländern Europas zu dieser Zeit und seine zahlreichen persönlichen und musikalischen Beziehungen zu deutschen KünstlerInnenkreisen. Diese Kontakte haben die Persönlichkeit von Fryderyk Chopin stark geprägt und sind ein wichtiges Zeugnis für die Integration der europäischen KünstlerInnenkreise in der Romantik.</p>

													<hr>
													
													<a href="http://krakowpianosummer.pl/professors.html" target="_blank" class="static"><h2 class="avatar two-line" style="background-image: url(img/content/aw.png);">Adam Wibrowski<span>Vortrag</span></h2></a>
													<a href="https://muzeum.nifc.pl/pl/muzeum/koncert-artykul/152_mateusz-dubiel/" target="_blank" class="static"><h2 class="avatar two-line" style="background-image: url(img/content/mdm.png);">Mateusz Dubiel<span>Klavier</span></h2></a>
													
													<hr>
													
													<h3>Flügel Steinway &amp; Sons, Hamburg 1994</h3>

													<p><span class="highlight">Felix Mendelssohn Bartholdy (1809-1847)</span></p>
													<p>Lied ohne Worte g-Moll, op. 102 Nr. 4<br>Un poco agitato, ma andante</p>

													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Rhapsodie h-Moll op. 79</p>

													<p><span class="highlight">Robert Schumann (1810-1856)</span></p>
													<p>Kinderszenen op. 15</p>
													<p>1. Von fremden Ländern und Menschen – 2. Kuriose Geschichte<br>3. Hasche-Mann – 4. Bittendes Kind – 5. Glückes genug<br>6. Wichtige Begebenheit – 7. Träumerei – 8. Am Kamin<br>9. Ritter vom Steckenpferd – 10. Fast zu ernst – 11. Fürchtenmachen<br>12. Kind im Einschlummern – 13. Der Dichter spricht</p>

													
													<p><span class="highlight">Frédéric Chopin (1810–1849)</span></p>
													<p>Sonata h-moll, op. 58</p>
													<p>Allegro Maestoso – Scherzo. Vivace – Largo – Presto non tanto</p>
                          
													<a href="https://www.eventbrite.de/e/chopin-und-deutschland-ein-besonderes-verhaltnis-ein-vortragskonzert-tickets-704626285187" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Vortragskonzert am 9.10.2023</span></a>

                        </div><!-- /content_05-04 -->
												
												<div id="content_05-05" style="min-height: 1285px!important;">
													

													<p class="abstract">19.30 Uhr<br>Von Schubert bis Silvestrov<br><br>Klavierabend<br>Museum für Kunst und Gewerbe Hamburg<br>Sammlung Musikinstrumente</p>
													<!-- <p class="abstract">19.00 Uhr<br>Balladen und Romanzen<br><br>Improvisationsabend<br>Hochschule für Musik und Theater Hamburg, Mendelssohn-Saal</p> -->
													
													<hr>

													<a href="https://de.wikipedia.org/wiki/Alexei_Borissowitsch_Ljubimow " target="_blank" class="static"><h2 class="avatar" style="background-image: url(img/content/al2.png);">Alexei Lubimov</span></h2></a>
													
													<hr>

													<h3>Hammerflügel Joseph Brodmann, Wien um 1815</h3>

													<p><span class="highlight">Franz Schubert (1797–1828)</span></p>
													<p>Vier Impromptus op. 90, D 899</p>
													<p>Allegro molto moderato, c-Moll<br>Allegro, Es-Dur<br>Andante, Ges-Dur<br>Allegretto, As-Dur</p>

													<h3>Flügel Shigeru Kawai, Hamamatsu 2018</h3>
													
													<p><span class="highlight">Valentin Silvestrov (* 1937)</span></p>
													<p>Kitsch-Musik (1977)</p>
													<p>Allegro vivace – Moderato – Allegretto – Moderato – Allegretto</p>

													<strong class="line-thru">Pause</strong>

													<h3>Flügel Steinway &amp; Sons, New York 1872</h3>

													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Sechs Klavierstücke op. 118</p>
													<p>Intermezzo a-Moll<br>Intermezzo A-Dur<br>Ballade g-Moll<br>Intermezzo f-Moll<br>Romanze F-Dur<br>Intermezzo es-Moll</p>

													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Drei Intermezzi op. 117<br>Es-Dur – b-Moll – cis-Moll</p>

													<p><span class="highlight">Frédéric Chopin (1810–1849)</span></p>
													<p>Barcarolle Fis-Dur op. 60</p>												
                          
													<a href="https://www.eventbrite.de/e/5-chopin-festival-hamburg-von-schubert-bis-silvestrov-tickets-705256088947" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Klavierabend am 10.10.2023</span></a>
													
													<!-- <div class="img_center">
														<img src="img/content/2022/7.png" alt="Logo">
														<p class="small_text ">Das Project "Balladen und Romanzen" wird im Rahmen des Programms "44 x Mickiewicz" furchgeführt, das seinerseits durch das Adam-Mickiewicz-Institut initiiert wurde.<br>Partner der Veranstaltung ist das National Institut für Musik und Tanz. Gefördert mit Mitteln des Ministers für Kultur und nationales Erbe.</p>
													</div> -->

                        </div><!-- /content_05-05 -->

												<div id="content_05-06" style="min-height: 1285px!important;">
													

													<p class="abstract">19.30 Uhr<br>Brahms & Zarębski<br>zwei Klavierquintette op. 34<br><br>Kammermusikabend<br>Elbphilharmonie</p>
													<!-- <p class="abstract">19.00 Uhr<br>Balladen und Romanzen<br><br>Improvisationsabend<br>Hochschule für Musik und Theater Hamburg, Mendelssohn-Saal</p> -->
													
													<hr>
													<a href="http://hubertrutkowski.com/" target="_blank" class="static"><h2 class="avatar two-line" style="background-image: url(img/content/hr.png);">Hubert Rutkowski<span>Flügel Shigeru Kawai (Hamamatsu 2017)</span></h2></a>
													<p class="abstract">Elphier-Quartett:</p>
													<a href="https://www.ndr.de/orchester_chor/elbphilharmonieorchester/orchester/Ljudmila-Minnibaeva,ljudmilaminnibaeva100.html" target="_blank" class="static"><h2 class="avatar two-line" style="background-image: url(img/content/lm.png);">Ljudmila Minnibaeva<span>Violine Pietro Landolfi (Mailand 1760)</span></h2></a>
													<a href="https://www.ndr.de/orchester_chor/elbphilharmonieorchester/orchester/Yihua-Jin-Mengel,yihuajin101.html" target="_blank" class="static"><h2 class="avatar two-line" style="background-image: url(img/content/yjm.png);">Yihua Jin-Mengel<span>Violine Sergio Peresson (1985)</span></h2></a>
													<a href="https://www.ndr.de/orchester_chor/elbphilharmonieorchester/orchester/Alla-Rutter,allarutter102.html" target="_blank" class="static"><h2 class="avatar two-line" style="background-image: url(img/content/ar.png);">Alla Rutter<span>Viola (Bauer unbekannt, Mittenwald ca. 18. Jh.)</span></h2></a>
													<a href="https://www.ndr.de/orchester_chor/elbphilharmonieorchester/orchester/Phillip-Wentrup,phillipwentrup100.html" target="_blank" class="static"><h2 class="avatar two-line" style="background-image: url(img/content/pw.png);">Phillip Wentrup<span>Violoncello Carlo Antonio Testore (Mailand 1751)</span></h2></a>
													
													<hr>
													
													<p><span class="highlight">Johannes Brahms (1833–1897)</span></p>
													<p>Klavierquintett f-Moll op. 34<br>Allegro non troppo –  Andante, un poco Adagio –  Scherzo. Allegro –<br>Finale. Poco sostenuto, Allegro non troppo, Presto non troppo</p>

													<strong class="line-thru">Pause</strong>
													
													<p><span class="highlight">Juliusz Zarębski (1854–1885)</span></p>
													<p>Klavierquintett g-Moll op. 34<br>Allegro – Adagio – Scherzo. Presto – Finale. Presto</p>

													<a href="https://www.elbphilharmonie.de/de/programm/elphier-quartett-hubert-rutkowski/20742" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Abschlusskonzert am 11.10.2023</span></a>
													
													<!-- <div class="img_center">
														<img src="img/content/2022/7.png" alt="Logo">
														<p class="small_text ">Das Project "Balladen und Romanzen" wird im Rahmen des Programms "44 x Mickiewicz" furchgeführt, das seinerseits durch das Adam-Mickiewicz-Institut initiiert wurde.<br>Partner der Veranstaltung ist das National Institut für Musik und Tanz. Gefördert mit Mitteln des Ministers für Kultur und nationales Erbe.</p>
													</div> -->

                        </div><!-- /content_05-06 -->
												
												<div id="content_05-07">
													
													<h2>Meisterkurse</h2>

													<hr>
													
													<p>Studierende spielen auf historischen und modernen Flügeln</p>
													
													<hr>
												
													<span class="highlight">Samstag, 7. Oktober <?php echo $year; ?>, 10.30 Uhr </span>
													
													<a href="https://www.stefanianeonato.com/" target="_blank" class="static">
                        
														<p style="background: url(img/content/sn.png) 2px 5px no-repeat; background-size: 60px; padding-left: 80px; margin-top: 10px;">Meisterkurs auf historischen Flügeln<br>Flügel Pleyel, Paris 1847 und Hammerflügel Joseph Brodmann, Wien um 1815<br><br>Stefania Neonato, Hochschule für Musik und Darstellende Kunst Stuttgart<br><br>Museum für Kunst und Gewerbe Hamburg, Sammlung Musikinstrumente</p>
													
													</a>
													<span><strong>Eintritt frei</strong></span>
													<a href="https://www.eventbrite.de/e/meisterkurs-auf-historischen-flugeln-tickets-705287252157" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Meisterkurs 1</span></a>
													<!-- <a href="https://www.eventbrite.de/e/meisterkurs-mit-prof-joanna-awrynowicz-chopin-musikuniversitat-warschau-tickets-411232105297" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Karten 16.10.</span></a> -->
													
													<span class="highlight">Sonntag, 8. Oktober <?php echo $year; ?>, 10.00 Uhr </span><br>
													<a href="https://chopin.edu.pl/employees/82_joanna-lawrynowicz-just " target="_blank" class="static">
													
														<p style="background: url(img/content/jl2.png) 2px 5px no-repeat; background-size: 60px; padding-left: 80px; margin-top: 10px;">Meisterkurs auf modernen Flügeln<br>Flügel Shigeru Kawai, Hamamatsu 2018 <br><br>Joanna Ławrynowicz-Just, Chopin Universität für Musik Warschau
														<br><br>Hochschule für Musik und Theater Hamburg, Mendelssohn-Saal
														<br>
		
														</p>
													</a>
													<span><strong>Eintritt frei</strong></span>
													<a href="https://www.eventbrite.de/e/meisterkurs-auf-modernen-flugeln-tickets-705294684387" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Meisterkurs 2</span></a>
													
													<!-- <div class="double_button">
														<a href="https://www.eventbrite.de/e/meisterkurs-mit-prof-piotr-paleczny-chopin-musikuniversitat-warschau-tickets-411243639797" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Karten 22.10.</span></a>
														<a href="https://www.eventbrite.de/e/meisterkurs-mit-prof-piotr-paleczny-chopin-musikuniversitat-warschau-tickets-411252145237" class="button button_width button_width__left" rel="noopener noreferrer" target="_blank"><span>Karten 23.10.</span></a>
													</div> -->
                          
													<!-- <a href="https://www.betterplace.org/de/projects/80868-das-4-chopin-festival-hamburg-und-die-produktion-von-livestreams-2022?utm_campaign=donate_btn&utm_content=project%2380868&utm_medium=external_banner&utm_source=projects" class="button button_width" rel="noopener noreferrer" target="_blank"><span>Karten kaufen</span></a> -->

                        </div><!-- /content_05-07 -->
                        
                      </div><!-- /panel -->
                      
                    </div><!-- /tabs -->

									</div><!-- /single-column -->

								</div><!-- /box-inner -->

							</div><!-- /box -->

						</div><!-- /container -->

					</section><!-- /section-content_05 -->

					<div class="section-next"><a href="#content_06" class="section-slider"></a></div>

				</div><!-- /content_05 -->

				<div class="scroller-main" data-image="./img/scroller/desktop/<?php echo $year; ?>/06.jpg" data-image-mobile="./img/scroller/mobile/<?php echo $year; ?>/06.jpg" data-width="1600" data-height="900" data-extra-height="0"><!-- Image 06 --></div>

				<div id="content_06" class="content" data-tooltip="Veranstalter">

					<section id="section-content_06" class="auto-size" data-auto-size="0.6">

						<div class="container">

							<div class="box">

								<div class="box-inner inview">

									<div class="two-columns two-columns-img">

										<div class="img-main-holder">

											<img src="./img/layout/blank-large.gif" class="img-main img-content_06" alt="Eine Veranstaltung der Chopin-Gesellschaft Hamburg &amp; Sachsenwald e.V. in Kooperation mit dem Museum für Kunst und Gewerbe und der Hochschule für Musik und Theater Hamburg">

										</div><!-- /img-main-holder -->

										<!-- <p class="small_text">
										Das Projekt "Balladen und Romanzen" wird im Rahmen des Programms "44 x Mickiewicz" durchgeführt, das seinerseits durch das Adam-Mickiewicz-Institut initiiert wurde. 
Partner der Veranstaltung ist das Nationale Institut für Musik und Tanz. Gefördert mit Mitteln des Ministers für Kultur und nationales Erbe.
										</p> -->

									</div><!-- /two-columns-img -->

                  <div class="two-columns">
										
										<h1>Festival der Klaviermusik</h1>
										
										<p>Chopin-Gesellschaft Hamburg &amp; Sachsenwald e.V. in Zusammenarbeit mit der Hochschule für Musik und Theater Hamburg und mit freundlicher Unterstützung des Museum für Kunst und Gewerbe Hamburg</p>
                    
                    <p><span class="highlight">Schirmherrschaft</span></p>
                    <p>Prof. Dr. Jan Philipp Sprick, Präsident der Hochschule für Musik und Theater Hamburg</p>
										
										<p><span class="highlight">Veranstaltungsorte</span></p>
										<p>Elbphilharmonie, Platz der Deutschen Einheit 4<br>Museum für Kunst und Gewerbe Hamburg, Steintorplatz<br>Hochschule für Musik und Theater Hamburg, Harvestehuder Weg 12<br>Rittelmeyer-Saal, Heimhuder Str. 34a<br>Residenz des Generalkonsuls der Republik Polen, Maria-Louisen-Straße 137</p>
										
										<!--<p><span class="highlight">Medienpartner</span></p>
										<p>Polskie Radio</p>-->
										
										<p><span class="highlight">In Partnerschaft mit</span></p>
										<p>ORLEN Deutschland GmbH</p>
										<p>KAWAI Europa GmbH</p>
										<!-- <p>Ośrodek Badań nad Pamięcią Zbiorową i Studiów Muzealnych</p> -->
										<p><span class="highlight">Unterstützt durch das</span></p>
										<p>Generalkonsulat der Republik Polen in Hamburg</p>
										
										<hr>
										
										<a class="web-link" title="Zur Website" href="https://www.chopin-hamburg.de/" target="_blank"><span class="web-link-text">Chopin-Gesellschaft Hamburg &amp; Sachsenwald e.V.</span> <img src="./img/content/2023/zur_1.jpg" alt="Zur Website" class="web-link-img"></a>
										<a class="web-link" title="Zur Website" href="https://www.hfmt-hamburg.de/" target="_blank"><span class="web-link-text">Hochschule für Musik und Theater Hamburg</span> <img src="./img/content/2023/zur_2.jpg" alt="Zur Website" class="web-link-img"></a>
										<a class="web-link" title="Zur Website" href="http://www.mkg-hamburg.de/de/" target="_blank"><span class="web-link-text">Museum für Kunst und Gewerbe Hamburg</span> <img src="./img/content/2023/zur_3.jpg" alt="Zur Website" class="web-link-img"></a>
										<a class="web-link" title="Zur Website" href="http://www.orlen-deutschland.de/" target="_blank"><span class="web-link-text">ORLEN Deutschland GmbH</span> <img src="./img/content/2023/zur_4_1.jpg" alt="Zur Website" class="web-link-img"></a>
										<a class="web-link" title="Zur Website" href="https://www.kawai.de/" target="_blank"><span class="web-link-text">KAWAI Europa GmbH</span> <img src="./img/content/2023/zur_5.jpg" alt="Zur Website" class="web-link-img"></a>
										<a class="web-link" title="Zur Website" href="https://shigerukawai.com/" target="_blank"><span class="web-link-text">SHIGERU KAWAI</span> <img src="./img/content/2023/zur_6.jpg" alt="Zur Website" class="web-link-img"></a>
										<a class="web-link" title="Zur Website" href="https://www.gov.pl/web/deutschland/generalkonsulat-der-republik-polen-in-hamburg" target="_blank"><span class="web-link-text">Generalkonsulat der Republik Polen in Hamburg</span> <img src="./img/content/2023/zur_7.jpg" alt="Zur Website" class="web-link-img"></a>
										<!-- <a class="web-link" title="Zur Website" href="https://www.facebook.com/profile.php?id=100057497047263" target="_blank"><span class="web-link-text">Ośrodek Badań nad Pamięcią Zbiorową i Studiów Muzealnych</span> <img src="./img/content/2023/zur_8.jpg" alt="Zur Website" class="web-link-img"></a> -->



									</div><!-- /two-columns -->

								</div><!-- /box-inner -->

							</div><!-- /box -->

						</div><!-- /container -->

					</section><!-- /section-content_06 -->

					<div class="section-next"><a href="#content_07" class="section-slider"></a></div>

				</div><!-- /content_06 -->

				<div class="scroller-main" data-image="./img/scroller/desktop/<?php echo $year; ?>/07.jpg" data-image-mobile="./img/scroller/mobile/<?php echo $year; ?>/07.jpg" data-width="1600" data-height="900" data-extra-height="0"><!-- Image 07 --></div>

				<div id="content_07" class="content" data-tooltip="Veranstalter">

					<section id="section-content_07" class="ticket-section" data-auto-size="0.6">

						<div class="container">

							<div class="box">

								<div class="box-inner inview">

									<h1>Ticket für 5. Chopin Festival Hamburg kaufen</h1>
									<div class="double_button">
										<a href="https://www.eventbrite.de/o/chopin-gesellschaft-hamburg-und-sachsenwald-ev-29376013677" class="button button_width" rel="noopener noreferrer" target="_blank"><span>Karten kaufen</span></a>
										<a href="https://www.elbphilharmonie.de/de/programm/elphier-quartett-hubert-rutkowski/20742" class="button button_width" rel="noopener noreferrer" target="_blank"><span>Karten Kaufen Elbphilharmonie</span></a>
									</div>
									<hr>
									<h3>Buchen Sie jetzt Tickets für das 5. Chopin Festival Hamburg 2023<br> Book tickets for the 5th Chopin Festival Hamburg 2023 now</h3>

									<div class="w-800 mt-5 text-center">
										<p>Der Kartenvorverkauf für alle Konzerte (Einzelkarten) außer für das Abschlusskonzert* läuft ab sofort über das Online-Portal Eventbrite.</p>
										<p>Advance ticket sales (single tickets) for all concerts except for the final concert* are now open via the online portal Eventbrite.</p>

									</div>
									
									<!-- <div class="w-800 mt-5 text-start">
										<p class="text-left">Karten für das Abschlusskonzert* am 11. Oktober können über den Vorverkauf in der <a href="https://www.elbphilharmonie.de/de/programm/elphier-quartett-hubert-rutkowski/20742" target="_blank">Elbphilharmonie</a> gebucht werden.</p>
										<p class="text-left">Tickets for the final concert on October 11 are via advance booking at the <a href="https://www.elbphilharmonie.de/de/programm/elphier-quartett-hubert-rutkowski/20742" target="_blank">Elbphilharmonie</a> available.</p>
									</div> -->
									
									<p class="abstract small_text">Preise/Prices</p>

									<div class="row">
										<div class="col">
											<p class="abstract small_text text-start">Einzelkarten / single tickets:</p>
										</div>
										<div class="col">
											<p class="abstract small_text text-start">Erwachsene / adults</p>
										</div>
										<div class="col">
											<p class="abstract small_text text-start">Ermäßigt / reduced</p>
										</div>
										<!--  -->
										<div class="col">
											<p class="small_text text-start">Klavierabend am 5.10.2023</p>
										</div>
										<div class="col">
										<p class="small_text text-start">35 €</p>
											
										</div>
										<div class="col">
											<p class="small_text text-start">15€</p>										
										</div>
										<!--  -->
										<div class="col">
											<p class="small_text text-start">Klavierabend am 6.10.2023</p>											
										</div>
										<div class="col">
										<p class="small_text text-start">35 €</p>
											
										</div>
										<div class="col">
											<p class="small_text text-start">15€</p>										
										</div>
										<!--  -->
										<div class="col">
											<p class="small_text text-start">Klavierabend am 7.10.2023</p>											
										</div>
										<div class="col">
										<p class="small_text text-start">25 €</p>
											
										</div>
										<div class="col">
											<p class="small_text text-start">10€</p>
										</div>
										<!--  -->
										<div class="col">
											<p class="small_text text-start">Vortragskonzert am 9.10.2023</p>											
										</div>
										<div class="col">
										<p class="small_text text-start">Eintritt frei / Free entry</p>
											
										</div>
										<div class="col">
											<p class="small_text text-start"></p>
										</div>
										<!--  -->
										<div class="col">
											<p class="small_text text-start">Klavierabend am 10.10.2023</p>											
										</div>
										<div class="col">
										<p class="small_text text-start">35 €</p>
										
										</div>
										<div class="col">
										<p class="small_text text-start">15€</p>
										</div>
										<!--  -->
										<div class="col">
											<p class="small_text text-start">Abschlusskonzert* am 11.10.2023<br>Final Concert*</p>											
										</div>
										<div class="col">
										<p class="small_text text-start">18€ / 28€ / 38€ / 48€</p>
										
										</div>
										<div class="col">
										<p class="small_text text-start">-50% Ermäßigung für Studierende<br>-50% reduction for students</p>
										</div>
										<!--  -->
										<div class="col">
											<p class="small_text text-start">Meisterkurs am 7.10.2023</p>
										</div>
										<div class="col">
										<p class="small_text text-start">Eintritt frei / Free entry</p>
											
										</div>
										<div class="col">
										
										</div>
										<!--  -->
										<div class="col">
											<p class="small_text text-start">Meisterkurs am 8.10.2023</p>
										</div>
										<div class="col">
											<p class="small_text text-start">Eintritt frei / Free entry</p>
										</div>
										<div class="col">
										
										</div>
										<!--  -->
										<!-- <div class="col">
											<p class="small_text text-start">Vortragskonzert am 9.10.2023**</p>											
										</div>
										<div class="col-2">
										<p class="small_text text-start">„Zahl, so viel du willst und kannst“ / “Pay as much you wish and can”</p>
										
										</div> -->
										<!-- <div class="col">
										<p class="small_text text-start">15€</p>
										</div> -->
										<!--  -->
									</div>

									<div class="row mt-5">
										<div class="col-6">
											<p class="abstract small_text text-start">Abonnement** / Subscription**</p>
										</div>
										<div class="col-6">
											<p class="abstract small_text text-start">Erwachsene / adults</p>
										</div>
										<!--  -->
										<div class="col-6">
											<p class="small_text text-start">3 Konzerte</p>
										</div>
										<div class="col-6">
											<p class="small_text text-start">Rabatt / Discount 15€</p>
										</div>
										<!--  -->
										<div class="col-6">
											<p class="small_text text-start">4 Konzerte</p>
										</div>
										<div class="col-6">
											<p class="small_text text-start">Rabatt / Discount 25€</p>
										</div>
									</div>

									<div class="w-800 mt-5 text-start">
									<p class="small_text text-start">*Karten nur über den Vorverkauf in der <a href="https://www.elbphilharmonie.de/de/programm/elphier-quartett-hubert-rutkowski/20742" target="_blank">Elbphilharmonie</a> erhältlich</p>
									<p class="small_text text-start">*Tickets only available via advance booking at the <a href="https://www.elbphilharmonie.de/de/programm/elphier-quartett-hubert-rutkowski/20742" target="_blank">Elbphilharmonie</a></p>
									<p class="small_text text-start">**Das Abschlusskonzert ist im Abonnement leider nicht erhältlich</p>
									<p class="small_text text-start">**The final concert is unfortunately not available by subscription</p>

									</div>

									<div class="w-800 mt-5 text-start">
										<p class="abstract small_text">
										Bestellung von Abonnements und Karten für Vereinsmitglieder nur bei<br>Order subscriptions and tickets for association members only from
										</p>
										<p class="small_text">
											Chopin-Gesellschaft Hamburg und Sachsenwald e.V.<br>
											Kirchberg 8<br>
											D-21521 Wohltorf<br>
											Fon: +49 1573 3718515 oder +49 4104 5913<br>
											Fax:+49 4104 69 48 35<br>
											Email: karten@chopin-hamburg.de<br>
										</p>
									</div>

									<div class="w-800 mt-5 text-start">
										<p class="abstract small_text">
											Ermäßigungen (Discounts)
										</p>
										<ul>
											<li class="small_text"> Ermäßigter Preis für Schüler:innen, Studierende und Personen in Freiwilligendiensten mit gültigem Ausweis.
											<br>– Menschen mit Behinderung bezahlen den regulären Kartenpreis. Für eine Begleitperson (Vermerk B im Schwerbehindertenausweis) ist der Eintritt zu den Konzerten kostenfrei.</li>
											<li class="small_text">Reduced price for pupils, students and persons in voluntary service with valid ID.
											<br>- People with disabilities pay the regular ticket price. Admission to the concerts is free for one accompanying person (note B on the disabled person&#39;s ID).</li>
										</ul>
										
									</div>
									<div class="double_button">
										<a href="https://www.eventbrite.de/o/chopin-gesellschaft-hamburg-und-sachsenwald-ev-29376013677" class="button button_width" rel="noopener noreferrer" target="_blank"><span>Karten kaufen</span></a>
										<a href="https://www.elbphilharmonie.de/de/programm/elphier-quartett-hubert-rutkowski/20742" class="button button_width" rel="noopener noreferrer" target="_blank"><span>Karten Kaufen Elbphilharmonie</span></a>
									</div>


								</div><!-- /box-inner -->

							</div><!-- /box -->

						</div><!-- /container -->

					</section><!-- /section-content_07 -->

				</div><!-- /content_07 -->

				<section id="section-teaser" class="content teaser" data-tooltip="Karten">

					<div class="teaser-container">

						<div class="teaser-box">
            
							<div class="teaser-box-inner">

								<h1>Spenden</h1>

								<p class="abstract">betterplace.org</p>
								<p>&nbsp;</p>
								<p class="copy">Die Chopin-Gesellschaft Hamburg &amp; Sachsenwald e.V. wird auch das 5. Chopin Festival Hamburg austragen können, worüber wir sehr froh sind. Ein großes Anliegen des Festivals ist immer gewesen, dass nicht nur Erwachsene neue Klangwelten erfahren, sondern auch jungen Leuten neue Musikerfahrungen vermittelt werden. In diesem Zusammenhang arbeitet die Gesellschaft auch an einem neuen Konzertformat, zu dem wir Großeltern mit ihren EnkelInnen einladen wollen.
								<br><br>
								Wichtig ist uns, dass wir durch niedrige Eintrittspreise für Studierende, Schülerinnen und Schüler gerade auch dieser Gruppe einen zusätzlichen Anreiz bieten, die Konzerte zu besuchen und dafür neue Formate speziell für Kinder vorbereiten und ausprobieren. Um das zu verwirklichen, reichen Sponsoren- und Eintrittsgelder nicht aus. Hierfür benötigen wir zusätzliche Unterstützung, denn Könner brauchen Gönner.
								<br><br>
								Bitte beachten Sie auch, dass wir auf dem <a href="https://www.youtube.com/results?search_query=chopin+gesellschaft+hamburg+%26+sachsenwald+e.v." target="_blank">YouTube-Kanal der Chopin-Gesellschaft Hamburg &amp; Sachsenwald</a> weiterhin die meisten Konzerte der vergangenen Jahre für Sie kostenfrei zum Anschauen und -hören zur Verfügung stellen.
								<br><br>
								Wir freuen uns sehr über Ihre Spende.
								<br><br>
								The Chopin Society Hamburg &amp; Sachsenwald e.V. will also be able to host the 5th Chopin Festival Hamburg, which we are very happy about.
								A great concern of the Festival has always been that not only adults experience new worlds of sound, but that also young people are given new musical experiences. In this context, the society is also working on a new concert format to which we want to invite grandparents with their grandchildren.
								<br><br>
								It is important to us that we offer this group in particular an additional incentive to attend the concerts through low ticket prices for students and pupils, and that we prepare and try out new formats especially for children for this purpose. To realise this, sponsorship and admission fees are not enough. For this we need additional support, because “experts need patrons”.
								<br><br>
								Please also note that we will continue to make most of the concerts of the past years available for you to watch and listen to free of charge on the <a href="https://www.youtube.com/results?search_query=chopin+gesellschaft+hamburg+%26+sachsenwald+e.v." target="_blank">YouTube channel of the Chopin Society Hamburg &amp; Sachsenwald</a>.
								<br><br>
								We are very happy about your donation.
								</p>

								<a href="https://www.betterplace.org/de/projects/126287-musikvermittlung-im-rahmen-des-5-chopin-festival-hamburg-2023" class="button" rel="noopener noreferrer" target="_blank"><span>Jetzt spenden</span></a>

							</div><!-- /teaser-box-inner -->

							<div class="teaser-box-inner">

                <h1>Kontakt</h1>
                
                <p class="abstract">Chopin-Gesellschaft</p>
                <p>Hamburg &amp; Sachsenwald e.V.</p>
                <p class="copy"><br>&nbsp;<br>&nbsp;<br>Kirchberg 8<br>21521 Wohltorf<br><br>Fon: 04104 5913<br>Mobil: 01573 3718515<br>Fax: 04104 694835<br><br><br><br>Mehr Informationen unter:<br><a href="https://www.chopin-hamburg.de/" target="_blank" rel="noopener noreferrer">www.chopin-hamburg.de</a><br>&nbsp;<br>&nbsp;<br>&nbsp;<br></p>
                
                <a href="mailto:info@chopin-hamburg.de" class="button mail-button modal" data-start-section="register"><span>Kontaktformular</span></a>

							</div><!-- /teaser-box-inner -->

						</div><!-- /teaser-box -->
            
            <div class="inview"></div>

					</div><!-- /teaser-container -->

				</section><!-- /section-teaser -->

			</div><!-- /content-main -->

		</div><!-- /wrap -->

		<footer class="footer-main" role="contentinfo">

			<div class="container">

				<nav class="nav-footer">

          <ul>
            <li class="nav-item"><a href="#content_01" class="nav-link nav-link-01">Festival</a></li>
						<li class="nav-item"><a href="#content_02" class="nav-link nav-link-02">Intendant</a></li>
            <li class="nav-item"><a href="#content_04" class="nav-link nav-link-04">Künstler</a></li>
            <li class="nav-item"><a href="#content_05" class="nav-link nav-link-05">Programm</a></li>
						<li class="nav-item"><a href="#content_06" class="nav-link nav-link-06">Veranstalter</a></li>
          </ul>
    
          <ul class="small">
            <li class="nav-item"><a href="#" class="modal" data-start-section="imprint">Impressum</a></li>
            <li class="nav-item"><a href="#" class="modal" data-start-section="disclaimer">Haftungsausschluss</a></li>
						<li class="nav-item"><a href="https://www.chopin-hamburg.de/fileadmin/redaktion/downloads/presse/Pressespiegel.pdf" target="_blank">Pressespiegel</a>
						<li class="nav-item"><a href="https://www.facebook.com/chopinhamburg/" target="_blank">Das Festival bei Facebook</a></li>
          </ul>

				</nav><!-- /nav-footer -->

				<div class="box">
          
					<small class="copyright"><a title="Zur Website" href="https://www.chopin-hamburg.de/" target="_blank">&copy; <?php echo $year; ?> Chopin&ndash;Gesellschaft Hamburg &amp; Sachsenwald e.V.</a></small>
          
				</div><!-- /box -->

			</div><!-- /container -->

		</footer>
		
		<script type="text/javascript" src="./js/nlb.js"></script>
    <script type="text/javascript" src="./js/nlb.utils.js"></script>
    <script type="text/javascript" src="./js/nlb.environment.js"></script>
    <script type="text/javascript" src="./js/nlb.form.js"></script>
    <script type="text/javascript" src="./js/nlb.ui.js"></script>
    <script type="text/javascript" src="./js/nlb.user.js"></script>
    <script type="text/javascript" src="./js/nlb.contact.js"></script>
		<script type="text/javascript" src="./js/nlb.overlay.js"></script>
    <script type="text/javascript" src="./js/nlb.parallax.js"></script>
    <script type="text/javascript" src="./js/nlb.artwork.js"></script>
    <script type="text/javascript" src="./js/nlb.sidebar.js"></script>
    <script type="text/javascript" src="./js/nlb.home.js"></script>
		<script src="https://vjs.zencdn.net/6.2.7/video.js" type="text/javascript"></script>
    
    <script>
			$(document).ready(function(){
				nlb.ui.init();
				
				var isMobile=nlb.user.isMobile();
				var isMobilePage=nlb.ui.isMobilePage();
				
				if(!isMobilePage){
					//$('.da-slider').cslider();
					$(".single-column > .da-slider > div").unwrap().removeAttr("class");
					
					$(".da-slide").swipe({
						swipeLeft:function(event, direction, distance, duration, fingerCount){
							$(this).parent().find(".da-arrows-next").trigger("click");
						},
						swipeRight:function(event, direction, distance, duration, fingerCount){
							$(this).parent().find(".da-arrows-prev").trigger("click");
						}
					});
					
					nlb.sidebar.init($("#content-main"));
						
					$('.inview').bind('inview', function(event, isInView, visiblePartX, visiblePartY){
						if(isInView){
							nlb.sidebar.select($(this).parents(".content").attr("id"));
						}
					});
					
					nlb.overlay.init({
						useOverlay:true
					})
				}else{
					$("body").addClass("is-mobile-page");
					$(".single-column > .da-slider > div").unwrap().removeAttr("class");
				}
					
				if(isMobile){
					$("body").addClass("is-mobile");
				}
				
				nlb.home.init();
				
				$('.tabs').easytabs({
					updateHash:false,
					transitionIn:'slideDown',
					transitionOut:'fadeOut',
					transitionInEasing:'linear',
					transitionOutEasing:'linear'
				});
				
				(function(){
					Galleria.loadTheme('js/themes/azur/galleria.azur.min.js');
					Galleria.configure({
						autoplay: 5000,
						_locale: {
							show_captions: 'Titel einblenden',
							hide_captions: 'Titel ausblenden',
							play: 'Diashow starten',
							pause: 'Diashow anhalten',
							enter_fullscreen: 'Vollbildmodus',
							exit_fullscreen: 'Vollbildmodus beenden',
							next: 'Nächstes Bild',
							prev: 'Vorheriges Bild',
							showing_image: 'Bild %s von %s'
    				}
					});
    			Galleria.run('.galleria', {
            imageCrop: true
          });
     		}());
				
			}());
    </script>

	</body>

</html>