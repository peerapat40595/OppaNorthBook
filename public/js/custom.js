// $('document').each(function(){ 
//   alert("yo"); 
//   var sh=screen.height()-30; 
//   $('.square-modal').css('max-height',sh) 
// }); 
  
 app.directive('styleParent', function(){  
    return { 
      restrict: 'A', 
      link: function(scope, elem, attr) { 
          elem.on('load', function() { 
             var w = $(this).width(), 
                 h = $(this).height(); 
  
  
             //check width and height and apply styling to parent here. 
               var div = $('.square'); 
               var width = div.width();  
      
             // // div.css('height', width); 
             // // div.css('width',width); 
             //  div.css('overflow','hidden'); 
               var shiftp=((h-width)/2)/width*100; 
              
             if(w>h){ 
                  
                 $(this).css('max-width','none'); 
                 $(this).css('max-height','100%'); 
                 var shiftp2=(($(this).width()-width)/2)/width*100; 
                 $(this).css('right',shiftp2+'%'); 
                 $('.square-modal').css('right',shiftp2+'%'); 
  
             } 
             else
             { 
                 $(this).css('max-width','100%'); 
                  $(this).css('bottom',shiftp+'%'); 
                  $('.square-modal').css('bottom',shiftp+'%'); 
  
             } 
          }); 
      } 
    }; 
 });    