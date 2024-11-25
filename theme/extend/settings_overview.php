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
 * TODO describe file settings_overview
 *
 * @package    theme_extend
 * @copyright  2024 LMSCloud.io
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

require_login();
$url = new moodle_url('/theme/extend/settings_overview.php', []);
$PAGE->set_url($url);

$PAGE->set_pagelayout('admin');
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('settingsoverview_title', 'theme_extend'));
echo $OUTPUT->header();

$PAGE->set_heading(get_string('settingsoverview_title', 'theme_extend'));

$context['card'][] = [
    'title' => get_string('pluginname', 'theme_boost'),
    'desc' => get_string('settingsoverview_boost_desc', 'theme_extend'),
    'url' => new core\url('/admin/settings.php', params: ['section' => 'theme_extend_boost']),
];

$context['card'][] = [
    'title' => get_string('configure_navbar', 'theme_extend'),
    'desc' => get_string('settingsoverview_navbar_desc', 'theme_extend'),
    'url' => new core\url('/admin/settings.php', ['section' => 'theme_extend_navbar']),
];

$context['card'][] = [
    'title' => get_string('configure_page', 'theme_extend'),
    'desc' => get_string('settingsoverview_page_desc', 'theme_extend'),
    'url' => new core\url('/admin/settings.php', params: ['section' => 'theme_extend_page']),
];

$context['card'][] = [
    'title' => get_string('configure_footer', 'theme_extend'),
    'desc' => get_string('settingsoverview_footer_desc', 'theme_extend'),
    'url' => new core\url('/admin/settings.php', ['section' => 'theme_extend_footer']),
];



echo $OUTPUT->render_from_template( 'theme_extend/settings-overview', $context);
echo $OUTPUT->footer();
