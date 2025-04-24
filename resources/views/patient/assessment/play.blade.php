@section('pageTitle', "Take A Test")
@section('pageActionData')
@endsection
<x-auth-layout>
    <div class="row">

        <div class="col-md-12" id="cogniFitContent">
            {{--
            <counter /> --}}
        </div>
    </div>
    @push('UserJS')
        <script>
            const displayDiv = document.getElementById("cogniFitContent");

            HTML5JS.loadMode("2025-04-10_1419_snaga", "{{ $type }}", "{{ $task }}", "cogniFitContent",
                {
                    "clientId": "{{ $clientId }}",
                    "accessToken": "{{ $userAccessToken }}",
                    "appType": "web"
                }
            );

            window.addEventListener('message', receiveMessage, false);

            function receiveMessage(event) {
                
                if (event.origin == "https://js.cognifit.com") {
                    console.log("🚀 ~ :27 ~ receiveMessage ~ event:", event)
                    if (event.data.status == "aborted") {
                        displayDiv.removeChild(displayDiv.lastChild);
                    }
                }
            }
        </script>
    @endpush
</x-auth-layout>