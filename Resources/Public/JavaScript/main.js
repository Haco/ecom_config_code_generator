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
function ccgUpdatePart(preResult) {
	$('.configurator-select-part-group-part-selector').on('click', function (e) {
		e.preventDefault();
		if ( $(this).hasClass('disabled') ) {
			$(this).blur();
			return void(0);
		}
		var modal = $(this).attr('data-modal'),
			part = $(this).attr('data-part'),
			unset = $(this).attr('data-part-state');
		if ( modal > 0 && preResult.modals && unset == 0 ) {
			swal({
				title: preResult.modals[modal]['title'],
				text: preResult.modals[modal]['text'],
				type: "info",
				html: true,
				showCancelButton: true,
				confirmButtonColor: "#43AC6A",
				confirmButtonText: "Proceed »",
				cancelButtonText: "Cancel"
			},
			function( isConfirm ) {
				if ( isConfirm ) {
					ccgUpdatePartExec(part, unset);
				} else {
					$(this).blur();
					return void(0);
				}
			});
		} else {
			ccgUpdatePartExec(part, unset);
		}
	});
}

function ccgUpdatePartExec(part, unset) {
	addAjaxLoader('ccg-configurator-ajax-loader');
	genericAjaxRequest(t3pid, t3lang, 1441344351, 'updatePart', {
		part: part,
		unset: unset,
		cObj: t3cobj
	}, function (result) {
		onSuccessFunction(result);
	});
}

/**
 * Update index view only (switch between packages)
 */
function ccgIndex(target) {
	$(target).on('click', function (e) {
		// Prevent default anchor action
		e.preventDefault();
		/*if ( target === "#configurator-next-button" && $('.configurator-part-group-select[data-part-group=]').hasClass('disabled') ) {
			$(this).blur();
			return void(0);
		}*/
		if ( ( $(this).hasClass('configurator-part-group-state-0') && $('.configurator-part-group-state-0').first().attr('id') !== $(this).attr('id')) || $(this).hasClass('configurator-locked-part-group') || $(this).hasClass('current') ) {
			$(this).blur();
			return false;
		}
		addAjaxLoader('ccg-configurator-ajax-loader');
		genericAjaxRequest(t3pid, t3lang, 1441344351, 'index', {
			partGroup: $(this).attr('data-part-group'),
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
	var resetButton = $('#configurator-reset-configuration-button'),
		nextButton = $('#configurator-next-button'),
		confPrice = $('#configurator-config-header-config-price');
	removeAjaxLoader('ccg-configurator-ajax-loader');
	updateProgressIndicator(result.progress);
	resetButton.toggle(!result.showResultingConfiguration && result.progress > 0);
	$('#configurator-part-group-select-index').html(result.selectPartGroupsHTML);
	$('#configurator-select-parts-ajax-update').html(result.selectPartsHTML);
	if ( confPrice ) {
		confPrice.html(result.configurationPrice);
	}
	if ( result.showResultingConfiguration ) {
		$('#configurator-result-canvas').show();
		$('#configurator-part-group-select-part-index').hide();
		alterPartGroupInformation('hide');
		$('#configurator-show-result-button').hide();
		nextButton.hide();
		nextButton.attr('data-current', 0);
		$('#configurator-result-canvas .configurator-result h3.configurator-result-label').first().html(result.title);
		$('#configurator-result-canvas .configurator-result small.configurator-result-code').first().html(result.configurationCode['code']);
		$('#configurator-summary-table').html(result.configurationCode['summaryTable']);
	} else {
		$('#configurator-result-canvas').hide();
		$('#configurator-part-group-select-part-index').show();
		alterPartGroupInformation(result.currentPartGroup);
		$('#configurator-show-result-button').toggle(result.progress === 1 && !result.currentPartGroup['last']);
		nextButton.attr('data-part-group', result.nextPartGroup);
		nextButton.attr('data-current', result.currentPartGroup ? result.currentPartGroup['uid'] : 0);
		if ( result.currentPartGroup && $('#configurator-part-group-' + result.currentPartGroup['uid'] + '-link').hasClass('configurator-part-group-state-1') ) {
			nextButton.removeClass('disabled');
		} else {
			nextButton.addClass('disabled');
		}
		nextButton.show();
		if ( result.progress === 0 ) {
			resetButton.addClass('disabled');
		} else {
			resetButton.removeClass('disabled');
		}
	}
	assignListeners(result);
	$('#ccg-configurator-canvas').scrollTop();
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
				var addDN = data.dependentNotesFluidParsedMessages !== undefined ? data.dependentNotesFluidParsedMessages : '';
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
function assignListeners(preResult) {
	$('#configurator-part-group-select-index').tooltip({
		tooltipClass: "ecompc-custom-tooltip-styling",
		track: true
	});
	$('.syntax-help').tooltip({
		tooltipClass: "ecom-custom-tooltip-styling",
		track: true
	});
	ccgUpdatePart(preResult);
	addInfoTrigger();
	ccgIndex('.configurator-part-group-select');
}


/**********************************************
 * Initialize Event Listeners once DOM loaded *
 *********************************************/
(function() {
	$('#configurator-result-canvas').toggle(showResult);
	$('#configurator-reset-configuration-button').toggle(!showResult);
	$('#configurator-next-button').toggle(!showResult);
	$('#configurator-part-group-select-part-index').toggle(!showResult);
	$('#configurator-show-result-button').hide();
	assignListeners(preResult);
	ccgIndex('#configurator-next-button');
})(jQuery);