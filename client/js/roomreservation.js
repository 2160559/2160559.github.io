$(function() {
    $('input[name=post-format]').on('click init-post-format', function() {
        $('#no_of_rooms').toggle($('#room').prop('checked'));
    }).trigger('init-post-format');
});
