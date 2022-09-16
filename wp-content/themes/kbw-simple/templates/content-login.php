<?php
$kbw_logo = kbw_get_option('logo');
$logo_url = $kbw_logo['url'] ? $kbw_logo['url'] : '';

$redirect_url_on_login = kbw_get_current_page_url();
?>

<div id="kabiweb-login" class="kabiweb-login">
    <div class="notification">
        <span></span>
    </div>
    <form name="loginform" action="" method="post">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" name="user_login" tabindex="1" class="form-control" placeholder="<?php _e('User name', 'kbw'); ?>" aria-label="User name" aria-describedby="basic-addon1" required="required">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-pencil"></i></span>
            </div>
            <input type="password" name="user_pass" tabindex="2" class="form-control" placeholder="<?php _e('Password', 'kbw'); ?>" aria-label="Password" aria-describedby="basic-addon1" required="required">
        </div>
        <div class="form-group">
            <div class="custom-control custom-checkbox form-control border-0">
                <input type="checkbox" name="rememberme" tabindex="3" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember me</label>
                <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="forgot-password text-dark float-right"><i class="fa fa-lock mr-1"></i><?php _e('Forgot password?', 'kbw'); ?>
                </a>
            </div>
        </div>
        <div class="form-action form-group text-center">
            <input type="hidden" name="kbw_login_nonce" value="<?php echo wp_create_nonce('kbw-login-nonce'); ?>"/>
            <input type="hidden" name="action" value="kbw_login_user">
            <input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_url_on_login) ?>">
            <button tabindex="4" class="login ajax btn btn-block btn-info"><?php _e('LOG IN', 'kbw') ?></button>
        </div>

        <div class="form-group text-center">
            <div class="social form-control border-0">
                <a href="javascript:void(0)" class="btn btn-facebook" data-toggle="tooltip" title="" data-original-title="Login with Facebook"><i aria-hidden="true" class="fa fa-facebook"></i></a>
                <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="" data-original-title="Login with Google"><i aria-hidden="true" class="fa fa-google-plus"></i>
                </a>
            </div>
        </div>
    </form>
    <?php if (get_option('users_can_register')) { ?>
        <div class="seperator"></div>
        <p class="text-center">
            <?php echo __("Don't have an account?", 'kbw'); ?>
            <a href="#kabiweb-signup" class="goto-signup kbw-popupbox"><?php _e('Sign up', 'kbw'); ?></a>
        </p>
    <?php } ?>
</div>
