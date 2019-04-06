<?php
/**
 * Template: Shortcode single menu item
 *
 * @since  1.0.0
 * @version 1.0.0
 */

$thumb_width = wprm_get_option('thumbnail_width');
$thumb_height = wprm_get_option('thumbnail_height');

?>
<ul>
    <li id="wprm-menu-item-<?php echo get_the_id();?>">
        <?php do_action( 'wprm_single_menu_item_part_before' ); ?>
        <div class="inner">
            <?php 
                if(has_post_thumbnail() && $display_images == 'true') :
                    $post_thumbnail_id = get_post_thumbnail_id();
                    $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                    $thumb = wprm_thumb($post_thumbnail_url, $thumb_width, $thumb_height); // Crops from bottom right
                    echo '<img class="wp-post-image" src="'.$thumb.'">';
                endif;
           ?>
            <div class="content">
                <div class="head">
                    <?php if($hyperlink == 'true') : ?>
                        <p class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></p>
                    <?php else : ?>
                        <p class="title"><?php the_title();?></p>
                    <?php endif; ?>
                    <?php if($price == 'true'): ?>
                        <p class="price"><?php echo wprm_get_item_price(); ?></p>
                    <?php endif; ?>
                </div>
                <?php if($description == 'true') : ?>
                    <?php the_content();?>
                <?php endif; ?>
            </div>
        </div>
        <?php do_action( 'wprm_single_menu_item_part_after' ); ?>
    </li>
</ul>