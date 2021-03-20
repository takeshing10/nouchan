<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package drento
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-9" class="post-9 page type-page status-publish hentry">
            <div class="profile">
                <div class="profile-image">
                    <img src="https://nouchan.com/wp-content/uploads/2021/03/ringo.jpg" alt="" width="400">
                </div>
                <div class="profile-text">
                    <p class="has-text-align-left">
                        <span style="font-size: 20px">竹中りんご</span><br>
                        絵描き・文字書き
                    </p>
                    <p class="has-text-align-left">
                        石川県生まれ。<br>
                        京都造形芸術大学映像科卒。<br>
                        マバタキ製作所(Yellow Brain)を経て<br>
                        2012年よりクリエイティブチーム「おムすび」で活動をはじめ、ミュージックビデオやCM、Eテレ「デザインあ」の一部コンテンツのプランニングやイラストを担当。<br>
                        2021年よりフリーでの活動開始。<br>
                        東京在住。
                    </p>
                    <p class="has-text-align-left">
                        お仕事のご依頼はこちらまで
                        <a href="mailto:musubihiraku@gmail.com" data-type="mailto" data-id="mailto:musubihiraku@gmail.com" style="color: #404040; padding-left: 5px;">
                            <i class="fa fa-envelope-o fa-2x"><span class="screen-reader-text">Homepage</span></i>
                        </a>
                    </p>
                </div>
            </div>
        </article>
    </main><!-- #main -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
