<?php
$settings->add(new admin_setting_heading(
            'headerconfig',
            get_string('headerconfig', 'block_test'),
            get_string('descconfig', 'block_test')
        ));
 
$settings->add(new admin_setting_configcheckbox(
            'test/Allow_HTML',
            get_string('labelallowhtml', 'block_test'),
            get_string('descallowhtml', 'block_test'),
            '0'
        ));