<?php
	add_action( 'init', function() {
		$post_type = 'consumable'; // il nome del cpt
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
							'className' => 'consumable_subtitle',
							'placeholder' => 'Sottotitolo',
							'level' => 3
						)
					),
					array(
						'core/post-featured-image',
						array(
							'className' => 'consumable_cover',
						)
					),
					array( 
						'core/paragraph',
						array(
						'className' => 'consumable_product_description',
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
						'core/file',
						array(
							'className' => 'consumable_pdf',
							'placeholder' => 'Carica qui la brochure'
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
	