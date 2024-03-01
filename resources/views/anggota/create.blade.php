@extends('layout')
  
@section('content')
<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-10">
              <div class="card">
                  <div class="card-header">Tambah Anggota</div>
                  <div class="card-body">
                                  <?php
                                    $no_kd=1;

                                    $koneksi = mysqli_connect('localhost','root','','db_perpustakaan');

                                    $query = mysqli_query($koneksi, "SELECT max(kd_anggota) as kodeTerbaru FROM anggotas");

                                    $result = mysqli_fetch_array($query);
                                    $kodeAnggota = $result['kodeTerbaru'];
                                    $urutan = (int) substr($kodeAnggota, 4, 4);
                                    $urutan++;
                                    $huruf = "ang-";
                                    $kodeAnggota = $huruf . sprintf("%04s", $urutan);
                                  ?>
                      <form action="{{ route('anggota.store') }}" method="POST">
                          @csrf
                          <div class="form-group row mt-3">
                              <label for="kd_anggota" class="col-md-4 col-form-label text-right">Kode Anggota</label>
                              <div class="col-md-6">
                                  <input type="text" id="kd_anggota" class="form-control" name="kd_anggota" value="<?php echo $kodeAnggota; ?>" required autofocus>
                                  @if ($errors->has('kd_anggota'))
                                      <span class="text-danger">{{ $errors->first('kd_anggota') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="nm_anggota" class="col-md-4 col-form-label text-right">Nama Anggota</label>
                              <div class="col-md-6">
                                  <input type="text" id="nm_anggota" class="form-control" name="nm_anggota" placeholder="Masukkan Nama Pengguna" required autofocus>
                                  @if ($errors->has('nm_anggota'))
                                      <span class="text-danger">{{ $errors->first('nm_anggota') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                            <label for="jk" class="col-md-4 col-form-label text-right">Gender</label>
                            <div class="col-md-6">
                                <select class="form-select" id="jk" name="jk" aria-label="jk">
                                    <option value="">Choose</option>
                                    <option value="pria">Pria Sejati</option>
                                    <option value="wanita">Wanita Sejati</option>
                                </select>
                                @if ($errors->has('jk'))
                                    <span class="text-danger">{{ $errors->first('jk') }}</span>
                                @endif
                            </div>
                          </div>
  
                          <div class="form-group row mt-3">
                              <label for="tp_lahir" class="col-md-4 col-form-label text-right">Tempat Lahir</label>
                              <div class="col-md-6">
                                  <input type="text" id="tp_lahir" class="form-control" name="tp_lahir" placeholder="Masukkan Tempat Lahir Anda" required autofocus>
                                  @if ($errors->has('tp_lahir'))
                                      <span class="text-danger">{{ $errors->first('tp_lahir') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="tg_lahir" class="col-md-4 col-form-label text-right">Tanggal Lahir</label>
                              <div class="col-md-6">
                                  <input type="date" id="tg_lahir" class="form-control" name="tg_lahir" required autofocus>
                                  @if ($errors->has('tg_lahir'))
                                      <span class="text-danger">{{ $errors->first('tg_lahir') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="alamat" class="col-md-4 col-form-label text-right">Alamat</label>
                              <div class="col-md-6">
                                  <textarea class="form-control"  name="alamat" id="alamat" cols="10" rows="5" placeholder="Masukkan Alamat Lengkap Anggota"></textarea>
                                  @if ($errors->has('alamat'))
                                      <span class="text-danger">{{ $errors->first('alamat') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="no_hp" class="col-md-4 col-form-label text-right">Nomor Handphone</label>
                              <div class="col-md-6">
                                  <input type="text" id="no_hp" class="form-control" name="no_hp" maxlength="13" placeholder="Masukkan Nomor Telepon Anggota" required autofocus>
                                  @if ($errors->has('no_hp'))
                                      <span class="text-danger">{{ $errors->first('no_hp') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row mt-3">
                            <label for="jns_anggota" class="col-md-4 col-form-label text-right">Jenis Anggota</label>
                            <div class="col-md-6">
                                <select class="form-select" id="jns_anggota" name="jns_anggota" aria-label="jns_anggota">
                                    <option value="" >Choose</option>
                                    <option value="member">Member</option>
                                    <option value="non_member">Non Member</option>
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
                                    <option value="" >Choose</option>
                                    <option value="returned">Dikembalikan</option>
                                    <option value="borrowed">Dipinjam</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                          </div>

                          <div class="form-group row mt-3">
                              <label for="jm_pinjam" class="col-md-4 col-form-label text-right">Jumlah Pinjam</label>
                              <div class="col-md-6">
                                  <input type="text" id="jm_pinjam" class="form-control" name="jm_pinjam" maxlength="10" placeholder="Masukkan jumlah Pinjam Anggota" required autofocus>
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
              </div>
          </div>
      </div>
  </div>
</main>
@endsection