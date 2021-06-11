<?php

	/*
	* PHP Formater
	* This will format some BBCode to HTML
	* Paulo Regina - 2016
	* Version: 1.5
	*/

	class BBCodeFormater
	{
		// BB Code to HTML Rules
		private $bb_code_tags = array(
			'[heading1]' => '<h1>', '[/heading1]' => '</h1>',
    		'[heading2]' => '<h2>', '[/heading2]' => '</h2>',
    		'[heading3]' => '<h3>', '[/heading3]' => '</h3>',
			'[heading4]' => '<h4>', '[/heading4]' => '</h4>',
    		'[heading5]' => '<h5>', '[/heading5]' => '</h5>',
    		'[heading6]' => '<h6>', '[/heading6]' => '</h6>',

			'[h1]' => '<h1>', '[/h1]' => '</h1>',
    		'[h2]' => '<h2>', '[/h2]' => '</h2>',
    		'[h3]' => '<h3>', '[/h3]' => '</h3>',
			'[h4]' => '<h4>', '[/h4]' => '</h4>',
    		'[h5]' => '<h5>', '[/h5]' => '</h5>',
    		'[h6]' => '<h6>', '[/h6]' => '</h6>',

			'[paragraph]' => '<p>', '[/paragraph]' => '</p>',
    		'[p]' => '<p>', '[/p]' => '</p>',

			'[left]' => '<p style="text-align:left;">', '[/left]' => '</p>',
			'[right]' => '<p style="text-align:right;">', '[/right]' => '</p>',
			'[center]' => '<p style="text-align:center;">', '[/center]' => '</p>',
			'[justify]' => '<p style="text-align:justify;">', '[/justify]' => '</p>',

			'[bold]' => '<strong>', '[/bold]' => '</strong>',
			'[b]' => '<strong>', '[/b]' => '</strong>',

			'[italic]' => '<em>', '[/italic]' => '</em>',
			'[i]' => '<em>', '[/i]' => '</em>',

			'[underline]' => '<span style="text-decoration:underline;">', '[/underline]' => '</span>',
			'[u]' => '<span style="text-decoration:underline;">','[/u]' => '</span>',

			'[unordered_list]' => '<ul>', '[/unordered_list]' => '</ul>',
   			'[list]' => '<ul>', '[/list]' => '</ul>',
    		'[ul]' => '<ul>', '[/ul]' => '</ul>',

    		'[ordered_list]' => '<ol>', '[/ordered_list]' => '</ol>',
    		'[ol]' => '<ol>', '[/ol]' => '</ol>',

    		'[item]' => '<li>', '[/item]' => '</li>',
    		'[li]' => '<li>', '[/li]' => '</li>',
			'[*]' => '<li>', '[/*]' => '</li>',

			'[code]' => '<code>', '[/code]' => '</code>',
    		'[preformatted]' => '<pre>', '[/preformatted]' => '</pre>',
    		'[pre]' => '<pre>', '[/pre]' => '</pre>',

			'[break]' => '<br>',
    		'[br]' => '<br>',
    		'[newline]' => '<br>',
    		'[nl]' => '<br>',

			// Icon Support

			// js quick extract icons from bs page
			// var buffer = '';
			//	$('.bs-glyphicons-list').find('li').find('span:eq(0)').each(function() {
			//	  buffer += "'[" + $( this ).attr('class') + "]'" + ' => ' + "'"+'<i class="' + $( this ).attr('class') + '"></i>' + "'," + "\n";
			//	});
			//	console.log(buffer);

			'[glyphicon glyphicon-asterisk]' => '<i class="glyphicon glyphicon-asterisk"></i>',
			'[glyphicon glyphicon-plus]' => '<i class="glyphicon glyphicon-plus"></i>',
			'[glyphicon glyphicon-euro]' => '<i class="glyphicon glyphicon-euro"></i>',
			'[glyphicon glyphicon-eur]' => '<i class="glyphicon glyphicon-eur"></i>',
			'[glyphicon glyphicon-minus]' => '<i class="glyphicon glyphicon-minus"></i>',
			'[glyphicon glyphicon-cloud]' => '<i class="glyphicon glyphicon-cloud"></i>',
			'[glyphicon glyphicon-envelope]' => '<i class="glyphicon glyphicon-envelope"></i>',
			'[glyphicon glyphicon-pencil]' => '<i class="glyphicon glyphicon-pencil"></i>',
			'[glyphicon glyphicon-glass]' => '<i class="glyphicon glyphicon-glass"></i>',
			'[glyphicon glyphicon-music]' => '<i class="glyphicon glyphicon-music"></i>',
			'[glyphicon glyphicon-search]' => '<i class="glyphicon glyphicon-search"></i>',
			'[glyphicon glyphicon-heart]' => '<i class="glyphicon glyphicon-heart"></i>',
			'[glyphicon glyphicon-star]' => '<i class="glyphicon glyphicon-star"></i>',
			'[glyphicon glyphicon-star-empty]' => '<i class="glyphicon glyphicon-star-empty"></i>',
			'[glyphicon glyphicon-user]' => '<i class="glyphicon glyphicon-user"></i>',
			'[glyphicon glyphicon-film]' => '<i class="glyphicon glyphicon-film"></i>',
			'[glyphicon glyphicon-th-large]' => '<i class="glyphicon glyphicon-th-large"></i>',
			'[glyphicon glyphicon-th]' => '<i class="glyphicon glyphicon-th"></i>',
			'[glyphicon glyphicon-th-list]' => '<i class="glyphicon glyphicon-th-list"></i>',
			'[glyphicon glyphicon-ok]' => '<i class="glyphicon glyphicon-ok"></i>',
			'[glyphicon glyphicon-remove]' => '<i class="glyphicon glyphicon-remove"></i>',
			'[glyphicon glyphicon-zoom-in]' => '<i class="glyphicon glyphicon-zoom-in"></i>',
			'[glyphicon glyphicon-zoom-out]' => '<i class="glyphicon glyphicon-zoom-out"></i>',
			'[glyphicon glyphicon-off]' => '<i class="glyphicon glyphicon-off"></i>',
			'[glyphicon glyphicon-signal]' => '<i class="glyphicon glyphicon-signal"></i>',
			'[glyphicon glyphicon-cog]' => '<i class="glyphicon glyphicon-cog"></i>',
			'[glyphicon glyphicon-trash]' => '<i class="glyphicon glyphicon-trash"></i>',
			'[glyphicon glyphicon-home]' => '<i class="glyphicon glyphicon-home"></i>',
			'[glyphicon glyphicon-file]' => '<i class="glyphicon glyphicon-file"></i>',
			'[glyphicon glyphicon-time]' => '<i class="glyphicon glyphicon-time"></i>',
			'[glyphicon glyphicon-road]' => '<i class="glyphicon glyphicon-road"></i>',
			'[glyphicon glyphicon-download-alt]' => '<i class="glyphicon glyphicon-download-alt"></i>',
			'[glyphicon glyphicon-download]' => '<i class="glyphicon glyphicon-download"></i>',
			'[glyphicon glyphicon-upload]' => '<i class="glyphicon glyphicon-upload"></i>',
			'[glyphicon glyphicon-inbox]' => '<i class="glyphicon glyphicon-inbox"></i>',
			'[glyphicon glyphicon-play-circle]' => '<i class="glyphicon glyphicon-play-circle"></i>',
			'[glyphicon glyphicon-repeat]' => '<i class="glyphicon glyphicon-repeat"></i>',
			'[glyphicon glyphicon-refresh]' => '<i class="glyphicon glyphicon-refresh"></i>',
			'[glyphicon glyphicon-list-alt]' => '<i class="glyphicon glyphicon-list-alt"></i>',
			'[glyphicon glyphicon-lock]' => '<i class="glyphicon glyphicon-lock"></i>',
			'[glyphicon glyphicon-flag]' => '<i class="glyphicon glyphicon-flag"></i>',
			'[glyphicon glyphicon-headphones]' => '<i class="glyphicon glyphicon-headphones"></i>',
			'[glyphicon glyphicon-volume-off]' => '<i class="glyphicon glyphicon-volume-off"></i>',
			'[glyphicon glyphicon-volume-down]' => '<i class="glyphicon glyphicon-volume-down"></i>',
			'[glyphicon glyphicon-volume-up]' => '<i class="glyphicon glyphicon-volume-up"></i>',
			'[glyphicon glyphicon-qrcode]' => '<i class="glyphicon glyphicon-qrcode"></i>',
			'[glyphicon glyphicon-barcode]' => '<i class="glyphicon glyphicon-barcode"></i>',
			'[glyphicon glyphicon-tag]' => '<i class="glyphicon glyphicon-tag"></i>',
			'[glyphicon glyphicon-tags]' => '<i class="glyphicon glyphicon-tags"></i>',
			'[glyphicon glyphicon-book]' => '<i class="glyphicon glyphicon-book"></i>',
			'[glyphicon glyphicon-bookmark]' => '<i class="glyphicon glyphicon-bookmark"></i>',
			'[glyphicon glyphicon-print]' => '<i class="glyphicon glyphicon-print"></i>',
			'[glyphicon glyphicon-camera]' => '<i class="glyphicon glyphicon-camera"></i>',
			'[glyphicon glyphicon-font]' => '<i class="glyphicon glyphicon-font"></i>',
			'[glyphicon glyphicon-bold]' => '<i class="glyphicon glyphicon-bold"></i>',
			'[glyphicon glyphicon-italic]' => '<i class="glyphicon glyphicon-italic"></i>',
			'[glyphicon glyphicon-text-height]' => '<i class="glyphicon glyphicon-text-height"></i>',
			'[glyphicon glyphicon-text-width]' => '<i class="glyphicon glyphicon-text-width"></i>',
			'[glyphicon glyphicon-align-left]' => '<i class="glyphicon glyphicon-align-left"></i>',
			'[glyphicon glyphicon-align-center]' => '<i class="glyphicon glyphicon-align-center"></i>',
			'[glyphicon glyphicon-align-right]' => '<i class="glyphicon glyphicon-align-right"></i>',
			'[glyphicon glyphicon-align-justify]' => '<i class="glyphicon glyphicon-align-justify"></i>',
			'[glyphicon glyphicon-list]' => '<i class="glyphicon glyphicon-list"></i>',
			'[glyphicon glyphicon-indent-left]' => '<i class="glyphicon glyphicon-indent-left"></i>',
			'[glyphicon glyphicon-indent-right]' => '<i class="glyphicon glyphicon-indent-right"></i>',
			'[glyphicon glyphicon-facetime-video]' => '<i class="glyphicon glyphicon-facetime-video"></i>',
			'[glyphicon glyphicon-picture]' => '<i class="glyphicon glyphicon-picture"></i>',
			'[glyphicon glyphicon-map-marker]' => '<i class="glyphicon glyphicon-map-marker"></i>',
			'[glyphicon glyphicon-adjust]' => '<i class="glyphicon glyphicon-adjust"></i>',
			'[glyphicon glyphicon-tint]' => '<i class="glyphicon glyphicon-tint"></i>',
			'[glyphicon glyphicon-edit]' => '<i class="glyphicon glyphicon-edit"></i>',
			'[glyphicon glyphicon-share]' => '<i class="glyphicon glyphicon-share"></i>',
			'[glyphicon glyphicon-check]' => '<i class="glyphicon glyphicon-check"></i>',
			'[glyphicon glyphicon-move]' => '<i class="glyphicon glyphicon-move"></i>',
			'[glyphicon glyphicon-step-backward]' => '<i class="glyphicon glyphicon-step-backward"></i>',
			'[glyphicon glyphicon-fast-backward]' => '<i class="glyphicon glyphicon-fast-backward"></i>',
			'[glyphicon glyphicon-backward]' => '<i class="glyphicon glyphicon-backward"></i>',
			'[glyphicon glyphicon-play]' => '<i class="glyphicon glyphicon-play"></i>',
			'[glyphicon glyphicon-pause]' => '<i class="glyphicon glyphicon-pause"></i>',
			'[glyphicon glyphicon-stop]' => '<i class="glyphicon glyphicon-stop"></i>',
			'[glyphicon glyphicon-forward]' => '<i class="glyphicon glyphicon-forward"></i>',
			'[glyphicon glyphicon-fast-forward]' => '<i class="glyphicon glyphicon-fast-forward"></i>',
			'[glyphicon glyphicon-step-forward]' => '<i class="glyphicon glyphicon-step-forward"></i>',
			'[glyphicon glyphicon-eject]' => '<i class="glyphicon glyphicon-eject"></i>',
			'[glyphicon glyphicon-chevron-left]' => '<i class="glyphicon glyphicon-chevron-left"></i>',
			'[glyphicon glyphicon-chevron-right]' => '<i class="glyphicon glyphicon-chevron-right"></i>',
			'[glyphicon glyphicon-plus-sign]' => '<i class="glyphicon glyphicon-plus-sign"></i>',
			'[glyphicon glyphicon-minus-sign]' => '<i class="glyphicon glyphicon-minus-sign"></i>',
			'[glyphicon glyphicon-remove-sign]' => '<i class="glyphicon glyphicon-remove-sign"></i>',
			'[glyphicon glyphicon-ok-sign]' => '<i class="glyphicon glyphicon-ok-sign"></i>',
			'[glyphicon glyphicon-question-sign]' => '<i class="glyphicon glyphicon-question-sign"></i>',
			'[glyphicon glyphicon-info-sign]' => '<i class="glyphicon glyphicon-info-sign"></i>',
			'[glyphicon glyphicon-screenshot]' => '<i class="glyphicon glyphicon-screenshot"></i>',
			'[glyphicon glyphicon-remove-circle]' => '<i class="glyphicon glyphicon-remove-circle"></i>',
			'[glyphicon glyphicon-ok-circle]' => '<i class="glyphicon glyphicon-ok-circle"></i>',
			'[glyphicon glyphicon-ban-circle]' => '<i class="glyphicon glyphicon-ban-circle"></i>',
			'[glyphicon glyphicon-arrow-left]' => '<i class="glyphicon glyphicon-arrow-left"></i>',
			'[glyphicon glyphicon-arrow-right]' => '<i class="glyphicon glyphicon-arrow-right"></i>',
			'[glyphicon glyphicon-arrow-up]' => '<i class="glyphicon glyphicon-arrow-up"></i>',
			'[glyphicon glyphicon-arrow-down]' => '<i class="glyphicon glyphicon-arrow-down"></i>',
			'[glyphicon glyphicon-share-alt]' => '<i class="glyphicon glyphicon-share-alt"></i>',
			'[glyphicon glyphicon-resize-full]' => '<i class="glyphicon glyphicon-resize-full"></i>',
			'[glyphicon glyphicon-resize-small]' => '<i class="glyphicon glyphicon-resize-small"></i>',
			'[glyphicon glyphicon-exclamation-sign]' => '<i class="glyphicon glyphicon-exclamation-sign"></i>',
			'[glyphicon glyphicon-gift]' => '<i class="glyphicon glyphicon-gift"></i>',
			'[glyphicon glyphicon-leaf]' => '<i class="glyphicon glyphicon-leaf"></i>',
			'[glyphicon glyphicon-fire]' => '<i class="glyphicon glyphicon-fire"></i>',
			'[glyphicon glyphicon-eye-open]' => '<i class="glyphicon glyphicon-eye-open"></i>',
			'[glyphicon glyphicon-eye-close]' => '<i class="glyphicon glyphicon-eye-close"></i>',
			'[glyphicon glyphicon-warning-sign]' => '<i class="glyphicon glyphicon-warning-sign"></i>',
			'[glyphicon glyphicon-plane]' => '<i class="glyphicon glyphicon-plane"></i>',
			'[glyphicon glyphicon-calendar]' => '<i class="glyphicon glyphicon-calendar"></i>',
			'[glyphicon glyphicon-random]' => '<i class="glyphicon glyphicon-random"></i>',
			'[glyphicon glyphicon-comment]' => '<i class="glyphicon glyphicon-comment"></i>',
			'[glyphicon glyphicon-magnet]' => '<i class="glyphicon glyphicon-magnet"></i>',
			'[glyphicon glyphicon-chevron-up]' => '<i class="glyphicon glyphicon-chevron-up"></i>',
			'[glyphicon glyphicon-chevron-down]' => '<i class="glyphicon glyphicon-chevron-down"></i>',
			'[glyphicon glyphicon-retweet]' => '<i class="glyphicon glyphicon-retweet"></i>',
			'[glyphicon glyphicon-shopping-cart]' => '<i class="glyphicon glyphicon-shopping-cart"></i>',
			'[glyphicon glyphicon-folder-close]' => '<i class="glyphicon glyphicon-folder-close"></i>',
			'[glyphicon glyphicon-folder-open]' => '<i class="glyphicon glyphicon-folder-open"></i>',
			'[glyphicon glyphicon-resize-vertical]' => '<i class="glyphicon glyphicon-resize-vertical"></i>',
			'[glyphicon glyphicon-resize-horizontal]' => '<i class="glyphicon glyphicon-resize-horizontal"></i>',
			'[glyphicon glyphicon-hdd]' => '<i class="glyphicon glyphicon-hdd"></i>',
			'[glyphicon glyphicon-bullhorn]' => '<i class="glyphicon glyphicon-bullhorn"></i>',
			'[glyphicon glyphicon-bell]' => '<i class="glyphicon glyphicon-bell"></i>',
			'[glyphicon glyphicon-certificate]' => '<i class="glyphicon glyphicon-certificate"></i>',
			'[glyphicon glyphicon-thumbs-up]' => '<i class="glyphicon glyphicon-thumbs-up"></i>',
			'[glyphicon glyphicon-thumbs-down]' => '<i class="glyphicon glyphicon-thumbs-down"></i>',
			'[glyphicon glyphicon-hand-right]' => '<i class="glyphicon glyphicon-hand-right"></i>',
			'[glyphicon glyphicon-hand-left]' => '<i class="glyphicon glyphicon-hand-left"></i>',
			'[glyphicon glyphicon-hand-up]' => '<i class="glyphicon glyphicon-hand-up"></i>',
			'[glyphicon glyphicon-hand-down]' => '<i class="glyphicon glyphicon-hand-down"></i>',
			'[glyphicon glyphicon-circle-arrow-right]' => '<i class="glyphicon glyphicon-circle-arrow-right"></i>',
			'[glyphicon glyphicon-circle-arrow-left]' => '<i class="glyphicon glyphicon-circle-arrow-left"></i>',
			'[glyphicon glyphicon-circle-arrow-up]' => '<i class="glyphicon glyphicon-circle-arrow-up"></i>',
			'[glyphicon glyphicon-circle-arrow-down]' => '<i class="glyphicon glyphicon-circle-arrow-down"></i>',
			'[glyphicon glyphicon-globe]' => '<i class="glyphicon glyphicon-globe"></i>',
			'[glyphicon glyphicon-wrench]' => '<i class="glyphicon glyphicon-wrench"></i>',
			'[glyphicon glyphicon-tasks]' => '<i class="glyphicon glyphicon-tasks"></i>',
			'[glyphicon glyphicon-filter]' => '<i class="glyphicon glyphicon-filter"></i>',
			'[glyphicon glyphicon-briefcase]' => '<i class="glyphicon glyphicon-briefcase"></i>',
			'[glyphicon glyphicon-fullscreen]' => '<i class="glyphicon glyphicon-fullscreen"></i>',
			'[glyphicon glyphicon-dashboard]' => '<i class="glyphicon glyphicon-dashboard"></i>',
			'[glyphicon glyphicon-paperclip]' => '<i class="glyphicon glyphicon-paperclip"></i>',
			'[glyphicon glyphicon-heart-empty]' => '<i class="glyphicon glyphicon-heart-empty"></i>',
			'[glyphicon glyphicon-link]' => '<i class="glyphicon glyphicon-link"></i>',
			'[glyphicon glyphicon-phone]' => '<i class="glyphicon glyphicon-phone"></i>',
			'[glyphicon glyphicon-pushpin]' => '<i class="glyphicon glyphicon-pushpin"></i>',
			'[glyphicon glyphicon-usd]' => '<i class="glyphicon glyphicon-usd"></i>',
			'[glyphicon glyphicon-gbp]' => '<i class="glyphicon glyphicon-gbp"></i>',
			'[glyphicon glyphicon-sort]' => '<i class="glyphicon glyphicon-sort"></i>',
			'[glyphicon glyphicon-sort-by-alphabet]' => '<i class="glyphicon glyphicon-sort-by-alphabet"></i>',
			'[glyphicon glyphicon-sort-by-alphabet-alt]' => '<i class="glyphicon glyphicon-sort-by-alphabet-alt"></i>',
			'[glyphicon glyphicon-sort-by-order]' => '<i class="glyphicon glyphicon-sort-by-order"></i>',
			'[glyphicon glyphicon-sort-by-order-alt]' => '<i class="glyphicon glyphicon-sort-by-order-alt"></i>',
			'[glyphicon glyphicon-sort-by-attributes]' => '<i class="glyphicon glyphicon-sort-by-attributes"></i>',
			'[glyphicon glyphicon-sort-by-attributes-alt]' => '<i class="glyphicon glyphicon-sort-by-attributes-alt"></i>',
			'[glyphicon glyphicon-unchecked]' => '<i class="glyphicon glyphicon-unchecked"></i>',
			'[glyphicon glyphicon-expand]' => '<i class="glyphicon glyphicon-expand"></i>',
			'[glyphicon glyphicon-collapse-down]' => '<i class="glyphicon glyphicon-collapse-down"></i>',
			'[glyphicon glyphicon-collapse-up]' => '<i class="glyphicon glyphicon-collapse-up"></i>',
			'[glyphicon glyphicon-log-in]' => '<i class="glyphicon glyphicon-log-in"></i>',
			'[glyphicon glyphicon-flash]' => '<i class="glyphicon glyphicon-flash"></i>',
			'[glyphicon glyphicon-log-out]' => '<i class="glyphicon glyphicon-log-out"></i>',
			'[glyphicon glyphicon-new-window]' => '<i class="glyphicon glyphicon-new-window"></i>',
			'[glyphicon glyphicon-record]' => '<i class="glyphicon glyphicon-record"></i>',
			'[glyphicon glyphicon-save]' => '<i class="glyphicon glyphicon-save"></i>',
			'[glyphicon glyphicon-open]' => '<i class="glyphicon glyphicon-open"></i>',
			'[glyphicon glyphicon-saved]' => '<i class="glyphicon glyphicon-saved"></i>',
			'[glyphicon glyphicon-import]' => '<i class="glyphicon glyphicon-import"></i>',
			'[glyphicon glyphicon-export]' => '<i class="glyphicon glyphicon-export"></i>',
			'[glyphicon glyphicon-send]' => '<i class="glyphicon glyphicon-send"></i>',
			'[glyphicon glyphicon-floppy-disk]' => '<i class="glyphicon glyphicon-floppy-disk"></i>',
			'[glyphicon glyphicon-floppy-saved]' => '<i class="glyphicon glyphicon-floppy-saved"></i>',
			'[glyphicon glyphicon-floppy-remove]' => '<i class="glyphicon glyphicon-floppy-remove"></i>',
			'[glyphicon glyphicon-floppy-save]' => '<i class="glyphicon glyphicon-floppy-save"></i>',
			'[glyphicon glyphicon-floppy-open]' => '<i class="glyphicon glyphicon-floppy-open"></i>',
			'[glyphicon glyphicon-credit-card]' => '<i class="glyphicon glyphicon-credit-card"></i>',
			'[glyphicon glyphicon-transfer]' => '<i class="glyphicon glyphicon-transfer"></i>',
			'[glyphicon glyphicon-cutlery]' => '<i class="glyphicon glyphicon-cutlery"></i>',
			'[glyphicon glyphicon-header]' => '<i class="glyphicon glyphicon-header"></i>',
			'[glyphicon glyphicon-compressed]' => '<i class="glyphicon glyphicon-compressed"></i>',
			'[glyphicon glyphicon-earphone]' => '<i class="glyphicon glyphicon-earphone"></i>',
			'[glyphicon glyphicon-phone-alt]' => '<i class="glyphicon glyphicon-phone-alt"></i>',
			'[glyphicon glyphicon-tower]' => '<i class="glyphicon glyphicon-tower"></i>',
			'[glyphicon glyphicon-stats]' => '<i class="glyphicon glyphicon-stats"></i>',
			'[glyphicon glyphicon-sd-video]' => '<i class="glyphicon glyphicon-sd-video"></i>',
			'[glyphicon glyphicon-hd-video]' => '<i class="glyphicon glyphicon-hd-video"></i>',
			'[glyphicon glyphicon-subtitles]' => '<i class="glyphicon glyphicon-subtitles"></i>',
			'[glyphicon glyphicon-sound-stereo]' => '<i class="glyphicon glyphicon-sound-stereo"></i>',
			'[glyphicon glyphicon-sound-dolby]' => '<i class="glyphicon glyphicon-sound-dolby"></i>',
			'[glyphicon glyphicon-sound-5-1]' => '<i class="glyphicon glyphicon-sound-5-1"></i>',
			'[glyphicon glyphicon-sound-6-1]' => '<i class="glyphicon glyphicon-sound-6-1"></i>',
			'[glyphicon glyphicon-sound-7-1]' => '<i class="glyphicon glyphicon-sound-7-1"></i>',
			'[glyphicon glyphicon-copyright-mark]' => '<i class="glyphicon glyphicon-copyright-mark"></i>',
			'[glyphicon glyphicon-registration-mark]' => '<i class="glyphicon glyphicon-registration-mark"></i>',
			'[glyphicon glyphicon-cloud-download]' => '<i class="glyphicon glyphicon-cloud-download"></i>',
			'[glyphicon glyphicon-cloud-upload]' => '<i class="glyphicon glyphicon-cloud-upload"></i>',
			'[glyphicon glyphicon-tree-conifer]' => '<i class="glyphicon glyphicon-tree-conifer"></i>',
			'[glyphicon glyphicon-tree-deciduous]' => '<i class="glyphicon glyphicon-tree-deciduous"></i>',
			'[glyphicon glyphicon-cd]' => '<i class="glyphicon glyphicon-cd"></i>',
			'[glyphicon glyphicon-save-file]' => '<i class="glyphicon glyphicon-save-file"></i>',
			'[glyphicon glyphicon-open-file]' => '<i class="glyphicon glyphicon-open-file"></i>',
			'[glyphicon glyphicon-level-up]' => '<i class="glyphicon glyphicon-level-up"></i>',
			'[glyphicon glyphicon-copy]' => '<i class="glyphicon glyphicon-copy"></i>',
			'[glyphicon glyphicon-paste]' => '<i class="glyphicon glyphicon-paste"></i>',
			'[glyphicon glyphicon-alert]' => '<i class="glyphicon glyphicon-alert"></i>',
			'[glyphicon glyphicon-equalizer]' => '<i class="glyphicon glyphicon-equalizer"></i>',
			'[glyphicon glyphicon-king]' => '<i class="glyphicon glyphicon-king"></i>',
			'[glyphicon glyphicon-queen]' => '<i class="glyphicon glyphicon-queen"></i>',
			'[glyphicon glyphicon-pawn]' => '<i class="glyphicon glyphicon-pawn"></i>',
			'[glyphicon glyphicon-bishop]' => '<i class="glyphicon glyphicon-bishop"></i>',
			'[glyphicon glyphicon-knight]' => '<i class="glyphicon glyphicon-knight"></i>',
			'[glyphicon glyphicon-baby-formula]' => '<i class="glyphicon glyphicon-baby-formula"></i>',
			'[glyphicon glyphicon-tent]' => '<i class="glyphicon glyphicon-tent"></i>',
			'[glyphicon glyphicon-blackboard]' => '<i class="glyphicon glyphicon-blackboard"></i>',
			'[glyphicon glyphicon-bed]' => '<i class="glyphicon glyphicon-bed"></i>',
			'[glyphicon glyphicon-apple]' => '<i class="glyphicon glyphicon-apple"></i>',
			'[glyphicon glyphicon-erase]' => '<i class="glyphicon glyphicon-erase"></i>',
			'[glyphicon glyphicon-hourglass]' => '<i class="glyphicon glyphicon-hourglass"></i>',
			'[glyphicon glyphicon-lamp]' => '<i class="glyphicon glyphicon-lamp"></i>',
			'[glyphicon glyphicon-duplicate]' => '<i class="glyphicon glyphicon-duplicate"></i>',
			'[glyphicon glyphicon-piggy-bank]' => '<i class="glyphicon glyphicon-piggy-bank"></i>',
			'[glyphicon glyphicon-scissors]' => '<i class="glyphicon glyphicon-scissors"></i>',
			'[glyphicon glyphicon-bitcoin]' => '<i class="glyphicon glyphicon-bitcoin"></i>',
			'[glyphicon glyphicon-btc]' => '<i class="glyphicon glyphicon-btc"></i>',
			'[glyphicon glyphicon-xbt]' => '<i class="glyphicon glyphicon-xbt"></i>',
			'[glyphicon glyphicon-yen]' => '<i class="glyphicon glyphicon-yen"></i>',
			'[glyphicon glyphicon-jpy]' => '<i class="glyphicon glyphicon-jpy"></i>',
			'[glyphicon glyphicon-ruble]' => '<i class="glyphicon glyphicon-ruble"></i>',
			'[glyphicon glyphicon-rub]' => '<i class="glyphicon glyphicon-rub"></i>',
			'[glyphicon glyphicon-scale]' => '<i class="glyphicon glyphicon-scale"></i>',
			'[glyphicon glyphicon-ice-lolly]' => '<i class="glyphicon glyphicon-ice-lolly"></i>',
			'[glyphicon glyphicon-ice-lolly-tasted]' => '<i class="glyphicon glyphicon-ice-lolly-tasted"></i>',
			'[glyphicon glyphicon-education]' => '<i class="glyphicon glyphicon-education"></i>',
			'[glyphicon glyphicon-option-horizontal]' => '<i class="glyphicon glyphicon-option-horizontal"></i>',
			'[glyphicon glyphicon-option-vertical]' => '<i class="glyphicon glyphicon-option-vertical"></i>',
			'[glyphicon glyphicon-menu-hamburger]' => '<i class="glyphicon glyphicon-menu-hamburger"></i>',
			'[glyphicon glyphicon-modal-window]' => '<i class="glyphicon glyphicon-modal-window"></i>',
			'[glyphicon glyphicon-oil]' => '<i class="glyphicon glyphicon-oil"></i>',
			'[glyphicon glyphicon-grain]' => '<i class="glyphicon glyphicon-grain"></i>',
			'[glyphicon glyphicon-sunglasses]' => '<i class="glyphicon glyphicon-sunglasses"></i>',
			'[glyphicon glyphicon-text-size]' => '<i class="glyphicon glyphicon-text-size"></i>',
			'[glyphicon glyphicon-text-color]' => '<i class="glyphicon glyphicon-text-color"></i>',
			'[glyphicon glyphicon-text-background]' => '<i class="glyphicon glyphicon-text-background"></i>',
			'[glyphicon glyphicon-object-align-top]' => '<i class="glyphicon glyphicon-object-align-top"></i>',
			'[glyphicon glyphicon-object-align-bottom]' => '<i class="glyphicon glyphicon-object-align-bottom"></i>',
			'[glyphicon glyphicon-object-align-horizontal]' => '<i class="glyphicon glyphicon-object-align-horizontal"></i>',
			'[glyphicon glyphicon-object-align-left]' => '<i class="glyphicon glyphicon-object-align-left"></i>',
			'[glyphicon glyphicon-object-align-vertical]' => '<i class="glyphicon glyphicon-object-align-vertical"></i>',
			'[glyphicon glyphicon-object-align-right]' => '<i class="glyphicon glyphicon-object-align-right"></i>',
			'[glyphicon glyphicon-triangle-right]' => '<i class="glyphicon glyphicon-triangle-right"></i>',
			'[glyphicon glyphicon-triangle-left]' => '<i class="glyphicon glyphicon-triangle-left"></i>',
			'[glyphicon glyphicon-triangle-bottom]' => '<i class="glyphicon glyphicon-triangle-bottom"></i>',
			'[glyphicon glyphicon-triangle-top]' => '<i class="glyphicon glyphicon-triangle-top"></i>',
			'[glyphicon glyphicon-console]' => '<i class="glyphicon glyphicon-console"></i>',
			'[glyphicon glyphicon-superscript]' => '<i class="glyphicon glyphicon-superscript"></i>',
			'[glyphicon glyphicon-subscript]' => '<i class="glyphicon glyphicon-subscript"></i>',
			'[glyphicon glyphicon-menu-left]' => '<i class="glyphicon glyphicon-menu-left"></i>',
			'[glyphicon glyphicon-menu-right]' => '<i class="glyphicon glyphicon-menu-right"></i>',
			'[glyphicon glyphicon-menu-down]' => '<i class="glyphicon glyphicon-menu-down"></i>',
			'[glyphicon glyphicon-menu-up]' => '<i class="glyphicon glyphicon-menu-up"></i>',

		);

		private $advanced_bb_code_tags = array(
			"/\[url\](.*?)\[\/url\]/i" => "<a href=\"http://$1\">$1</a>",
			"/\[url=(.*?)\](.*?)\[\/url\]/i" => "<a href=\"http://$1\" title=\"$1\">$2</a>",
			"/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
			"/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
	  	);

		// Convert BB Code to HTML Code
		public function html_format($string, $justString = '')
		{
			$string = str_ireplace(array_keys($this->bb_code_tags), array_values($this->bb_code_tags), $string);

			if(stripos($string, '[/url]') == true || stripos($string, '[/img]') == true || stripos($string, '[/image]') == true)
			{
				foreach($this->advanced_bb_code_tags as $match => $replacement)
				{
					$string = preg_replace($match, $replacement, $string);
				}
			}

			if($justString)
			{
				return $string;
			} else {
				return '<p>'.$string.'</p>';
			}

		}
	}

	$formater = new BBCodeFormater();

?>
