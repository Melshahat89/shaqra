/*
 * DGA Platforms Code — icon layer (Hugeicons stroke-rounded)
 * ----------------------------------------------------------
 * The DGA Platforms Code and the approved su.edu.sa theme use Hugeicons.
 * This script:
 *   1. replaces legacy Font Awesome <i class="fa fa-*"> with the matching Hugeicons SVG
 *   2. renders declarative placeholders <i class="hgi hgi-<name>"></i>
 * Icon paths come from window.DGA_HGI (public/website/js/dga-hgi-map.js, generated from
 * @hugeicons/core-free-icons, MIT). Unmapped Font Awesome names are left untouched.
 */
(function () {
    'use strict';
    var FA = {
        'arrow-left': 'arrow-left-02', 'arrow-right': 'arrow-right-02', 'arrow-up': 'arrow-up-02', 'arrow-down': 'arrow-down-02',
        'chevron-up': 'arrow-up-01', 'chevron-down': 'arrow-down-01', 'chevron-left': 'arrow-left-01', 'chevron-right': 'arrow-right-01',
        'angle-up': 'arrow-up-01', 'angle-down': 'arrow-down-01', 'angle-left': 'arrow-left-01', 'angle-right': 'arrow-right-01',
        'angle-double-right': 'arrow-right-double', 'angle-double-left': 'arrow-left-double', 'bars': 'menu-01', 'align-justify': 'menu-01',
        'home': 'home-01', 'globe': 'globe-02', 'search': 'search-01', 'plus': 'add-01', 'plus-circle': 'add-01', 'minus': 'remove-01',
        'close': 'cancel-01', 'times': 'cancel-01', 'check': 'tick-02', 'check-circle': 'checkmark-circle-02', 'trash': 'delete-02', 'save': 'floppy-disk',
        'edit': 'edit-02', 'eye': 'view', 'download': 'download-04', 'cloud-download-alt': 'cloud-download', 'paper-plane': 'sent',
        'sign-out-alt': 'logout-03', 'cog': 'settings-01', 'cart-plus': 'shopping-cart-add-01', 'spinner': 'loading-03',
        'calendar': 'calendar-04', 'calendar-o': 'calendar-04', 'clock': 'clock-01', 'clock-o': 'clock-01', 'info-circle': 'information-circle',
        'question-circle': 'help-circle', 'life-ring': 'customer-support', 'file': 'file-02', 'file-word': 'doc-01', 'sticky-note': 'sticky-note-02',
        'id-card': 'identity-card', 'envelope': 'mail-02', 'lock': 'lock', 'user': 'user', 'users': 'user-multiple', 'heart': 'favourite', 'star': 'star',
        'thumbs-up': 'thumbs-up', 'trophy': 'champion', 'crown': 'crown', 'certificate': 'certificate-01', 'graduation-cap': 'mortarboard-02',
        'chalkboard': 'presentation-01', 'chalkboard-teacher': 'teaching', 'laptop': 'laptop', 'play': 'play', 'play-circle': 'play-circle', 'circle': 'circle',
        'sign-language': 'sign-language-c', 'twitter': 'new-twitter', 'facebook': 'facebook-02', 'facebook-f': 'facebook-02', 'linkedin': 'linkedin-02',
        'linkedin-in': 'linkedin-02', 'instagram': 'instagram', 'youtube': 'youtube', 'whatsapp': 'whatsapp', 'google-plus-g': 'google', 'apple': 'apple', 'android': 'android',
        'map-marker': 'location-01', 'map-marker-alt': 'location-01', 'phone': 'call-02', 'filter': 'filter', 'bell': 'notification-01', 'image': 'image-02',
        'lightbulb': 'idea-01', 'share-alt': 'share-08', 'ellipsis-h': 'more-horizontal', 'bookmark': 'bookmark-01', 'comment': 'comment-01', 'comments': 'comment-01',
        'exclamation-triangle': 'alert-02', 'exclamation-circle': 'alert-circle', 'video': 'video-01', 'briefcase': 'briefcase-01', 'building': 'building-03',
        'credit-card': 'credit-card', 'shield-alt': 'security-check', 'award': 'award-01', 'tasks': 'task-01', 'newspaper': 'news-01', 'sitemap': 'sitemap', 'link': 'link-01', 'external-link-alt': 'link-square-02'
    };

    function svgFor(name, extraClasses, src) {
        var map = window.DGA_HGI || {};
        if (!map[name]) return null;
        var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('viewBox', '0 0 24 24');
        svg.setAttribute('width', '24'); svg.setAttribute('height', '24');
        svg.setAttribute('fill', 'none');
        svg.setAttribute('class', ['hgi', 'hgi-' + name, 'dga-icon'].concat(extraClasses || []).join(' '));
        svg.setAttribute('focusable', 'false');
        var label = src && (src.getAttribute('aria-label') || src.getAttribute('title'));
        if (label) { svg.setAttribute('role', 'img'); svg.setAttribute('aria-label', label); } else { svg.setAttribute('aria-hidden', 'true'); }
        if (src) Array.prototype.forEach.call(src.attributes, function (a) { if (/^data-/.test(a.name) || a.name === 'id' || a.name === 'style') svg.setAttribute(a.name, a.value); });
        svg.innerHTML = map[name];
        return svg;
    }

    function replaceIcons(root) {
        var scope = root || document;
        /* 1. Font Awesome */
        Array.prototype.forEach.call(scope.querySelectorAll('i[class*="fa-"]'), function (el) {
            if (el.textContent.trim() || el.children.length) return;
            var cls = Array.prototype.slice.call(el.classList), name = null, keep = [];
            cls.forEach(function (c) {
                var m = /^fa-(.+)$/.exec(c);
                if (m && !/^(\d+x|lg|xs|sm|fw|spin|pulse|stack|inverse|border|pull-left|pull-right)$/.test(m[1])) { if (!name) name = m[1]; }
                else if (!/^(fa|fas|far|fal|fab|fad)$/.test(c) && !m) keep.push(c);
            });
            if (!name || !FA[name]) return;
            if (cls.indexOf('fa-spin') > -1 || name === 'spinner') keep.push('dga-icon-spin');
            var svg = svgFor(FA[name], keep, el);
            if (svg) el.parentNode.replaceChild(svg, el);
        });
        /* 2. Declarative placeholders */
        Array.prototype.forEach.call(scope.querySelectorAll('i.hgi[class*="hgi-"]'), function (el) {
            var name = null, keep = [];
            Array.prototype.forEach.call(el.classList, function (c) { var m = /^hgi-(.+)$/.exec(c); if (m) name = m[1]; else if (c !== 'hgi') keep.push(c); });
            var svg = name && svgFor(name, keep, el);
            if (svg) el.parentNode.replaceChild(svg, el);
        });
    }

    window.dgaReplaceIcons = replaceIcons;
    function boot() {
        replaceIcons();
        if (window.MutationObserver) {
            new MutationObserver(function (muts) {
                muts.forEach(function (m) { Array.prototype.forEach.call(m.addedNodes, function (n) { if (n.nodeType === 1) replaceIcons(n); }); });
            }).observe(document.body, { childList: true, subtree: true });
        }
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot); else boot();
})();
