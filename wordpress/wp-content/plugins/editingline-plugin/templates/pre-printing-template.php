<?php
	add_action( 'init', function() {
		$post_type = 'pre-printing'; // il nome del cpt
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
							'className' => 'pre_printing_subtitle',
							'placeholder' => 'Sottotitolo',
							'level' => 3
						)
					),
					array(
						'core/post-featured-image',
						array(
							'className' => 'pre_printing_cover',
						)
					),
					array( 
						'core/paragraph',
						array(
						'className' => 'pre_printing_product_description',
						'placeholder' => 'Descrizione del prodotto',
						)
					),
				)
			),
			
			// link_group
			array(
				'core/group',
				array(
					'className' => 'link_group'
				),
				array(
					array(
						'core/paragraph', // Blocco paragrafo all'interno di 'core/details'
						array(
							'className' => 'pre_printing_external_link',
							'placeholder' => 'Link sito esterno'
						)
					),
					array(
						'core/file',
						array(
							'className' => 'pre_printing_pdf',
							'placeholder' => 'Carica qui la brochure'
						)
					),
				)
			),
			
			// cover-media
			array(
				'core/group',
				array(
					'className' => 'media_group',
				),
				array(
					array(
						'core/gallery',
						array(
							'className' => 'pre_printing_gallery',
							'linkTo' => 'none'
						)
					),
					array(
						'core/embed',
						array(
							'className' => 'pre_printing_video',
							'providerNameSlug' => 'youtube',
							'responsive' => true
						)
					),
				)
			),
			
			// columns group
			array(
				'core/group',
				array(
					'className' => 'columns_group'
				),
				array(
					array(
						'core/columns',
						array(
							'className' => 'columns_block'
						),
						array(
							array(
								'core/column',
								array(
									'width' => '33.33%',
								),
								array(
									array(
										'core/image',
										array(
											'alt' => '',
										)
									)
								)
							),
							array(
								'core/column',
								array(
									'width' => '66.66%',
								),
								array(
									array(
										'core/paragraph',
										array()
									)
								)
							)
						)
					),
					// new columns block
					array(
						'core/columns',
						array(
							'className' => 'columns_block'
						),
						array(
							array(
								'core/column',
								array(
									'width' => '66.66%',
								),
								array(
									array(
										'core/paragraph',
										array()
									)
								)
							),
							array(
								'core/column',
								array(
									'width' => '33.33%',
								),
								array(
									array(
										'core/image',
										array(
											'alt' => '',
										)
									)
								)
							)
						)
					)
				)
			)
		);
	});
	