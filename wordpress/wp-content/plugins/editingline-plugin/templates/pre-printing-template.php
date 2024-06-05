<?php
	add_action( 'init', function() {
		$post_type = 'pre-printing'; // il nome del cpt
		$post_type_object = get_post_type_object( $post_type );
		$post_type_object->template = array(
			
			//cover-group
			array(
				'core/group',
				array(
					'metadata' => array('name' => 'cover')
				),
				array(
					array(
						'core/heading',
						array(
							'placeholder' => 'Sottotitolo',
							'level' => 2
						)
					),
					array(
						'core/post-featured-image',
						array()
					),
				)
				),
			
			//cover-info
			array(
				'core/group',
				array(
					'metadata' => array(
						'name' => 'info'
					)
				),
				array(
					array(
						'core/paragraph',
						array(
							'placeholder' => 'Descrizione del prodotto'
						)
					),
					array(
						'core/image', 
						array()
					)
				),
			)
			,
			
			//cover-link
			array( 'core/group',array(
				'metadata' => array(
					'name' => 'link'
				)
			),array(
				array('core/paragraph', // Blocco paragrafo all'interno di 'core/details'
					array('placeholder' => 'Link sito esterno'
						)),
				array( 'core/file',array(
					'placeholder' => 'Carica qui la brochure'
				) ),
			) ),
			
			//cover-media
			array( 'core/group',array(
				'metadata' => array(
					'name' => 'media'
				)
			),array(
				array( 'core/gallery',array(
					'linkTo' => 'none'
				) ),
				array( 'core/embed',array(
					'providerNameSlug' => 'youtube',
					'responsive' => true
				) ),
			) )
		);

		
	});

	