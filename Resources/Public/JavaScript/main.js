/**
 * Created by S3b0 on 03/09/15.
 * main.js
 */

// Equalize height of checkbox and part group selection on resize.
(function($) {
	function equalizeHeight() {
		$('#ccg-configurator-canvas .configurator-part-group-select').each(function() {
			$(this).siblings('.configurator-part-group-state').height($(this).outerHeight());
		});
	}equalizeHeight();
	$(window).resize(function() {
		equalizeHeight();
	});
})(jQuery);

// PartGroup-PartList => Popover for hint text
(function($) {
	var hintBoxSelector = '#ccg-configurator-canvas #configurator-select-part-group-part-info-hint-box';

	// Hide the Box Function
	function hideHintBox(hintBox) {
		$(hintBox).slideUp();
	}
	// Hide hint-box on click and ESC key
	$('#ccg-configurator-canvas #configurator-select-part-group-part-info-hint-box .close-popover-x, #ccg-configurator-canvas #configurator-select-part-group-part-info-hint-box, body').on('click keyup', function(e) {
		// If the keyup event is triggered
		if ( e.type == 'keyup' ) {
			if ( e.keyCode == 27 ) {
				hideHintBox(hintBoxSelector);
			}
			// If click event is triggered
		} else {
			hideHintBox(hintBoxSelector);
		}
	});
})(jQuery);

// Review/Summary Configuration Button
(function($) {
	var summaryTable = $('#ccg-configurator-canvas #configurator-summary-table');
	$('#ccg-configurator-canvas .configurator-result-review-config').on('click', function(e) {
		// Prevent default anchor action
		e.preventDefault();
		$(this).stop().toggleClass('active');
		summaryTable.stop().slideToggle('slow').toggleClass('active');

		// Scroll in position if the table is not currently hidden
		if ( summaryTable.hasClass('active') ) {
			$('html, body').stop().animate({
				scrollTop: summaryTable.offset().top
			}, 'slow');
		}
	});
})(jQuery);

(function($) {
	$('#configurator-part-group-select-index').tooltip({
		tooltipClass: "ecompc-custom-tooltip-styling",
		track: true
	});
	$('.ecompc-syntax-help').tooltip({
		tooltipClass: "ecompc-custom-tooltip-styling",
		track: true
	});
	if ( showResult === null ) {
		$('#configurator-result-canvas').hide();
		$('#configurator-select-parts-ajax-update').show();
		$('#configurator-reset-configuration-button').show();
	} else {
		$('#configurator-result-canvas').show();
		$('#configurator-select-parts-ajax-update').hide();
		$('#configurator-reset-configuration-button').hide();
	}
	$('#configurator-show-result-button').hide();
})(jQuery);

/**
 * ajax.js
 */

function addAjaxLoader(element) {
	$('#' + element).addClass('ajaxloader');
}

function removeAjaxLoader(element) {
	$('#' + element).removeClass('ajaxloader');
}

/**************************************
 *                                    *
 * AJAX request functions (re-worked) *
 *                                    *
 *************************************/

/**
 * Update part function
 */
function ccgUpdatePart() {
	$('.configurator-select-part-group-part').on('click', function (e) {
		e.preventDefault();
		if ( $(this).hasClass('disabled') ) {
			$(this).blur();
			return void(0);
		}
		addAjaxLoader('ccg-configurator-ajax-loader');
		genericAjaxRequest(t3pid, t3lang, 1441344351, 'updatePart', {
			part: $(this).attr('data-part'),
			unset: $(this).attr('data-part-state'),
			cObj: t3cobj
		}, function (result) {
			console.log(result);
/*
			var partGroupInfo = $('#configurator-partSelection-part-group-info'),
				resultDiv = $('#configurator-result-canvas');
			removeAjaxLoader('ccg-configurator-ajax-loader');
			updateProgressIndicators(result.progress);
			if ( result.currentPartGroup instanceof Object ) {
				/!* Add dependency notes *!/
				var addDN = result.currentPartGroup['dependencyNotesFluidParsedMessage'].length ? '<p>' + result.currentPartGroup.dependentNotesFluidParsedMessages + '</p>' : '';
				partGroupInfo.html(
					'<h2>' + result.currentPartGroup.title + '</h2>' +
					'<p>' + result.currentPartGroup.prompt + '</p>' + addDN
				).show();
			}
			if ( result.showResult ) {
				partGroupInfo.hide();
				$('#configurator-request').attr('href', result.requestLink);
				$('#configurator-result-canvas .ecom-configurator-result h3.ecom-configurator-result-label').first().html(result.configurationData[0]);
				$('#configurator-result-canvas .ecom-configurator-result small.ecom-configurator-result-code').first().html(getConfigurationCode(result.configurationData[1]));
				$('#configurator-summary-table').html(getConfigurationSummary(result.configurationData[2], result.pricingEnabled));
				$('.ecompc-syntax-help').tooltip({
					tooltipClass: "ecompc-custom-tooltip-styling",
					track: true
				});
				resultDiv.show();
				$('#configurator-show-result-button').hide();
				txEcompcIndex(); // Re-assign Click-function()
			} else {
				partGroupInfo.show();
				resultDiv.hide();
				if ( result.progress === 1 ) {
					$('#configurator-show-result-button').show();
				} else {
					$('#configurator-show-result-button').hide();
				}
			}
*/
/*
			updatePackageNavigation(result.packages);
			buildSelector(result);
*/
/*
			if ( result.pricingEnabled && result.pricing ) {
				$('#configurator-config-header-config-price').html(result.pricing);
			}
*/
		});
	});
}

/**
 * Generic AJAX request function
 *
 * @param pageUid
 * @param language
 * @param pageType
 * @param action
 * @param arguments
 * @param onSuccess
 */
function genericAjaxRequest(pageUid, language, pageType, action, arguments, onSuccess) {
	$.ajax({
		async: 'true',
		url: 'index.php',
		type: 'POST',
		//contentType: 'application/json; charset=utf-8',
		dataType: 'json',
		data: {
			eID: 'EcomConfigCodeGenerator',
			id: parseInt(pageUid),
			L: parseInt(language),
			type: parseInt(pageType),
			request: {
				controllerName: 'AjaxRequest',
				actionName: action,
				arguments: arguments
			}
		},
		success: onSuccess,
		error: function(jqXHR, textStatus, errorThrown) {
			console.log('Request failed with ' + textStatus + ': ' + errorThrown +  '!');
		}
	});
}

/**********************************
 * Various build helper functions *
 *********************************/

/**
 * Update progress indicators including progress bar and 'percent done' display
 * @param progress
 */
function updateProgressIndicators(progress) {
	// Update/animate progress bar
	$('#ecom-configurator-progress-value').animate({value: progress});
	// Update/animate number display(s)
	$('.ecom-configurator-progress-value-print').each(function(index, element) {
		$({countNum: $(element).text()}).animate({countNum: Math.floor(progress * 100)}, {
			duration: 800,
			easing:'linear',
			step: function() {
				$(element).text(Math.floor(this.countNum));
			},
			complete: function() {
				$(element).text(this.countNum);
			}
		});
	});
}


/**********************************************
 * Initialize Event Listeners once DOM loaded *
 *********************************************/
(function() {
	ccgUpdatePart();
	ccgIndex();
	ccgAddInfoTrigger();
})(jQuery);