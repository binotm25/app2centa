@if(Session::has('info'))
    <div class="modal fade" id="info_pop_route" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <p class="modal-title" id="myModalLabel">{!! Session::get('type') !!}</p>
                    <h4 style="color: red;"></h4>
                </div>
                <div class="modal-body">
                    <p>{{ Session::get('info') }}</p>
                    <div class="text-right">
                        <button type="button" class="btn btn-default btn-modal" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                    <a class="btn btn-danger" data-dismiss="modal">Close</a>
                </div> -->
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#info_pop_route').modal('show');
        });
    </script>
@endif

@if($errors->any())
    <div class="modal fade" id="error_pop_route" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="background: rgba(125, 189, 255, 0.84) !important; color: #31708f !important;">
                <div class="modal-header">
                    <h4 style="color: red;">Errors!</h4>
                </div>
                <div class="modal-body">
                    @foreach($errors->all() as $key=>$value)
                        <h4>{{ $key+1 }}. {{ $value }}</h4>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#error_pop_route').modal('show');
        });
    </script>
@endif

<div class="modal fade" id="msgPopUp" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title" id="title-label"></p>
            </div>
            <div class="modal-body">
                <p class="reason"></p>
                <div class="text-right" id="addButton">
                    <button type="button" class="btn btn-default btn-modal" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <a class="btn btn-danger" data-dismiss="modal">Close</a>
            </div> -->
        </div>
    </div>
</div>