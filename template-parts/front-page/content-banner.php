<?php
/**
 * Template part for displaying front page header banner slider content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Real_Home
 */
if (!Real_Home_Helper::crucial_real_state_plugin()) {
    return;
}

$enable_banner_slider = get_theme_mod('real_home_front_page_banner_slider_enable', ['desktop' => 'true']);

if ($enable_banner_slider && array_key_exists('desktop', $enable_banner_slider)):

    $slides_limit = get_theme_mod(
        'real_home_front_page_banner_slider_limit',
        ['desktop' => 5]
    );
    // Arguments
    $args = [
        'post_type' => 'property',
        'posts_per_page' => absint($slides_limit['desktop']),
        'meta_query' => [
            [
                'key' => 'cre_add_in_slider',
                'value' => 'yes',
            ],
        ],
        'no_found_rows' => true,
        'ignore_sticky_posts' => true,
    ];

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()): ?>

	        <section class="featured-slider">
	            <div class="banner-slider">
	                <?php while ($the_query->have_posts()): $the_query->the_post();?>
		                    <div class="slider-item">

		                        <?php if ($slider_image = get_post_meta(get_the_ID(), 'cre_slider_image', true)):
            $img_url = wp_get_attachment_image_src($slider_image, 'full');
            $img_url = $img_url[0];
            ?>
			                            <figure class="featured-image" data-ratio="16x9">
			                                <img src="<?php echo esc_url($img_url); ?>">
			                            </figure>
			                        <?php else: ?>
		                            <?php real_home_post_thumbnail('full', '16x9');?>
		                        <?php endif;?>

	                        <div class="slider-text justify-content-left">
	                            <div class="post">
	                                <div class="post-detail-wrap">
										<?php
    $status_terms = wp_get_post_terms(get_the_ID(), 'property-status', ['orderby' => 'term_order']);
    $type_terms = wp_get_post_terms(get_the_ID(), 'property-type', ['orderby' => 'term_order']);
    if ($status_terms || $type_terms): ?>
											<div class="post-tags-wrap">

												<?php if ($type_terms): ?>
													<?php foreach ($type_terms as $type_term): ?>
														<a href="<?php echo esc_url(get_term_link($type_term->slug, 'property-type')); ?>" class="post-tags property-type-<?php echo esc_attr($type_term->term_id); ?>"><?php echo esc_html($type_term->name); ?></a>
													<?php endforeach;?>
											<?php endif;?>

											<?php if ($status_terms): ?>
												<?php foreach ($status_terms as $status_term): ?>
													<a href="<?php echo esc_url(get_term_link($status_term->slug, 'property-status')); ?>" class="post-tags property-status-<?php echo esc_attr($status_term->term_id); ?>"><?php echo esc_html($status_term->name); ?></a>
												<?php endforeach;?>
											<?php endif;?>
										</div><!-- .post-tags-wrap -->
									<?php endif;?>
                                    <header class="entry-header">
										<?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>');?>
                                    </header><!-- .entry-header -->

                                    <div class="entry-content">
                                        <?php Real_Home_Helper::post_excerpt();?>
                                    </div><!-- .entry-content -->

                                    <div class="property-meta entry-meta">

                                        <?php if ($bedrooms = get_post_meta(get_the_ID(), 'cre_property_bedrooms', true)): ?>
                                            <div class="meta-wrapper">
                                            <span class="meta-icon">
                                                <i class="fa fa-bed"></i>
                                            </span>
                                                <span class="meta-value"><?php echo esc_html($bedrooms); ?></span>
                                                <span class="meta-unit"><?php esc_html_e('bedroom', 'real-home');?></span>
                                            </div>
                                        <?php endif;?>

                                        <?php if ($bathrooms = get_post_meta(get_the_ID(), 'cre_property_bathrooms', true)): ?>
                                            <div class="meta-wrapper">
                                            <span class="meta-icon">
                                                <i class="fa fa-bath"></i>
                                            </span>
                                                <span class="meta-value"><?php echo esc_html($bathrooms); ?></span>
                                                <span class="meta-unit"><?php esc_html_e('bathroom', 'real-home');?></span>
                                            </div>
                                        <?php endif;?>

                                        <?php if ($garage = get_post_meta(get_the_ID(), 'cre_property_garage', true)): ?>
                                            <div class="meta-wrapper">
                                            <span class="meta-icon">
                                                <i class="fa fa-home"></i>
                                            </span>
                                                <span class="meta-value"><?php echo esc_html($garage); ?></span>
                                                <span class="meta-unit"><?php esc_html_e('garage', 'real-home');?></span>
                                            </div>
                                        <?php endif;?>

                                        <?php if ($area_size = get_post_meta(get_the_ID(), 'cre_property_size', true)): ?>
                                            <div class="meta-wrapper">
                                            <span class="meta-icon">
                                                <i class="fa fa-area-chart"></i>
                                            </span>
                                                <span class="meta-value"><?php echo esc_html($area_size); ?></span>
                                                <?php if ($area_size_suffix = get_post_meta(get_the_ID(), 'cre_property_size_postfix', true)): ?>
                                                    <span class="meta-unit"><?php echo esc_html($area_size_suffix); ?></span>
                                                <?php endif;?>
                                            </div>
                                        <?php endif;?>

                                    </div>
                                    <div class="property-meta-info">
                                        <div class="properties-price">
                                            <?php cre_property_price();?>
                                        </div>
										<div class="properties-contact">
                                            <a href="tel:013563184"><i class="fa fa-mobile"></i></a>
                                        </div>
										<div class="properties-fav">
                                            <?php echo do_shortcode( '[favorite_button]' ); ?>
                                        </div>
                                        <div class="share-section">
                                            <a href="javascript:void(0);" target="_self">
                                                <i class="fa fa-share-alt"></i>
                                            </a>
                                            <div class="block-social-icons social-links">
												<?php cre_social_share();?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .post -->
                        </div><!-- .slider-text -->

                    </div><!-- .slider-item -->
                    <?php wp_reset_postdata();?>
                <?php endwhile;?>
            </div><!-- .banner-slider -->
            <div id="feature-search" class="feature-search">
                <div class="container">
                    <div class="feature-search-wrap">
                        <div class="hsearch-form">
                            <form method="get" class="searchand-filter-form" id="advanced-searchform" role="search" action="<?php echo esc_url(home_url('/')); ?>">
                                <input type="hidden" name="s" value="">
                                <input type="hidden" name="post_type" value="property" />
                                <input type="hidden" name="search" value="advanced">

                                <ul class="searchand-filter">
                                    <li>
                                        <input type="text" name="keyword_search" id="keyword_search" placeholder="Keyword">
                                    </li>
                                    <li>
                                        <?php
                                        $args = array(
                                            'order' => 'ASC',
                                            'hide_empty' => false,
                                            'parent' => 0,
                                        );
                                        $tax_terms = get_terms('property-location', $args);

                                        ?>
                                        <select name="location" id="location" class="postform">
                                            <option value="" selected="selected" id="property_divi">Properties' Division</option>
                                            <?php if ($tax_terms): ?>
                                                <?php foreach ($tax_terms as $tax_term):?>
                                                <option data-id="<?php echo $tax_term->term_id; ?>" value="<?php echo $tax_term->term_id; ?>"><?php echo $tax_term->name; ?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    </li>
                                    <li id="child-category-li">
                                        <select name="location_tsp" id="location_tsp">
                                            <option value=""  id="property_tsp">Location TSP</option>
                                        </select>
                                    </li>
                                    <li>
                                        <?php
										$property_args = array(
                                                'order' => 'ASC',
                                                'hide_empty' => false,
                                            );
                                            $property_types = get_terms('property-type', $property_args);
// 										$property_args = array(
//                                             'order' => 'ASC',
//                                             'hide_empty' => false,

//                                         );
//                                         $property_types = get_terms('property-type', $property_args);
                                        
//                                             $property_types = get_theme_mod(
//                                                 'real_home_front_page_property_types',
//                                                 ''
//                                             );
                                            ?>
                                        <select name="category" id="category" class="postform">
                                            <option value="" selected="selected"  id="property_type">Properties' Type</option>
                                            <?php if ($property_types):    ?>
	                                                <?php foreach ($property_types as $property_type):?>
		                                                <option value="<?php echo $property_type->slug; ?>"><?php echo $property_type->name; ?></option>
		                                                <?php endforeach;?>
	                                            <?php endif;?>
                                        </select>
                                    </li>
                                    <li>
                                        <?php
                                            $feature_args = array(
                                                'order' => 'ASC',
                                                'hide_empty' => false,
                                            );
                                            $feature_terms = get_terms('property-feature', $feature_args);

                                            ?>
                                        <select name="feature" id="feature" class="postform">
                                            <option value="" selected="selected" id="property_features">Properties' Features</option>
                                            <?php if ($feature_terms):    ?>
	                                                <?php foreach ($feature_terms as $feature_term):?>
		                                                <option value="<?php echo $feature_term->slug; ?>"><?php echo $feature_term->name; ?></option>
		                                                <?php endforeach;?>
	                                            <?php endif;?>
                                        </select>
                                    </li>
                                    
                                    <li>
                                        <select name="min_price" id="min_price" class="postform">
                                            <option class="item" value="" id="property_min">Minimum Price</option>
                                            <option class="item" value="100">100lkhs</option>
                                            <option class="item" value="200">200lkhs</option>
                                            <option class="item" value="300">300lkhs</option>
                                            <option class="item" value="400">400lkhs</option>
                                            <option class="item" value="500">500lkhs</option>
                                            <option class="item" value="600">600lkhs</option>
                                            <option class="item" value="700">700lkhs</option>
                                            <option class="item" value="800">800lkhs</option>
                                            <option class="item" value="900">900lkhs</option>
                                            <option class="item" value="1000">1000lkhs</option>
                                            <option class="item" value="1500">1500lkhs</option>
                                            <option class="item" value="2000">2000lkhs</option>
                                            <option class="item" value="2500">2500lkhs</option>
                                            <option class="item" value="3000">3000lkhs</option>
                                            <option class="item" value="3500">3500lkhs</option>
                                            <option class="item" value="4000">4000lkhs</option>
                                            <option class="item" value="4500">4500lkhs</option>
                                            <option class="item" value="5000">5000lkhs</option>
                                            <option class="item" value="6000">6000lkhs</option>
                                            <option class="item" value="7000">7000lkhs</option>
                                            <option class="item" value="8000">8000lkhs</option>
                                            <option class="item" value="9000">9000lkhs</option>
                                            <option class="item" value="10000">10000lkhs</option>
                                            <option class="item" value="15000">15000lkhs</option>
                                            <option class="item" value="30000">30000lkhs</option>

                                        </select>
                                    </li>
                                    <li>
                                        <select name="max_price" id="max_price" class="postform">
                                            <option class="item" value="" id="property_max">Maximum Price</option>
                                            <option class="item" value="100">100lkhs</option>
                                            <option class="item" value="200">200lkhs</option>
                                            <option class="item" value="300">300lkhs</option>
                                            <option class="item" value="400">400lkhs</option>
                                            <option class="item" value="500">500lkhs</option>
                                            <option class="item" value="600">600lkhs</option>
                                            <option class="item" value="700">700lkhs</option>
                                            <option class="item" value="800">800lkhs</option>
                                            <option class="item" value="900">900lkhs</option>
                                            <option class="item" value="1000">1000lkhs</option>
                                            <option class="item" value="1500">1500lkhs</option>
                                            <option class="item" value="2000">2000lkhs</option>
                                            <option class="item" value="2500">2500lkhs</option>
                                            <option class="item" value="3000">3000lkhs</option>
                                            <option class="item" value="3500">3500lkhs</option>
                                            <option class="item" value="4000">4000lkhs</option>
                                            <option class="item" value="4500">4500lkhs</option>
                                            <option class="item" value="5000">5000lkhs</option>
                                            <option class="item" value="6000">6000lkhs</option>
                                            <option class="item" value="7000">7000lkhs</option>
                                            <option class="item" value="8000">8000lkhs</option>
                                            <option class="item" value="9000">9000lkhs</option>
                                            <option class="item" value="10000">10000lkhs</option>
                                            <option class="item" value="15000">15000lkhs</option>
                                            <option class="item" value="30000">30000lkhs</option>

                                        </select>
                                    </li>

                                    <li>
                                        <input type="submit" value="Search">
                                    </li>
                                </ul>
                            </form>
                        </div>

                        <div class="links-list">
                            <ul class="link-list">
                                <!-- <?php
$args = array(
    'order' => 'ASC',
    'hide_empty' => true,
);
$tax_terms = get_terms('property-location', $args);

?>

                                <?php if ($tax_terms): ?>
                                    <?php foreach ($tax_terms as $tax_term):
    //print_r($tax_term);?>
	                                        <li class="location-link-list">
	                                            <a href="/real-estate/property-location/<?php echo $tax_term->slug; ?>">Properties in <?php echo $tax_term->name; ?></a>
	                                        </li>
	                                    <?php endforeach;?>
                                <?php endif;?>    -->
                                <?php
$feature_args = array(
    'order' => 'ASC',
    'hide_empty' => true,
);
$feature_terms = get_terms('property-feature', $feature_args);

?>
                                    <?php if ($feature_terms):
    //print_r($feature_terms);
    ?>
	                                        <?php foreach ($feature_terms as $feature_term):
        //print_r($feature_term);?>
		                                        <li class="location-link-list">
		                                            <a href="/real-estate/property-feature/<?php echo $feature_term->slug; ?>">Properties in <?php echo $feature_term->name; ?></a>
		                                        </li>

		                                        <?php endforeach;?>
	                                    <?php endif;?>
                                    <?php
$property_types = get_theme_mod(
    'real_home_front_page_property_types',
    ''
);
?>
                                    <?php foreach ($property_types as $property_key => $property_type): ?>
                                        <?php if (!empty($property_type['cat_slug'])): $property_term_type = get_term_by('slug', $property_type['cat_slug'], 'property-type');?>
	                                            <?php if ($property_term_type): ?>
	                                                <li class="location-link-list">
	                                                    <a href="/real-estate/property-type/<?php echo $property_term_type->slug; ?>">Properties in <?php echo $property_term_type->name; ?></a>
	                                                </li>

	                                            <?php endif;?>
                                        <?php endif;?>
                                    <?php endforeach;?>
                            </ul>
                        </div>
                    </div>

                </div>

             </div>
        </section><!-- .featured-slider -->

    <?php
endif;
endif;
