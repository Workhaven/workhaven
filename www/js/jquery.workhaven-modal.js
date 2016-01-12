/* 
 * 
 * 
 * 
 */

(function( $ ) {
 
    $.fn.inlineModal = function() {
         
        return this.each(function() {
            var inline_content = $('body').find($( this ).attr("href"));
            var class_name = $( this ).attr("data-target");
            var title = "&nbsp;";
            if (typeof $( this ).attr("title") !== "undefined") {
                title =  $( this ).attr("title");
            }
            $('<div id="'+ class_name.slice(1) +'" class="modal fade myModal" style="outline: 0px; position: absolute; overflow-y: auto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">' +            
                '<div class="modal-dialog modal-lg">' +
                    '<div class="modal-content">'  +
                        '<div class="modal-header">' +
                            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' +
                            '<h4 class="modal-title">' +
                                title +
                            '</h4>' +
                        '</div>' +
                        '<div class="modal-body">' +
                            inline_content.html() +
                        '</div>' +        
                    '</div>' +
                '</div>' +            
            '</div>').appendTo( "body" );                        
        });
 
    };
 
}( jQuery ));
