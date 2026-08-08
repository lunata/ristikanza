function highlightSentences() {
    $(".sentence").hover(function(){ // over
            var trans_sid = 'trans' + $(this).attr('id');
            $("#"+trans_sid).css('background','yellow');
        },
        function(){ // out
            $(".trans_sentence").css('background','none');
        }
    );
    
    $(".trans_sentence").hover(function(){ // over
            var sid = $(this).attr('id').replace('trans','');
            var cyr_sid = $(this).attr('id').replace('trans','cyr');
            $("#"+sid).css('background','#a9eef8');
            $("#"+cyr_sid).css('background','#bef587');
        },
        function(){ // out
            $(".sentence").css('background','none');
            $(".cyr_sentence").css('background','none');
            $(".word-marked").css('background','yellow');
        }
    );    
    
    $(".sentence w").hover(function(){ // over
            var cyr_id = 'cyr_w_' + $(this).attr('id');
            $("#"+cyr_id).css('background','#bef587');
        },
        function(){ // out
            $(".cyr_word").css('background','none');
        }
    );
    
    $(".cyr_word").hover(function(){ // over
            var text_id = $(this).attr('id').replace('cyr_w_','');
            $(".sentence #"+text_id).css('background','#a9eef8');
        },
        function(){ // out
            var text_id = $(this).attr('id').replace('cyr_w_','');
            $(".sentence #"+text_id).css('background','none');
            $(".word-marked").css('background','yellow');
        }
    ); 
    //#8cd049   
}

function toggleColumns() {
    $("#hide-cyrtext").click(function() {
        $("#cyrtext-c").hide();
        $(this).hide();
        $("#show-cyrtext").show();
    });

    $("#show-cyrtext").click(function() {
        $("#cyrtext-c").show();
        $(this).hide();
        $("#hide-cyrtext").show();
    });
    
    $("#hide-transtext").click(function() {
        $("#transtext-c").hide();
        $(this).hide();
        $("#show-transtext").show();
    });

    $("#show-transtext").click(function() {
        $("#transtext-c").show();
        $(this).hide();
        $("#hide-transtext").show();
    });
}