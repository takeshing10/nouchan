<?php
$img_dir;
$dir_name = 'work-single';
$meta_title = '';
$meta_desc = '';

$repeater = get_field('p_repeater', $post_id);
$img;

$num = 0;
foreach($repeater as $r){
if($num == 0){
$radio = $r['radio'];
if($radio == 'img'){
    $img = $r['p_img'];
    $img = wp_get_attachment_image_src($img, 'large');
    $num += 1;
}
}}
$ogimage = $img[0];
        
?>
<?php include_once('header.php'); ?>
<?php
$img_dir = $temp_dir . '/assets/images/' . $dir_name;
?>

<div class="b_container" data-barba="container" data-barba-namespace="work-single">
<div id="page_work-single" class="page_container">

<div id="post_body" class="pj_t">
<?php
$post_id = $post->ID;
$repeater = get_field('p_repeater', $post_id);
foreach($repeater as $r):
$radio = $r['radio'];
?>

<?php if($radio == 'img'):
$img = $r['p_img'];
$img = wp_get_attachment_image_src($img, 'medium');
?>
<div class="img"><img data-src="<?php echo $img[0]; ?>" src="<?php echo $img[0]; ?>" alt=""></div>
<?php endif; ?>


<?php if($radio == 'txt'):
$txt = $r['p_txt'];
?>
<div class="txt_wrap">
<?php echo $txt; ?>
</div>
<?php endif; ?>

<?php endforeach; ?>
</div>

<?php
$next_post = get_next_post();
$prev_post = get_previous_post();
?>
<div class="fixed_container">
<?php if($prev_post): ?>
<p class="next_post pj_t"><a href="/work/<?php echo $prev_post->ID; ?>.html"><span class="w"><span class="t"></span><span class="b"></span></span></a><p>
<?php endif; ?>
    
<?php if($next_post): ?>
<p class="prev_post pj_t"><a href="/work/<?php echo $next_post->ID; ?>.html"><span class="w"><span class="t"></span><span class="b"></span></span></a><p>
<?php endif; ?>
</div>


</div>
</div>

<?php include_once('footer.php'); ?>