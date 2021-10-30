@foreach($js as $j)
<script src="{{ admin_asset ("$j") }}"></script>
@endforeach

@stack('custom_js')