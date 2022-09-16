<?php
$footer_style = 'footer-1';
$footer_matrix = array(
    'footer-1' => array('col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6'),
    'footer-2' => array('col-md-6 col-sm-12', 'col-md-3 col-sm-6', 'col-md-3 col-sm-6'),
    'footer-3' => array('col-md-3 col-sm-6', 'col-md-3 col-sm-6', 'col-md-6 col-sm-12'),
    'footer-4' => array('col-md-6 col-sm-12', 'col-md-6 col-sm-12'),
    'footer-5' => array('col-md-4 col-sm-12', 'col-md-4 col-sm-12', 'col-md-4 col-sm-12'),
    'footer-6' => array('col-md-8 col-sm-12', 'col-md-4 col-sm-12'),
    'footer-7' => array('col-md-4 col-sm-12', 'col-md-8 col-sm-12'),
    'footer-8' => array('col-md-3 col-sm-12', 'col-md-6 col-sm-12', 'col-md-3 col-sm-12'),
    'footer-9' => array('col-sm-12'),
);
$footer_sidebar = array();
for ($i = 0; $i < count($footer_matrix[$footer_style]); $i++) {
    $footer_sidebar[$i] = 'footer-' . ($i + 1);
}
$footer_class = array('main-footer');
?>

<div class="inner">
    <div class="row <?php echo join(' ', $footer_class); ?>">
        <?php for ($i = 0; $i < count($footer_sidebar); $i++): ?>
            <?php if(is_active_sidebar($footer_sidebar[$i])): ?>
                <div class="sidebar <?php echo esc_attr($footer_matrix[$footer_style][$i]); ?>">
                    <?php dynamic_sidebar($footer_sidebar[$i]); ?>
                </div>
            <?php endif;?>
        <?php endfor; ?>
    </div>
</div>
