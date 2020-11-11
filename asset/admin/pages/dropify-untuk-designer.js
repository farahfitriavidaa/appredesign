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
}
(window.jQuery);

window.onload=()=>{
    // disable input file jika input link terisi
    var input_link      = document.getElementById('link');
    var input_file      = document.querySelector('input[type=file]');
    var remove_button   = document.getElementsByClassName('dropify-clear')[0];
    var change_button   = document.getElementById('change');

    input_link.addEventListener('input', function(){
        if( input_link.value ) {
            input_file.setAttribute('disabled', 'disabled');
            input_file.parentElement.classList.add('disabled');
        }
        else {
            input_file.removeAttribute('disabled');
            input_file.parentElement.classList.remove('disabled');
        }
    });

    input_file.addEventListener('change', function() {
        if( input_file.files.length != 0 ) {
            input_link.setAttribute('disabled', 'disabled');
        }
    });

    remove_button.addEventListener('click', function () {
        input_file.value  ='';
        input_link.removeAttribute('disabled');
    });

    var idx = 1;
    var button_text = ['Ganti portofolio dengan file', 'Batalkan dan tetap pakai link'];
    change_button.addEventListener('click', function () {
        input_link.toggleAttribute('disabled');

        input_file.toggleAttribute('disabled');
        input_file.parentElement.classList.toggle('disabled');

        change_button.innerText = button_text[(idx%2)];
        idx++;
    });

    if( input_link.value ) {
        input_file.setAttribute('disabled', 'disabled');
        input_file.parentElement.classList.add('disabled');
    }
}