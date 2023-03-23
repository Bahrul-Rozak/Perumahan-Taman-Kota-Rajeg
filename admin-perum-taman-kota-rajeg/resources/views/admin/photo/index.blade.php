@extends('layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Foto</h1>
            </div>

            <div class="section-body">

                @can('photos.create')
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-image"></i> Upload Foto</h4>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('admin.photo.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>GAMBAR</label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror">

                                    @error('image')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>CAPTION</label>
                                    <input type="text" name="caption" value="{{ old('caption') }}"
                                        placeholder="Masukkan Judul Foto"
                                        class="form-control @error('caption') is-invalid @enderror">

                                    @error('caption')
                                        <div class="invalid-feedback" style="display: block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-upload"></i>
                                    UPLOAD</button>
                                <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i>
                                    RESET</button>


                            </form>

                        </div>
                    </div>
                @endcan

                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-image"></i> Foto</h4>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                        <th scope="col">FOTO</th>
                                        <th scope="col">CAPTION</th>
                                        <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($photos as $no => $photo)
                                        <tr>
                                            <th scope="row" style="text-align: center">
                                                {{ ++$no + ($photos->currentPage() - 1) * $photos->perPage() }}</th>
                                            <td><img src="{{ $photo->image }}" style="width: 150px"></td>
                                            <td>{{ $photo->caption }}</td>
                                            <td class="text-center">
                                                @can('photos.delete')
                                                    <button onClick="Delete(this.id)" class="btn btn-sm btn-danger"
                                                        id="{{ $photo->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="text-align: center">
                                {{ $photos->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>

    <script>
        //ajax delete
        function Delete(id) {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {


                    //ajax delete
                    jQuery.ajax({
                        url: "/admin/photo/" + id,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
    </script>
@stop
