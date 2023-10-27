@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    {{-- # PULSANTE CHE CI RIPORTA ALLA LISTA QUINDI ALL'index --}}
    <a href="{{ route('admin.projects.index') }}" class="btn btn-success">Torna alla lista</a>
    <hr>
    <h2>Crea progetto</h2>
    <form action="{{ route('admin.projects.store') }}" method="POST">
      @csrf
      <div class="row g-3">
        <div class="col-12">
          <label for="name" class="form-label">Name</label>
          {{-- ! QUI METTIAMO NELL'INPUT IL VECCHIO VALORE E IL GLI ERROR PER LA VALIDAZIONE --}}
          <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"
            value="{{ old('name') }}">
          {{-- ! QUI ABBIAMO IL MESSAGGIO DI ERRORE --}}
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>



        <div class="col-12">
          <label for="link" class="form-label">Link</label>
          {{-- ! FACCIAMO LO STESSO DI SOPRA --}}
          <input class="form-control @error('link') is-invalid @enderror" type="url" id="link" name="link"
            value="{{ old('link') }}">

          @error('link')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>



        <div class="col-12">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">
            {{ old('description') }}
          </textarea>

          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      {{-- ! RICORDA CHE IL BUTTON DELL'INVIO DEL FORM NON DEVE ESSERE MAI TYPE BUTTON --}}
      <button class="btn btn-success mt-3">Salva progetto</button>
    </form>
  @endsection
