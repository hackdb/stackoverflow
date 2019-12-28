var i = 0;
busy = false;
questionList = [];
$( document ).on( "click", "#start", function(){
    hackDB()
} );
function hackDB(){
    if( busy )
        return;
    busy = true;
    if( i>=1246757 )
        return $( "#message" ).text( "Done" );
    i++;
    var url = "https://stackoverflow.com/questions?page="+i;
    $.ajax( {
        url : url,
        type : "GET",
        success : function( res ){
            let html = $.parseHTML( res )
            var questions = $(html).find( "#questions .question-summary" );
            questionList = [];
            questions.each( function(){
                let question = {
                    title : $(this).find(".summary h3 a:first").text().trim(),
                    url : $(this).find(".summary h3 a:first").attr("href"),
                    description : $(this).find(".excerpt").text().trim(),
                    question_time : $(this).find(".relativetime").attr('title').replace("Z", ""),
                    uid : $(this).find(".summary h3 a:first").attr("href").split("/")[2],
                    tags : []
                }
                let tags = $(this).find( ".tags a" );
                tags.each( function(){
                    let tag = {
                        name : $( this ).text(),
                        url : $( this ).attr("href")
                    }
                    question.tags.push( tag );
                } );
                questionList.push( question );
            } );
            $("#msg").text( "Saving to Database..." );
            $.ajax({
                url : "api.php",
                type : "POST",
                data : {
                    module : "add-question_mst",
                    data : JSON.stringify(questionList)
                },
                success : function( res ){
                    if( res=="Done" ){
                        $("#msg").text( "Saved, now waiting 2 seconds.." );
                        $( "#counts" ).text( parseInt($("#counts").text())+questionList.length );
                        setTimeout( function(){
                            busy = false;
                            $("#msg").text( "Fetching..." );
                            hackDB();
                        }, 2000 );
                    }else{
                        $("#msg").text( "Cannot Save Error!! See console" );
                        console.log( res );
                    }
                }
            })
        },
        error : function( err ){
            console.log( err );
        }
    } );
}
