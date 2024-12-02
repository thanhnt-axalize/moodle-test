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
 * TODO describe module default
 *
 * @module     theme_extend/carousel
 * @copyright  2024 YOUR NAME <your@email.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
import $ from 'jquery';
import {getCoursesRequest} from './repository';
/**
 * Init Carousel.
 * @param {number} page
 * @param {number} perpage
 */
export async function initCarousel(page, perpage) {
    const tagId = 1;
    // Get list of courses
    const courselist = await getCoursesRequest(tagId, page, perpage);
    // Carousel should only display in homepage(landing page)
    const url = window.location.pathname;
    const carousel = $('#home-carousel');
    if (url === '' || url === '/') {
        carousel.removeClass('display-none');
    }
    const carouselInner = carousel.children('.carousel-inner')[0];
    console.log(carouselInner);
    let coursesElements = '';
    if (courselist.courses.length > 0) {
        coursesElements = courselist.courses.map((value) => {
            const newcourseElemnt = `<div class="carousel-item"><img class="carousel-img" src="${value.courseimage}"/></div>`;
            return `${coursesElements}${newcourseElemnt}`;
        }).join('');
    } else {
        carousel.children('.carousel-control-prev').addClass('display-none');
        carousel.children('.carousel-control-next').addClass('display-none');
        carousel.children('.carousel-indicators').addClass('display-none');
        carouselInner.innerHTML = `
            <div></div>
        `;
    }
    carouselInner.innerHTML = coursesElements;
    if (carouselInner.children.length > 0) {
        carouselInner.children[0].classList.add('active');
    }
    console.log(courselist);
}

