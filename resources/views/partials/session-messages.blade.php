{{-- Affichage des messages de succès --}}
@if(session('success'))
    <div class="alert alert-success"> {{ session('success') }} </div>
@endif

{{-- Affichage des messages d'erreur --}}
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
