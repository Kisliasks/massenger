$(document).ready(function(){

function allMyMesseges() {

        $.get("functions.php?messegecount=result", function(data){

            $(".all_my_messeges").text(data);

        });

}


allMyMesseges();

setInterval(function(){

    allMyMesseges();
},500);



function getMessegesFromUser() {

    $.get("messages_for_me.php?messege=result", function(html){

        $(".messege_from_user").html(html);

    });

}
getMessegesFromUser();

setInterval(function(){

    getMessegesFromUser();
},500);

});

function getAllMessegesInWindow() {


    $.get("all_messages_in_window.php?all_messeges=result", function(html){

        $(".all_messeges_in_window").html(html);

    });


}

getAllMessegesInWindow();

setInterval(function(){

    getAllMessegesInWindow();
},500);





