/* 
 * 2014
 * Author: Jiří Kvapil
 * 
 */
$(document).ready(function () {   
    
    $('img.note').jQueryNotes({loadNotes: true,allowLink: false,operator: '/notes/'});            
    
    $( ".datetimefuzzy" ).hover(
      function() {
        $( this ).find( ".fuzzy" ).toggle();
        $( this ).find( ".datetime" ).toggle();
      }
    );    
    
    /* projects/detail > show/hide button */
    $(document).on("click", "a.show-hide-info", function(e) {
        e.preventDefault();                
        $('#info').toggle(400);
        $('#edit').hide(400);
        $('a.show-hide-info').toggle();
    });     
    
    /* projects/detail > edit button */
    $(document).on("click", ".edit", function(e) {
        e.preventDefault();                        
        $('#info-container').toggle(400);        
        $('#edit').toggle(400);
    });    
            
    $(document).on("click", ".show-progressbar", function(e) {                                        
        $(this).prev(".progress").show();
    });     
        
    $('textarea').autosize({append: "\n"});
    
    $(".inline-modal").inlineModal();

    $(".tooltip-elem").tooltip();    
        
    $('.deadline').datetimepicker();

    $(document).on("click", "a.confirm-modal-dialog", function(e) {
        e.preventDefault();       
        var url = $(this).attr("href");                
        bootbox.confirm($(this).data("message"), function(confirmed) {
            if(confirmed) window.location = url;
        });                        
    });            

    $( "div.galery div.images div.actions" ).hide();            
    $( "div.images" ).hover(
      function() {
        $( this ).find( "div.actions" ).show();
      }, function() {
        $( this ).find( "div.actions" ).hide();
      }
    );       

    $(document).on("click", "a.reply", function(e) {
        e.preventDefault();                
        var parent = $(this).parent();                
        parent.parent().next().toggle();
    }); 

    $('.color-picker').minicolors();

    $( '.color-picker' ).change(function() {
        $('.wrapper').css('background-color', $(this).val());
    });   

    $('.myModal').draggable({
        handle: ".modal-header"
    });        
    
    $('.selectpicker').selectpicker();    
    
    $(document).on("click", "button#select_all", function(e) {
        e.preventDefault();                
        $('.selectpicker').selectpicker('selectAll');        
        $( this ).hide();
        $( "button#deselect_all" ).show();
    });   
    $(document).on("click", "button#deselect_all", function(e) {
        e.preventDefault();                
        $('.selectpicker').selectpicker('deselectAll');
        $( this ).hide();        
        $( "button#select_all" ).show();        
    });     

    /**
     * Following lines manipulates DOM for prijects sharing. Just hiding and 
     * showing appropriate elements.               
     */
    $('div#share').hide();                  
    $( 'input#team_sharing' ).change(function() {         
        $('div#team').toggle();
    });    
    $( '.visibility' ).click(function() {                
        $('div#public_permissions_box').hide();
        $('div#secure_permissions_box').hide();        
        $('div#secure_permissions_box').find("input#password").removeAttr('required');
        if($( this ).val() === "2"){            
            $('div#public_permissions_box').toggle();
        }
        else if($( this ).val() === "3"){
            $('div#secure_permissions_box').find("input#password").attr("required", "");
            $('div#secure_permissions_box').toggle();            
        }
    });
    
    $( 'input#select_all_permissions' ).change(function() {         
        if( $(this).is(":checked") ){
            $( "div.option" ).find( "input" ).prop('checked', true);        
        } else {
            $( "div.option" ).find( "input" ).prop('checked', false);
        }        
    });   
    
    $( "div.option" ).find( "input" ).change(function() {         
        if( !$(this).is(":checked") ){
            $( 'input#select_all_permissions' ).prop('checked', false);        
        }
    });          
    
  });   
    
