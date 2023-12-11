@extends('verificator.layouts.app')
@section('title', 'Instant Message(IM)')
@push('styles')

<link href="/css/instant_message.css" rel="stylesheet">
<link href="/verificator/css/helper.css" rel="stylesheet">
<style>
    .message-container {
display: flex;
flex-direction: column;
}

.message {
margin: 5px;
display: flex;
justify-content: flex-start;
align-items:flex-end;
}

.message.right {
justify-content: flex-end;
}


.message-content {
padding: 10px;
padding-bottom: 0;
border-radius: 5px;
max-width: 70%;
word-wrap: break-word;
}

.message-content.blue {
background-color: #3498db;
color: white;
flex-direction: column;

}

.message-content.gray {
background-color: #ccc;
color: black;
flex-direction: column;

}
.user-image {
width: 40px;
height: 40px;
border-radius: 50%;
margin-right: 10px;
}

.message-content.gray .message-timestamp {
font-size: 12px;
color: #888;
display: flex;
justify-content: flex-start;
}
.message-content.blue .message-timestamp {
font-size: 12px;
color: #ddd;
display: flex;
justify-content: flex-end;
}

.nmf{
width: 100%;
height: 100%;
display: flex;
align-items: center;
justify-content: center;
font-size: 1.2em;
}
/* #messages_wrapper{
max-height: 82vh;
overflow-y: auto;
} */
.image-grid {
display: grid;
grid-template-columns: repeat(3, 1fr); /* You can adjust the number of columns as needed */
gap: 5px;
margin-top: 10px;
}

.message-image {
width: 80px;
height: auto;
}
.container-fluid #content #messages_section .row:nth-child(2){
max-height: 82vh;
justify-content: flex-end;
opacity: 0;

}
.glink{
color:red;
}
body{
    overflow: hidden;
}
</style>
@endpush
@push('scripts')
<script defer src="/js/instant_message.js"></script>
<script defer src="/verificator/js/pagination.js"></script>
@endpush
@section('content')
<div class="col-xxl-10 col-xl-10 col-lg-9 col-md-9 col-sm-8 p-0 m-0" id="content">
    @include('verificator.partials.header')
   
    @include('partials.messages')
</div>
@endsection

{{-- @push('scripts')
    <script defer>
        $(document).ready(function() {
            $(document).on('click','a[href="#location-tab"],a[href="#verification-tab"],a[href="#authentication-tab"]', function (e) {
            var e = $(this); // Get the ID of the clicked tab
            $(e.attr('href')).find('.table').css({'width':'100%'});
        });
          
        });
    </script>
@endpush --}}