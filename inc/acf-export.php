<?php
/**
 * ACF param export
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_56accb6eb23a6',
	'title' => 'Évènements',
	'fields' => array (
		array (
			'key' => 'field_56accb73cd5a0',
			'label' => 'Titre',
			'name' => 'uxr_event_title',
			'type' => 'text',
			'instructions' => 'Par exemple : UX Deiz #1, Afterwork #1, Ateliers #1… C\'est ce titre qui sera affiché à côté de la date en haut de page.',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56accb82cd5a1',
			'label' => 'Thématique',
			'name' => 'uxr_event_theme',
			'type' => 'text',
			'instructions' => 'Par exemple : Au cœur de notre quotidien, Je t\'aime moi non plus…<br />
Seule la balise <code>&lt;br /&gt;</code> est autorisée.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56accbaecd5a2',
			'label' => 'Date de l\'évènement',
			'name' => 'uxr_event_date',
			'type' => 'date_picker',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => 'd/m/Y',
			'return_format' => 'F j, Y',
			'first_day' => 1,
		),
		array (
			'key' => 'field_56accbd4cd5a3',
			'label' => 'Contenu',
			'name' => 'uxr_event_flexible_content',
			'type' => 'flexible_content',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'button_label' => 'Ajouter un bloc de contenu',
			'min' => 1,
			'max' => '',
			'layouts' => array (
				array (
					'key' => '56ace797aba12',
					'name' => 'subtitle',
					'label' => 'Sous-titre',
					'display' => 'row',
					'sub_fields' => array (
						array (
							'key' => 'field_56ace79faba13',
							'label' => 'Sous-titre',
							'name' => 'subtitle',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '56accbe67319f',
					'name' => 'wysiwyg',
					'label' => 'WYSIWYG',
					'display' => 'row',
					'sub_fields' => array (
						array (
							'key' => 'field_56accbf9cd5a4',
							'label' => 'WYSIWYG',
							'name' => 'wysiwyg',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',
							'toolbar' => 'full',
							'media_upload' => 1,
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '56accd43cd5ac',
					'name' => 'talk',
					'label' => 'Présentation',
					'display' => 'block',
					'sub_fields' => array (
						array (
							'key' => 'field_56accc5fcd5a7',
							'label' => 'Titre de la présentation',
							'name' => 'title',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_56accc6ccd5a8',
							'label' => 'Qui a présenté ?',
							'name' => 'speaker_name',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
						array (
							'key' => 'field_56accc7bcd5a9',
							'label' => 'Pseudo Twitter de l\'intervenant·e',
							'name' => 'speaker_twitter',
							'type' => 'text',
							'instructions' => 'Ne pas inclure l\'arobase en début de pseudo. Ne pas saisir l\'URL Twitter entière.',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'readonly' => 0,
							'disabled' => 0,
						),
					),
					'min' => '',
					'max' => '',
				),
				array (
					'key' => '56accd1dcd5aa',
					'name' => 'fullwidth_image',
					'label' => 'Image pleine largeur',
					'display' => 'row',
					'sub_fields' => array (
						array (
							'key' => 'field_56accd27cd5ab',
							'label' => 'Image pleine largeur',
							'name' => 'fullwidth_image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array (
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'preview_size' => 'medium',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
							'return_format' => 'array',
							'library' => 'all',
						),
					),
					'min' => '',
					'max' => '',
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'events',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array (
		0 => 'the_content',
		1 => 'comments',
		2 => 'categories',
		3 => 'tags',
	),
	'active' => 1,
	'description' => '',
));

endif;