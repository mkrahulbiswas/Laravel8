var pathArray = window.location.pathname.split('/');

if (jQuery.inArray("loader", pathArray) >= 1 && jQuery.inArray("details", pathArray) >= 1) {

    $('.loader-details').summernote({
        height: 350, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false, // set focus to editable area after initializing summernote
        // callbacks: {
        //     onInit: function () {
        //         $("div.note-editor button.btn-codeview").click();
        //     }
        // },
        toolbar: [
            ["view", ["fullscreen", "codeview", "help"]]
        ],
        // codemirror: {
        //     theme: 'blackboard',
        //     lineNumbers: true
        // }
    });

} else {
    $('.summernote').summernote({
        height: 350, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false, // set focus to editable area after initializing summernote
        placeholder: 'Paste content here...',
    });

    $('.summernote-height-200').summernote({
        height: 200, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false // set focus to editable area after initializing summernote
    });
}
