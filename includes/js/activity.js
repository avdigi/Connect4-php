function activityWatcher(){
 
    //The number of seconds that have passed
    //since the user was active.
    var secondsSinceLastActivity = 0;
 
    //Five minutes. 60 x 5 = 300 seconds.
    var maxInactivity = (10);

    //Setup the setInterval method to run
    //every second. 1000 milliseconds = 1 second.
    setInterval(function(){
        secondsSinceLastActivity++;
        if(secondsSinceLastActivity > maxInactivity){
            location.href = '../login/logout.php';
        }
    }, 60000);
 
    //The function that will be called whenever a user is active
    function activity(){
        //reset the secondsSinceLastActivity variable
        //back to 0
        secondsSinceLastActivity = 0;
    }
 
    //An array of DOM events that should be interpreted as
    //user activity.
    var activityEvents = [
        'mousedown', 'mousemove', 'keydown',
        'scroll', 'touchstart'
    ];
 
    //add these events to the document.
    //register the activity function as the listener parameter.
    activityEvents.forEach(function(eventName) {
        document.addEventListener(eventName, activity, true);
    });
 
 
}
 
activityWatcher();