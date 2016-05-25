function urldecode (str) {
  return decodeURIComponent((str + '').replace(/\+/g, '%20'));
}

// Vertical centered modals
// you can give custom class like this // var modalVerticalCenterClass = ".modal.modal-vcenter";

var modalVerticalCenterClass = ".modal";
function centerModals($element) {
    var $modals;
    if ($element.length) {
        $modals = $element;
    } else {
        $modals = $(modalVerticalCenterClass + ':visible');
    }
    $modals.each( function(i) {
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 0 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top);
    });
}
$(modalVerticalCenterClass).on('show.bs.modal', function(e) {
    centerModals($(this));
});
$(window).on('resize', centerModals);

$(".modal").on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var content = button.data('activity'); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);
  
  modal.find('.title-activity').text(content);
  modal.find('#send_activite').val(content);
  //modal.find('.modal-body input').val(recipient)
})