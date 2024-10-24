@include('layout.header')

@include('layout.sidebar')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createCandidateModal">
                Tambah Kandidat
            </button>

            <!-- Tabel Kandidat Sekolah 1 -->
            <h3>Kandidat Sekolah 1</h3>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Kandidat Sekolah 1</h3>
                        </div>
                        <div class="card-body">
                            <table id="candidatesTableSchool1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kandidat</th>
                                        <th>Ketua</th>
                                        <th>Wakil</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidatesSchool1 as $candidate)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->ketua ? $candidate->ketua->name : '-' }}</td>
                                        <td>{{ $candidate->wakil ? $candidate->wakil->name : '-' }}</td>
                                        <td>{{ $candidate->visi }}</td>
                                        <td>{{ $candidate->misi }}</td>
                                        <td>
                                            @if($candidate->image)
                                                <img src="{{ asset('storage/'.$candidate->image) }}" alt="Candidate Image" width="50">
                                            @else
                                                <span>Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCandidateModal-{{ $candidate->id }}">Edit</button>
                                            <form action="{{ route('candidate.destroy', $candidate->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this candidate?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Kandidat -->
                                    <div class="modal fade" id="editCandidateModal-{{ $candidate->id }}" tabindex="-1" role="dialog" aria-labelledby="editCandidateModalLabel-{{ $candidate->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCandidateModalLabel-{{ $candidate->id }}">Edit Kandidat</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('candidate.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="name">Nama Kandidat</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $candidate->name }}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ketua_id">Ketua</label>
                                                            <select name="ketua_id" class="form-control" required>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $candidate->ketua_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="wakil_id">Wakil</label>
                                                            <select name="wakil_id" class="form-control">
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $candidate->wakil_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="visi">Visi</label>
                                                            <textarea name="visi" class="form-control" required>{{ $candidate->visi }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="misi">Misi</label>
                                                            <textarea name="misi" class="form-control" required>{{ $candidate->misi }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Gambar Kandidat</label>
                                                            <input type="file" name="image" class="form-control">
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update Kandidat</button>
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

            <!-- Tabel Kandidat Sekolah 2 -->
            <h3>Kandidat Sekolah 2</h3>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Kandidat Sekolah 2</h3>
                        </div>
                        <div class="card-body">
                            <table id="candidatesTableSchool2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kandidat</th>
                                        <th>Ketua</th>
                                        <th>Wakil</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidatesSchool2 as $candidate)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->ketua ? $candidate->ketua->name : '-' }}</td>
                                        <td>{{ $candidate->wakil ? $candidate->wakil->name : '-' }}</td>
                                        <td>{{ $candidate->visi }}</td>
                                        <td>{{ $candidate->misi }}</td>
                                        <td>
                                            @if($candidate->image)
                                                <img src="{{ asset('storage/'.$candidate->image) }}" alt="Candidate Image" width="50">
                                            @else
                                                <span>Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCandidateModal-{{ $candidate->id }}">Edit</button>
                                            <form action="{{ route('candidate.destroy', $candidate->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this candidate?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Kandidat -->
                                    <div class="modal fade" id="editCandidateModal-{{ $candidate->id }}" tabindex="-1" role="dialog" aria-labelledby="editCandidateModalLabel-{{ $candidate->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCandidateModalLabel-{{ $candidate->id }}">Edit Kandidat</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('candidate.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="name">Nama Kandidat</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $candidate->name }}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ketua_id">Ketua</label>
                                                            <select name="ketua_id" class="form-control" required>
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $candidate->ketua_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="wakil_id">Wakil</label>
                                                            <select name="wakil_id" class="form-control">
                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}" {{ $candidate->wakil_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="visi">Visi</label>
                                                            <textarea name="visi" class="form-control" required>{{ $candidate->visi }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="misi">Misi</label>
                                                            <textarea name="misi" class="form-control" required>{{ $candidate->misi }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="image">Gambar Kandidat</label>
                                                            <input type="file" name="image" class="form-control">
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Update Kandidat</button>
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

@include('layout.footer')

<!-- Modal Tambah Kandidat -->
<div class="modal fade" id="createCandidateModal" tabindex="-1" role="dialog" aria-labelledby="createCandidateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCandidateModalLabel">Tambah Kandidat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('candidate.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                
                    <div class="form-group">
                        <label for="school_id">Sekolah</label>
                        <select name="school_id" id="school_id" class="form-control" required>
                            <option value="">Pilih Sekolah</option>
                            <option value="1">Sekolah 1</option>
                            <option value="2">Sekolah 2</option>
                            <!-- Add more schools as needed -->
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="name">Nama Kandidat</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                
                    <div class="form-group">
                        <label for="ketua_id">Ketua</label>
                        <select name="ketua_id" id="ketua_id" class="form-control" required>
                            <option value="">Pilih Ketua</option>
                            <!-- Options will be populated based on selected school -->
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="wakil_id">Wakil</label>
                        <select name="wakil_id" id="wakil_id" class="form-control">
                            <option value="">Pilih Wakil</option>
                            <!-- Options will be populated based on selected school -->
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label for="visi">Visi</label>
                        <textarea name="visi" class="form-control" rows="3" required></textarea>
                    </div>
                
                    <div class="form-group">
                        <label for="misi">Misi</label>
                        <textarea name="misi" class="form-control" rows="3" required></textarea>
                    </div>
                
                    <div class="form-group">
                        <label for="image">Gambar Kandidat</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                
                    <button type="submit" class="btn btn-primary">Tambah Kandidat</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- Script untuk inisialisasi DataTables -->
<script>
    $(function () {
        $('#candidatesTableSchool1').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": true,
        });
        
        $('#candidatesTableSchool2').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": true,
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Define users with their respective school ids
        const users = @json($users); // Assuming $users is an array of user objects

        const schoolSelect = document.getElementById('school_id');
        const ketuaSelect = document.getElementById('ketua_id');
        const wakilSelect = document.getElementById('wakil_id');

        schoolSelect.addEventListener('change', function () {
            const selectedSchoolId = parseInt(this.value);

            // Clear previous options
            ketuaSelect.innerHTML = '<option value="">Pilih Ketua</option>';
            wakilSelect.innerHTML = '<option value="">Pilih Wakil (Opsional)</option>';

            // Filter users by selected school id and populate ketua and wakil selects
            const filteredUsers = users.filter(user => user.school_id === selectedSchoolId);

            filteredUsers.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.name;
                ketuaSelect.appendChild(option);

                const wakilOption = document.createElement('option');
                wakilOption.value = user.id;
                wakilOption.textContent = user.name;
                wakilSelect.appendChild(wakilOption);
            });
        });
    });
</script>
