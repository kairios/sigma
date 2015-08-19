/* 
* @Author: Ophelie
* @Date:   2015-05-13 13:49:48
* @Last Modified by:   Ophelie
* @Last Modified time: 2015-08-19 15:06:21
*/

'use strict';

/**
 * API Sigma
 * @type {Object}
 */
var sigma={
	// Pour les fonctions communes à toute l'application
	common:{
		init:function(){
			this.notification.init();
		},
		// setCookie:function(cname, cvalue, exdays) {
		//     var d = new Date();
		//     d.setTime(d.getTime() + (exdays*24*60*60*1000));
		//     var expires = "expires="+d.toUTCString();
		//     document.cookie = cname + "=" + cvalue + "; " + expires;
		// },
		// getCookie:function(cname) {
		//     var name = cname + "=";
		//     var ca = document.cookie.split(';');
		//     for(var i=0; i<ca.length; i++) {
		//         var c = ca[i];
		//         while (c.charAt(0)==' ') c = c.substring(1);
		//         if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
		//     }
		//     return "";
		// },
		gererMinimalizeNavigation:function()
		{
			if(getCookie("minimalize")=="")
			{
                setCookie("minimalize","false",1);
			}
            else if(getCookie("minimalize")=="true")
            { 
            	$("body").addClass("mini-navbar"); 
            }
            else
            { 
            	$("body").removeClass("mini-navbar"); 
            }

            $('.navbar-minimalize').click(function (){
                if(getCookie("minimalize")=="true")
                { 
                	setCookie("minimalize","false",1); 
                }
                else
                { 
                	setCookie("minimalize","true",1); 
                }
            });
		},
		gererPageUtilisateur:function()
		{
			/******************** Au chargement de la page, on affiche le bon onglet *************************/

			var _page = getCookie('page');
			var _onglet = getCookie('onglet');

			// Si le cookie existe et correspond au module courant,
			// on affiche l'onglet du module correspondant
			if(_page==_module)
			{
				// Si le cookie de l'onglet n'existe pas ou est incorrecte, on le réinitialise
                if(_onglet=="" || _onglet < 0) 
                {
                	sigma.common.onglet.init();
                }
                else // Si le cookie existe qu'il est correct, on affiche l'onglet
                {
                	sigma.common.onglet.setOnglet(_onglet);
                }
			}
			// Si le cookie n'existe pas ou est différent du module courant,
			// on le réinitialise et on enregistre l'onglet courant du nouveau module
			else 
			{
				setCookie('page',_module,1);
				sigma.common.onglet.init();
			}

			/***************** Au changement d'un onglet ******************/

			$('#tabs li').on('click', function(){
				// On récuppère la position de l'onglet sélecionné par l'utilisateur et on le met en session
				var numOnglet = $('#tabs li').index($(this));
				setCookie('onglet',numOnglet,1);
			});
		},
		onglet:{
			init:function()
			{
				var ongletActif = $('#tabs li[class="active"]');
				var numOnglet = $('#tabs li').index(ongletActif);
                setCookie("onglet",numOnglet,1);
			},
			setOnglet:function(numOnglet)
			{
				$('#tabs li:eq('+numOnglet+') a').trigger('click');
			}
		},
		notification:{ // DÉPRÉCIÉ
			init:function()
			{
				$('.notification').hide();
			},
			alertSuccess:function(title, message){
				$('.notification .alert-success .message-title').text(title).after(' '+message);
				$('.notification .alert-success').show();
				setTimeout(function(){
					$('.notification .alert-success').hide('slow');
					$('.notification .alert-success .message-title').text('').after('');
				}, 3000);
			},
		},
	},
	// Pour la traduction du JS
	language:{
		init:function(){
			//appel ajax
			// language=retour ajx sous format json et langue utilisateur

			langage.all = "All";
			sigma.controller.init();
		},
		error:function(code){
			alert( language.code );
		}
	},
	// Pour les actions spécifiques
	controller:{
		init:function(){

			// Gestion de l'affichage de la barre de navigation   
			sigma.common.gererMinimalizeNavigation();

		    // Gestion des scripts spécifiques aux routes
			switch(_module)
			{
				case 'application':
					this.application.init();
				break;
				case 'client':
					this.client.init();
				break;
				case 'fournisseur':
					this.fournisseur.init();
				break;
				case 'produit':
					this.produit.init();
				break;
				case 'affaire':
					this.affaire.init();
				break;
				case 'personnel':
					this.personnel.init();
				break;
				case 'fiche_heure':
					this.ficheHeure.init();
				break;
			}

			// Une fois que tout a été initialisé (écouteurs, etc, etc), on affiche l'onglet courant
			// Attention à ce que cette action soit toujours effectuée (et qu'il n'y ai pas de return false avant)
			sigma.common.gererPageUtilisateur();
		},
		application:{
			init:function(){
				switch(_action)
				{
					case 'authentification':/*
						$("body").addClass('mini-navbar').addClass('fixed-sidebar');
						$('.navbar-minimalize').unbind();*/
					break;
				}
			},
		},
		adresse:{
			init:function(){
			},
			setModalAdresse:function(numAdresse)
			{
				var url = '/formulaire-adresse-session';
				if(numAdresse)
					url+='/'+numAdresse;					

				$.ajax({
					url: url,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#adresse-modal .modal-body').html(data);
						$('#adresse-modal').modal('toggle');
						sigma.controller.adresse.setAutocompletionAdresse();

						if(_module=='fournisseur')
						{
							$('#adresse-form input[value="adresse_livraison"]').attr('disabled','disabled');
						}
						
						$('#adresse-form-submit').unbind('click');
						$('#adresse-form-submit').on('click',function(){
							sigma.controller.adresse.verifierAdresse(numAdresse);
							return false;
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						alert(error);
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#adresse-modal").html(message);
					}
				});
			},
			verifierAdresse:function(numAdresse)
			{	
				var url='/formulaire-adresse-session';
				if(numAdresse)
					url+='/'+numAdresse;

				$('#adresse-form-submit').text($('#adresse-form-submit').attr('data-loading-text'));

				$.ajax({
					url: url,
					dataType: 'json',
					data: $('#adresse-form').serialize(),
					type: 'post',
					success:function(resultats)
					{
						/* On supprime les erreurs affichées s'il y en a */
						//$('#adresse-form div[class*="has-error"]').removeClass('has-error');
						$('span').remove('.help-inline');

						if(resultats.statut==true)
						{
							/* L'adresse a été ajoutée en session, on l'ajoute maintenant au DOM */

							var span=resultats.reponse;
							var adresseSpan=$("input[value='"+resultats.uniqid+"']").parents('span');

							if(adresseSpan.length) // Si l'élément existe
							{
								adresseSpan.replaceWith(span);
							}
							else // S'il n'existe pas
							{
								$("#adresse-list").append(span);
							}
							sigma.controller.adresse.setAdresseListeners();
							$('#adresse-modal .close').trigger('click');
						}
						// Si c'est pas bon, on met à jour, le formulaire d'adresse avec les erreurs
						else
						{
							/* Ici on affiche les erreurs et les champs contenant des erreurs */

							var errors=resultats.reponse;
							$.each(errors,function(index,value){
								//$('#'+index).closest('div').addClass('has-error');
								$.each(value,function(codeError, messageError){
									$("label[for='"+index+"']").after('<span class="help-inline"> - '+messageError+'</span>');
								});
							});
							$("#adresse-form span.help-inline").css({'color':'red'});
						}
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});

				$('#adresse-form-submit').text($('#adresse-form-submit').attr('data-default-text'));
				$('#adresse-form-submit').prepend('<i class="fa fa-check"></i> ');
			},
			supprimerAdresse:function(numAdresse)
			{
				if(confirm('Vous avez cliqué sur "Supprimer l\'adresse" ?'))
				{
					if(!numAdresse)
						return;

					$.ajax({
						url: '/supprimer-adresse-session/'+numAdresse,
						dataType: 'json',
						type: 'post',
						success:function(resultats)
						{
							// Si l'adresse a bien étée supprimée de la session, on la supprime du DOM 
							if(resultats.statut==true)
							{
								var adresseSpan=$("input[value='"+resultats.uniqid+"']").parents('span');
								if(adresseSpan.length) // Si l'élément existe
								{
									adresseSpan.hide();
								}
								else // S'il n'existe pas
								{
									return;
								}
								sigma.controller.adresse.setAdresseListeners();
							}
							else
							{
								return;
							}
						},
						error:function(xml,status,message)
						{
							alert(message);
						}
					});
				}
			},
			setAutocompletionAdresse:function()
			{
				$('#code_postal, #ville').autocomplete({
					source:function(request,response)
					{
						var params = {};
						if($(this.element).attr('id')=='code_postal')
						{
							params = { codePostal:request.term,pays:'FR',maxRows:10 };
						}
						else
						{
							params = { ville:request.term,pays:'FR',maxRows:10 };
						}

						$.ajax({
							url:'/autocompletion_adresse',
							dataType:'json',
							data:params,
							type:'GET',
							success:function(data)
							{
								var suggestions = eval(data.resultat);
								response($.map(suggestions,function(item){
									return {
										label:item.codePostal + ', '+item.ville,
										value:function()
										{
											if($(this).attr('id')=='code_postal')
											{
												$('#ville').val(item.ville);
												return item.codePostal;
											}
											else
											{
												$('#code_postal').val(item.codePostal);
												return item.ville;
											}
										}
									}
								}));
							},
							error:function(xml,status,message)
							{
								alert(message);
							}
						});
					},
					select:function()
					{
						$('#pays').val('France');
					},
					minLength:3,
					delay:600
				});
			},
			setAdresseListeners:function()
			{
				$('.adresse').unbind('click');
				$('.adresse').on('click',function(e){
					var numAdresse=$(this).find('input').val();

					if($(e.target).is('i'))
					{
						sigma.controller.adresse.supprimerAdresse(numAdresse);
						return false;
					}
					else
					{
						sigma.controller.adresse.setModalAdresse(numAdresse);
						return false;
					}
				});
			}
		},
		client:{
			init:function(){

	            // Gestion des scripts spécifiques aux actions
				switch(_action)
				{
					case 'listeclient':

						// Gestion de l'onglet des interlocuteurs [En cours]
						$('#tab-interlocuteur a').one('click',function(){ // "one" au lieu de "on" pour ne pas refaire l'ajax à chaque clic sur l'onglet Interlocuteur, peut être changé selon demande du client
							sigma.controller.client.setDataTableInterlocuteur({});
						});

						// Initialisation du plugin dataTables sur la table des clients
						var clientTable = $('#table-client').dataTable({
				            'dom': '<"row"l>r<"table-responsive"t>ip',
				            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, langage.all]],
				            oLanguage: {
		                    	'sUrl': '/js/Inspinia/plugins/dataTables/datatables-'+locale+'.json'
		                	},
		                	fnInitComplete: function(){
								sigma.controller.client.setClientListeners();

								$('#table-client').unbind();
								$('#table-client').on('order.dt page.dt', function(){
									sigma.controller.client.setClientListeners();
								});
								$('select[name="table-client_length"]').on('change',function(){
									sigma.controller.client.setClientListeners();
								});
							},
						});						
						// Ceci permet de filtrer les éléments de la table client 
						// en fonction de la valeur de l'input de recherche
						$('#client-filter').keyup(function(){
							clientTable.fnFilter($(this).val());
						});

						

						/**************** Initialisation des écouteurs pour la recherche et listing client ****************/

						// Utilisation du plugin CHOSEN [FINI], pour mettre à jour les dépendances entre select-chosen

						$('.chosen-select').chosen();
						// $('.chosen-select').chosen().on('change',function(e,p){
						// 	var target = e.target;

						// 	//MAJ des dépendances de sélect
						// 	switch(target.id)
						// 	{
						// 		case 'type_segment-select':
						// 			var types = $('#type_segment-select').val();

						// 			if(types)
						// 			{
						// 				console.log(types);
						// 				sigma.controller.client.updateSegments({types:types});
						// 			}

						// 			// updateSegments ?
									
						// 			// updateProduitsFinis ?
						// 			// ========> OUI, s'il veulent combiner, ils ont qu'a sélectionner leur critère dans le même input
						// 		break;
						// 		case 'segment-select':
						// 			var segments = $('#segment-select').val();
						// 			// update produit fini ?
						// 		break;
						// 		case 'produit_fini-select':
						// 			var produits = $('#produit_fini-select').val();
						// 		break;
						// 	}
							
						// });

						// Utilisation du plugin CHOSEN [AVANT], pour recherche à chaque changement
						// $('.chosen-select-deselect').chosen({
						// 	allow_single_deselect: true
						// }).on('change',function(e,p){
						// 	sigma.controller.client.rechercheClient(e.target);
						// });
						// $(".chosen-select").chosen().on('change',function(e, p){
						// 	sigma.controller.client.rechercheClient(e.target);
						// });
						
						// // Gestion de la recherche sur les deux onglets [FINI]
						// $("input[type='search']").on('keydown', function(e){
						// 	// Si l'utilisateur appuie sur Entrée, on effectue la recherche
						// 	// [Permettre à l'utilisateur de faire la recherche s'il appuie sur le bouton de recherche (pour mobile)]
						// 	if(e.type == 'keydown' && e.which == 13)
						// 		sigma.controller.client.rechercheClient(e.target);
						// });

						$('#search-client').on('click', function(){
							sigma.controller.client.rechercherClient();
							return false;
						});

					break;
					case 'formulaireclient':
						//$('.chosen-select').chosen();
						$('#ref_type_segment').on('change',function(){
							var type = $(this).find(':selected').val();
							if(type)
							{
								$('#segments').removeAttr('disabled');
							}
							else
							{
								$('#segments').attr('disabled','disabled');
							}
							sigma.controller.client.updateSegments(type);
						});
						$('#segments').on('change',function(){
							var segments = [];
							$(this).find(':selected').each(function(){
								segments.push($(this).val());
							});
							console.log(segments);
							if(segments)
							{
								$('#produits_finis').removeAttr('disabled');
								sigma.controller.client.updateProduitsFinis(segments);
							}
						});
						sigma.controller.adresse.setAdresseListeners();
						sigma.controller.client.setInterlocuteurListenersSession();
					break;
					case 'consulterclient':
						$('#interlocuteur-details .tab-pane:first-child').addClass('active');
						$('.scrollable').slimScroll({
					        height: '140px',
					        alwaysVisible:true,
					        railOpacity: 0.4,
					        wheelStep: 10
					    });
						$('#client-delete-toggle').on('click',function(e){
							var numClient=$(this).attr('data-id');
							sigma.controller.client.setModalDeleteClient(numClient);
							return false;
						});
					break;
					case 'formulaireinterlocuteur':
						sigma.controller.client.setAutocompletionSocieteClient();
					break;
				}
			},
			rechercherClient:function() // [A TERMINER] : Intégrer les dépendances entre type_segment, segment, produit fini
			{
				var params 		= {};
				var types 		= $('#type_segment-select').val();
				var produits 	= $('#produit_fini-select').val();
				var segments 	= $('#segment-select').val();
				var motCle 		= $('#mot_cle-input').val();

				if(produits)
					params.produitsFinis = produits;
				else if(segments)
					params.segments = segments;
				else if(types)
					params.typesSegment = types;

				if(motCle)
					params.motCle = motCle;

				params.maxRows = 500;

				sigma.controller.client.setDataTableClient(params);
			},
			updateSegments:function(typesSegment) // Met à jour les options de segment-select
			{
				var params = {};

				if(typeof(typesSegment)==='string')
					params = {typeSegment:typesSegment};
				else if(typeof(typesSegment)==='object')
					params = {typesSegment:typesSegment};

				$.ajax({
					url: '/segments',
					data: params,
					type: 'get',
					dataType: 'json',
					success:function(data, status, XMLHttpRequest)
					{
						console.log(data);
						$('#segments option:not(:first-child)').remove();
						$.each(data.resultat, function(index,segment){
							$('#segments').append('<option value="'+segment.id+'">'+segment.text+'</option>');
						});
						//eval(_callback);
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$("#interlocuteurs").html(message);
					}
				});
			},
			updateProduitsFinis:function(segments) // Met à jour les options de produit_fini-select
			{
				var params = {};

				if(typeof(segments)==='string')
					params = {segment:segments};
				else if(typeof(segments)==='object')
					params = {segments:segments};

				console.log(typeof(segments) + segments);

				$.ajax({
					url: '/produits_finis',
					data: params,
					type: 'get',
					dataType: 'json',
					success:function(data, status, XMLHttpRequest)
					{
						console.log(data);
						$('#produits_finis option:not(:first-child)').remove();
						$.each(data.resultat, function(index,produit){
							$('#produits_finis').append('<option value="'+produit.id+'">'+produit.text+'</option>');
						});
						//eval(_callback);
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$("#interlocuteurs").html(message);
					}
				});
			},
			// filtrerClient:function(target) // [A TERMINER] : Intégrer les dépendances entre type_segment, segment, produit fini
			// {
			// 	var params 		= {};
			// 	var type 		= $('#type_segment-select').val();
			// 	var produits 	= $('#produit_fini-select').val();
			// 	var segments 	= $('#segment-select').val();

			// 	switch(target.id)
			// 	{
			// 		case 'type_segment-select':
			// 			if(type)
			// 				params = {typeSegment:type};
			// 		break;
			// 		case 'segment-select':
			// 			if(segments)
			// 				params = {segments:segments};
			// 			else if(type)
			// 				params = {typeSegment:type};
			// 		break;
			// 		case 'produit_fini-select':
			// 			if(produits)
			// 				params = {produitsFinis:produits};
			// 			else if(segments)
			// 				params = {segments:segments};
			// 			else if(type)
			// 				params = {typeSegment:type};
			// 		break;
			// 		case 'search-client':
			// 			params.motCle = $('#search-client').val();
			// 			if(produits)
			// 				params.produitsFinis = produits;
			// 			else if(segments)
			// 				params.segments = segments;
			// 			else if(type)
			// 				params.typeSegment = type;
			// 		break;
			// 		case 'search-interlocuteur':
			// 			params = {motCle:$('#search-interlocuteur').val()};
			// 		break;
			// 	}
			// 	params.maxRows = 500;

			// 	console.log(params);
			// 	sigma.controller.client.setDataTableClient(params);
			// },
			setDataTableClient:function(params)
			{
				$.ajax({
					url: '/clients',
					data:params,
					type: 'get',
					dataType: 'json',
					success:function(data, status, XMLHttpRequest)
					{
						var _clients=$.parseJSON(data["resultat"]);
						$('#table-client').dataTable().fnDestroy();
						var clientTable = $('#table-client').dataTable( {
						    data: _clients,
						    columns: [
						        { 'data': 'code_client' },
						        { 'data': 'raison_sociale' },
						        { 'data': 'code_postal' },
						        { 'data': 'ville' },
						        { 'data': 'pays' },
						        { 'data': 'id' },
						    ],
						    columnDefs:[{
						    	'targets':5,
						    	'className':'actions',
						    	'searchable':false,
						    	'data':_clients.id,
						    	'render': function ( data, type, full, meta ) {
							      	return 	'<a href="clients/'+data+'"><i class="fa fa-eye fa-lg"></i></a> '+
                                        	'<a href="formulaire-client/'+data+'"><i class="fa fa-pencil-square-o fa-lg"></i></a> '+
                                        	'<a href="#" class="client-delete-toggle client" data-target="#client-delete-modal" data-action="delete" data-id="'+data+'"><i class="fa fa-trash-o fa-lg"></i></a>  ';
							    },
						    }],
						    'dom': '<"row"l>r<"table-responsive"t>ip',
						    /*
				            'tableTools': {
				                'sSwfPath': '/js/Inspinia/plugins/dataTables/swf/copy_csv_xls_pdf.swf'
				            },
				            */
				            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
				            oLanguage: {
		                    	'sUrl': '/js/Inspinia/plugins/dataTables/datatables-'+locale+'.json'
		                	},
		                	// Fonction de callback
		                	'fnInitComplete': function(){
								sigma.controller.client.setClientListeners();

								$('#table-client').unbind();
								$('#table-client').on('order.dt page.dt', function(){
									sigma.controller.client.setClientListeners();
								});
								$('select[name="table-client_length"]').on('change',function(){
									sigma.controller.client.setClientListeners();
								});
							},
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$("#clients").html(message);
					}
				});
			},
			setDataTableInterlocuteur:function(params)
			{
				$.ajax({
					url: '/clients/interlocuteurs',
					data:params,
					type: 'get',
					dataType: 'json',
					success:function(data, status, XMLHttpRequest)
					{
						var _interlocuteurs=$.parseJSON(data["resultat"]);
						$('#table-interlocuteur').dataTable().fnDestroy();
						var tableInterlocuteur = $('#table-interlocuteur').dataTable( {
						    data: _interlocuteurs,
						    columns: [
						        { 'data': 'nom_complet' },
						        { 'data': 'code_client' },
						        { 'data': 'raison_sociale' },
						        { 'data': 'email' },
						        { 'data': 'accepte_infos' },
						        { 'data': 'id' },
						    ],
						    columnDefs:
						    [
							    {
							    	'targets':3,
							    	'data':_interlocuteurs.email,
							    	'render': function (data){
							    		return (data) ? '<a href="mailto:'+data+'">'+data+'</a>':'';
							    	}
							    },
							    {
							    	'targets':4,
							    	'className':'bool',
							    	'data':_interlocuteurs.accepte_infos,
							    	'render': function (data){
							    		return (data==true)? '<i class="fa fa-check"></i>':'';
							    	}
							    },
							    {
							    	'targets':5,
							    	'className':'actions',
							    	'searchable':false,
							    	'data':_interlocuteurs.id,
							    	'render': function ( data, type, full, meta ) {
								      	return 	'<a href="#" class="interlocuteur-toggle interlocuteur" data-target="#interlocuteur-modal" data-action="view" data-id="'+data+'"><i class="fa fa-eye fa-lg"></i></a> '+
		                                    	'<a href="#" class="interlocuteur-form-toggle interlocuteur" data-target="#interlocuteur-form-modal" data-action="edit" data-id="'+data+'"><i class="fa fa-pencil-square-o fa-lg"></i></a> '+
		                                    	'<a href="#" class="interlocuteur-delete-toggle interlocuteur" data-target="#interlocuteur-delete-modal" data-action="delete" data-id="'+data+'"><i class="fa fa-trash-o fa-lg"></i></a> ';
								    },
							    }
						    ],
						    'dom': '<"row"l>r<"table-responsive"t>ip',
				            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
				            oLanguage: {
		                    	'sUrl': '/js/Inspinia/plugins/dataTables/datatables-'+locale+'.json'
		                	},
		                	'fnInitComplete': function(){ // Fonction de callback
		                		sigma.controller.client.setInterlocuteurListeners();

		                		$('#table-interlocuteur').unbind();
								$('#table-interlocuteur').on('order.dt page.dt', function(){
									sigma.controller.client.setInterlocuteurListeners();
								});
								$('select[name="table-interlocuteur_length"]').on('change',function(){
									sigma.controller.client.setInterlocuteurListeners();
								});
							},
						});
						$('#search-interlocuteur').keyup(function(){
							tableInterlocuteur.fnFilter($(this).val());
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$("#interlocuteurs").html(message);
					}
				});
			},
			setAutocompletionSocieteClient:function()
			{
				var codesClient=$('#code_client');
				var societes=$('#ref_societe_client');

				codesClient.on('change',function(){
					var val=$(this).val();
					var params={};

					if(val!=='')
						params={codeClient:val};

					$.ajax({
						url:'/autocompletion_client',
						data:params,
						dataType:'json',
						type:'GET',
						success:function(resultats){
							societes.empty();
							$.each($.parseJSON(resultats["resultat"]),function(index,value){
								societes.append('<option value="'+value.id+'">'+value.societe+'</option>');
							});
							societes.prepend('<option value="">Société</option>'); // Traduire "société"
						},
					});
				});
			},
			setModalInterlocuteurSession:function(numInterlocuteur)
			{
				var url = '/clients/formulaire-interlocuteur-session';
				if(numInterlocuteur)
					url+='/'+numInterlocuteur;	

				$.ajax({
					url: url,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#interlocuteur-modal .modal-body').html(data);
						$('#interlocuteur-modal').modal('toggle');
						sigma.controller.client.setAutocompletionSocieteClient();
						
						$('#interlocuteur-form-submit').unbind('click');
						$('#interlocuteur-form-submit').on('click',function(){
							sigma.controller.client.verifierInterlocuteurSession(numInterlocuteur);
							return false;
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#interlocuteur-modal").html(message);
					}
				});
			},
			setInterlocuteurListenersSession:function()
			{
				$('.interlocuteur').unbind('click');
				$('.interlocuteur').on('click',function(e){
					var numInterlocuteur=$(this).find('input').val();

					if($(e.target).is('i'))
					{
						sigma.controller.client.supprimerInterlocuteurSession(numInterlocuteur);
					}
					else
					{
						sigma.controller.client.setModalInterlocuteurSession(numInterlocuteur);
					}

					return false;
				});
			},
			verifierInterlocuteurSession:function(numInterlocuteur)
			{
				var url='/clients/formulaire-interlocuteur-session';
				if(numInterlocuteur)
					url+='/'+numInterlocuteur;

				$('#interlocuteur-form-submit').text($('#interlocuteur-form-submit').attr('data-loading-text'));

				$.ajax({
					url: url,
					dataType: 'json',
					data: $('#interlocuteur-form').serialize(),
					type: 'post',
					success:function(resultats)
					{
						/* On supprime les erreurs affichées s'il y en a */
						//$('#adresse-form div[class*="has-error"]').removeClass('has-error');
						$('span').remove('.help-inline');

						if(resultats.statut==true)
						{
							/* L'interlocuteur a été ajouté en session, on l'ajoute maintenant au DOM */

							var span=resultats.reponse;
							var interlocuteurSpan=$("input[value='"+resultats.uniqid+"']").parents('span');

							if(interlocuteurSpan.length) // Si l'élément existe
							{
								interlocuteurSpan.replaceWith(span);
							}
							else // S'il n'existe pas
							{
								$("#interlocuteur-list").append(span);
							}
							sigma.controller.client.setInterlocuteurListenersSession();
							$('#interlocuteur-modal .close').trigger('click');
						}
						// Si c'est pas bon, on met à jour, le formulaire d'interlocuteur avec les erreurs
						else
						{
							/* Ici on affiche les erreurs et les champs contenant des erreurs */

							var errors=resultats.reponse;
							$.each(errors,function(index,value){
								//$('#'+index).closest('div').addClass('has-error');
								$.each(value,function(codeError, messageError){
									$("label[for='"+index+"']").after('<span class="help-inline"> - '+messageError+'</span>');
								});
							});
							$("#interlocuteur-form span.help-inline").css({'color':'red'});
						}
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});

				$('#interlocuteur-form-submit').text($('#interlocuteur-form-submit').attr('data-default-text'));
				$('#interlocuteur-form-submit').prepend('<i class="fa fa-check"></i> ');
			},
			supprimerInterlocuteurSession:function(numInterlocuteur)
			{
				if(confirm('Vous avez cliqué sur "Supprimer l\'interlocuteur" ?'))
				{
					if(!numInterlocuteur)
						return;

					$.ajax({
						url: '/clients/supprimer-interlocuteur-session/'+numInterlocuteur,
						dataType: 'json',
						type: 'post',
						success:function(resultats)
						{
							// Si l'interlocuteur a bien été supprimé de la session, on le supprime du DOM 
							if(resultats.statut==true)
							{
								var interlocuteurSpan=$("input[value='"+resultats.uniqid+"']").parents('span');
								if(interlocuteurSpan.length) // Si l'élément existe
								{
									interlocuteurSpan.hide();
								}
								else // S'il n'existe pas
								{
									return;
								}
								sigma.controller.client.setInterlocuteurListenersSession();
							}
							else
							{
								return;
							}
						},
						error:function(xml,status,message)
						{
							alert(message);
						}
					});
				}
			},
			setInterlocuteurListeners:function()
			{
				$('.interlocuteur').unbind('click');
				$('.interlocuteur').on('click',function(e){
					var numInterlocuteur=$(this).attr('data-id');
					if($(this).attr('data-action')=='delete')
					{
						sigma.controller.client.setModalDeleteInterlocuteur(numInterlocuteur);
					}
					else if($(this).attr('data-action')=='view')
					{
						sigma.controller.client.setModalInterlocuteur(numInterlocuteur);
					}
					else // On ne précise pas l'action pour ne pas exclure le clic sur le bouton Nouvel interlocuteur
					{
						sigma.controller.client.setFormModalInterlocuteur(numInterlocuteur);
					}

					return false;
				});
			},
			setModalInterlocuteur:function(numInterlocuteur)
			{
				if(!numInterlocuteur)
						return;

				$.ajax({
					url: '/clients/interlocuteurs/'+numInterlocuteur,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#interlocuteur-modal .modal-content').html(data);
						$('#interlocuteur-modal').modal('toggle');
					},
					error:function(XMLHttpRequest, status, error)
					{
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#interlocuteur-modal").html(message);
					}
				});
			},
			setFormModalInterlocuteur:function(numInterlocuteur)
			{
				var url = '/clients/formulaire-interlocuteur';
				if(numInterlocuteur)
					url+='/'+numInterlocuteur;	

				$.ajax({
					url: url,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#interlocuteur-form-modal .modal-body').html(data);
						$('#interlocuteur-form-modal').modal('toggle');
						sigma.controller.client.setAutocompletionSocieteClient();
						
						$('#interlocuteur-form-submit').unbind('click');
						$('#interlocuteur-form-submit').on('click',function(){
							sigma.controller.client.verifierInterlocuteur(numInterlocuteur);
							return false;
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#interlocuteur-modal").html(message);
					}
				});
			},
			verifierInterlocuteur:function(numInterlocuteur)
			{
				$('#interlocuteur-form-submit span').text($('#interlocuteur-form-submit').attr('data-loading-text'));

				// Définition de l'adresse de requète
				var url='/clients/formulaire-interlocuteur';
				if(numInterlocuteur)
					url+='/'+numInterlocuteur;

				// Les inputs de type disabled ne sont pas pris en compte par le serialize() de jQuery
				// Il faut donc les enable le temps de la sérialisation :
				var form = $('#interlocuteur-form');
				var disabledInputs = form.find(':input:disabled').removeAttr('disabled');
				var serializeForm = form.serialize();
				disabledInputs.attr('disabled','disabled');

				$.ajax({
					url: url,
					dataType: 'json',
					data: serializeForm,
					type: 'post',
					success:function(resultats)
					{
						/* On supprime les erreurs affichées s'il y en a */
						//$('#adresse-form div[class*="has-error"]').removeClass('has-error');
						$('span').remove('.help-inline');

						if(resultats.statut==true)
						{
							// Affichage de l'interlocuteur dans le tableau
							var params={motCle:resultats.motCle,maxRows:500};
							sigma.controller.client.setDataTableInterlocuteur(params);

							// Si l'interlocuteur a été ajouté, on réactualise la table des interlocuteurs
							$('#interlocuteur-form-modal .close').trigger('click');
						}
						// Si c'est pas bon, on met à jour, le formulaire d'interlocuteur avec les erreurs
						else
						{
							/* Ici on affiche les erreurs et les champs contenant des erreurs */

							var errors=resultats.reponse;
							$.each(errors,function(index,value){
								//$('#'+index).closest('div').addClass('has-error');
								$.each(value,function(codeError, messageError){
									$("label[for='"+index+"']").after('<span class="help-inline"> - '+messageError+'</span>');
								});
							});
							$("#interlocuteur-form span.help-inline").css({'color':'red'});
						}
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});

				$('#interlocuteur-form-submit span').text($('#interlocuteur-form-submit').attr('data-default-text'));
			},
			setModalDeleteInterlocuteur:function(numInterlocuteur)
			{
				if(!numInterlocuteur)
					return;

				$.ajax({
					url: '/clients/supprimer-interlocuteur/'+numInterlocuteur,
					dataType: 'json',
					type: 'get',
					success:function(resultats)
					{
						var interlocuteur = resultats.interlocuteur;
						//$('#interlocuteur-delete-modal .modal-body').append('<p>'+interlocuteur.titreCivilite+' '+interlocuteur.prenom+' '+interlocuteur.nom+'</p>');
						$('#interlocuteur-delete-modal #infos-interlocuteur').text(interlocuteur);
						$('#interlocuteur-delete-modal').modal('toggle');

						$('#interlocuteur-delete-submit').unbind('click');
						$('#interlocuteur-delete-submit').on('click',function(){
							sigma.controller.client.supprimerInterlocuteur(numInterlocuteur);
							return false;
						});
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
			supprimerInterlocuteur:function(numInterlocuteur)
			{
				$.ajax({
					url: '/clients/supprimer-interlocuteur/'+numInterlocuteur,
					dataType: 'json',
					type: 'post',
					success:function(resultats)
					{
						// Si l'interlocuteur a bien été supprimé
						$('#interlocuteur-delete-modal .close').trigger('click');
						sigma.controller.client.setDataTableInterlocuteur({});
						//sigma.common.notification.alertSuccess('Action terminée avec succès','L\'interlocuteur a été supprimé sans problème');
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
			setClientListeners:function()
			{
				/*
				$('#table-client').unbind('click');
				$('#table-client tr td').on('click',function(){
						//alert('ophelie is back ');
				});
				*/
				$('.client').unbind('click');
				$('.client').on('click',function(e){
					var numClient=$(this).attr('data-id');
					if($(this).attr('data-action')=='delete')
					{
						sigma.controller.client.setModalDeleteClient(numClient);
					}
					return false;
				});
			},
			setModalDeleteClient:function(numClient)
			{
				if(!numClient)
					return;

				$.ajax({
					url: '/supprimer-client/'+numClient,
					dataType: 'json',
					type: 'get',
					success:function(resultats)
					{
						var client = resultats.client;
						$('#client-delete-modal #infos-client').text(client);
						$('#client-delete-modal').modal('toggle');

						$('#client-delete-submit').unbind('click');
						$('#client-delete-submit').on('click',function(){
							sigma.controller.client.supprimerClient(numClient);
							return false;
						});
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
			supprimerClient:function(numClient)
			{
				if(!numClient)
					return;

				$.ajax({
					url: '/supprimer-client/'+numClient,
					dataType: 'json',
					type: 'post',
					success:function(resultats)
					{
						// Si le client a bien été supprimé, on redirige l'utilisateur à l'entrée du module
						$('#client-delete-modal .close').trigger('click');
						setTimeout(function(){
							window.location.href='/clients'
						},1000);
						//sigma.common.notification.alertSuccess('','Le client a bien été supprimé');
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
			listeners:{
				// Mettre écouteurs ici
			},
			client:{
				// Mettre gestion formulaires client ici
			},
			interlocuteur:{
				// Mettre gestion formulaire interlocuteur client ici
			},
			requete:{
				// Mettre requetes et recherche

			}
		},
		fournisseur:{
			init:function(){

	            // Gestion des scripts spécifiques aux actions
				switch(_action)
				{
					case 'listefournisseur':
						// Initialisation du plugin dataTables sur la table des fournisseurs
						var fournisseurTable = $('#table-fournisseur').dataTable({
				            'dom': '<"row"l>r<"table-responsive"t>ip',
				            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
				            oLanguage: {
		                    	'sUrl': '/js/Inspinia/plugins/dataTables/datatables-'+locale+'.json'
		                	},
		                	fnInitComplete: function(){
								sigma.controller.fournisseur.setFournisseurListeners();

								$('#table-fournisseur').unbind();
								$('#table-fournisseur').on('order.dt page.dt', function(){
									sigma.controller.fournisseur.setFournisseurListeners();
								});
								$('select[name="table-fournisseur_length"]').on('change',function(){
									sigma.controller.fournisseur.setFournisseurListeners();
								});
							},
						});

						$('.chosen-select').chosen();
						
						// Ceci permet de filtrer les éléments de la table fournisseur 
						// en fonction de la valeur de l'input de recherche
						$('#fournisseur-filter').keyup(function(){
							fournisseurTable.fnFilter($(this).val());
						});

						$('#search-fournisseur').on('click', function(){
							sigma.controller.fournisseur.rechercherFournisseur();
							return false;
						});

						// Gestion de l'onglet des interlocuteurs [En cours]
						$('#tab-interlocuteur a').one('click',function(){ // "one" au lieu de "on" pour ne pas refaire l'ajax à chaque clic sur l'onglet Interlocuteur
							sigma.controller.fournisseur.setDataTableInterlocuteur({});
						});

						// Gestion de la recherche sur les deux onglets [En cours]
						$("input[type='search']").on('keydown',function(event){
							// Si l'utilisateur appuie sur Entrée, on effectue la recherche
							// [Permettre à l'utilisateur de faire la recherche s'il appuie sur le bouton de recherche (pour mobile)]
							if(event.type=='keydown'&&event.which==13)
							{
								var params={motCle:$(this).val(),maxRows:500};
								//console.log(params);
								if($(this).attr('id')=='search-fournisseur')
								{
									sigma.controller.fournisseur.setDataTableFournisseur(params);
								}
								else if ($(this).attr('id')=='search-interlocuteur')
								{
									sigma.controller.fournisseur.setDataTableInterlocuteur(params);
								}
							}
						});
					break;
					case 'formulairefournisseur':
						sigma.controller.adresse.setAdresseListeners();
						sigma.controller.fournisseur.setInterlocuteurListenersSession();
					break;
					case 'consulterfournisseur':
						$('#interlocuteur-details .tab-pane:first-child').addClass('active');
						$('.scrollable').slimScroll({
					        height: '140px',
					        alwaysVisible:true,
					        railOpacity: 0.4,
					        wheelStep: 10
					    });
						$('#fournisseur-delete-toggle').on('click',function(e){
							var numFournisseur=$(this).attr('data-id');
							sigma.controller.fournisseur.setModalDeleteFournisseur(numFournisseur);
							return false;
						});
					break;
					case 'formulaireinterlocuteur':
						sigma.controller.fournisseur.setAutocompletionSocieteFournisseur();
					break;
				}
			},
			rechercherFournisseur:function()
			{
				var params 		= {};
				var activites 	= $('#activite-select').val();
				var categories 	= $('#categorie-select').val();
				var motCle 		= $('#mot_cle-input').val();

				if(activites)
					params.activites = activites;
				if(categories)
					params.categories = categories;
				if(motCle)
					params.motCle = motCle;

				params.maxRows = 500;

				sigma.controller.fournisseur.setDataTableFournisseur(params);
			},
			setDataTableFournisseur:function(params)
			{
				$.ajax({
					url: '/fournisseurs',
					data:params,
					type: 'get',
					dataType: 'json',
					success:function(data, status, XMLHttpRequest)
					{
						var _fournisseurs=$.parseJSON(data["resultat"]);
						$('#table-fournisseur').dataTable().fnDestroy();
						var fournisseurTable = $('#table-fournisseur').dataTable( {
						    data: _fournisseurs,
						    columns: [
						        { 'data': 'code_fournisseur' },
						        { 'data': 'raison_sociale' },
						        { 'data': 'code_postal' },
						        { 'data': 'ville' },
						        { 'data': 'pays' },
						        { 'data': 'id' },
						    ],
						    columnDefs:[{
						    	'targets':5,
						    	'className':'actions',
						    	'searchable':false,
						    	'data':_fournisseurs.id,
						    	'render': function ( data, type, full, meta ) {
							      	return 	'<a href="fournisseurs/'+data+'"><i class="fa fa-eye fa-lg"></i></a> '+
                                        	'<a href="formulaire-fournisseur/'+data+'"><i class="fa fa-pencil-square-o fa-lg"></i></a> '+
                                        	'<a href="#" class="fournisseur-delete-toggle fournisseur" data-target="#fournisseur-delete-modal" data-action="delete" data-id="'+data+'"><i class="fa fa-trash-o fa-lg"></i></a>  ';
							    },
						    }],
						    'dom': '<"row"l>r<"table-responsive"t>ip',
						    /*
				            'tableTools': {
				                'sSwfPath': '/js/Inspinia/plugins/dataTables/swf/copy_csv_xls_pdf.swf'
				            },
				            */
				            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
				            oLanguage: {
		                    	'sUrl': '/js/Inspinia/plugins/dataTables/datatables-'+locale+'.json'
		                	},
		                	// Fonction de callback
		                	'fnInitComplete': function(){
								sigma.controller.fournisseur.setFournisseurListeners();

								$('#table-fournisseur').unbind();
								$('#table-fournisseur').on('order.dt page.dt', function(){
									sigma.controller.fournisseur.setFournisseurListeners();
								});
								$('select[name="table-fournisseur_length"]').on('change',function(){
									sigma.controller.fournisseur.setFournisseurListeners();
								});
							},
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$("#fournisseurs").html(message);
					}
				});
			},
			setDataTableInterlocuteur:function(params)
			{
				$.ajax({
					url: '/fournisseurs/interlocuteurs',
					data:params,
					type: 'get',
					dataType: 'json',
					success:function(data, status, XMLHttpRequest)
					{
						var _interlocuteurs=$.parseJSON(data["resultat"]);
						$('#table-interlocuteur').dataTable().fnDestroy();
						var tableInterlocuteur = $('#table-interlocuteur').dataTable( {
						    data: _interlocuteurs,
						    columns: [
						        { 'data': 'nom_complet' },
						        { 'data': 'code_fournisseur' },
						        { 'data': 'raison_sociale' },
						        { 'data': 'email' },
						        { 'data': 'envoi_vers_outlook' },
						        { 'data': 'id' },
						    ],
						    columnDefs:
						    [
							    {
							    	'targets':3,
							    	'data':_interlocuteurs.email,
							    	'render': function (data){
							    		return (data) ? '<a href="mailto:'+data+'">'+data+'</a>':'';
							    	}
							    },
							    {
							    	'targets':4,
							    	'className':'bool',
							    	'data':_interlocuteurs.envoi_vers_outlook,
							    	'render': function (data){
							    		return (data==true)? '<i class="fa fa-check"></i>':'';
							    	}
							    },
							    {
							    	'targets':5,
							    	'className':'actions',
							    	'searchable':false,
							    	'data':_interlocuteurs.id,
							    	'render': function ( data, type, full, meta ) {
								      	return 	'<a href="#" class="interlocuteur-toggle interlocuteur" data-target="#interlocuteur-modal" data-action="view" data-id="'+data+'"><i class="fa fa-eye fa-lg"></i></a> '+
		                                    	'<a href="#" class="interlocuteur-form-toggle interlocuteur" data-target="#interlocuteur-form-modal" data-action="edit" data-id="'+data+'"><i class="fa fa-pencil-square-o fa-lg"></i></a> '+
		                                    	'<a href="#" class="interlocuteur-delete-toggle interlocuteur" data-target="#interlocuteur-delete-modal" data-action="delete" data-id="'+data+'"><i class="fa fa-trash-o fa-lg"></i></a> ';
								    },
							    }
						    ],
						    'dom': '<"row"l>r<"table-responsive"t>ip',
				            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
				            oLanguage: {
		                    	'sUrl': '/js/Inspinia/plugins/dataTables/datatables-'+locale+'.json'
		                	},
		                	'fnInitComplete': function(){ // Fonction de callback
		                		sigma.controller.fournisseur.setInterlocuteurListeners();

		                		$('#table-interlocuteur').unbind();
								$('#table-interlocuteur').on('order.dt page.dt', function(){
									sigma.controller.fournisseur.setInterlocuteurListeners();
								});
								$('select[name="table-interlocuteur_length"]').on('change',function(){
									sigma.controller.fournisseur.setInterlocuteurListeners();
								});
							},
						});
						$('#search-interlocuteur').keyup(function(){
							tableInterlocuteur.fnFilter($(this).val());
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$("#interlocuteurs").html(message);
					}
				});
			},
			setAutocompletionSocieteFournisseur:function()
			{
				var codesFournisseur=$('#code_fournisseur');
				var societes=$('#ref_societe_fournisseur');

				codesFournisseur.on('change',function(){
					var val=$(this).val();
					var params={};

					if(val!=='')
						params={codeFournisseur:val};

					$.ajax({
						url:'/autocompletion_fournisseur',
						data:params,
						dataType:'json',
						type:'GET',
						success:function(resultats){
							societes.empty();
							$.each($.parseJSON(resultats["resultat"]),function(index,value){
								societes.append('<option value="'+value.id+'">'+value.societe+'</option>');
							});
							societes.prepend('<option value="">Société</option>'); // Traduire "société"
						},
					});
				});
			},
			setModalInterlocuteurSession:function(numInterlocuteur)
			{
				var url = '/fournisseurs/formulaire-interlocuteur-session';
				if(numInterlocuteur)
					url+='/'+numInterlocuteur;	

				$.ajax({
					url: url,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#interlocuteur-modal .modal-body').html(data);
						$('#interlocuteur-modal').modal('toggle');
						sigma.controller.fournisseur.setAutocompletionSocieteFournisseur();
						
						$('#interlocuteur-form-submit').unbind('click');
						$('#interlocuteur-form-submit').on('click',function(){
							sigma.controller.fournisseur.verifierInterlocuteurSession(numInterlocuteur);
							return false;
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#interlocuteur-modal").html(message);
					}
				});
			},
			setInterlocuteurListenersSession:function()
			{
				$('.interlocuteur').unbind('click');
				$('.interlocuteur').on('click',function(e){
					var numInterlocuteur=$(this).find('input').val();

					if($(e.target).is('i'))
					{
						sigma.controller.fournisseur.supprimerInterlocuteurSession(numInterlocuteur);
					}
					else
					{
						sigma.controller.fournisseur.setModalInterlocuteurSession(numInterlocuteur);
					}

					return false;
				});
			},
			verifierInterlocuteurSession:function(numInterlocuteur)
			{
				var url='/fournisseurs/formulaire-interlocuteur-session';
				if(numInterlocuteur)
					url+='/'+numInterlocuteur;

				$('#interlocuteur-form-submit').text($('#interlocuteur-form-submit').attr('data-loading-text'));

				$.ajax({
					url: url,
					dataType: 'json',
					data: $('#interlocuteur-form').serialize(),
					type: 'post',
					success:function(resultats)
					{
						/* On supprime les erreurs affichées s'il y en a */
						//$('#adresse-form div[class*="has-error"]').removeClass('has-error');
						$('span').remove('.help-inline');

						if(resultats.statut==true)
						{
							/* L'interlocuteur a été ajouté en session, on l'ajoute maintenant au DOM */

							var span=resultats.reponse;
							var interlocuteurSpan=$("input[value='"+resultats.uniqid+"']").parents('span');

							if(interlocuteurSpan.length) // Si l'élément existe
							{
								interlocuteurSpan.replaceWith(span);
							}
							else // S'il n'existe pas
							{
								$("#interlocuteur-list").append(span);
							}
							sigma.controller.fournisseur.setInterlocuteurListenersSession();
							$('#interlocuteur-modal .close').trigger('click');
						}
						// Si c'est pas bon, on met à jour, le formulaire d'interlocuteur avec les erreurs
						else
						{
							/* Ici on affiche les erreurs et les champs contenant des erreurs */

							var errors=resultats.reponse;
							$.each(errors,function(index,value){
								//$('#'+index).closest('div').addClass('has-error');
								$.each(value,function(codeError, messageError){
									$("label[for='"+index+"']").after('<span class="help-inline"> - '+messageError+'</span>');
								});
							});
							$("#interlocuteur-form span.help-inline").css({'color':'red'});
						}
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});

				$('#interlocuteur-form-submit').text($('#interlocuteur-form-submit').attr('data-default-text'));
				$('#interlocuteur-form-submit').prepend('<i class="fa fa-check"></i> ');
			},
			supprimerInterlocuteurSession:function(numInterlocuteur)
			{
				if(confirm('Vous avez cliqué sur "Supprimer l\'interlocuteur" ?'))
				{
					if(!numInterlocuteur)
						return;

					$.ajax({
						url: '/fournisseurs/supprimer-interlocuteur-session/'+numInterlocuteur,
						dataType: 'json',
						type: 'post',
						success:function(resultats)
						{
							// Si l'interlocuteur a bien été supprimé de la session, on le supprime du DOM 
							if(resultats.statut==true)
							{
								var interlocuteurSpan=$("input[value='"+resultats.uniqid+"']").parents('span');
								if(interlocuteurSpan.length) // Si l'élément existe
								{
									interlocuteurSpan.hide();
								}
								else // S'il n'existe pas
								{
									return;
								}
								sigma.controller.fournisseur.setInterlocuteurListenersSession();
							}
							else
							{
								return;
							}
						},
						error:function(xml,status,message)
						{
							alert(message);
						}
					});
				}
			},
			setInterlocuteurListeners:function()
			{
				$('.interlocuteur').unbind('click');
				$('.interlocuteur').on('click',function(e){
					var numInterlocuteur=$(this).attr('data-id');
					if($(this).attr('data-action')=='delete')
					{
						sigma.controller.fournisseur.setModalDeleteInterlocuteur(numInterlocuteur);
					}
					else if($(this).attr('data-action')=='view')
					{
						sigma.controller.fournisseur.setModalInterlocuteur(numInterlocuteur);
					}
					else // On ne précise pas l'action pour ne pas exclure le clic sur le bouton Nouvel interlocuteur
					{
						sigma.controller.fournisseur.setFormModalInterlocuteur(numInterlocuteur);
					}

					return false;
				});
			},
			setModalInterlocuteur:function(numInterlocuteur)
			{
				if(!numInterlocuteur)
						return;

				$.ajax({
					url: '/fournisseurs/interlocuteurs/'+numInterlocuteur,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#interlocuteur-modal .modal-content').html(data);
						$('#interlocuteur-modal').modal('toggle');
					},
					error:function(XMLHttpRequest, status, error)
					{
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#interlocuteur-modal").html(message);
					}
				});
			},
			setFormModalInterlocuteur:function(numInterlocuteur)
			{
				var url = '/fournisseurs/formulaire-interlocuteur';
				if(numInterlocuteur)
					url+='/'+numInterlocuteur;	

				$.ajax({
					url: url,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#interlocuteur-form-modal .modal-body').html(data);
						$('#interlocuteur-form-modal').modal('toggle');
						sigma.controller.fournisseur.setAutocompletionSocieteFournisseur();
						
						$('#interlocuteur-form-submit').unbind('click');
						$('#interlocuteur-form-submit').on('click',function(){
							sigma.controller.fournisseur.verifierInterlocuteur(numInterlocuteur);
							return false;
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#interlocuteur-modal").html(message);
					}
				});
			},
			verifierInterlocuteur:function(numInterlocuteur)
			{
				$('#interlocuteur-form-submit span').text($('#interlocuteur-form-submit').attr('data-loading-text'));

				// Définition de l'adresse de requète
				var url='/fournisseurs/formulaire-interlocuteur';
				if(numInterlocuteur)
					url+='/'+numInterlocuteur;

				// Les inputs de type disabled ne sont pas pris en compte par le serialize() de jQuery
				// Il faut donc les enable le temps de la sérialisation :
				var form = $('#interlocuteur-form');
				var disabledInputs = form.find(':input:disabled').removeAttr('disabled');
				var serializeForm = form.serialize();
				disabledInputs.attr('disabled','disabled');

				$.ajax({
					url: url,
					dataType: 'json',
					data: serializeForm,
					type: 'post',
					success:function(resultats)
					{
						/* On supprime les erreurs affichées s'il y en a */
						//$('#adresse-form div[class*="has-error"]').removeClass('has-error');
						$('span').remove('.help-inline');

						if(resultats.statut==true)
						{
							// Affichage de l'interlocuteur dans le tableau
							var params={motCle:resultats.motCle,maxRows:500};
							sigma.controller.fournisseur.setDataTableInterlocuteur(params);

							// Si l'interlocuteur a été ajouté, on réactualise la table des interlocuteurs
							$('#interlocuteur-form-modal .close').trigger('click');
						}
						// Si c'est pas bon, on met à jour, le formulaire d'interlocuteur avec les erreurs
						else
						{
							/* Ici on affiche les erreurs et les champs contenant des erreurs */

							var errors=resultats.reponse;
							$.each(errors,function(index,value){
								//$('#'+index).closest('div').addClass('has-error');
								$.each(value,function(codeError, messageError){
									$("label[for='"+index+"']").after('<span class="help-inline"> - '+messageError+'</span>');
								});
							});
							$("#interlocuteur-form span.help-inline").css({'color':'red'});
						}
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});

				$('#interlocuteur-form-submit span').text($('#interlocuteur-form-submit').attr('data-default-text'));
			},
			setModalDeleteInterlocuteur:function(numInterlocuteur)
			{
				if(!numInterlocuteur)
					return;

				$.ajax({
					url: '/fournisseurs/supprimer-interlocuteur/'+numInterlocuteur,
					dataType: 'json',
					type: 'get',
					success:function(resultats)
					{
						var interlocuteur = resultats.interlocuteur;
						//$('#interlocuteur-delete-modal .modal-body').append('<p>'+interlocuteur.titreCivilite+' '+interlocuteur.prenom+' '+interlocuteur.nom+'</p>');
						$('#interlocuteur-delete-modal #infos-interlocuteur').text(interlocuteur);
						$('#interlocuteur-delete-modal').modal('toggle');

						$('#interlocuteur-delete-submit').unbind('click');
						$('#interlocuteur-delete-submit').on('click',function(){
							sigma.controller.fournisseur.supprimerInterlocuteur(numInterlocuteur);
							return false;
						});
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
			supprimerInterlocuteur:function(numInterlocuteur)
			{
				$.ajax({
					url: '/fournisseurs/supprimer-interlocuteur/'+numInterlocuteur,
					dataType: 'json',
					type: 'post',
					success:function(resultats)
					{
						// Si l'interlocuteur a bien été supprimé
						$('#interlocuteur-delete-modal .close').trigger('click');
						sigma.controller.fournisseur.setDataTableInterlocuteur({});
						//sigma.common.notification.alertSuccess('Action terminée avec succès','L\'interlocuteur a été supprimé sans problème');
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
			setFournisseurListeners:function()
			{
				$('.fournisseur').unbind('click');
				$('.fournisseur').on('click',function(e){
					var numFournisseur=$(this).attr('data-id');
					if($(this).attr('data-action')=='delete')
					{
						sigma.controller.fournisseur.setModalDeleteFournisseur(numFournisseur);
					}
					return false;
				});
			},
			setModalDeleteFournisseur:function(numFournisseur)
			{
				if(!numFournisseur)
					return;

				$.ajax({
					url: '/supprimer-fournisseur/'+numFournisseur,
					dataType: 'json',
					type: 'get',
					success:function(resultats)
					{
						var fournisseur = resultats.fournisseur;
						$('#fournisseur-delete-modal #infos-fournisseur').text(fournisseur);
						$('#fournisseur-delete-modal').modal('toggle');

						$('#fournisseur-delete-submit').unbind('click');
						$('#fournisseur-delete-submit').on('click',function(){
							sigma.controller.fournisseur.supprimerFournisseur(numFournisseur);
							return false;
						});
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
			supprimerFournisseur:function(numFournisseur)
			{
				if(!numFournisseur)
					return;

				$.ajax({
					url: '/supprimer-fournisseur/'+numFournisseur,
					dataType: 'json',
					type: 'post',
					success:function(resultats)
					{
						// Si le fournisseur a bien été supprimé, on redirige l'utilisateur à l'entrée du module
						$('#fournisseur-delete-modal .close').trigger('click');
						setTimeout(function(){
							window.location.href='/fournisseurs'
						},1000);
						//sigma.common.notification.alertSuccess('','Le fournisseur a bien été supprimé');
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
		},
		affaire:{
			init:function(){
				switch(_action)
				{
					case 'listeaffaire':
						// Initialisation du plugin dataTables sur la table des affaires
						var affaireTable = $('#table-affaire').dataTable({
				            'dom': '<"row"l>r<"table-responsive"t>ip',
				            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
				            oLanguage: {
		                    	'sUrl': '/js/Inspinia/plugins/dataTables/datatables-'+locale+'.json'
		                	},
		                	fnInitComplete: function(){
								// sigma.controller.affaire.setAffaireListeners();

								// $('#table-affaire').unbind();
								// $('#table-affaire').on('order.dt page.dt', function(){
								// 	sigma.controller.affaire.setAffaireListeners();
								// });
								// $('select[name="table-affaire_length"]').on('change',function(){
								// 	sigma.controller.affaire.setAffaireListeners();
								// });
							},
						});
						$('#affaire-filter').keyup(function(){
							affaireTable.fnFilter($(this).val());
						});

						$('.chosen-select').chosen();
						$('.chosen-single-select').chosen({
							width: "100%",
							allow_single_deselect: true
						});
						

						$('#search-affaire').on('click', function(){
							sigma.controller.affaire.rechercherAffaire();
							return false;
						});
					break;
					case 'formulaireaffaire':
						// $('#demande_client').summernote({
						// 	// toolbar: [
						// 	//     //[groupname, [button list]]
						// 	//     ['style', ['bold', 'italic', 'underline', 'clear']],
						// 	//     ['font', ['strikethrough', 'superscript', 'subscript']],
						// 	//     ['fontsize', ['fontsize']],
						// 	//     ['color', ['color']],
						// 	//     ['para', ['ul', 'ol', 'paragraph']],
						// 	//     ['height', ['height']],
						// 	// ],
						// 	// height: 300,
						// 	// lang: 'fr_FR'
						// });
						// $('.i-checks').iCheck({
		    			//                 checkboxClass: 'icheckbox_square-green',
		    			//                 radioClass: 'iradio_square-green',
		    			//             });
						sigma.controller.affaire.setAutocompletionClient();
						sigma.controller.affaire.setAutocompletionInterlocuteur();
						$('#affaire-submit-button').on('click',function(){
							$('#affaire-form').find(':input:disabled').removeAttr('disabled');
						});
					break;
					case 'consulteraffaire':
						$('.scrollable').slimScroll({
					        height: '300px',
					        alwaysVisible:true,
					        railOpacity: 0.4,
					        wheelStep: 10
					    });
						$('#ligne-form-submit').on('click', function(){
							sigma.controller.affaire.addLigneAffaire();
					    	return false;
					    });

					    sigma.controller.produit.setAutocompletionInitulesProduits($('#ligne-form'));

					    // sigma.controller.affaire.setLigneListeners();
					break;
				}
			},
			setDataTableAffaire:function(params)
			{
				$.ajax({
					url: '/affaires',
					data:params,
					type: 'get',
					dataType: 'json',
					success:function(data, status, XMLHttpRequest)
					{
						var _affaires=$.parseJSON(data["resultat"]);
						$('#table-affaire').dataTable().fnDestroy();
						var clientTable = $('#table-affaire').dataTable( {
						    data: _affaires,
						    columns: [
						        { 'data': 'numero_affaire' },
						        { 'data': 'date_debut' },
						        { 'data': 'raison_sociale' },
						        { 'data': 'code_postal' },
						        { 'data': 'ville' },
						        { 'data': 'pays' },
						        { 'data': 'ref_devis_signe' },
						        { 'data': 'intitule_etat' },
						        { 'data': 'id' },
						    ],
						    columnDefs:
						    [
							    {
							    	'targets':6,
							    	'className':'bool',
							    	'data':_affaires.accepte_infos,
							    	'render': function (data){
							    		return (data)? '<i class="fa fa-check"></i>':'';
							    	}
							    },
						    	{
							    	'targets':8,
							    	'className':'actions',
							    	'searchable':false,
							    	'data':_affaires.id,
							    	'render': function ( data, type, full, meta ) {
								      	return 	'<a href="affaires/'+data+'"><i class="fa fa-eye fa-lg"></i></a> '+
	                                        	'<a href="formulaire-affaire/'+data+'"><i class="fa fa-pencil-square-o fa-lg"></i></a> '+
	                                        	'<a href="#" class="affaire-delete-toggle affaire" data-target="#affaire-delete-modal" data-action="delete" data-id="'+data+'"><i class="fa fa-trash-o fa-lg"></i></a>  ';
								    },
						    	}
						    ],
						    'dom': '<"row"l>r<"table-responsive"t>ip',
				            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
				            oLanguage: {
		                    	'sUrl': '/js/Inspinia/plugins/dataTables/datatables-'+locale+'.json'
		                	},
		                	// Fonction de callback
		                	'fnInitComplete': function(){
								// sigma.controller.affaire.setAffaireListeners();

								// $('#table-affaire').unbind();
								// $('#table-affaire').on('order.dt page.dt', function(){
								// 	sigma.controller.affaire.setAffaireListeners();
								// });
								// $('select[name="table-client_length"]').on('change',function(){
								// 	sigma.controller.affaire.setAffaireListeners();
								// });
							},
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$("#clients").html(message);
					}
				});
			},
			setAffaireListeners:function()
			{
				$('.affaire').unbind('click');
				$('.affaire').on('click',function(e){
					var numAffaire=$(this).attr('data-id');
					if($(this).attr('data-action')=='delete')
					{
						sigma.controller.affaire.setModalDeleteAffaire(numAffaire);
					}
					return false;
				});
			},
			rechercherAffaire:function()
			{
				var params 		= {};
				var centres 	= $('#centre_profit-select').val();
				var etat 		= $('#etat_affaire-select').val();
				var projetSigne = $('#projet_signe-select').val();
				var motCle 		= $('#mot_cle-input').val();

				if(centres)
					params.centres = centres;
				if(etat)
					params.etat = etat;
				if(projetSigne)
					params.projetSigne = projetSigne;
				if(motCle)
					params.motCle = motCle;

				params.maxRows = 500;

				sigma.controller.affaire.setDataTableAffaire(params);
			},
			setAutocompletionClient:function()
			{
				var codesClient=$('#code_client');
				var societes=$('#ref_client');

				codesClient.on('change',function(){
					var val=$(this).val();
					var params={};

					if(val!=='')
						params={codeClient:val};

					$.ajax({
						url:'/autocompletion_client',
						data:params,
						dataType:'json',
						type:'GET',
						success:function(resultats){
							societes.empty();
							$.each($.parseJSON(resultats["resultat"]),function(index,value){
								societes.append('<option value="'+value.id+'">'+value.societe+'</option>');
							});
							societes.prepend('<option value="">Société</option>'); // Traduire "société"
						},
					});
				});
			},
			setAutocompletionInterlocuteur:function()
			{
				var societes = $('#ref_client');
				var interlocuteurs = $('#ref_interlocuteur');

				societes.on('change',function(){
					var val = $(this).val();
					var params = {};

					if(val!=='')
						params={client:val};

					$.ajax({
						url:'/autocompletion_interlocuteur',
						data:params,
						dataType:'json',
						type:'GET',
						success:function(resultats){
							interlocuteurs.empty();
							$.each($.parseJSON(resultats["resultat"]),function(index,value){
								interlocuteurs.append('<option value="'+value.id+'">'+value.nom_complet+'</option>');
							});
							interlocuteurs.prepend('<option value="">Interlocuteur</option>'); // Traduire "société"
						},
					});
				});
			},
			// verifierLigneAffaire:function()
			// {

			// },
			// addLigneAffaire:function() // A MODIFIER
			// {
		 //    	var _formData = $('#ligne-form').serializeArray();

			// 	var _trVisible = $('#table-ligne tbody tr.footable-visible:first').clone(); // Duplique la premiere ligne du tableau
			// 	var _trUnVisible = $('#table-ligne tbody tr.footable-raw-detail:first').clone(); // Duplique la premiere ligne du tableau

			// 	console.log($('#table-ligne tbody tr.footable-row-detail:first'));

			// 	$.each(_formData, function(index, objet){
			// 		switch(objet.name)
			// 		{
			// 			case 'reference_produit':
			// 				_trVisible.find('.reference_produit').text(objet.value).prepend('<span class="fa fa-angle-right"></span>');
			// 			break;
			// 			case 'metier':
			// 				_trVisible.find('.metier').text(objet.value);
			// 			break;
			// 			case 'charge':
			// 				_trVisible.find('.charge').text(objet.value);
			// 				_trUnVisible.find('td div:eq(1) div:eq(2)').text(objet.value);
			// 			break;
			// 			case 'intitule_produit':
			// 				_trVisible.find('.intitule_produit').text(objet.value);
			// 			break;
			// 			case 'quantite':
			// 				_trVisible.find('.quantite').text(objet.value);
			// 			break;
			// 			case 'code_fournisseur':
			// 				_trVisible.find('.code_fournisseur').text(objet.value);
			// 			break;
			// 			case 'ref_fournisseur':
			// 				_trVisible.find('.ref_fournisseur').text(objet.value);
			// 			break;
			// 			case 'reference_devis':
			// 				_trVisible.find('.reference_devis').text(objet.value);
			// 			break;
			// 			case 'prix_unitaire_achat':
			// 				_trVisible.find('.prix_unitaire_achat').text(objet.value);
			// 			break;
			// 			case 'prix_unitaire_vente':
			// 				_trVisible.find('.prix_unitaire_vente').text(objet.value);
			// 			break;
			// 			case 'poids_unitaire':
			// 				_trVisible.find('.poids_unitaire').text(objet.value);
			// 			break;
			// 		}
			// 	});
			// 	// Azjouter les actions Modifier, Supprimer et ecouteur sur la nouvelle ligne !!

			// 	_trVisible.appendTo('#table-ligne tbody');
			// 	_trUnVisible.appendTo('#table-ligne tbody');

				
				

		 //    	// Le premier champ est un numéro de ligne
		 //    	_tr.find('td').eq(0).text(+$('#table-ligne tbody tr:last td:first').text()+1); // Le premier + permet de forcer la conversion du string en nombre et de faire la somma avec 1
		 //    	_tr.find('td').eq(1).html('<a href="#" class="delete-ligne"><i class="fa fa-times"></i></a>'); 
		 //    	// On rempli les autres champs avec les données du formulaire
		 //    	// (Utiliser des variables au lieu d'une boucle !!!)
		 //    	var _i = 1;
		 //    	$.each(_formData,function(index, objet){
		 //    		_i++;
		 //    		_tr.find('td').eq(_i).text(objet.value);
		 //    	});
			// 	_tr.appendTo('#table-ligne tbody');

			// 	// On réinitialise les écouteurs de ligne
			// 	sigma.controller.affaire.setLigneListeners();
			// },
			// deleteLigneAffaire:function(){

			// },
			// editLigneAffaire:function(){

			// },
			// setLigneListeners:function(){
			// 	/* Set consultation listeners */
			// 	$('#table-ligne tbody tr').unbind();
			// 	$('#table-ligne tbody tr').on('click', function(){
			// 		var rowDetail = $(this).next('.footable-row-detail');
			// 		if(rowDetail.css('display')=='table-row')
			// 		{
			// 			rowDetail.css('display','none');
			// 			$(this).find(':first span').removeClass('fa-angle-down').addClass('fa-angle-right');
			// 		}
			// 		else
			// 		{
			// 			rowDetail.css('display','table-row');
			// 			$(this).find(':first span').removeClass('fa-angle-right').addClass('fa-angle-down');
			// 		}
			// 		//sigma.controller.affaire.setModalLigneAffaire($(this));
			// 	});

			// 	/* Set deletion listeners */
			// 	$('#table-ligne tbody tr a.delete-ligne').unbind();
			// 	$('#table-ligne tbody tr a.delete-ligne').on('click', function(){	// Attention, la suppression doit également supprimer le TR généré !!!
			// 		var n = $('#table-ligne tbody tr').length;
			// 		console.log($('#table-ligne tbody tr'));
			// 		if(n > 1) {
			// 			$(this).closest('tr').remove();
			// 		}
			// 		else
			// 		{
			// 			// Faire un toast de notification
			// 			alert('Une affaire doit comporter au moins une ligne');
			// 		}
			// 	});

			// 	/* Set edition listeners */
			// 	$('#table-ligne tbody tr a.edit-ligne').unbind();
			// 	$('#table-ligne tbody tr a.edit-ligne').on('click', function(){	// Attention, la suppression doit également supprimer le TR généré !!!
			// 		return false;
			// 	});
			// },
			// updateLigneData:function(){ // cette méthode va permettre de mettre à jour les données d'une ligne après modification (PTA, PTV, PT)

			// },
			// updateAffaireData:function(){ // cette méthode va permettre de mettre à jour les données d'une affaire (Total frais hors port, etc)

			// },
			setModalLigneAffaire:function(){
				// Requète ajax
			},
		},
		personnel:{
			init:function()
			{
				switch(_action)
				{
					case 'profil':
						$('#modifier-password').on('click', function(){
							sigma.controller.personnel.password.setFormModalPassword();
						});
					break;
					case 'listepersonnel':
						sigma.controller.personnel.personnel.setPersonnelListeners();
					break;
				}
			},
			personnel:{
				setPersonnelListeners:function()
				{
					$('.personnel').unbind('click');
					$('.personnel').on('click',function(e){
						var numPersonnel=$(this).attr('data-id');
						if($(this).attr('data-action')=='delete')
						{
							sigma.controller.personnel.personnel.setModalDeletePersonnel(numPersonnel);
						}
						// else if($(this).attr('data-action')=='view')
						// {
						// 	sigma.controller.personnel.setModalPersonnel(numPersonnel);
						// }
						else // On ne précise pas l'action pour ne pas exclure le clic sur le bouton Nouvel interlocuteur
						{
							sigma.controller.personnel.personnel.setFormModalPersonnel(numPersonnel);
						}

						return false;
					});
				},
				setFormModalPersonnel:function(numPersonnel)
				{
					var url = '/formulaire-utilisateur';
					if(numPersonnel)
						url+='/'+numPersonnel;	

					$.ajax({
						url: url,
						type: 'get',
						dataType: 'html',
						success:function(data, status, XMLHttpRequest)
						{
							$('#personnel-form-modal .modal-body').html(data);
							$('#personnel-form-modal').modal('toggle');
							
							$('#personnel-form-submit').unbind('click');
							$('#personnel-form-submit').on('click',function(){
								sigma.controller.personnel.personnel.verifierPersonnel(numPersonnel);
								return false;
							});
						},
						error:function(XMLHttpRequest, status, error)
						{
							//sigma.language.error(233);
							var message='';
							if(locale=='en_US')
								message='An error occured when retrieving data : <strong>'+error+'</strong>';
							else
								message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
							$("#personnel-modal").html(message);
						}
					});
				},
				verifierPersonnel:function(numPersonnel)
				{
					$('#personnel-form-submit span').text($('#personnel-form-submit').attr('data-loading-text'));

					// Définition de l'adresse de requète
					var url='/formulaire-utilisateur';
					if(numPersonnel)
						url+='/'+numPersonnel;

					// Les inputs de type disabled ne sont pas pris en compte par le serialize() de jQuery
					// Il faut donc les enable le temps de la sérialisation :
					var form = $('#personnel-form');
					var disabledInputs = form.find(':input:disabled').removeAttr('disabled');
					var serializeForm = form.serialize();
					disabledInputs.attr('disabled','disabled');

					$.ajax({
						url: url,
						dataType: 'json',
						data: serializeForm,
						type: 'post',
						success:function(resultats)
						{
							/* On supprime les erreurs affichées s'il y en a */
							//$('#adresse-form div[class*="has-error"]').removeClass('has-error');
							$('span').remove('.help-inline');

							if(resultats.statut==true)
							{	
								console.log('Mot de passe : '+resultats.pwd);
								// Si l'utilisateur a été ajouté, on réactualise la table des utilisateurs
								$('#personnel-form-modal .close').trigger('click');
								setTimeout(function(){
									window.location.href='/utilisateurs'
								},1000);
							}
							// Si c'est pas bon, on met à jour, le formulaire d'utilisateur avec les erreurs
							else
							{
								/* Ici on affiche les erreurs et les champs contenant des erreurs */

								var errors=resultats.reponse;
								$.each(errors,function(index,value){
									//$('#'+index).closest('div').addClass('has-error');
									$.each(value,function(codeError, messageError){
										$("label[for='"+index+"']").after('<span class="help-inline"> - '+messageError+'</span>');
									});
								});
								$("#personnel-form span.help-inline").css({'color':'red'});
							}
						},
						error:function(xml,status,message)
						{
							alert(message);
						}
					});
					$('#personnel-form-submit span').text($('#personnel-form-submit').attr('data-default-text'));
				},
				verifierTauxHoraire:function()
				{
					// Vérifier que le taux-horaire est un simple nombre à virgule et non du texte
					// Fonction utilisée dans verifierPersonnel()
					// Ou utiliser la fonction de Anthony permettant de brider l'utilisateur que entrerai autre chose dans l'input que les caractères autorisés
				}
			},
			password:{
				setFormModalPassword:function()
				{
					$.ajax({
						url: '/profil/formulaire-password',
						type: 'get',
						dataType: 'html',
						success:function(data, status, XMLHttpRequest)
						{
							$('#password-form-modal .modal-body').html(data);
							$('#password-form-modal').modal('toggle');

							$('#password-form-submit').unbind('click');
							$('#password-form-submit').on('click',function(){
								sigma.controller.personnel.password.verifierPassword();
								return false;
							});
						},
						error:function(XMLHttpRequest, status, error)
						{
							//sigma.language.error(233);
							var message='';
							if(locale=='en_US')
								message='An error occured when retrieving data : <strong>'+error+'</strong>';
							else
								message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
							$("#password-modal").html(message);
						}
					});
				},
				verifierPassword:function()
				{
					$('#password-form-submit span').text($('#password-form-submit').attr('data-loading-text'));
					

					$.ajax({
						url: '/profil/formulaire-password',
						dataType: 'json',
						data: $('#password-form').serialize(),
						type: 'post',
						success:function(resultats)
						{
							/* On supprime les erreurs affichées s'il y en a */
							//$('#adresse-form div[class*="has-error"]').removeClass('has-error');
							$('span').remove('.help-inline');

							if(resultats.statut==true)
							{	
								// Si l'utilisateur a été ajouté, on réactualise la table des utilisateurs
								// $('#password-form-modal .close').trigger('click');
								// setTimeout(function(){
								// 	window.location.href='/utilisateurs'
								// },1000);
							}
							// Si c'est pas bon, on met à jour, le formulaire d'utilisateur avec les erreurs
							else
							{
								/* Ici on affiche les erreurs et les champs contenant des erreurs */
								// alert('hello2');
								var errors=resultats.reponse;
								$.each(errors,function(index,value){
									//$('#'+index).closest('div').addClass('has-error');
									$.each(value,function(codeError, messageError){
										$("label[for='"+index+"']").after('<span class="help-inline">'+messageError+'</span>');
									});
								});
								$("#password-form span.help-inline").css({'color':'red'});
							}
						},
						error:function(xml,status,message)
						{
							alert(message);
						}
					});
					$('#password-form-submit span').text($('#password-form-submit').attr('data-default-text'));
				},
			},
		},
		ficheHeure:{
			// ATTENTION : L'utilisateur ne peut modifier que sa propre fiche d'heure, 
			// il faudra donc tester s'il est sur sa fiche ou une autre avant d'afficher les formulaire d'jout ou modification
			init:function(){
				switch(_action)
				{
					case 'editerficheheure':
						// Ajustement de la taille du layout pour le calendrier
						// MEILLEURE SOLUTION : utiliser un layout spécifique à la saisie d'heure avec 
						// calendrier initialisé dès le début (pour ne pas avoir ce problème d'ajustement)
						$('#page-wrapper').css('height','2500px');

						// Initialisation du calendrier
				        $('.calendar').fullCalendar({
				            header: {
				                left: 'prev,next today',
				                center: 'title',
				                right: '',
				            },
				            editable: false, // this forbid the drop-and-down option
				            dayClick:function(date, jsEvent, view){
				                sigma.controller.ficheHeure.setFormModalSaisieHoraire(date.format());
				            },
				            eventClick: function(saisieHeure, jsEvent, view) {
				            	sigma.controller.ficheHeure.setFormModalSaisieProjet(saisieHeure.id);
				            },
				            events: sigma.controller.ficheHeure.convertInEvents(saisiesPHP),
				            lang: locale
				        });
						

				        // Recherche d'affaires par client et numéro d'affaire
						sigma.controller.ficheHeure.setAutocompletionAffaire();
						// Permet de réinitialiser la valeur de ref_affaire 
						// (en prévision de recherches)
						$('#numero_affaire').on('change',function(){ 
							if( $('#numero_affaire').val() == "" ){
								$('#ref_affaire').val("");
							}
						});

						// Lance la recherche en fonction des criteres renseignés
						$('#search-heures, .fc-prev-button, .fc-next-button, .fc-today-button').on('click', function(){
							sigma.controller.ficheHeure.rechercherFicheHeure();
							return false;
						});

						// Permet de supprimer une saisie d'heure [ A MODIFIER : 
						// faire en sorte que n'importe qui ne puisse pas supprimer les saisies de qq'un d'autre ]
						$('#projet-delete-submit').on('click',function(){
							sigma.controller.ficheHeure.supprimerSaisieHeure();
							return false;
						});
					break;
				}
			},
			// Ce formlaire permet de configurer les heures du jour ainsi que d'ajouter un projet
			setFormModalSaisieHoraire:function(date)
			{
				$.ajax({
					url: '/editer-fiche-heures/formulaire-saisie-horaire/'+date,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#saisie-form-modal .modal-body').html(data);
						$('#saisie-horaire-form #date').val(date);
						$('#saisie-form-modal').modal('toggle');
						
						$('#saisie-form-submit').unbind('click');
						$('#saisie-form-submit').on('click',function(){
							sigma.controller.ficheHeure.verifierSaisieHoraire(date);
							return false;
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#saisie-form-modal").html(message);
					}
				});
			},
			verifierSaisieHoraire:function(date)
			{
				$('span').remove('.help-inline');

				// Précision du 'select' car plusieurs inputs ont l'id ref_affaire 
				// (1 dans chaque formulaire de saisie + barre de recherche)
				if($('#saisie-horaire-form select#ref_affaire').val() || $('#saisie-horaire-form select#ref_libelle').val()  )
				{
					$('#saisie-form-submit span').text($('#saisie-form-submit').attr('data-loading-text'));

					var serializeForm = $('#saisie-horaire-form').serialize();

					$.ajax({
						url: '/editer-fiche-heures/formulaire-saisie-horaire/'+date,
						dataType: 'json',
						data: serializeForm,
						type: 'post',
						success:function(resultats)
						{
							if(resultats.statut==true)
							{
								// Si la saisie a été ajoutée, on ferme le modal
								$('#saisie-form-modal .close').trigger('click');

								// On recharge des saisie d'heure dans le module en faisant une redirection avec setTimeOut
								setTimeout(function(){
									window.location.href='/editer-fiche-heures'
								},500);
							}
							// Si c'est pas bon, on met à jour, le formulaire d'interlocuteur avec les erreurs
							else
							{
								/* Ici on affiche les erreurs et les champs contenant des erreurs */

								var errors=resultats.reponse;
								$.each(errors,function(index,value){
									$.each(value,function(codeError, messageError){
										$("label[for='"+index+"']").after('<span class="help-inline"> - '+messageError+'</span>');
									});
								});
								$("#saisie-horaire-form span.help-inline").css({'color':'red'});
							}
						},
						error:function(xml,status,message)
						{
							alert(message);
						}
					});

					$('#saisie-form-submit span').text($('#saisie-form-submit').attr('data-default-text'));
				}
				else
				{
					var p = $('#ref_affaire_error').text();
					$("#saisie-horaire-form label[for='ref_affaire']").after('<span class="help-inline" style="color:red;"> - '+p+'</span>');
					$('#saisie-form-submit span').text($('#saisie-form-submit').attr('data-default-text'));
					return;
				}				
			},
			// Ce formulaire permet de de modifier les informations d'une saisie d'heure par projet
			setFormModalSaisieProjet:function(numSaisie)
			{
				$.ajax({
					url: '/editer-fiche-heures/formulaire-saisie-heure/'+numSaisie,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$('#projet-form-modal .modal-body').html(data);
						// $('#projet-horaire-form #date').val(date);
						$('#projet-form-modal').modal('toggle');
						
						$('#projet-form-submit').unbind('click');
						$('#projet-form-submit').on('click',function(){
							sigma.controller.ficheHeure.verifierSaisieHeure(numSaisie);
							return false;
						});
					},
					error:function(XMLHttpRequest, status, error)
					{
						//sigma.language.error(233);
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération du formulaire : <strong>'+error+'</strong>';
						$("#projet-form-modal").html(message);
					}
				});
			},
			verifierSaisieHeure:function(numSaisie)
			{
				$('span').remove('.help-inline');

				// Précision du 'select' car plusieurs inputs ont l'id ref_affaire 
				// (1 dans chaque formulaire de saisie + barre de recherche)
				if($('#saisie-heure-form select#ref_affaire').val() || $('#saisie-heure-form select#ref_libelle').val()  )
				{
					$('#projet-form-submit span').text($('#projet-form-submit').attr('data-loading-text'));

					var serializeForm = $('#saisie-heure-form').serialize();

					$.ajax({
						url: '/editer-fiche-heures/formulaire-saisie-heure/'+numSaisie,
						dataType: 'json',
						data: serializeForm,
						type: 'post',
						success:function(resultats)
						{
							if(resultats.statut==true)
							{
								// Si la saisie a été ajoutée, on ferme le modal
								$('#projet-form-modal .close').trigger('click');
								window.location.href='/editer-fiche-heures';
							}
							// Si c'est pas bon, on met à jour, le formulaire d'interlocuteur avec les erreurs
							else
							{
								// Ici on affiche les erreurs et les champs contenant des erreurs
								var errors=resultats.reponse;
								$.each(errors,function(index,value){
									$.each(value,function(codeError, messageError){
										$("label[for='"+index+"']").after('<span class="help-inline"> - '+messageError+'</span>');
									});
								});
								$("#saisie-heure-form span.help-inline").css({'color':'red'});
							}
						},
						error:function(xml,status,message)
						{
							alert(message);
						}
					});

					$('#projet-form-submit span').text($('#projet-form-submit').attr('data-default-text'));
				}
				else
				{
					var p = $('#ref_affaire_error').text();
					$("#saisie-heure-form label[for='ref_affaire']").after('<span class="help-inline" style="color:red;"> - '+p+'</span>');
					$('#projet-form-submit span').text($('#projet-form-submit').attr('data-default-text'));
					return;
				}
				
			},
			supprimerSaisieHeure:function()
			{
				var numSaisie = $('#projet-form-modal #id_saisie_projet').val();

				$.ajax({
					url: '/editer-fiche-heures/supprimer-saisie-heure/'+numSaisie,
					dataType: 'json',
					type: 'post',
					success:function(resultats)
					{
						$('#projet-form-modal .close').trigger('click');
						window.location.href='/editer-fiche-heures';
					},
					error:function(xml,status,message)
					{
						alert(message);
					}
				});
			},
			rechercherFicheHeure:function()
			{
				var params 		= {};

				var personnel 	= $('#ref_personnel').val();
				var affaire 	= $('#ref_affaire').val();
				if(personnel)
					params.personnel = personnel;
				if(affaire)
					params.affaire = affaire;

				params.date 	= $('.calendar').fullCalendar('getDate').format();
				params.critere 	= $('[name="critere[]"]:checked').val();
				params.maxRows 	= 500;

				sigma.controller.ficheHeure.setCalendarFicheHeure(params);
				sigma.controller.ficheHeure.setRecapitulatifFicheHeure(params.critere, params.personnel, params.affaire, params.date);
			}, 
			setCalendarFicheHeure:function(params)
			{
				$.ajax({
					url: '/editer-fiche-heures',
					data: params,
					type: 'get',
					dataType: 'json',
					success:function(data, status, XMLHttpRequest)
					{
						$('.calendar').fullCalendar('destroy');
						$('.calendar').fullCalendar( {
							header: {
				                left: 'prev,next today',
				                center: 'title',
				                right: '',
				            },
				            // Permet d'initialiser le calendrier à une date définie 
				            // (à un mois en particulier donc, il doit s'agir d'un Moment)
				            // Peut être remplacé par la méthode "gotoDate" de fullCalendar après instanciation
				            defaultDate: $.fullCalendar.moment(data.date), 
				            editable: false,
				            //droppable: true, // this allows things to be dropped onto the calendar
				            dayClick:function(date, jsEvent, view){
				                sigma.controller.ficheHeure.setFormModalSaisieHoraire(date.format());
				            },
				            eventClick: function(saisieHeure, jsEvent, view) {
				            	sigma.controller.ficheHeure.setFormModalSaisieProjet(saisieHeure.id);
				            },
				            events: sigma.controller.ficheHeure.convertInEvents(data["saisiesPHP"]),
				            lang: locale
						});

						if($('[name="critere[]"]:checked').val() == 'personnel')
						{
							// ne pas unbind => sinon ça enlève le changement de mois et on ne peux plus changer de mois, 
							// et de toute façon la recherche au clic est déjà supprimée lors du 'destroy' du calendrier.
							// $('.fc-prev-button, .fc-next-button, .fc-today-button').unbind(); 

							$('.fc-prev-button, .fc-next-button, .fc-today-button').on('click', function(){
								sigma.controller.ficheHeure.rechercherFicheHeure();
								return false;
							});
						}
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$(".calendar").html(message);
					}
				});
			},
			setRecapitulatifFicheHeure:function(critere,personnel,projet,date)
			{
				// selon critere, route différente : personnel ou projet
				if(critere == 'personnel')
				{
					var url = '/editer-fiche-heures/recapitulatif-personnel/'+personnel;
				}
				else
				{
					var url = '/editer-fiche-heures/recapitulatif-projet';
				}

				if(projet)
					url+='/'+projet;

				$.ajax({
					url: url,
					data: 'date='+date,
					type: 'get',
					dataType: 'html',
					success:function(data, status, XMLHttpRequest)
					{
						$("#recapitulatif").html(data);
					},
					error:function(XMLHttpRequest, status, error)
					{
						var message='';
						if(locale=='en_US')
							message='An error occured when retrieving data : <strong>'+error+'</strong>';
						else
							message='Une erreur s\'est produite lors de la récupération des données : <strong>'+error+'</strong>';
						$("#recapitulatif").html(message);
					}
				});
			},
			setAutocompletionAffaire:function()
			{

				$('#numero_affaire').autocomplete({
					source:function(request,response)
					{
						$.ajax({
							url:'/autocompletion_affaire',
							dataType:'json',
							data:{ motCle:request.term,maxRows:10 },
							type:'GET',
							success:function(data)
							{
								var suggestions = eval(data.resultat);
								response($.map(suggestions,function(item){
									return {
										label:item.numero_affaire,
										value:function()
										{
											$('#ref_affaire').val(item.id);
											return item.numero_affaire;
										}
									}
								}));
							},
							error:function(xml,status,message)
							{
								alert(message);
							}
						});
					},
					minLength:3,
					delay:600
				});
			},
			convertInEvents:function(saisiesPHP)
			{
				var saisiesJSON = [];
				$.each(saisiesPHP,function(index,saisiePHP){

					var saisieJSON = {};

					var date = new Date(saisiePHP.annee, saisiePHP.mois - 1, saisiePHP.jour);

					saisieJSON.id = saisiePHP.id;
					saisieJSON.title = saisiePHP.nb_heure + 'h: '+ saisiePHP.intitule_saisie;
					saisieJSON.start = date;
					saisieJSON.end = date;
					saisieJSON.allDay = false;

					saisiesJSON.push(saisieJSON);

				});
				return saisiesJSON;
			},
		},
		produit:{
			init:function(){
				switch(_action)
				{
					case 'listeproduit':
					break;
				}
			},
			setAutocompletionInitulesProduits:function(scope)
			{
				scope.find('#code_produit, #intitule_produit').autocomplete({
					source:function(request,response)
					{
						var params = {};
						if($(this.element).attr('id')=='code_produit')
						{
							params = { codeProduit:request.term,maxRows:10 };
						}
						else
						{
							params = { intituleProduit:request.term,maxRows:10 };
						}

						$.ajax({
							url:'/autocompletion_produit',
							dataType:'json',
							data:params,
							type:'GET',
							success:function(data)
							{
								var suggestions = eval(data.resultat);
								response($.map(suggestions,function(item){
									return {
										label:'['+item.code_produit + '] '+item.intitule_produit,
										value:function()
										{
											if($(this).attr('id')=='code_produit')
											{
												$('#intitule_produit').val(item.intitule_produit);
												return item.code_produit;
											}
											else
											{
												$('#code_produit').val(item.code_produit);
												return item.intitule_produit;
											}
										}
									}
								}));
							},
							error:function(xml,status,message)
							{
								alert(message);
							}
						});
					},
					// select:function()
					// {
					// 	$('#pays').val('France');
					// },
					minLength:3,
					delay:600
				});
			},
		},
	},
	// Initialisation de l'API Sigma V2.0
	init:function(){
		//eval(_route+'.init()');
		this.language.init();
		this.common.init();
	}
}

/**
 * Fonction pour créer, modifier un cookie
 * @param {string} cname  CookieName
 * @param {string} cvalue CookieValue
 * @param {int} exdays NombreJoursPourExpiration
 */
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

/**
 * Fonction pour réccupérer un cookie
 * @param  {string} cname CookieName
 * @return {string}       CookieValue ou "" si le cookie n'existe pas
 */
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}

$(document).ready(function(){
	// Initialisation de l'API Sigma
	sigma.init();
});


//dans le layout
var language={};