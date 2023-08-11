<?php
/**
 * Template functions used for posts.
 *
 * @package eighteen-tags
 */

if ( ! function_exists( 'eighteen_tags_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 * @since 1.0.0
	 */
	function eighteen_tags_post_header() { ?>
		<header class="entry-header">
		<?php
		if ( is_single() ) {
			eighteen_tags_posted_on();
			the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
		} else {
			if ( 'post' == get_post_type() ) {
				eighteen_tags_posted_on();
			}

			the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

if ( ! function_exists( 'eighteen_tags_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 * @since 1.0.0
	 */
	function eighteen_tags_post_content() {
		?>
		<div class="entry-content" itemprop="articleBody">
		<?php
		eighteen_tags_post_thumbnail( 'full' );

		the_content(
			sprintf(
				__( 'Continue reading %s', 'eighteen-tags' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'eighteen-tags' ),
			'after'  => '</div>',
		) );
		?>
		</div><!-- .entry-content -->
		<?php
	}
}

if ( ! function_exists( 'eighteen_tags_post_meta' ) ) {
	/**
	 * Display the post meta
	 * @since 1.0.0
	 */
	function eighteen_tags_post_meta() {
		if ( 'post' == get_post_type() ) :

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'eighteen-tags' ) );

			if ( $categories_list && eighteen_tags_categorized_blog() ) : ?>
				<span class="post-meta cat-links">
					<?php
					echo '<span class="screen-reader-text">' . esc_attr( __( 'Categories: ', 'eighteen-tags' ) ) . '</span>';
					echo wp_kses_post( $categories_list );
					?>
				</span>
			<?php endif; // End if categories

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'eighteen-tags' ) );

			if ( $tags_list ) : ?>
					<span class="post-meta tags-links">
						<?php
						echo '<span class="screen-reader-text">' . esc_attr( __( 'Tags: ', 'eighteen-tags' ) ) . '</span>';
						echo wp_kses_post( $tags_list );
						?>
					</span>
			<?php endif; // End if $tags_list
		endif; // End if 'post' == get_post_type()
		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="post-meta comments-link">
				<?php comments_popup_link( __( 'Leave a comment', 'eighteen-tags' ), __( '1 Comment', 'eighteen-tags' ), __( '% Comments', 'eighteen-tags' ) ); ?>
			</span>
		<?php endif;
	}
}

if ( ! function_exists( 'eighteen_tags_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function eighteen_tags_paging_nav() {
		global $wp_query;

		$args = array(
			'type' 	    => 'list',
			'next_text' => _x( 'Next', 'Next post', 'eighteen-tags' ) . '&nbsp;<span class="meta-nav">&rarr;</span>',
			'prev_text' => '<span class="meta-nav">&larr;</span>&nbsp' . _x( 'Previous', 'Previous post', 'eighteen-tags' ),
			);

		the_posts_pagination( $args );
	}
}

if ( ! function_exists( 'eighteen_tags_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function eighteen_tags_post_nav() {
		$args = array(
			'next_text' => '%title &nbsp;<span class="meta-nav">&rarr;</span>',
			'prev_text' => '<span class="meta-nav">&larr;</span>&nbsp;%title',
			);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'eighteen_tags_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function eighteen_tags_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s" itemprop="datePublished">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( '%s', 'post date', 'eighteen-tags' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			_x( 'By %s', 'post author', 'eighteen-tags' ),
			'<span class="vcard author"><span class="fn" itemprop="author"><a class="url fn n" rel="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>'
		);

		echo apply_filters( 'eighteen_tags_single_post_posted_on_html', '<span class="post-meta byline"> ' . $byline . '</span><span class="post-meta posted-on">' . $posted_on . '</span>', $posted_on, $byline );

	}
}
