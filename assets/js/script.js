$(document).scroll(function () {
    localStorage['page'] = document.URL;
    localStorage['scrollTop'] = $(document).scrollTop();
});

$(document).ready(function () {
    if (localStorage['page'] == document.URL) {
      $(document).scrollTop(localStorage['scrollTop']);
    }
    console.log("Document is ready.");
});

$(document).ready(function () {
  $('#loadmore').on('click', function () {

    var xhttp = new XMLHttpRequest();
    var start = $('#course-d').length;
    
    xhttp.open("POST", "/coffee/ajax", true);
    xhttp.setRequestHeader("X-Requested-With", "XMLHTTPRequest");
    xhttp.send('start=' + start);

    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = this.responseText;
        if (response) {
          var data = JSON.parse(response);
          var html = '';
          for (var i = 9; i < data.courses.length; i++) {
            var course = data.courses[i];
            html += '<div class="col">';
            html += '<a class="link-underline link-underline-opacity-0" href="course/' + course.courseid + '">';
            html += '<div class="card h-100">';
            html += '<img src="writable/uploads/courses/' + course.img + '" class="card-img-top" alt="cover img">';
            html += '<div class="card-body">';
            html += '<h5 class="card-title">' + course.coursename + '</h5>';
            html += '<p class="card-text">' + course.description + '</p>';
            html += '</div>';
            html += '</div>';
            html += '</a>';
            html += '</div>';
          }
          $('#ajaxResponse').append(html);
        } else {
          $('#loadmore').hide();
        }
      }
    };
  });
});

$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars i').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children().each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars i').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children();
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }

    var ratingValue = parseInt($('#stars i.selected').last().data('value'), 10);
    $('#rating').val(ratingValue);
    console.log(ratingValue);
    console.log($('#rating').val(ratingValue));

    var ratingValue1 = parseInt($('#stars1 i.selected').last().data('value'), 10);
    $('#rating1').val(ratingValue1);
    console.log(ratingValue1);
    console.log($('#rating1').val(ratingValue1));
  });
  
});