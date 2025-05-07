@section('pageTitle', "Take A $task Test")
@section('pageActionData')
@endsection
<style>
    iframe {
        width: 100vw;
        height: 100vh;
        border: none;
        display: block;
    }
</style>
<x-auth-layout>
    <div class="row">

        <div class="col-md-12" id="cogniFitContent">
            
        </div>
    </div>
    @push('UserJS')
        <script src="https://js.cognifit.com/{{ $jsVersion }}/html5Loader.js"></script>
        <script>
            const displayDiv = document.getElementById("cogniFitContent");

            HTML5JS.loadMode("{{ $jsVersion }}", "{{ $type }}", "{{ $task }}", "cogniFitContent",
                {
                    "clientId": "{{ $clientId }}",
                    "accessToken": "{{ $userAccessToken }}",
                    "appType": "web"
                }
            );

            window.addEventListener('message', receiveMessage, false);

            function receiveMessage(event) {

                if (event.origin == "https://js.cognifit.com") {
                    

                    if (event.data.status == "aborted") {
                        $('#cogniFitContent').children().remove();
                        displayDiv.removeChild(displayDiv.lastChild);
                        axios.post("{{ route('patient.tests.get-pre-test-result', ['test' => $test->id]) }}", {
                            testId: "{{ $test->id }}",
                            data: event.data
                        }).then((response) => {
                            console.log("🚀 ~ :44 ~ axios.post ~ response:", response.data)
                            $('#cogniFitContent').html(response.data);
                        });
                        
                    } else if (event.data.status == "event" && event.data.action == "loadingComplete") {
                        const iframeParent = document.getElementById('cogniFitContent');
                        if (iframeParent) {
                            iframeParent.style.width = '100vw';
                            iframeParent.style.height = '100vh';

                            const iframe = iframeParent.querySelector('iframe');
                            if (iframe) {
                                iframe.style.width = '100%';
                                iframe.style.height = '100%';
                                iframe.style.border = 'none';
                            }
                        }
                    }
                }
            }
        </script>
    @endpush
</x-auth-layout>