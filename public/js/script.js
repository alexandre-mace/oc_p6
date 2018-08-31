// Bottom scrolling arrow
$(function() {
  $('#arrow-scroll-bottom').on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 800);
  });
});
// Bottom scrolling arrow
$(function() {
  $('#arrow-scroll-top').on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 800);
  });
});
// Button scrolling
$(function() {
  $('#button-scrolling').on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 800);
  });
});

// Dynamic collection handler
$(".btn-add").on("click", function() {
    var $collectionHolder = $($(this).data("rel"));
    var index = $collectionHolder.data("index");
    var prototype = $collectionHolder.data("prototype");
    $collectionHolder.append(prototype.replace(/__name__/g, index));
    $collectionHolder.data("index", index+1);
});

$("body").on("click", ".btn-remove", function() {
    $($(this).data("rel")).remove();
})


// Preview image before upload
function readURL(input, index) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#showImg-' + index).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("body").on("change", ".uploadImg", function(){
	index = $(this).attr('data-img')
	readURL(this, index);
});

// Make the checkbox for main image choice unique
$('body').on('change', '.uniqCheckbox', function() {
    $('.uniqCheckbox').not(this).prop('checked', false);  
});

// Modal confirmation on delete
$(function() {
  $('a[data-confirm]').click(function(ev) {
    var href = $(this).attr('href');
    
    if (!$('#dataConfirmModal').length) {
      $('body').append('<div id="dataConfirmModal" class="modal" tabindex="-1" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Please confirm</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn" data-dismiss="modal">No</button><a class="btn btn-danger" id="dataConfirmOK">Yes</a></div></div></div></div>');
    }
    $('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
    $('#dataConfirmOK').attr('href', href);
    $('#dataConfirmModal').modal({show:true});
    
    return false;
  });
});

// ajax upload
$(function () {
  $("body").on("change", ".file", function () {
    var $input = $($(this).data("rel"));
    var file = this.files[0];

    var formData = new FormData();
    formData.append("file", file);
    $.ajax({
        // Your server script to process the upload
        url: '/file/upload',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
          $input.val(data);
        }
    });
  });
});