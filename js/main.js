jQuery(document).ready(function($) {
var pointer = "//code-codec.fr/ocr//wp-content/themes/ocrgood/video-header/";
testExp = new RegExp('Android|webOS|iPhone|' +
    		       'BlackBerry|Windows Phone|'  +
    		       'Opera Mini|IEMobile|Mobile' , 
    		      'i');
    		      
var img = $('.video').data('placeholder'),
    $video = $('.video').data('video'),
    noVideo = $('.video').data('src'),
    video = $('.video').get(0);
    el = '';

if($(window).width() > 599 && !testExp.test(navigator.userAgent)) {
    el +=   '<video id="video" autoplay loop poster="' + img + '">';
    el += 		'<source src="' + $video + '.webm ' +'" type="video/webm">';
    el +=       '<source src="' + $video +'.m4v ' +  '" type="video/mp4">';
    el += 		'<source src="' + $video + '.ogv ' +'" type="video/ogg">';
   
    el +=   '</video>';
    el +=  '<!-- Video Controls --><div id="video-controls"><img src="' + pointer + 'pause.png" id="play-pause"/></div>';
} else {
    el = '<div class="video-element" style="background-image: url(' + noVideo + ')"></div>';
}
$('.video').prepend(el);
var playButton = $("#play-pause");

// Event listener for the play/pause button
playButton.on("click", function() {
var vid = document.getElementById("video");
  if (vid.paused == true) {
    // Play the video
    playButton.attr('src', pointer +'pause.png');
    vid.play();
    
  } else {
    // Pause the video
    playButton.attr('src',pointer + 'play.png');
    vid.pause();

  }
});


// Find all YouTube & vimeo videos
var youtube = function () {

    var $allVideos = $("iframe[src*='//player.vimeo.com'], iframe[src*='//www.youtube'], object, embed");
   
    var $fluidEl;

	$allVideos.each(function() {
	
	$(this).wrap("<figure></figure>");
	$fluidEl = $("figure");
								
	$(this)
	    // jQuery .data does not work on object/embed elements
	    .attr('data-aspectRatio', this.height / this.width)
	    .removeAttr('height')
	    .removeAttr('width');

	});

	$(window).resize(function() {
	if($fluidEl){
	  var newWidth = $fluidEl.width() ;
	  $allVideos.each(function() {
		 var $el = $(this);
	     $el
	        .width(newWidth)
	        .height(newWidth * $el.attr('data-aspectRatio'));

	  });
	}

	}).resize();

};
youtube();




});