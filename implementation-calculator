<?php
/*
 * Template Name: Implementation Calculator
 * Template Post Type: page
 */

	get_header();


	// Get Variables
	$currencyIndex = isset(($_GET['currency'])) ? $_GET['currency'] : null ;
	$numUsers      = isset(($_GET['numUsers'])) ? $_GET['numUsers'] : null ;
	$PM            = isset(($_GET['PM'])) ? $_GET['PM'] : null ;
	$EC            = isset(($_GET['EC'])) ? $_GET['EC'] : null ;
	$HR            = isset(($_GET['HR'])) ? $_GET['HR'] : null ;

	$currencyIndex = $currencyIndex > 0 ? $currencyIndex : 0; // setting index to 0 if not provided


	// Initial Slider Values
	$sliderCompany     = 1;
	$sliderPerformance = 2;
	$sliderEngagement  = 2;
	$sliderHr          = 2;
	if ($HR=='false') {$sliderHr = 0;} 	// HR Included?
	

	// Banding for Low, Medium and High staff levels
	$peopleBands = array(
		50,  // Max for Low
		500, // Max for Medium, anything above this is High
	);
	
	// Costs
	$costBands = array (
		990,
		1500,
		2590
	);
	$timeBands = array (
		4,
		6,
		8
	);
	$extraHour    = 120;
	$extraSession = 120;
	$extraHalf = 360;
	$extraFull = 600;


	
	// Which band are we in?
	if ($numUsers) {
		for ($i = 0; $i < count($peopleBands); $i++) {
			if ($numUsers <= $peopleBands[$i]) {
				$sliderCompany = $i;
				$i = 0; // Reset
				break;
			} else {
				$sliderCompany = count($peopleBands);
			}
		}
		$i = 0; // Reset
	}


	// Convert PHP values to JS for use in runtime calcs
	echo '
		<script type="text/javascript">
			var peopleBands   = '.json_encode($peopleBands).';
			var costBands     = '.json_encode($costBands).'
			var timeBands     = '.json_encode($timeBands).';
			var extraHour     = '.$extraHour.';
			var extraSession  = '.$extraSession.';
			var extraHalf     = '.$extraHalf.';
			var extraFull     = '.$extraFull.';
		</script>
	';


	// Lets go!
	while (have_posts()) :
		the_post();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header light">
		<div class="container container-large">
			<?php the_title( '<h1 class="entry-title my-3 mt-lg-2 mb-lg-0">', '</h1>' ); ?>
		</div>
	</header>
	<div class="divider-curved">
		<svg
			version="1.1"
			xmlns="http://www.w3.org/2000/svg"
			xmlns:xlink="http://www.w3.org/1999/xlink"
			x="0px" y="0px"
			viewBox="0 0 1000 50"
			preserveAspectRatio="none"
			style="
				width:100%;
				height:5vw;
			"
		>
			<path class="fill-light" d="M1000,0c0,0-204.95,49.93-500,50S0,0,0,0"/>
		</svg>

	</div>


	<div class="container">
		<div class="entry-content py-4">



			<form id="form_implementation" action="" autocomplete="off">



				<!-- Currency Selector -->
				<div class="radio-groups flags">
					<?php
						// Getting the currency information
						if(have_rows('currency_multiplier', 'options')):
							$i==0;
							while (have_rows('currency_multiplier', 'options')) : the_row();
					
								$symbol     = get_sub_field('symbol');
								$multiplier = get_sub_field('multiplier');
								$code       = get_sub_field('code');
								$flag       = get_sub_field('flag');
								$checked    = $currencyIndex == $i ? 'checked': ''; // apply the checked attribute when the index matches the currencyIndex

								echo '
								<label class="radio-group">
									<input type="radio" name="currency" value="'.$symbol.'" data-index="'.$i.'" data-code="'.$code.'" data-multiplier="'.$multiplier.'" '.$checked.'>
									<span class="radio-custom">
										<img src="'.$flag['url'].'" alt="'.$flag['alt'].'">
									</span>
									<p class="lead">'.$symbol.'</p>
								</label>
								';
								
								$i++;
							endwhile;
							endif;
					?>
				</div>
				<p class="text-center mt-1 mb-5">(All prices are in <span class="valueCurrency"></span><span class="valueCode"></span>)</p>



				<div id="calcArea">

					<div class="row">

						<div class="col-xxxl-9">
							<div class="row">
								<div class="col-md-6 col-xl-3 mb-4">
									<div class="section light">

										<div class="slider-container mb-5">
											<p class="lead">Company Size</p>
											<div class="range-container tips">
												<input type="range" min="0" max="2" value="<?php echo $sliderCompany; ?>" class="slider small" id="rangeCompany">
												<div class="value">
													<div class="text"></div>
												</div>
											</div>
										</div>

										<!-- Figures -->
										<div class="input-container">
											<label for="inpEmployees">Max Employees</label>
											<input id="inpEmployees" type="number" min="0" max="2500" disabled>
										</div>
										<div class="input-container">
											<label for="inpDepartment">Departments</label>
											<input id="inpDepartment" type="number" disabled>
										</div>
										<div class="input-container">
											<label for="inpCustomerGroups">Customer Groups</label>
											<input id="inpCustomerGroups" type="number" disabled>
										</div>
										<div class="input-container">
											<label for="inpJobRoles">Job Roles</label>
											<input id="inpJobRoles" type="number" disabled>
										</div>

									</div>
								</div>


								<div class="col-md-6 col-xl-3 mb-4">
									<div class="section light">

										<div class="slider-container mb-5">
											<p class="lead">Performance Management</p>
											<div class="range-container tips">
												<input type="range" min="0" max="3" value="<?php echo $sliderPerformance; ?>" class="slider small" id="rangePerformance">
												<div class="value">
													<div class="text"></div>
												</div>
											</div>
										</div>



										<!-- Figures -->
										<div class="input-container">
											<label for="inpTemplates">
												<div class="tooltip-anchor">
													<span class="input-name">Objective Templates</span>
													<div class="tooltip"><span>Objectives templates are default settings for the creation of smart objectives or OKRs – How many different types of objectives you want will determine how many templates you need to create.</span></div>
												</div>
											</label>
											<input id="inpTemplates" type="number" min="0">
										</div>
										<div class="input-container">
											<label for="inpCompetencies">
												<div class="tooltip-anchor">
													<span class="input-name">Competencies</span>
													<div class="tooltip"><span>Setting up competencies is important for structuring performance and the success circles. The default setup is 3 competencies (performance, development, and culture) but other companies may have more. If the customer doesn’t have any defined yet – then stick to the default 3.</span></div>
												</div>
											</label>
											<input id="inpCompetencies" type="number" min="0">
										</div>
										<div class="input-container">
											<label for="inpReviews">
												<div class="tooltip-anchor">
													<span class="input-name">Review Types</span>
													<div class="tooltip"><span>These are templates for the Reviews / meetings which you wish to hold. Examples are one2one’s, annual appraisals, personal development review, 3-month probation etc. Find out how many roughly and if they want different or the same ones for each department.</span></div>
												</div>
											</label>
											<input id="inpReviews" type="number" min="0">
										</div>
										<div class="input-container">
											<label for="inpFeedback">
												<div class="tooltip-anchor">
													<span class="input-name">Feedback Qs per Review</span>
													<div class="tooltip"><span>Each review can have one or more questions which the manager can ask the employee – these are called Feedback Questions. Roughly how many questions per review does the customer want.</span></div>
												</div>
											</label>
											<input id="inpFeedback" type="number" min="0">
										</div>

									</div>
								</div>


								<div class="col-md-6 col-xl-3 mb-4">
									<div class="section light">

										<div class="slider-container mb-5">
											<p class="lead">Engagement & Culture</p>
											<div class="range-container tips">
												<input type="range" min="0" max="3" value="<?php echo $sliderEngagement; ?>" class="slider small" id="rangeEngagement">
												<div class="value">
													<div class="text"></div>
												</div>
											</div>
										</div>

										<!-- Figures -->
										<div class="input-container">
											<label for="inpCustomFeeds">
												<div class="tooltip-anchor">
												<span class="input-name">Custom Feeds</span>
													<div class="tooltip"><span>Custom feeds are the items on the menu which can have one or more channels inside. There are up to 6 custom feeds allowed (total of up to 50 channels) – tell us how many custom feeds they want. Custom feeds are in addition to the default feed which is always enabled in the Comms & Culture module.</span></div>
												</div>
											</label>
											<input id="inpCustomFeeds" type="number" min="0">
										</div>
										<div class="input-container">
											<label for="inpAwards">
												<div class="tooltip-anchor">
													<span class="input-name">Awards</span>
													<div class="tooltip"><span>Awards can be created for both peer to peer and manager/admin to employee. Indicate how many award (templates) you wish to initially setup on the system.</span></div>
												</div>
											</label>
											<input id="inpAwards" type="number" min="0">
										</div>
										<div class="input-container">
											<label for="inpValues">
												<div class="tooltip-anchor">
												<span class="input-name">Values & Behaviours</span>
													<div class="tooltip"><span>Your values and optional behaviours will be setup and linked to your competencies. Please indicate how many values you have in your business and if you also if you have behaviours linked to these values and how many there are.</span></div>
												</div>
											</label>
											<input id="inpValues" type="number" min="0">
										</div>

									</div>
								</div>


								<div class="col-md-6 col-xl-3 mb-4">
									<div class="section light">

										<div class="slider-container mb-5">
										<p class="lead">HR Operations</p>
											<div class="range-container tips">
												<input type="range" min="0" max="3" value="<?php echo $sliderHr; ?>" class="slider small" id="rangeHr">
												<div class="value">
													<div class="text"></div>
												</div>
											</div>
										</div>

										<!-- Figures -->
										<div class="input-container">
											<label for="inpAbsencePolicies">
												<div class="tooltip-anchor">
													<span class="input-name">Absence Policies</span>
													<div class="tooltip"><span>Absence Policies define how many days holiday people can have, any carry over and other absence related items. Individual absence policies can be defined for sets of employees within your organisation, for example 9-5 Monday to Friday salaried employees, or zero hour contract employees, part time employees etc. Tell us how many of these different groups you have.</span></div>
												</div>
											</label>
											<input id="inpAbsencePolicies" type="number" min="0">
										</div>
										<div class="input-container">
											<label for="inpPatterns">
												<div class="tooltip-anchor">
													<span class="input-name">Working Patterns</span>
													<div class="tooltip"><span>A Working Pattern is linked to the absence policy and defines what constitutes holiday and what doesn’t. Based on your different working groups you will need a separate working pattern for each group – for example: 9-5 Monday to Friday people are a single working pattern linked to a single absence policy.</span></div>
												</div>
											</label>
											<input id="inpPatterns" type="number" min="0">
										</div>
										<div class="input-container">
											<label for="inpHolidays">
												<div class="tooltip-anchor">
													<span class="input-name">Company Holidays</span>
													<div class="tooltip"><span>Company holidays define the general holidays for certain employees which are usually grouped by county. Please indicate how many different countries you have which you would like to define the national holidays.</span></div>
												</div>
											</label>
											<input id="inpHolidays" type="number" min="0">
										</div>
										<div class="input-container">
											<label for="inpAbsenceTypes">
												<div class="tooltip-anchor">
													<span class="input-name">Absence Types</span>
													<div class="tooltip"><span>Absence types and sub-types define all the different types of reasons for peoples absences. Tell us how many absence types and sub-types you wish to create. For example, an Absence Type could be <strong>Covid</strong> and the Absence Sub-Types could be <strong>Covid Sickness</strong> and <strong>Covid Self-Isolation</strong></span></div>
												</div>
											</label>
											<input id="inpAbsenceTypes" type="number" min="0">
										</div>
										<div class="input-container">
											<input class="styled-checkbox" id="inpAbsenceHistory" type="checkbox" checked>
											<label for="inpAbsenceHistory">
												<div class="tooltip-anchor">
													<span class="input-name">Upload Absence History</span>
													<div class="tooltip"><span>This is a check box and if enabled indicates the customer wishes to have their employees absence history uploaded.</span></div>
												</div>
											</label>
										</div>
									</div>
								</div>

								<div class="col-12 mb-4">
									<div class="section light extras">

									<div class="row">

										<div class="col-12">
											<div class="input-container">
												<label for="extraAdmin">
													<div class="tooltip-anchor">
														Additional Admin Training Sessions
														<div class="tooltip"><span>This indicates the number of additional administrator training sessions you require, over the standard amount. Each training session is 60 minutes long over Zoom or Microsoft Teams.</span></div>
													</div>
													
												</label>
												<input id="extraAdmin" type="number" value="0" min="0">
											</div>
											<div class="input-container">
												<label for="extraManager">
													<div class="tooltip-anchor">
													Additional Manager/End User Training Sessions
														<div class="tooltip"><span>This indicates the number of additional manager and/or end user training sessions you require, over the standard amount. Each training session is 60 minutes long over Zoom or Microsoft Teams. Usually the manager training sessions will take place after the administrator training.</span></div>
													</div>
												</label>
												<input id="extraManager" type="number" value="0" min="0">
											</div>
										</div>

										<div class="col-12">
											<div class="input-container">
												<label for="servicesHalf">
													<div class="tooltip-anchor">
														Professional Services - ½ Day
														<div class="tooltip"><span>e.g. Performance Management or Competency Framework Planning, Integration configuration, Office 365 SSO/user sync setup, Microsoft Flow Configuration, Webhook integrations with Zapier, Flow or other iPaaS solutions</span></div>
													</div>
												</label>
												<input id="servicesHalf" type="number" value="0" min="0">
											</div>
											<div class="input-container">
												<label for="servicesFull">
													<div class="tooltip-anchor">
														Professional Services - Full Day
														<div class="tooltip"><span>e.g. Performance Management or Competency Framework Planning, Integration configuration, Office 365 SSO/user sync setup, Microsoft Flow Configuration, Webhook integrations with Zapier, Flow or other iPaaS solutions</span></div>
													</div>
												</label>
												<input id="servicesFull" type="number" value="0" min="0">
											</div>
										</div>

										<div class="col-12">
											<div class="input-container">
												<label for="signUp">Sign-Up Date</label>
												<input id="signUp" type="date">
											</div>
											<div class="input-container">
												<label for="goLive">Go-Live Date</label>
												<input id="goLive" type="date">
											</div>
										</div>
									</div>

									</div>
								</div>
								
							</div>
						</div>

						<div class="col-xxxl-3">
							<div class="row">
								<div class="col-12 mb-0">

									<div class="section dark results mb-4 hack-03">

										<div class="row">

											<div class="col-md-8 px-lg-5 mb-5 mb-md-0">
												<p class="lead text-center">Costs</p>
												<div class="row costs">
													<div class="col">
													<p class="mb-1">Base Package Setup</p>
													<p class="smaller">
														Includes:<br>
														<span id="levelPerformance"></span> Performance Management<br>
														<span id="levelEngagement"></span> Engagement & Culture<br>
														<span id="levelHr"></span> HR Operations<br>
														<span id="trainingAdmin">1</span>x Admin Training Session<br>
														<span id="trainingManager">2</span>x Manager Training Sessions<br>
													</p>
													</div>
													<div class="col value">
														<p><span class="valueCurrency"></span> <span id="costBase"></span></p>
													</div>
												</div>

												<p id=extraItems class="d-none">Additional Extras</p>
												<div id="extraSessionAdmin" class="costs-extras"></div>
												<div id="extraSessionManager" class="costs-extras"></div>
												<div id="extraHalf" class="costs-extras"></div>
												<div id="extraFull" class="costs-extras"></div>
												<div id="extraVarious" class="costs-extras"></div>


												<div id="totalCost">
													<div class="row costs">
														<div class="col">
															<p>Total</p>
														</div>
														<div class="col value">
															<p><span class="valueCurrency"></span> <span id="costTotal"></span></p>
														</div>
													</div>
												</div>



											</div>

											<div class="col-md-4 px-lg-5">
												<p class="lead text-center">Notes</p>
												<div id="wrongDate" class="d-none text-pink text-center">
													<p class="mb-2"><strong>!! The Go Live date is too soon !!</strong></p>
													<p>Based on the spec provided, the earliest date is <span id="correctDate"></span>. You can proceed if you want to, but be aware!</p>
												</div>

												<p class="text">Your implementation kick-off call will be scheduled for on or around <span id="kickOff"></span>.</p>
												<p class="text">Your data should be prepared for import based on templates provided before <span id="importsDate"></span>. Any delay in these being delivered will result in additional setup time costs being incurred.</p>
												<div class="btn yellow"><a href="javascript:downloadPDF()">Download PDF</a></div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>





						</div>

					<div class="gap-2"></div>



				</div>

			</form>




		</div>
	</div>

</article>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.0/jspdf.umd.min.js"></script>
<script>


	var companyValues = [
		'Low',
		'Medium',
		'High'
	]

	var moduleValues = [
		'Off',
		'Low',
		'Medium',
		'High'
	]


	var defaultValues = {
		inpEmployees: [
			50,
			500,
			2500
		],
		inpDepartment: [
			3,
			9,
			36
		],
		inpCustomerGroups: [
			3,
			6,
			12
		],
		inpJobRoles: [
			20,
			40,
			80
		],
		inpCustomFeeds: [
			1,
			3,
			5
		],
		inpAwards: [
			3,
			6,
			12
		],
		inpValues: [
			3,
			6,
			12
		],
		inpTemplates: [
			3,
			12,
			24
		],
		inpCompetencies: [
			1.2,
			3,
			6
		],
		inpReviews: [
			2,
			4,
			6
		],
		inpFeedback: [
			1.5,
			3,
			15
		],
		inpAbsencePolicies: [
			3,
			6,
			24
		],
		inpPatterns: [
			6,
			12,
			36
		],
		inpHolidays: [
			2,
			4,
			15
		],
		inpAbsenceTypes: [
			1,
			3,
			6
		],
		inpAbsenceHistory: [
			1,
			2,
			3
		]
	}

	var defaultMinutes = {
		inpEmployees: 0, // not used in the calcs
		inpDepartment: 5,
		inpCustomerGroups: 10,
		inpJobRoles: 5,
		inpCustomFeeds: 15,
		inpAwards: 5,
		inpValues: 5,
		inpTemplates: 5,
		inpCompetencies: 5,
		inpReviews: 5,
		inpFeedback: 5,
		inpAbsencePolicies: 5,
		inpPatterns: 5,
		inpHolidays: 10,
		inpAbsenceTypes: 10,
		inpAbsenceHistory: 0  // not used in the calcs
	}

	const longDate = {year: 'numeric', month: 'long', day: 'numeric' };
	var dateChange = false;


	$(document).ready(function() {

		// initialise the sliders
		$('.slider').each(function() {
			sliderUpdate($(this));
		});

		// Set the currency information
		var currencySymbol = $('input[name="currency"]:checked').val();
		var currencyCode   = $('input[name="currency"]:checked').attr('data-code');
		$('.valueCurrency').text(currencySymbol);
		$('.valueCode').text(currencyCode);

		// Run the calculate function
		calculate();

	});





	// Re-calculate whenever the form is altered or range sliders are moved
	$('#form_implementation').change(function(){
		calculate();
	});
	$(document).on('input change', '.slider', function() {
		sliderUpdate($(this));
		calculate();
	});
	$('#goLive').change(function(){
		dateChange = true;
	});





	// ---------
	// FUNCTIONS
	// ---------



	// Slider Update
	function sliderUpdate(obj) {


		// VISUALS
		value =  Math.round(obj.val() / obj.prop('max') * 100);
		if (obj.prop('max') == 2) {
			text = companyValues[obj.val()];
		} else {
			text = moduleValues[obj.val()];
		}
		// The colour of the range slider controls track is achieved using a gradient that's one colour before the thumb and a different colour after
		obj.css('background', 'linear-gradient(90deg, #0c1c4d 0%, #0c1c4d '+value+'%, #fff '+value+'%, #fff 100%)');;
		// This keeps the value box level with the slider position
		obj.siblings('.value').children().css('left', value+'%');
		obj.siblings('.value').children().text(text);


		// DATA
		// Get position of slider
		var currPosition = obj.val();
		var currId       = obj.attr('id');

		// Get slider status 
		var currText = obj.siblings('.value').find('.text').text();

		if (currText == 'Off') {
			obj.parents('.section').find('.input-container').each(function() {
				$(this).children('input').attr("disabled", true);
			});
		} else if (currText == 'Low') {
			valueIndex = 0;
			obj.parents('.section').find('.input-container').each(function() {
				$(this).children('input[type=number]').attr("disabled", true);
				$(this).children('input[type=checkbox]').attr("disabled", false);
			});
		} else if (currText == 'Medium') {
			valueIndex = 1;
			obj.parents('.section').find('.input-container').each(function() {
				$(this).children('input[type=number]').attr("disabled", true);
				$(this).children('input[type=checkbox]').attr("disabled", false);
			});
		} else if (currText == 'High') {
			valueIndex =  2;
			if (currId != 'rangeCompany') { // If not Company Size
				// Allow inputs to be edited if on High setting
				obj.parents('.section').find('.input-container').each(function() {
					$(this).children('input').attr("disabled", false);
				});
			} else {
				$('#inpEmployees').attr("disabled", false);
			}
		}

		// Resetting the Extras text area
		if (currText != 'High') {
			obj.parents('.section').find('.input-container').each(function() {
				itemId = $(this).children('input').attr('id');
				$('#cost'+itemId).remove();
			});

		}

		// Set input values
		obj.parents('.section').find('.input-container').each(function() {
			if (currText == 'Off') {
				$(this).addClass('inactive')
				$(this).children('input').val('0');
			} else {
				$(this).removeClass('inactive')
				name = $(this).children('input').attr('id');
				value = defaultValues[name][valueIndex]
				$(this).children('input').val(value);
				if (currId != 'rangeCompany') { // If not Company Size
					$(this).children('input').attr({'min':value}) // prevent user reducing qty
				};
			}
		});

	}




var costExtraVarious  = 0;



// Calculate
	function calculate() {


		var currencyMultiplier = $('input[name="currency"]:checked').attr('data-multiplier');


		// Resets
		var levelPerformance  = '';
		var levelEngagement   = '';
		var levelHr           = '';
		var timeBase          = 0;
		var timeExtras        = 0;
		var timeTotal         = 0;
		var costBase          = 0;
		var costExtraAdmin   = 0;
		var costExtraManager  = 0;
		var costHalf			    = 0;
		var costFull			    = 0;
		var extraItems        = 0;
		var costTotal         = 0;
		var trainingAdmin     = 2;
		var trainingManager   = 2;

		costExtraVarious  = 0;



		// Currency Area Text
		var currencySymbol     = $('input[name="currency"]:checked').val();
		var currencyCode       = $('input[name="currency"]:checked').attr('data-code');
		$('.valueCurrency').text(currencySymbol);
		$('.valueCode').text(currencyCode);


		// Calcs for the slider boxes
		$('.slider').each(function(i, obj) {
			var currText = $(this).siblings('.value').find('.text').text();
			
			if (currText != 'Off') {
				if (currText == 'Low')    {
					timeBase += timeBands[0] / 4;
					if (this.id == 'rangeHr') {
						costBase += costBands[0] * .25;
					} else {
						costBase += costBands[0] / 3;
					}
				} else if (currText == 'Medium') {
					timeBase += timeBands[1] / 4;
					if (this.id == 'rangeHr') {
						costBase += costBands[1] * .25;
					} else {
						costBase += costBands[1] / 3;
					}
				} else if (currText == 'High') {
					timeBase += timeBands[2] / 4;
					if (this.id == 'rangeHr') {
						costBase += costBands[2] * .25;
					} else {
						costBase += costBands[2] / 3;
					}

					if ($(this).attr('id') != 'rangeCompany') { // Not company section

						// Calc the extras if above High (cost only, ignore lead-time as instructed)
						$(this).parents('.section').find('.input-container').each(function() {

							itemId      = $(this).children('input').attr('id');
							itemName    = $(this).find('.input-name').text();
							basicValue  = defaultValues[itemId][2];
							actualValue = $(this).children('input').val();

							if (actualValue > basicValue) {
								diffValue   = actualValue - basicValue;
								itemMinutes = diffValue * defaultMinutes[itemId];
								itemCost    = Math.round(itemMinutes * (extraHour / 60) * currencyMultiplier);
								
								$('#cost'+itemId).remove();

								$('#extraVarious').append('<div id="cost'+ itemId + '" class="row costs"><div class="col"><p class="data-description">'+ itemName +' x'+ diffValue +'</p></div><div class="col value"><p class="data-value">'+ currencySymbol + ' ' + parseInt(itemCost).toLocaleString() +'</p></div></div>');
								extraItems = 1;
								costExtraVarious += itemCost;

							} else {
								$('#cost'+itemId).remove();
							}

						});



					}

				}
				if (i==1) {levelPerformance = currText + ' Volume'};
				if (i==2) {levelEngagement  = currText + ' Volume'};
				if (i==3) {levelHr          = currText + ' Volume'};
			} else {
				if (i==1) {levelPerformance = 'No'};
				if (i==2) {levelEngagement  = 'No'};
				if (i==3) {levelHr          = 'No'};
			}


		});


		// Default training sessions
		var hrLevel = $('#rangeHr').siblings('.value').find('.text').text();
		var trainingAdmin = 3;
		var trainingManager = hrLevel=='Off' ? 2 : 3;

		// Calcs for the extras section
		var extraAdmin      = parseInt($('#extraAdmin').val());
		var extraManager    = parseInt($('#extraManager').val());
		var servicesHalf    = parseInt($('#servicesHalf').val());
		var servicesFull    = parseInt($('#servicesFull').val());


		if (extraAdmin > 0) {
			costExtraAdmin = extraAdmin * extraSession  * currencyMultiplier;
			$('#extraSessionAdmin').html('<div class="row costs"><div class="col"><p class="data-description">Admin Training Sessions x'+ extraAdmin +'</p></div><div class="col value"><p class="data-value">'+ currencySymbol + ' ' + parseInt(costExtraAdmin).toLocaleString() +'</p></div></div>');
			extraItems = 1;
		} else {
			$('#extraSessionAdmin').html('')
		}

		if (extraManager > 0) {
			costExtraManager = extraManager * extraSession  * currencyMultiplier;
			$('#extraSessionManager').html('<div class="row costs"><div class="col"><p class="data-description">Manager/ End User Training Sessions x'+ extraManager +'</p></div><div class="col value"><p class="data-value">'+ currencySymbol + ' ' + parseInt(costExtraManager).toLocaleString() +'</p></div></div>');
			extraItems = 1;
		} else {
			$('#extraSessionManager').html('')
		}

		if (servicesHalf > 0) {
			costHalf = servicesHalf * extraHalf * currencyMultiplier;
			$('#extraHalf').html('<div class="row costs"><div class="col"><p class="data-description">Professional Services ½-Day x'+ servicesHalf +'</p></div><div class="col value"><p class="data-value">'+ currencySymbol + ' ' + parseInt(costHalf).toLocaleString() +'</p></div></div>');
			extraItems = 1;
		} else {
			$('#extraHalf').html('')
		}

		if (servicesFull > 0) {
			costFull = servicesFull * extraFull * currencyMultiplier;
			$('#extraFull').html('<div class="row costs"><div class="col"><p class="data-description">Professional Services Full Day x'+ servicesFull +'</p></div><div class="col value"><p class="data-value">'+ currencySymbol + ' ' + parseInt(costFull).toLocaleString() +'</p></div></div>');
			extraItems = 1;
		} else {
			$('#extraFull').html('')
		}

		costExtras = costExtraAdmin + costExtraManager +costHalf + costFull + costExtraVarious;

		if (extraItems) {
			$('#extraItems').removeClass('d-none');
		} else {
			$('#extraItems').addClass('d-none');
		}




		// Final Calcs
		costBase =  Math.round(costBase * currencyMultiplier);
		costTotal = costBase  + costExtras;

		timeTotal = Math.round((timeBase + timeExtras) * 7); // convert weeks into days


		// Dates
		if (!dateChange) {

			// Go Live date wasn't the trigger for the calc, so work forward from the sign-up date

			// Is sign-up date specified?
			if ($('#signUp').val()) {
				var signUp = new Date($('#signUp').val());
			} else {
				var signUp = new Date();
			}

			var goLive = new Date();
			goLive.setDate(signUp.getDate() + timeTotal);
			var correctDate = goLive;
			var kickOff = signUp;

			goLive = goLive.toISOString().split('T')[0]; // format to match date input control
			$('#goLive').val(goLive);
			$('#wrongDate').addClass('d-none');

		} else {

			// Go live date was the trigger for the calc, so work backwards form that to get the other dates

			var goLive = new Date($('#goLive').val());
			var signUp = new Date($('#signUp').val());

			var earliestDate = new Date(goLive);
			earliestDate.setDate(earliestDate.getDate() - timeTotal);

			// Checking if enough time has been given
			var diffDate = new Date(earliestDate) - new Date();
			var diffDate = Math.round(diffDate / (1000 * 60 * 60 * 24));
			var correctDate = new Date(goLive);
			correctDate.setDate(correctDate.getDate() - diffDate);

			if (diffDate < 0) { // not leaving enough time to implement
				$('#wrongDate').removeClass('d-none');
				signUp = new Date();
				var kickOff = signUp;
			}  else {
				$('#wrongDate').addClass('d-none');

				// re-calc the kickoff and data import dates based on looser go-live date
				var kickOff = earliestDate;

			}

		}


		// The data inports should always be completed 1 week after the kick off date
		var importsDate = new Date(kickOff);
		importsDate.setDate(importsDate.getDate() + 7);


		// Display Values
		$('#costBase').text(parseInt(costBase).toLocaleString());
		$('#costTotal').text(parseInt(costTotal).toLocaleString());
		$('#levelPerformance').text(levelPerformance);
		$('#levelEngagement').text(levelEngagement);
		$('#levelHr').text(levelHr);
		$('#trainingAdmin').text(trainingAdmin);
		$('#trainingManager').text(trainingManager);


		$('#kickOff').text(kickOff.toLocaleDateString(undefined, longDate));
		signUp = signUp.toISOString().split('T')[0]; // format to match date input control
		$('#signUp').val(signUp);
		$('#importsDate').text(importsDate.toLocaleDateString(undefined, longDate));
		$('#correctDate').text(correctDate.toLocaleDateString(undefined, longDate));

		dateChange = false; // reset


	}



	var imgLogo = 'data:image/png;base64,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'
	var doc = new jsPDF()


	function downloadPDF() {


		// Get variables
		var currencySymbol   = $('input[name="currency"]:checked').val();
		var currencyCode     = $('input[name="currency"]:checked').attr('data-code');

		var cs1              = $('#inpEmployees').val();
		var cs2              = $('#inpDepartment').val();
		var cs3              = $('#inpCustomerGroups').val();
		var cs4              = $('#inpJobRoles').val();

		var pmLevel          = $('#levelPerformance').text();
		var pm1              = $('#inpTemplates').val();
		var pm2              = $('#inpCompetencies').val();
		var pm3              = $('#inpReviews').val();
		var pm4              = $('#inpFeedback').val();

		var ecLevel          = $('#levelEngagement').text();
		var ec1              = $('#inpCustomFeeds').val();
		var ec2              = $('#inpAwards').val();
		var ec3              = $('#inpValues').val();

		var hrLevel          = $('#levelHr').text();
		var hr1              = $('#inpAbsencePolicies').val();
		var hr2              = $('#inpPatterns').val();
		var hr3              = $('#inpHolidays').val();
		var hr4              = $('#inpAbsenceTypes').val();
		var hr5              = $('#inpAbsenceHistory').prop('checked') ? 'Yes' : 'No';

		var trainingAdmin    = $('#trainingAdmin').text();
		var trainingManager  = $('#trainingManager').text();

		var costBase         = $('#costBase').text();
		var costExras        = $('#costExras').text();
		var costTotal        = $('#costTotal').text();
		
		var signUp           = new Date($('#signUp').val()); signUp = signUp.toLocaleDateString(undefined, longDate)
		var goLive           = new Date($('#goLive').val()); goLive = goLive.toLocaleDateString(undefined, longDate);
		var kickOff          = $('#kickOff').text();
		var importsDate      = $('#importsDate').text();


		// Initialise
		window.jsPDF = window.jspdf.jsPDF;
		var doc = new jsPDF();



		//////////
		// DRAW //
		//////////


		// Header
		doc.setFillColor(12, 28, 77);
		doc.setDrawColor(12, 28, 77);
		doc.rect(10, 10, 190, 25, "FD")
		doc.addImage(imgLogo, "PNG", 93, 10, 25, 25)


		// Tables
		doc.rect(10, 105, 150, 115);
		doc.rect(160, 105, 40, 115);
		
		doc.rect(10, 228, 150, 30);
		doc.rect(160, 228, 40, 30);
		
		doc.rect(10, 265, 150, 12);
		doc.rect(160, 265, 40, 12);


		// Headings
		doc.rect(10, 95, 190, 10, "FD");
		doc.rect(10, 218, 190, 10, "FD");

		// White Lines
		doc.setDrawColor(255, 255, 255);
		doc.line(160, 95, 160, 105, "S")
		doc.line(160, 218, 160, 228, "S")

		// Heading Text
		doc.setTextColor(255, 255, 255);
		doc.setFontSize(14);
		doc.text("Module Setup", 85, 102,  align="center");
		doc.text("Price", 180, 102,  align="center");
		doc.text("Additional Items", 85, 225,  align="center");
		doc.text("Price", 180, 225,  align="center");


		var currentY = 47;
		// Notes
		doc.setTextColor(20, 36, 80);
		doc.setFontSize(19);
		doc.setFont(undefined, 'bold');
		doc.text("Deployment Pricing", 105, currentY, align="center");
		doc.setFont(undefined, 'normal');

		currentY += 12;
		doc.setFontSize(11);
		doc.text("IMPORTANT DATES", 10, currentY);
		doc.text("DEPLOYMENT INFORMATION", 120, currentY);

		currentY += 5;
		doc.setFontSize(9);
		doc.text('The scheduled go-live date is ' + goLive , 10, currentY);
		doc.text('Employees Deployed (up to):', 120, currentY);
		doc.text(cs1 , 175, currentY, align="right");

		currentY += 4;
		doc.text('The kick-off call will be on or around ' + kickOff, 10, currentY);
		doc.text('Departments (up to):', 120, currentY);
		doc.text(cs2 , 175, currentY, align="right");

		currentY += 4;
		doc.text('Final data submission is required by ' + importsDate, 10, currentY);
		doc.text('Employee Groups (up to):', 120, currentY);
		doc.text(cs3 , 175, currentY, align="right");
		
		currentY += 4;
		doc.text('Job Roles (up to):', 120, currentY);
		doc.text(cs4 , 175, currentY, align="right");

		currentY += 7;
		doc.setFontSize(9);
		var textNotes = "PLEASE NOTE: All the dates in this document are based on a sign-up date of " + signUp + " and require that all your data is submitted by the date detailed above. Any delay in either of these will affect the go-live date provided. All monetary amounts are shown in "+ currencySymbol + currencyCode;
		var textNotes = doc.splitTextToSize(textNotes, 188);
		doc.text(textNotes, 10, currentY);



		var currentY = 113; // 123

		// Base Costs
		doc.setFontSize(12);
		var text01 = "All the support you need to get your data imported and live on StaffCircle for a corporate level implementation, including:";
		var text01s = doc.splitTextToSize(text01, 140);
		doc.text(text01s, 15, currentY);
		doc.text(currencySymbol + ' ' + costBase, 197, currentY, align="right");
 		currentY += 12;

		doc.setFontSize(12);
		doc.text('Performance Management', 15, currentY); currentY += 5;
		doc.setFontSize(9);
		if (pmLevel == 'No') {
			doc.text('Not Included', 20, currentY); currentY += 9;
		} else {
			doc.text('• Objective Templates up to '    + pm1, 20, currentY); currentY += 4;
			doc.text('• Competencies up to '           + pm2, 20, currentY); currentY += 4;
			doc.text('• Review Types up to '           + pm3, 20, currentY); currentY += 4;
			doc.text('• Feedback Qs per Review up to ' + pm4, 20, currentY); currentY += 9;
		}

		doc.setFontSize(10);
		doc.text('Engagement & Culture', 15, currentY); currentY += 5;
		doc.setFontSize(9);
		if (ecLevel == 'No') {
			doc.text('Not Included', 20, currentY); currentY += 9;
		} else {
			doc.text('• Custom Feeds up to '           + ec1, 20, currentY); currentY += 4;
			doc.text('• Awards up to '                 + ec2, 20, currentY); currentY += 4;
			doc.text('• Values & Behaviours up to '    + ec3, 20, currentY); currentY += 9;
		}

		doc.setFontSize(10);
		doc.text('HR Operations', 15, currentY); currentY += 5;
		doc.setFontSize(9);
		if (hrLevel == 'No') {
			doc.text('Not Included', 20, currentY); currentY += 9;
		} else {
			doc.text('• Absence Policies up to '       + hr1, 20, currentY); currentY += 4;
			doc.text('• Working Patterns up to '       + hr2, 20, currentY); currentY += 4;
			doc.text('• Company Holidays up to '       + hr3, 20, currentY); currentY += 4;
			doc.text('• Absence Types up to '          + hr4, 20, currentY); currentY += 4;
			doc.text('• Upload Absence History? '      + hr5, 20, currentY); currentY += 9;
		}

		doc.setFontSize(12);
		doc.text('Training Sessions', 15, currentY); currentY += 5;
		doc.setFontSize(9);
		doc.text('• Included Administration Training Sessions x' + trainingAdmin, 20, currentY); currentY += 4;
		doc.text('• Included Manager Training Sessions x'    + trainingManager, 20, currentY); currentY += 9;



		// Extras
		doc.setFontSize(10);
		currentY = 233;
		var extras = 0;

		if ($('#extraSessionAdmin').html().length > 0) {
			textDescription = $('#extraSessionAdmin').find('.data-description').text();
			textCost = $('#extraSessionAdmin').find('.data-value').text();
			doc.text('Additional ' + textDescription, 15, currentY);
			doc.text(textCost , 197, currentY, align="right");
			currentY += 5;
			extras = 1;
		}

		if ($('#extraSessionManager').html().length > 0) {
			textDescription = $('#extraSessionManager').find('.data-description').text();
			textCost = $('#extraSessionManager').find('.data-value').text();
			doc.text('Additional ' + textDescription, 15, currentY);
			doc.text(textCost , 197, currentY, align="right");
			currentY += 5;
			extras = 1;
		}


		if ($('#extraHalf').html().length > 0) {
			textDescription = $('#extraHalf').find('.data-description').text();
			textCost = $('#extraHalf').find('.data-value').text();
			doc.text('Additional ' + textDescription, 15, currentY);
			doc.text(textCost , 197, currentY, align="right");
			currentY += 5;
			extras = 1;
		}

		if ($('#extraFull').html().length > 0) {
			textDescription = $('#extraFull').find('.data-description').text();
			textCost = $('#extraFull').find('.data-value').text();
			doc.text('Additional ' + textDescription, 15, currentY);
			doc.text(textCost , 197, currentY, align="right");
			currentY += 5;
			extras = 1;
		}

		if (costExtraVarious > 0) {
			doc.text('Additional Module Configuration', 15, currentY);
			doc.text( currencySymbol + ' ' + parseInt(costExtraVarious).toLocaleString() , 197, currentY, align="right");
			extras = 1;
		}
		
		if (extras == 0) {
			doc.text("No Extras", 15, currentY);
			doc.text("-" , 197, currentY, align="right");
			extras = 1;
		}


		// Total
		doc.setFontSize(15);
		doc.text('Total', 15, 273);
		doc.text(currencySymbol + ' ' + costTotal, 197, 273, align="right");



		// Footer
		var d = new Date();
		currentDate = d.toLocaleString();
		doc.setFontSize(8);
		doc.text("StaffCircle Implementation Calculator - v1.1 - Created on "+ currentDate, 200, 290, align="right");

	
		// Product
		//window.open(doc.output('bloburl')); // preview for testing purposes
		doc.save('implementation-calc.pdf'); // download from browser
	
	}


</script>





<?php
	endwhile;
	get_footer();
