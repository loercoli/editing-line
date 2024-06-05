<?php
	add_action( 'init', function() {
		$post_type = 'post-printing'; // il nome del cpt
		$post_type_object = get_post_type_object( $post_type );
		$post_type_object->template = array(
			
			
			// cover_group
			array(
				'core/group',
				array(
					'className' => 'cover_group'
				),
				array(
					array(
						'core/heading',
						array(
							'className' => 'post_printing_subtitle',
							'placeholder' => 'Sottotitolo',
							'level' => 3
						)
					),
					array(
						'core/post-featured-image',
						array(
							'className' => 'post_printing_cover',
						)
					),
					array( 
						'core/paragraph',
						array(
						'className' => 'post_printing_product_description',
						'placeholder' => 'Descrizione del prodotto',
						)
					),
				)
			),
				//features_group
				array(
					'core/group',
					array(
						'className' => 'features_group',
					),
					array(
						array(
							'core/group',
							array(
								'className' => 'card_main_features',
							),
							array(
								array(
									'core/heading',
									array(
										'className' => 'title',
										'placeholder' => 'Titolo Caratteristica principale',
										'level' => 3,
									)
								),
								array(
									'core/paragraph',
									array(
										'className' => 'text',
										'placeholder' => 'Testo Caratteristica principale'
									)
								)
							)
						),
						array(
							'core/group',
							array(
								'className' => 'card_main_features',
							),
							array(
								array(
									'core/heading',
									array(
										'className' => 'title',
										'placeholder' => 'Titolo Caratteristica principale',
										'level' => 3,
									)
								),
								array(
									'core/paragraph',
									array(
										'className' => 'text',
										'placeholder' => 'Testo Caratteristica principale'
									)
								)
							)
						),
					)
									),
				
				//info_group
				array( 'core/group',array(
					'className' => 'info_group',
				),array(
					array( 'core/list', 
						array(
							'className' => 'post_printing_main_feature',
							'values' => '<li>Caratteristiche in evidenza</li>'
							)
						),
					array(
						'core/details', // Supponendo che 'core/details' sia un blocco personalizzato
						array(
							'className' => 'post_printing_additional_features',
							'summary' => 'Caratteristiche aggiuntive'),
						array(array('core/paragraph', // Blocco paragrafo all'interno di 'core/details'
								array('placeholder' => 'Inserisci qui i dettagli aggiuntivi del prodotto')
							)
						)
					)
				) ),
				
				
				//link_group
				array( 'core/group',array(
					'className' => 'link_group'),
				array(
					array(
						'core/paragraph', // Blocco paragrafo all'interno di 'core/details'
						array(
							'className' => 'post_printing_external_link',
							'placeholder' => 'Link sito esterno'
							)),
					array( 
						'core/file',
						array(
							'className' => 'post_printing_pdf',
							'placeholder' => 'Carica qui la brochure'
						) ),
				) ),
				
				//cover-media
				array( 'core/group',array(
					'className' => 'media_group',
				),array(
					array( 'core/gallery',array(
						'className' => 'post_printing_gallery',
						'linkTo' => 'none'
					) ),
					array( 'core/embed',array(
						'className' => 'post_printing_video',
						'providerNameSlug' => 'youtube',
						'responsive' => true
					) ),
				) )
			);
	
		
	});

	