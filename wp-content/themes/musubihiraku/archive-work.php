<?php
$img_dir;
$dir_name = 'work';
$meta_title = '';
$meta_desc = '';
?>
<?php include_once('header.php'); ?>
<?php
$img_dir = $temp_dir . '/assets/images/' . $dir_name;
?>

<div class="b_container" data-barba="container" data-barba-namespace="work">
<div id="page_work" class="page_container">

<?php
$home_posts = query_posts(array(
    'post_type' => 'work',
    'posts_per_page' => 30,
    'post_status' => 'publish',
    'paged' => $paged
));
?>
<div class="post_list pj_t">
    <ul>
<?php foreach($home_posts as $p):
$post_id = $p->ID;
$link = get_permalink($post_id);

$repeater = get_field('p_repeater', $post_id);
$img;

$num = 0;
foreach($repeater as $r){
if($num == 0){
$radio = $r['radio'];
if($radio == 'img'){
    $img = $r['p_img'];
    $img = wp_get_attachment_image_src($img, 'thumbnail');
    $num += 1;
}
}}
?>
        <li><a href="<?php echo $link; ?>" class="set_bg lazy"><img data-src="<?php echo $img[0]; ?>" alt=""></a></li>
<?php endforeach; ?>
    </ul>
</div>




<div id="page_nav" class="plx">
<?php wp_paginate();?>
</div>

<?php
wp_reset_postdata();
wp_reset_query();
?>


</div>
</div>
<?php include_once('footer.php'); ?>