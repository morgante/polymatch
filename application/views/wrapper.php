<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Canvas / Fbootstrapp by Clemens Krack, based on Bootstrap, from Twitter</title>
    <meta name="description" content="">
    <meta name="author" content="">

	<link rel="stylesheet" href="<?php echo Utils::media('bootstrap', 'css'); ?>" type="text/css" media="screen" title="FBootstrap" charset="utf-8">
	<link rel="stylesheet" href="<?php echo Utils::media('main', 'css'); ?>" type="text/css" media="screen" title="Main" charset="utf-8">

  </head>

  <body>
	
    <div class="container canvas">
	
		<?php echo $content; ?>

      <footer>
        <p>Do we need any fine print here? Maybe a link to explain the study?</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>