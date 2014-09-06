<?php




?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Mortgage Calc</title>
        <meta name="description" content="This text will appear in Google search results.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/normalize.min.css">

	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/humanity/jquery-ui.css" />
<!--
        <link rel="stylesheet" href="css/jquery-ui-1.11.0.custom/jquery-ui.min.css">


	<link href='//fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
-->
	<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="css/main.css?v=<?php echo filemtime("css/main.css");?>">
        <link rel="stylesheet" href="css/app.css?v=<?php echo filemtime("css/app.css");?>">

            
        <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>        

<!--
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
-->

        <script src="css/jquery-ui-1.11.0.custom/jquery-ui.min.js"></script>



        <?php
// Minify routine:
//rm main-ugly.js ; cat *.js | uglifyjs -nc  > main-ugly.js

			$uglytime = 0; $apptime = 0 ;
			if(file_exists("js/main-ugly.js")) {
				$uglytime = filemtime("js/main-ugly.js");
			}
			if(file_exists("js/main.js")) {
				$apptime = filemtime("js/main.js");
			}
            
            if($apptime > $uglytime) {
        ?>
			<script src="js/jquery.cookie.js"></script>
			<script src="js/jquery.formatCurrency-1.4.0.min.js"></script>
			<script src="js/plugins.js"></script>
			<script src="js/mustache.js"></script>
			<script src="js/templates.js?v=<?php echo filemtime("js/templates.js");?>"></script>
			<script src="js/main.js?v=<?php echo $apptime;?>"></script>
        <?php
            } else {
                ?><script src="js/main-ugly.js?v=<?php echo $uglytime;?>"></script><?php
            }
        ?>


            
    </head>
    <body>
 
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="header-container ui-corner-bottom">
            <header class="wrapper clearfix">
                <h1 class="title">Mortgage Calc</h1>
                <nav>
                    <ul>
                        <li><a id="AboutLink" class="dialoglink" data-target="AboutDialog" href="#">About</a></li>
                        <li><a id="HelpLink" class="dialoglink"  data-target="HelpDialog" href="#">Help</a></li>
                        <li><a id="ContactLink" class="dialoglink" data-target="ContactDialog" href="#">Contact</a></li>
                    </ul>
						<div id="AboutDialog" title="About Mortgage Calc" class="ui-helper-hidden">
						<p>This is a tutorial.</p>
						</div>

						<div id="HelpDialog" title="Help" class="ui-helper-hidden">
						<p>Fill out mortgage. See results.</p>
						</div>

						<div id="ContactDialog" title="Contact" class="ui-helper-hidden">
						<p>Email me: <a href="#">me@example.com</a></p>
						</div>
               </nav>
            </header>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">
<!--
Dynamic dialog example hidden in js.
-->
<div id="LaunchDialogButton">Launch Dialog</div>

                <article>
                    <header>
                        <h2>Loan Amount</h2>
                        <input class="money" type="money" 
							id="originalloanamount" placeholder="Starting amount" value="$100,000">
                    </header>
                    <section>
                        <h2>Interest Rate</h2>
                        <input class="percent" type="percent"
                         id="interestrate" placeholder="Interest rate"  value="5%">
                    </section>
                    <section>
                        <h3>Loan Length</h3>
                        <input class="number" min='1'  type="number" 
                        id="loanlength"  placeholder="Length in years"  value="30">
                    </section>
                    <footer>
                        <br>
                        <button id="CalculateButton">Calculate</button>
                    </footer>
                </article>

                <aside  class="ui-corner-all">
                    <h2>Results</h2>
                    <p id="results">My Results</p>
                </aside>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div class="footer-container  ui-corner-all">
            <footer class="wrapper" style="text-align:right;">
                <h3>Mortgage Calc is &copy; Dan Nagle</h3>
            </footer>
        </div>

    </body>
</html>
