<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"></link>
    <link rel="icon" href="favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <title>Your dashboard</title>
    <script src="https://kit.fontawesome.com/2751fbc624.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/peerjs@1.4.7/dist/peerjs.min.js"></script>
</head>
<body class="dash-body">
  <div class="header">
    <h1>Meet</h1>
    <?php
      include_once 'notif-menu.php';
    ?>
  </div>
  <div class="mainBody" id="videoChat">
<?php
session_start();
if(!isset($_SESSION["loggedIN"])){
  header('location:index.php');
}else{
//show dashboard menu
include_once 'dash-menu.php'
?>
<section> 
    <div class="video-stream">
        <video id="localVideo" autoplay></video>
        <video id="remoteVideo" autoplay></video>
        <div class="buttons">
            <button id="startButton"><i class="fa-solid fa-phone"></i></button>
            <button id="muteButton"><i class="fa fa-microphone"></i></button>
            <button id="stopVideoButton"><i class="fa fa-video"></i></button>
            <button id="endButton"><i class="fa-solid fa-phone"></i></button>
        </div> 
    </div>
</section>
<?php
    }
    ?>
</div>
</body>
<script>
var localVideo = document.getElementById('localVideo');
var remoteVideo = document.getElementById('remoteVideo');
var startButton = document.getElementById('startButton');
var endButton = document.getElementById('endButton');
var muteButton = document.getElementById('muteButton');
var stopVideoButton = document.getElementById('stopVideoButton');

var localStream;
var remoteStream;
var peerConnection;

// Start call button click event
startButton.addEventListener('click', function() {
    startButton.disabled = true;
    endButton.disabled = false;
    // Get user media (video and audio)
    navigator.mediaDevices.getUserMedia({ video: true, audio: true })
        .then(function(stream) {
            localStream = stream;
            localVideo.srcObject = stream;
            
            // Create peer connection
            peerConnection = new RTCPeerConnection();

            // Add local stream to the peer connection
            localStream.getTracks().forEach(function(track) {
                peerConnection.addTrack(track, localStream);
            });

            // Set up remote stream event
            peerConnection.ontrack = function(event) {
                remoteStream = event.streams[0];
                remoteVideo.srcObject = remoteStream;
            };

            // Generate SDP offer
            peerConnection.createOffer()
                .then(function(offer) {
                    // Set the local description of the peer connection
                    return peerConnection.setLocalDescription(offer);
                })
                .then(function() {
                    // Send the offer SDP to the other peer
                    sendOffer(peerConnection.localDescription.sdp);
                })
                .catch(function(error) {
                    // Handle the error
                    console.error('Error generating SDP offer:', error);
                });

            // Signaling and negotiation logic here
            // Include code for signaling server communication,
            // exchanging SDP and ICE candidates, etc.
        })
        .catch(function(error) {
            console.log('Error accessing media devices: ' + error);
        });
});


// End call button click event
    endButton.addEventListener('click', function() {
    startButton.disabled = false;
    endButton.disabled = true;

    // Close the peer connection
    if (peerConnection) {
        peerConnection.close();
        peerConnection = null;
    }

    // Stop local stream
    if (localStream) {
        localStream.getTracks().forEach(function(track) {
            track.stop();
        });
        localStream = null;
    }

    // Clear remote stream
    remoteVideo.srcObject = null;
    remoteStream = null;
});

var countMute = 1;
// Mute button click event
muteButton.addEventListener('click', function() {
    countMute  += 1;
    if (localStream) {
        localStream.getAudioTracks().forEach(function(track) {
            track.enabled = !track.enabled;
        });
        muteButton.classList.toggle('muted');
        if( countMute %2 != 0){
            muteButton.innerHTML = '<i class="fa fa-microphone"></i>';
            muteButton.style.color = 'rgb(53, 182, 190)';
        }else{
            muteButton.innerHTML = '<i class="fa fa-microphone-slash"></i>';
            muteButton.style.color = ' rgb(136, 33, 0)';
        }
    }
   
});

var countVid = 1;
// Stop video button click event
stopVideoButton.addEventListener('click', function() {
    countVid += 1;
    if (localStream) {
        localStream.getVideoTracks().forEach(function(track) {
            track.enabled = !track.enabled;
        });
        stopVideoButton.classList.toggle('stopped');
    }
    if( countVid %2 != 0){
        stopVideoButton.innerHTML = '<i class="fa fa-video"></i>';
        stopVideoButton.style.color = 'rgb(53, 182, 190)';
    }else{
        stopVideoButton.innerHTML = '<i class="fa fa-video-slash"></i>';
        stopVideoButton.style.color = ' rgb(136, 33, 0)';
    }
});
        // Offer SDP exchange
        function sendOffer(offerSdp) {
            // Prepare the data to be sent to the server
            const data = new FormData();
            data.append('action', 'offer');
            data.append('offerSdp', offerSdp);

            // Send the offer SDP to the PHP backend
            fetch('processing.php', {
                method: 'POST',
                body: data
            })
                .then(response => response.json())
                .then(responseData => {
                    // Handle the response from the server
                    if (responseData.status === 'success') {
                        // Offer successfully sent
                        // Perform any necessary actions on success
                    } else {
                        // Offer sending failed
                        // Handle the failure scenario
                    }
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error sending offer:', error);
                });
        }

        // Answer SDP exchange
        function sendAnswer(answerSdp) {
            // Prepare the data to be sent to the server
            const data = new FormData();
            data.append('action', 'answer');
            data.append('answerSdp', answerSdp);

            // Send the answer SDP to the PHP backend
            fetch('processing.php', {
                method: 'POST',
                body: data
            })
                .then(response => response.json())
                .then(responseData => {
                    // Handle the response from the server
                    if (responseData.status === 'success') {
                        // Answer successfully sent
                        // Perform any necessary actions on success
                    } else {
                        // Answer sending failed
                        // Handle the failure scenario
                    }
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error sending answer:', error);
                });
        }

        // ICE candidate exchange
        function sendIceCandidate(candidate) {
            // Prepare the data to be sent to the server
            const data = new FormData();
            data.append('action', 'candidate');
            data.append('candidate', JSON.stringify(candidate));

            // Send the ICE candidate to the PHP backend
            fetch('processing.php', {
                method: 'POST',
                body: data
            })
                .then(response => response.json())
                .then(responseData => {
                    // Handle the response from the server
                    if (responseData.status === 'success') {
                        // ICE candidate successfully sent
                        // Perform any necessary actions on success
                    } else {
                        // ICE candidate sending failed
                        // Handle the failure scenario
                    }
                })
                .catch(error => {
                    // Handle errors
                    console.error('Error sending ICE candidate:', error);
                });
        }
        // WebSocket client code
        const socket = new WebSocket('ws://localhost:8080');

        // Event handler for connection open
        socket.onopen = function() {
        console.log('WebSocket connection opened');
        };

        // Event handler for receiving messages
        socket.onmessage = function(event) {
        const message = event.data;
        console.log('Received message:', message);
        };

        // Event handler for connection close
        socket.onclose = function() {
        console.log('WebSocket connection closed');
        };

        // Send a message to the signaling server
        socket.send('Hello, server!');

    </script>
</html>