@include('header')
<div class="container">
  <div class="row">
    <div class="col s12 m10 offset-m1" style="margin-top:30px">
      <div class="card">
        <form name="frmUpload">
          <input type="hidden" name="code" value="{{ $code }}">
          <div class="card-content">
            <span class="card-title black-text">Upload</span>
            <div class="row">
              <div class="file-field input-field">
                <div class="btn">
                  <span>Browse</span>
                  <input type="file" name="image_reference">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload file">
                </div>
              </div>
            </div>
            <div class="image-container"></div>
          </div>
          <div class="card-action" style="overflow:hidden">
            <button type="submit" class="btn waves-light waves-effect right">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@include('footer')
