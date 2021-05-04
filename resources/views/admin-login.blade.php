@extends('layout')
@section('contents')
    <div class="card w-50">
        <div class="card-header text-center bg-info text-light">Admin</div>
        <div class="card-body">
            <form action="{{ route('is_admin') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control h-fix" name="email"
                           placeholder="Enter Email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control h-fix"
                           placeholder="Enter password" name="password" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="w-50 btn btn-success">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js_after')
    <script>
        @if(session('error'))
            swal({ title: "Admin",
                text: `{{ session('error') }}`,
                icon: "error",
            });
        @endif
        @if(session('success'))
            swal({ title: "Admin",
                text: `{{ session('success') }}`,
                icon: "success",
            });
        @endif
    </script>
@endsection