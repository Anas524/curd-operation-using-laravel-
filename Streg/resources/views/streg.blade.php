<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Registration</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <main class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <h3 class="card-header text-center">Register</h3>
                        <div class="card-body">
                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="/addData">
                                @csrf
                                <div class="from-group mb-3">
                                    <input type="text" placeholder="Name" id="name" class="form-control" name="name" autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif    
                                </div>
                                <div class="from-group mb-3">
                                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif    
                                </div>
                                <div class="from-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif    
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-primary btn-block">Sign up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-8 mx-auto">
                    <h3>Registerd Users</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ModifyDatas as $ModifyData)
                            <tr>
                                <td>{{ $ModifyData->id }}</td>
                                <td>{{ $ModifyData->name }}</td>
                                <td>{{ $ModifyData->email }}</td>
                                <td>{{ $ModifyData->created_at->format('d-m-Y h:m:s') }}</td>
                                <td>
                                    <a href="javascript:void(0);" onclick="editData('{{ $ModifyData->id }}')" class="btn btn-success m-1">Edit</a>
                                    <a href="{{ url('delete/'.$ModifyData->id) }}" class="btn btn-danger m-1" onclick="return confirmDelete();">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="textcenter">No registered users found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editData(id) {
            $.ajax({
                url: 'edit/' + id,
                method: 'GET',
                success: function (data) {
                    if (data) {
                        $('#editModal #name').val(data.name);
                        $('#editModal #email').val(data.email);
                        
                        $('#editModal form').attr('action', 'update-data/' + data.id);
                        
                        $('#editModal').modal('show');
                    } else {
                        alert('Failed to fetch the data.');
                    }
                },
                error: function (xhr) {
                    // Log the error and show a message if data fetching fails
                    alert('Error fetching data.');
                }
            });
        }

        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</body>
</html>