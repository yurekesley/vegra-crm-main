GitLab
------

RosarioSIS code is now hosted at [**GitLab**](https://gitlab.com/francoisjacquet/tinymce-uploadimage)!

UploadImage, a TinyMCE plugin
=============================

![screenshot](https://raw.githubusercontent.com/francoisjacquet/tinymce-uploadimage/master/screenshot.png)

https://github.com/francoisjacquet/tinymce-uploadimage

Version 0.1 - January, 2017

License GNU GPL v2

Author François Jacquet

This plugin allows users to upload images which are directly placed into the text area.

Technically speaking, the image is automatically converted to base64 code. No images are uploaded to the server. The image data is directly placed inside the `src` of the HTML image tag.

## Requirements

This was written for [TinyMCE](http://tinymce.com/) version 4 (TinyMCE is a WYSIWYG HTML editor).

## Setup

Your TinyMCE init() method should contain the following value:
```javascript
tinymce.init({
	...
	plugins: 'uploadimage', // and your other plugins.
	toolbar: 'uploadimage'  // and your other buttons.
	...
});
```

To allow images drag-n-drop or pasting:
```javascript
tinymce.init({
	...
	paste_data_images: true,
	images_upload_handler: function (blobInfo, success, failure) {
		success("data:" + blobInfo.blob().type + ";base64," + blobInfo.base64());
	},
	...
});
```

## Limitations

base64 encoded images are larger than its couterpart file.

Browsers _may_ have image size limitations (around 8.5Mb).

If saved to DB, you may end up storing lots of data...

## Demo

You can test this plugin within [RosarioSIS](https://github.com/francoisjacquet/rosariosis/).
Go to the [demo site](https://www.rosariosis.org/demo/), login as `administrator`, then browse to _Students > Print Letters_.

## Save base64 image to disk

RosarioSIS can automatically save base64 images to disk, thanks to [this function](https://github.com/francoisjacquet/rosariosis/blob/mobile/ProgramFunctions/MarkDownHTML.fnc.php#L158) which detects and extracts base64 images in the TinyMCE HTML; and [this function](https://github.com/francoisjacquet/rosariosis/blob/mobile/ProgramFunctions/FileUpload.fnc.php#L99) which actually uploads the image to the server.

## Credits

@boxuk for the original plugin, see https://github.com/boxuk/tinymce-imageupload
