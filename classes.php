<?
	session_start();

	set_include_path('cgi-bin');

	// System utilities
	require_once('cgi-bin/__system.php');

	// Modules importer
	require_once('cgi-bin/__module.php');
?>
<html>
	<head>
		<title>Classes</title>

		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="lib/materialize/css/materialize.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/classes.css"/>
		<link type="text/css" rel="stylesheet" href="css/system.css"/>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- Libraries import -->
		<script type="text/javascript" src="lib/jQuery/jQuery1.11.1.js"></script>

		<script type="text/javascript" src="lib/materialize/js/materialize.js"></script>

		<!--Import Google Icon Font-->
		<link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,500italic' rel='stylesheet' type='text/css'>
		<meta charset="UTF-8">

		<!-- System utility -->
		<script type="text/javascript" src="js/__systemUtility.js"></script>

		<!-- Events handler -->
		<script type="text/javascript" src="js/events/__event.js"></script>

	</head>
	<body>
		<?
			// Menu
			modHeader();
			if(!isset($_GET['id'])) {

				// Show list if is not set a specific id
				mainList(); ?>

				<!-- Button to add a requirement -->
				<a id="addClass" class="btn-floating btn-large waves-effect waves-light red modal-trigger" data-target="classesInsertion"><i class="material-icons">add</i></a> <?

				// Modal insertion window
				include_once 'cgi-bin/__moduleClassesInsertion.php';
			} else {
				if(!esiste($_GET['id'], $_GET['package'])) { ?>

					<!-- Redirect if id not exist -->
					<script>location.href = 'classes.php';</script>

				<? } else {
					$id = $_GET['id']; $package = $_GET['package'];	?>

					<!-- Current requirement id -->
					<h1 id="id"><? echo($id) ?></h1>

					<!-- Module required to update requirement's information -->
					<? include_once '__moduleClassesUpdate.php' ?>

					<div class="row">
						<?

							// Module required to perform operation on requirement's child
							include_once '__moduleClassesDerivatives.php';

							// Module required to perform operation on requirement's usecases combine
							include_once '__moduleClassesBase.php';

							// Module required to combine class with multiple relation
							include_once '__moduleClassesRelation.php'

						?>
					</div>
						<?

							// Module required to perform action on classes's attributes
							include_once '__moduleClassesAttributes.php';

							// Module required to perform update actions on classes's attributes
							include_once '__moduleClassesAttributesUpdate.php';

							// Module required to perform action on classes's method_exists(object, method_name)
							include_once '__moduleClassesMethods.php';

						?>

					<!-- Perform a delete of requirement -->
					<a id="classDelete" class="waves-effect waves-light col s12 red btn-large">Delete class</a>

				<? }
			}
		?>
	</body>
</html>
