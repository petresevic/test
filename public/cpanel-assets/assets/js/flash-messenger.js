$(document).ready(function() {
    window.cpanel                     = window.cpanel                     || {};
    window.cpanel.flashMessenger      = window.cpanel.flashMessenger      || {};
    window.cpanel.flashMessenger.init = window.cpanel.flashMessenger.init || [];

    var globalOptions = {
        closeButton:       true,
        debug:             false,
        newestOnTop:       false,
        progressBar:       true,
        positionClass:     'toast-top-right',
        preventDuplicates: false,
        showDuration:      '300',
        hideDuration:      '1000',
        timeOut:           '7000',
        extendedTimeOut:   '1000',
        showEasing:        'swing',
        hideEasing:        'linear',
        showMethod:        'fadeIn',
        hideMethod:        'fadeOut',
        onclick:           null
    };

    jQuery.each(cpanel.flashMessenger.init, function(index, item){
        if (item.type === 'info') {
            toastr.info(item.message, item.title, globalOptions);
        }
        if (item.type === 'warning') {
            toastr.warning(item.message, item.title, globalOptions);
        }
        if (item.type === 'error') {
            toastr.error(item.message, item.title, globalOptions);
        }
        if (item.type === 'success') {
            toastr.success(item.message, item.title, globalOptions);
        }
    });
});
