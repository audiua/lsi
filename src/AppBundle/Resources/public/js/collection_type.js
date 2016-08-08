$(function () {
    function addForm(collectionHolder) {
        var prototype = collectionHolder.data('prototype');
        var index = collectionHolder.data('index');
        var newForm = $(prototype.replace(/__name__/g, index));
        collectionHolder.data('index', index + 1);
        collectionHolder.append(newForm);
        addFormDeleteLink();
        return index;
    }

    function addFormDeleteLink() {
        console.log('this');
        $('a.remove').on('click', function(e) {
            console.log(this);
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    }

    $('.add-fields').on('click', function(e){
        e.preventDefault();
        addForm($('#shop_fields'));
    });

    $('.add-conditions').on('click', function(e){
        e.preventDefault();
        addForm($('#shop_conditions'));
    });

    addFormDeleteLink();
    console.log('oops');
});