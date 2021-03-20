<?php
/*
Template Name: about
*/
?>
<?php
$img_dir;
$dir_name = 'about';
$meta_title = '';
$meta_desc = '';
?>
<?php include_once('header.php'); ?>
<?php
$img_dir = $temp_dir . '/assets/images/' . $dir_name;
?>

<div class="b_container" data-barba="container" data-barba-namespace="about">
<div id="page_about" class="page_container">

<?php
$about = get_page_by_path('get_page_by_path');
$page_id = $about->ID;
$ja_name = get_field('ja_name', $page_id);
$ja_job = get_field('ja_job', $page_id);
$ja_body = get_field('ja_body', $page_id);
$en_name = get_field('en_name', $page_id);
$en_job = get_field('en_job', $page_id);
$en_body = get_field('en_body', $page_id);
?>
<div id="profile_wrap" class="pj_t">
    <div class="inner">
        <h2>プロフィール</h2>
        
        <div class="profile_inner">
            <div class="w">
                <h3><?php echo $ja_name; ?></h3>
                <p class="job"><?php echo $ja_job; ?></p>
                
                <div class="desc">
                    <p><?php echo $ja_body; ?></p>
                </div>
            </div>
            
            <div class="w">
                <h4>Ringo Takenaka</h4>
                <p class="job"><?php echo $en_job; ?></p>
                
                <div class="desc">
                    <p><?php echo $en_body; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- <div id="page_script"><script src="<?php echo $temp_dir; ?>/assets/js/about.js"></script></div> -->
</div>
</div>
<?php include_once('footer.php'); ?>