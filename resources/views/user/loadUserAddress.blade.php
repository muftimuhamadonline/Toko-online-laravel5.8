<div class="col-md-8">
        <div class="row">
                <div class="col-md-8">
                        <p><h2>Current Address:</h2></p><br/>
                        <h3>{{ Auth::user()->alamat }}</h3>
                </div>
        </div><br/><hr>
        <form method="post" action="{{ route('changeaddress') }}">
                @csrf
                <div class="form-group">
                        <textarea placeholder="Ubah alamat" class="form-control" id="changeaddress" name="changeaddress" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success" id="btnsave">Save</button>
        </form>
</div>
<script>
        $(document).ready(function(){
                $("#btnsave").hide();
                $("#changeaddress").click(function(){
                        $("#btnsave").show();
                });
        });
</script>
<script>
        $(document).ready(function(){
                $("#btnsave").click(function(e){
                        e.preventDefault();
                        var value = $("textarea#changeaddress").val();
                        var token = $(this).prev().prev().val();
                $.post('{{ url("profile/changeaddress") }}',{changeaddress:value,_token:token},function(data){
                        var json = jQuery.parseJSON(JSON.stringify(data));
                                if(json.status == 1){
                                        alert(json.message);
                                $(".container-load").load('{{ url("profile/address") }}');   
                                }else{
                                        alert("Wrong Address");
                                }
                        });
                });
        })
</script>            