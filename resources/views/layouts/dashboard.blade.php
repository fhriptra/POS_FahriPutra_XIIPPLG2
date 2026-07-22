@extend('layouts.app')

@section('title', 'Login')

@section('content')

<h1>Ini Dashboard</h1>
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>

@endsection