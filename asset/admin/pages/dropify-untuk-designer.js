/*
 Template Name: Urora - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: upload. Js

 Edited
 */


!function($) {
    "use strict";


    // Basic
    $('.dropify').dropify({
        error: {
            'fileSize': 'File terlalu besar ({{ value }} max).',
            'minWidth': 'The image width is too small ({{ value }}}px min).',
            'maxWidth': 'The image width is too big ({{ value }}}px max).',
            'minHeight': 'The image height is too small ({{ value }}}px min).',
            'maxHeight': 'The image height is too big ({{ value }}px max).',
            'imageFormat': 'Format gambar tidak dibolehkan (hanya {{ value }}).',
            'fileExtension': 'Format file tidak dibolehkan (hanya {{ value }} atau png, jpg).'
        }
    });

    // Translated
    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove:  'Supprimer',
            error:   'Désolé, le fichier trop volumineux'
        }
    });

    // Used events
    var drEvent = $('#input-file-events').dropify();

    drEvent.on('dropify.beforeClear', function(event, element){
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element){
        alert('File deleted');
    });

    drEvent.on('dropify.errors', function(event, element){
        console.log('Has Errors');
    });

    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e){
        e.preventDefault();
        if (drDestroy.isDropified()) {
            drDestroy.destroy();
        } else {
            drDestroy.init();
        }
    })

    // disable input file jika input link terisi
    var input_link      = document.getElementById('link');
    var input_file      = document.querySelector('input[type=file]');
    var is_upload       = false;
    var remove_button   = document.getElementsByClassName('dropify-clear')[0];

    input_link.addEventListener('input', function()
    {
        if( $(this).val() ) {
            input_file.setAttribute('disabled', 'disabled');
            input_file.parentElement.classList.add('disabled');
        }
        else {
            input_file.removeAttribute('disabled');
            input_file.parentElement.classList.remove('disabled');
        }
    });

    input_file.addEventListener('change', function()
    {
        // input_link.toggleAttribute('disabled', 'disabled');
        if( input_file.files.length != 0 ) {
            input_link.setAttribute('disabled', 'disabled');
            is_upload = true;
            console.log( ' disabled');
        }
    });

    remove_button.addEventListener('click', function () {
        input_file.val  ='';
        input_link.removeAttribute('disabled');
    })
}
(window.jQuery);




