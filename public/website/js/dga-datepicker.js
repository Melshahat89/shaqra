/*
 * DGA Platforms Code — Date Picker component
 * ------------------------------------------
 * Progressive enhancement for text/date inputs marked with .datepicker2,
 * .dga-datepicker or input[type="date"]. The input stays typeable; a calendar
 * button opens a popup implementing the Platforms Code states:
 *   day: default · hover · pressed · focus · disabled · Selected · Today
 *   header: Prev / Next month, month + year label
 * Output format: YYYY-MM-DD. Arabic / English labels from <html lang>.
 * Keyboard: arrows move days, PageUp/PageDown months, Enter selects, Esc closes.
 */
(function () {
    'use strict';
    var isAr = (document.documentElement.lang || 'ar').indexOf('ar') === 0;
    var L = isAr ? {
        months: ['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'],
        days: ['أحد','اثنين','ثلاثاء','أربعاء','خميس','جمعة','سبت'], open: 'فتح التقويم', prev: 'الشهر السابق', next: 'الشهر التالي', today: 'اليوم', clear: 'مسح'
    } : {
        months: ['January','February','March','April','May','June','July','August','September','October','November','December'],
        days: ['Su','Mo','Tu','We','Th','Fr','Sa'], open: 'Open calendar', prev: 'Previous month', next: 'Next month', today: 'Today', clear: 'Clear'
    };
    var pad = function (n) { return (n < 10 ? '0' : '') + n; };
    var fmt = function (d) { return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()); };
    var parse = function (v) { var m = /^(\d{4})-(\d{1,2})-(\d{1,2})/.exec(v || ''); return m ? new Date(+m[1], +m[2] - 1, +m[3]) : null; };
    var same = function (a, b) { return a && b && a.getFullYear() === b.getFullYear() && a.getMonth() === b.getMonth() && a.getDate() === b.getDate(); };
    var open = null;

    function build(input) {
        if (input.dataset.dgaDp) return;
        input.dataset.dgaDp = '1';
        if (input.type === 'date') { input.type = 'text'; input.setAttribute('inputmode', 'numeric'); }
        if (!input.placeholder) input.placeholder = 'YYYY-MM-DD';
        input.autocomplete = 'off';
        var wrap = document.createElement('div'); wrap.className = 'dga-dp';
        input.parentNode.insertBefore(wrap, input); wrap.appendChild(input);
        var btn = document.createElement('button'); btn.type = 'button'; btn.className = 'dga-dp-btn'; btn.setAttribute('aria-label', L.open); btn.setAttribute('aria-haspopup', 'dialog'); btn.setAttribute('aria-expanded', 'false');
        btn.innerHTML = '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" class="hgi hgi-calendar-04" aria-hidden="true" focusable="false"><path d="M16 2V6M8 2V6" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path d="M13 4H11C7.22876 4 5.34315 4 4.17157 5.17157C3 6.34315 3 8.22876 3 12V14C3 17.7712 3 19.6569 4.17157 20.8284C5.34315 22 7.22876 22 11 22H13C16.7712 22 18.6569 22 19.8284 20.8284C21 19.6569 21 17.7712 21 14V12C21 8.22876 21 6.34315 19.8284 5.17157C18.6569 4 16.7712 4 13 4Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path d="M3 10H21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>';
        wrap.appendChild(btn);
        if (input.disabled) btn.disabled = true;
        var pop = document.createElement('div'); pop.className = 'dga-dp-pop'; pop.setAttribute('role', 'dialog'); pop.setAttribute('aria-modal', 'false'); pop.hidden = true;
        wrap.appendChild(pop);
        var min = parse(input.getAttribute('min')), max = parse(input.getAttribute('max'));
        var view, focusDate;

        function render() {
            var today = new Date(); today.setHours(0,0,0,0);
            var sel = parse(input.value);
            var y = view.getFullYear(), m = view.getMonth();
            var first = new Date(y, m, 1), startDow = first.getDay(), dim = new Date(y, m + 1, 0).getDate();
            var h = '<div class="dga-dp-head">' +
                '<button type="button" class="dga-dp-nav" data-nav="-1" aria-label="' + L.prev + '">' + (isAr ? '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" class="hgi hgi-arrow-right-01" aria-hidden="true" focusable="false"><path d="M9.00005 6C9.00005 6 15 10.4189 15 12C15 13.5812 9 18 9 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>' : '<svg viewBox="0 0 24 24" width="20" height="20" fill="none" class="hgi hgi-arrow-left-01" aria-hidden="true" focusable="false"><path d="M15 6C15 6 9.00001 10.4189 9 12C8.99999 13.5812 15 18 15 18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>') + '</button>' +
                '<div class="dga-dp-title" aria-live="polite">' + L.months[m] + ' ' + y + '</div>' +
                '<button type="button" class="dga-dp-nav" data-nav="1" aria-label="' + L.next + '"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="' + (isAr ? '15 18 9 12 15 6' : '9 18 15 12 9 6') + '"/></svg></button></div>';
            h += '<table class="dga-dp-grid" role="grid"><thead><tr>';
            for (var d = 0; d < 7; d++) h += '<th scope="col" abbr="' + L.days[d] + '">' + L.days[d] + '</th>';
            h += '</tr></thead><tbody><tr>';
            var cell = 0;
            for (var i = 0; i < startDow; i++) { h += '<td></td>'; cell++; }
            for (var day = 1; day <= dim; day++) {
                var dt = new Date(y, m, day);
                var dis = (min && dt < min) || (max && dt > max);
                var cls = 'dga-dp-day' + (same(dt, today) ? ' is-today' : '') + (same(dt, sel) ? ' is-selected' : '');
                h += '<td role="gridcell"><button type="button" class="' + cls + '" data-date="' + fmt(dt) + '" tabindex="' + (same(dt, focusDate) ? '0' : '-1') + '"' + (dis ? ' disabled' : '') + (same(dt, sel) ? ' aria-selected="true"' : '') + (same(dt, today) ? ' aria-current="date"' : '') + '>' + day + '</button></td>';
                if (++cell % 7 === 0 && day < dim) h += '</tr><tr>';
            }
            while (cell % 7 !== 0) { h += '<td></td>'; cell++; }
            h += '</tr></tbody></table>';
            h += '<div class="dga-dp-foot"><button type="button" class="dga-btn dga-btn-ghost dga-btn-sm" data-act="today">' + L.today + '</button><button type="button" class="dga-btn dga-btn-ghost dga-btn-sm" data-act="clear">' + L.clear + '</button></div>';
            pop.innerHTML = h;
        }
        function show() {
            if (open && open !== hide) open();
            var sel = parse(input.value); focusDate = sel || new Date(); focusDate.setHours(0,0,0,0);
            view = new Date(focusDate.getFullYear(), focusDate.getMonth(), 1);
            render(); pop.hidden = false; btn.setAttribute('aria-expanded', 'true'); open = hide;
            var f = pop.querySelector('.dga-dp-day[tabindex="0"]'); if (f) f.focus();
        }
        function hide(returnFocus) { pop.hidden = true; btn.setAttribute('aria-expanded', 'false'); open = null; if (returnFocus) btn.focus(); }
        function select(dt) { input.value = fmt(dt); input.dispatchEvent(new Event('input', { bubbles: true })); input.dispatchEvent(new Event('change', { bubbles: true })); hide(true); }
        function moveFocus(days, months) {
            var d = new Date(focusDate); if (months) d.setMonth(d.getMonth() + months); if (days) d.setDate(d.getDate() + days);
            focusDate = d; view = new Date(d.getFullYear(), d.getMonth(), 1); render();
            var f = pop.querySelector('.dga-dp-day[tabindex="0"]'); if (f) f.focus();
        }
        btn.addEventListener('click', function () { pop.hidden ? show() : hide(); });
        pop.addEventListener('click', function (e) {
            var t = e.target.closest('button'); if (!t) return;
            if (t.dataset.nav) { view.setMonth(view.getMonth() + (+t.dataset.nav)); render(); return; }
            if (t.dataset.date) { select(parse(t.dataset.date)); return; }
            if (t.dataset.act === 'today') { select(new Date()); return; }
            if (t.dataset.act === 'clear') { input.value = ''; input.dispatchEvent(new Event('change', { bubbles: true })); hide(true); }
        });
        pop.addEventListener('keydown', function (e) {
            var k = e.key;
            if (k === 'Escape') { e.preventDefault(); hide(true); return; }
            if (!e.target.classList.contains('dga-dp-day')) return;
            var rtl = isAr;
            if (k === 'ArrowRight') { e.preventDefault(); moveFocus(rtl ? -1 : 1); }
            else if (k === 'ArrowLeft') { e.preventDefault(); moveFocus(rtl ? 1 : -1); }
            else if (k === 'ArrowUp') { e.preventDefault(); moveFocus(-7); }
            else if (k === 'ArrowDown') { e.preventDefault(); moveFocus(7); }
            else if (k === 'PageUp') { e.preventDefault(); moveFocus(0, -1); }
            else if (k === 'PageDown') { e.preventDefault(); moveFocus(0, 1); }
            else if (k === 'Home') { e.preventDefault(); focusDate = new Date(focusDate.getFullYear(), focusDate.getMonth(), 1); render(); pop.querySelector('.dga-dp-day[tabindex="0"]').focus(); }
            else if (k === 'End') { e.preventDefault(); focusDate = new Date(focusDate.getFullYear(), focusDate.getMonth() + 1, 0); render(); pop.querySelector('.dga-dp-day[tabindex="0"]').focus(); }
        });
        document.addEventListener('click', function (e) { if (!pop.hidden && !wrap.contains(e.target)) hide(); });
    }
    function init(root) { (root || document).querySelectorAll('input.datepicker2, input.dga-datepicker, input[type="date"]').forEach(build); }
    window.dgaDatepicker = init;
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', function () { init(); }); else init();
})();
