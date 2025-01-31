@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pengaturan</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="background_image" class="form-label">Gambar Background</label>
            <input type="file" class="form-control" name="background_image">
            <img src="{{ asset('storage/' . $background_image) }}" class="mt-2" width="200">
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Logo</label>
            <input type="file" class="form-control" name="logo">
            <img src="{{ asset('storage/' . $logo) }}" class="mt-2" width="100">
        </div>

        <div class="mb-3">
            <label for="navigation" class="form-label">Menu Navigasi (JSON Format)</label>
            <textarea class="form-control" name="navigation" rows="5">{{ json_encode($navigation, JSON_PRETTY_PRINT) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>

        <button type="button" class="btn btn-danger" onclick="confirmReset()">Reset Pengaturan</button>
    </form>

    <form id="reset-form" action="{{ route('settings.reset') }}" method="POST" style="display: none;">
        @csrf
        @method('POST')
    </form>
</div>

<script>
    function confirmReset() {
        if (confirm("Apakah Anda yakin ingin mereset pengaturan ke default?")) {
            document.getElementById('reset-form').submit();
        }
    }
</script>
@endsection
