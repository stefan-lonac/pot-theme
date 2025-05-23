jQuery(function ($) {
  // on upload button click
  $('body').on('click', '.pt-img-upload, .pt-img-upload-favicon', function (event) {
    event.preventDefault(); // prevent default link click and page refresh

    const button = $(this)
    const imageId = button.next().next().val();

    const imageUploader = wp.media({
      title: 'Insert image', // modal window title
      library: {
        // uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
        type: 'image'
      },
      button: {
        text: 'Use this image' // button label text
      },
      multiple: false
    }).on('select', function () { // it also has "open" and "close" events
      const attachment = imageUploader.state().get('selection').first().toJSON();
      let imageSizeClass = '';

      if (button.hasClass('pt-img-upload')) {
        imageSizeClass = 'w-[150px] height-[150px]';
      } else if (button.hasClass('pt-img-upload-favicon')) {
        imageSizeClass = 'w-[48px] height-[48px]';
      }

      if (button.hasClass('pt-img-upload-favicon') && (attachment.width > 512 && attachment.height > 512)) {
        $('.pt-favicon-error').show();
        return;
      }
      
      $('.pt-favicon-error').hide();
      button.removeClass('button  ' + ptStyleComponents.buttonPrimary + '').html('<img class="' + imageSizeClass +'" src="' + attachment.url + '">'); // add image instead of "Upload Image"
      button.next().show(); // show "Remove image" link
      button.next().next().val(attachment.id); // Populate the hidden field with image ID
    })

    // already selected images
    imageUploader.on('open', function () {

      if (imageId) {
        const selection = imageUploader.state().get('selection')
        attachment = wp.media.attachment(imageId);
        attachment.fetch();
        selection.add(attachment ? [attachment] : []);
      }
    })

    imageUploader.open()

  });
  // on remove button click
  $('body').on('click', '.pt-img-remove', function (event) {
    event.preventDefault();
    const button = $(this);
    button.next().val(''); // emptying the hidden field
    button.hide().prev().addClass('button ' + ptStyleComponents.buttonPrimary + '').html('Upload image'); // replace the image with text
  });
});