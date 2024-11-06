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
 * Settings for Default theme
 *
 * @package    theme_default
 * @copyright  2024 LMSCloud.io
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    // Since this theme is based on Boost, we can use all the strings from theme_boost.
    // Below are the example settings that you can replace with your own.

    $settings = new theme_boost_admin_settingspage_tabs('themesettingdefault', get_string('pluginname', 'theme_default'));
    $page = new admin_settingpage('theme_default_general', get_string('generalsettings', 'theme_boost'));

    // Setting for the preset, similar to the one in boost - remove/replace if not needed.
    $choices = ['default.scss' => 'default.scss', 'plain.scss' => 'plain.scss'];
    $setting = new admin_setting_configthemepreset(
        'theme_default/preset',
        get_string('preset', 'theme_boost'),
        get_string('preset_desc', 'theme_boost'),
        key($choices),
        $choices,
        'default'
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Must add the page after defining all the settings!
    $settings->add($page);

    // Advanced settings.
    $page = new admin_settingpage('theme_default_advanced', get_string('advancedsettings', 'theme_boost'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode(
        'theme_default/scsspre',
        get_string('rawscsspre', 'theme_boost'),
        get_string('rawscsspre_desc', 'theme_boost'),
        '',
        PARAM_RAW
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode(
        'theme_default/scss',
        get_string('rawscss', 'theme_boost'),
        get_string('rawscss_desc', 'theme_boost'),
        '',
        PARAM_RAW
    );
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
