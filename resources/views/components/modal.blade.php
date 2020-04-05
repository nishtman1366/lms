<div class="modal fade" id="{{$id}}" tabindex="-1" role="dialog"
     aria-labelledby="{{$id}}-labelled" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{$id}}-labelled">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
            <div class="modal-footer">
                @foreach($buttons as $button)
                    <button type="button"
                            class="btn btn-{{$button['class']}}" {{key_exists('form_id',$button) ? 'data-form-id="'.$button['form_id'].'"' : ''}} {{key_exists('dismiss',$button) ? 'data-dismiss=modal' : ''}}>
                        {{$button['label']}}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>