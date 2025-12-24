$(function () {
    'use strict';
    //buttons
    let callBtn = $("#callBtn");
    let acceptBtn = $("#acceptBtn");
    let declineBtn = $("#declineBtn");

    //varibles
    let user = {};
    let receiverID = callBtn.data('user');
    let receiverGuard = callBtn.data('guard');
    let peerConnection;
    let localStream;

    const localVideo = document.querySelector("#localVideo");
    const remoteVideo = document.querySelector("#remoteVideo");
    const config = {
        iceServers: [
            { urls: 'stun:strun1.l.google.com:19302' },
        ]
    }
    function createConn() {
        if (!peerConnection) {
            peerConnection = new RTCPeerConnection(config);
        }
    }

    async function getCam() {
        try {
            if (!peerConnection) {
                createConn();
            }

            let mediaStream = await navigator.mediaDevices.getUserMedia({
                video: true,
                audio: true
            });

            localVideo.srcObject = mediaStream;
            localStream = mediaStream;
            localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

            peerConnection.ontrack = event => {
                remoteVideo.srcObject = event.streams[0];
            }

        } catch (error) {
            if (error.name === "PermissionDeniedError") {
                alert("Camera permission denied. Please allow access");
            } else if (error.name === "NotFoundError") {
                alert("No Camera found. Please connect a camera");
            } else {
                alert("Something went wrong: ", error);
            }
        }
    }

    callBtn.on('click', async () => {
        await getCam();
        getUser(authGuard, authID).then(function (data) {
            showCall();
            user = data;
            send('is-client-ready', null, receiverGuard, receiverID, user);
        }).catch(function (error) {
            localStream
            console.error("Error getting user:", error);
        });
    });

    $(document).on('click', '#muteMicBtn', function () {
        muteMic();
        $(this).toggleClass('text-red-400');
    });


    $(document).on('click', '#muteCamBtn', function () {
        muteCam();
        $(this).toggleClass('text-red-400');
    });

    $(document).on('click', '#hangupBtn', function () {
        getUser().then(function (data) {
            user = data;
            send('client-hangup', null, receiverGuard, receiverID, user);
            peerConnection.close();
            peerConnection = null;
            location.reload(true);
        }).catch(function (error) {
            localStream
            console.error("Error getting user:", error);
        });
    });
    function muteMic() {
        if (peerConnection) {
            localVideo.srcObject.getAudioTracks().forEach((track) => {
                track.enabled = !track.enabled;
            });
        }
    }
    function muteCam() {
        if (peerConnection) {
            localVideo.srcObject.getVideoTracks().forEach((track) => {
                track.enabled = !track.enabled;
            });
        }
    }
    function getUser(guard = 'web', id = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '/getUser',
                type: 'GET',
                data: {
                    id: id,
                    guard: guard
                },
                success: function (response) {
                    resolve(response);
                },
                error: function (error) {
                    reject(error);
                }
            })
        });
    }

    function showHideCallPopup(name, image, text, btns = true) {
        $("#caller-popup-container").toggleClass('hidden');
        $("#caller-name").text(`${name} ${text}`);
        $("#caller-profileImage").attr('src', image);
        if (btns === false) {
            $(".call-buttons").hide();
        }
    }

    function showCall() {
        $("#chat_container").addClass('hidden');
        $("#video_call_container").removeClass('hidden');
        $("#video-call-footer").removeClass('hidden');
    }

    function send(type, data, receiverGuard, receiverID, user) {
        console.log(user);

        Echo.private(`chat.${receiverGuard}.${receiverID}`).whisper('Webrtc', {
            recipientGuard: receiverGuard,
            recipientId: receiverID,
            senderGuard: user.guard || null,
            senderID: user.id || null,
            senderName: user.name || null,
            profileImage: user.profileImagePath || null,
            type: type,
            data: data
        });
    }

    async function createOffer(receiverGuard, receiverID, user) {
        
        await peerConnection.createOffer({
            OfferToReceiveVideo: 1,
            OfferToReceiveAudio: 1
        });
        console.log(receiverGuard);
        console.log(receiverID);
        console.log('accepted');
        await peerConnection.setLocalDescription(peerConnection.localDescription);
        send('client-offer', peerConnection.localDescription, receiverGuard, receiverID, user);
        sendIceCandidate(receiverGuard, receiverID);
    }



    async function createAnswer(receiverGuard, receiverID, data) {
        if (!peerConnection) {
            await createConn();
        }

        if (!localStream) {
            await getCam();
        }

        await peerConnection.setRemoteDescription(data);
        await peerConnection.createAnswer();
        await peerConnection.setLocalDescription(peerConnection.localDescription);
        send('client-answer', peerConnection.localDescription, receiverGuard, receiverID, '');
        sendIceCandidate(receiverGuard, receiverID);
    }

    async function sendIceCandidate(receiverGuard, receiverID) {
        peerConnection.onicecandidate = event => {
            if (event.candidate !== null) {
                send('client-candidate', event.candidate, receiverGuard, receiverID, '');
            }
        }

        peerConnection.onicecandidatestatechange = (event) => {
            if (peerConnection.iceConnectionState === "disconnected" || peerConnection.iceConnectionState === "failed") {
                alert("Ther other user has disconnected or encountered an error. Call ended");
                setTimeout('window.location.reload(true)', 2000);
            }
        }
    }

    Echo.private(`chat.${authGuard}.${authID}`).listenForWhisper('Webrtc', async (e) => {
        console.log(e);

        let message = e;
        let type = message.type;
        let data = message.data;
        let receiverGuard = message.recipientGuard;
        let receiver = message.recipientId;

        let sender = {
            guard: message.senderGuard,
            id: message.senderID,
            name: message.senderName,
            profileImage: message.profileImage
        };


        switch (type) {
            case 'client-candidate':
                if (peerConnection.localDescription) {
                    await peerConnection.addIceCandidate(new RTCIceCandidate(data));
                }
                break;
            case 'is-client-ready':
                if (!peerConnection) {
                    await createConn();
                }

                if (peerConnection.iceConnectionState === "connected") {
                    getUser(receiverGuard, receiver).then(function (data) {
                        send('client-already-oncall', null, sender.guard, sender.id, data);
                    }).catch(function (error) {
                        localStream
                        console.error("Error getting user:", error);
                    });
                } else {
                    showHideCallPopup(sender.name, sender.profileImage, 'is calling');
                    acceptBtn.on('click', function () {

                        getUser(receiverGuard, receiver).then(function (data) {


                            showHideCallPopup(sender.name, sender.profileImage, '');
                            send('client-is-ready', null, sender.guard, sender.id, data);
                        }).catch(function (error) {
                            localStream
                            console.error("Error getting user:", error);
                        });
                    });

                    declineBtn.on('click', function () {
                        getUser(receiverGuard, receiver).then(function (data) {
                            send('client-rejected', null, sender.guard, sender.id, data);

                            location.reload(true);
                        }).catch(function (error) {
                            localStream
                            console.error("Error getting user:", error);
                        });
                    });
                }


                break;
            case 'client-is-ready':
                createOffer(sender.guard, sender.id, user);
                break;
            case 'client-offer':
                createAnswer(sender.guard, sender.id, data);
                showCall();
                $("#video-call-name").text(sender.name);
                break;
            case 'client-answer':
                if (peerConnection.localDescription) {
                    await peerConnection.setRemoteDescription(data);
                }
                getUser(receiverGuard, receiverID).then(function (user) {
                    $("#video-call-name").text(user.name);
                }).catch(function (error) {
                    localStream
                    console.error("Error getting user:", error);
                });
                break;
            case 'client-already-oncall':
                showHideCallPopup(sender.name, sender.profileImage, 'is on another call', false);
                setTimeout('window.location.reload(true)', 2000);
                break;
            case 'client-rejected':
                showHideCallPopup(sender.name, sender.profileImage, 'is busy', false);
                setTimeout('window.location.reload(true)', 2000);
                break;
            case 'client-hangup':
                showHideCallPopup(sender.name, sender.profileImage, ' disconnected the call', false);
                setTimeout('window.location.reload(true)', 2000);
                break;
        }
    });
});