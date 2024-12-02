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
 * Callback implementations for Extend theme
 *
 * Documentation: {@link https://docs.moodle.org/dev/Themes}
 *
 * @param theme_config $theme The theme config object.
 * @return string
 *@license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * /
 *
* /**
 * Returns the main SCSS content.
  *
  * @package    theme_extend
 * @copyright  2024 LMSCloud.io
 */
function theme_extend_get_main_scss_content(theme_config $theme): string {
    // Example content - use the setting 'preset' from this theme but the actual presets - from Boost theme.
    /**@var stdClass $CFG*/
    global $CFG;
    $scss = '';

    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();
    $context = context_system::instance();
    if ($filename == 'default.scss') {
        $scss .= file_get_contents("$CFG->dirroot/theme/boost/scss/preset/default.scss");
    } else if ($filename == 'plain.scss') {
        $scss .= file_get_contents("$CFG->dirroot/theme/boost/scss/preset/plain.scss");
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_extend', 'preset', 0, '/', $filename))) {
        $scss .= $presetfile->get_content();
    } else {
        $scss .= file_get_contents("$CFG->dirroot/theme/boost/scss/preset/default.scss");
    }

    $pre = file_get_contents("$CFG->dirroot/theme/extend/scss/pre.scss");
    $post = file_get_contents("$CFG->dirroot/theme/extend/scss/post.scss");

    return "$pre\n$scss\n$post";
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_extend_get_extra_scss(theme_config $theme): string {
    return !empty($theme->settings->scss) ? $theme->settings->scss : '';
}

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_extend_get_pre_scss(theme_config $theme): string {
    return !empty($theme->settings->scsspre) ? $theme->settings->scsspre : '';
}

/**
 * Get compiled CSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string compiled CSS
 */
function theme_extend_get_precompiled_css(theme_config $theme): string {
    global $CFG;
    // By default, fallback to Boost CSS.
    return file_get_contents($CFG->dirroot . '/theme/boost/style/moodle.css');
}
