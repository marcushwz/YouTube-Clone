// subscribe function

function subscribe(userTo, userFrom, button) {
    if(userTo == userFrom) {
        alert("You cant't subscribe to yourself");
        return;
    }
    
    $.post("ajax/subscribe.php", {userTo: userTo, userFrom: userFrom})
    .done(function(count) {

        if(count != null) {
            
            $(button).toggleClass("subscribe unsubscribe");

            var buttonText = $(button).hasClass("subscribe") ? "SUBSCRIBE" : "SUBSCRIBED";
            $(button).text(buttonText + " " + count);
        }
        else {
            alert("something went wrong");
        }

    });
}
