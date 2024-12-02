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
 * TODO describe module repository
 *
 * @module     theme_extend/repository
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import Ajax from 'core/ajax';
/**
 * @param {number} tag The tag Id which associate with courses
 * @param {number} perpage Number of course will return per page
 * @param {number} page Number of page want to return
 * @returns {promise} Resolve with an array of course
 */
export const getCoursesRequest = (tag, perpage, page) => {
    const args = {};
    if (typeof tag !== 'undefined') {
        args.criterianame = 'tagid';
        args.criteriavalue = tag;
    }
    if (typeof perpage !== 'undefined') {
        args.perpage = perpage;
    }
    if (typeof page !== 'undefined') {
        args.page = page;
    }

    const request = {
        methodname: 'core_course_search_courses',
        args: args
    };
    return Ajax.call([request])[0];
};
