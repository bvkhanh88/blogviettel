<?php
/**
 * KBW Build The Options
 *
 * @package kabiweb
 * @author Khanh Bui - bvkhanh88@gmail.com
 * @since 09/02/2021
 */

function kbw_options_build($value, $option_name, $data)
{
    $elm_class = array("filed-{$value['type']}");
    if (isset($value['class']) && $value['class'] != '') {
        $elm_class[] = $value['class'];
    }
    $elm_class = implode(' ', $elm_class);
    
    ob_start();
    ?>

    <div class="option-item <?php echo $elm_class; ?>" id="<?php echo $value['id'] ?>-item">
        <span class="label"><?php echo !empty($value['name']) ? $value['name'] : ''; ?></span>
        <div class="input">
            <?php
            switch ($value['type']) {
                //Text Option
                case 'text': ?>
                    <input type="text" name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" value="<?php if (!empty($data)) echo $data; elseif (!empty($value['default'])) echo $value['default']; ?>"/>
                    <?php break;
                
                //Array Option
                case 'arrayText':
                    $currentValue = $data; ?>
                    <input type="text" name="<?php echo $option_name ?>[<?php echo $value['key']; ?>]" id="<?php echo $value['id']; ?>[<?php echo $value['key']; ?>]" class="arrayText" value="<?php if (!empty($currentValue[$value['key']])) echo $currentValue[$value['key']] ?>"/>
                    <?php break;
                
                //Number Option
                case 'number': ?>
                    <input type="number" name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" value="<?php if (!empty($data)) echo $data; elseif (!empty($value['default'])) echo $value['default']; ?>"/>
                    <?php break;
                
                //Password Option
                case 'password': ?>
                    <input type="password" name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" value="<?php if (!empty($data)) echo $data; elseif (!empty($value['default'])) echo $value['default']; ?>"/>
                    <?php break;
                
                //Checkbox Option
                case 'checkbox':
                    if (isset($data)) {
                        $checked = $data ? 'checked="checked"' : '';
                    } else {
                        $checked = '';
                    }
                    ?>
                    <input type="checkbox" name="<?php echo $option_name ?>" id="<?php echo $value['id'] ?>" class="on-of" value="true" <?php echo $checked; ?> />
                    <?php break;
                
                //Radio Option
                case 'radio': ?>
                    <div class="option-contents">
                        <?php
                        $i = 0;
                        if (!empty($value['options'])): foreach ($value['options'] as $key => $option):
                            $i++; ?>
                            <label class=""><input type="radio" name="<?php echo $option_name ?>" id="<?php echo $value['id'] . '_' . $i; ?>" class="field-radio" value="<?php echo $key ?>" <?php echo ((!empty($data) && $data == $key) || (empty($data) && $i == 1)) ? ' checked="checked"' : ''; ?>><?php echo $option; ?>
                            </label>
                        <?php endforeach;endif; ?>
                    </div>
                    <?php break;
                
                //Select Menu Option
                case 'select': ?>
                    <select name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" class="">
                        <?php
                        $i = 0;
                        if (!empty($value['options'])): foreach ($value['options'] as $key => $option):
                            $i++; ?>
                            <option value="<?php echo $key ?>" <?php echo ((!empty($data) && $data == $key) || (empty($data) && $i == 1)) ? ' selected="selected"' : ''; ?>><?php echo $option; ?></option>
                        <?php endforeach;endif; ?>
                    </select>
                    <?php break;
                
                //Text List Option
                case 'text-list':
                    $currentValue = $data;
                    $default = $value['default']; ?>
                    <?php
                    $i = -1;
                    if (!empty($value['options'])): foreach ($value['options'] as $key => $option):
                        $i++; ?>
                        <label><span class="text-list-label"><?php echo $option; ?></span><input type="text" class="text-list" name="<?php echo $option_name ?>[]" value="<?php if (!empty($currentValue[$i])) echo $currentValue[$i]; elseif (!empty($default[$i])) echo $default[$i]; ?>" placeholder="<?php echo $option; ?>"></label>
                    <?php endforeach;endif; ?>
                    <?php break;
                
                //Textarea Option
                case 'textarea': ?>
                    <textarea type="textarea" name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" class="field-textarea" rows="5" tabindex="4"><?php echo $data; ?></textarea>
                    <?php break;
                
                //Upload Option
                case 'upload': ?>
                    <div class="upload-file">
                        <input type="text" name="<?php echo $option_name ?>" id="<?php echo $value['id']; ?>" class="img-path" size="56" value="<?php echo $data; ?>"/>
                        <input type="button" id="upload_<?php echo $value['id']; ?>_button" class="button" value="<?php _e('Upload', 'kbw') ?>"/>
                        
                        <?php if (isset($value['extra_text'])): ?>
                            <span class="extra-text"><?php echo $value['extra_text'] ?></span>
                        <?php endif; ?>

                        <div id="<?php echo $value['id']; ?>-preview" class="img-preview" <?php if (!$data) echo 'style="display:none;"' ?>>
                            <img src="<?php if ($data) echo $data; else echo KBW_THEME_DIRECTORY_URI . '/inc/admin/images/empty.png'; ?>" alt=""/>
                            <a class="del-img" title="Delete"></a>
                        </div>

                        <script type='text/javascript'>
                            jQuery('#<?php echo $value['id']; ?>').change(function () {
                                jQuery('#<?php echo $value['id']; ?>-preview').show();
                                jQuery('#<?php echo $value['id']; ?>-preview img').attr("src", jQuery(this).val());
                            });
                            kbw_set_uploader('<?php echo $value['id']; ?>');
                        </script>
                    </div>
                    <?php break;
                
                //WP Editor
                case 'wysiwyg':
                    // Setup up default args
                    $defaults = array(
                        'textarea_name' => $option_name,
                        'editor_class' => isset($value['class']) ? $value['class'] : '',
                        'textarea_rows' => 10, //Wordpress default
                        'teeny' => false,
                    );
                    $option_args = wp_parse_args($value['options'], $defaults);
                    
                    $editor_content = isset($value['default']) != '' ? $value['default'] : '';
                    if (!empty($data)) {
                        $editor_content = $data;
                    }
                    $editor_content = htmlspecialchars_decode($editor_content);
                    
                    ob_start(); ?>
                    <div class="editor-wrap">
                        <?php wp_editor($editor_content, $value['id'], $option_args); ?>
                    </div>
                    <?php
                    echo ob_get_clean();
                    break;
            }
            ?>
            
            <?php if (isset($value['extra_text']) && $value['type'] != 'upload') : ?>
                <span class="extra-text"><?php echo $value['extra_text'] ?></span>
            <?php endif; ?>
            <?php if (isset($value['help'])) : ?>
                <a class="kbw-help kbw-tooltip" title="<?php echo $value['help'] ?>"></a>
            <?php endif; ?>
        </div>

    </div>
    
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}
