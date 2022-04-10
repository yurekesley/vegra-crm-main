$(() => {
    $(document).on('change', '.image-upload', function (event) {
        console.log("preview_" + event.target.id);
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview_" + event.target.id);
            preview.src = src;
            preview.style.display = "block";
        }
    });
    $(document).on('change', '.file-upload', function (event) {
        console.log("preview_" + event.target.id);
        if (event.target.files.length > 0) {
            var preview = document.getElementById("preview_" + event.target.id);
            preview.innerHTML = event.target.files[0].name;
            preview.style.display = "block";
        }
    });
});
