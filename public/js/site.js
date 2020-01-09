function getButton(type, title, id, buttonClass){

    var iconClass = '';

    switch (type){
        case 'edit':
            iconClass = 'fa fa-pencil';
            break;
        case 'send':
            iconClass = 'fa fa-envelope-o';
            break;
        case 'view':
            iconClass = 'fa fa-eye';
            break;
        case 'delete':
            iconClass = 'fa fa-trash';
            break;
    }

    button = '<a data-id="' + id + '" href="javascript:void(0)" ' +
        'class="' + buttonClass + '" ' +
        'style="margin-right: 10px;" ' +
        'title="' + title + '">' +
        '<i class="' + iconClass + '"></i>' +
        '</a>';

    return button;
}