<?php
/**
 * File sidebar-single-staff.php
 * Created by: Shawn on 3/16/13 at 3:20 PM
 * Project JetBrains PhpStorm
 * @category
 * @author W. Shawn Wilkerson, Sanity LLC
 * @link http://www.sanityllc.com
 * @copyright
 * @license
 *
 */


/**
 * If Staff member has members assigned to them, this will display an optional sidebar of those members, otherwise nothing will appear.
 * This will allow departments, teams, etc., to be displayed on a section leaders area of the site.
 * Caveat: This is intended to only work one tier deep.
 * Sub teams will not be shown unless the specified leader is selected from side menu or elsewhere on the site.
 *
 * @package WordPress
 * @subpackage Foursquare Two
 * @since Foursquare Two 1.0
 */
?>


<?php
// The Query for Staff custom post type
$args = array('post_type' => 'staff', 'hierarchical' => true, 'orderby' => 'menu_order', 'order' => 'ASC',
              'showposts' => 5000, 'post_parent' => $id);
// The Loop
$loop = new WP_Query($args);
if ($loop->have_posts()):
    ?>
    <aside id="sidebar-about" class="about span4">
    <div class="widget-container">
    <h2><?php the_title(); ?>'s staff</h2>
<?php endif;
while ($loop->have_posts()) : $loop->the_post(); ?>

    <article class="staff">
        <?php
        if (has_post_thumbnail()) :?>
            <a href="<?php the_permalink(); ?>">
  				<span class="alignleft">
						<?php echo get_the_post_thumbnail($id, 'thumbnail'); ?>
					</span>
            </a>
        <?php endif;?>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php // Get the Church Staff Title custom taxonomy.
        $terms_as_text = get_the_term_list($post->ID, 'church-staff-title', '<h2>', ', ', '</h2>');
        echo strip_tags($terms_as_text, '<h2>');
        ?>
    </article>
    <!--end staff-->
<?php endwhile;
if ($loop->have_posts()): ?>
    </div>
    </aside>
<?php endif; ?>
