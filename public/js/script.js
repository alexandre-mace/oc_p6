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
	index = $(this).attr('data-rel')
	readURL(this, index);
});

// Make the checkbox for main image choice unique
$('body').on('change', '.uniqCheckbox', function() {
    $('.uniqCheckbox').not(this).prop('checked', false);  
});