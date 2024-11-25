<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Settings for Extend theme
 *
 * @package    theme_extend
 * @copyright  2024 LMSCloud.io
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig || has_capability('theme/extend:configure', context_system::instance())) {
    global $PAGE;

    $mainsettingspageurl = new core\url('/admin/settings.php', ['section' => 'themesettingextend']);
    if ($ADMIN->fulltree && $PAGE->has_set_url() && $PAGE->url->compare($mainsettingspageurl)) {
        redirect(new core\url('/theme/extend/settings_overview.php'));
    }

    // Create a new category in admin setting page.
    $ADMIN->add(
        'appearance',
        new admin_category('theme_extend', visiblename: get_string('pluginname', 'theme_extend', null, true))
    );

    if (!$ADMIN->fulltree) {
        // Create overview page.
        $overviewpage = new admin_externalpage(
            'theme_extend_overview',
            get_string('settingsoverview_title', 'theme_extend', null , true),
            new core\url('/theme/extend/settings_overview.php'),
            'theme/extend:configure'
        );
        $ADMIN->add('theme_extend', $overviewpage);

        // Create Boost setting pages.
        $tab = new admin_settingpage(
            'theme_extend_boost',
            get_string('pluginname', 'theme_boost', null, true),
            'theme/extend:configure'
        );
        $ADMIN->add('theme_extend', $tab);

        // Create Navbar setting pages.
        $tab = new admin_settingpage(
            'theme_extend_navbar',
            get_string('configure_navbar', 'theme_extend', null, true),
            'theme/extend:configure'
        );
        $ADMIN->add('theme_extend', $tab);

        // Create Page setting pages.
        $tab = new admin_settingpage(
            'theme_extend_page',
            get_string('configure_page', 'theme_extend', null, true),
            'theme/extend:configure'
        );
        $ADMIN->add('theme_extend', $tab);

        // Create Footer setting pages.
        $tab = new admin_settingpage(
            'theme_extend_footer',
            get_string('configure_footer', 'theme_extend', null, true),
            'theme/extend:configure'
        );
        $ADMIN->add('theme_extend', $tab);

    } else if ($ADMIN->fulltree) {

        // Create Boost settings page with tab.
        // Since this theme is based on Boost, we can use all the strings from theme_boost.
        // Below are the example settings that you can replace with your own.
        $pages = new theme_boost_admin_settingspage_tabs(
            'theme_extend_boost_settings',
            get_string('pluginname', 'theme_boost', null , true),
            'theme/extend:configure'
        );

        $tab = new admin_settingpage(
            'theme_extend_boost_general',
            get_string('generalsettings', 'theme_boost', null, true),
            'theme/extend:configure'
        );

        // Setting for the preset, similar to the one in boost - remove/replace if not needed.
        $choices = ['default.scss' => 'default.scss', 'plain.scss' => 'plain.scss'];
        $setting = new admin_setting_configthemepreset('theme_extend/preset',
            get_string('preset', 'theme_boost', null , true),
            get_string('preset_desc', 'theme_boost', null, true),
            key($choices), $choices, 'extend');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $tab->add($setting);

        // Must add the page after defining all the settings!
        $pages->add($tab);

        // Advanced settings.
        $tab = new admin_settingpage(
            'theme_extend_advanced',
            get_string('advancedsettings', 'theme_boost', null, true),
            'theme/extend:configure'
        );

        // Raw SCSS to include before the content.
        $setting = new admin_setting_scsscode(
            'theme_extend/scsspre',
            get_string('rawscsspre', 'theme_boost', null, true),
            get_string('rawscsspre_desc', 'theme_boost', null, true), '',
            PARAM_RAW
        );
        $setting->set_updatedcallback('theme_reset_all_caches');
        $tab->add($setting);

        // Raw SCSS to include after the content.
        $setting = new admin_setting_scsscode('theme_extend/scss', get_string('rawscss', 'theme_boost'),
            get_string('rawscss_desc', 'theme_boost'), '', PARAM_RAW);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $tab->add($setting);

        $pages->add($tab);

        $ADMIN->add('theme_extend', $pages);
    }
}
