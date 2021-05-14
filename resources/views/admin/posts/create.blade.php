<x-admin-master>
    @section('content')
        <h1>Create Post</h1>
        <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="title">Title :</label>
                <input type="text" 
                    name="title" 
                    id="title" 
                    class="form-control" 
                    placeholder="Enter Title..">
            </div>
            <div class="form-group">
                <label for="post_image">Select Image :</label>
                <input type="file" 
                    name="post_image" 
                    id="post_image" 
                    class="form-control-file">
            </div>
            <div class="form-group">
                <label for="body">Body :</label>
                <textarea name="body" 
                    id="body" 
                    cols="30" 
                    rows="10"
                    class="form-control"
                    placeholder="Enter Body.."></textarea>
            </div>
            <div class="form-group"><input type="submit" value="Submit" class="btn btn-primary"></div>
        </form>
    @endsection()
</x-admin-master>