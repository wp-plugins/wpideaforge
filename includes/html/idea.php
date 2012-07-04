<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

<form method="post" action=""  class="wpideaforge_vote">
<input type="hidden" name="postId" value="<?php echo $post->ID; ?>">
<div class="wpideaforge_vote">
		<div class="wpideaforge_vote_submit">
			<button class="wpideaforge_vote_submit">+</button>
		</div>
                <div class="wpideaforge_vote_counter">
                        <?php echo get_post_meta( $post->ID, 'wpideaforge_counter', true); ?>
                </div>
		<div class="wpideaforge_vote_title">
			<p><?php the_title(); ?></p> 
		</div>
		<div style="clear: both;"></div>
</div>
</form>

<?php endwhile; ?>