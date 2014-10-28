var fireBaseRef = new Firebase("https://radiant-inferno-2509.firebaseio.com/");

var userCounter = 0;
var username;
var loginTime = new Date();
var logoutTimer;

function persistUser(name) {
    var usersRef = fireBaseRef.child("users");
    var currentUserRef = usersRef.push({
        name: name
    });
    currentUserRef.onDisconnect().remove();
    $("#chat-username").text(name);
}

function makeUniqueUser(name, usernames) {
    if(usernames.indexOf(name) != -1) {
        makeUniqueUser(name+Math.floor(Math.random()*100 + 1), usernames);
    } else {
        persistUser(name);
        return name;
    }
}

$(document).ready(function() {
    $("#chat-logout").show();
    var userNames = [];

    fireBaseRef.child("users").once("value", function(snapshot) {
        snapshot.forEach(function(elm) {
            userNames.push(elm.val().name);
        });
        username = $("#chat-username").text();
        username = makeUniqueUser(username, userNames);
    });
});

$("#message-send").bind("click",function(event) {
    event.preventDefault();
    event.stopPropagation();

    var message = $("#message-body");
    var messageValue = $.trim(message.val());

    if(messageValue.length === 0) {
        alert("comment needed");
    } else {
        fireBaseRef.child("messages").push({
            username: username,
            sentAt: Firebase.ServerValue.TIMESTAMP,
            message: messageValue
        }, function(error) {
            if(error !== null) {
                alert("Unable to push comments to Firebase!");
            }
        });

        message.val("");
    }

    return false;
});

$("#chat-logout").click(function() {
    location.href = "/z4/chat.php";
});

$("#form").submit(function(event) {
    event.preventDefault();
    $("#message-send").trigger("click");
});


$(document).on("mousemove keydown click", function() {
    clearTimeout(logoutTimer);
    logoutTimer = setTimeout(function(){
        location.href = "/z4/chat.php";
    },1000 * 60 * 5);
});

fireBaseRef.child("users").on("child_added", function(snapshot) {

    var user = snapshot.val();
    $("<span/>",{class:"label label-info",id:snapshot.name()}).html(user.name).appendTo($("#chat-users"));
    userCounter++;
    $("#chat-users-count").html(userCounter);
});


fireBaseRef.child("users").on("child_removed", function(snapshot) {
    $("#"+snapshot.name()).remove();
    userCounter--;
    $("#chat-users-count").html(userCounter);
});

fireBaseRef.child("messages").on("child_added", function(snapshot) {
    var sentBy = snapshot.val().username;
    var message = snapshot.val().message;
    var sentAt = moment(new Date(snapshot.val().sentAt)).format("h:mm");
    if(snapshot.val().sentAt >= loginTime) {
        $("<div/>",{class: "message-container"}).html('<strong>'+sentBy+'</strong><span class="text-muted"> ('+sentAt+')</span> '+message).appendTo($("#chat-container"));
        $("#chat-container").scrollTop($("#chat-container").prop('scrollHeight'));
    }
});