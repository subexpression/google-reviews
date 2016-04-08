<?php 
function starrating($val, $n, $t){

	$t = round(($t / $n) * 2) / 2;

	switch($t){
		case '0':
			$classname = '';
			break;
		case '0.1':
			$classname = 'stars-half';
			break;
		case '1':
			$classname = 'stars-one';
			break;
		case '1.5':
			$classname = 'stars-one-half';
			break;
		case '2':
			$classname = 'stars-two';
			break;
		case '2.5':
			$classname = 'stars-two-half';
			break;
		case '3':
			$classname = 'stars-three';
			break;
		case '3.5':
			$classname = 'stars-three-half';
			break;
		case '4':
			$classname = 'stars-four';
			break;
		case '4.5':
			$classname = 'stars-four-half';
			break;
		case '5':
			$classname = 'stars-five';
			break;			
	}
	$html = '<div class="stars">';
		$html .= '<div itemprop="reviewRating" class="rating-text">' . $val . ' / 5 stars</div>';
		$html .= '<div class="overall-rating">';
			$html .= 'Overall rating: ';
		$html .= '</div>';
		$html .= '<div class="rating ' . $classname . '"></div>';
		$html .= '<div class="based-on">based on ' . $n . ' reviews</div>';
		$html .= '</div>';
	$html .= '</div>';
	return $html;
}
function get_review($id, $termid){
	
	wp_reset_query();
	$args = array(
		'post_type' => 'review',
		'tax_query'      => array(
			array(
				'taxonomy' => 'reviews',
				'terms'    => array($termid),
				'field'    => 'term_id',
				'operator' => 'IN',
			)
		)
	);

	$total = 0;
	$count = 0;
	$loop = new WP_Query($args);
	while($loop->have_posts()){
		$loop->the_post();
		$total += floatval(get_post_meta(get_the_ID(), 'star_rating', true));
		$count++;
	}

	wp_reset_query();

	$args = array(
		'post_type' => 'review',
		'orderby' => 'rand',
		'posts_per_page' => 1,
		'tax_query'      => array(
			array(
				'taxonomy' => 'reviews',
				'terms'    => array($termid),
				'field'    => 'term_id',
				'operator' => 'IN',
			)
		)
	);
	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post();
		
		ob_start();
			$permalink = get_the_permalink();
			$stars = get_post_meta(get_the_ID(), 'star_rating', true);
			$name = get_post_meta(get_the_ID(), 'editor_name', true);
			$link = get_post_meta(get_the_ID(), 'review_link', true);
			$excerpt = get_post_meta(get_the_ID(), 'editor_excerpt', true);
			$date = get_the_date('Y-m-d');

			$html = '<div class="review" itemscope itemtype="http://schema.org/Review">';
				$html .= '<blockquote class="boxed-blockquote">';
					$html .= '<div itemprop="author" itemscope itemtype="http://schema.org/Person">';
						$html .=  '<span itemprop="name"><a href="' . $link . '" target="_blank">' . $name . '</a></span>'; 
					$html .= '</div>';
					$html .= '<meta itemprop="datePublished" content="' . $date . '">';
					$html .= '<span itemprop="reviewBody">';
					$html .= $excerpt;
					$html .= '</span>';
				$html .= '</blockquote>';
				$html .= starrating($stars, $count, $total);
			$html .= '</div>';

		ob_end_flush();

	endwhile;

	wp_reset_query();
	
	return $html;

}
?>