@if(Session::has( 'success' ))
<div class="alert alert-success">

    {{session('success')}}
</div>

@elseif(Session::has( 'failed' ))
<div class="alert alert-danger">
    {{session('failed')}}
</div>
@endif