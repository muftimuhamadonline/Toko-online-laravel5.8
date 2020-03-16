<form action="{{ route('change',['id'=>Auth::user()->id]) }}" method="post">
        <input id="id" name="id" type="hidden" value="{{ Auth::user()->id }}">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input name="name" id="name" type="text" value="{{ Auth::user()->name }}" class="form-control" >
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Email</span>
            </div>
            <input type="text" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Nomor Telepon</span>
            </div>
            <input type="text" name="notelepon" id="notelepon" value="{{ Auth::user()->notelepon }}" class="form-control">
        </div>
        @csrf
        <button type="submit" class="badge badge-success savecancel" id="save">Save</button>   
        <button class="badge badge-danger savecancel" id="cancel">Cancel</button>   
</form>

    <script>
        // hide,show button confirm
        $(document).ready(function(){
            $(".savecancel").hide();
        $("input").click(function(e){
            e.preventDefault();
            $(".savecancel").show();
        })
    });
    // If user canceled the edit process
        $("#cancel").click(function(e){
            e.preventDefault();
            $(".savecancel").hide(2000);
            // $(".container-load").load("{{ url('profile/loadProfile') }}");
        });




    </script>
    <script>
            // Save Profile Without Image
        $("#save").click(function(e){
            e.preventDefault();
            var id = $("form").find("#id").val();
            var token = $(this).prev().val();
            var name = $("#name").val();
            var email = $("#email").val();
            var notelepon = $("#notelepon").val();
            $.post("{{ url('profile/changeprofile') }}/"+id,{id:id,_token:token,name:name,email:email,notelepon:notelepon},function(result){
                var json = jQuery.parseJSON(JSON.stringify(result));
                if(json.status == 1){
                    alert(json.message);
                    $(".container-load").load('{{ url("profile/loadProfile") }}');
                }else{
                    alert("Cannot be update!");
                }
            });
        });
    </script>

                           