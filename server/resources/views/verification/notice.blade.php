@extends('layouts.auth')

@section('content')
<div class="col-12 align-self-center">
@if($error)
<div class="alert alert-success text-center" role="alert">
    {{ $error}}
</div>
@else
<div class="alert alert-success text-center" role="alert">
    Before proceeding, please check your email for a verification link. If you did not receive the email,
</div>
@endif
</div>
@endsection