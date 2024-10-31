<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Post types
 *
 * DM Page Creation
 *
 * @class 		OSPTAbout
 * @version		1.2
 * @category	Class
 * @author 		Jinesh, Senior Software Engineer
 */
 
if ( ! class_exists( 'OSPTAbout' ) ) :

	class OSPTAbout { 
	
		/**
		 * Constructor
		 */
		
		public function __construct() { 
			
			add_action( 'admin_menu', array( $this, 'ospt_admin_menu' ) );
		}

		/**
		 * Creating a admin setting menu for design maker
		 */
		 
		public function ospt_admin_menu() {
			
			add_submenu_page( 'edit.php?post_type=ospt-pricing-table', __( 'About Offshorent', OSPT_TEXT_DOMAIN ), __( 'About', OSPT_TEXT_DOMAIN ), 'manage_options', 'about-developer', array( $this, 'about_ospt_developer' ) );
		}

		/**
		* about_ourteam_developer for ourteam blog
		*
		* @since  1.2
		*/
	
		public function about_ospt_developer() {
	
			ob_start();
			?>
			<div class="wrap">
				<div id="dashboard-widgets">
					<h2><?php _e( "About Offshorent", "OSPT_TEXT_DOMAIN" );?></h2> 
					<div class="postbox-container">
						<div class="meta-box-sortables ui-sortable">
							<h2><?php _e( "We build your team. We build your trust..", "OSPT_TEXT_DOMAIN"  );?></h2>
							<img src="<?php echo OSPT_PLUGIN_URL;?>/images/about.jpg" alt="" width="524">
							<p><?php _e( "We are experts at building web and mobile products. And more importantly, we are committed to building your trust. We are a leading offshore outsourcing center that works primarily with digital agencies and software development firms. Offshorent was founded by U.S. based consultants specializing in software development and who built a reputation for identifying the very best off-shore outsourcing talent. We are now applying what we learned over the past ten years with a mission to become the world’s most trusted off-shore outsourcing provider.", "OSPT_TEXT_DOMAIN"  );?></p>
							<ul class="offshorent">
								<li><a href="http://offshorent.com/services" target="_blank"><?php _e( "Services", "OSPT_TEXT_DOMAIN"  );?></a></li>
								<li><a href="http://offshorent.com/our-work" target="_blank"><?php _e( "Our Works", "OSPT_TEXT_DOMAIN"  );?></a></li>
								<li><a href="http://offshorent.com/clients-speak" target="_blank"><?php _e( "Testimonials", "OSPT_TEXT_DOMAIN"  );?></a></li>
								<li><a href="http://offshorent.com/our-team" target="_blank"><?php _e( "Our Team", "OSPT_TEXT_DOMAIN"  );?></a></li>
								<li><a href="http://offshorent.com/process" target="_blank"><?php _e( "Process", "OSPT_TEXT_DOMAIN"  );?></a></li>
								<li><a href="http://offshorent.com/life-offshorent" target="_blank"><?php _e( "Life @ Offshorent", "OSPT_TEXT_DOMAIN"  );?></a></li>
								<li><a href="https://www.facebook.com/Offshorent" target="_blank"><?php _e( "Facebook Page", "OSPT_TEXT_DOMAIN"  );?></a></li>
								<li><a href="http://offshorent.com/blog" target="_blank"><?php _e( "Blog", "OSPT_TEXT_DOMAIN"  );?></a></li>
							</ul>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>	
					</div>
					<div class="postbox-container">
						<div class="meta-box-sortables ui-sortable">
							<h2><?php _e( "Contact Us", "OSPT_TEXT_DOMAIN"  );?></h2>
							<p><?php _e( "Email:" , "OSPT_TEXT_DOMAIN"  );?><a href="mailto:<?php _e( "info@offshorent.com", "OSPT_TEXT_DOMAIN"   );?>"><?php _e( "info@offshorent.com", "OSPT_TEXT_DOMAIN"  );?></a></p>
							<p><?php _e( "Project Support:" , "OSPT_TEXT_DOMAIN"  );?><a href="mailto:<?php _e( "project-support@offshorent.com", "OSPT_TEXT_DOMAIN"  );?>"><?php _e( "project-support@offshorent.com", "OSPT_TEXT_DOMAIN"  );?></a></p>
							<p><?php _e( "Phone - US Office:" , "OSPT_TEXT_DOMAIN"  );?><?php _e( "+1(484) 313 – 4264", "OSPT_TEXT_DOMAIN"  );?></p>					
							<p><?php _e( "Phone - India:" , "OSPT_TEXT_DOMAIN"  );?><?php _e( "+91 484 – 2624225", "OSPT_TEXT_DOMAIN" );?></p>
							<div class="location-col">
								<b><?php _e( "Philadelphia / USA", "OSPT_TEXT_DOMAIN" );?></b>
								<p><?php _e( "1150 1st Ave #501,<br> King Of Prussia,PA 19406<br> Tel: (484) 313 &ndash; 4264 <br>Email ", "OSPT_TEXT_DOMAIN" );?><a href="mailto:<?php _e( "philly@offshorent.com", "OSPT_TEXT_DOMAIN" );?>"><?php _e( "philly@offshorent.com", "OSPT_TEXT_DOMAIN" );?></a></p>
							</div>
							<div class="location-col">
								<b><?php _e( "Chicago / USA", "OSPT_TEXT_DOMAIN" );?></b>
								<p><?php _e( "233 South Wacker Drive, Suite 8400,<br> Chicago, IL 60606<br> Tel: (312) 380 &ndash; 0775 <br>Email: ", "OSPT_TEXT_DOMAIN" );?><a href="mailto:chicago@offshorent.com"><?php _e( "chicago@offshorent.com", "OSPT_TEXT_DOMAIN" );?></a></p>
							</div>
							<div class="location-col">
								<b><?php _e( "California / USA", "OSPT_TEXT_DOMAIN" );?></b>
								<p><?php _e( "17311 Virtuoso. #102 Irvine,<br> CA 92620 <br>Tel: +1 949 391 1012 <br>Email: ", "OSPT_TEXT_DOMAIN" );?><a href="mailto:<?php _e( "california@offshorent.com", "OSPT_TEXT_DOMAIN" );?>"><?php _e( "california@offshorent.com", "OSPT_TEXT_DOMAIN" );?></a></p>
							</div>
							<div class="location-col">
								<b><?php _e( "Sydney / AUSTRALIA", "OSPT_TEXT_DOMAIN" );?></b>
								<p><?php _e( "Suite 59, 38 Ricketty St, Mascot,<br> New South Wales &ndash; 2020,<br> Sydney, Australia,<br> Tel: 02 8011 3413 <br>Email: ", "OSPT_TEXT_DOMAIN" );?><a href="mailto:<?php _e( "sydney@offshorent.com", "OSPT_TEXT_DOMAIN" );?>"><?php _e( "sydney@offshorent.com", "OSPT_TEXT_DOMAIN" );?></a></p>
							</div>
							<div class="location-col">
								<b><?php _e( "Cochin / INDIA", "OSPT_TEXT_DOMAIN" );?></b>
								<p><?php _e( "Palm Lands, 3rd Floor,<br> Temple Road, Bank Jn,<br> Aluva &ndash; 01, Cochin, Kerala <br>Tel: +91 484 &ndash; 2624225 <br>Email: ", "OSPT_TEXT_DOMAIN" );?><a href="mailto:<?php _e( "aluva@offshorent.com", "OSPT_TEXT_DOMAIN" );?>"><?php _e( "aluva@offshorent.com", "OSPT_TEXT_DOMAIN" );?></a></p>
							</div>	
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="social">
					<img src="<?php echo OSPT_PLUGIN_URL;?>/images/social.png" usemap="#av92444" width="173" height="32" alt="click map" border="0" />
					<map id="av92444" name="av92444">
						<!-- Region 1 -->
						<area shape="rect" alt="Facebook" title="Facebook" coords="1,2,29,30" href="https://www.facebook.com/Offshorent" target="_blank" />
						<!-- Region 2 -->
						<area shape="rect" alt="Twitter" title="Twitter" coords="36,1,64,31" href="https://twitter.com/Offshorent" target="_blank" />
						<!-- Region 3 -->
						<area shape="rect" alt="Google" title="Google" coords="73,3,98,29" href="https://plus.google.com/+Offshorent/posts" target="_blank" />
						<!-- Region 4 -->
						<area shape="rect" alt="Linkedin" title="Linkedin" coords="110,1,136,30" href="https://www.linkedin.com/company/offshorent" target="_blank" />
						<!-- Region 5 -->
						<area shape="rect" alt="Youtube" title="Youtube" coords="145,3,169,31" href="http://www.youtube.com/user/Offshorent" target="_blank" />
						<area shape="default" nohref alt="" />
					</map>
				</div>			
			</div>
			<?php
		}
	}
	
endif;

/**
 * Returns the main instance of OSPTAbout to prevent the need to use globals.
 *
 * @since  2.0
 * @return OSPTAbout
 */
 
return new OSPTAbout();
?>
