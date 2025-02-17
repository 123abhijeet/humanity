@extends('backend.layouts.master')
@section('title','Join Meeting | Sattree Gurukul')
@section('body')
<link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.17.0/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.17.0/css/react-select.css" />
<style>
    #zmmtg-root {
        height: 100%;
        width: 100%;
    }
</style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Join Meeting</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('Admin-Dashboard') }}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Join Meeting</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="zmmtg-root"></div>
        <div id="aria-notify-area"></div>
        <div id="meetingSDKElement">
            <!-- Zoom Meeting SDK renders here -->
        </div>
    </div>
</div>
<script src="https://source.zoom.us/2.17.0/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/2.17.0/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/2.17.0/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/2.17.0/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/2.17.0/lib/vendor/lodash.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-2.17.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        ZoomMtg.setZoomJSLib('https://source.zoom.us/2.17.0/lib', '/av');
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareWebSDK();

        const meetingConfig = {
            sdkKey: '{{ $sdkKey }}',
            meetingNumber: '{{ $meetingId }}',
            passWord: '{{ $password }}',
            userName: '{{ $userName }}',
            userEmail: '{{ $userEmail }}',
            leaveUrl: '{{ $leaveUrl }}',
            role: 1
        };

        async function getSignature(meetingNumber, role) {
            const response = await fetch('/api/generate-signature', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ meetingNumber, role })
            });
            const data = await response.json();
            return data.signature;
        }

        ZoomMtg.init({
            leaveUrl: meetingConfig.leaveUrl,
            isSupportAV: true,
            success: function() {
                getSignature(meetingConfig.meetingNumber, meetingConfig.role).then(signature => {
                    ZoomMtg.join({
                        meetingNumber: meetingConfig.meetingNumber,
                        userName: meetingConfig.userName,
                        signature: signature,
                        sdkKey: meetingConfig.sdkKey,
                        userEmail: meetingConfig.userEmail,
                        passWord: meetingConfig.passWord,
                        success: function(res) {
                            console.log('join meeting success');
                            console.log('get attendeelist', res.result);
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    });
                }).catch(error => {
                    console.error(error);
                });
            },
            error: function(res) {
                console.log(res);
            }
        });
    });
</script>
@endsection
