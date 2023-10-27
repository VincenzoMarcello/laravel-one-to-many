{{-- # CREO UN TEMPLATE DEL DETTAGLIO ESTENDENDO IL layouts.app --}}
@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    {{-- # PULSANTE CHE CI RIPORTA ALLA LISTA QUINDI ALL'index --}}
    <a href="{{ route('admin.projects.index') }}" class="btn btn-success">Torna alla lista</a>
    <hr>
    <div class="row g-5 mt-3">
      <div class="col-6">
        <p>
          <strong>Project Name:</strong><br>
          {{ $project->name }}
        </p>
      </div>

      <div class="col-6">
        <p>
          <strong>Link:</strong><br>
          <a href="">{{ $project->link }}</a>
        </p>
      </div>

      <div class="col-12">
        <p>
          <strong>Description</strong><br>
          {{ $project->description }}
        </p>
      </div>
    </div>
  </div>
@endsection
