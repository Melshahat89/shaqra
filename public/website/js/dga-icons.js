/*
 * DGA Platforms Code — unified icon layer
 * ---------------------------------------
 * Replaces legacy Font Awesome <i class="fa fa-*"> elements with inline 24px
 * line SVG icons (stroke 2, currentColor) so every icon on the site shares the
 * same library, size and colour rules. Unmapped names fall back to Font Awesome.
 * Extra classes / aria attributes on the <i> are preserved on the <svg>.
 */
(function () {
    'use strict';
    var S = 'fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"';
    var F = 'fill="currentColor" stroke="none"';
    var I = {
        /* navigation / arrows */
        'arrow-left':        [S, '<line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>'],
        'arrow-right':       [S, '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>'],
        'arrow-up':          [S, '<line x1="12" y1="19" x2="12" y2="5"/><polyline points="5 12 12 5 19 12"/>'],
        'arrow-down':        [S, '<line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/>'],
        'chevron-up':        [S, '<polyline points="18 15 12 9 6 15"/>'],
        'chevron-down':      [S, '<polyline points="6 9 12 15 18 9"/>'],
        'chevron-left':      [S, '<polyline points="15 18 9 12 15 6"/>'],
        'chevron-right':     [S, '<polyline points="9 18 15 12 9 6"/>'],
        'angle-up':          [S, '<polyline points="18 15 12 9 6 15"/>'],
        'angle-down':        [S, '<polyline points="6 9 12 15 18 9"/>'],
        'angle-left':        [S, '<polyline points="15 18 9 12 15 6"/>'],
        'angle-right':       [S, '<polyline points="9 18 15 12 9 6"/>'],
        'angle-double-right':[S, '<polyline points="13 17 18 12 13 7"/><polyline points="6 17 11 12 6 7"/>'],
        'angle-double-left': [S, '<polyline points="11 17 6 12 11 7"/><polyline points="18 17 13 12 18 7"/>'],
        'bars':              [S, '<line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>'],
        'align-justify':     [S, '<line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>'],
        'home':              [S, '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>'],
        'globe':             [S, '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>'],
        /* actions */
        'search':            [S, '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>'],
        'plus':              [S, '<line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>'],
        'plus-circle':       [S, '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>'],
        'minus':             [S, '<line x1="5" y1="12" x2="19" y2="12"/>'],
        'close':             [S, '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>'],
        'times':             [S, '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>'],
        'check':             [S, '<polyline points="20 6 9 17 4 12"/>'],
        'check-circle':      [S, '<path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>'],
        'trash':             [S, '<polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>'],
        'save':              [S, '<path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>'],
        'edit':              [S, '<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4z"/>'],
        'eye':               [S, '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'],
        'download':          [S, '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>'],
        'cloud-download-alt':[S, '<polyline points="8 17 12 21 16 17"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"/>'],
        'paper-plane':       [S, '<line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/>'],
        'sign-out-alt':      [S, '<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>'],
        'cog':               [S, '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>'],
        'cart-plus':         [S, '<circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/><line x1="13" y1="9" x2="13" y2="13"/><line x1="11" y1="11" x2="15" y2="11"/>'],
        'spinner':           [S, '<path d="M21 12a9 9 0 1 1-6.219-8.56"/>'],
        /* content / status */
        'calendar':          [S, '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>'],
        'calendar-o':        [S, '<rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>'],
        'clock':             [S, '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>'],
        'clock-o':           [S, '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>'],
        'info-circle':       [S, '<circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/>'],
        'question-circle':   [S, '<circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/>'],
        'life-ring':         [S, '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="4"/><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"/><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"/><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"/><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"/>'],
        'file':              [S, '<path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/>'],
        'file-word':         [S, '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><path d="M8 13l1.5 6 2.5-4 2.5 4 1.5-6"/>'],
        'sticky-note':       [S, '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="13" y2="17"/>'],
        'id-card':           [S, '<rect x="2" y="4" width="20" height="16" rx="2"/><circle cx="8" cy="11" r="2.5"/><path d="M4.5 18c.5-2 2-3 3.5-3s3 1 3.5 3"/><line x1="14" y1="9" x2="19" y2="9"/><line x1="14" y1="13" x2="19" y2="13"/>'],
        'envelope':          [S, '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>'],
        'lock':              [S, '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>'],
        'user':              [S, '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
        'users':             [S, '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
        'heart':             [S, '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>'],
        'star':              [S, '<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>'],
        'thumbs-up':         [S, '<path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>'],
        'trophy':            [S, '<path d="M8 21h8M12 17v4M7 4h10v5a5 5 0 0 1-10 0z"/><path d="M17 6h3a2 2 0 0 1-2 5h-1M7 6H4a2 2 0 0 0 2 5h1"/>'],
        'crown':             [S, '<path d="M2 18h20l-1.5-9-5 4L12 5l-3.5 8-5-4z"/><line x1="2" y1="21" x2="22" y2="21"/>'],
        'certificate':       [S, '<circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>'],
        'graduation-cap':    [S, '<path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>'],
        'chalkboard':        [S, '<rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/>'],
        'chalkboard-teacher':[S, '<rect x="2" y="3" width="20" height="13" rx="2"/><path d="M8 21a4 4 0 0 1 8 0"/><circle cx="12" cy="17" r="0.5"/>'],
        'laptop':            [S, '<rect x="3" y="4" width="18" height="12" rx="2"/><line x1="2" y1="20" x2="22" y2="20"/>'],
        'play':              [F, '<polygon points="6 3 20 12 6 21 6 3"/>'],
        'play-circle':       [S, '<circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/>'],
        'circle':            [F, '<circle cx="12" cy="12" r="5"/>'],
        'sign-language':     [S, '<path d="M18 11V6a2 2 0 0 0-4 0v5"/><path d="M14 10V4a2 2 0 0 0-4 0v2"/><path d="M10 10.5V6a2 2 0 0 0-4 0v8"/><path d="M18 8a2 2 0 1 1 4 0v6a8 8 0 0 1-8 8h-2c-2.8 0-4.5-.86-5.99-2.34l-3.6-3.6a2 2 0 0 1 2.83-2.82L7 15"/>'],
        /* brands (filled) */
        'twitter':           [F, '<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>'],
        'facebook':          [S, '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>'],
        'facebook-f':        [S, '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>'],
        'linkedin':          [S, '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>'],
        'linkedin-in':       [S, '<path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/>'],
        'instagram':         [S, '<rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>'],
        'youtube':           [S, '<path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-2C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 2A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/>'],
        'whatsapp':          [F, '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>'],
        'google-plus-g':     [S, '<path d="M15.5 8.5A5 5 0 1 0 17 12h-5"/><line x1="19" y1="9" x2="19" y2="15"/><line x1="16" y1="12" x2="22" y2="12"/>'],
        'windows':           [S, '<rect x="3" y="3" width="8" height="8"/><rect x="13" y="3" width="8" height="8"/><rect x="3" y="13" width="8" height="8"/><rect x="13" y="13" width="8" height="8"/>'],
        'apple':             [S, '<path d="M12 6c1.5-2 4-2 5.5-1-2 1.5-2 4 0 5.5-1 3.5-3 8-5.5 8s-4.5-4.5-5.5-8c2-1.5 2-4 0-5.5C8 4 10.5 4 12 6z"/><path d="M12 6c0-2 1-3 2.5-3.5"/>'],
        'android':           [S, '<rect x="5" y="9" width="14" height="10" rx="2"/><path d="M8 9a4 4 0 0 1 8 0"/><line x1="9" y1="19" x2="9" y2="22"/><line x1="15" y1="19" x2="15" y2="22"/><line x1="3" y1="11" x2="3" y2="16"/><line x1="21" y1="11" x2="21" y2="16"/>']
    };

    function replaceIcons(root) {
        var nodes = (root || document).querySelectorAll('i[class*="fa-"]');
        Array.prototype.forEach.call(nodes, function (el) {
            if (el.textContent.trim() || el.children.length) return;
            var cls = Array.prototype.slice.call(el.classList);
            var name = null, keep = [];
            cls.forEach(function (c) {
                var m = /^fa-(.+)$/.exec(c);
                if (m && !/^(\d+x|lg|xs|sm|fw|spin|pulse|stack|inverse|border|pull-left|pull-right)$/.test(m[1])) { if (!name) name = m[1]; }
                else if (!/^(fa|fas|far|fal|fab|fad)$/.test(c) && !m) keep.push(c);
            });
            if (!name || !I[name]) return;
            var spin = cls.indexOf('fa-spin') > -1 || name === 'spinner';
            var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svg.setAttribute('viewBox', '0 0 24 24');
            svg.setAttribute('class', ['dga-icon', 'dga-icon-' + name].concat(keep).concat(spin ? ['dga-icon-spin'] : []).join(' '));
            svg.setAttribute('aria-hidden', el.getAttribute('aria-hidden') || 'true');
            svg.setAttribute('focusable', 'false');
            var label = el.getAttribute('aria-label') || el.getAttribute('title');
            if (label) { svg.setAttribute('role', 'img'); svg.setAttribute('aria-label', label); svg.setAttribute('aria-hidden', 'false'); }
            Array.prototype.forEach.call(el.attributes, function (a) { if (/^data-/.test(a.name) || a.name === 'id' || a.name === 'style') svg.setAttribute(a.name, a.value); });
            svg.innerHTML = '<g ' + I[name][0] + '>' + I[name][1] + '</g>';
            el.parentNode.replaceChild(svg, el);
        });
    }

    window.dgaReplaceIcons = replaceIcons;
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', function () { replaceIcons(); });
    else replaceIcons();
    /* Livewire / AJAX injected content */
    if (window.MutationObserver) {
        var mo = new MutationObserver(function (muts) {
            muts.forEach(function (m) { Array.prototype.forEach.call(m.addedNodes, function (n) { if (n.nodeType === 1) replaceIcons(n); }); });
        });
        document.addEventListener('DOMContentLoaded', function () { mo.observe(document.body, { childList: true, subtree: true }); });
    }
})();
