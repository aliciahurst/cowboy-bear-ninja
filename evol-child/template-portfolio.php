
<?php
/*
Template Name: Portfolio
*/

get_header(); ?>
	

	
	<main id="main">
		<div class="inner">
			<div id="primary" role="main"><?php
				while ( have_posts() ) : the_post();
					the_content();
				endwhile; ?>
				<?php $tr_portfolio_filter = ot_get_option( 'tr_portfolio_filter', 'yes' ); if ( $tr_portfolio_filter != 'no' ) { ?>
					<div id="filter">
							<ul>
							<li><a href="#" value="*" class="all">Show All</a></li>
							<li><a href="#" value=".animation">Animation</a></li>
							<li><a href="#" value=".commercials">Commercials</a></li>
							<li><a href="#" value=".web">Web</a></li>
							<li><a href="#" value=".promos">Promos</a></li>
							<li><a href="#" value=".documentary">Documentary</a></li>
							<li><a href="#" value=".film">Film</a></li>
							<li><a href="#" value=".nonprofit">Nonprofit</a></li>
							</ul>
					</div>
					<div class="clearfix"> </div>
				<?php } ?>

				<div id="portfolio"><div class="portfolio-inner clearfix"><?php
					$tr_projects_per_page = ot_get_option( 'tr_projects_per_page', '-1' );
					$tr_portfolio_nav = ot_get_option( 'tr_portfolio_nav', 'no' );
	

					if ( get_query_var( 'paged' ) ) $paged = get_query_var( 'paged' );
					elseif ( get_query_var( 'page' ) ) $paged = get_query_var( 'page' );
					else $paged = 1;
					
					query_posts( array( 'post_type' => 'portfolio', 'category__not_in' => array(22, 19) , 'posts_per_page' => $tr_projects_per_page, 'paged' => $paged ) );
					
					while ( have_posts() ) : the_post();
						get_template_part( 'content-portfolio' );
					endwhile; ?>
    			</div></div>
    			<div class="clearfix"></div>
    			<?php if ( $tr_portfolio_nav != 'no' ) tr_pagination(); ?>
			</div>
		</div>
	</main>

<?php get_footer(); ?>