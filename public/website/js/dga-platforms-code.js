/*
 * DGA Platforms Code (كود المنصات) — behaviour layer
 * ---------------------------------------------------
 * 1. Page preloader (Loading component) — hides on window load, with a hard
 *    timeout fallback and bfcache support.
 * 2. External-link icon — adds .dga-ext + SR text to every cross-origin text
 *    link that does not already carry an icon / image.
 * 3. Breadcrumb current page → aria-current="page".
 * 4. Nav header: marks the current nav item (aria-current) from the URL.
 * 5. Digital stamp + accessibility panel toggles (keyboard accessible).
 * 6. Accessibility preferences (font size / contrast) persisted in localStorage.
 * Vanilla JS, no jQuery dependency. Safe to load on every page.
 */
(function () {
    'use strict';

    /* ─── 1. PRELOADER ─────────────────────────────────────────────── */
    var pre = document.getElementById('dga-preloader');
    function hidePreloader() {
        if (!pre || pre.classList.contains('is-hidden')) return;
        pre.classList.add('is-hidden');
        pre.setAttribute('aria-hidden', 'true');
        pre.setAttribute('aria-busy', 'false');
        document.documentElement.classList.remove('dga-preloading');
        setTimeout(function () { if (pre && pre.parentNode) pre.parentNode.removeChild(pre); }, 450);
    }
    if (pre) {
        document.documentElement.classList.add('dga-preloading');
        if (document.readyState === 'complete') {
            setTimeout(hidePreloader, 150);
        } else {
            window.addEventListener('load', function () { setTimeout(hidePreloader, 150); });
        }
        /* Hard fallback — never block the user more than 4s (slow network / blocked asset) */
        setTimeout(hidePreloader, 4000);
        /* Back/forward cache restores the page already loaded */
        window.addEventListener('pageshow', function (e) { if (e.persisted) hidePreloader(); });
    }

    document.addEventListener('DOMContentLoaded', function () {

        /* ─── 2. EXTERNAL LINK ICON ───────────────────────────────── */
        var host = location.hostname;
        var srText = (document.documentElement.lang || 'ar').indexOf('ar') === 0 ? '(رابط خارجي)' : '(external link)';
        document.querySelectorAll('a[href^="http"]').forEach(function (a) {
            try {
                var u = new URL(a.href);
                if (u.hostname === host || u.hostname.endsWith('.' + host)) return;
            } catch (e) { return; }
            if (a.classList.contains('dga-ext') || a.classList.contains('dga-no-ext')) return;
            if (a.querySelector('img, svg, i, picture')) return;        // icon-only / logo links keep their own visual
            if (!a.textContent.trim()) return;
            a.classList.add('dga-ext');
            var sr = document.createElement('span');
            sr.className = 'dga-ext-sr';
            sr.textContent = ' ' + srText;
            a.appendChild(sr);
            if (!a.getAttribute('rel')) a.setAttribute('rel', 'noopener');
        });

        /* ─── 3. BREADCRUMB current page ──────────────────────────── */
        document.querySelectorAll('.dga-breadcrumb, nav.breadcrumb, ol.breadcrumb').forEach(function (bc) {
            var last = bc.querySelector('[aria-current="page"]');
            if (last) return;
            var items = bc.querySelectorAll('span:not(.dga-breadcrumb-sep), li:last-child, .breadcrumb-item.active');
            if (items.length) items[items.length - 1].setAttribute('aria-current', 'page');
        });

        /* ─── 4. NAV current item ─────────────────────────────────── */
        var path = location.pathname.replace(/\/+$/, '') || '/';
        document.querySelectorAll('header .navbar-nav > .nav-item > .nav-link[href]').forEach(function (link) {
            var href = link.getAttribute('href');
            if (!href || href === '#' || href.indexOf('javascript') === 0) return;
            var lp;
            try { lp = new URL(href, location.origin).pathname.replace(/\/+$/, '') || '/'; } catch (e) { return; }
            var isHome = lp === '/' || /^\/(ar|en)$/.test(lp);
            var match = isHome ? (path === '/' || /^\/(ar|en)$/.test(path)) : path.indexOf(lp) === 0;
            link.parentElement.classList.toggle('active', match);
            if (match) link.setAttribute('aria-current', 'page'); else link.removeAttribute('aria-current');
        });

        /* ─── 5. STAMP + A11Y PANEL toggles ───────────────────────── */
        function wireToggle(btnId, panelId, onOpen) {
            var btn = document.getElementById(btnId), panel = document.getElementById(panelId);
            if (!btn || !panel) return;
            function set(open) {
                panel.classList.toggle('is-open', open);
                btn.setAttribute('aria-expanded', open ? 'true' : 'false');
                if (open && onOpen) onOpen();
            }
            btn.addEventListener('click', function () { set(!panel.classList.contains('is-open')); });
            btn.addEventListener('keydown', function (e) { if (e.key === 'Escape') set(false); });
            panel.addEventListener('keydown', function (e) { if (e.key === 'Escape') { set(false); btn.focus(); } });
        }
        wireToggle('dga-stamp-toggle', 'dga-stamp-details');
        wireToggle('dga-a11y-toggle', 'dga-a11y-panel', function () {
            var first = document.querySelector('#dga-a11y-panel button'); if (first) first.focus();
        });

        /* ─── 6. ACCESSIBILITY PREFERENCES ────────────────────────── */
        var MODES = { mono: 'dga-mono', high: 'dga-high-c', smart: 'dga-smart-c', sat: 'dga-high-sat' };
        var base = 16;
        var size = parseInt(localStorage.getItem('dga_font_size') || '0', 10);

        function applyFont() {
            document.documentElement.style.fontSize = size === 0 ? '' : (base + size * 2) + 'px';
            localStorage.setItem('dga_font_size', String(size));
        }
        function applyContrast(mode, persist) {
            Object.keys(MODES).forEach(function (k) { document.body.classList.remove(MODES[k]); });
            document.querySelectorAll('#dga-a11y-panel [data-contrast]').forEach(function (b) { b.setAttribute('aria-pressed', 'false'); b.classList.remove('active'); });
            if (mode && MODES[mode]) {
                document.body.classList.add(MODES[mode]);
                var active = document.querySelector('#dga-a11y-panel [data-contrast="' + mode + '"]');
                if (active) { active.setAttribute('aria-pressed', 'true'); active.classList.add('active'); }
                if (persist) localStorage.setItem('dga_contrast', mode);
            } else if (persist) {
                localStorage.removeItem('dga_contrast');
            }
        }
        document.querySelectorAll('#dga-a11y-panel [data-font]').forEach(function (b) {
            b.addEventListener('click', function () {
                size = Math.max(-2, Math.min(4, size + parseInt(b.getAttribute('data-font'), 10)));
                applyFont();
            });
        });
        document.querySelectorAll('#dga-a11y-panel [data-contrast]').forEach(function (b) {
            b.addEventListener('click', function () {
                var m = b.getAttribute('data-contrast');
                applyContrast(document.body.classList.contains(MODES[m]) ? null : m, true);
            });
        });
        var reset = document.getElementById('dga-a11y-reset');
        if (reset) reset.addEventListener('click', function () { size = 0; applyFont(); localStorage.removeItem('dga_font_size'); applyContrast(null, true); });
        /* restore */
        if (size !== 0) applyFont();
        var storedMode = localStorage.getItem('dga_contrast');
        if (storedMode) applyContrast(storedMode, false);

        /* keep legacy global helpers alive for any inline callers */
        window.dgaFontSize = function (dir) { size = Math.max(-2, Math.min(4, size + dir)); applyFont(); };
        window.dgaContrast = function (mode) { applyContrast(mode, true); };
        window.dgaReset = function () { if (reset) reset.click(); };
        window.dgaZoom = function () {};
    });
})();

/* ── Accessibility patches for third-party widgets (Selectize) + missing alts ── */
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        function patch() {
            document.querySelectorAll('.selectize-control input:not([aria-label])').forEach(function (inp) {
                var ctrl = inp.closest('.selectize-control');
                var sel = ctrl && ctrl.previousElementSibling && ctrl.previousElementSibling.tagName === 'SELECT' ? ctrl.previousElementSibling : null;
                var label = sel && sel.labels && sel.labels[0] ? sel.labels[0].textContent.trim() : (inp.placeholder || (sel && sel.getAttribute('aria-label')) || '');
                if (label) inp.setAttribute('aria-label', label);
            });
            document.querySelectorAll('img:not([alt])').forEach(function (img) { img.setAttribute('alt', ''); });
        }
        patch();
        if (window.MutationObserver) new MutationObserver(patch).observe(document.body, { childList: true, subtree: true });
    });
})();
