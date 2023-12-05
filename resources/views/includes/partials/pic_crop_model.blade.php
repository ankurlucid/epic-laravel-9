 <div class="modal fade picCropModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Persanalize your chart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            
            <div class="btn-group m-b-10 crop-selector">
                @if (isset($source) && $source == 'meal')
                    <a class="btn btn-primary btn-o toggle-ratio hidden" href="#" data-ratio="1.77"
                        data-crop-selector="aspect">Aspect</a>
                @else
                    <a class="btn btn-primary btn-o toggle-ratio" href="#" data-ratio="1"
                        data-crop-selector="square">Square</a>
                    <a class="btn btn-primary btn-o toggle-ratio rectangleRatio" href="#" data-ratio="0"
                        data-crop-selector="rectangle">Rectangle</a>
                @endif
            </div>
            <div class="center">
                @if (isset($source) && $source == 'meal')
                    <img alt="Loading..." class="preview" style="width: 500px; height: 400px;" />
                @else
                    <img alt="Loading..." class="preview" />
                @endif
                <input type="hidden" name="ui-x1" />
                <input type="hidden" name="ui-y1" />
                <input type="hidden" name="ui-w" />
                <input type="hidden" name="ui-h" />
                <input type="hidden" name="widthScale" />
                <input type="hidden" name="heightScale" />
                <input type="hidden" name="photoName">
                <input type="hidden" id="getPhotoCropCsrf" name="_token" value="{{ csrf_token() }}" />
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn bg-gradient-primary save">Save</button>

        </div>
      </div>
    </div>
  </div>
