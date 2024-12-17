@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card">
        <div class="card-body text-nowrap d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0 flex-wrap text-nowrap">Selamat datang {{ Auth::user()->nama_lengkap }}!!</h5>
          <a href="{{ route('profil') }}" class="btn btn-sm btn-primary">Lihat profil</a>
        </div>
      </div>
    </div>

    <!-- Data Tables -->
    <div class="col-12">
      <div class="card overflow-hidden">
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-truncate">User</th>
                <th class="text-truncate">Email</th>
                <th class="text-truncate">Role</th>
                <th class="text-truncate">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-4">
                      <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div>
                      <h6 class="mb-0 text-truncate">Bradan Rosebotham</h6>
                      <small class="text-truncate">@brosebothamz</small>
                    </div>
                  </div>
                </td>
                <td class="text-truncate">tillman.Gleason68@hotmail.com</td>
                <td class="text-truncate">
                  <div class="d-flex align-items-center">
                    <i class="ri-edit-box-line text-warning ri-22px me-2"></i>
                    <span>Editor</span>
                  </div>
                </td>
                <td><span class="badge bg-label-warning rounded-pill">Pending</span></td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-4">
                      <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div>
                      <h6 class="mb-0 text-truncate">Bree Kilday</h6>
                      <small class="text-truncate">@bkildayr</small>
                    </div>
                  </div>
                </td>
                <td class="text-truncate">otho21@gmail.com</td>
                <td class="text-truncate">
                  <div class="d-flex align-items-center">
                    <i class="ri-user-3-line ri-22px text-success me-2"></i>
                    <span>Subscriber</span>
                  </div>
                </td>
                <td><span class="badge bg-label-success rounded-pill">Active</span></td>
              </tr>
              <tr class="border-transparent">
                <td>
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-4">
                      <img src="../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                    </div>
                    <div>
                      <h6 class="mb-0 text-truncate">Breena Gallemore</h6>
                      <small class="text-truncate">@bgallemore6</small>
                    </div>
                  </div>
                </td>
                <td class="text-truncate">florencio.Little@hotmail.com</td>
                <td class="text-truncate">
                  <div class="d-flex align-items-center">
                    <i class="ri-user-3-line ri-22px text-success me-2"></i>
                    <span>Subscriber</span>
                  </div>
                </td>
                <td><span class="badge bg-label-secondary rounded-pill">Inactive</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--/ Data Tables -->
  </div>
</div>
@endsection