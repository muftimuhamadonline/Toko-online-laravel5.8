<form method="post" action="{{ route('changeImage',['id'=>Auth::user()->id]) }}" enctype="multipart/form-data">
    @csrf
    <img id="image" name="image" src="{{asset('userimageprofile/'.Auth::user()->image)}}" alt="testimonial images">
    <h2 class="text-center">{{ Auth::user()->name }}</h2>
    <input type="file" class="badge badge-info" name="edit" id="edit">
    <button type="submit" id="save" class="badge badge-success save">save</button>
    <input type="hidden" id="id" value="{{ Auth::user()->id }}">
</form>

<script>
    $(document).ready(function(){
        $("#edit").hide()
        $("#save").hide()
            $("#image").mouseover(function(){
                $("#edit").show();
                $("#save").show();
        });
    });
        // Change image
</script>
{{-- <script>
        $(document).ready(function(){
            $("#save").click(function(e){
                e.preventDefault();
                var token = $("#image").prev().val();
                var image = path.split('\\').pop();
                alert("ok");
            });
        });
</script> --}}