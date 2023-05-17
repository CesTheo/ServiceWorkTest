<!DOCTYPE html>
<html>
<head>
    <title>Check Internet Connection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }
        #status {
            font-size: 2em;
        }
    </style>
</head>
<body>
    <div id="status">
        Checking connection...
    </div>
    <div id="connexion">
        Calcul de la vitesse
    </div>
    <script>
        // Check if service workers are supported
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('sw.js').then(function(registration) {
                console.log('Service Worker registered with scope:', registration.scope);
            }, function(err) {
                console.log('Service Worker registration failed:', err);
            });
        }

        function updateConnectionStatus() {
            var status = document.getElementById('status');
            if (navigator.onLine) {
                status.textContent = 'You are online';
                status.style.color = '#27ae60';
                var connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
                console.log(connection)
                if (connection) {
                    var connexionText = document.getElementById('connexion');

                    var type = connection.effectiveType;

                    connexionText.textContent = connection.downlink + 'Mb/s //' +  type 

                    console.log('Connection type: ' + type);
                    console.log('Downlink: ' + connection.downlink + 'Mb/s');
                }

            } else {
                status.textContent = 'You are offline';
                status.style.color = '#c0392b';
            }
        }

        window.addEventListener('load', function() {
            setTimeout(updateConnectionStatus, 0);
        });
        window.addEventListener('online', updateConnectionStatus);
        window.addEventListener('offline', updateConnectionStatus);
    </script>
</body>
</html>
