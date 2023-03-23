@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Edit Video</h1>
            </div>

            <div class="section-body">

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-video"></i> Edit Video</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.video.update', $video->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>JUDUL VIDEO</label>
                                <input type="text" name="title" value="{{ old('title', $video->title) }}"
                                    placeholder="Masukkan Judul Video"
                                    class="form-control @error('title') is-invalid @enderror">

                                @error('title')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>EMBED YOUTUBE</label>
                                <input type="text" name="embed" value="{{ old('embed', $video->embed) }}"
                                    placeholder="Masukkan Embed YouTube"
                                    class="form-control @error('embed') is-invalid @enderror">

                                @error('embed')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                                UPDATE</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i>
                                RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
