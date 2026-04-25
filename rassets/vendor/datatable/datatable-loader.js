$(function () {

    // cek apakah ada tabel datatable
    if ($('.datatable').length === 0) {
        return; // tidak ada → stop
    }

    /* =========================
       LOAD CSS (CEGAH DOBEL)
    ========================= */
    if ($('link[data-dt]').length === 0) {

        const cssFiles = [
            'rassets/vendor/datatable/jquery.dataTables.min.css',
            'rassets/vendor/datatable/select.dataTables.min.css',
            'rassets/vendor/datatable/buttons.dataTables.min.css',
            'rassets/vendor/datatable/datatable-loader.css'
        ];

        cssFiles.forEach(function (file) {
            $('<link>', {
                rel: 'stylesheet',
                type: 'text/css',
                href: BASE_URL + file,
                'data-dt': 'true'
            }).appendTo('head');
        });
    }

    /* =========================
       LOAD JS (URUTAN PENTING)
    ========================= */
    if (!window.__DT_LOADED__) {

        const jsFiles = [
            'rassets/vendor/datatable/jquery.dataTables.min.js',
            'rassets/vendor/datatable/dataTables.select.min.js',
            'rassets/vendor/datatable/dataTables.buttons.min.js',
            'rassets/vendor/datatable/buttons.html5.min.js',
            'rassets/vendor/datatable/buttons.print.min.js',
            'rassets/vendor/datatable/buttons.colVis.min.js',
            'rassets/vendor/datatable/jszip.min.js',
            'rassets/vendor/datatable/pdfmake.min.js',
            'rassets/vendor/datatable/vfs_fonts.js'
        ];

        let i = 0;

        function loadNext() {
            if (i >= jsFiles.length) {
                window.__DT_LOADED__ = true;

                // 🔔 TRIGGER EVENT
                $(document).trigger('datatable:ready');

                return;
            }

            $.getScript(BASE_URL + jsFiles[i], function () {
                i++;
                loadNext();
            });
        }

        loadNext();
    }

});
/**
 * DataTable Button Generator
 * Compatible: CI3 + Bootstrap 4 / 5
 */
function dtBtn({
    text = '',
    icon = '',
    action = null,
    extend = null,
    color = 'primary',
    style = 'solid', // solid | outline | pastel
    shape = '',      // '' | pill | icon
    size = 'sm',     // sm | lg | ''
    extraClass = '',
    attr = {}
} = {}) {

    let classes = ['btn'];

    // size
    if (size) classes.push('btn-' + size);

    // style + color
    if (style === 'outline') {
        classes.push('btn-outline-' + color);
    } else if (style === 'pastel') {
        classes.push('btn-pastel', 'btn-pastel-' + color);
    } else {
        classes.push('btn-' + color);
    }

    // shape
    if (shape === 'pill') classes.push('btn-pill');
    if (shape === 'icon') classes.push('btn-icon');

    if (extraClass) classes.push(extraClass);

    return {
        text: icon ? `<i class="${icon}"></i>${text ? ' ' + text : ''}` : text,
        className: classes.join(' '),
        extend: extend || undefined,
        action: action || undefined,
        attr: attr,
        tag: 'button'
    };
}