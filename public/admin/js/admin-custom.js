$('table').on('click', 'a[data-toggle]', function () {
    let modal = $(this).attr('data-target');
    $(this).parents('tr').find('td[data-target]').each(function (i, item) {
        console.log($(modal).find(`[name="${$(item).attr('data-target')}"]`));
        $(modal).find(`[name="${$(item).attr('data-target')}"]`).val(
            $(item).hasClass('number') ? $(item).text().trim().replace(/,/g, '') : $(item).text().trim()
        );
    });
});

$('#table-brand').DataTable({
    order: [
        [ 3, 'desc' ]
    ]
});
$('#table-category').DataTable({
    order: [
        [ 3, 'desc' ]
    ]
});
$('#table-product').DataTable({
    columns: [{
        width: "5%"
    }, {
        width: "12.5%"
    }, {
        width: "12.5%"
    }, {
        width: "12.5%"
    }, {
        width: "12.5%"
    }, {
        width: "5%"
    }, {
        width: "5%"
    }, {
        width: "5%"
    }, {
        width: "7.5%"
    }, {
        width: "7.5%"
    }, {
        width: "7.5%"
    }, {
        width: "7.5%"
    }]
});
