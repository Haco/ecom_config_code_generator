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
	$('.configurator-select-part-group-part-selector').on('click', function (e) {
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
			onSuccessFunction(result);
		});
	});
}

/**
 * Update index view only (switch between packages)
 */
function ccgIndex() {
	$('.configurator-part-group-select').on('click', function (e) {
		// Prevent default anchor action
		e.preventDefault();
		if ( ( $(this).hasClass('configurator-part-group-state-0') && $('.configurator-part-group-state-0').first().attr('id') !== $(this).attr('id')) || $(this).hasClass('configurator-locked-part-group') || $(this).hasClass('current') )
			return false;
		addAjaxLoader('ccg-configurator-ajax-loader');
		genericAjaxRequest(t3pid, t3lang, 1441344351, 'index', {
			partGroup: $(this).attr('data-ccgpg'),
			cObj: t3cobj
		}, function (result) {
			onSuccessFunction(result);
		});
	});
}

/**
 * @param part
 * @returns {boolean}
 */
function getPartInformation(part) {
	genericAjaxRequest(t3pid, t3lang, 1441344351, 'showHint', {
			part: part,
			cObj: t3cobj
		}, function(result) {
			swal({
				title: null,
				text: result,
				type: "info",
				html: true,
				confirmButtonText: "OK"
			});
		}
	);
	return false;
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

/**
 * Handle result
 * @param result
 */
function onSuccessFunction(result) {
	var resetButton1 = $('#configurator-reset-configuration-button');
	removeAjaxLoader('ccg-configurator-ajax-loader');
	updateProgressIndicator(result.progress);
	resetButton1.toggle(!result.showResultingConfiguration && result.progress > 0);
	$('#configurator-part-group-select-index').html(result.selectPartGroupsHTML);
	$('#configurator-select-parts-ajax-update').html(result.selectPartsHTML);
	if ( result.showResultingConfiguration ) {
		$('#configurator-result-canvas').show();
		$('#configurator-part-group-select-part-index').hide();
		alterPartGroupInformation('hide');
		$('#configurator-show-result-button').hide();
		$('#configurator-result-canvas .configurator-result h3.configurator-result-label').first().html(result.title);
		$('#configurator-result-canvas .configurator-result small.configurator-result-code').first().html(result.configurationCode['code']);
		$('#configurator-summary-table').html(result.configurationCode['summaryTable']);
	} else {
		$('#configurator-result-canvas').hide();
		$('#configurator-part-group-select-part-index').show();
		alterPartGroupInformation(result.currentPartGroup);
		$('#configurator-show-result-button').toggle(result.progress === 1);
		if ( result.progress === 0 ) {
			resetButton1.addClass('disabled');
		} else {
			resetButton1.removeClass('disabled');
		}
	}
	assignListeners();
}

/**********************************
 * Various build helper functions *
 *********************************/

/**
 * Alter part group information
 * @param data
 */
function alterPartGroupInformation(data) {
	var div = $('#configurator-part-group-info');
	switch (data) {
		case 'show':
			div.show();
			break;
		case 'hide':
			div.hide();
			break;
		default:
			if ( data instanceof Object ) {
				/* Add dependency notes */
				var addDN = data.dependentNotesFluidParsedMessage !== undefined ? data.dependentNotesFluidParsedMessage : '';
				div.html( '<h2>' + data.title + '</h2><p>' + data.prompt + '</p><p>' + addDN + '</p>' ).show();
			}
	}
}

/**
 * Update progress indicators including progress bar and 'percent done' display
 * @param progress
 */
function updateProgressIndicator(progress) {
	// Update/animate progress bar
	$('#configurator-progress-value').animate({value: progress});
	// Update/animate number display(s)
	$('.configurator-progress-value-print').each(function(index, element) {
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

// Popup on click
function addInfoTrigger() {
	var triggerHint = '#ccg-configurator-canvas .configurator-select-part-group-part-info';

	$(triggerHint).on('click', function(e) {
		e.preventDefault();
		getPartInformation($(this).parents('a').first().attr('data-part'));
		return false;
	})
}

/**
 * Add default listeners
 */
function assignListeners() {
	$('#configurator-part-group-select-index').tooltip({
		tooltipClass: "ecompc-custom-tooltip-styling",
		track: true
	});
	$('.syntax-help').tooltip({
		tooltipClass: "ecom-custom-tooltip-styling",
		track: true
	});
	ccgUpdatePart();
	addInfoTrigger();
	ccgIndex();
}


/**********************************************
 * Initialize Event Listeners once DOM loaded *
 *********************************************/
(function() {
	$('#configurator-result-canvas').toggle(showResult);
	$('#configurator-reset-configuration-button').toggle(!showResult);
	$('#configurator-part-group-select-part-index').toggle(!showResult);
	$('#configurator-show-result-button').hide();
	assignListeners();
})(jQuery);