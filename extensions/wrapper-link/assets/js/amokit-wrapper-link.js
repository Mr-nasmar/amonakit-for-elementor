jQuery(document).ready(function($) {
    $('body').on('click', '.amo-element-link', function () {
        var $target = $(this),
                data = $target.data('amokit-element-link'),
                id = $target.data('id'),
                hrefData = document.createElement('a'),
                hrefDataReal,
                timeout;
        hrefData.id = 'amokit-wrapper-link-' + id;
        hrefData.href = data.url;
        hrefData.target = data.is_external ? '_blank' : '_self';
        hrefData.rel = data.nofollow ? 'nofollow noreferer' : '';
        hrefData.style.display = 'none';
        document.body.appendChild(hrefData);
        hrefDataReal = document.getElementById(hrefData.id);
        hrefDataReal.click();
        timeout = setTimeout( function () {
            document.body.removeChild(hrefDataReal);
            clearTimeout(timeout);
        });
    });
});


