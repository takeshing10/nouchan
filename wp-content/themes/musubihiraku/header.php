<?php
header( 'Etag:' . time() );
global $dir_name, $dir_category, $sub_name, $meta_title, $meta_desc, $meta_keyword, $sub_dir, $ogimage, $contact_template;

$temp_dir = get_bloginfo('template_directory');
$unique_id = date('ymdhis');

$current_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

$site_title = 'RINGO TAKENAKA | 絵描き・絵本作家　竹中りんご';
$meta_title = 'RINGO TAKENAKA | 絵描き・絵本作家　竹中りんご';
$meta_desc = 'RINGO TAKENAKA | 絵描き・絵本作家　竹中りんご';
if(!$ogimage) $ogimage = $temp_dir . '/assets/images/og.jpg';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<title><?php echo $meta_title; ?></title>
<meta name="description" content="<?php echo $meta_desc; ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo $meta_title; ?>">
<meta name="twitter:site" content="<?php echo $site_title; ?>">
<meta name="twitter:url" content="<?php echo $current_url; ?>">
<meta name="twitter:image" content="<?php echo $ogimage; ?>">
<meta name="twitter:creator" content="">
<meta property="og:url" content="<?php echo $current_url; ?>" />
<meta property="og:image" content="<?php echo $ogimage; ?>" />
<meta property="og:title" content="<?php echo $meta_title; ?>" />
<meta property="og:site_name" content="<?php echo $site_title; ?>" />
<meta property="og:type" content="website" />
<meta property="fb:app_id" content="" />
<link rel="stylesheet" href="<?php echo $temp_dir; ?>/assets/css/setting.css?d=<?php echo $unique_id; ?>" />
<link rel="stylesheet" href="<?php echo $temp_dir; ?>/assets/css/common_pc.css?d=<?php echo $unique_id; ?>" />
<link rel="stylesheet" href="<?php echo $temp_dir; ?>/assets/css/common_sp.css?d=<?php echo $unique_id; ?>" />
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script src="<?php echo $temp_dir; ?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo $temp_dir; ?>/assets/js/lib.js"></script>
<script src="<?php echo $temp_dir; ?>/assets/js/common.js"></script>
<?php wp_head(); ?>
</head>
<body id="<?php echo $dir_name; ?>"<?php if($dir_name != 'home'): ?> class="lv"<?php endif; ?>>
<h1 class="l"><a href="/">竹中りんご</a></h1>

<p class="ig switch_sp" data-barba-prevent="all"><a href="https://www.instagram.com/ringo_takenaka/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a></p>
<p class="tw switch_sp" data-barba-prevent="all"><a href="https://twitter.com/ringo_musubi" target="_blank"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 250 203.18" style="enable-background:new 0 0 250 203.18;" xml:space="preserve"><path d="M78.62,203.18C173,203.18,224.56,125,224.56,57.24q0-3.33-.15-6.63A104.24,104.24,0,0,0,250,24.05a102.11,102.11,0,0,1-29.46,8.08A51.52,51.52,0,0,0,243.1,3.76a103.15,103.15,0,0,1-32.57,12.45A51.34,51.34,0,0,0,123.12,63,145.59,145.59,0,0,1,17.4,9.39,51.33,51.33,0,0,0,33.28,77.87a50.87,50.87,0,0,1-23.23-6.42c0,.22,0,.43,0,.65a51.31,51.31,0,0,0,41.15,50.29,51.42,51.42,0,0,1-23.17.88,51.34,51.34,0,0,0,47.92,35.62,102.91,102.91,0,0,1-63.7,22A105.19,105.19,0,0,1,0,180.14a145.17,145.17,0,0,0,78.62,23"/></svg></a></p>


<div class="gnav_ico is_a">
    <div class="l"><span class="t"></span><span class="m"></span><span class="b"></span></div>
</div>

<div id="gnav">
    <div class="nav_wrap fz14">
        <nav>
            <ul class="site_nav">
                <li class="work <?php if($dir_name == 'work' || $dir_name == 'work-single'): ?> on<?php endif; ?>"><a href="/work/"><span>Work</span></a></li>
                <li class="about <?php if($dir_name == 'about'): ?> on<?php endif; ?>"><a href="/about/"><span>About</span></a></li>
                <li class="contact" data-barba-prevent="all"><a href="#" class="email"><span>Contact</span></a></li>
                <li class="blog" data-barba-prevent="all"><a href="https://note.com/musubihiraku" target="_blank" rel="noopener"><span>Blog</span></a></li>
                <li class="ig switch_pc" data-barba-prevent="all"><a href="https://www.instagram.com/ringo_takenaka/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a></li>
                <li class="tw switch_pc" data-barba-prevent="all"><a href="https://twitter.com/ringo_musubi" target="_blank"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 250 203.18" style="enable-background:new 0 0 250 203.18;" xml:space="preserve"><path d="M78.62,203.18C173,203.18,224.56,125,224.56,57.24q0-3.33-.15-6.63A104.24,104.24,0,0,0,250,24.05a102.11,102.11,0,0,1-29.46,8.08A51.52,51.52,0,0,0,243.1,3.76a103.15,103.15,0,0,1-32.57,12.45A51.34,51.34,0,0,0,123.12,63,145.59,145.59,0,0,1,17.4,9.39,51.33,51.33,0,0,0,33.28,77.87a50.87,50.87,0,0,1-23.23-6.42c0,.22,0,.43,0,.65a51.31,51.31,0,0,0,41.15,50.29,51.42,51.42,0,0,1-23.17.88,51.34,51.34,0,0,0,47.92,35.62,102.91,102.91,0,0,1-63.7,22A105.19,105.19,0,0,1,0,180.14a145.17,145.17,0,0,0,78.62,23"/></svg></a></li>
            </ul>
        </nav>
    </div>
    <p class="overlay"></p>
</div>

<main id="wrap">
<div class="pj_container" data-barba="wrapper">