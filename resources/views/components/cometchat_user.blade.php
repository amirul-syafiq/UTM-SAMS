    <div id="cometchat"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script defer src="https://widget-js.cometchat.io/v3/cometchatwidget.js"></script>


    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            var authToken = ""
            var widgetId = ""
            var desiredHeight = 0;
            var desiredWidth = 0;
            // Check screen is phone
            if (window.matchMedia("(max-width: 767px)").matches) {
                // The viewport is less than 768 pixels wide
                // Set the height and width of the widget
                desiredHeight = window.screen.height * 0.8;
                desiredWidth = window.screen.width * 0.9;
            } else {
                // Calculate the desired height and width based on the screen dimensions
                desiredHeight = window.screen.height * 0.5; // For example, set the height to 80% of the screen height
                desiredWidth = window.screen.width * 0.5; // For example, set the width to 60% of the screen width
            }
            // Convert the calculated values to strings
            const heightValue = `${desiredHeight}px`;
            const widthValue = `${desiredWidth}px`;


            fetch('/chat')
                .then(response => response.json())
                .then(data => {
                    // Access the value returned from PHP
                    authToken = data.authToken;
                    widgetId = data.widgetId;
                }).then

            (CometChatWidget.init({
                "appID": "24002323c788ecb6",
                "appRegion": "us",
            })).then(response => {
                console.log("Initialization completed successfully");
                //You can now call login function.
                CometChatWidget.login({
                    "authToken": authToken
                }).then(response => {
                    CometChatWidget.launch({
                        "widgetID": widgetId,
                        "target": "#cometchat",
                        "roundedCorners": "true",
                        "height": heightValue,
                        "width": widthValue,
                        "docked": "true",


                    });
                }, error => {
                    console.log("User login failed with error:", error);
                    //Check the reason for error and take appropriate action.
                });
            }, error => {
                console.log("Initialization failed with error:", error);
                //Check the reason for error and take appropriate action.
            });
        });
    </script>
