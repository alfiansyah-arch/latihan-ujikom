@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-10">
              <div class="card">
                  <div class="card-header">Edit User</div>
                  <div class="card-body">
  
                      <form action="{{ route('users.update' , $user->id) }}"  method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mt-3">
                              <label for="nm_pengguna" class="col-md-4 col-form-label text-right">Nama Pengguna</label>
                              <div class="col-md-6">
                              <input type="hidden" id="id" name="id" value="{{ $user->id }}">
                                  <input type="text" id="nm_pengguna" class="form-control" name="nm_pengguna" placeholder="Masukkan Nama Pengguna" value="{{ $user->nm_pengguna }}" required autofocus>
                                  @if ($errors->has('nm_pengguna'))
                                      <span class="text-danger">{{ $errors->first('nm_pengguna') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row mt-3">
                              <label for="email" class="col-md-4 col-form-label text-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email" class="form-control" name="email" placeholder="example@gmail.com" value="{{ $user->email }}" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row mt-3">
                              <label for="password" class="col-md-4 col-form-label text-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" value="{{ $user->password }}" >
                                  <p>Jika tidak ingin diubah passwordnya biarkan saja</p>
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                            <label for="hak_akses" class="col-md-4 col-form-label text-right">Hak Akses</label>
                            <div class="col-md-6">
                                <select class="form-select" id="hak_akses" name="hak_akses" aria-label="hak_akses">
                                    <?php
                                    if($user->hak_akses == "admin"){
                                        echo "
                                        <option value='admin' selected='true'>Administrator</option>
                                        <option value='anggota'>Anggota</option>
                                        ";
                                    }elseif($user->hak_akses == "anggota"){
                                        echo "
                                        <option value='admin'>Administrator</option>
                                        <option value='anggota' selected='true'>Anggota</option>
                                        ";
                                    }else{
                                        echo "
                                        <option value=''>Choose</option>
                                        <option value='admin'>Administrator</option>
                                        <option value='anggota'>Anggota</option>
                                        ";
                                    }
                                    ?>
                                </select>
                                @if ($errors->has('hak_akses'))
                                    <span class="text-danger">{{ $errors->first('hak_akses') }}</span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row mt-3">
                            <label for="status" class="col-md-4 col-form-label text-right">Hak Akses</label>
                            <div class="col-md-6">
                                <select class="form-select" id="status" name="status" aria-label="status">
                                    <?php
                                    if($user->status == "active"){
                                        echo "
                                        <option value='active' selected='true'>Aktif</option>
                                        <option value='inactive'>Tidak AKtif</option>
                                        ";
                                    }elseif($user->status == "inactive"){
                                        echo "
                                        <option value='active'>Aktif</option>
                                        <option value='inactive' selected='true'>Tidak Aktif</option>
                                        ";
                                    }else{
                                        echo "Error";
                                    }
                                    ?>
                                </select>
                                @if ($errors->has('hak_akses'))
                                    <span class="text-danger">{{ $errors->first('hak_akses') }}</span>
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
              </div>
          </div>
      </div>
  </div>
</main>
@endsection