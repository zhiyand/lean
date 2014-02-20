<?php

include('inc/util.php');
include('inc/MainNavWalker.class.php');

class LeanTheme{
    
    private $_actions = array('after_setup_theme', 'wp_enqueue_scripts', 'widgets_init');
    private $_filters = array('comment_form_default_fields', 'comment_form_field_comment',
        array('post_gallery', 10, 2),
        array('img_caption_shortcode_width', 10, 3),
        array('image_resize_dimensions', 10, 6),
    );
    
    function __construct(){
        add_theme_support( 'post-thumbnails' );
        add_image_size('-lean-full', 900, 450, true);
        add_image_size('-lean-thumb', 420, 210, true);
        add_image_size('-lean-thumb-3', 273, 136, true);
        add_image_size('-lean-thumb-4', 200, 100, true);
        //add_image_size('-lean-tiny', 75, 75, true);

        foreach($this->_actions as $action){
            if(is_array($action)){
                add_action($action[0], array($this, $action[0]), $action[1], $action[2]);
            }else{
                add_action($action, array($this, $action));
            }
        }

        foreach($this->_filters as $filter){
            if(is_array($filter)){
                add_action($filter[0], array($this, $filter[0]), $filter[1], $filter[2]);
            }else{
                add_action($filter, array($this, $filter));
            }
            
        }
    }

    /* Actions */
    function after_setup_theme(){
        register_nav_menu( 'Footer', 'Footer navigation' );
        register_nav_menu( 'Main', 'Main navigation' );

        add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image',
            'quote', 'status', 'video', 'audio', 'chat' ) );
    }
    function widgets_init(){
        /* Sidebar */

        register_sidebar( array(
            'name'          => 'Homepage Sidebar',
            'id'            => 'sidebar-home',
            'description'   => 'The sidebar on the home page.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>' ) );

        register_sidebar( array(
            'name'          => 'Single Sidebar',
            'id'            => 'sidebar-single',
            'description'   => 'The sidebar on single post pages.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>' ) );

        register_sidebar( array(
            'name'          => 'Footer Column A',
            'id'            => 'footer-col-a',
            'description'   => 'Footer column on the left.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>' ) );


        register_sidebar( array(
            'name'          => 'Footer Column B',
            'id'            => 'footer-col-b',
            'description'   => 'Footer column in the middle.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>' ) );


        register_sidebar( array(
            'name'          => 'Footer Column C',
            'id'            => 'footer-col-c',
            'description'   => 'Footer column on the right.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widgettitle">',
            'after_title'   => '</h4>' ) );
    }
    function wp_enqueue_scripts(){
        $tpl = get_template_directory_uri();
        
        wp_register_style('lean-fonts', 'http://fonts.googleapis.com/css?family=Quattrocento');
        wp_register_style('lean-reset', $tpl . '/static/css/reset.css');
        wp_register_style('lean-font-awesome', $tpl . '/static/font-awesome/css/font-awesome.min.css');
        wp_register_style('lean', $tpl . '/static/css/lean.css');

        wp_enqueue_style('lean-fonts');
        wp_enqueue_style('lean-reset');
        wp_enqueue_style('lean-font-awesome');
        wp_enqueue_style('lean');
        
        wp_register_script('lean-rem', "$tpl/static/js/rem.min.js", '', '0.1', true);
        wp_enqueue_script('lean-rem');
    }
    /* Filters */
    function img_caption_shortcode_width($caption_width, $atts, $content){
        return $caption_width -10;
    }

    // Up-scale small images
    function image_resize_dimensions( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
        if ( !$crop ) return null; // let the wordpress default function handle this
 
        $aspect_ratio = $orig_w / $orig_h;
        $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
 
        $crop_w = round($new_w / $size_ratio);
        $crop_h = round($new_h / $size_ratio);
 
        $s_x = floor( ($orig_w - $crop_w) / 2 );
        $s_y = floor( ($orig_h - $crop_h) / 2 );
 
        return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
    }

    function comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
        ?>
        <li class="post pingback">
            <p><i class="icon icon-external-link"></i> <?php _e( 'Pingback:', 'lean' ); ?> <?php comment_author_link(); ?>
<?php edit_comment_link( __( '<i class="icon icon-pencil"></i>', 'slim' ), ' <span class="edit-link">', '</span>' ); ?></p>
        <?php
                break;
            default :
        ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div class="vcard"> <?php echo get_avatar( $comment, 48 ); ?> </div>
                <div class="text">
                    <div class="meta">
    <?php printf( '<span class="fn">%s</span>', get_comment_author_link() ); ?> 
                        <div class="misc">
    <?php printf( '<time pubdate datetime="%1$s">%2$s</time>',
        get_comment_time( 'c' ),
        _lean_time_ago('comment'));?> 
    <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'lean' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> 
    <?php edit_comment_link( __( 'Edit', 'lean' ), '', '' ); ?>
                        </div>
                    </div>
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'lean' ); ?></em>
                        <br />
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>
            <!--</li> #comment-## -->

        <?php
                break;
        endswitch;
    }
    function comment_form_default_fields($fields)
    {
        $fields = array(
            '<div class="field"><label for="reply-author">Name <span class="required">*</span></label><div class="input"><input placeholder="Name" id="reply-author" name="author" type="text" value="" size="30" aria-required="true" /></div></div>',
            '<div class="field"><label for="reply-email">Email <span class="required">*</span></label><div class="input"><input placeholder="Email" id="reply-email" name="email" type="text" value="" size="30" aria-required="true" /></div></div>',
            '<div class="field"><label for="reply-url">Website</label><div class="input"><input id="reply-url" name="url" type="text" value="" size="30" placeholder="Website" /></div></div>',
        );

        return $fields;
    }
    function comment_form_field_comment(){
        $current_user = wp_get_current_user();
         if ( ($current_user instanceof WP_User) ) {
             $id = $current_user->ID;
             $avatar = get_avatar( $current_user->user_email, 75 );
         }
         $label = $id > 0 ? $avatar : 'Comment <span class="required">*</span>';
        return '<div class="comment-f field"><label for="reply-comment">'.$label.'</label><div class="input"><textarea placeholder="Share your insights with us..." id="reply-comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></div>';
    }

    /**
     * The Gallery shortcode.
     *
     * This implements the functionality of the Gallery Shortcode for displaying
     * WordPress images on a post.
     *
     * @param array $attr Attributes of the shortcode.
     * @return string HTML content to display gallery.
     */
    function post_gallery($output, $attr) {

        $post = get_post();
        
        static $instance = 0;
        $instance++;

        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) )
                $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
        }

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post ? $post->ID : 0,
            'itemtag'    => 'div',
            'icontag'    => 'div',
            'captiontag' => 'p',
            'columns'    => 2,
            'size'       => '-lean-thumb',
            'include'    => '',
            'exclude'    => '',
            'link'       => ''
        ), $attr, 'gallery'));
        
        $columns = intval($columns);
        switch($columns){
            case 1:
            $size = '-lean-full'; break;
            case 2:
            $size = '-lean-thumb'; break;
            case 3:
            $size = '-lean-thumb-3'; break;
            case 4:
            default:
            $size = '-lean-thumb-4'; break;
            
        }

        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $icontag = tag_escape($icontag);
        $valid_tags = wp_kses_allowed_html( 'post' );
        if ( ! isset( $valid_tags[ $itemtag ] ) )
            $itemtag = 'dl';
        if ( ! isset( $valid_tags[ $captiontag ] ) )
            $captiontag = 'dd';
        if ( ! isset( $valid_tags[ $icontag ] ) )
            $icontag = 'dt';

        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-$instance";

        $gallery_style = $gallery_div = '';
        
        $size_class = sanitize_html_class( $size );
        $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
        
        $output = $gallery_div;

        $i = 0;
        foreach ( $attachments as $id => $attachment ) {
            if ( ! empty( $link ) && 'file' === $link )
                $image_output = wp_get_attachment_link( $id, $size, false, false );
            elseif ( ! empty( $link ) && 'none' === $link )
                $image_output = wp_get_attachment_image( $id, $size, false );
            else
                $image_output = wp_get_attachment_link( $id, $size, true, false );

            $image_meta  = wp_get_attachment_metadata( $id );

            $orientation = '';
            if ( isset( $image_meta['height'], $image_meta['width'] ) )
                $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';

            $output .= "<{$itemtag} class='gallery-item'>";
            $output .= "
                <{$icontag} class='gallery-icon {$orientation}'>
                    $image_output
                </{$icontag}>";
            if ( $captiontag && trim($attachment->post_excerpt) ) {
                $output .= "
                    <{$captiontag} class='wp-caption-text gallery-caption'>
                    " . wptexturize($attachment->post_excerpt) . "
                    </{$captiontag}>";
            }
            $output .= "</{$itemtag}>";
            if ( $columns > 0 && ++$i % $columns == 0 )
                $output .= '<br style="clear: both" />';
        }

        $output .= "
            </div>\n";

        return $output;
    }


};

function _lean_paginavi(){
    global $wp_query;

    $inf = 999999;

    $args = array(
        'base'         => str_replace($inf, '%#%', get_pagenum_link($inf)),
        'total'        => $wp_query->max_num_pages,
        'current'      => max( 1, get_query_var('paged') ),
        'prev_text'    => __('« Previous'),
        'next_text'    => __('Next »'),
        'type'         => 'list',
    );
    echo paginate_links( $args );
}


$_lean_theme = new LeanTheme();
?>
