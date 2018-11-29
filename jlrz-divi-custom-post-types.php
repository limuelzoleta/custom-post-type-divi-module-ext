<?php

class ET_Builder_Module_Custom_Post extends ET_Builder_Module_Type_PostBased {
	function init() {
		$this->name       = esc_html__( 'Custom Post', 'et_builder' );
		$this->plural     = esc_html__( 'Custom Posts', 'et_builder' );
		$this->slug       = 'et_pb_custom_post';
		$this->vb_support = 'on';
		$this->main_css_element = '%%order_class%% .et_pb_post';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Content', 'et_builder' ),
					'elements'     => esc_html__( 'Elements', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'layout'  => esc_html__( 'Layout', 'et_builder' ),
					'overlay' => esc_html__( 'Overlay', 'et_builder' ),
					'image' => array(
						'title' => esc_html__( 'Image', 'et_builder' ),
						'priority' => 51,
					),
					'text'    => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 49,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'header' => array(
					'label'    => esc_html__( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .entry-title",
						'font' => "{$this->main_css_element} .entry-title a",
						'color' => "{$this->main_css_element} .entry-title a",
						'plugin_main' => "{$this->main_css_element} .entry-title, {$this->main_css_element} .entry-title a",
						'important' => 'all',
					),
					'header_level' => array(
						'default' => 'h2',
						'computed_affects' => array(
							'__posts',
						),
					),
				),
				'body'   => array(
					'label'    => esc_html__( 'Body', 'et_builder' ),
					'css'      => array(
						'main'        => "{$this->main_css_element} .post-content, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content p",
						'color'       => "{$this->main_css_element}, {$this->main_css_element} .post-content *",
						'line_height' => "{$this->main_css_element} p",
						'plugin_main' => "{$this->main_css_element}, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_light .et_pb_post a.more-link, %%order_class%%.et_pb_bg_layout_dark .et_pb_post a.more-link",
					),
				),
				'meta' => array(
					'label'    => esc_html__( 'Meta', 'et_builder' ),
					'css'      => array(
						'main'        => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a",
						'plugin_main' => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a, {$this->main_css_element} .post-meta span",
					),
				),
				'pagination' => array(
					'label'    => esc_html__( 'Pagination', 'et_builder' ),
					'css'      => array(
						'main' => function_exists( 'wp_pagenavi' ) ? '%%order_class%% .wp-pagenavi a, %%order_class%% .wp-pagenavi span' : '%%order_class%% .pagination a',
						'important'  => function_exists( 'wp_pagenavi' ) ? 'all' : array(),
						'text_align' => '%%order_class%% .wp-pagenavi',
					),
					'hide_text_align' => ! function_exists( 'wp_pagenavi' ),
					'text_align' => array(
						'options' => et_builder_get_text_orientation_options( array( 'justified' ), array() ),
					),
				),
			),
			'background'            => array(
				'css' => array(
					'main' => '%%order_class%%',
				),
			),
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .et_pb_blog_grid .et_pb_post",
							'border_styles' => "%%order_class%% .et_pb_blog_grid .et_pb_post",
							'border_styles_hover' => "%%order_class%% .et_pb_blog_grid .et_pb_post:hover",
						),
					),
					'depends_on'      => array( 'fullwidth' ),
					'depends_show_if' => 'off',
					'defaults' => array(
						'border_radii'  => 'on||||',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#d8d8d8',
							'style' => 'solid',
						),
					),
				),
				'fullwidth' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "%%order_class%%:not(.et_pb_blog_grid) .et_pb_post",
							'border_styles' => "%%order_class%%:not(.et_pb_blog_grid) .et_pb_post",
						),
					),
					'depends_on'      => array( 'fullwidth' ),
					'depends_show_if' => 'on',
					'defaults'        => array(
						'border_radii'  => 'on||||',
						'border_styles' => array(
							'width' => '0px',
							'color' => '#333333',
							'style' => 'solid',
						),
					),
				),
			),
			'margin_padding' => array(
				'css'           => array(
					'main' => '%%order_class%%',
                    'important' => array( 'custom_margin' )
				),
			),
			'text'                  => array(
				'use_background_layout' => true,
				'css' => array(
					'text_shadow' => '%%order_class%%',
				),
				'options' => array(
					'background_layout' => array(
						'depends_show_if' => 'on',
						'default_on_front' => 'light',
						'hover' => 'tabs',
					),
				),
			),
			'filters'               => array(
				'css' => array(
					'main' => '%%order_class%%',
				),
				'child_filters_target' => array(
					'tab_slug' => 'advanced',
					'toggle_slug' => 'image',
				),
			),
			'image'                 => array(
				'css' => array(
					'main' => implode(', ', array(
						'%%order_class%% img',
						'%%order_class%% .et_pb_slides',
						'%%order_class%% .et_pb_video_overlay',
					)),
				),
			),
			'button'                => false,
		);

		$this->custom_css_fields = array(
			'title' => array(
				'label'    => esc_html__( 'Title', 'et_builder' ),
				'selector' => '.entry-title',
			),
			'content' => array(
				'label'    => esc_html__( 'Content', 'et_builder' ),
				'selector' => '.post-content',
			),
			'post_meta' => array(
				'label'    => esc_html__( 'Post Meta', 'et_builder' ),
				'selector' => '.post-meta',
			),
			'pagenavi' => array(
				'label'    => esc_html__( 'Pagenavi', 'et_builder' ),
				'selector' => '.wp_pagenavi',
			),
			'featured_image' => array(
				'label'    => esc_html__( 'Featured Image', 'et_builder' ),
				'selector' => '.et_pb_image_container',
			),
			'read_more' => array(
				'label'    => esc_html__( 'Read More Button', 'et_builder' ),
				'selector' => '.more-link',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'PRaWaGI75wc' ),
				'name' => esc_html__( 'An introduction to the Blog module', 'et_builder' ),
			),
			array(
				'id'   => esc_html( 'jETCzKVv6P0' ),
				'name' => esc_html__( 'How To Use Divi Blog Post Formats', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'fullwidth' => array(
				'label'             => esc_html__( 'Layout', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'layout',
				'options'           => array(
					'on'  => esc_html__( 'Fullwidth', 'et_builder' ),
					'off' => esc_html__( 'Grid', 'et_builder' ),
				),
				'affects'           => array(
					'background_layout',
					'masonry_tile_background_color',
					'border_radii_fullwidth',
					'border_styles_fullwidth',
					'border_radii',
					'border_styles',
				),
				'description'        => esc_html__( 'Toggle between the various blog layout types.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'tab_slug'           => 'advanced',
				'toggle_slug'        => 'layout',
				'default_on_front'   => 'on',
			),
			'posts_number' => array(
				'label'             => esc_html__( 'Posts Number', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'       => 'main_content',
				'default'           => 10,
			),
			'post_type' => array(
				'label'             => esc_html__( 'Posts Type', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose the post type you want to display.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'       => 'main_content',
				'default'           => 'post',
			),
			'include_categories' => array(
				'label'            => esc_html__( 'Include Categories', 'et_builder' ),
				'type'             => 'categories',
				'meta_categories'  => array(
					'all'     => esc_html__( 'All Categories', 'et_builder' ),
					'current' => esc_html__( 'Current Category', 'et_builder' ),
				),
				'option_category'  => 'basic_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => esc_html__( 'Choose which categories you would like to include in the feed.', 'et_builder' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__posts',
				),
			),
			'meta_date' => array(
				'label'             => esc_html__( 'Meta Date Format', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
				'toggle_slug'       => 'main_content',
				'computed_affects'  => array(
					'__posts',
				),
				'default'           => 'M j, Y',
			),
			'show_thumbnail' => array(
				'label'             => esc_html__( 'Show Featured Image', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'       => esc_html__( 'This will turn thumbnails on and off.', 'et_builder' ),
				'computed_affects'  => array(
					'__posts',
				),
				'toggle_slug'       => 'elements',
				'default_on_front'  => 'on',
			),
			'show_content' => array(
				'label'             => esc_html__( 'Content', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( 'Show Excerpt', 'et_builder' ),
					'on'  => esc_html__( 'Show Content', 'et_builder' ),
				),
				'affects'           => array(
					'show_more',
				),
				'description'       => esc_html__( 'Showing the full content will not truncate your posts on the index page. Showing the excerpt will only display your excerpt text.', 'et_builder' ),
				'toggle_slug'       => 'main_content',
				'computed_affects'  => array(
					'__posts',
				),
				'default_on_front'  => 'off',
			),
			'show_more' => array(
				'label'             => esc_html__( 'Show Read More Button', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'depends_show_if'   => 'off',
				'description'       => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'       => 'elements',
				'default_on_front'  => 'off',
			),
			'show_author' => array(
				'label'             => esc_html__( 'Show Author', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Turn on or off the author link.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'        => 'elements',
				'default_on_front'   => 'on',
			),
			'show_date' => array(
				'label'             => esc_html__( 'Show Date', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Turn the date on or off.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'        => 'elements',
				'default_on_front'   => 'on',
			),
			'show_categories' => array(
				'label'             => esc_html__( 'Show Categories', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Turn the category links on or off.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'        => 'elements',
				'default_on_front'   => 'on',
			),
			'show_comments' => array(
				'label'             => esc_html__( 'Show Comment Count', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Turn comment count on and off.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'        => 'elements',
				'default_on_front'   => 'off',
			),
			'show_pagination' => array(
				'label'             => esc_html__( 'Show Pagination', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'Turn pagination on and off.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'        => 'elements',
				'default_on_front'   => 'on',
			),
			'offset_number' => array(
				'label'            => esc_html__( 'Offset Number', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'description'      => esc_html__( 'Choose how many posts you would like to offset by', 'et_builder' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__posts',
				),
				'default'          => 0,
			),
			'use_overlay' => array(
				'label'             => esc_html__( 'Featured Image Overlay', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'layout',
				'options'           => array(
					'off' => esc_html__( 'Off', 'et_builder' ),
					'on'  => esc_html__( 'On', 'et_builder' ),
				),
				'affects'           => array(
					'overlay_icon_color',
					'hover_overlay_color',
					'hover_icon',
				),
				'description'       => esc_html__( 'If enabled, an overlay color and icon will be displayed when a visitors hovers over the featured image of a post.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'overlay',
				'default_on_front'  => 'off',
			),
			'overlay_icon_color' => array(
				'label'             => esc_html__( 'Overlay Icon Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'depends_show_if'   => 'on',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'overlay',
				'description'       => esc_html__( 'Here you can define a custom color for the overlay icon', 'et_builder' ),
			),
			'hover_overlay_color' => array(
				'label'             => esc_html__( 'Hover Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'depends_show_if'   => 'on',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'overlay',
				'description'       => esc_html__( 'Here you can define a custom color for the overlay', 'et_builder' ),
			),
			'hover_icon' => array(
				'label'               => esc_html__( 'Hover Icon Picker', 'et_builder' ),
				'type'                => 'select_icon',
				'option_category'     => 'configuration',
				'class'               => array( 'et-pb-font-icon' ),
				'depends_show_if'     => 'on',
				'description'         => esc_html__( 'Here you can define a custom icon for the overlay', 'et_builder' ),
				'tab_slug'            => 'advanced',
				'toggle_slug'         => 'overlay',
				'computed_affects'    => array(
					'__posts',
				),
			),
			'masonry_tile_background_color' => array(
				'label'             => esc_html__( 'Grid Tile Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'toggle_slug'       => 'background',
				'depends_show_if'   => 'off',
				'depends_on'        => array(
					'fullwidth',
				),
				'hover'             => 'tabs',
			),
			'__posts' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				'computed_depends_on' => array(
					'fullwidth',
					'posts_number',
					'include_categories',
					'meta_date',
					'show_thumbnail',
					'show_content',
					'show_more',
					'show_author',
					'show_date',
					'show_categories',
					'show_comments',
					'show_pagination',
					'offset_number',
					'use_overlay',
					'hover_icon',
					'header_level',
					'__page',
				),
				'computed_minimum' => array(
					'posts_number',
				),
			),
			'__page'          => array(
				'type'              => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				'computed_affects'  => array(
					'__posts',
				),
			),
		);
		return $fields;
	}

	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['background_layout'] = array(
			'color' => implode( ', ',
				array(
					'%%order_class%% .entry-title',
					'%%order_class%% .post-meta',
					'%%order_class%% .post-content'
				)
			)
		);
		$fields['border_radii']            = array( 'border-radius' => self::$_->array_get( $this->advanced_fields, 'borders.default.css.main.border_radii' ) );
		$fields['border_styles']           = array( 'border' => self::$_->array_get( $this->advanced_fields, 'borders.default.css.main.border_styles' ) );
		$fields['border_radii_fullwidth']  = array( 'border-radius' => self::$_->array_get( $this->advanced_fields, 'borders.fullwidth.css.main.border_radii' ) );
		$fields['border_styles_fullwidth'] = array( 'border' => self::$_->array_get( $this->advanced_fields, 'borders.fullwidth.css.main.border_styles' ) );
		$fields['max_width']               = array( 'max-width' => '%%order_class%%');

		return $fields;
	}

	/**
	 * Get blog posts for blog module
	 *
	 * @param array   arguments that is being used by et_pb_blog
	 * @return string blog post markup
	 */
	static function get_blog_posts( $args = array(), $conditional_tags = array(), $current_page = array() ) {
		global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;

		$global_processing_original_value = $et_fb_processing_shortcode_object;

		// Default params are combination of attributes that is used by et_pb_blog and
		// conditional tags that need to be simulated (due to AJAX nature) by passing args
		$defaults = array(
			'fullwidth'                     => '',
			'posts_number'                  => '',
			'post_type'		                  => '',
			'include_categories'            => '',
			'meta_date'                     => '',
			'show_thumbnail'                => '',
			'show_content'                  => '',
			'show_author'                   => '',
			'show_date'                     => '',
			'show_categories'               => '',
			'show_comments'                 => '',
			'show_pagination'               => '',
			'background_layout'             => '',
			'show_more'                     => '',
			'offset_number'                 => '',
			'masonry_tile_background_color' => '',
			'overlay_icon_color'            => '',
			'hover_overlay_color'           => '',
			'hover_icon'                    => '',
			'use_overlay'                   => '',
			'header_level'                  => 'h2',
		);

		// WordPress' native conditional tag is only available during page load. It'll fail during component update because
		// et_pb_process_computed_property() is loaded in admin-ajax.php. Thus, use WordPress' conditional tags on page load and
		// rely to passed $conditional_tags for AJAX call
		$is_front_page               = et_fb_conditional_tag( 'is_front_page', $conditional_tags );
		$is_search                   = et_fb_conditional_tag( 'is_search', $conditional_tags );
		$is_single                   = et_fb_conditional_tag( 'is_single', $conditional_tags );
		$et_is_builder_plugin_active = et_fb_conditional_tag( 'et_is_builder_plugin_active', $conditional_tags );
		$post_id                     = isset( $current_page['id'] ) ? (int) $current_page['id'] : 0;

		$container_is_closed = false;

		// remove all filters from WP audio shortcode to make sure current theme doesn't add any elements into audio module
		remove_all_filters( 'wp_audio_shortcode_library' );
		remove_all_filters( 'wp_audio_shortcode' );
		remove_all_filters( 'wp_audio_shortcode_class' );

		$args = wp_parse_args( $args, $defaults );

		$processed_header_level = et_pb_process_header_level( $args['header_level'], 'h2' );
		$processed_header_level = esc_html( $processed_header_level );

		$overlay_output = '';
		$hover_icon = '';

		if ( 'on' === $args['use_overlay'] ) {
			$data_icon = '' !== $args['hover_icon']
				? sprintf(
					' data-icon="%1$s"',
					esc_attr( et_pb_process_font_icon( $args['hover_icon'] ) )
				)
				: '';

			$overlay_output = sprintf(
				'<span class="et_overlay%1$s"%2$s></span>',
				( '' !== $args['hover_icon'] ? ' et_pb_inline_icon' : '' ),
				$data_icon
			);
		}

		$overlay_class = 'on' === $args['use_overlay'] ? ' et_pb_has_overlay' : '';

		$query_args = array(
			'posts_per_page' => intval( $args['posts_number'] ),
			'post_status'    => 'publish',
		);

		if ( defined( 'DOING_AJAX' ) && isset( $current_page['paged'] ) ) {
			$paged = intval( $current_page['paged'] ); //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		} else {
			$paged = $is_front_page ? get_query_var( 'page' ) : get_query_var( 'paged' ); //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		}

		// support pagination in VB
		if ( isset( $args['__page'] ) ) {
			$paged = $args['__page']; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		}

		if ( '' !== $args['include_categories'] ) {
			$query_args['cat'] = implode( ',', self::filter_meta_categories( $args['include_categories'], $post_id ) );
		}

		if ( ! $is_search ) {
			$query_args['paged'] = $paged;
		}

		if ( '' !== $args['offset_number'] && ! empty( $args['offset_number'] ) ) {
			/**
			 * Offset + pagination don't play well. Manual offset calculation required
			 * @see: https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
			 */
			if ( $paged > 1 ) {
				$query_args['offset'] = ( ( $paged - 1 ) * intval( $args['posts_number'] ) ) + intval( $args['offset_number'] );
			} else {
				$query_args['offset'] = intval( $args['offset_number'] );
			}
		}

		if ( $is_single ) {
			$query_args['post__not_in'][] = get_the_ID();
		}

		$query_args['post_type'] = $args['post_type'];

		// Get query
		$query = new WP_Query( $query_args );
		// Keep page's $wp_query global
		$wp_query_page = $wp_query;

		// Turn page's $wp_query into this module's query
		$wp_query = $query; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

		ob_start();

		if ( $query->have_posts() ) {
			if ( 'on' !== $args['fullwidth'] ) {
				echo '<div class="et_pb_salvattore_content" data-columns>';
			}

			while( $query->have_posts() ) {
				$query->the_post();
				global $et_fb_processing_shortcode_object;

				$global_processing_original_value = $et_fb_processing_shortcode_object;

				// reset the fb processing flag
				$et_fb_processing_shortcode_object = false;

				$thumb          = '';
				$width          = 'on' === $args['fullwidth'] ? 1080 : 400;
				$width          = (int) apply_filters( 'et_pb_blog_image_width', $width );
				$height         = 'on' === $args['fullwidth'] ? 675 : 250;
				$height         = (int) apply_filters( 'et_pb_blog_image_height', $height );
				$classtext      = 'on' === $args['fullwidth'] ? 'et_pb_post_main_image' : '';
				$titletext      = get_the_title();
				$thumbnail      = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
				$thumb          = $thumbnail["thumb"];
				$no_thumb_class = '' === $thumb || 'off' === $args['show_thumbnail'] ? ' et_pb_no_thumb' : '';

				$post_format = et_pb_post_format();
				if ( in_array( $post_format, array( 'video', 'gallery' ) ) ) {
					$no_thumb_class = '';
				}

				// Print output
				?>
					<article id="" <?php post_class( 'et_pb_post clearfix' . $no_thumb_class . $overlay_class ) ?>>
						<?php
							et_divi_post_format_content();

							if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
								if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
									$video_overlay = has_post_thumbnail() ? sprintf(
										'<div class="et_pb_video_overlay" style="background-image: url(%1$s); background-size: cover;">
											<div class="et_pb_video_overlay_hover">
												<a href="#" class="et_pb_video_play"></a>
											</div>
										</div>',
										et_core_esc_previously( $thumb )
									) : '';

									printf(
										'<div class="et_main_video_container">
											%1$s
											%2$s
										</div>',
										et_core_esc_previously( $video_overlay ),
										et_core_esc_previously( $first_video )
									);
								elseif ( 'gallery' === $post_format ) :
									et_pb_gallery_images( 'slider' );
								elseif ( '' !== $thumb && 'on' === $args['show_thumbnail'] ) :
									if ( 'on' !== $args['fullwidth'] ) echo '<div class="et_pb_image_container">'; ?>
										<a href="<?php esc_url( the_permalink() ); ?>" class="entry-featured-image-url">
											<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
											<?php if ( 'on' === $args['use_overlay'] ) {
												echo et_core_esc_previously( $overlay_output );
											} ?>
										</a>
								<?php
									if ( 'on' !== $args['fullwidth'] ) echo '</div> <!-- .et_pb_image_container -->';
								endif;
							}
						?>

						<?php if ( 'off' === $args['fullwidth'] || ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) { ?>
							<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) { ?>
								<<?php echo et_core_esc_previously( $processed_header_level ); ?> class="entry-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></<?php echo et_core_esc_previously( $processed_header_level ); ?>>
							<?php } ?>

							<?php
								if ( 'on' === $args['show_author'] || 'on' === $args['show_date'] || 'on' === $args['show_categories'] || 'on' === $args['show_comments'] ) {
									$author = 'on' === $args['show_author']
										? et_get_safe_localization( sprintf( __( 'by %s', 'et_builder' ), '<span class="author vcard">' .  et_pb_get_the_author_posts_link() . '</span>' ) )
										: '';

									$author_separator = 'on' === $args['show_author'] && 'on' === $args['show_date']
										? ' | '
										: '';

									$date = 'on' === $args['show_date']
										? et_get_safe_localization( sprintf( __( '%s', 'et_builder' ), '<span class="published">' . esc_html( get_the_date( $args['meta_date'] ) ) . '</span>' ) )
										: '';

									$date_separator = (( 'on' === $args['show_author'] || 'on' === $args['show_date'] ) && 'on' === $args['show_categories'] )
										? ' | '
										: '';

									$categories = 'on' === $args['show_categories']
										? get_the_category_list(', ')
										: '';

									$categories_separator = (( 'on' === $args['show_author'] || 'on' === $args['show_date'] || 'on' === $args['show_categories'] ) && 'on' === $args['show_comments'])
										? ' | '
										: '';

									$comments = 'on' === $args['show_comments']
										? sprintf( esc_html( _nx( '%s Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder' ) ), number_format_i18n( get_comments_number() ) )
										: '';

									printf( '<p class="post-meta">%1$s %2$s %3$s %4$s %5$s %6$s %7$s</p>',
										et_core_esc_previously( $author ),
										et_core_intentionally_unescaped( $author_separator, 'fixed_string' ),
										et_core_esc_previously( $date ),
										et_core_intentionally_unescaped( $date_separator, 'fixed_string' ),
										et_core_esc_wp( $categories ),
										et_core_intentionally_unescaped( $categories_separator, 'fixed_string' ),
										et_core_esc_previously( $comments )
									);
								}

								$post_content = et_strip_shortcodes( et_delete_post_first_video( get_the_content() ), true );

								// reset the fb processing flag
								$et_fb_processing_shortcode_object = false;
								// set the flag to indicate that we're processing internal content
								$et_pb_rendering_column_content = true;
								// reset all the attributes required to properly generate the internal styles
								ET_Builder_Element::clean_internal_modules_styles();

								echo '<div class="post-content">';

								if ( 'on' === $args['show_content'] ) {
									global $more;

									// page builder doesn't support more tag, so display the_content() in case of post made with page builder
									if ( et_pb_is_pagebuilder_used( get_the_ID() ) ) {
										$more = 1; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

										echo et_core_intentionally_unescaped( apply_filters( 'the_content', $post_content ), 'html' );

									} else {
										$more = null; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
										echo et_core_intentionally_unescaped( apply_filters( 'the_content', et_delete_post_first_video( get_the_content( esc_html__( 'read more...', 'et_builder' ) ) ) ), 'html' );
									}
								} else {
									if ( has_excerpt() ) {
										the_excerpt();
									} else {
										if ( '' !== $post_content ) {
											// set the $et_fb_processing_shortcode_object to false, to retrieve the content inside truncate_post() correctly
											$et_fb_processing_shortcode_object = false;
											echo et_core_intentionally_unescaped( wpautop( et_delete_post_first_video( strip_shortcodes( truncate_post( 270, false, '', true ) ) ) ), 'html' );
											// reset the $et_fb_processing_shortcode_object to its original value
											$et_fb_processing_shortcode_object = $global_processing_original_value;
										} else {
											echo '';
										}
									}
								}

								$et_fb_processing_shortcode_object = $global_processing_original_value;
								// retrieve the styles for the modules inside Blog content
								$internal_style = ET_Builder_Element::get_style( true );
								// reset all the attributes after we retrieved styles
								ET_Builder_Element::clean_internal_modules_styles( false );
								$et_pb_rendering_column_content = false;
								// append styles to the blog content
								if ( $internal_style ) {
									printf(
										'<style type="text/css" class="et_fb_blog_inner_content_styles">
											%1$s
										</style>',
										et_core_esc_previously( $internal_style )
									);
								}

								echo '</div>';

								if ( 'on' !== $args['show_content'] ) {
									$more = 'on' === $args['show_more'] ? sprintf( ' <a href="%1$s" class="more-link" >%2$s</a>' , esc_url( get_permalink() ), esc_html__( 'read more', 'et_builder' ) )  : ''; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
									echo et_core_esc_previously( $more );
								}
								?>
						<?php } // 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote', 'gallery' ?>
					</article>
				<?php

				$et_fb_processing_shortcode_object = $global_processing_original_value;
			} // endwhile

			if ( 'on' !== $args['fullwidth'] ) {
				echo '</div>';
			}

			if ( 'on' === $args['show_pagination'] && ! $is_search ) {
				// echo '</div> <!-- .et_pb_posts -->'; // @todo this causes closing tag issue

				$container_is_closed = true;

				if ( function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi( array(
						'query' => $query
					) );
				} else {
					if ( $et_is_builder_plugin_active ) {
						include( ET_BUILDER_PLUGIN_DIR . 'includes/navigation.php' );
					} else {
						get_template_part( 'includes/navigation', 'index' );
					}
				}
			}

			wp_reset_query();
		}

		wp_reset_postdata();

		// Reset $wp_query to its origin
		$wp_query = $wp_query_page; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

		if ( ! $posts = ob_get_clean() ) {
			$posts = self::get_no_results_template();
		}

		return $posts;
	}

	function render( $attrs, $content = null, $render_slug ) {
		global $post;

		// Stored current global post as variable so global $post variable can be restored
		// to its original state when et_pb_blog shortcode ends to avoid incorrect global $post
		// being used on the page (i.e. blog + shop module in backend builder)
		$post_cache = $post;

		/**
		 * Cached $wp_filter so it can be restored at the end of the callback.
		 * This is needed because this callback uses the_content filter / calls a function
		 * which uses the_content filter. WordPress doesn't support nested filter
		 */
		global $wp_filter;
		$wp_filter_cache = $wp_filter;

		$fullwidth                           = $this->props['fullwidth'];
		$posts_number                        = $this->props['posts_number'];
		$post_type                      		 = $this->props['post_type'];
		$include_categories                  = $this->props['include_categories'];
		$meta_date                           = $this->props['meta_date'];
		$show_thumbnail                      = $this->props['show_thumbnail'];
		$show_content                        = $this->props['show_content'];
		$show_author                         = $this->props['show_author'];
		$show_date                           = $this->props['show_date'];
		$show_categories                     = $this->props['show_categories'];
		$show_comments                       = $this->props['show_comments'];
		$show_pagination                     = $this->props['show_pagination'];
		$background_layout                   = $this->props['background_layout'];
		$background_layout_hover             = et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
		$background_layout_hover_enabled     = et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
		$show_more                           = $this->props['show_more'];
		$offset_number                       = $this->props['offset_number'];
		$masonry_tile_background_color       = $this->props['masonry_tile_background_color'];
		$masonry_tile_background_color_hover = $this->get_hover_value( 'masonry_tile_background_color' );
		$overlay_icon_color                  = $this->props['overlay_icon_color'];
		$hover_overlay_color                 = $this->props['hover_overlay_color'];
		$hover_icon                          = $this->props['hover_icon'];
		$use_overlay                         = $this->props['use_overlay'];
		$header_level                        = $this->props['header_level'];

		global $paged;

		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$container_is_closed = false;

		$processed_header_level = et_pb_process_header_level( $header_level, 'h2' );

		// some themes do not include these styles/scripts so we need to enqueue them in this module to support audio post format
		wp_enqueue_style( 'wp-mediaelement' );
		wp_enqueue_script( 'wp-mediaelement' );

		// include easyPieChart which is required for loading Blog module content via ajax correctly
		wp_enqueue_script( 'easypiechart' );

		// include ET Shortcode scripts
		wp_enqueue_script( 'et-shortcodes-js' );

		// remove all filters from WP audio shortcode to make sure current theme doesn't add any elements into audio module
		remove_all_filters( 'wp_audio_shortcode_library' );
		remove_all_filters( 'wp_audio_shortcode' );
		remove_all_filters( 'wp_audio_shortcode_class' );

		if ( '' !== $masonry_tile_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_blog_grid .et_pb_post',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $masonry_tile_background_color )
				),
			) );
		}

		if ( et_builder_is_hover_enabled( 'masonry_tile_background_color', $this->props ) ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%%:hover .et_pb_blog_grid .et_pb_post',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $masonry_tile_background_color_hover )
				),
			) );
		}

		if ( '' !== $overlay_icon_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_overlay:before',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $overlay_icon_color )
				),
			) );
		}

		if ( '' !== $hover_overlay_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_overlay',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $hover_overlay_color )
				),
			) );
		}

		if ( 'on' === $use_overlay ) {
			$data_icon = '' !== $hover_icon
				? sprintf(
					' data-icon="%1$s"',
					esc_attr( et_pb_process_font_icon( $hover_icon ) )
				)
				: '';

			$overlay_output = sprintf(
				'<span class="et_overlay%1$s"%2$s></span>',
				( '' !== $hover_icon ? ' et_pb_inline_icon' : '' ),
				$data_icon
			);
		}

		$overlay_class = 'on' === $use_overlay ? ' et_pb_has_overlay' : '';

		if ( 'on' !== $fullwidth ){
			wp_enqueue_script( 'salvattore' );

			$background_layout = 'light';
		}

		$args = array( 'posts_per_page' => (int) $posts_number );

		$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

		if ( is_front_page() ) {
			$paged = $et_paged; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		}

		if ( '' !== $include_categories ) {
			$args['cat'] = implode( ',', self::filter_meta_categories( $include_categories, $this->get_the_ID() ) );
		}

		if ( ! is_search() ) {
			$args['paged'] = $et_paged;
		}

		if ( '' !== $offset_number && ! empty( $offset_number ) ) {
			/**
			 * Offset + pagination don't play well. Manual offset calculation required
			 * @see: https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
			 */
			if ( $paged > 1 ) {
				$args['offset'] = ( ( $et_paged - 1 ) * intval( $posts_number ) ) + intval( $offset_number );
			} else {
				$args['offset'] = intval( $offset_number );
			}
		}

		if ( is_single() && ! isset( $args['post__not_in'] ) ) {
			$args['post__not_in'] = array( get_the_ID() );
		}

		// Images: Add CSS Filters and Mix Blend Mode rules (if set)
		if ( array_key_exists( 'image', $this->advanced_fields ) && array_key_exists( 'css', $this->advanced_fields['image'] ) ) {
			$this->add_classname( $this->generate_css_filters(
				$render_slug,
				'child_',
				self::$data_utils->array_get( $this->advanced_fields['image']['css'], 'main', '%%order_class%%' )
			) );
		}

		$args['post_type'] = $post_type;
		ob_start();

		query_posts( $args );

		if ( have_posts() ) {
			if ( 'off' === $fullwidth ) {
				echo '<div class="et_pb_salvattore_content" data-columns>';
			}

			while ( have_posts() ) {
				the_post();

				global $post;

				$post_format = et_pb_post_format();

				$thumb = '';

				$width = 'on' === $fullwidth ? 1080 : 400;
				$width = (int) apply_filters( 'et_pb_blog_image_width', $width );

				$height = 'on' === $fullwidth ? 675 : 250;
				$height = (int) apply_filters( 'et_pb_blog_image_height', $height );
				$classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
				$titletext = get_the_title();
				$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
				$thumb = $thumbnail['thumb'];

				$no_thumb_class = '' === $thumb || 'off' === $show_thumbnail ? ' et_pb_no_thumb' : '';

				if ( in_array( $post_format, array( 'video', 'gallery' ) ) ) {
					$no_thumb_class = '';
				}
				?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post clearfix' . $no_thumb_class . $overlay_class  ); ?>>

			<?php
				et_divi_post_format_content();

				if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) || post_password_required( $post ) ) {
					if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
						$video_overlay = has_post_thumbnail() ? sprintf(
							'<div class="et_pb_video_overlay" style="background-image: url(%1$s); background-size: cover;">
								<div class="et_pb_video_overlay_hover">
									<a href="#" class="et_pb_video_play"></a>
								</div>
							</div>',
							$thumb
						) : '';

						printf(
							'<div class="et_main_video_container">
								%1$s
								%2$s
							</div>',
							et_core_esc_previously( $video_overlay ),
							et_core_esc_previously( $first_video )
						);
					elseif ( 'gallery' === $post_format ) :
						et_pb_gallery_images( 'slider' );
					elseif ( '' !== $thumb && 'on' === $show_thumbnail ) :
						if ( 'on' !== $fullwidth ) {
							echo '<div class="et_pb_image_container">';
						}
						?>
							<a href="<?php esc_url( the_permalink() ); ?>" class="entry-featured-image-url">
								<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
								<?php if ( 'on' === $use_overlay ) {
									echo et_core_esc_previously( $overlay_output );
								} ?>
							</a>
					<?php
						if ( 'on' !== $fullwidth ) echo '</div> <!-- .et_pb_image_container -->';
					endif;
				} ?>

			<?php if ( 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) || post_password_required( $post ) ) { ?>
				<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) || post_password_required( $post ) ) { ?>
					<<?php echo et_core_intentionally_unescaped( $processed_header_level, 'fixed_string' ); ?> class="entry-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></<?php echo et_core_intentionally_unescaped( $processed_header_level, 'fixed_string' ); ?>>
				<?php } ?>

				<?php
					if ( 'on' === $show_author || 'on' === $show_date || 'on' === $show_categories || 'on' === $show_comments ) {
						$author = 'on' === $show_author
							? et_get_safe_localization( sprintf( __( 'by %s', 'et_builder' ), '<span class="author vcard">' .  et_pb_get_the_author_posts_link() . '</span>' ) )
							: '';

						$author_separator = 'on' === $show_author && 'on' === $show_date
							? ' | '
							: '';

						$date = 'on' === $show_date
							? et_get_safe_localization( sprintf( __( '%s', 'et_builder' ), '<span class="published">' . esc_html( get_the_date( $meta_date ) ) . '</span>' ) )
							: '';

						$date_separator = (( 'on' === $show_author || 'on' === $show_date ) && 'on' === $show_categories )
							? ' | '
							: '';

						$categories = 'on' === $show_categories
							? get_the_category_list(', ')
							: '';

						$categories_separator = (( 'on' === $show_author || 'on' === $show_date || 'on' === $show_categories ) && 'on' === $show_comments)
							? ' | '
							: '';

						$comments = 'on' === $show_comments
							? sprintf( esc_html( _nx( '%s Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder' ) ), number_format_i18n( get_comments_number() ) )
							: '';

						printf( '<p class="post-meta">%1$s %2$s %3$s %4$s %5$s %6$s %7$s</p>',
							et_core_esc_previously( $author ),
							et_core_intentionally_unescaped( $author_separator, 'fixed_string' ),
							et_core_esc_previously( $date ),
							et_core_intentionally_unescaped( $date_separator, 'fixed_string' ),
							et_core_esc_wp( $categories ),
							et_core_intentionally_unescaped( $categories_separator, 'fixed_string' ),
							et_core_esc_previously( $comments )
						);
					}

					echo '<div class="post-content">';
					global $et_pb_rendering_column_content;

					$post_content = et_strip_shortcodes( et_delete_post_first_video( get_the_content() ), true );

					$et_pb_rendering_column_content = true;

					if ( 'on' === $show_content ) {
						global $more;

						// page builder doesn't support more tag, so display the_content() in case of post made with page builder
						if ( et_pb_is_pagebuilder_used( get_the_ID() ) ) {
							$more = 1; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
							echo et_core_intentionally_unescaped( apply_filters( 'the_content', $post_content ), 'html' );
						} else {
							$more = null; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
							echo et_core_intentionally_unescaped( apply_filters( 'the_content', et_delete_post_first_video( get_the_content( esc_html__( 'read more...', 'et_builder' ) ) ) ), 'html' );
						}
					} else {
						if ( has_excerpt() ) {
							the_excerpt();
						} else {
							echo et_core_intentionally_unescaped( wpautop( et_delete_post_first_video( strip_shortcodes( truncate_post( 270, false, '', true ) ) ) ), 'html' );
						}
					}

					$et_pb_rendering_column_content = false;

					if ( 'on' !== $show_content ) {
						$more = 'on' === $show_more ? sprintf( ' <a href="%1$s" class="more-link" >%2$s</a>' , esc_url( get_permalink() ), esc_html__( 'read more', 'et_builder' ) )  : ''; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
						echo et_core_esc_previously( $more );
					}

					echo '</div>';
					?>
			<?php } // 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote', 'gallery' ?>

			</article> <!-- .et_pb_post -->
	<?php
			} // endwhile

			if ( 'off' === $fullwidth ) {
 				echo '</div><!-- .et_pb_salvattore_content -->';
 			}

			if ( 'on' === $show_pagination && ! is_search() ) {
				if ( function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi();
				} else {
					if ( et_is_builder_plugin_active() ) {
						include( ET_BUILDER_PLUGIN_DIR . 'includes/navigation.php' );
					} else {
						get_template_part( 'includes/navigation', 'index' );
					}
				}

				echo '</div> <!-- .et_pb_posts -->';

				$container_is_closed = true;
			}
		} else {
			if ( et_is_builder_plugin_active() ) {
				include( ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php' );
			} else {
				get_template_part( 'includes/no-results', 'index' );
			}
		}

		wp_reset_query();

		$posts = ob_get_contents();

		ob_end_clean();

		// Remove automatically added classnames
		$this->remove_classname( array(
			$render_slug,
		) );

		$data_background_layout       = '';
		$data_background_layout_hover = '';

		if ( $background_layout_hover_enabled ) {
			$data_background_layout = sprintf(
				' data-background-layout="%1$s"',
				esc_attr( $background_layout )
			);
			$data_background_layout_hover = sprintf(
				' data-background-layout-hover="%1$s"',
				esc_attr( $background_layout_hover )
			);
		}

		if ( 'on' !== $fullwidth ) {
			// Module classname
			$this->add_classname( array(
				'et_pb_blog_grid_wrapper',
			) );

			// Remove auto-added classname for module wrapper because on grid mode these classnames
			// are placed one level below module wrapper
			$this->remove_classname( array(
				'et_pb_section_video',
				'et_pb_preload',
				'et_pb_section_parallax',
			) );

			// Inner module wrapper classname
			$inner_wrap_classname = array(
				'et_pb_blog_grid',
				'clearfix',
				"et_pb_bg_layout_{$background_layout}",
				$this->get_text_orientation_classname(),
			);

			if ( '' !== $video_background ) {
				$inner_wrap_classname[] = 'et_pb_section_video';
				$inner_wrap_classname[] = 'et_pb_preload';
			}

			if ( '' !== $parallax_image_background ) {
				$inner_wrap_classname[] = 'et_pb_section_parallax';
			}

			$output = sprintf(
				'<div%4$s class="%5$s"%9$s%10$s>
					<div class="%1$s">
					%7$s
					%6$s
					<div class="et_pb_ajax_pagination_container">
						%2$s
					</div>
					%3$s %8$s
				</div>',
				esc_attr( implode( ' ', $inner_wrap_classname ) ),
				$posts,
				( ! $container_is_closed ? '</div> <!-- .et_pb_posts -->' : '' ),
				$this->module_id(),
				$this->module_classname( $render_slug ), // #5
				$video_background,
				$parallax_image_background,
				$this->drop_shadow_back_compatibility( $render_slug ),
				et_core_esc_previously( $data_background_layout ),
				et_core_esc_previously( $data_background_layout_hover ) // #10
			);
		} else {
			// Module classname
			$this->add_classname( array(
				'et_pb_posts',
				"et_pb_bg_layout_{$background_layout}",
				$this->get_text_orientation_classname(),
			) );

			$output = sprintf(
				'<div%4$s class="%1$s"%8$s%9$s>
				%6$s
				%5$s
				<div class="et_pb_ajax_pagination_container">
					%2$s
				</div>
				%3$s %7$s',
				$this->module_classname( $render_slug ),
				$posts,
				( ! $container_is_closed ? '</div> <!-- .et_pb_posts -->' : '' ),
				$this->module_id(),
				$video_background, // #5
				$parallax_image_background,
				$this->drop_shadow_back_compatibility( $render_slug ),
				et_core_esc_previously( $data_background_layout ),
				et_core_esc_previously( $data_background_layout_hover )
			);
		}

		// Restore $wp_filter
		$wp_filter = $wp_filter_cache; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		unset($wp_filter_cache);

		// Restore global $post into its original state when et_pb_blog shortcode ends to avoid
		// the rest of the page uses incorrect global $post variable
		$post = $post_cache; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

		return $output;
	}

	public function process_box_shadow( $function_name ) {
		if ( isset( $this->props['fullwidth'] ) && $this->props['fullwidth'] === 'off' ) {
			$this->advanced_fields['box_shadow'] = array(
				'default' => array(
					'css' => array(
						'main'         => '%%order_class%% article.et_pb_post',
						'overlay'      => "inset",
					),
				),
			);
		}

		parent::process_box_shadow( $function_name );
	}

	/**
	 * Since the styling file is not updated until the author updates the page/post,
	 * we should keep the drop shadow visible.
	 *
	 * @param string $functions_name
	 *
	 * @return string
	 */
	private function drop_shadow_back_compatibility( $functions_name ) {
		$utils = ET_Core_Data_Utils::instance();
		$atts  = $this->props;

		if (
			version_compare( $utils->array_get( $atts, '_builder_version', '3.0.93' ), '3.0.94', 'lt' )
			&&
			'on' !== $utils->array_get( $atts, 'fullwidth' )
			&&
			'on' === $utils->array_get( $atts, 'use_dropshadow' )
		) {
			$class = self::get_module_order_class( $functions_name );

			return sprintf(
				'<style>%1$s</style>',
				sprintf( '.%1$s  article.et_pb_post { box-shadow: 0 1px 5px rgba(0,0,0,.1) }', esc_html( $class ) )
			);
		}

		return '';
	}
}

new ET_Builder_Module_Custom_Post;
