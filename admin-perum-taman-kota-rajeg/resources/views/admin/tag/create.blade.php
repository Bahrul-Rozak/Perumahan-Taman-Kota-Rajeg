@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Tag</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-tags"></i> Tambah Tag</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.tag.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>NAMA TAG</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Masukkan Nama Tag"
                                    class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                                SIMPAN</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i>
                                RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
