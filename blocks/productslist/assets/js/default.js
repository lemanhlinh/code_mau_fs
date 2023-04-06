$(document).ready(function () {
    $('a.tab-cat').on('click', function () {
        var me = $(this);
        var id = me.data('id');
        if (!id)
            return false;

        if (me.hasClass('active')) {
            me.removeClass('active');
            $('.item-products').show();
        } else {
            $('a.tab-cat').removeClass('active');
            me.addClass('active');
            $('.item-products').hide();
            $('.products-'+id).show();
        }
    })
});