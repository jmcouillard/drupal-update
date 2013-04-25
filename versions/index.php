<?php

$content  = file_get_contents("versions.json");
$json = json_decode($content);

$values = array();

foreach ($json->list as $key => $item) {
	$ex = explode(" ", $item->version);
	$values[str_replace("/html/CHANGELOG.txt", "", $item->file)] = str_replace(",", "", $ex[1]);
}

// Sort ASC
asort($values);

// Separate by major, minor
foreach ($values as $key => $item) {
	$values[$key] = explode(".", $item);
}


// Find highets for major
$highest = array();
foreach ($values as $key => $item) {
	if(!isset($highest[$item[0]]) || $highest[$item[0]] < $item[1]) $highest[$item[0]] = $item[1];
}


// print_r($highest);

?>

<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html> <!--<![endif]-->

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Drupal Versions</title>

    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>

<!-- header-wrap -->
<div id="header-wrap">
    <header>

        <hgroup>
            <h1><a href="index.html">Main</a></h1>
            <h3>Drupal Versions</h3>
        </hgroup>


    </header>
</div>

<!-- content-wrap -->
<div class="content-wrap">

    <!-- main -->
    <section id="main">

        <div class="intro-box">
           <h1>Gatorade me, bitch!</h1>

           <p class="intro">Drupal is some kind of shit when not updated. Please make all those red things become green.</p>
           
           <p class="intro">Versions are updated every 24 hours,<br/>or when update.sh script is run.</p>

			<p class="intro"><a href="http://drupal.org/project/drupal">Check out current on drupal.org...</a></p>


        </div>


<?php

$i=0;
foreach ($values as $site => $version) {
	
	if($i%3==0 && $i!=0) print '</div>';
	if($i%3==0) print '<div class="row no-bottom-margin">';
	
	$secClasses = ($i%3==1) ? "col mid" : "col";
	$vClasses = ($version[1] == $highest[$version[0]]) ? "good" : "bad";
	
?>

	
	<section class="<?= $secClasses ?>">
	    <h2 class="<?= $vClasses ?>"><?= $version[0]. "." . $version[1]  ?></h2>
	    <p><?= $site ?></p>
	</section>
            
<?php
	$i++;	
	if($i==count($values)) print '</div>';
}

?>

      </section>


</div>


</body>
</html>