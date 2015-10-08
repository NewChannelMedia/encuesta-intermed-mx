<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-4">
        <div class="col-md-offset-2">
          <form method="POST"action ="<?=base_url()?>admin/login"id="loguin"class="form-horizontal">
            <div class="form-group">
              <label for="userLog" class="col-sm-2 control-label">Usuario</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="userLog" name="user" placeholder="Usuario:"/>
              </div>
            </div>
            <div class="form-group">
              <label for="pass" class="col-sm-2 control-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="pass" name="password" placeholder="Password:" />
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Sign in</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
