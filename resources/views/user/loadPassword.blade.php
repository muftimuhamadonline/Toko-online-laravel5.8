
<form id="form" action="{{ route('changepassword') }}" method="post">
    @csrf
    <div id="1" class="form-group">
        <label for="current">Current Password</label>
        <input type="password" name="current" class="form-control" id="current">
    </div>
    <div class="form-group">
        <label for="newpassword">New Password</label>
        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Your New Password">
    </div>
    <div class="form-group">
        <label for="newpassword2">Repeat New Password</label>
        <input type="password" class="form-control" name="newpassword2" id="newpassword2"  placeholder="Repeat Your New Password">
    </div>
    <button type="submit" class="btn btn-success" id="submit">Submit</button>
</form>

<script>
        $(document).ready(function(){
            $("#submit").click(function(e){
                e.preventDefault();
                var current = $('form').find("#current").val();
                var newpass = $('form').find("#newpassword").val();
                var newpass2 = $('form').find("#newpassword2").val();
                var token = $('#1').prev().val()
                $.post('{{ URL::to("profile/changepassword") }}',{_token:token,current:current,newpassword:newpass,newpassword2:newpass2},function(result){
                    var json = jQuery.parseJSON(JSON.stringify(result));
                    if(json.status == 1){
                        alert(json.message);
                        $(".container-load").load("{{ url('profile/loadPassword') }}");
                    }else{
                        alert(json.error);
                    }
                });
            });
        });
</script>