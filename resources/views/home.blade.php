@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <div class="mt-4">
                        <!-- Botón para modificar datos personales -->
                        <a href="{{ route('user.edit', ['id' => Auth::user()->id]) }}" class="btn btn-primary">
                            {{ __('Edit My Profile') }}
                        </a>

                        <!-- Botón para ver todas las mascotas -->
                        <a href="{{ route('mascota.index') }}" class="btn btn-secondary mt-2">
                            {{ __('View All Mascotas') }}
                        </a>

                        <!-- Botón para agregar una nueva mascota -->
                        <a href="{{ route('mascota.create') }}" class="btn btn-success mt-2">
                            {{ __('Add New Mascota') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
