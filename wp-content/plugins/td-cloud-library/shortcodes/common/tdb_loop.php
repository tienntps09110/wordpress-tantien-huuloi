<?php

/**
 * Class tdb_loop - this works on all wp templates pages that have a loop 
 */

class tdb_loop extends td_block {

    static function cssMedia( $res_ctx ) {

        // container_width
        $container_width = $res_ctx->get_shortcode_att('container_width');
        if ( is_numeric( $container_width ) ) {
            $res_ctx->load_settings_raw( 'container_width', $container_width . '%' );
        } else {
            $res_ctx->load_settings_raw( 'container_width', $container_width );
        }

        // image_height
        $image_height = $res_ctx->get_shortcode_att('image_height');
        if ( is_numeric( $image_height ) ) {
            $res_ctx->load_settings_raw( 'image_height', $image_height . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_height', $image_height );
        }

        // image_width
        $image_width = $res_ctx->get_shortcode_att('image_width');
        if ( is_numeric( $image_width ) ) {
            $res_ctx->load_settings_raw( 'image_width', $image_width . '%' );
        } else {
            $res_ctx->load_settings_raw( 'image_width', $image_width );
        }

        // image_floated
        $image_floated = $res_ctx->get_shortcode_att('image_floated');
        if ( $image_floated == '' ||  $image_floated == 'no_float' ) {
            $image_floated = 'no_float';
            $res_ctx->load_settings_raw( 'no_float',  1 );
        }
        if ( $image_floated == 'float_left' ) {
            $res_ctx->load_settings_raw( 'float_left',  1 );
        }
        if ( $image_floated == 'float_right' ) {
            $res_ctx->load_settings_raw( 'float_right',  1 );
        }
        if ( $image_floated == 'hidden' ) {
            if ( $res_ctx->is( 'all' ) && !$res_ctx->is_responsive_att( 'image_floated' ) ) {
                $res_ctx->load_settings_raw( 'hide_desktop',  1 );
            } else {
                $res_ctx->load_settings_raw( 'hide',  1 );
            }
        }

        // meta info width
        $meta_info_width = $res_ctx->get_shortcode_att('meta_width');
        $res_ctx->load_settings_raw( 'meta_width', $meta_info_width );
        if( $meta_info_width != '' && is_numeric( $meta_info_width ) ) {
            $res_ctx->load_settings_raw( 'meta_width', $meta_info_width . 'px' );
        }
        // meta info margin
        $meta_margin = $res_ctx->get_shortcode_att('meta_margin');
        $res_ctx->load_settings_raw( 'meta_margin', $meta_margin );
        if ( is_numeric( $meta_margin ) ) {
            $res_ctx->load_settings_raw( 'meta_margin', $meta_margin . 'px' );
        }
        // meta info padding
        $meta_padding = $res_ctx->get_shortcode_att('meta_padding');
        $res_ctx->load_settings_raw( 'meta_padding', $meta_padding );
        if ( is_numeric( $meta_padding ) ) {
            $res_ctx->load_settings_raw( 'meta_padding', $meta_padding . 'px' );
        }

        // meta info align
        $meta_info_align = $res_ctx->get_shortcode_att('meta_info_align');
        $res_ctx->load_settings_raw( 'meta_info_align', $meta_info_align );
        // meta info align to fix top when no float is selected
        if ( $meta_info_align == 'initial' && $image_floated == 'no_float' ) {
            $res_ctx->load_settings_raw( 'meta_info_align_top',  1 );
        }
        // meta info align top/bottom - align category
        if ( $meta_info_align == 'initial' ) {
            $res_ctx->load_settings_raw( 'align_category_top',  1 );
        }
        if ( $meta_info_align == 'flex-end'  && $image_floated == 'no_float' ) {
            $res_ctx->load_settings_raw( 'align_category_bottom',  1 );
        }

        // meta_info_border_size
        $meta_info_border_size = $res_ctx->get_shortcode_att('meta_info_border_size');
        $res_ctx->load_settings_raw( 'meta_info_border_size', $meta_info_border_size );
        if ( is_numeric( $meta_info_border_size ) ) {
            $res_ctx->load_settings_raw( 'meta_info_border_size', $meta_info_border_size . 'px' );
        }
        // meta info border style
        $res_ctx->load_settings_raw( 'meta_info_border_style', $res_ctx->get_shortcode_att('meta_info_border_style') );
        // meta info border color
        $res_ctx->load_settings_raw( 'meta_info_border_color', $res_ctx->get_shortcode_att('meta_info_border_color') );

        // modules per row
        $modules_on_row = $res_ctx->get_shortcode_att('modules_on_row');
        $res_ctx->load_settings_raw( 'modules_on_row', $modules_on_row );
        if ( $modules_on_row == '' ) {
            $modules_on_row = '100%';
        }

        // modules space
        $modules_space = $res_ctx->get_shortcode_att('all_modules_space');
        $res_ctx->load_settings_raw( 'all_modules_space', $modules_space );
        if ( $modules_space == '' ) {
            $res_ctx->load_settings_raw( 'all_modules_space', '18px');
        } else if ( is_numeric( $modules_space ) ) {
            $res_ctx->load_settings_raw( 'all_modules_space', $modules_space / 2 .'px' );
        }

        // modules clearfix
        $clearfix = 'clearfix';
        $padding = 'padding';
        if ( $res_ctx->is( 'all' ) ) {
            $clearfix = 'clearfix_desktop';
            $padding = 'padding_desktop';
        }
        switch ($modules_on_row) {
            case '100%':
                $res_ctx->load_settings_raw( $padding,  '1' );
                break;
            case '50%':
                $res_ctx->load_settings_raw( $clearfix,  '2n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+2' );
                break;
            case '33.33333333%':
                $res_ctx->load_settings_raw( $clearfix,  '3n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+3' );
                break;
            case '25%':
                $res_ctx->load_settings_raw( $clearfix,  '4n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+4' );
                break;
            case '20%':
                $res_ctx->load_settings_raw( $clearfix,  '5n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+5' );
                break;
            case '16.66666667%':
                $res_ctx->load_settings_raw( $clearfix,  '6n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+6' );
                break;
            case '14.28571428%':
                $res_ctx->load_settings_raw( $clearfix,  '7n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+7' );
                break;
            case '12.5%':
                $res_ctx->load_settings_raw( $clearfix,  '8n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+8' );
                break;
            case '11.11111111%':
                $res_ctx->load_settings_raw( $clearfix,  '9n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+9' );
                break;
            case '10%':
                $res_ctx->load_settings_raw( $clearfix,  '10n+1' );
                $res_ctx->load_settings_raw( $padding,  '-n+10' );
                break;
        }

        // modules gap
        $modules_gap = $res_ctx->get_shortcode_att('modules_gap');
        $res_ctx->load_settings_raw( 'modules_gap', $modules_gap );
        if ( $modules_gap == '' ) {
            $res_ctx->load_settings_raw( 'modules_gap', '24px');
        } else if ( is_numeric( $modules_gap ) ) {
            $res_ctx->load_settings_raw( 'modules_gap', $modules_gap / 2 .'px' );
        }
        // modules padding
        $m_padding = $res_ctx->get_shortcode_att('m_padding');
        $res_ctx->load_settings_raw( 'm_padding', $m_padding );
        if ( is_numeric( $m_padding ) ) {
            $res_ctx->load_settings_raw( 'm_padding', $m_padding . 'px' );
        }
        // modules radius
        $m_radius = $res_ctx->get_shortcode_att('m_radius');
        $res_ctx->load_settings_raw( 'm_radius', $m_radius );
        if ( is_numeric( $m_radius ) ) {
            $res_ctx->load_settings_raw( 'm_radius', $m_radius . 'px' );
        }

        // modules divider
        $res_ctx->load_settings_raw( 'modules_divider', $res_ctx->get_shortcode_att('modules_divider') );
        // modules divider color
        $res_ctx->load_settings_raw( 'modules_divider_color', $res_ctx->get_shortcode_att('modules_divider_color') );

        // image radius
        $image_radius = $res_ctx->get_shortcode_att('image_radius');
        $res_ctx->load_settings_raw( 'image_radius', $image_radius );
        if ( is_numeric( $image_radius ) ) {
            $res_ctx->load_settings_raw( 'image_radius', $image_radius . 'px' );
        }

        // meta info horizontal align
        $content_align = $res_ctx->get_shortcode_att('meta_info_horiz');
        if ( $content_align == 'content-horiz-center' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_center', 1 );
        } else if ( $content_align == 'content-horiz-right' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_right', 1 );
        } else if ( $content_align == 'content-horiz-left' ) {
            $res_ctx->load_settings_raw( 'meta_horiz_align_left', 1 );
        }

        // article title space
        $art_title = $res_ctx->get_shortcode_att('art_title');
        $res_ctx->load_settings_raw( 'art_title', $art_title );
        if ( is_numeric( $art_title ) ) {
            $res_ctx->load_settings_raw( 'art_title', $art_title . 'px' );
        }
        // article excerpt space
        $art_excerpt = $res_ctx->get_shortcode_att('art_excerpt');
        $res_ctx->load_settings_raw( 'art_excerpt', $art_excerpt );
        if ( is_numeric( $art_excerpt ) ) {
            $res_ctx->load_settings_raw( 'art_excerpt', $art_excerpt . 'px' );
        }
        // article excerpt columns
        $excerpt_col = $res_ctx->get_shortcode_att('excerpt_col');
        $res_ctx->load_settings_raw( 'excerpt_col', $excerpt_col );
        if ( $excerpt_col == '' ) {
            $res_ctx->load_settings_raw( 'excerpt_col', '1' );
        }
        // article excerpt space
        $excerpt_gap = $res_ctx->get_shortcode_att('excerpt_gap');
        $res_ctx->load_settings_raw( 'excerpt_gap', $excerpt_gap );
        if( $excerpt_gap != '' ) {
            if ( is_numeric( $excerpt_gap ) ) {
                $res_ctx->load_settings_raw( 'excerpt_gap', $excerpt_gap . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'excerpt_gap', '48px' );
        }
        // article button space
        $art_btn = $res_ctx->get_shortcode_att('art_btn');
        $res_ctx->load_settings_raw( 'art_btn', $art_btn );
        if ( is_numeric( $art_btn ) ) {
            $res_ctx->load_settings_raw( 'art_btn', $art_btn . 'px' );
        }

        // category tag space
        $modules_category_margin = $res_ctx->get_shortcode_att('modules_category_margin');
        $res_ctx->load_settings_raw( 'modules_category_margin', $modules_category_margin );
        if( $modules_category_margin != '' && is_numeric( $modules_category_margin ) ) {
            $res_ctx->load_settings_raw( 'modules_category_margin', $modules_category_margin . 'px' );
        }
        // category tag padding
        $modules_category_padding = $res_ctx->get_shortcode_att('modules_category_padding');
        $res_ctx->load_settings_raw( 'modules_category_padding', $modules_category_padding );
        if( $modules_category_padding != '' && is_numeric( $modules_category_padding ) ) {
            $res_ctx->load_settings_raw( 'modules_category_padding', $modules_category_padding . 'px' );
        }
        //category tag radius
        $modules_category_radius = $res_ctx->get_shortcode_att('modules_category_radius');
        if ( $modules_category_radius != 0 || !empty($modules_category_radius) ) {
            $res_ctx->load_settings_raw( 'modules_category_radius', $modules_category_radius . 'px' );
        }

        // author photo size
        $author_photo_size = $res_ctx->get_shortcode_att('author_photo_size');
        $res_ctx->load_settings_raw( 'author_photo_size', '20px' );
        if( $author_photo_size != '' && is_numeric( $author_photo_size ) ) {
            $res_ctx->load_settings_raw( 'author_photo_size', $author_photo_size . 'px' );
        }
        // author photo space
        $author_photo_space = $res_ctx->get_shortcode_att('author_photo_space');
        $res_ctx->load_settings_raw( 'author_photo_space', '6px' );
        if( $author_photo_space != '' && is_numeric( $author_photo_space ) ) {
            $res_ctx->load_settings_raw( 'author_photo_space', $author_photo_space . 'px' );
        }
        // author photo radius
        $author_photo_radius = $res_ctx->get_shortcode_att('author_photo_radius');
        $res_ctx->load_settings_raw( 'author_photo_radius', $author_photo_radius );
        if( $author_photo_radius != '' ) {
            if( is_numeric( $author_photo_radius ) ) {
                $res_ctx->load_settings_raw( 'author_photo_radius', $author_photo_radius . 'px' );
            }
        } else {
            $res_ctx->load_settings_raw( 'author_photo_radius', '50%' );
        }


        // show meta info details
        $res_ctx->load_settings_raw( 'show_cat', $res_ctx->get_shortcode_att('show_cat') );
        $res_ctx->load_settings_raw( 'show_excerpt', $res_ctx->get_shortcode_att('show_excerpt') );
        $res_ctx->load_settings_raw( 'show_btn', $res_ctx->get_shortcode_att('show_btn') );
        // button space
        $btn_margin = $res_ctx->get_shortcode_att('btn_margin');
        $res_ctx->load_settings_raw( 'btn_margin', $btn_margin );
        if( $btn_margin != '' && is_numeric( $btn_margin ) ) {
            $res_ctx->load_settings_raw( 'btn_margin', $btn_margin . 'px' );
        }
        // button padding
        $btn_padding = $res_ctx->get_shortcode_att('btn_padding');
        $res_ctx->load_settings_raw( 'btn_padding', $btn_padding );
        if( $btn_padding != '' && is_numeric( $btn_padding ) ) {
            $res_ctx->load_settings_raw( 'btn_padding', $btn_padding . 'px' );
        }
        // button border
        $btn_border_width = $res_ctx->get_shortcode_att('btn_border_width');
        $res_ctx->load_settings_raw( 'btn_border_width', $btn_border_width );
        if( $btn_border_width != '' && is_numeric( $btn_border_width ) ) {
            $res_ctx->load_settings_raw( 'btn_border_width', $btn_border_width . 'px' );
        }
        // btn_radius
        $btn_radius = $res_ctx->get_shortcode_att('btn_radius');
        $res_ctx->load_settings_raw( 'btn_radius', $btn_radius );
        if( $btn_radius != '' && is_numeric( $btn_radius ) ) {
            $res_ctx->load_settings_raw( 'btn_radius', $btn_radius . 'px' );
        }
        // pagination space
        $pag_space = $res_ctx->get_shortcode_att('pag_space');
        $res_ctx->load_settings_raw( 'pag_space', $pag_space );
        if( $pag_space != '' && is_numeric( $pag_space ) ) {
            $res_ctx->load_settings_raw( 'pag_space', $pag_space . 'px' );
        }

        // show meta info details
        $show_author = $res_ctx->get_shortcode_att('show_author');
        $show_date = $res_ctx->get_shortcode_att('show_date');
        $show_review = $res_ctx->get_shortcode_att('show_review');
        $show_com = $res_ctx->get_shortcode_att('show_com');
        if( $show_author == 'none' && $show_date == 'none' && $show_com == 'none' && $show_review == 'none' ) {
            $res_ctx->load_settings_raw( 'hide_author_date', 1 );
        }
        $res_ctx->load_settings_raw( 'show_author', $show_author );
        $res_ctx->load_settings_raw( 'show_date', $show_date );
        $res_ctx->load_settings_raw( 'show_review', $show_review );
        $res_ctx->load_settings_raw( 'show_com', $show_com );

        // colors
        $res_ctx->load_settings_raw( 'm_bg', $res_ctx->get_shortcode_att('m_bg') );
        $res_ctx->load_settings_raw( 'meta_bg', $res_ctx->get_shortcode_att('meta_bg') );
        $res_ctx->load_settings_raw( 'cat_bg', $res_ctx->get_shortcode_att('cat_bg') );
        $res_ctx->load_settings_raw( 'cat_txt', $res_ctx->get_shortcode_att('cat_txt') );
        $res_ctx->load_settings_raw( 'cat_bg_hover', $res_ctx->get_shortcode_att('cat_bg_hover') );
        $res_ctx->load_settings_raw( 'cat_txt_hover', $res_ctx->get_shortcode_att('cat_txt_hover') );
        $res_ctx->load_settings_raw( 'title_txt', $res_ctx->get_shortcode_att('title_txt') );
        $res_ctx->load_settings_raw( 'title_txt_hover', $res_ctx->get_shortcode_att('title_txt_hover') );
        $res_ctx->load_settings_raw( 'author_txt', $res_ctx->get_shortcode_att('author_txt') );
        $res_ctx->load_settings_raw( 'author_txt_hover', $res_ctx->get_shortcode_att('author_txt_hover') );
        $res_ctx->load_settings_raw( 'date_txt', $res_ctx->get_shortcode_att('date_txt') );
        $res_ctx->load_settings_raw( 'ex_txt', $res_ctx->get_shortcode_att('ex_txt') );
        $res_ctx->load_settings_raw( 'com_bg', $res_ctx->get_shortcode_att('com_bg') );
        $res_ctx->load_settings_raw( 'com_txt', $res_ctx->get_shortcode_att('com_txt') );
        $res_ctx->load_settings_raw( 'btn_bg', $res_ctx->get_shortcode_att('btn_bg') );
        $res_ctx->load_settings_raw( 'btn_bg_hover', $res_ctx->get_shortcode_att('btn_bg_hover') );
        $res_ctx->load_settings_raw( 'btn_txt', $res_ctx->get_shortcode_att('btn_txt') );
        $res_ctx->load_settings_raw( 'btn_txt_hover', $res_ctx->get_shortcode_att('btn_txt_hover') );
        $res_ctx->load_settings_raw( 'btn_border', $res_ctx->get_shortcode_att('btn_border') );
        $res_ctx->load_settings_raw( 'btn_border_hover', $res_ctx->get_shortcode_att('btn_border_hover') );
        $res_ctx->load_settings_raw( 'pag_text', $res_ctx->get_shortcode_att('pag_text') );
        $res_ctx->load_settings_raw( 'pag_bg', $res_ctx->get_shortcode_att('pag_bg') );
        $res_ctx->load_settings_raw( 'pag_border', $res_ctx->get_shortcode_att('pag_border') );
        $res_ctx->load_settings_raw( 'pag_a_text', $res_ctx->get_shortcode_att('pag_a_text') );
        $res_ctx->load_settings_raw( 'pag_a_bg', $res_ctx->get_shortcode_att('pag_a_bg') );
        $res_ctx->load_settings_raw( 'pag_a_border', $res_ctx->get_shortcode_att('pag_a_border') );
        $res_ctx->load_settings_raw( 'pag_h_text', $res_ctx->get_shortcode_att('pag_h_text') );
        $res_ctx->load_settings_raw( 'pag_h_bg', $res_ctx->get_shortcode_att('pag_h_bg') );
        $res_ctx->load_settings_raw( 'pag_h_border', $res_ctx->get_shortcode_att('pag_h_border') );

        // shadow
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.08)', 'shadow' );
        $res_ctx->load_shadow_settings( 0, 0, 0, 0, 'rgba(0, 0, 0, 0.08)', 'shadow_m' );


        // fonts
        $res_ctx->load_font_settings( 'f_header' );
        $res_ctx->load_font_settings( 'f_pag' );
        $res_ctx->load_font_settings( 'f_title' );
        $res_ctx->load_font_settings( 'f_cat' );
        $res_ctx->load_font_settings( 'f_meta' );
        $res_ctx->load_font_settings( 'f_ex' );
        $res_ctx->load_font_settings( 'f_btn' );

    }

    public function get_custom_css() {
        // $unique_block_class - the unique class that is on the block. use this to target the specific instance via css
        $unique_block_class = $this->block_uid . '_rand';

        $compiled_css = '';

        $raw_css =
            "<style>

				/* @container_width */
				.$unique_block_class {
					width: @container_width; float: left;
				}
				.$unique_block_class:after {
				    content: '';
				    display: table;
				    clear: both;    
                }
				/* @image_height */
				.$unique_block_class .td-image-wrap {
					padding-bottom: @image_height;
				}
				/* @image_width */
				.$unique_block_class .td-image-container {
				 	flex: 0 0 @image_width;
				 	width: @image_width;
			    }
				.ie10 .$unique_block_class .td-image-container,
				.ie11 .$unique_block_class .td-image-container {
				 	flex: 0 0 auto;
			    }
				/* @no_float */
				.$unique_block_class .td-module-container {
					flex-direction: column;
				}
                .$unique_block_class .td-image-container {
                	display: block; order: 0;
                }
                .ie10 .$unique_block_class .td-module-meta-info,
				.ie11 .$unique_block_class .td-module-meta-info {
				 	flex: auto;
			    }
				/* @float_left */
				.$unique_block_class .td-module-container {
					flex-direction: row;
				}
                .$unique_block_class .td-image-container {
                	display: block; order: 0;
                }
                .ie10 .$unique_block_class .td-module-meta-info,
				.ie11 .$unique_block_class .td-module-meta-info {
				 	flex: 1;
			    }
				/* @float_right */
				.$unique_block_class .td-module-container {
					flex-direction: row;
				}
                .$unique_block_class .td-image-container {
                	display: block; order: 1;
                }
                .$unique_block_class .td-module-meta-info {
                	flex: 1;
                }
                /* @hide_desktop */
                .$unique_block_class .td-image-container {
                	display: none;
                }
                .$unique_block_class .entry-thumb {
                	background-image: none !important;
                }
				/* @hide */
				.$unique_block_class .td-image-container {
					display: none;
				}
				/* @meta_info_align_top */
				.$unique_block_class .td-image-container {
					order: 1;
				}
				.$unique_block_class .td-module-meta-info {
				    flex: 1;
				}
				/* @meta_width */
				.$unique_block_class .td-module-meta-info {
					max-width: @meta_width;
				}
				/* @meta_margin */
				.$unique_block_class .td-module-meta-info {
					margin: @meta_margin;
				}
				/* @meta_padding */
				.$unique_block_class .td-module-meta-info {
					padding: @meta_padding;
				}
				/* @meta_info_align */
				.$unique_block_class .td-module-container {
					align-items: @meta_info_align;
				}
				/* @align_category_top */
				.$unique_block_class .td-category-pos-image .td-post-category {
					top: 0;
					bottom: auto;
				}
				/* @align_category_bottom */
				.$unique_block_class .td-category-pos-image .td-post-category {
				    flex-direction: column-reverse;
			    }
				/* @meta_info_border_size */
				.$unique_block_class .td-module-meta-info {
					border-width: @meta_info_border_size;
				}
				/* @meta_info_border_style */
				.$unique_block_class .td-module-meta-info {
					border-style: @meta_info_border_style;
				}
				/* @meta_info_border_color */
				.$unique_block_class .td-module-meta-info {
					border-color: @meta_info_border_color;
				}
				/* @modules_on_row */
				.$unique_block_class .td_module_wrap {
					width: @modules_on_row;
					float: left;
				}
				/* @modules_gap */
				.$unique_block_class .td_module_wrap {
					padding-left: @modules_gap;
					padding-right: @modules_gap;
				}
				.$unique_block_class .tdb-block-inner {
					margin-left: -@modules_gap;
					margin-right: -@modules_gap;
				}
				/* @all_modules_space */
				.$unique_block_class .td_module_wrap {
					padding-bottom: @all_modules_space;
					margin-bottom: @all_modules_space;
				}
				.$unique_block_class .td-module-container:before {
					bottom: -@all_modules_space;
				}
				/* @m_padding */
				.$unique_block_class .td-module-container {
					padding: @m_padding;
				}
				/* @m_radius */
				.$unique_block_class .td-module-container {
					border-radius: @m_radius;
					overflow: hidden;
				}
				/* @modules_divider */
				.$unique_block_class .td-module-container:before {
					border-width: 0 0 1px 0;
					border-style: @modules_divider;
					border-color: #eaeaea;
				}
				/* @modules_divider_color */
				.$unique_block_class .td-module-container:before {
					border-color: @modules_divider_color;
				}
				/* @image_radius */
				.$unique_block_class .entry-thumb {
					border-radius: @image_radius;
				}
				/* @modules_category_margin */
				.$unique_block_class .td-post-category {
					margin: @modules_category_margin;
				}
				/* @modules_category_padding */
				.$unique_block_class .td-post-category {
					padding: @modules_category_padding;
				}
				/* @modules_category_radius */
				.$unique_block_class .td-post-category {
					border-radius: @modules_category_radius;
				}
				/* @show_cat */
				.$unique_block_class .td-post-category {
					display: @show_cat;
				}
				/* @author_photo_size */
				.$unique_block_class .tdb-author-photo .avatar {
				    width: @author_photo_size;
				    height: @author_photo_size;
				}
				/* @author_photo_space */
				.$unique_block_class .tdb-author-photo .avatar {
				    margin-right: @author_photo_space;
				}
				/* @author_photo_radius */
				.$unique_block_class .tdb-author-photo .avatar {
				    border-radius: @author_photo_radius;
				}
				/* @show_excerpt */
				.$unique_block_class .td-excerpt {
					display: @show_excerpt;
				}
				/* @show_btn */
				.$unique_block_class .td-read-more {
					display: @show_btn;
				}
				/* @hide_author_date */
				.$unique_block_class .td-author-date {
					display: none;
				}
				/* @show_author */
				.$unique_block_class .td-post-author-name {
					display: @show_author;
				}
				/* @show_date */
				.$unique_block_class .td-post-date,
				.$unique_block_class .td-post-author-name span {
					display: @show_date;
				}
				/* @show_review */
				.$unique_block_class .entry-review-stars {
					display: @show_review;
				}
				/* @show_com */
				.$unique_block_class .td-module-comments {
					display: @show_com;
				}
				/* @clearfix_desktop */
				.$unique_block_class .td_module_wrap:nth-child(@clearfix_desktop) {
					clear: both;
				}
				/* @clearfix */
				.$unique_block_class .td_module_wrap {
					clear: none !important;
				}
				.$unique_block_class .td_module_wrap:nth-child(@clearfix) {
					clear: both !important;
				}
				/* @padding_desktop */
				.$unique_block_class .td_module_wrap:nth-last-child(@padding_desktop) {
					margin-bottom: 0;
					padding-bottom: 0;
				}
				.$unique_block_class .td_module_wrap:nth-last-child(@padding_desktop) .td-module-container:before {
					display: none;
				}
				/* @padding */
				.$unique_block_class .td_module_wrap {
					padding-bottom: @all_modules_space !important;
					margin-bottom: @all_modules_space !important;
				}
				.$unique_block_class .td_module_wrap:nth-last-child(@padding) {
					margin-bottom: 0 !important;
					padding-bottom: 0 !important;
				}
				.$unique_block_class .td_module_wrap .td-module-container:before {
					display: block !important;
				}
				.$unique_block_class .td_module_wrap:nth-last-child(@padding) .td-module-container:before {
					display: none !important;
				}
				/* @m_bg */
				.$unique_block_class .td-module-container {
					background-color: @m_bg;
				}
				/* @shadow */
				.$unique_block_class .td-module-container {
				    box-shadow: @shadow;
				}
				/* @shadow_m */
				.$unique_block_class .td-module-meta-info {
				    box-shadow: @shadow_m;
				}
				/* @meta_bg */
				.$unique_block_class .td-module-meta-info {
					background-color: @meta_bg;
				}
				/* @cat_bg */
				.$unique_block_class .td-post-category {
					background-color: @cat_bg;
				}
				/* @cat_bg_hover */
				.$unique_block_class .td-post-category:hover {
					background-color: @cat_bg_hover;
				}
				/* @cat_txt */
				.$unique_block_class .td-post-category {
					color: @cat_txt;
				}
				/* @cat_txt_hover */
				.$unique_block_class .td-post-category:hover {
					color: @cat_txt_hover;
				}
				/* @title_txt */
				.$unique_block_class .td-module-title a {
					color: @title_txt;
				}
				/* @title_txt_hover */
				.$unique_block_class .td_module_wrap:hover .td-module-title a {
					color: @title_txt_hover;
				}
				/* @author_txt */
				.$unique_block_class .td-post-author-name a {
					color: @author_txt;
				}
				/* @author_txt_hover */
				.$unique_block_class .td-post-author-name:hover a {
					color: @author_txt_hover;
				}
				/* @date_txt */
				.$unique_block_class .td-post-date,
				.$unique_block_class .td-post-author-name span {
					color: @date_txt;
				}
				/* @ex_txt */
				.$unique_block_class .td-excerpt {
					color: @ex_txt;
				}
				/* @com_bg */
				.$unique_block_class .td-module-comments a {
					background-color: @com_bg;
				}
				.$unique_block_class .td-module-comments a:after {
					border-color: @com_bg transparent transparent transparent;
				}
				/* @com_txt */
				.$unique_block_class .td-module-comments a {
					color: @com_txt;
				}
				/* @btn_bg */
				.$unique_block_class .td-read-more a {
					background-color: @btn_bg;
				}
				/* @btn_bg_hover */
				.$unique_block_class .td-read-more:hover a {
					background-color: @btn_bg_hover !important;
				}
				/* @btn_txt */
				.$unique_block_class .td-read-more a {
					color: @btn_txt;
				}
				/* @btn_txt_hover */
				.$unique_block_class .td-read-more:hover a {
					color: @btn_txt_hover;
				}
				/* @btn_border_width */
				.$unique_block_class .td-read-more a {
					border-width: @btn_border_width;
					border-style: solid;
					border-color: #000;
				}
				/* @btn_border */
				.$unique_block_class .td-read-more a {
					border-color: @btn_border;
				}
				/* @btn_border_hover */
				.$unique_block_class .td-read-more:hover a {
					border-color: @btn_border_hover;
				}
				/* @btn_radius */
				.$unique_block_class .td-read-more a {
					border-radius: @btn_radius;
				}
				/* @pag_space */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap,
				.$unique_block_class .page-nav,
				.$unique_block_class .td-load-more-wrap {
					margin-top: @pag_space;
				}
				/* @pag_text */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a,
				.$unique_block_class .page-nav a,
				.$unique_block_class .td-load-more-wrap a {
					color: @pag_text;
				}
				/* @pag_bg */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a,
				.$unique_block_class .page-nav a,
				.$unique_block_class .td-load-more-wrap a {    
					background-color: @pag_bg;
				}
				/* @pag_border */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a,
				.$unique_block_class .page-nav a,
				.$unique_block_class .td-load-more-wrap a {
					border-color: @pag_border;
				}
				/* @pag_a_text */
				.$unique_block_class .page-nav .current {
					color: @pag_a_text;
				}
				/* @pag_a_bg */
				.$unique_block_class .page-nav .current {
					background-color: @pag_a_bg;
				}
				/* @pag_a_border */
				.$unique_block_class .page-nav .current {
					border-color: @pag_a_border;
				}
				/* @pag_h_text */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a:hover,
				.$unique_block_class .page-nav a:hover,
				.$unique_block_class .td-load-more-wrap a:hover {
					color: @pag_h_text;
				}
				/* @pag_h_bg */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a:hover,
				.$unique_block_class .page-nav a:hover,
				.$unique_block_class .td-load-more-wrap a:hover {    
					background-color: @pag_h_bg;
				}
				/* @pag_h_border */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a:hover,
				.$unique_block_class .page-nav a:hover,
				.$unique_block_class .td-load-more-wrap a:hover {
					border-color: @pag_h_border;
				}
				
                
				/* @meta_horiz_align_center */
				.$unique_block_class .td-module-meta-info {
					text-align: center;
				}
				.$unique_block_class .td-image-container {
					margin-left: auto;
                    margin-right: auto;
				}
				.$unique_block_class .td-category-pos-image .td-post-category {
					left: 50%;
					transform: translateX(-50%);
					-webkit-transform: translateX(-50%);
				}
				.$unique_block_class.td-h-effect-up-shadow .td_module_wrap:hover .td-category-pos-image .td-post-category {
				    transform: translate(-50%, -2px);
					-webkit-transform: translate(-50%, -2px);
				}
				/* @meta_horiz_align_right */
				.$unique_block_class .td-module-meta-info {
					text-align: right;
				}
				
				/* @art_title */
				.$unique_block_class .entry-title {
					margin: @art_title;
				}
				/* @art_excerpt */
				.$unique_block_class .td-excerpt {
					margin: @art_excerpt;
				}
				/* @excerpt_col */
				.$unique_block_class .td-excerpt {
					column-count: @excerpt_col;
				}
				/* @excerpt_gap */
				.$unique_block_class .td-excerpt {
					column-gap: @excerpt_gap;
				}
				/* @art_btn */
				.$unique_block_class .td-read-more {
					margin: @art_btn;
				}
				/* @btn_margin */
				.$unique_block_class .td-read-more {
					margin: @btn_margin;
				}
				/* @btn_padding */
				.$unique_block_class .td-read-more a {
					padding: @btn_padding;
				}
				/* @btn_radius */
				.$unique_block_class .td-read-more a {
					border-radius: @btn_radius;
				}

				/* @f_header */
				.$unique_block_class .td-block-title a,
				.$unique_block_class .td-block-title span {
					@f_header
				}
				/* @f_pag */
				.$unique_block_class.td_with_ajax_pagination .td-next-prev-wrap a i,
				.$unique_block_class .page-nav a,
				.$unique_block_class .page-nav span,
				.$unique_block_class .td-load-more-wrap a {
					@f_pag
				}
				/* @f_title */
				.$unique_block_class .entry-title {
					@f_title
				}
				/* @f_cat */
				.$unique_block_class .td-post-category {
					@f_cat
				}
				/* @f_meta */
				.$unique_block_class .td-author-date,
				.$unique_block_class .tdb-author-photo,
				.$unique_block_class .td-post-author-name,
				.$unique_block_class .td-module-comments a {
					@f_meta
				}
				/* @f_ex */
				.$unique_block_class .td-excerpt {
					@f_ex
				}
				/* @f_btn */
				.$unique_block_class .td-read-more a {
					@f_btn
				}
			</style>";


        $td_css_res_compiler = new td_css_res_compiler( $raw_css );
        $td_css_res_compiler->load_settings( __CLASS__ . '::cssMedia', $this->get_all_atts() );

        $compiled_css .= $td_css_res_compiler->compile_css();

        return $compiled_css;
    }

    function render( $atts, $content = null ) {

        global $tdb_state_category, $tdb_state_author, $tdb_state_search, $tdb_state_date, $tdb_state_tag, $tdb_state_single_page;

        switch( tdb_state_template::get_template_type() ) {

            case 'single':
                $loop_data = array();
                break;

            case '404':
                $loop_data = array();
                break;

            case 'attachment':
                $loop_data = array();
                break;

            case 'category':
                $loop_data = $tdb_state_category->loop->__invoke( $atts );
                $atts['category_id'] = $loop_data['category_id'];

                break;

            case 'author':
                $loop_data = $tdb_state_author->loop->__invoke( $atts );
                $atts['autors_id'] = $loop_data['author_id'];

                break;

            case 'search':
                $loop_data = $tdb_state_search->loop->__invoke( $atts );
                $atts['search_query'] = $loop_data['search_query'];

                break;

            case 'date':
                $loop_data = $tdb_state_date->loop->__invoke( $atts );
                $atts['date_query'] = $loop_data['date_query'];

                break;

            case 'tag':
                $loop_data = $tdb_state_tag->loop->__invoke( $atts );
                $atts['tag_slug'] = $loop_data['tag_slug'];

                break;

            default:
                $loop_data = $tdb_state_single_page->loop->__invoke( $atts );
        }


        parent::render( $atts ); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)

        if( $this->get_att('block_template_id') != '' ) {
            $global_block_template_id = $this->get_att('block_template_id');
        } else {
            $global_block_template_id = td_options::get( 'tds_global_block_template', 'td_block_template_1' );
        }
        $td_css_cls_block_title = 'td-block-title';

        if ( $global_block_template_id === 'td_block_template_1' ) {
            $td_css_cls_block_title = 'block-title';
        }

        $additional_classes_array = array();

        // pagination
        $pagination = $this->get_att( 'ajax_pagination' );
        if( $pagination != '' && $pagination === 'numbered' ) {
            $additional_classes_array[] = 'tdb-numbered-pagination';
        }

        // hover effect
        $h_effect = $this->get_att('h_effect');
        if( $h_effect != '' ) {
            $additional_classes_array[] = 'td-h-effect-' . $h_effect;
        }

        $buffy = ''; //output buffer

        $buffy .= '<div class="' . $this->get_block_classes( $additional_classes_array ) . ' tdb-category-loop-posts" ' . $this->get_block_html_atts() . '>';

            //get the block css
            $buffy .= $this->get_block_css();

            //get the js for this block
            $buffy .= $this->get_block_js();


            $custom_title = $this->get_att( 'custom_title' );

            if( $custom_title != '' ) {
                //get the filter for this block
                $buffy .= '<div class="td-block-title-wrap">';
                    $buffy .= '<h4 class="' . $td_css_cls_block_title . '">';
                        $buffy .= '<span>' . $custom_title . '</span>';
                    $buffy .= '</h4>';
                $buffy .= '</div>';
            }

            $buffy .= '<div  id=' . $this->block_uid . ' class="td_block_inner tdb-block-inner td-fix-index">';

            if ( empty( $loop_data['loop_posts'] ) ) {

                /**
                 * on composer iframe and on templates that do not have posts we show the no posts message
                 *  @see td_page_generator::no_posts() - this function generates the __td('No posts to display').
                 * the text can be overwritten by the template using the global @see td_global::$custom_no_posts_message
                 */
                //if ( tdc_state::is_live_editor_ajax() || tdc_state::is_live_editor_iframe() ) {
                //    $buffy .= td_page_generator::no_posts();
                //} else {
                //    $offset = intval($this->get_att('offset'));
                //    if ( $offset === 0 ) {
                //        $buffy .= td_page_generator::no_posts();
                //    }
                //}

                $buffy .= '</div>';

            } else {
                $buffy .= $this->inner( $loop_data['loop_posts'] );  //inner content of the block

	            $buffy .= '</div>';

	            if ( $pagination != '' ) {
		            if ( $pagination === 'numbered' ) {
			            $buffy .= $this->get_numbered_pagination( $loop_data['loop_pagination'] );
		            } else {
			            $buffy .= $this->get_block_pagination();
		            }
	            }
            }

        $buffy .= '</div>';

        return $buffy;
    }

    function inner( $posts ) {

        $buffy = '';
        $td_block_layout = new td_block_layout();

        if ( !empty( $posts ) ) {
            foreach ( $posts as $post ) {
                $tdb_module_loop = new tdb_module_loop( $post, $this->get_all_atts() );
                $buffy .= $tdb_module_loop->render( $post );
            }
        }
        $buffy .= $td_block_layout->close_all_tags();

        return $buffy;

    }

    function get_numbered_pagination( $loop_pagination_data ) {

        $pagination_data  = $loop_pagination_data;
        $pagenavi_options = $loop_pagination_data['pagenavi_options'];

        $buffy = '';

        if( $pagination_data['max_page'] > 1 || intval( $pagenavi_options['always_show'] ) === true ) {
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n( $pagination_data['paged'] ), $pagenavi_options['pages_text'] );
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n( $pagination_data['max_page'] ), $pages_text );

            $buffy .= '<div class="page-nav td-pb-padding-side">';

            $buffy .= $pagination_data['previous_posts_link'];

            if ( $pagination_data['start_page'] >= 2 && $pagination_data['pages_to_show'] < $pagination_data['max_page'] ) {
                $first_page_text = str_replace( "%TOTAL_PAGES%", number_format_i18n( $pagination_data['max_page'] ), $pagenavi_options['first_text'] );
                $buffy .= '<a href="' . esc_url( get_pagenum_link() ) . '" class="first" title="' . $first_page_text . '">' . $first_page_text . '</a>';
                if ( !empty( $pagenavi_options['dotleft_text'] ) && ( $pagination_data['start_page'] > 2) ) {
                    $buffy .= '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
                }
            }

            for ( $i = $pagination_data['start_page']; $i <= $pagination_data['end_page']; $i++ ) {
                if ( $i == $pagination_data['paged'] ) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n( $i ), $pagenavi_options['current_text'] );
                    $buffy .= '<span class="current">' . $current_page_text . '</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n( $i ), $pagenavi_options['page_text'] );
                    $buffy .= '<a href="' . esc_url( get_pagenum_link( $i )) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
                }
            }

            if ( $pagination_data['end_page'] < $pagination_data['max_page'] ) {
                if ( !empty( $pagenavi_options['dotright_text']) && ( $pagination_data['end_page'] + 1 < $pagination_data['max_page'] ) ) {
                    $buffy .= '<span class="extend">' . $pagenavi_options['dotright_text'] . '</span>';
                }

                $last_page_text = str_replace( "%TOTAL_PAGES%", number_format_i18n( $pagination_data['max_page'] ), $pagenavi_options['last_text'] );
                $buffy .= '<a href="' . esc_url( get_pagenum_link( $pagination_data['max_page'] ) ) . '" class="last" title="' . $last_page_text . '">' . $last_page_text . '</a>';
            }

            $buffy .= $pagination_data['next_posts_link'];

            if ( !empty( $pages_text ) ) {
                $buffy .= '<span class="pages">' . $pages_text . '</span>';
            }

            $buffy .= '<div class="clearfix"></div>';
            $buffy .= '</div>';
        }

        return $buffy;
    }

}