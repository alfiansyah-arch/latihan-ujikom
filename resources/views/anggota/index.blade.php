@extends('layout')
  
@section('content')

    <div class="container">
        <div id="message">
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-sm-9">Tabel Anggota</div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Launch demo modal
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <a href="{{ route('anggota.create') }}" class="btn btn-sm btn-primary">
                        <b>Tambah Anggota</b>
                    </a>
                    <table class="table table-striped table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Gender</th>
                                <th>Tempat / Tgl Lahir</th>
                                <th>Alamat</th>
                                <th>No. Hp</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Jml Pinjam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0; ?>
                            @foreach($anggota as $row)
                            <?php $no++ ?>
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{$row->kd_anggota}}</td>
                                <td>{{$row->nm_anggota}}</td>
                                <td>{{$row->jk}}</td>
                                <td>{{$row->tp_lahir." / ".$row->tg_lahir}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->no_hp}}</td>
                                <td>{{$row->jns_anggota}}</td>
                                <?php
                                    if($row->status=="returned"){
                                        echo "<td style='background-color:green;color:white;'><b>Returned</b></td>";
                                    }else{
                                        echo "<td style='background-color:red;color:white;'><b>Borrowed</b></td>";
                                    }
                                    ?>
                                <td>{{$row->jm_pinjam}}</td>
                                <td> 
                                    <button type="button" id="edit_data" class="btn btn-warning btn-sm" style="color:white;" onclick="showOne(+json[i].id+)"><b>Edit</b></button>
                                    <!-- <a style="color: white;" href="{{ route('users.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                        <b>Edit</b>
                                    </a> -->
                                    <form action="{{ route('users.destroy',$row->id) }}" method="POST"
                                    style="display: inline;" onsubmit="return confirm('Do you really want to delete {{ $row->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button style="display : inline;" type="submit" class="btn btn-sm btn-danger"><span class="text-muted">
                                        <b style="color:white;">Delete</b>
                                    </span></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form Edit -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Data Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('anggota.update' , $anggota->id) }}"  method="POST">
                        @csrf
                        @method('PUT')
                          <div class="form-group row mt-3">
                              <label for="kd_anggota" class="col-md-4 col-form-label text-right">Kode Anggota</label>
                              <div class="col-md-6">
                                  <input type="text" id="kd_anggota" class="form-control" name="kd_anggota" value="{{ $anggota->kd_anggota }}" required autofocus>
                                  @if ($errors->has('kd_anggota'))
                                      <span class="text-danger">{{ $errors->first('kd_anggota') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="nm_anggota" class="col-md-4 col-form-label text-right">Nama Anggota</label>
                              <div class="col-md-6">
                                  <input type="text" id="nm_anggota" class="form-control" name="nm_anggota" placeholder="Masukkan Nama Pengguna" value="{{ $anggota->nm_anggota }}" required autofocus>
                                  @if ($errors->has('nm_anggota'))
                                      <span class="text-danger">{{ $errors->first('nm_anggota') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                            <label for="jk" class="col-md-4 col-form-label text-right">Gender</label>
                            <div class="col-md-6">
                                <select class="form-select" id="jk" name="jk" aria-label="jk">
                                <?php
                                    if($anggota->jk == "pria"){
                                        echo "
                                        <option value='pria' selected='true'>Pria Sejati</option>
                                        <option value='wanita'>Wanita Sejati</option>
                                        ";
                                    }elseif($anggota->jk == "wanita"){
                                        echo "
                                        <option value='pria'>Pria Sejati</option>
                                        <option value='wanita' selected='true'>Wanita Sejati</option>
                                        ";
                                    }else{
                                        echo "
                                        <option value=''>Choose</option>
                                        <option value='pria'>Pria Sejati</option>
                                        <option value='wanita'>Wanita Sejati</option>
                                        ";
                                    }
                                    ?>
                                </select>
                                @if ($errors->has('jk'))
                                    <span class="text-danger">{{ $errors->first('jk') }}</span>
                                @endif
                            </div>
                          </div>
  
                          <div class="form-group row mt-3">
                              <label for="tp_lahir" class="col-md-4 col-form-label text-right">Tempat Lahir</label>
                              <div class="col-md-6">
                                  <input type="text" id="tp_lahir" class="form-control" name="tp_lahir" placeholder="Masukkan Tempat Lahir Anda" value="{{ $anggota->tp_lahir }}" required autofocus>
                                  @if ($errors->has('tp_lahir'))
                                      <span class="text-danger">{{ $errors->first('tp_lahir') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="tg_lahir" class="col-md-4 col-form-label text-right">Tanggal Lahir</label>
                              <div class="col-md-6">
                                  <input type="date" id="tg_lahir" class="form-control" name="tg_lahir" value="{{ $anggota->tg_lahir }}" required autofocus>
                                  @if ($errors->has('tg_lahir'))
                                      <span class="text-danger">{{ $errors->first('tg_lahir') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="alamat" class="col-md-4 col-form-label text-right">Alamat</label>
                              <div class="col-md-6">
                                  <textarea class="form-control"  name="alamat" id="alamat" cols="10" rows="5" placeholder="Masukkan Alamat Lengkap Anggota" value="{{ $anggota->alamat }}"></textarea>
                                  @if ($errors->has('alamat'))
                                      <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="no_hp" class="col-md-4 col-form-label text-right">Nomor Handphone</label>
                              <div class="col-md-6">
                                  <input type="text" id="no_hp" class="form-control" name="no_hp" maxlength="13" placeholder="Masukkan Nomor Telepon Anggota" value="{{ $anggota->no_hp }}" required autofocus>
                                  @if ($errors->has('no_hp'))
                                      <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                            <label for="jns_anggota" class="col-md-4 col-form-label text-right">Jenis Anggota</label>
                            <div class="col-md-6">
                                <select class="form-select" id="jns_anggota" name="jns_anggota" aria-label="jns_anggota">
                                    <?php
                                    if($anggota->jns_anggota == "member"){
                                        echo "
                                        <option value='member' selected='true'>Member</option>
                                        <option value='non_member'>Non Member</option>
                                        ";
                                    }elseif($anggota->jns_anggota == "non_member"){
                                        echo "
                                        <option value='member'>Member</option>
                                        <option value='non_member' selected='true'>Non Member</option>
                                        ";
                                    }else{
                                        echo "
                                        <option value=''>Choose</option>
                                        <option value='member'>Member</option>
                                        <option value='non_member'>Non Member</option>
                                        ";
                                    }
                                    ?>
                                </select>
                                @if ($errors->has('jns_anggota'))
                                    <span class="text-danger">{{ $errors->first('jns_anggota') }}</span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row mt-3">
                            <label for="status" class="col-md-4 col-form-label text-right">Status</label>
                            <div class="col-md-6">
                                <select class="form-select" id="status" name="status" aria-label="status">
                                <?php
                                    if($anggota->status == "returned"){
                                        echo "
                                        <option value='returned' selected='true'>Dikembalikan</option>
                                        <option value='borrowed'>Dipinjam</option>
                                        ";
                                    }elseif($anggota->status == "borrowed"){
                                        echo "
                                        <option value='returned'>Dikembalikan</option>
                                        <option value='borrowed' selected='true'>Dipinjam</option>
                                        ";
                                    }else{
                                        echo "
                                        <option value=''>Choose</option>
                                        <option value='returned'>Dikembalikan</option>
                                        <option value='borrowed'>Dipinjam</option>
                                        ";
                                    }
                                    ?>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="jm_pinjam" class="col-md-4 col-form-label text-right">Jumlah Pinjam</label>
                              <div class="col-md-6">
                                  <input type="text" id="jm_pinjam" class="form-control" name="jm_pinjam" maxlength="10" placeholder="Masukkan jumlah Pinjam Anggota" value="{{ $anggota->jm_pinjam }}" required autofocus>
                                  @if ($errors->has('jm_pinjam'))
                                      <span class="text-danger">{{ $errors->first('jm_pinjam') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="col-md-6 offset-md-4 mt-3 p-2 d-grid">
                              <button type="submit" class="btn btn-primary">
                                  Save
                              </button>
                          </div>
                      </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
        </div>
        <!-- Akhir Form Edit -->
        <div class="modal" tabindex="-1" id="action_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dynamic_modal_title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Anggota</label>
                                <input type="text" name="nm_anggota" id="nm_anggota" class="form-control" placeholder="Masukkan Nama Anggota" />
                                <span id="nm_anggota_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="jk" name="jk" aria-label="jk">
                                    <option hidden disabled="disabled">Choose</option>
                                    <option value="pria">Pria</option>s
                                    <option value="wanita">Wanita</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tp_lahir" id="tp_lahir" class="form-control" placeholder="Masukkan Tempat Lahir Anda" />
                                    <span id="pass_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tp_lahir" id="tp_lahir" class="form-control" />
                                    <span id="pass_error" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                    <input type="text" name="tp_lahir" id="tp_lahir" class="form-control" placeholder="Masukkan Tempat Lahir Anda" />
                                    <span id="pass_error" class="text-danger"></span>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="action" id="action" value="Add" />
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="action_button">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
        })
    </script>
    <script>
    $(document).ready(function() {
        showAll();

        $('#edit_data').click(function(){
            $('#dynamic_modal_title').text('Edit Data Anggota');
            $('#sample_form')[0].reset();
            $('#action').val('Edit');
            $('#action_button').text('Edit');
            $('.text-danger').text('');
            $('#action_modal').modal('show');
        });
        
        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == "Add"){
                var formData = {
                '_token': '{{ csrf_token() }}',
                'nama_ruangan' : $('#nama_ruangan').val(),
                'keterangan' : $('#keterangan').val(),
                'kapasitas' : $('#kapasitas').val()
                }

                $.ajax({
                    headers: {
                        "Content-Type":"application/json",
                        "Authorization": "Bearer {{ session('accessToken') }}"
                    },
                    url:"{{ url('api/ruangans/create')}}",
                    method:"POST",
                    data: JSON.stringify(formData),
                    success:function(data){
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">'+data.message+'</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }else if($('#action').val() == "Update"){
                var formData = {
                    '_token': '{{ csrf_token() }}',
                    'nm_anggota' : $('#nm_anggota').val(),
                    'gender' : $('#gender').val(),
                    'tp_lahir' : $('#tp_lahir').val(),
                    'tg_lahir' : $('#tg_lahir').val(),
                    'alamat' : $('#alamat').val(),
                    'no_hp' : $('#no_hp').val(),
                    'jns_anggota' : $('#jns_anggota').val(),
                    'status' : $('#status').val(),
                    'jm_pinjam' : $('#jm_pinjam').val()
                }

                $.ajax({ 
                    headers: {
                        "Content-Type":"application/json",
                        "Authorization": "Bearer {{ session('accessToken') }}"
                    },
                    url:"{{ url('api/anggota/')}}/"+$('#id').val()+"/update",
                    method:"POST",
                    data: JSON.stringify(formData),
                    success:function(data){
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">'+data.message+'</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
            });
    });

    function showAll() {
        $.ajax({
            type: "GET",
            headers: {
                "Content-Type":"application/json",
                "Authorization": "Bearer {{ session('accessToken') }}"
            },
            url:"{{ url('api/ruangans/all')}}",
            success: function(response) {
            // console.log(response);
                var json = response;
                var dataSet=[];
                for (var i = 0; i < json.length; i++) {
                    var sub_array = {
                        'nama_ruangan' : json[i].nama_ruangan,
                        'keterangan' : json[i].keterangan,
                        'kapasitas' : json[i].kapasitas,
                        'action' : '<button onclick="showOne('+json[i].id+')" class="btn btn-sm btn-warning">Edit</button>'+
                        '<button onclick="deleteOne('+json[i].id+')" class="btn btn-sm btn-danger">Delete</button>'
                    };
                    dataSet.push(sub_array);
                }
                $('#sample_data').DataTable({
                    data: dataSet,
                    columns : [
                        { data : "nama_ruangan" },
                        { data : "keterangan" },
                        { data : "kapasitas" },
                        { data : "action" }
                    ]
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function showOne(id) {
        $('#dynamic_modal_title').text('Edit Data');
        $('#sample_form')[0].reset();
        $('#action').val('Update');
        $('#action_button').text('Update');
        $('.text-danger').text('');
        $('#action_modal').modal('show');

        $.ajax({
            type: "GET",
            headers: {
                "Content-Type":"application/json",
                "Authorization": "Bearer {{ session('accessToken') }}"
            },
            url:"{{ url('api/ruangans')}}/"+id+"/show",
            success: function(response) {
                $('#id').val(response.id);
                $('#nama_ruangan').val(response.nama_ruangan);
                $('#keterangan').val(response.keterangan);
                $('#kapasitas').val(response.kapasitas);
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function deleteOne(id) {
        alert('Yakin untuk hapus data ?');
        $.ajax({
            headers: {
                "Content-Type":"application/json",
                "Authorization": "Bearer {{ session('accessToken') }}"
            },
            url:"{{ url('api/ruangans')}}/"+id+"/delete",
            method:"DELETE",            
            data: JSON.stringify({
                    '_token': '{{ csrf_token() }}'
                }),
            success:function(data){
                $('#action_button').attr('disabled', false);
                $('#message').html('<div class="alert alert-success">'+data+'</div>');
                $('#action_modal').modal('hide');
                $('#sample_data').DataTable().destroy();
                showAll();
            },
            error: function(err) {
                console.log(err);
            }
        });
    }
    </script>
@endsection