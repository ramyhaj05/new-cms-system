<x-admin-master>
    @section('content')
        <h1>Edit Post</h1>
        <form action="{{route('post.update',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
            <div class="form-group">
                <label for="title">Title :</label>
                <input type="text" 
                    name="title" 
                    id="title" 
                    class="form-control" 
                    placeholder="Enter Title.."
                    value="{{$post->title}}">
            </div>
            <div class="form-group">
                <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
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
                    placeholder="Enter Body..">{{$post->body}}</textarea>
            </div>
            <div class="form-group"><input type="submit" value="Submit" class="btn btn-primary"></div>
        </form>
    @endsection()
</x-admin-master>