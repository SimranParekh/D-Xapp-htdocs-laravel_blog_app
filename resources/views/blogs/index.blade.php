
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
</head>

<body>
<nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register-user') }}">Register</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                    </li>
                    
                    @endguest
                </ul>
            </div>
            
            <h4 class="text-right" >{{ Auth::user()->name }}</h4>
                    
        </div>
    </nav>
    <div class="container">   
        <div class="row input-daterange">
            <div class="col-md-4">
                <input type="text" name="created_at" id="created_at" class="form-control" placeholder="From Date" readonly />
            </div>
            <div class="col-md-4">
                <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
            </div>
        </div>
        <br />
        <div class="col text-right">
            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm float-right">Add new blog</a>
        </div>
        <br />
        <div class="row" id="total_records">
            <div class="col-md-12">
                <table id="blogs_table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" width="1%">#</th>
                            <th scope="col" width="10%">Name</th>
                            <th scope="col" width="8%">Description</th>
                            <th scope="col" width="10%">Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>{{ $blog->name }}</td>
                                <td>{{ $blog->description }}</td>
                                <td>{{ $blog->category_id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body> 
<script>
$(document).ready(function(){
    $('.input-daterange').datepicker({
        todayBtn:'linked',
        format:'dd-mm-yyyy',
        autoclose:true
    });
 
    load_data();
    
    function load_data(created_at = ''){
        $('#blogs_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url:'{{ route("blogs.filter") }}',
                data:{created_at:created_at}
            },
            columns: [{
                data:'id'
            },
            {
                data:'name'
            },
            {
                data:'description'
            },
            {
                data:'category_id'
            }
            
            ]
        });
    }
 
    $('#filter').click(function(){
        var created_at = $('#created_at').val();
        console.log(created_at)
        if((created_at) && (created_at != '')){
            $('#blogs_table').DataTable().destroy();
            load_data(created_at);
        }
        else{
            alert('Date is required');
        }
    });

 
    $('#refresh').click(function(){
        $('#created_at').val('');
        $('#blogs_table').DataTable().destroy();
        load_data();
    });
});
</script>
<script>
    $(document).ready(function () {
    $('#blogs_table').DataTable();
});
</script>
