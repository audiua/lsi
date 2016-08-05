$(function () {

    // add image form from prototype
    function addForm(collectionHolder) {
        var prototype = collectionHolder.data('prototype');
        // prototype = prototype.replace('class="form-group"', 'class="image-entry"');
        var index = collectionHolder.data('index');
        // var index = 0;
        var newForm = $(prototype.replace(/__name__/g, index));
        collectionHolder.data('index', index + 1);
        collectionHolder.append(newForm);

        return index;
    }

    function addFormDeleteLink() {
        // remove image button
        $('.remove-image').on('click', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });
    }
    
    addImageFormDeleteLink();
});