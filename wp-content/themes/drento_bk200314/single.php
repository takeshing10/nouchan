<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package drento
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {
			while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<div class="drentoColor drentoPrevNext" style="text-align: center">
					<?php $category = get_the_category(); ?>

                    <!--カテゴリ：脳ちゃんとタマ子の場合-->
                    <?php if ($category[0]->cat_ID == 3) : ?>
						<?php
                        //記事データを取得
						$params = [
							'post_type' => 'post',
							'post_status' => 'publish', //公開
							'category__in' => 3, //脳ちゃんとタマ子
							'orderby' => 'ID',
							'order'   => 'ASC',
						];
						$wp_query_data = new \WP_Query($params);
						$posts_data = $wp_query_data->posts;

						$post_no_is = [];
						foreach ($posts_data as $post_no => $post_data)
						{
							$post_no_is[$post_data->ID] = $post_no + 1; //カウントは1始まりとする
						}

						//現在のPOST_NOをグローバル変数$postから取得
                        global $post;
						$post_no_current = $post_no_is[$post->ID];

						//前後のPOST_IDを取得
						$post_id_next = array_keys($post_no_is, $post_no_current+1);
						$post_id_prev = array_keys($post_no_is, $post_no_current-1);

						$disabled_next = '';
						$disabled_prev = '';
						if(empty($post_id_next)){$disabled_next = 'disabled';}
						if(empty($post_id_prev)){$disabled_prev = 'disabled';}

                        //記事総数
						$post_num = count($posts_data);

						/**
						 * バックナンバーの処理
						 * */
						//最初の記事
                        $first_post_id = array_keys($post_no_is, 1);

                        $post_links = [];
                        $view_unit = floor($post_num/30);
                        for($i=1; $i<=$view_unit; $i++)
                        {
                            $post_no = 30*$i;
							$post_id = array_keys($post_no_is, $post_no);
							$post_links[$post_no] = $post_id[0];
						}
						?>

                        <div class="backnumber">
                            <a href="/main/<?php echo $post_id_prev[0];?>" class="<?php echo $disabled_prev?>"><i class="fa fa-2x fa-angle-double-left"></i></a>
                            <span><?php echo $post_no_current?> / <?php echo $post_num; ?></span>
                            <a href="/main/<?php echo $post_id_next[0];?>" class="<?php echo $disabled_next?>"><i class="fa fa-2x fa-angle-double-right"></i></a>
                        </div>

                        <?php if($view_unit!=0):?>
                        <div class="acbox">
                            <input id="ac-1" type="checkbox" />
                            <label for="ac-1">バックナンバー</label>
                            <div class="acbox-under">
                                <?php
                                echo "<a href=\"/main/<?php echo $first_post_id[0]?>\">1</a>";
                                $counter = 0;
                                foreach ($post_links as $post_no => $post_id)
                                {
									echo "<a href=\"/main/$post_id\">$post_no</a>";
									$counter++;
									if($counter%7 == 0)
									{
										echo "<br>";
									}
								}
                                ?>
                            </div>
                        </div>
						<?php endif; ?>

                    <!--カテゴリ：脳ちゃんのトリセツの場合-->
					<?php elseif ($category[0]->cat_ID == 4): ?>
                            <a href="/category/manual">戻る</a>
                    <?php else: ?>
                            <a href="/">戻る</a>
					<?php endif; ?>
                </div>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop.
		} ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>


