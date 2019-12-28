var i = 0;

$( document ).on( "click", "#start", function(){
    if( i>=1246757 )
        return $( "#message" ).text( "Done" );
    i++;
    var url = "https://stackoverflow.com/questions?page="+i;
    $.ajax( {
        url : url,
        type : "GET",
        success : function( res ){
            let html = $.parseHTML( res )
            console.log( $(html).find( ".questions" ) );
        }
    } );
} );