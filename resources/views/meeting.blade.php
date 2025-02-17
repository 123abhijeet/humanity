@extends('backend.layouts.master')
@section('title', 'Join Meeting | Sattree Gurukul')
@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .scrollable-container {
        max-height: 300px;
        overflow-y: auto;
    }

    #user-list {
        max-height: 250px;
    }

    #message {
        max-height: 250px;
    }
</style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Meeting</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('Admin-Dashboard') }}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Meeting</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row" id="join-meeting-btn">
            <div class="col-sm-12 col-12 text-right add-btn-col" style="margin-left: 0%;">
                <button class="btn btn-primary btn-rounded" onclick="startMeeting()">Join Meeting</button>
            </div>
        </div>
        <div class="row mb-2" style="height: 60vh; display: flex; align-items: flex-start;">
            <div class="col-sm-6 col-6 text-center" id="video-container" style="display: none; flex: 1; height: 100%;">
                <div id="local-video" style="width: 100%; border: 2px solid #28a745; margin-bottom: 50%; border-radius: 2%; height: 100%;"></div>
            </div>
            <div class="col-sm-2 col-2" id="user-list-container" style="display: none; border: 1px solid #28a745; text-align: center; padding-bottom: 0; margin-bottom: 8%; flex: 1; height: 100%; border-radius: 2%;">
                <h4>Audience</h4>
                <div id="remote-video" style="width: 30px; height: 5px;"></div>
                <ul id="user-list" style="list-style-type: none; height: 71%; padding: 0;" class="scrollable-container">
                   
                </ul>
            </div>
            <div class="col-sm-4 col-4 px-2" id="message-container" style="display: none; border: 1px solid #28a745; text-align: center; border-radius: 2%; margin-bottom: 8%; padding-bottom: 2%; flex: 1; height: 100%;">
                <h4>Chat</h4>
                <ul id="message" style="list-style-type: none; height: 71%; padding: 0;" class="scrollable-container">
                   
                </ul>
                <div style="margin-top:-1%;">
                    <textarea class="form-control" id="chat-input" rows="2" cols="50" placeholder="Type a message..."></textarea>
                    <button class="btn btn-primary" style="margin-left: 85%; margin-top: -22%;" onclick="sendMessage()"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-12 text-right add-btn-col" style="margin-left: -55%; margin-top: -7%;">
                <button id="leave-meeting-btn" class="btn btn-danger btn-rounded mr-2" onclick="leaveMeeting()" style="display: none;">Leave Meeting</button>
                <button id="toggle-mute-audio" class="btn btn-secondary btn-rounded mr-2" style="display: none;">Mute Audio</button>
                <button id="toggle-mute-video" class="btn btn-secondary btn-rounded mr-2" style="display: none;">Mute Video</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.20.2.js"></script>
<script>
    let client = AgoraRTC.createClient({
        mode: "live",
        codec: "vp8"
    });
    let localAudioTrack;
    let localVideoTrack;
    let isAudioMuted = false;
    let isVideoMuted = false;
    const role = 'host'; // 'host' or 'audience'
    const joinedUsers = {}; // To keep track of joined users

    async function startMeeting() {
        const appId = 'edc91d506be342f7ba3be8fd650610a8'; // Replace with your Agora App ID
        const channelName = '{{$channelName}}';
        const token = '{{$token}}'; // Get this from your backend

        try {
            // Set the user role before joining the channel
            client.setClientRole(role);

            // Join the channel
            await client.join(appId, channelName, token, null);

            if (role === 'host') {
                [localAudioTrack, localVideoTrack] = await AgoraRTC.createMicrophoneAndCameraTracks();
                localVideoTrack.play('local-video');
                await client.publish([localAudioTrack, localVideoTrack]);
                console.log("Publish local tracks successfully");

                $.ajax({
                    url: '/update-joining-status',
                    type: 'POST',
                    data: {
                        channelName: channelName,
                        status: 1,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log("Status updated successfully");
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

                document.getElementById('toggle-mute-audio').style.display = 'inline-block';
                document.getElementById('toggle-mute-video').style.display = 'inline-block';
            }


            // Show the video container and the leave meeting button
            document.getElementById('video-container').style.display = 'block';
            document.getElementById('user-list-container').style.display = 'block';
            document.getElementById('message-container').style.display = 'block';
            document.getElementById('join-meeting-btn').style.display = 'none';
            document.getElementById('leave-meeting-btn').style.display = 'inline-block';

            client.on('user-published', async (user, mediaType) => {
                updateJoinedUserList();
            });

            client.on('user-unpublished', (user) => {
                updateJoinedUserList();
            });

            client.on('user-left', (user) => {
                updateJoinedUserList();
            });


            // Update button actions
            if (role === 'host') {
                document.getElementById('toggle-mute-audio').addEventListener('click', () => {
                    if (isAudioMuted) {
                        localAudioTrack.setEnabled(true);
                        document.getElementById('toggle-mute-audio').innerText = 'Mute Audio';
                    } else {
                        localAudioTrack.setEnabled(false);
                        document.getElementById('toggle-mute-audio').innerText = 'Unmute Audio';
                    }
                    isAudioMuted = !isAudioMuted;
                });

                document.getElementById('toggle-mute-video').addEventListener('click', () => {
                    if (isVideoMuted) {
                        localVideoTrack.setEnabled(true);
                        document.getElementById('toggle-mute-video').innerText = 'Mute Video';
                    } else {
                        localVideoTrack.setEnabled(false);
                        document.getElementById('toggle-mute-video').innerText = 'Unmute Video';
                    }
                    isVideoMuted = !isVideoMuted;
                });
            }

        } catch (err) {
            console.error("Error in joining or publishing stream: ", err);
        }
    }

    async function leaveMeeting() {
        const channelName = '{{$channelName}}';
        try {
            await client.leave();
            if (localAudioTrack) {
                localAudioTrack.close();
            }
            if (localVideoTrack) {
                localVideoTrack.close();
            }
            $.ajax({
                url: '/update-joining-status',
                type: 'POST',
                data: {
                    channelName: channelName,
                    status: 0,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log("Status updated successfully");
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
            
                 // Reset chats
            $.ajax({
                url: `/reset-chats/${channelName}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log("Chats reset successfully");
                },
                error: function(xhr, status, error) {
                    console.error('Error resetting chats:', xhr.responseText);
                }
            });
    
            // Reset users
            $.ajax({
                url: `/reset-users/${channelName}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log("Users reset successfully");
                },
                error: function(xhr, status, error) {
                    console.error('Error resetting users:', xhr.responseText);
                }
            });
            
            document.getElementById('local-video').innerHTML = '';
            console.log("Left the channel");

            document.getElementById('video-container').style.display = 'none';
            document.getElementById('user-list-container').style.display = 'none';
            document.getElementById('message-container').style.display = 'none';
            document.getElementById('join-meeting-btn').style.display = 'inline-block';
            document.getElementById('leave-meeting-btn').style.display = 'none';
            document.getElementById('toggle-mute-audio').style.display = 'none';
            document.getElementById('toggle-mute-video').style.display = 'none';

            // Clear the user list
            joinedUsers = {};
            updateJoinedUserList();
        } catch (err) {
            console.error("Error in leaving the meeting: ", err);
        }
    }

   function updateJoinedUserList() {
    const channel_name = '{{$channelName}}';
    $.ajax({
        url: '/all-users/' + channel_name,
        type: 'GET',
        success: function(response) {
            const userListContainer = document.getElementById('user-list');
            userListContainer.innerHTML = '';

            response.all_users.forEach(user => {
                const listItem = document.createElement('li');
                listItem.style.display = 'flex'; // To align image and username horizontally
                listItem.style.alignItems = 'center'; // Center the items vertically
                listItem.style.fontSize = '10px'; // Center the items vertically
                listItem.style.fontWeight = 'bold';

                const userImage = document.createElement('img');
                if(user.user_avatar == 'https://sattreevision.in/Student Picture')
                {
                userImage.src = '/default_user.jpg';
                }else{
                     userImage.src = user.user_avatar;
                }
                userImage.alt = user.user_name;
                userImage.style.width = '20px'; // Adjust size as needed
                userImage.style.height = '20px';
                userImage.style.borderRadius = '50%'; // To make the image circular
                userImage.style.marginRight = '5px'; // Space between image and username
                userImage.style.marginBottom = '2px'; // Space between image and username

                const userName = user.user_name || `User ${user.user_id}`; // Replace this with the actual username if available
                const userNameText = document.createTextNode(userName);

                listItem.appendChild(userImage);
                listItem.appendChild(userNameText);
                userListContainer.appendChild(listItem);
            });
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}


    document.addEventListener('DOMContentLoaded', function() {
        setInterval(updateJoinedUserList, 5000); // Refresh user list every 5 seconds
    });

        const channel_name = '{{$channelName}}';
        const user_id = '{{$user_id}}';
        const messageContainer = document.getElementById('message');
        
        // Fetch messages every second
        setInterval(fetchMessages, 1000);
        
        async function fetchMessages() {
            try {
                const response = await fetch(`/all-chat/${channel_name}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                });
        
                const data = await response.json();
                console.log(data); // Debug log to see the response structure
                if (data.status) {
                    updateMessageContainer(data.messages);
                }
            } catch (err) {
                console.error('Error fetching messages:', err);
            }
        }
        
        function updateMessageContainer(messages) {
            messageContainer.innerHTML = '';
            messages.forEach(message => {
                const listItem = document.createElement('li');
                listItem.style.display = 'flex'; // To align image and username horizontally
                listItem.style.alignItems = 'center'; // Center the items vertically
                listItem.style.fontSize = '10px';
        
                const userImage = document.createElement('img');
                
                if(message.user_avatar == 'https://sattreevision.in/Student Picture')
                {
                userImage.src = '/default_user.jpg';
                }else{
                     userImage.src = message.user_avatar;
                }
                userImage.alt = message.user_name;
                userImage.style.width = '20px'; // Adjust size as needed
                userImage.style.height = '20px';
                userImage.style.borderRadius = '50%'; // To make the image circular
                userImage.style.marginRight = '10px'; // Space between image and username
        
                const userName = document.createElement('span');
                userName.textContent = message.user_name; // Ensure there's a fallback name
                userName.style.fontWeight = 'bold';
                userName.style.marginRight = '5px'; // Space between username and message
        
                const messageText = document.createElement('span');
                messageText.textContent = message.message || ''; // Ensure there's a fallback message
        
                listItem.appendChild(userImage);
                listItem.appendChild(userName);
                listItem.appendChild(messageText);
                messageContainer.appendChild(listItem);
            });
            messageContainer.scrollTop = messageContainer.scrollHeight; // Auto-scroll to the bottom
        }
        
         async function sendMessage() {
    const chatInput = document.getElementById('chat-input');
    const message = chatInput.value;

    if (message.trim() === '') return;

    try {
        const response = await fetch('/store-chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                channel_name: channel_name,
                user_id: user_id,
                message: message
            }),
        });

        const data = await response.json();
        console.log(data); // Debug log to see the response structure
        if (data.status) {
            $('#chat-input').val('');
            fetchMessages(); // Fetch new messages
        }
    } catch (err) {
        console.error('Error sending message:', err);
    }
}


</script>
@endsection