<?php 

/* 
* Basically a custom post type module for 
*/

class CustomPost_Module_Blog extends ET_Builder_Module {
	function init() {
		$this->name       = esc_html__( 'Custom Post', 'et_builder' );
		$this->slug       = 'et_pb_custom_posts';
		$this->fb_support = true;

		$this->whitelisted_fields = array(
			'fullwidth',
			'posts_number',
			'post_type',
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
			'background_layout',
			'admin_label',
			'module_id',
			'module_class',
			'masonry_tile_background_color',
			'use_dropshadow',
			'use_overlay',
			'overlay_icon_color',
			'hover_overlay_color',
			'hover_icon',
		);

		$this->fields_defaults = array(
			'fullwidth'         => array( 'on' ),
			'posts_number'      => array( 10, 'add_default_setting' ),
			'posts_type'      => array( 'post', 'add_default_setting' ),
			'meta_date'         => array( 'M j, Y', 'add_default_setting' ),
			'show_thumbnail'    => array( 'on' ),
			'show_content'      => array( 'off' ),
			'show_more'         => array( 'off' ),
			'show_author'       => array( 'on' ),
			'show_date'         => array( 'on' ),
			'show_categories'   => array( 'on' ),
			'show_comments'     => array( 'off' ),
			'show_pagination'   => array( 'on' ),
			'offset_number'     => array( 0, 'only_default_setting' ),
			'background_layout' => array( 'light' ),
			'use_dropshadow'    => array( 'off' ),
			'use_overlay'       => array( 'off' ),
		);

		$this->main_css_element = '%%order_class%% .et_pb_post';
		$this->advanced_options = array(
			'fonts' => array(
				'header' => array(
					'label'    => esc_html__( 'Header', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .entry-title",
						'plugin_main' => "{$this->main_css_element} .entry-title, {$this->main_css_element} .entry-title a",
						'important' => 'all',
					),
				),
				'meta' => array(
					'label'    => esc_html__( 'Meta', 'et_builder' ),
					'css'      => array(
						'main'        => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a",
						'plugin_main' => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a, {$this->main_css_element} .post-meta span",
					),
				),
				'body'   => array(
					'label'    => esc_html__( 'Body', 'et_builder' ),
					'css'      => array(
						'main'        => "{$this->main_css_element}, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content p",
						'color'       => "{$this->main_css_element}, {$this->main_css_element} .post-content *",
						'line_height' => "{$this->main_css_element} p",
						'plugin_main' => "{$this->main_css_element}, %%order_class%%.et_pb_bg_layout_light .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_dark .et_pb_post .post-content p, %%order_class%%.et_pb_bg_layout_light .et_pb_post a.more-link, %%order_class%%.et_pb_bg_layout_dark .et_pb_post a.more-link",
					),
				),
			),
			'border' => array(
				'css'      => array(
					'main' => "%%order_class%%.et_pb_module .et_pb_post",
					'important' => 'plugin_only',
				),
			),
		);
		$this->custom_css_options = array(
			'title' => array(
				'label'    => esc_html__( 'Title', 'et_builder' ),
				'selector' => '.et_pb_post .entry-title',
			),
			'post_meta' => array(
				'label'    => esc_html__( 'Post Meta', 'et_builder' ),
				'selector' => '.et_pb_post .post-meta',
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
				'selector' => '.et_pb_post .more-link',
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
					'use_dropshadow',
					'masonry_tile_background_color',
				),
				'description'        => esc_html__( 'Toggle between the various blog layout types.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
			),
			'post_type' => array(
				'label'             => esc_html__( 'Post Type', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose a custom post type you would like to get.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
			),
			'posts_number' => array(
				'label'             => esc_html__( 'Posts Number', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose how much posts you would like to display per page.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
			),
			'include_categories' => array(
				'label'            => esc_html__( 'Include Categories', 'et_builder' ),
				'renderer'         => 'et_builder_include_categories_option',
				'option_category'  => 'basic_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => esc_html__( 'Choose which categories you would like to include in the feed.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
			),
			'meta_date' => array(
				'label'             => esc_html__( 'Meta Date Format', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
			),
			'show_thumbnail' => array(
				'label'             => esc_html__( 'Show Featured Image', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'description'        => esc_html__( 'This will turn thumbnails on and off.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
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
				'description'        => esc_html__( 'Showing the full content will not truncate your posts on the index page. Showing the excerpt will only display your excerpt text.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
			),
			'show_more' => array(
				'label'             => esc_html__( 'Read More Button', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( 'Off', 'et_builder' ),
					'on'  => esc_html__( 'On', 'et_builder' ),
				),
				'depends_show_if'   => 'off',
				'description'       => esc_html__( 'Here you can define whether to show "read more" link after the excerpts or not.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
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
			),
			'offset_number' => array(
				'label'           => esc_html__( 'Offset Number', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'Choose how many posts you would like to offset by', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
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
			),
			'overlay_icon_color' => array(
				'label'             => esc_html__( 'Overlay Icon Color', 'et_builder' ),
				'type'              => 'color',
				'custom_color'      => true,
				'depends_show_if'   => 'on',
				'description'       => esc_html__( 'Here you can define a custom color for the overlay icon', 'et_builder' ),
			),
			'hover_overlay_color' => array(
				'label'             => esc_html__( 'Hover Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'depends_show_if'   => 'on',
				'description'       => esc_html__( 'Here you can define a custom color for the overlay', 'et_builder' ),
			),
			'hover_icon' => array(
				'label'               => esc_html__( 'Hover Icon Picker', 'et_builder' ),
				'type'                => 'text',
				'option_category'     => 'configuration',
				'class'               => array( 'et-pb-font-icon' ),
				'renderer'            => 'et_pb_get_font_icon_list',
				'renderer_with_field' => true,
				'depends_show_if'     => 'on',
				'description'         => esc_html__( 'Here you can define a custom icon for the overlay', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
			),
			'background_layout' => array(
				'label'       => esc_html__( 'Text Color', 'et_builder' ),
				'type'        => 'select',
				'option_category' => 'color_option',
				'options'           => array(
					'light' => esc_html__( 'Dark', 'et_builder' ),
					'dark'  => esc_html__( 'Light', 'et_builder' ),
				),
				'depends_default' => true,
				'description' => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),
			),
			'masonry_tile_background_color' => array(
				'label'             => esc_html__( 'Grid Tile Background Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'depends_show_if'   => 'off',
				'depends_to'        => array(
					'fullwidth'
				),
			),
			'use_dropshadow' => array(
				'label'             => esc_html__( 'Use Dropshadow', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'layout',
				'options'           => array(
					'off' => esc_html__( 'Off', 'et_builder' ),
					'on'  => esc_html__( 'On', 'et_builder' ),
				),
				'tab_slug'          => 'advanced',
				'depends_show_if'   => 'off',
				'depends_to'        => array(
					'fullwidth'
				),
			),
			'disabled_on' => array(
				'label'           => esc_html__( 'Disable on', 'et_builder' ),
				'type'            => 'multiple_checkboxes',
				'options'         => array(
					'phone'   => esc_html__( 'Phone', 'et_builder' ),
					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),
					'desktop' => esc_html__( 'Desktop', 'et_builder' ),
				),
				'additional_att'  => 'disable_on',
				'option_category' => 'configuration',
				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),
			),
			'admin_label' => array(
				'label'       => esc_html__( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'module_id' => array(
				'label'           => esc_html__( 'CSS ID', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
			),
			'module_class' => array(
				'label'           => esc_html__( 'CSS Class', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'tab_slug'        => 'custom_css',
				'option_class'    => 'et_pb_custom_css_regular',
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
				),
			),
		);
		return $fields;
	}


	function shortcode_callback( $atts, $content = null, $function_name ) {
		/**
		 * Cached $wp_filter so it can be restored at the end of the callback.
		 * This is needed because this callback uses the_content filter / calls a function
		 * which uses the_content filter. WordPress doesn't support nested filter
		 */
		global $wp_filter;
		$wp_filter_cache = $wp_filter;

		$module_id           = $this->shortcode_atts['module_id'];
		$module_class        = $this->shortcode_atts['module_class'];
		$fullwidth           = $this->shortcode_atts['fullwidth'];
		$posts_number        = $this->shortcode_atts['posts_number'];
		$post_type 			 = $this->shortcode_atts['post_type'];
		$include_categories  = $this->shortcode_atts['include_categories'];
		$meta_date           = $this->shortcode_atts['meta_date'];
		$show_thumbnail      = $this->shortcode_atts['show_thumbnail'];
		$show_content        = $this->shortcode_atts['show_content'];
		$show_author         = $this->shortcode_atts['show_author'];
		$show_date           = $this->shortcode_atts['show_date'];
		$show_categories     = $this->shortcode_atts['show_categories'];
		$show_comments       = $this->shortcode_atts['show_comments'];
		$show_pagination     = $this->shortcode_atts['show_pagination'];
		$background_layout   = $this->shortcode_atts['background_layout'];
		$show_more           = $this->shortcode_atts['show_more'];
		$offset_number       = $this->shortcode_atts['offset_number'];
		$masonry_tile_background_color = $this->shortcode_atts['masonry_tile_background_color'];
		$use_dropshadow      = $this->shortcode_atts['use_dropshadow'];
		$overlay_icon_color  = $this->shortcode_atts['overlay_icon_color'];
		$hover_overlay_color = $this->shortcode_atts['hover_overlay_color'];
		$hover_icon          = $this->shortcode_atts['hover_icon'];
		$use_overlay         = $this->shortcode_atts['use_overlay'];

		global $paged;

		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );

		$container_is_closed = false;

		// remove all filters from WP audio shortcode to make sure current theme doesn't add any elements into audio module
		remove_all_filters( 'wp_audio_shortcode_library' );
		remove_all_filters( 'wp_audio_shortcode' );
		remove_all_filters( 'wp_audio_shortcode_class');

		if ( '' !== $masonry_tile_background_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%%.et_pb_blog_grid .et_pb_post',
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $masonry_tile_background_color )
				),
			) );
		}

		if ( '' !== $overlay_icon_color ) {
			ET_Builder_Element::set_style( $function_name, array(
				'selector'    => '%%order_class%% .et_overlay:before',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $overlay_icon_color )
				),
			) );
		}

		if ( '' !== $hover_overlay_color ) {
			ET_Builder_Element::set_style( $function_name, array(
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
			if ( 'on' === $use_dropshadow ) {
				$module_class .= ' et_pb_blog_grid_dropshadow';
			}

			wp_enqueue_script( 'salvattore' );

			$background_layout = 'light';
		}

		$args = array( 'posts_per_page' => (int) $posts_number );

		$et_paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

		if ( is_front_page() ) {
			$paged = $et_paged;
		}

		if ( '' !== $include_categories )
			$args['cat'] = $include_categories;

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


		
		ob_start();
		$args['post_type'] = $post_type;
		query_posts( $args );

		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();

				$post_format = et_pb_post_format();

				$thumb = '';

				$width = 'on' === $fullwidth ? 1080 : 400;
				$width = (int) apply_filters( 'et_pb_blog_image_width', $width );

				$height = 'on' === $fullwidth ? 675 : 250;
				$height = (int) apply_filters( 'et_pb_blog_image_height', $height );
				$classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
				$titletext = get_the_title();
				$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
				$thumb = $thumbnail["thumb"];

				$no_thumb_class = '' === $thumb || 'off' === $show_thumbnail ? ' et_pb_no_thumb' : '';

				if ( in_array( $post_format, array( 'video', 'gallery' ) ) ) {
					$no_thumb_class = '';
				} ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post clearfix' . $no_thumb_class . $overlay_class  ); ?>>

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
							$thumb
						) : '';

						printf(
							'<div class="et_main_video_container">
								%1$s
								%2$s
							</div>',
							$video_overlay,
							$first_video
						);
					elseif ( 'gallery' === $post_format ) :
						et_pb_gallery_images( 'slider' );
					elseif ( '' !== $thumb && 'on' === $show_thumbnail ) :
						if ( 'on' !== $fullwidth ) echo '<div class="et_pb_image_container">'; ?>
							<a href="<?php esc_url( the_permalink() ); ?>" class="entry-featured-image-url">
								<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
								<?php if ( 'on' === $use_overlay ) {
									echo $overlay_output;
								} ?>
							</a>
					<?php
						if ( 'on' !== $fullwidth ) echo '</div> <!-- .et_pb_image_container -->';
					endif;
				} ?>

			<?php if ( 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) { ?>
				<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) { ?>
					<h2 class="entry-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2>
				<?php } ?>

				<?php
					if ( 'on' === $show_author || 'on' === $show_date || 'on' === $show_categories || 'on' === $show_comments ) {
						printf( '<p class="post-meta">%1$s %2$s %3$s %4$s %5$s %6$s %7$s</p>',
							(
								'on' === $show_author
									? et_get_safe_localization( sprintf( __( 'by %s', 'et_builder' ), '<span class="author vcard">' .  et_pb_get_the_author_posts_link() . '</span>' ) )
									: ''
							),
							(
								( 'on' === $show_author && 'on' === $show_date )
									? ' | '
									: ''
							),
							(
								'on' === $show_date
									? et_get_safe_localization( sprintf( __( '%s', 'et_builder' ), '<span class="published">' . esc_html( get_the_date( $meta_date ) ) . '</span>' ) )
									: ''
							),
							(
								(( 'on' === $show_author || 'on' === $show_date ) && 'on' === $show_categories)
									? ' | '
									: ''
							),
							(
								'on' === $show_categories
									? get_the_category_list(', ')
									: ''
							),
							(
								(( 'on' === $show_author || 'on' === $show_date || 'on' === $show_categories ) && 'on' === $show_comments)
									? ' | '
									: ''
							),
							(
								'on' === $show_comments
									? sprintf( esc_html( _nx( '1 Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder' ) ), number_format_i18n( get_comments_number() ) )
									: ''
							)
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
							$more = 1;
							echo apply_filters( 'the_content', $post_content );
						} else {
							$more = null;
							echo apply_filters( 'the_content', et_delete_post_first_video( get_the_content( esc_html__( 'read more...', 'et_builder' ) ) ) );
						}
					} else {
						if ( has_excerpt() ) {
							the_excerpt();
						} else {
							echo wpautop( et_delete_post_first_video( strip_shortcodes( truncate_post( 270, false, '', true ) ) ) );
						}
					}

					$et_pb_rendering_column_content = false;

					if ( 'on' !== $show_content ) {
						$more = 'on' == $show_more ? sprintf( ' <a href="%1$s" class="more-link" >%2$s</a>' , esc_url( get_permalink() ), esc_html__( 'read more', 'et_builder' ) )  : '';
						echo $more;
					}

					echo '</div>';
					?>
			<?php } // 'off' === $fullwidth || ! in_array( $post_format, array( 'link', 'audio', 'quote', 'gallery' ?>

			</article> <!-- .et_pb_post -->
	<?php
			} // endwhile

			if ( 'on' === $show_pagination && ! is_search() ) {
				echo '</div> <!-- .et_pb_posts -->';

				$container_is_closed = true;

				if ( function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi();
				} else {
					if ( et_is_builder_plugin_active() ) {
						include( ET_BUILDER_PLUGIN_DIR . 'includes/navigation.php' );
					} else {
						get_template_part( 'includes/navigation', 'index' );
					}
				}
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

		$class = " et_pb_module et_pb_bg_layout_{$background_layout}";

		$output = sprintf(
			'<div%5$s class="%1$s%3$s%6$s"%7$s>
				%2$s
			%4$s',
			( 'on' === $fullwidth ? 'et_pb_posts' : 'et_pb_blog_grid clearfix' ),
			$posts,
			esc_attr( $class ),
			( ! $container_is_closed ? '</div> <!-- .et_pb_posts -->' : '' ),
			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' ),
			( 'on' !== $fullwidth ? ' data-columns' : '' )
		);

		if ( 'on' !== $fullwidth )
			$output = sprintf( '<div class="et_pb_blog_grid_wrapper">%1$s</div>', $output );

		// Restore $wp_filter
		$wp_filter = $wp_filter_cache;
		unset($wp_filter_cache);

		return $output;
	}
}
new CustomPost_Module_Blog;
