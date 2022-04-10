<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.tiny-mce-component', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists image print searchreplace code imagetools',
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table image',
        menubar: '',
        language: 'pt_BR',
        branding: false,
        statusbar: false,
        paste_data_images: true,
        images_upload_handler: function(blobInfo, success, failure) {
            var reader = new FileReader();
            reader.readAsDataURL(blobInfo.blob());
            reader.onload = function() {
                success(this.result);
            }
        }
    });
</script>
