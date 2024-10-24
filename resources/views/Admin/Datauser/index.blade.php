@include('layout.header')

@include('layout.sidebar')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Button to trigger Create User Modal -->
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createUserModal">Tambah User</button>

            <!-- Table displaying users -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar User</h3>
                        </div>
                        <div class="card-body">
                            <table id="usersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>NISN/NIP</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                        <th>Role</th>
                                        <th>Sekolah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->nisn ?? $user->nip }}</td>
                                        <td>{{ $user->nis ?? '-' }}</td>
                                        <td>{{ $user->kelas ? $user->kelas->nama_kelas : '-' }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->school->name }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editUserModal-{{ $user->id }}">Edit</button>
                                
                                            <!-- Delete Form -->
                                            <form action="{{ route('datauser.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                
                                    <!-- Edit User Modal (with role-specific forms) -->
                                    <div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editUserModalLabel-{{ $user->id }}">Edit User: {{ $user->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('datauser.update', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                
                                                        <!-- Common Fields for All Users -->
                                                        <div class="form-group">
                                                            <label for="name">Nama</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                        </div>
                                
                                                        <div class="form-group">
                                                            <label for="username">Username</label>
                                                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" readonly>
                                                        </div>
                                
                                                        <!-- Role-Specific Fields -->
                                                        @if ($user->role->name == 'Siswa')
                                                            <!-- Siswa Fields -->
                                                            <div class="form-group">
                                                                <label for="nisn">NISN</label>
                                                                <input type="text" name="nisn" class="form-control" value="{{ $user->nisn }}">
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label for="nis">NIS</label>
                                                                <input type="text" name="nis" class="form-control" value="{{ $user->nis }}">
                                                            </div>
                                
                                                            <div class="form-group">
                                                                <label for="kelas_id">Kelas</label>
                                                                <select name="kelas_id" class="form-control">
                                                                    <option value="">Pilih Kelas</option>
                                                                    @foreach ($kelas as $k)
                                                                        <option value="{{ $k->id }}" {{ $user->kelas_id == $k->id ? 'selected' : '' }}>
                                                                            {{ $k->nama_kelas }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @elseif ($user->role->name == 'Guru' || $user->role->name == 'Pegawai')
                                                            <!-- Guru/Pegawai Fields -->
                                                            <div class="form-group">
                                                                <label for="nip">NIP</label>
                                                                <input type="text" name="nip" class="form-control" value="{{ $user->nip }}">
                                                            </div>
                                                        @endif
                                
                                                        <!-- Role Selector (if allowed to change) -->
                                                        <div class="form-group">
                                                            <label for="role_id">Role</label>
                                                            <select name="role_id" class="form-control">
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Create User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('datauser.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    
                    <!-- User Type Selector -->
                    <div class="form-group">
                        <label for="user_type_create">Tipe User</label>
                        <select id="user_type_create" class="form-control" onchange="toggleCreateForm()">
                            <option value="siswa">Siswa</option>
                            <option value="guru">Guru/Pegawai</option>
                        </select>
                    </div>

                    <!-- Form for Siswa -->
                    <div id="form-siswa-create">
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" name="nisn" id="nisn" class="form-control" oninput="autoFillUsername()" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="nis">NIS</label>
                            <input type="text" name="nis" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="kelas_id">Kelas</label>
                            <select name="kelas_id" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select name="role_id" class="form-control">
                                @foreach ($roles as $role)
                                    @if ($role->name == 'Siswa')
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Form for Guru/Pegawai -->
                    <div id="form-guru-create" style="display:none;">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select name="role_id" class="form-control">
                                @foreach ($roles as $role)
                                    @if ($role->name == 'Guru' || $role->name == 'Pegawai')
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah User</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')

<script>
    function autoFillUsername() {
        var nisn = document.getElementById('nisn').value;
        document.getElementById('username').value = nisn; // Set Username to NISN value
    }

    function toggleCreateForm() {
        var userType = document.getElementById('user_type_create').value;
        if (userType === 'siswa') {
            document.getElementById('form-siswa-create').style.display = 'block';
            document.getElementById('form-guru-create').style.display = 'none';
        } else {
            document.getElementById('form-siswa-create').style.display = 'none';
            document.getElementById('form-guru-create').style.display = 'block';
        }
    }
</script>
