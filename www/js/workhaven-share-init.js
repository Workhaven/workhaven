/* 
 * 2014
 * Author: Jiří Kvapil
 * 
 */
$(document).ready(function () {   
    
    $('img.note').jQueryNotes({loadNotes: true,allowLink: false,operator: '/notes/'});
    
    $(document).on("click", "a.reply", function(e) {
        e.preventDefault();                
        var parent = $(this).parent();                
        parent.parent().next().toggle();
    });
    
    $( ".datetimefuzzy" ).hover(
      function() {
        $( this ).find( ".fuzzy" ).toggle();
        $( this ).find( ".datetime" ).toggle();
      }
    );     
});   
    
