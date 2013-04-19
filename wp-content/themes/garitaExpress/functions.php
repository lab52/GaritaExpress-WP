<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	// register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */



	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );
		
		wp_register_script( 'calculadora', get_template_directory_uri().'/_/js/calculadora.js', array( 'jquery' ) );
		wp_register_script( 'faq', get_template_directory_uri().'/_/js/faq.js', array( 'jquery' ) );
		wp_register_script( 'carousel', get_template_directory_uri().'/_/js/jquery.carouFredSel-6.1.0-packed.js', array( 'jquery' ) );
		wp_register_script( 'mousewheel', get_template_directory_uri().'/_/js/helper-plugins/jquery.mousewheel.min.js', array( 'jquery' ) );
		wp_register_script( 'touchSwipe', get_template_directory_uri().'/_/js/helper-plugins/jquery.touchSwipe.min.js', array( 'jquery' ) );
		wp_register_script( 'deBounce', get_template_directory_uri().'/_/js/helper-plugins/jquery.ba-throttle-debounce.min.js', array( 'jquery' ) );
		wp_register_script( 'organictabs', get_template_directory_uri().'/_/js/organictabs.jquery.js', array( 'jquery' ) );
		wp_register_script( 'kkcountdown', get_template_directory_uri().'/_/js/kkcountdown.min.js', array( 'jquery' ) );
		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
        
        if ( is_front_page() ) {
        	wp_enqueue_script('calculadora');
        	add_action( 'wp_head', 'calculadora_initialize' );
        }
        
        if ( is_page('preguntas') ) {
        	wp_enqueue_script('faq');
        	wp_enqueue_script('organictabs');
        	add_action( 'wp_head', 'preguntas_initialize' );
        }
        
        if ( is_page('ofertas') ) {
        	wp_enqueue_script('carousel');
        	wp_enqueue_script('mousewheel');
        	wp_enqueue_script('touchSwipe');
        	wp_enqueue_script('deBounce');
        	add_action( 'wp_head', 'ofertas_initialize' );
        }
        
        if ( is_page('ganga-express') ) {
        	wp_enqueue_script('kkcountdown');
        	add_action( 'wp_head', 'ganga_express_initialize' );
        }
	}
	
	function calculadora_initialize(){ ?>
		<script type="text/javascript" charset="utf-8">
			jQuery(window).load(function() {
			  jQuery('#calForm').live({
			    mouseover:
			    function (e) {
			    doCalc();
			    }
			  });
			});
		</script>
		<?php }
		
	function preguntas_initialize(){ ?>
		<script type="text/javascript">
		  jQuery(window).load(function() {
		 	 jQuery('#faq-slider').organicTabs();
		  });
		 </script>
		<?php }
	
	function ofertas_initialize(){ ?>
		<script type="text/javascript">
		jQuery(window).load(function() {
			jQuery('#foo0').carouFredSel({
				auto: false,
				prev: '#prev0',
				next: '#next0',
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		
			jQuery('#foo1').carouFredSel({
				auto: false,
				prev: '#prev1',
				next: '#next1',
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		
			jQuery('#foo2').carouFredSel({
				auto: false,
				prev: '#prev2',
				next: '#next2',
				pagination: "#pager2",
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
			function test(){
				console.log('si cargo');
			}
		});
		</script>
		<?php }
	function ganga_express_initialize(){ ?>
		<script type="text/javascript">
		        jQuery(window).load(function(){
		            jQuery(".kkcount-down-1").kkcountdown({
		            	dayText		: 'day ',
		            	daysText 	: 'days ',
		                hoursText	: 'h ',
		                minutesText	: 'm ',
		                secondsText	: 's',
		                displayZeroDays : false,
		                callback	: test,
		                oneDayClass	: 'one-day'
		            });
		            jQuery(".kkcount-down").kkcountdown({
		            	dayText		: 'd ',
		            	daysText 	: 'd ',
		                hoursText	: ':',
		                minutesText	: ':',
		                secondsText	: '',
		                displayZeroDays : false,
		                callback	: test,
		                addClass	: 'shadow'
		            });
		        });
		        function test(){
		        	console.log('KONIEC');
		        }
		    </script>
		<?php }	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
	
	// Create Slider Post Type
	require( get_template_directory() . '/inc/slider/slider_post_type.php' );
	// Create Slider
	require( get_template_directory() . '/inc/slider/slider.php' );
		