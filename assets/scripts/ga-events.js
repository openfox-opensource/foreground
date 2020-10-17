(function (mw, $) {
	var ApiGaConditional = function( category, action, label ){
        label = label || null;
        if( 'undefined' !== typeof ga ){
            ga( 'send', 'event', category, action, label );
        }
    }
    function fixLink( str ){
    	return decodeURIComponent( str ).replace(/^\//,'');
    }
    function isExternalLink( that ){
    	let href = that.attr( 'href' );
    	return 0 === href.indexOf( 'http' ) && 0 !== href.indexOf(location.protocol + '//' + location.hostname);
    }
    function onCreatePage( ){
    	return $('body').is( '.page-id-0' );
    }
	function delayedClick( e, that ,callback ){
		e.GAEventAlreadyFired = true;
		if(!that.data('gaEventFired')){
			e.preventDefault();
			callback(that ,e);
			that.data('gaEventFired', true);
			var href = that.attr('href');
			setTimeout( function(){
				if( that.is('a') && 0 !== href.indexOf( '#' )){
					location.href = href;
				}
				else{
					that.trigger('click');
				}
			},200);
		}
	}
	
	//toolbar
	/*$('body').on('click','#create_toggle2', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'create_clicked', title );
		});
	}); 	

	$('body').on('click','#files_toggle', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'files_popup_open', title );
		});
	}); 

	$('body').on('click','#ca-edit', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'special_edit_clicked', title );
		});
	}); 
	$('body').on('click','#f-edit', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'source_edit_clicked', title );
		});
	}); 

	$('body').on('click','#rename_item', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'rename_page_clicked', title );
		});
	}); 

	$('body').on('click','#menu-btn-tags', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'category_page_clicked', title );
		});
	}); 

	$('body').on('click','#deletePage', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'delete_page_clicked', title );
		});
	}); 
	
	$('body').on('click','#f-purge', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'purge_page_clicked', title );
		});
	}); 

	$('body').on('click','#f-history', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'toolbar', 'history_page_clicked', title );
		});
	}); 

	
*/
	$('body').on('click','.fennec-toolbar-rename-dialog .oo-ui-buttonElement-button:first', function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle'),
				newTitle = $('.fennec-toolbar-rename-dialog .oo-ui-inputWidget-input[type=text]').val();
			ApiGaConditional(  'knowledge_items', 'rename', "Fennec rename. " + title + ' to: ' + newTitle );
		});
	}); 
	//forms
	//wait until message loaded
	// setTimeout(function(){
		
	// 	console.log("findSaveButton222",findSaveButton)
	// 	$('body').on('click', findSaveButton, function( e ){
			
	// 	}); 
	// 	//veditor upload
	// 	$('body').on('click', , function(e){
			
			
	// 		// delayedClick(e, $(this), function( that ){
	// 		// });
	// 	});

	$('body').on('click','.ve-ui-mwSaveDialog .oo-ui-buttonElement-button:contains("' +  mw.message('visualeditor-toolbar-savedialog').text() + '")', function( e ){
		delayedClick(e, $(this), function( that ){
			var action = onCreatePage() ? 'create' : 'edit';
			ApiGaConditional(  'knowledge_items', action, 'veditor' );
		});
	});

	$('body').on('click','#wpSave', function( e ){
		var action = onCreatePage() ? 'create' : 'edit',
			label = $('body').is('.action-edit') ? 'source' : 'form';
		ApiGaConditional(  'knowledge_items', action , label );
		// delayedClick(e, $(this), function( that ){
		// });
	});
	$('body').on('click','.action-delete #wpConfirmB' , function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle');
			ApiGaConditional(  'knowledge_items', 'delete'  );
		});
	});

	$('body').on('click','.mw-special-Movepage [name=wpMove]' , function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle').split('/').pop(),
				newTitle = $('[name=wpNewTitleMain]').val(),
				newTitleNs = $('[name=wpNewTitleNs]').val();
			if( newTitleNs && Number(newTitleNs) ){
				newTitleNSName = $('[name=wpNewTitleNs] option[value='+ newTitleNs + ']');
				if(newTitleNSName){
					newTitle = newTitleNSName + ':' + newTitle;
				}
			}
			ApiGaConditional(  'knowledge_items', 'rename', 'MW rename. ' + title + " To " + newTitle );
		});
	});

	$('body').on('click','#mw-upload-form :submit' , function( e ){
		let fileName = $('#wpUploadFile').val(),
			title = fileName ? fileName.val().split(/\/|\\/).pop() : '';
		console.log("wpUploadFile",fileName,title);
		delayedClick(e, $(this), function( that ){
			ApiGaConditional(  'files', 'upload_page', title  );
		});
	});


	//download
	$('body').on('click','#icon-word, #icon-pdf' , function( e ){
		delayedClick(e, $(this), function( that ){
			var title = mw.config.get('wgTitle'),
				action = that.attr( 'id' ).replace('icon-','');
			ApiGaConditional(  'engagement', 'top_bar' , action );
		});
	});
	$('body').on('click','#page-cart' , function( e ){
		delayedClick(e, $(this), function( that ){
			ApiGaConditional(  'engagement', 'top_bar' , "save_item" );
		});
	});		
	$('body').on('click','a#ca-unwatch' , function( e ){
		delayedClick(e, $(this), function( that ){
			ApiGaConditional(  'engagement', 'top_bar' , "watch_item" );
		});
	});	
	$('body').on('click','#read-it' , function( e ){
		delayedClick(e, $(this), function( that ){
			ApiGaConditional(  'engagement', 'top_bar' , "read_item" );
		});
	});
	$('body').on('click','#share-it' , function( e ){
		delayedClick(e, $(this), function( that ){
			ApiGaConditional(  'engagement', 'top_bar' , "share_item" );
		});
	});

	//search
	var onSearchKeyDown;
	$( '#searchInput' ).on('keydown', function(){
		var that = $(this);
		clearTimeout( onSearchKeyDown );
		onSearchKeyDown = setTimeout( function(){
			var searchStr = that.val();
			if( searchStr ){
				ApiGaConditional(  'search', 'search_bar' , searchStr );
			}
		},2000);
	});
	$('body').on('click', '.suggestions a', function(e){
		delayedClick(e, $(this), function( that ){
			var page = that.attr('href').replace( '/w/index.php?search=', '');
			ApiGaConditional(  'search', 'result_clicked_autocomplete', fixLink( page ) );
		});
	});
	



	$('body').on('click', 'a', function(e){
		//this is global event so dont do it if other event binding did something
		if( e.GAEventAlreadyFired || $(this).data('gaEventFired')){
			return;
		}
		
		delayedClick(e, $(this), function( that ){
			let target = fixLink(that.attr('href'));
			if( that.closest( '#sidebar-right' ).length ){
				ApiGaConditional(  'engagement', 'side_bar', target );
			}
			else if( that.closest( '.bottom-tools, #actions-top-panel' ).length ){
				ApiGaConditional(  'engagement', 'top_bar', target );
			}
			else if( 0 === that.attr('href').indexOf('#')  ){
				ApiGaConditional(  'engagement', 'anchor_link', target );
			}
			else if( isExternalLink( that ) ){

				ApiGaConditional(  'engagement', 'external_link', target );
			}
			else{
				ApiGaConditional(  'engagement', 'internal_link', target );
			}

		});
	});
	//StructuredSearch events
	document.addEventListener('StructuredSearch', function (e) { 
		ApiGaConditional(  'search', 'search_page' , e.params.search );
	}, false);
	document.addEventListener('StructuredSearchPageClicked', function (e) { 
		if( e.params.title ){
			var title = e.params.title.split(location.hostname).pop();
			if( title ){
				title = fixLink( title );				
				ApiGaConditional(  'search', 'result_clicked_list', title );

			}
		}
		
		//ApiGaConditional(  'search', 'term_searched' , e.params.search );
	}, false);
	$('.mw-special-StructuredSearch').off('click').on('click','#results a',  function(e){
		delayedClick(e, $(this), function( that ){
			var title =  fixLink( that.attr('href') );
			ApiGaConditional(  'search', 'result_clicked_list' , title );
		});
	});
	if( location.search.includes('veaction=edit') ){
		var veditorSave,
			veditorUpload,
			cycle = 0;
		setInterval(function(){
			//be sure that message loaded but do not do it for any time
			cycle++;
			if( cycle < 6 ){
				veditorSave = '.ve-ui-mwSaveDialog .oo-ui-buttonElement-button:contains("' +  mw.message('visualeditor-toolbar-savedialog').text() + '")';
				veditorSave += ', .ve-ui-mwSaveDialog .oo-ui-buttonElement-button:contains("' +  mw.message('savechanges').text() + '")';
							veditorUpload = '.oo-ui-buttonElement-button:contains("' + mw.message('visualeditor-dialog-media-upload').text() + '")';
			}

			if( $(veditorSave).length && !$(veditorSave).data('ga_bound') ){
				$(veditorSave).data('ga_bound', 1)
				$(veditorSave).on('click', function(){
					var action = onCreatePage() ? 'create' : 'edit';
					ApiGaConditional( 'knowledge_items', action, 'veditor' );
				});
			}
			if( $(veditorUpload).length  && !$(veditorUpload).data('ga_bound')){
				$(veditorUpload).data('ga_bound', 1)
				$(veditorUpload).on('click', function(){
					if( $(this).closest('.oo-ui-window-content').find('label:contains("' + mw.message('upload-form-label-own-work').text() +  '"):visible')){
						ApiGaConditional(  'files', 'upload', 'visual_editor' );
					}
				});
			}
		},1500)
	}

}(mediaWiki, jQuery));
