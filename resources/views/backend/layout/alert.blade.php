@if (Session('message'))
    <div class="flash-data" data-flashdata="{{ Session('message')}}"></div>
@endif