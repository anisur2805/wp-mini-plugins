<?php
defined('ABSPATH') || die('Nice Try!');

get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<article class="post-news" id="post-new-<?php echo get_the_ID(); ?>">
				<?php 

				if(have_posts()):
					while (have_posts()):
						the_post();
						the_title('<h3 class="title">', '</h3>');
						$value = get_option('ardev_option_1');

						echo '<h3>'.$value.'</h3>';
						the_content('<p>', '</p>');
					endwhile;
				endif;

				?>
			</article>
		</div>
	</div>
</div>
<?php get_footer(); ?>