<?php
/**
 * Template Name: Used Functions
 *
 * Description: Revolution loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Revolution
 * @since Revolution 1.0
 */

get_header(); ?>

<div id="main" class="wrapper">
	
	<?php 
		/*======================================================
		 *       PAGE HEADER OR BANNER SECTION 
		 *====================================================== */
			
			get_template_part( 'page-templates/page/page', 'header' ); 
	?>
<!---  .page-content-section Start -->
	<div class="page-content-section pt-5 pb-5">
		<div class="container">
			<div class="full-width">
				<div id="content">

					<?php while ( have_posts() ) : the_post(); ?>
						<?php echo '<h3 class="entry-title">'.get_the_title().'</h3>';?>
						<?php the_content(); ?>				
					<?php endwhile; // end of the loop. ?>
					<section class="function-list">
						<div class="row">
							<div class="col-md-12 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
								<h3>List of all functions those are used in the theme. These all functions are listed on the <strong>"functions.php"</strong> file.</h3>
								<table class="table table-striped">
									<thead>
									  <tr>
										<th>SNo.</th>
										<th>Function</th>
										<th>Descriptions</th>									
									  </tr>
									</thead>
									<tbody>
									  <tr>
										<td>1</td>
										<td>debug()</td>
										<td>This function is used for print array in directly</td>
									  </tr>
									  <tr>
										<td>2</td>
										<td>options()</td>
										<td>This function is used for get Theme Option Value just pass the argument value withing the function</td>
									  </tr>
									  <tr>
										<td>3</td>
										<td>my_login_logo()</td>
										<td>This function is To manage design of Admin Login Window.</td>
									  </tr>
									  <tr>
										<td>4</td>
										<td>custom_loginlogo_url()</td>
										<td>This function is to Change the admin Login window, Logo URL</td>
									  </tr>
									  <tr>
										<td>5</td>
										<td>my_login_logo_url_title()</td>
										<td>This function to Change the admin Login window, Logo Title</td>
										
									  </tr>
									  <tr>
										<td>6</td>
										<td>acf_google_map_api()</td>
										<td>This function to Add google MAP api key</td>
									  </tr>
									  
									  <tr>
										<td>7</td>
										<td>show_pagination() </td>
										<td>This function used to print pagination</td>
									  </tr>
									  <tr>
										<td>8</td>
										<td>show_breadcrumb() </td>
										<td>This function used to print Breadcrumbs</td>
									  </tr>
									  <tr>
										<td>9</td>
										<td>logo_header() </td>
										<td>This function used to print Logo of website</td>
									  </tr>
									  <tr>
										<td>10</td>
										<td>social_list() </td>
										<td>This function used to print Social Media Links with icon</td>
									  </tr>
									  <tr>
										<td>11</td>	
										<td>google_analytics_code() </td>
										<td>This function used to GA Code in header</td>
									  </tr>
									  <tr>
										<td>12</td>	
										<td>scipt_print_in_body() </td>
										<td>This function used to print Scripts below just body start</td>
									  </tr>
									  <tr>
										<td>13</td>	
										<td>wp_maintenance_mode() and maintinance_label_in_admin_bar() </td>
										<td>This function used to enable maintinance mode on website</td>
									  </tr>
									  <tr>
										<td>14</td>	
										<td>footer_area() </td>
										<td>This function used to print the Footer(Widget Area as top footer, Social, Menu and Copyright as bottom footer.)</td>
									  </tr>
									</tbody>
									<tfoot>
									  <tr>
										<th>SNo.</th>
										<th>Function</th>
										<th>Descriptions</th>									
									  </tr>
									</tfoot>
								  </table
							</div>
							</div>						
						</div>
					</section>
					<section class="how-to-use">
						<div class="row">
							<div class="col-md-12 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
								<h3> How to Use </h3>
							</div>
						</div>
					</section>
					<section class="how-to-use-elements">
						<div class="row">
							<div class="col-md-12 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
								<h3> Use of Buttons</h3>
								<button type="button" class="btn">Basic</button>
								<button type="button" class="btn btn-default">Default</button>
								<button type="button" class="btn btn-primary">Primary</button>
								<button type="button" class="btn btn-success">Success</button>
								<button type="button" class="btn btn-info">Info</button>
								<button type="button" class="btn btn-warning">Warning</button>
								<button type="button" class="btn btn-danger">Danger</button>
								<button type="button" class="btn btn-link">Link</button>
								
								<h3> Use of alerts</h3>
								<div class="alert alert-success">
								  <strong>Success!</strong> Indicates a successful or positive action.
								</div>

								<div class="alert alert-info">
								  <strong>Info!</strong> Indicates a neutral informative change or action.
								</div>

								<div class="alert alert-warning">
								  <strong>Warning!</strong> Indicates a warning that might need attention.
								</div>

								<div class="alert alert-danger">
								  <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
								</div>

							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div><!-- .page-content-section -->
</div>

<?php get_footer(); ?>
