<?php
$kbw_logo = kbw_get_option('logo');
$logo_url = $kbw_logo['url'] ? $kbw_logo['url'] : '';

$redirect_url_on_signup = kbw_get_current_page_url();

if (!is_user_logged_in()) {
    if (get_option('users_can_register')) {
        $signup_desc = ''; ?>

        <div id="kabiweb-signup" class="kabiweb-signup">
            <div class="notification">
                <span></span>
            </div>
            <form name="registerform" action="" method="post">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="user-login"><?php echo __('User name', 'kbw'); ?></label>
                            <input type="text" name="user_login" id="user-login" class="form-control" value="" required="required" placeholder="<?php echo __('User name', 'kbw'); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="user-email"><?php echo __('Email', 'kbw'); ?></label>
                            <input type="email" name="user_email" id="user-email" class="form-control" value="" required="required" placeholder="Email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="first-name"><?php echo __('First name', 'kbw'); ?></label>
                            <input type="text" name="first_name" id="first-name" class="form-control" value="" required="required" placeholder="<?php echo __('First name', 'kbw'); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="last-name"><?php echo __('Last name', 'kbw'); ?></label>
                            <input type="text" name="last_name" id="last-name" class="form-control" value="" required="required" placeholder="<?php echo __('Last name', 'kbw'); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="user-pass"><?php echo __('Password', 'kbw'); ?></label>
                            <input type="password" name="user_pass" id="user-pass" class="form-control" required="required" placeholder="<?php echo __('Password', 'kbw'); ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label class="control-label" for="user-pass-confirm"><?php echo __('Confirm Password', 'kbw'); ?></label>
                            <input type="password" name="user_pass_confirm" id="user-pass-confirm" class="form-control" required="required" placeholder="<?php echo __('Confirm Password', 'kbw'); ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="agree" class="custom-control-input" id="customCheck2">
                        <label class="custom-control-label" for="customCheck2">
                            I agree to all
                            <a href="javascript:void(0)">Terms</a>
                        </label>
                    </div>
                </div>
                <div class="form-action form-group text-center ">
                    <input type="hidden" name="kbw_register_nonce" value="<?php echo wp_create_nonce('kbw-register-nonce'); ?>"/>
                    <input type="hidden" name="action" value="kbw_signup_user">
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_url_on_signup) ?>">
                    <button type="submit" class="signup ajax btn btn-block btn-info"><?php echo __('SIGN UP', 'kbw'); ?></button>
                </div>
            </form>
            <div class="seperator"></div>
            <p class="text-center">
                <?php echo __("Already have an account?", 'kbw'); ?>
                <a href="#kabiweb-login" class="goto-login kbw-popupbox"><?php _e('Login', 'kbw'); ?></a>
            </p>
        </div>
        
        <?php
    }
}