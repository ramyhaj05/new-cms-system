<x-admin-master>
    @section('content')
        <h1>All Posts</h1>
          @if(Session::has('message'))
          <div class="alert alert-danger">{{Session::get('message')}}</div>
          @elseif(Session::has('message-created'))
          <div class="alert alert-success">{{Session::get('message-created')}}</div>
          @elseif(Session::has('message-updated'))
          <div class="alert alert-success">{{Session::get('message-updated')}}</div>
          @elseif(Session::has('message-edit'))
          <div class="alert alert-warning">{{Session::get('message-edit')}}</div>
          @endif
        
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>OWNER</th>
                      <th>TITLE</th>
                      <th>IMAGE</th>
                      <th>CREATED AT</th>
                      <th>UPDATED</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>OWNER</th>
                      <th>TITLE</th>
                      <th>IMAGE</th>
                      <th>CREATED AT</th>
                      <th>UPDATED</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($posts as $post)
                      <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->user->name}}</td>
                        <td><a href="{{route('post.edit',$post->id)}}">{{$post->title}}</a></td>
                        <td><img height="100px" src="{{$post->post_image}}" alt=""></td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td>
                          <form action="{{route('post.destroy',$post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="d-flex">
            <div class="mx-auto">{{$posts->links()}}</div>
          </div>
          
    @endsection

    

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{asset('js/demo/datatables-demo.js')}}"></script> -->
    @endsection
</x-admin-master>